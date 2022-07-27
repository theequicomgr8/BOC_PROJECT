<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Session;
use Auth;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\PseudoTypes\False_;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\outdoorMediaTableTrait;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait, outdoorMediaTableTrait;
    public function index($media_id)
    {
        $tableFm = 'BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2';
        if (!Session::has('id')) {
            return Redirect('/vendor-login');
        } else {

            Session::put('payment_odmediaid', $media_id);

            $stateJson = $this->getStates();
            $states = json_decode(json_encode($stateJson), true);
            if (Session::get('WingType') == 0) {
                $owner_id = DB::table($this->tableODMediaOwnerDetail)->select('Owner ID')->where('OD Media ID', session('payment_odmediaid'))->first();
            } else {
                $owner_id = DB::table($tableFm)->select('Owner ID')->where('FM Station ID', session('payment_odmediaid'))->first();
            }
            $owner_data = '';
            if (!empty($owner_id)) {
                $owner_data = DB::table($this->tableOwner)->select('Owner Name', 'Mobile No_', 'Email ID', 'Address 1', 'State', 'City')->where('Owner ID', $owner_id->{'Owner ID'})->first();
            }
            return view('payment.payment')->with(['states' => $states['original']['data'], 'owner_data' => $owner_data]);
        }
    }
    public function signSignature(Request $request)
    {
        if (!Session::has('id')) {
            return Redirect('/vendor-login');
        } else {
            $request->validate(
                [
                    'amount' => 'required',
                    'email' => 'required',
                    'bill_fname' => 'required',
                    'bill_lname' => 'required',
                    'bill_mobile' => 'required',
                    'bill_address' => 'required',
                    'bill_pincode' => 'required',
                    'bill_country' => 'required',
                    'bill_state' => 'required',
                    'bill_city' => 'required',
                    'ship_fname' => 'required',
                    'ship_lname' => 'required',
                    'ship_mobile' => 'required',
                    'ship_address' => 'required',
                    'ship_pincode' => 'required',
                    'ship_country' => 'required',
                    'ship_state' => 'required',
                    'ship_city' => 'required'
                ]
            );

            // set order code
            $request->orderCode = 'TEST' . time();
            // insert data to database
            $data = array(
                'amount' => $request->amount,
                'orderCode' => $request->orderCode
            );
            $response = $this->insertData($data);
            if ($response == true) {
                // generate simple xml
                $dom = $this->generateSimpleXML($request);
                $path = resource_path() . '\views\payment';
                // Create a new Security object 
                $objDSig = new XMLSecurityDSig();
                // Use the c14n exclusive canonicalization
                $objDSig->setCanonicalMethod(XMLSecurityDSig::C14N);
                // Sign using SHA-1
                $objDSig->addReference(
                    $dom,
                    XMLSecurityDSig::SHA1,
                    array('http://www.w3.org/2000/09/xmldsig#enveloped-signature')
                );
                // Create a new (private) Security key
                $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'private'));
                // Load the private key
                $objKey->loadKey($path . '/private.pem', TRUE);
                // Sign the XML file
                $objDSig->sign($objKey);
                // Append the issuerSerial tag to the XML
                $crt = $path . '\server.crt';
                $cert = file_get_contents($crt);
                $data = openssl_x509_parse($cert, true);
                $options = array(
                    'issuerSerial' => 'issuerSerial',
                    'issuer' => $data['issuer'],
                    'serialNumber' => $data['serialNumber'],
                );
                // Add the associated public key to the signature
                $objDSig->add509Cert(file_get_contents($path . '/public.pem'), $isPEMFormat = true, $isURL = false, $options);
                // Append the signature to the XML      
                $objDSig->appendSignature($dom->documentElement);
                // Save the signed XML
                $xml_file = $path . '/SigendSample.xml';
                $dom->save($xml_file);
                // Read created XML
                $t_xml = file_get_contents($xml_file);
                // Remove first line xml version
                $t_xml = preg_replace('!^[^>]+>(\r\n|\n)!', '', $t_xml);
                // Save into same file as original
                file_put_contents($xml_file, $t_xml);
                $data = file_get_contents($xml_file);
                //remove space after tags
                $data = preg_replace("/>\s*</", "><", $data);
                $base64 = base64_encode($data);
                $postURL = 'https://training.pfms.gov.in/bharatkosh/BKEpay';
                return view('payment.bharatkosh-payment', compact('base64', 'postURL'));
            } else {
                return \Redirect::back()->withErrors(['msg' => 'Some error occurred!']);
            }
        }
    }

    private function generateSimpleXML(Request $request)
    {
        $orderCode = $request->orderCode;
        $Installation_id = '11112';
        $pao_code = '027973';
        $ddo_code = '227974';
        $orderContent = '14788';

        $xml = '<BharatKoshPayment DepartmentCode="020" Version="1.0"><Submit>';
        $xml .= '<OrderBatch TotalAmount="' . $request->amount . '" Transactions="' . $request->amount . '" merchantBatchCode="' . $orderCode . '">';
        $xml .= '<Order InstallationId="' . $Installation_id . '" OrderCode="' . $orderCode . '">';
        $xml .= '<CartDetails><Description>BOC</Description><Amount CurrencyCode="INR" exponent="0" value="' . $request->amount . '" />';
        $xml .= '<OrderContent>' . $orderContent . '</OrderContent><PaymentTypeId>0</PaymentTypeId><PAOCode>' . $pao_code . '</PAOCode><DDOCode>' . $ddo_code . '</DDOCode></CartDetails>';
        $xml .= '<PaymentMethodMask><Include Code="OnLine" /></PaymentMethodMask><Shopper><ShopperEmailAddress>' . $request->email . '</ShopperEmailAddress></Shopper>';
        $xml .= '<ShippingAddress><Address><FirstName>' . $request->ship_fname . '</FirstName><LastName>' . $request->ship_lname . '</LastName><Address1>' . $request->ship_address . '</Address1><Address2 /><PostalCode>' . $request->ship_pincode . '</PostalCode><City>' . $request->ship_city . '</City><StateRegion>' . $request->ship_state . '</StateRegion><State>' . $request->ship_state . '</State><CountryCode>' . $request->ship_country . '</CountryCode><MobileNumber>' . $request->ship_mobile . '</MobileNumber></Address></ShippingAddress>';
        $xml .= '<BillingAddress><Address><FirstName>' . $request->bill_fname . '</FirstName><LastName>' . $request->bill_lname . '</LastName><Address1>' . $request->bill_address . '</Address1><Address2 /><PostalCode>' . $request->bill_pincode . '</PostalCode><City>' . $request->bill_city . '</City><StateRegion>' . $request->bill_state . '</StateRegion><State>' . $request->bill_state . '</State><CountryCode>' . $request->bill_country . '</CountryCode><MobileNumber>' . $request->bill_mobile . '</MobileNumber></Address></BillingAddress>';
        $xml .= '<StatementNarrative /><Remarks /></Order></OrderBatch></Submit></BharatKoshPayment>';
        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = true;
        $dom->loadXML($xml);
        $path = resource_path() . '\views\payment';
        $dom->save($path . '/simpleXML.xml');
        return $dom;
    }

    public function verifySignature(Request $request)
    {
        $xml = base64_decode($request->BharatkoshResponse);
        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = true;
        $dom->loadXML($xml);
        $path = resource_path() . '\views\payment';
        $dom->save($path . '/responseXML.xml');
        $objDSig = new XMLSecurityDSig();
        // assign response xml to dom
        $objDSig->locateSignature($dom, 0);
        // create signInfoNode for verification signature
        $objDSig->canonicalizeSignedInfo();
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'public'));
        // Load the public key
        $objKey->loadKey($path . '/certificate.pem', TRUE);
        // verify the XML file
        $res =  $objDSig->verify($objKey);
        if ($res === 1) {
            $resxml = $path . '\responseXML.xml';
            // xml to array convert start
            $data = file_get_contents($resxml);
            // $data = openssl_x509_parse($data, true);
            $xmlObject = simplexml_load_string($data);
            // $json = json_encode($xmlObject);
            $resData = json_decode(json_encode($xmlObject), true);
            // xml to array convert end
            // update data to database
            $reply_attr_one = $resData['reply']['orderStatus']['@attributes'];
            $reply_attr_two = $resData['reply']['orderStatus']['reference']['@attributes'];
            $dateTime = Carbon::now();
            $transaction_date = '';
            if ($reply_attr_two['BankTransacstionDate'] != 'NA') {
                $transaction_date = date('Y-m-d H:i:s', strtotime($reply_attr_two['BankTransacstionDate']));
            } else {
                $transaction_date = $dateTime->toDateTimeString();
            }
            $reference_id = '';
            if ($reply_attr_two['id'] != '') {
                $reference_id = $reply_attr_two['id'];
            }
            $resData = array(
                'Status' => $reply_attr_one['status'],
                'Reference ID' => $reference_id,
                'Bank Transaction Date' => $transaction_date
            );
            $where = array('Order Code' => $reply_attr_one['orderCode']);
            $res = $this->updateData($resData, $where);
            if ($res == true) {
                return Redirect('/outdoor-media-list')->with('msg_success', 'Payment transacstion successful!');
            } else {
                return Redirect('/outdoor-media-list')->with('msg_error', 'Some error occurred!');
            }
        }
    }

    public function insertData($data)
    {
        $insert_array = array(
            'Media ID' => Session('payment_odmediaid'),
            'Amount' => $data['amount'],
            'Order Code' => $data['orderCode'],
            'Status' => '',
            'Reference ID' => '',
            'Bank Transaction Date' => '',
            'Global Dimension 1 Code' => '',
            'Global Dimension 2 Code' => ''
        );
        $sql = DB::table($this->tableVendorFees)->insert($insert_array);
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function updateData($resData, $where)
    {
        $sql = DB::table($this->tableVendorFees)->where($where)->update($resData);
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function getPaymentDetails(Request $request)
    {
        $select = array(
            'Amount',
            'Order Code as order_code',
            'Status',
            'Reference ID as ref_id',
            'Bank Transaction Date as transaction_date'
        );
        $data = DB::table($this->tableVendorFees)->select($select)->where('Media ID', $request->od_media_id)->first();
        $payment_data = '<tr><td colspan="5">No data found!</td></tr>';
        if (!empty($data)) {
            $amount = $data->Amount;
            $order_code = $data->order_code;
            $status = $data->Status;
            $ref_id = $data->ref_id;
            $transaction_date = date('d/m/Y H:i:s', strtotime($data->transaction_date));
            $payment_data = "<tr>
                            <td>$order_code</td>
                            <td>" . round($amount, 2) . "</td>
                            <td>$ref_id</td>
                            <td>$transaction_date</td>
                            <td>$status</td>
                            </tr>";
            return response()->json(['status' => 1, 'payment_data' => $payment_data]);
        } else {
            return response()->json(['status' => 0, 'payment_data' => $payment_data]);
        }
    }
}
