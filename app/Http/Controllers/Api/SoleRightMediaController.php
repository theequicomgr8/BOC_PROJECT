<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\outdoorMediaTableTrait;
use DB;
use Carbon\Carbon;
use Session;
use App\Models\Api\RateSettlementPersonalMedia;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MediaExcelsImportDone;
use App\Exports\Outdoor\SoleRightMediaExcelExport;
use App\Imports\Outdoor\Media\SoleRightMediaSheets;

class SoleRightMediaController extends Controller
{
    use CommonTrait, outdoorMediaTableTrait;

    public function getMediaExcel(Request $request)
    {
        // lit type section

        $litdata_array = array();
        $excel_data_array = array();
        $litStr = "Bus Panel,Hoarding,Digital Display,Train Inside,Train Outside";

        $lit_arr_data = explode(",", $litStr);
        $subCatTextArr = explode(",", $request->subcattext);
        $i = 0;
        $nonlit = 0;
        foreach ($subCatTextArr as $subcattext) {

            $nonlit = 0;
            foreach ($lit_arr_data as $val) {
                if (str_contains($subcattext, $val)) {
                    $nonlit = 1;
                }
            }

            $litdata_array[$i]['cat'] = $request->cattext;
            $litdata_array[$i]['sub_cat'] = $subcattext;

            if ($nonlit == 1) {

                $litdata_array[$i]['illumination'] = '';
                $litdata_array[$i]['lit_type'] = '';
            } else {

                $litdata_array[$i]['illumination'] = '';
                $litdata_array[$i]['lit_type'] = '';
            }
            $i++;
        }

        //end lit type section

        $traindata_array = array();
        $no_ofspots_array = array();
        $size_array = array();
        $key_data = array();
        $train_arr_data = "OD029,OD030,OD084,OD108";
        $no_ofspots_arr_data = "OD006,OD013,OD072,OD073,OD110,OD122,OD086,OD087,OD123,OD127";
        $size_arr_data = "OD053,OD010,OD011,OD014,OD017,OD018,OD019,OD020,OD021,OD023,OD024,OD025,OD036,OD037,OD038,OD044,OD047,OD048,OD054,OD055,OD057,OD071,OD082,OD084,OD088,OD089,OD090,OD092,OD095,OD108,OD113,OD117,OD041,OD120,OD035,OD051";

        foreach ($request->subcatvalue as $key => $subcatval) {

            if (strpos($no_ofspots_arr_data, $subcatval) !== false) {
                // no of spots section
                $excel_data_array[$key]['noOfSpotsArray']['Category'] = $request->cattext;
                $excel_data_array[$key]['noOfSpotsArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                $excel_data_array[$key]['noOfSpotsArray']['No Of Spots'] = '';
                $excel_data_array[$key]['noOfSpotsArray']['Illumination'] = $litdata_array[$key]['illumination'];
                if ($litdata_array[$key]['lit_type'] != '') {
                    $excel_data_array[$key]['noOfSpotsArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                }
                array_push($key_data, 'noOfSpotsArray');
            } else if (strpos($size_arr_data, $subcatval) !== false) {

                if (strpos($train_arr_data, $subcatval)  !== false) {
                    // size and train section 
                    $excel_data_array[$key]['sizeTrainArray']['Category'] = $request->cattext;
                    $excel_data_array[$key]['sizeTrainArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];

                    $excel_data_array[$key]['sizeTrainArray']['Train Number'] = '';
                    $excel_data_array[$key]['sizeTrainArray']['Train Name'] = '';

                    // $excel_data_array[$key]['sizeTrainArray']['Size Type'] = 'CM';
                    // $excel_data_array[$key]['sizeTrainArray']['Length'] = '56';
                    // $excel_data_array[$key]['sizeTrainArray']['Width'] = '78';

                    $excel_data_array[$key]['sizeTrainArray']['Illumination'] = $litdata_array[$key]['illumination'];
                    if ($litdata_array[$key]['lit_type'] != '') {
                        $excel_data_array[$key]['sizeTrainArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                    }

                    array_push($key_data, 'sizeTrainArray');
                } else {
                    // size section
                    $excel_data_array[$key]['sizeArray']['Category'] = $request->cattext;
                    $excel_data_array[$key]['sizeArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];

                    // $excel_data_array[$key]['sizeArray']['Size Type'] = 'CM';
                    // $excel_data_array[$key]['sizeArray']['Length'] = '56';
                    // $excel_data_array[$key]['sizeArray']['Width'] = '78';

                    $excel_data_array[$key]['sizeArray']['Illumination'] = $litdata_array[$key]['illumination'];
                    if ($litdata_array[$key]['lit_type'] != '') {
                        $excel_data_array[$key]['sizeArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                    }

                    array_push($key_data, 'sizeArray');
                }
            } else if (strpos($train_arr_data, $subcatval)  !== false) {
                // train section
                $excel_data_array[$key]['trainArray']['Category'] = $request->cattext;
                $excel_data_array[$key]['trainArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                $excel_data_array[$key]['trainArray']['Train Number'] = '';
                $excel_data_array[$key]['trainArray']['Train Name'] = '';

                $excel_data_array[$key]['trainArray']['Illumination'] = $litdata_array[$key]['illumination'];
                if ($litdata_array[$key]['lit_type'] != '') {
                    $excel_data_array[$key]['trainArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                }
                array_push($key_data, 'trainArray');
            } else {
                //default section
                $excel_data_array[$key]['default']['Category'] = $request->cattext;
                $excel_data_array[$key]['default']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                $excel_data_array[$key]['default']['Illumination'] = $litdata_array[$key]['illumination'];
                if ($litdata_array[$key]['lit_type'] != '') {
                    $excel_data_array[$key]['default']['Lit Type'] = $litdata_array[$key]['lit_type'];
                }
                array_push($key_data, 'default');
            }
        }
        //return (new MediaExcelExport($excel_data_array))->download('media_sample.xlsx');

        $myFile =  Excel::raw(new SoleRightMediaExcelExport($key_data, $excel_data_array), 'Xlsx');

        $response =  array(
            'name' => "outdoor_sample.xlsx",
            'file' => "data:application/vnd.ms-excel;base64," . base64_encode($myFile)
        );
        return response()->json($response);
    }

    public function fetchOwnerRecord(Request $request)
    {
        $table = $this->tableOwner;
        $select = array('Owner ID', 'Owner Name', 'Mobile No_', 'Email ID', 'Phone No_', 'Fax No_', 'Address 1', 'City', 'District', 'State');
        $where = array($request->key => $request->owner_id);
        $response = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', '');

        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    public function fetchOwnerVendorMapped(Request $request)
    {
        $table = $this->tableODMediaOwnerDetail;
        $select = array('Owner ID');
        $where = array($request->key => $request->owner_id, 'OD Media Type' => 1);
        $response = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', '');
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function getAllDistricts()
    {
        $table = $this->tableDistrict;
        $select = array('District');
        $response = RateSettlementPersonalMedia::fetchAllRecords($table, $select, 'District', 'ASC', '', '', '');
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function removeMediaaddress($line_no, $od_media_id)
    {
        $sql = DB::table($this->tableSoleMediasAddress)->where(['Line No_' => $line_no, 'Sole Media ID' => $od_media_id])->delete();
        if ($sql) {
            return $this->sendResponse('', 'Data deleted successfully!');
        } else {
            return $this->sendError('Some Error Occurred!.');
        }
    }
    public function removeSubcatLocation($subcatval, $od_media_id)
    {
        $sql = DB::table($this->tableODLatlongDetail)->where(['OD Media UID' => $subcatval, 'OD Vendor ID' => $od_media_id])->delete();
        if ($sql) {
            return $this->sendResponse('', 'Data deleted successfully!');
        } else {
            return $this->sendError('Some Error Occurred!.');
        }
    }
    //////////////////////// start outdoor media save data /////////////////
    public function OwnerDataSave(Request $request)
    {
        $msg = '';
        if ($request->ownerid == '') {
            $owner_id = DB::table($this->tableOwner)->select('Owner ID')->orderBy('Owner ID', 'desc')->first();
            if (empty($owner_id)) {
                $owner_id = 'EMPOW1';
            } else {
                $owner_id = $owner_id->{"Owner ID"};
                $owner_id++;
            }
            $sql =  $this->insertOwnerData($request, $owner_id);
            $msg = 'Data Saved Successfully!';
        } else {
            $sql =  $this->updateOwnerData($request);
            $msg = 'Data Updated Successfully!';
        }
        if ($sql) {
            return $this->sendResponse($request->ownerid, $msg);
        } else {
            return $this->sendError('Some Error Occurred!');
            exit;
        }
    }

    public function insertOwnerData(Request $request, $owner_id)
    {
        $table1 = '[' . $this->tableOwner . ']';
        $userid = Session::get('UserID');

        $request->owner_name = $request->owner_name ?? '';
        $request->phone = $request->phone ?? '';
        $request->owner_mobile = $request->owner_mobile ?? '';
        $request->owner_email = $request->owner_email ?? '';
        $request->owner_type = $request->owner_type ?? 0;
        $request->city = $request->city ?? '';
        $request->district = $request->district ?? '';
        $request->state = $request->state ?? '';
        $request->address = $request->address ?? '';

        return DB::insert(
            "insert into $table1 (
        [timestamp],[Owner ID],[Owner Name],[Mobile No_],[Email ID],[Phone No_],[Fax No_],[Address 1],[Address 2],[City],[District],
        [State],[HO Same Address as DO],[DO Address],[DO Landline No_(with STD)],[DO Fax No_],[DO E-Mail],[DO Mobile No_],[DO PIN Code],
        [DO City],[DO State],[DO District],[PIN Code],[User ID],[Group Name],[Printed],[BR Code],[Pay Mode],[Account No],[Account Type],
        [MICR Code],[MICR City Code],[Local],[RBI AG Code],[RBI BR Code],[State Code],[STEPS BR Code],[STEPS Account NO],[GRP Password],
        [STEPS CoreBank],[AUTH Sign Name],[AUTH Sign Desgn],[IFSC Code],[IFSC Account Name],[IFSC Account NO],[IFSC Address],[IFSC File],
        [Adwing Pay Mode],[PFMS UniqueCode],[Group New Name],[Sanction Payee],[Owner Type]
        )
        values (DEFAULT,
        '" . $owner_id . "','" . $request->owner_name . "','" . $request->owner_mobile . "','" . $request->owner_email . "','" . $request->phone . "','','" . $request->address . "','','" . $request->city . "','" . $request->district . "','" . $request->state . "',
        0,'','','','','','','','','','','" . $userid . "','','','',0,'','','','','','','','','','','','','','','','','','','',0,'','','',
         $request->owner_type
        )"
        );
    }

    public function updateOwnerData(Request $request)
    {
        $data = array(
            'Owner Name' => $request->owner_name ?? '',
            'Email ID' => $request->owner_email ?? '',
            'Mobile No_' => $request->owner_mobile ?? '',
            'Owner Type' => $request->owner_type ?? 0,
            'Address 1' => $request->address ?? '',
            'State' => $request->state ?? '',
            'District' => $request->district ?? '',
            'City' => $request->city ?? '',
            'Phone No_' => $request->phone ?? ''
        );
        return DB::table($this->tableOwner)->where(['Owner ID' => $request->ownerid, 'User ID' => Session::get('UserID')])->update($data);
    }

    public function companyDetailSave(Request $request)
    {
        $userid = Session::get('UserID');
        $current_year = Date('y');
        $current_month = Date('m');

        if ($request->odmedia_id == '') {
            $odmedia_id = DB::table($this->tableVendorEmpODMedia)->select('OD Media ID')->where('OD Media ID', 'LIKE',  '%' . '-OP' . '%')->orderBy('OD Media ID', 'desc')->first();

            if (empty($odmedia_id)) {
                $odmedia_id = $current_year . $current_month . '-OP0001';
            } else {
                $odmedia_id = $odmedia_id->{"OD Media ID"};
                $odmedia_id++;
            }

            $data = $this->companyDocData($request, $odmedia_id);

            if($data['Legal_Doc_File_Name'] == ''){
                if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
                    $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
                    $data['Legal_Doc_File_Name'] = time() . '-' . $od_media_id . '-LegalDocFile';
                    $file_uploaded = $file->move($destinationPath, $data['Legal_Doc_File_Name']);
                    if ($file_uploaded) {
                        $data['Company_Legal_Documents'] = 1;
                    } else {
                        $data['Legal_Doc_File_Name'] = '';
                    }
                }
            }

            $receiverID = $this->getReceiverID();
            $vendordata = [
                "OD Category" => 0,
                "OD Media ID" => $odmedia_id,
                "HO Address" => $request->HO_Address ?? '',
                "HO Landline No_" => $request->HO_Landline_No ?? '',
                "HO Fax No_" => '',
                "HO E-Mail" => $request->HO_Email ?? '',
                "HO Mobile No_" => $request->HO_Mobile_No ?? '',
                "DO Address" => '',
                "DO Landline No_" => '',
                "DO Fax No_" => '',
                "DO E-Mail" => '',
                "DO Mobile No_" => '',
                "Legal Status of Company" => 0,
                "Authority Which granted Media" => '',
                "Amount paid to Authority" => 0,
                "Contract No_" => 0,
                "License Fees" => 0,
                "Quantity Of Display" => 0,
                "License From" => '',
                "License To" => '',
                "Duration" => 0,
                "Rental Agreement" => 0,
                "Applying For OD Media Type" => 0,
                "Media Display size" => '',
                "Illumination" => 0,
                "GST No_" => $request->GST_No ?? '',
                "TIN_TAN_VAT No_" => $request->TIN_TAN_VAT_No ?? '',
                "Other Relevant Information" => $request->Other_Relevant_Information ?? '',
                "DD No_" => '',
                "DD Date" => '',
                "DD Bank Name" => '',
                "DD Bank Branch Name" => '',
                "Application Amount" => 0,
                "PM Agency Name" => $request->PM_Agency_Name ?? '',
                "PAN" => '',
                "Bank Name" => '',
                "Bank Branch" => '',
                "IFSC Code" => '',
                "Account No_" => '',
                "Notarized Copy File Name" => '',
                "PAN File Name" => $data['Attach_Copy_Of_Pan_Number_File_Name'],
                "Affidavit File Name" => '',
                "Photo File Name" => '',
                "Legal Doc File Name" => $data['Legal_Doc_File_Name'],
                "GST File Name" => $data['GST_File_Name'],
                "Balance Sheet File Name" => '',
                "Notarized Copy Of Agreement" => 0,
                "PAN Attached" => $data['Attach_Copy_Of_Pan_Number'],
                "Affidavit Of Oath" => 0,
                "Photographs" => 0,
                "Company Legal Documents" => $data['Company_Legal_Documents'],
                "GST Registration" => $data['GST_Registration'],
                "CA Certified Balance Sheet" => 0,
                "Self-declaration" => 0,
                "User Id" => $userid,
                "Status" => 0,
                "Global Dimension 1 Code" => 'M003',
                "Global Dimension 2 Code" => '',
                "Sender ID" => '',
                "Receiver ID" => $receiverID,
                "Recommended To Committee" => 0,
                "Modification" => 0,
                "Media Sub Category" => '',
                "Rate" => 0,
                "Rate Status" => 0,
                "Rate Remark" => '',
                "Rate Status Date" => '',
                "Agr File Path" => '',
                "Agr File Name" => '',
                "Allocated Vendor Code" => '',
                "Document Date" => date('Y-m-d'),
                "Empanelment Category" => 0,
                "From Date" => '',
                "To Date" => '',
                "File Name" => '',
                "File Uploaded" => 0,
                "Application Type" => 0,
                "Cancelled Cheque File Name" => '',
                "Analysis" => '',
                "Recommendation Rate Committee" => ''
            ];

            $sql = DB::table($this->tableVendorEmpODMedia)->insert($vendordata);

            $ownerId = DB::table($this->tableOwner)->select('Owner ID')->where('User ID', $userid)->first();
            $owner_id = $ownerId->{'Owner ID'};
            $detail = DB::table($this->tableODMediaOwnerDetail)->insert([
                "OD Media Type" => 0,
                "OD Media ID" => $odmedia_id,
                "Owner ID" => $owner_id,
                "Allocated Vendor Code" => ''
            ]);
        } else {
            $data = $this->companyDocData($request, $request->odmedia_id);
            $vendordata = array(
                "GST No_" => $request->GST_No ?? '',
                "PM Agency Name" => $request->PM_Agency_Name ?? '',
                "TIN_TAN_VAT No_" => $request->TIN_TAN_VAT_No ?? '',
                "Other Relevant Information" => $request->Other_Relevant_Information ?? '',
                "HO Address" => $request->HO_Address ?? '',
                "HO Landline No_" => $request->HO_Landline_No ?? '',
                "HO E-Mail" => $request->HO_Email ?? '',
                "HO Mobile No_" => $request->HO_Mobile_No ?? '',
                "Legal Doc File Name" => $data['Legal_Doc_File_Name'],
                "PAN File Name" => $data['Attach_Copy_Of_Pan_Number_File_Name'],
                "GST File Name" => $data['GST_File_Name'],
                "Company Legal Documents" => $data['Company_Legal_Documents'],
                "PAN Attached" => $data['Attach_Copy_Of_Pan_Number'],
                "GST Registration" => $data['GST_Registration'],
            );
            $where = array('User ID' => $userid);
            $sql = DB::table($this->tableVendorEmpODMedia)->where($where)->update($vendordata);
        }
        if ($sql) {
            Session::put('ODGSTID', $request->GST_No);
            Session::put('CompanyName', $request->PM_Agency_Name);
            return true;
        } else {
            return false;
        }
    }

    public function outdoorMediaEmpSave(Request $request)
    {
        $odmedia_id = $request->EMP_OD_Media_ID;
        $user_id = Session::get('UserID');
        $data_doc = $this->outdoorEmpDocData($request, $odmedia_id);
        $vendor_where = array(
            "User ID" => $user_id,
            "OD Media ID" => $odmedia_id ?? '',
            "OD Category" => 0,
            "Modification" => 0
        );
        $vendor_array = array(
            "Authority Which granted Media" => $request->Authority_Which_granted_Media ?? '',
            "License From" => $request->License_From ?? '',
            "License To" => $request->License_To ?? '',
            "Contract No_" => $request->Contract_No ?? '',
            "Quantity Of Display" => $request->Quantity_Of_Display ?? '',
            "License Fees" => $request->License_Fee ?? '',
            "Legal Doc File Name" => '', //upload file
            "Affidavit File Name" => $data_doc["Affidavit_File_Name"],  //upload file
            'Affidavit Of Oath' => $data_doc["Affidavit_Of_Oath"],
            "Last License Fee Paid File" => $data_doc["Last_License_Fee_Paid_File"],  //upload file
            'Last License Fee Paid' => $data_doc["Last_License_Fee_Paid"],
            "Rate Offered to BOC File" => $data_doc["Rate_Offered_to_BOC_File"],  //upload file
            'Rate Offered to BOC' => $data_doc["Rate_Offered_to_BOC"],
            "Categorization of Media File" => $data_doc["Categorization_of_Media_File"],  //upload file
            'Categorization of Media' => $data_doc["Categorization_of_Media"],
            "Notarized Copy File Name" => $data_doc["Notarized_Copy_File_Name"],  //upload file
            'Notarized Copy Of Agreement' => $data_doc["Notarized_Copy_Of_Agreement"],

        );
        //When you choose movieing media than modification value set one start
        $movingmedia = implode(",", $request->Applying_For_OD_Media_Type); //convert into string
        $ary = explode(",", $movingmedia); //again convert array
        $total_media = count($ary); //array count

        $str = $movingmedia;
        $length = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str[$i] == '3') {
                $length = $length + 1;
            }
        }

        if ($length == $total_media) {
            $vendor_array["Modification"] = 1;
            //$vendor_array["Document Date"] = date('Y-m-d');
        }

        $sql = DB::table($this->tableVendorEmpODMedia)->where($vendor_where)->update($vendor_array);
        $ownerdata = DB::table($this->tableOwner)->select("Owner ID")->where('User ID', $user_id)->first();
        $ownerid = $ownerdata->{'Owner ID'};

        $odMediaData = DB::table($this->tableODMediaOwnerDetail)->select("OD Media ID")->where([
            "OD Media ID" => $odmedia_id,
            "Owner ID" => $ownerid
        ])->first();

        if (empty($odMediaData)) {
            $sql_1 = DB::table($this->tableODMediaOwnerDetail)->insert([
                "OD Media Type" => 0,
                "OD Media ID" => $odmedia_id,
                "Owner ID" => $ownerid,
                "Allocated Vendor Code" => ''
            ]);
        }
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function outdoorMediaOtherEmpSave(Request $request)
    {
        if ($request->EMP_OD_Media_ID == '') {

            $user_id = Session::get('UserID');

            $destinationPath = public_path() . '/uploads/sole-right-media/';
            $Affidavit_File_Name = '';
            $Affidavit_Of_Oath = 0;
            $current_year = Date('y');
            $current_month = Date('m');

            $odmedia_id = DB::table($this->tableVendorEmpODMedia)->select('OD Media ID')->where('OD Media ID', 'LIKE',  '%' . '-OP' . '%')->orderBy('OD Media ID', 'desc')->first();

            if (empty($odmedia_id)) {
                $odmedia_id = $current_year . $current_month . '-OP0001';
            } else {
                $odmedia_id = $odmedia_id->{"OD Media ID"};
                $odmedia_id++;
            }
            // get doc data
            $data_doc = $this->outdoorEmpDocData($request, $odmedia_id);

            $vendor_where = array("User ID" => $user_id, "OD Category" => 0);
            $responsedata = DB::table($this->tableVendorEmpODMedia)->select("*")->where($vendor_where)->get();

            if (!empty($responsedata)) {
                // unset key
                unset($responsedata[0]->timestamp);
                unset($responsedata[0]->{'OD Media ID'});
                unset($responsedata[0]->{'$systemId'});
                unset($responsedata[0]->{'$systemCreatedAt'});
                unset($responsedata[0]->{'$systemCreatedBy'});
                unset($responsedata[0]->{'$systemModifiedAt'});
                unset($responsedata[0]->{'$systemModifiedBy'});

                $vendor_array = array(
                    "OD Media ID" => $odmedia_id,
                    "Authority Which granted Media" => $request->Authority_Which_granted_Media ?? '',
                    "License From" => $request->License_From ?? '',
                    "License To" => $request->License_To ?? '',
                    "Contract No_" => $request->Contract_No ?? '',
                    "Quantity Of Display" => $request->Quantity_Of_Display ?? '',
                    "License Fees" => $request->License_Fee ?? '',
                    "Modification" => 0,
                    "Document Date" => date('Y-m-d'),
                    "Legal Doc File Name" => '', //upload file
                    "Affidavit File Name" => $data_doc["Affidavit_File_Name"],  //upload file
                    'Affidavit Of Oath' => $data_doc["Affidavit_Of_Oath"],
                    "Last License Fee Paid File" => $data_doc["Last_License_Fee_Paid_File"],  //upload file
                    'Last License Fee Paid' => $data_doc["Last_License_Fee_Paid"],
                    "Rate Offered to BOC File" => $data_doc["Rate_Offered_to_BOC_File"],  //upload file
                    'Rate Offered to BOC' => $data_doc["Rate_Offered_to_BOC"],
                    "Categorization of Media File" => $data_doc["Categorization_of_Media_File"],  //upload file
                    'Categorization of Media' => $data_doc["Categorization_of_Media"],
                    "Notarized Copy File Name" => $data_doc["Notarized_Copy_File_Name"],  //upload file
                    'Notarized Copy Of Agreement' => $data_doc["Notarized_Copy_Of_Agreement"],
                    'Certified Media List File Name' => $data_doc["Certified_Media_List_File_Name"],
                    'Certified Media List' => $data_doc["Certified_Media_List"],
                    "Analysis" => '',
                    "Recommendation Rate Committee" => ''
                );
                foreach ($responsedata[0] as $key => $value) {
                    if (!array_key_exists($key, $vendor_array)) {
                        $vendor_array[$key] = $value;
                    }
                }
                DB::unprepared('SET ANSI_WARNINGS OFF');
                $sql = DB::table($this->tableVendorEmpODMedia)->insert($vendor_array);
                DB::unprepared('SET ANSI_WARNINGS ON');
                if (!$sql) {
                    return false;
                }
                //When you choose movieing media than modification value set one start
                $movingmedia = implode(",", $request->Applying_For_OD_Media_Type); //convert into string
                $ary = explode(",", $movingmedia); //again convert array
                $total_media = count($ary); //array count

                $str = $movingmedia;
                $length = 0;
                for ($i = 0; $i < strlen($str); $i++) {
                    if ($str[$i] == '3') {
                        $length = $length + 1;
                    }
                }

                if ($length == $total_media) {
                    $vendor_data["Modification"] = 1;
                   // $vendor_data["Document Date"] = date('Y-m-d');
                    $vendor_where = array("User ID" => $user_id, "OD Category" => 0, "OD Media ID" => $odmedia_id);
                    $sql = DB::table($this->tableVendorEmpODMedia)->where($vendor_where)->update($vendor_data);
                    if (!$sql) {
                        return false;
                    }
                }

                $ownerdata = DB::table($this->tableOwner)->select("Owner ID")->where('User ID', $user_id)->first();
                $ownerid = $ownerdata->{'Owner ID'};

                $odMediaData = DB::table($this->tableODMediaOwnerDetail)->select("OD Media ID")->where([
                    "OD Media ID" => $odmedia_id,
                    "Owner ID" => $ownerid
                ])->first();

                if (empty($odMediaData)) {
                    $sql = DB::table($this->tableODMediaOwnerDetail)->insert([
                        "OD Media Type" => 0,
                        "OD Media ID" => $odmedia_id,
                        "Owner ID" => $ownerid,
                        "Allocated Vendor Code" => ''
                    ]);
                    if (!$sql) {
                        return false;
                    }
                }
                if ($sql) {
                    Session::put('EMP_OD_Media_ID', $odmedia_id);
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return  $this->outdoorMediaEmpSave($request);
        }
    }

    public function outdoorMediaRenewalSave(Request $request)
    {
        $user_id = Session::get('UserID');
        $odmediaid = $request->EMP_OD_Media_ID;
        $destinationPath = public_path() . '/uploads/sole-right-media/';

        $mod = DB::table($this->tableVendorEmpODMedia)->select('Legal Doc File Name', 'Affidavit File Name', 'PM Agency Name')->where(["User ID" => $user_id, "OD Category" => 0, "OD Media ID" => $odmediaid])->first();

        $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
        if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
            $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
            $Legal_Doc_File_Name = time() . '-' . $odmediaid . 'LegalDocFile';
            $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
            if ($file_uploaded) {
                $Company_Legal_Documents = 1;
            } else {
                $Legal_Doc_File_Name = '';
            }
        }

        $Affidavit_File_Name = $mod->{'Affidavit File Name'} ?? '';
        if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
            $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
            $Affidavit_File_Name = time() . '-' . $odmediaid . 'AffidavitDocFile';
            $file_uploaded = $file->move($destinationPath, $Affidavit_File_Name);
            if ($file_uploaded) {
                $Affidavit_Of_Oath = 1;
            } else {
                $Affidavit_File_Name = '';
            }
        }

        $line_no = DB::table($this->tableODVendorRenewal)->select('Line No_')->where('OD Media ID', $odmediaid)->orderBy('Line No_', 'desc')->first();
        if (empty($line_no)) {
            $line_no = 10000;
        } else {
            $line_no = $line_no->{"Line No_"};
            $line_no = $line_no + 10000;
        }

        $receiverID = $this->getReceiverID();
        $vendor_renewal = array(
            "OD Media ID" => $odmediaid,
            "Line No_" => $line_no,
            "PM Agency Name" => $mod->{'PM Agency Name'},
            "OD Category" => 0,
            "HO Address" => '',
            "HO Landline No_" => '',
            "HO Fax No_" => '',
            "HO E-Mail" => '',
            "HO Mobile No_" => '',
            "BO Address" => '',
            "BO Landline No_" => '',
            "BO Fax No_" => '',
            "BO E-Mail" => '',
            "BO Mobile No_" => '',
            "DO Address" => '',
            "DO Landline No_" => '',
            "DO Fax No_" => '',
            "DO E-Mail" => '',
            "DO Mobile No_" => '',
            "Legal Status of Company" => 0,
            "Other Relevant Information" => '',
            "Authority Which granted Media" => $request->Authority_Which_granted_Media,
            "Amount paid to Authority" => 0,
            "License From" => $request->License_From,
            "License To" => $request->License_To,
            "Media Type" => 0,
            "Rental Agreement" => 0,
            "Applying For OD Media Type" => 0,
            "Media Display size" => '',
            "Illumination" => 0,
            "GST No_" => '',
            "TIN_TAN_VAT No_" => '',
            "DD Date" => '',
            "DD No_" => '',
            "DD Bank Name" => '',
            "DD Bank Branch Name" => '',
            "Application Amount" => 0,
            "PAN" => '',
            "Bank Name" => '',
            "Bank Branch" => '',
            "IFSC Code" => '',
            "Account No_" => '',
            "Company Legal Documents" => 1,
            "Notarized Copy Of Agreement" => 0,
            "Photographs" => 0,
            "Affidavit Of Oath" => 1,
            "GST Registration" => 0,
            "CA Certified Balance Sheet" => 0,
            "Self-declaration" => 0,
            "Legal Doc File Name" => $Legal_Doc_File_Name ?? '',
            "Notarized Copy File Name" => '',
            "Photo File Name" => '',
            "Affidavit File Name" => $Affidavit_File_Name ?? '',
            "GST File Name" => '',
            "Balance Sheet File Name" => '',
            "Authorized Rep Name" => '',
            "AR Address" => '',
            "AR Landline No_" => '',
            "AR FAX No_" => '',
            "AR Mobile No_" => '',
            "AR E-mail" => '',
            "Contract No_" => $request->Contract_No,
            "Quantity Of Display" => $request->Quantity_Of_Display ?? '',
            "License Fees" => $request->License_Fee,
            "PAN Attached" => 0,
            "PAN File Name" => '',
            "User ID" => $user_id,
            "Status" => 0,
            "Global Dimension 1 Code" => '',
            "Global Dimension 2 Code" => '',
            "Sender ID" => '',
            "Receiver ID" => $receiverID,
            "Recommended To Committee" => 0,
            "Modification" => 1,
            "Media Sub Category" => '',
            "Rate" => 0,
            "Rate Status" => 0,
            "Rate Remark" => '',
            "Rate Status Date" => '',
            "Agr File Path" => '',
            "Agr File Name" => '',
            "Allocated Vendor Code" => '',
            "Document Date" => date('Y-m-d'),
            "Agreement Start Date" => '',
            "Agreement End Date" => '',
            "Empanelment Category" => 0,
            "Duration" => ''
        );

        $sql = DB::table($this->tableODVendorRenewal)->insert($vendor_renewal);
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function branchOfficesSave(Request $request)
    {

        foreach ($request->BO_state as $key => $value) {

            $resData = $this->BranchOfficeData($request, $key);

            if (array_key_exists($key, $request->br_line_no)  && $request->br_line_no[$key] != '') {
                $where = array("Line No_" => $request->br_line_no[$key], 'User ID' => Session::get('UserID'), "OD Media Type" => 0);
                $sql = DB::table($this->tableODBranchOffices)->where($where)->update($resData);
            } else {

                $line_no = DB::table($this->tableODBranchOffices)->select("Line No_")->where(['User ID' => Session::get('UserID'), "OD Media Type" => 0])->orderBy("Line No_", "desc")->first();

                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }
                $odmediaId = DB::table($this->tableVendorEmpODMedia)->select('OD Media ID')->where(['User ID' => Session::get('UserID'), "OD Category" => 0])->first();

                $odmedia_id = $odmediaId->{'OD Media ID'};
                $resData["OD Media ID"] = $odmedia_id;
                $resData["Line No_"] = $line_no;
                $sql = DB::table($this->tableODBranchOffices)->insert($resData);
            }
        }
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function authorizedSave(Request $request)
    {
        foreach ($request->Authorized_Rep_Name as $key => $value) {

            $resData = $this->authorizedData($request, $key);

            if (array_key_exists($key, $request->auth_line_no)  && $request->auth_line_no[$key] != '') {

                $where = array("Line No_" => $request->auth_line_no[$key], 'User ID' => Session::get('UserID'), "OD Media Type" => 0);
                $sql = DB::table($this->tableODAuthRepresentative)->where($where)->update($resData);
            } else {

                $line_no = DB::table($this->tableODAuthRepresentative)->select("Line No_")->where(['User ID' => Session::get('UserID'), "OD Media Type" => 0])->orderBy("Line No_", "desc")->first();

                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }
                $odmediaId = DB::table($this->tableVendorEmpODMedia)->select('OD Media ID')->where(['User ID' => Session::get('UserID'), "OD Category" => 0])->first();

                $odmedia_id = $odmediaId->{'OD Media ID'};
                $resData["OD Media ID"] = $odmedia_id;
                $resData["Line No_"] = $line_no;
                $sql = DB::table($this->tableODAuthRepresentative)->insert($resData);
            }
        }
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }
    public function mediaAddressSave(Request $request)
    {
        $userid = Session::get('UserID');
        $odmedia_id = $request->EMP_OD_Media_ID;
        foreach ($request->Applying_For_OD_Media_Type as $key => $value) {
            $resData = $this->mediaAddressData($request, $key);

            $datamedia = DB::table($this->tableSoleMediasAddress)->select("Line No_ as line_no_")->where(["Sole Media ID" => $odmedia_id, "OD Media Type" => $request->Applying_For_OD_Media_Type[$key], "OD Media ID" => $request->od_media_type[$key]])->first();

            if (!empty($datamedia) && $datamedia->line_no_ != '') {

                $sql = DB::table($this->tableSoleMediasAddress)->where(["Sole Media ID" => $odmedia_id, "Line No_" => $datamedia->line_no_])->update($resData);
            } else {
                $line_no = DB::table($this->tableSoleMediasAddress)->select("Line No_")->where("Sole Media ID", $odmedia_id)->orderBy("Line No_", "desc")->first();
                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }
                $resData["Sole Media ID"] = $odmedia_id;
                $resData["Line No_"] = $line_no;
                $sql = DB::table($this->tableSoleMediasAddress)->insert($resData);

                // add lat long data
                $asset_id_arr = array();
                $select = array(
                    'Location Name as location_name',
                    'OD Asset ID as od_asset_id',
                    'Length',
                    'Width',
                    'Illumination Type as Illumination_Type',
                    'Lit Type as Lit_Type',
                    'Train Number as Train_Number',
                    'Train Name as Train_Name',
                    'Commercial Rate as Commercial_Rate',
                    'OD Media Type as media_cat',
                    'OD Media UID as media_subcat',
                    'Categorization'
                );
                $latlongData = DB::table($this->tableODLatlongDetailTemp)->select($select)->whereIn('OD Asset ID', explode(',',$request->OD_media_asset_ID[$key]))->get();
                $sql1 = '';
                if (!empty($latlongData)) {
                    foreach ($latlongData as $key => $data) {
                        $resData = $this->addLocationData($data);
                        $assetID = DB::table($this->tableODLatlongDetail)->select('OD Asset ID as asset_id')->orderBy('OD Asset ID', 'desc')->first();
                        $asset_ID = !empty($assetID) ? $assetID->asset_id + 1 : 1;
                        array_push($asset_id_arr, $asset_ID);
                        $resData["OD Vendor ID"] = $odmedia_id;
                        $resData["OD Asset ID"] = $asset_ID;
                        $resData["User ID"] = $userid;
                        $sql1 = DB::table($this->tableODLatlongDetail)->insert($resData);
                    }
                }
            }
        }
        if ($sql1) {
            $sql = DB::table($this->tableODLatlongDetailTemp)->where("User ID", $userid)->delete();
        }
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }


    public function detailsWorkDoneSave(Request $request, $data)
    {

        $odmedia_id = $request->EMP_OD_Media_ID;

        $line_no = DB::table($this->tableODMediaWorkDone)->select("Line No_")->where("OD Media ID", $odmedia_id)->orderBy("Line No_", "desc")->first();

        if (empty($line_no)) {
            $line_no = 10000;
        } else {
            $line_no = $line_no->{"Line No_"};
            $line_no = $line_no + 10000;
        }

        $data["OD Media ID"] = $odmedia_id;
        $data["Line No_"] = $line_no;

        $sql = DB::table($this->tableODMediaWorkDone)->insert($data);
        if ($sql) {
            return true;
        } else {
            return false;
        }

        // $resData = $this->detailsWorkDoneData($request, $key);
        // if (array_key_exists($key, $request->line_no)  && $request->line_no[$key] != '') {
        //     $sql = DB::table($this->tableODMediaWorkDone)->where(["OD Media ID" => $odmedia_id, "Line No_" => $request->line_no[$key]])->update($resData);
        // } else {

        //     $line_no = DB::table($this->tableODMediaWorkDone)->select("Line No_")->where("OD Media ID", $odmedia_id)->orderBy("Line No_", "desc")->first();

        //     if (empty($line_no)) {
        //         $line_no = 10000;
        //     } else {
        //         $line_no = $line_no->{"Line No_"};
        //         $line_no = $line_no + 10000;
        //     }

        //     $resData["OD Media ID"] = $odmedia_id;
        //     $resData["Line No_"] = $line_no;

        //     $sql = DB::table($this->tableODMediaWorkDone)->insert($resData);
        // }


    }

    public function updateAgencyData(Request $request)
    {
        $userid = Session::get('UserID');
        $agencydata = array(
            "GST No_" => $request->GST_No ?? '',
            "TIN_TAN_VAT No_" => $request->TIN_TAN_VAT_No ?? '',
            "Other Relevant Information" => $request->Other_Relevant_Information ?? '',
            "HO Address" => $request->HO_Address ?? '',
            "HO Landline No_" => $request->HO_Landline_No ?? '',
            "HO E-Mail" => $request->HO_Email ?? '',
            "HO Mobile No_" => $request->HO_Mobile_No ?? ''
        );
        $agency_code = DB::table($this->tableODAgency)->select("Agency Code")->where("Agency Code", $userid)->first();

        if (!empty($agency_code)) {
            $sql = DB::table($this->tableODAgency)->where("Agency Code", $userid)->update($agencydata);
            if ($sql) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function accountDetailSave(Request $request)
    {
        $destinationPath = public_path() . '/uploads/sole-right-media/';
        $userid = Session::get('UserID');
        $mod = DB::table($this->tableVendorEmpODMedia)->select('OD Media ID', 'Cancelled Cheque File Name')->where('User ID', $userid)->first();

        $cancelled_cheque_file = $mod->{'Cancelled Cheque File Name'} ?? '';
        if ($request->hasFile('cancelled_cheque_file') || $request->hasFile('cancelled_cheque_file_modify')) {
            $file = $request->file('cancelled_cheque_file') ?? $request->file('cancelled_cheque_file_modify');
            $cancelled_cheque_file = time() . '-' . $mod->{'OD Media ID'} . '-CancelChequeDocFile';
            $file_uploaded = $file->move($destinationPath, $cancelled_cheque_file);
            if ($file_uploaded) {
                $Attach_Copy_Of_Pan_Number = 1;
            } else {
                $cancelled_cheque_file = '';
            }
        }

        $update = array(
            'PAN' => $request->pan_card,
            'Bank Name' => $request->Bank_Name,
            'Bank Branch' => $request->Bank_Branch,
            'IFSC Code' => $request->ifsc_code,
            'Account No_' => $request->Account_No,
            'Cancelled Cheque File Name' => $cancelled_cheque_file
        );
        $sql = DB::table($this->tableVendorEmpODMedia)->where(['User ID' => $userid])->update($update);

        $agency_code = DB::table($this->tableODAgency)->select("Agency Code")->where("Agency Code", $userid)->first();

        if (!empty($agency_code)) {
            $sql = DB::table($this->tableODAgency)->where("Agency Code", $userid)->update($update);
        }

        if ($sql) {
            Session::put('IFSCCODE', $request->ifsc_code);
            return true;
        } else {
            return false;
        }
    }

    public function locationDetailUpdate(Request $request)
    {
        $userid = Session::get('UserID');
        $asset_id_arr = array();
        if (count($request->location_name) > 0) {
            foreach ($request->location_name as $key => $value) {

                $resData = $this->locationData($request, $key);

                if (($request->od_asset_id[$key] != null || $request->od_asset_id[$key] != '')  && ($request->od_vendor_id[$key] != null || $request->od_vendor_id[$key] != '')) {

                    $where = array('OD Asset ID' => $request->od_asset_id[$key], 'User ID' => $userid, 'OD Vendor ID' => $request->od_vendor_id[$key]);

                    $sql = DB::table($this->tableODLatlongDetail)
                        ->where($where)
                        ->update($resData);
                } else {
                    $odmediaid = $request->EMP_OD_Media_ID;

                    $where = array('Sole Media ID' => $odmediaid, 'OD Media Type' => $request->media_cat, 'OD Media ID' => $request->media_subcat);

                    $data = DB::table($this->tableSoleMediasAddress)->select("Quantity")->where($where)->first();
                    if (!empty($data)) {
                        DB::table($this->tableSoleMediasAddress)->where($where)->increment('Quantity', 1);
                    } else {
                        $cat_data = DB::table($this->tableSoleMediasAddress)->select("OD Media Type as od_media_type")->where('Sole Media ID', $odmediaid)->first();

                        if (@$cat_data->od_media_type != $request->media_cat) {

                            $sql = DB::table($this->tableSoleMediasAddress)->where('Sole Media ID', $odmediaid)->delete();

                            $sql = DB::table($this->tableODLatlongDetail)->where('OD Vendor ID', $odmediaid)->delete();
                        }

                        $line_no = DB::table($this->tableSoleMediasAddress)->select("Line No_")->where('Sole Media ID', $odmediaid)->orderBy("Line No_", "desc")->first();
                        if (empty($line_no)) {
                            $line_no = 10000;
                        } else {
                            $line_no = $line_no->{"Line No_"};
                            $line_no = $line_no + 10000;
                        }

                        $indexkey = substr($line_no, 0, 1) - 1;
                        $resData1 = $this->mediaAddressData($request, $indexkey);
                        $resData1["Sole Media ID"] = $odmediaid;
                        $resData1["Line No_"] = $line_no;
                        unset($resData1['Quantity']);
                        $resData1["Quantity"] = 1;
                        $sql = DB::table($this->tableSoleMediasAddress)->insert($resData1);
                    }

                    $assetID = DB::table($this->tableODLatlongDetail)->select('OD Asset ID as asset_id')->orderBy('OD Asset ID', 'desc')->first();
                    $asset_ID = !empty($assetID) ? $assetID->asset_id + 1 : 1;
                    array_push($asset_id_arr, $asset_ID);
                    $resData["OD Vendor ID"] = $odmediaid;
                    $resData["OD Asset ID"] = $asset_ID;
                    $resData["User ID"] = $userid;
                    $sql = DB::table($this->tableODLatlongDetail)->insert($resData);
                }
            }
        }
        if ($sql) {
            return $this->sendResponse($asset_id_arr, 'Data save successfully.');
        } else {
            return $this->sendResponse('', 'Fail not save.');
        }
    }

    public function locationDetailSave(Request $request)
    {

        $userid = Session::get('UserID');
        $asset_id_arr = array();
        if (count($request->location_name) > 0) {
            foreach ($request->location_name as $key => $value) {

                $resData = $this->locationData($request, $key);
                $assetID = DB::table($this->tableODLatlongDetailTemp)->select('OD Asset ID as asset_id')->orderBy('OD Asset ID', 'desc')->first();
                $asset_ID = !empty($assetID) ? $assetID->asset_id + 1 : 1;
                array_push($asset_id_arr, $asset_ID);
                $resData["OD Vendor ID"] = '';
                $resData["OD Asset ID"] = $asset_ID;
                $resData["User ID"] = $userid;
                $resData['$systemId'] = '5B8BFD30-BDE8-EC11-985B-00155D149E01';
                $resData['$systemCreatedAt'] = '';
                $resData['$systemCreatedBy'] = '00000000-0000-0000-0000-000000000000';
                $resData['$systemModifiedAt'] = '';
                $resData['$systemModifiedBy'] = '00000000-0000-0000-0000-000000000000';
                $sql = DB::table($this->tableODLatlongDetailTemp)->insert($resData);
            }
        }
        if ($sql) {
            return $this->sendResponse($asset_id_arr, 'Data save successfully.');
        } else {
            return $this->sendResponse('', 'Fail not save.');
        }
    }
    //////////////////////// end outdoor media save data /////////////////
    //////////////////////// start outdoor media return data array /////////////////

    public function companyDocData(Request $request, $od_media_id)
    {
        $userid = Session::get('UserID');
        $destinationPath = public_path() . '/uploads/sole-right-media/';

        $where = array('User ID' => $userid);
        $mod = DB::table($this->tableVendorEmpODMedia)->select('Legal Doc File Name', 'Company Legal Documents', 'PAN File Name', 'PAN Attached', 'GST File Name', 'GST Registration')->where($where)->first();

        $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
        $Company_Legal_Documents = $mod->{'Company Legal Documents'} ?? 0;
        if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
            $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
            $Legal_Doc_File_Name = time() . '-' . $od_media_id . '-LegalDocFile';
            $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
            if ($file_uploaded) {
                $Company_Legal_Documents = 1;
            } else {
                $Legal_Doc_File_Name = '';
            }
        }

        $Attach_Copy_Of_Pan_Number_File_Name = $mod->{'PAN File Name'} ?? '';
        $Attach_Copy_Of_Pan_Number = $mod->{'PAN Attached'} ?? '';
        if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name') || $request->hasFile('Attach_Copy_Of_Pan_Number_File_Name_modify')) {
            $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name') ?? $request->file('Attach_Copy_Of_Pan_Number_File_Name_modify');
            $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $od_media_id . '-PANDocFile';
            $file_uploaded = $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
            if ($file_uploaded) {
                $Attach_Copy_Of_Pan_Number = 1;
            } else {
                $Attach_Copy_Of_Pan_Number_File_Name = '';
            }
        }

        $GST_File_Name = $mod->{'GST File Name'} ?? '';
        $GST_Registration = $mod->{'GST Registration'} ?? 0;
        if ($request->hasFile('GST_File_Name') || $request->hasFile('GST_File_Name_modify')) {
            $file = $request->file('GST_File_Name') ?? $request->file('GST_File_Name_modify');
            $GST_File_Name = time() . '-' . $od_media_id . '-GSTDocFile';
            $file_uploaded = $file->move($destinationPath, $GST_File_Name);
            if ($file_uploaded) {
                $GST_Registration = 1;
            } else {
                $GST_File_Name = '';
            }
        }
        return array(
            "Legal_Doc_File_Name" => $Legal_Doc_File_Name,
            "Company_Legal_Documents" => $Company_Legal_Documents,
            "Attach_Copy_Of_Pan_Number_File_Name" => $Attach_Copy_Of_Pan_Number_File_Name,
            "Attach_Copy_Of_Pan_Number" => $Attach_Copy_Of_Pan_Number,
            "GST_File_Name" => $GST_File_Name,
            "GST_Registration" => $GST_Registration
        );
    }
    public function outdoorEmpDocData(Request $request, $odmedia_id = '')
    {
        $user_id = Session::get('UserID');
        $destinationPath = public_path() . '/uploads/sole-right-media/';

        $vendor_where = array(
            "User ID" => $user_id,
            "OD Media ID" => $odmedia_id ?? '',
            "OD Category" => 0,
            "Modification" => 0
        );

        $select = array(
            "Affidavit File Name",
            "Affidavit Of Oath",
            "Last License Fee Paid",
            "Rate Offered to BOC",
            "Categorization of Media",
            "Last License Fee Paid File",
            "Rate Offered to BOC File",
            "Categorization of Media File",
            "Notarized Copy File Name",
            "Notarized Copy Of Agreement",
            "Certified Media List File Name",
            "Certified Media List"
        );
        $responsedata = DB::table($this->tableVendorEmpODMedia)->select($select)->where($vendor_where)->first();

        $Affidavit_File_Name = @$responsedata->{'Affidavit File Name'} ?? '';
        $Affidavit_Of_Oath = @$responsedata->{'Affidavit Of Oath'} ?? 0;

        if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
            $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
            $Affidavit_File_Name = time() . '-' . $odmedia_id . '-AffidavitDocFile';
            $file_uploaded = $file->move($destinationPath, $Affidavit_File_Name);
            if ($file_uploaded) {
                $Affidavit_Of_Oath = 1;
            } else {
                $Affidavit_File_Name = '';
            }
        }

        $Last_License_Fee_Paid_File = @$responsedata->{'Last License Fee Paid File'} ?? '';
        $Last_License_Fee_Paid = @$responsedata->{'Last License Fee Paid'} ?? 0;

        if ($request->hasFile('Last_License_Fee_Paid') || $request->hasFile('Last_License_Fee_Paid_modify')) {
            $file = $request->file('Last_License_Fee_Paid') ?? $request->file('Last_License_Fee_Paid_modify');
            $Last_License_Fee_Paid_File = time() . '-' . $odmedia_id . '-LicenseFeeDocFile';
            $file_uploaded = $file->move($destinationPath, $Last_License_Fee_Paid_File);
            if ($file_uploaded) {
                $Last_License_Fee_Paid = 1;
            } else {
                $Last_License_Fee_Paid_File = '';
            }
        }

        $Rate_Offered_to_BOC_File = @$responsedata->{'Rate Offered to BOC File'} ?? '';
        $Rate_Offered_to_BOC = @$responsedata->{'Rate Offered to BOC'} ?? 0;

        if ($request->hasFile('Rate_Offered_to_BOC') || $request->hasFile('Rate_Offered_to_BOC_modify')) {
            $file = $request->file('Rate_Offered_to_BOC') ?? $request->file('Rate_Offered_to_BOC_modify');
            $Rate_Offered_to_BOC_File = time() . '-' . $odmedia_id . '-RateOfferedDocFile';
            $file_uploaded = $file->move($destinationPath, $Rate_Offered_to_BOC_File);
            if ($file_uploaded) {
                $Rate_Offered_to_BOC = 1;
            } else {
                $Rate_Offered_to_BOC_File = '';
            }
        }

        $Categorization_of_Media_File = @$responsedata->{'Categorization of Media File'} ?? '';
        $Categorization_of_Media = @$responsedata->{'Categorization of Media'} ?? 0;

        if ($request->hasFile('Categorization_of_Media') || $request->hasFile('Categorization_of_Media_modify')) {
            $file = $request->file('Categorization_of_Media') ?? $request->file('Categorization_of_Media_modify');
            $Categorization_of_Media_File = time() . '-' . $odmedia_id . '-CategorizationDocFile';
            $file_uploaded = $file->move($destinationPath, $Categorization_of_Media_File);
            if ($file_uploaded) {
                $Categorization_of_Media = 1;
            } else {
                $Categorization_of_Media_File = '';
            }
        }
        
        $Notarized_Copy_File_Name = @$responsedata->{'Notarized Copy File Name'} ?? '';
        $Notarized_Copy_Of_Agreement = @$responsedata->{'Notarized Copy Of Agreement'} ?? 0;

        if ($request->hasFile('Notarized_Copy_File_Name') || $request->hasFile('Notarized_Copy_File_Name_modify')) {
            $file = $request->file('Notarized_Copy_File_Name') ?? $request->file('Notarized_Copy_File_Name_modify');
            $Notarized_Copy_File_Name = time() . '-' . $odmedia_id . '-NotarizedDocFile';
            $file_uploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
            if ($file_uploaded) {
                $Notarized_Copy_Of_Agreement = 1;
            } else {
                $Notarized_Copy_File_Name = '';
            }
        }
        $Certified_Media_List_File_Name = @$responsedata->{'Certified Media List File Name'} ?? '';
        $Certified_Media_List = @$responsedata->{'Certified Media List'} ?? 0;

        if ($request->hasFile('Certified_Media_List_File_Name') || $request->hasFile('Certified_Media_List_File_Name_modify')) {
            $file = $request->file('Certified_Media_List_File_Name') ?? $request->file('Certified_Media_List_File_Name_modify');
            $Certified_Media_List_File_Name = time() . '-' . $odmedia_id . '-CertifiedDocFile';
            $file_uploaded = $file->move($destinationPath, $Certified_Media_List_File_Name);
            if ($file_uploaded) {
                $Certified_Media_List = 1;
            } else {
                $Certified_Media_List_File_Name = '';
            }
        }
        return array(
            "Affidavit_File_Name" => $Affidavit_File_Name,
            "Affidavit_Of_Oath" => $Affidavit_Of_Oath,
            "Last_License_Fee_Paid_File" => $Last_License_Fee_Paid_File,
            "Last_License_Fee_Paid" => $Last_License_Fee_Paid,
            "Rate_Offered_to_BOC_File" => $Rate_Offered_to_BOC_File,
            "Rate_Offered_to_BOC" => $Rate_Offered_to_BOC,
            "Categorization_of_Media_File" => $Categorization_of_Media_File,
            "Categorization_of_Media" => $Categorization_of_Media,
            "Notarized_Copy_File_Name" => $Notarized_Copy_File_Name,
            "Notarized_Copy_Of_Agreement" => $Notarized_Copy_Of_Agreement,
            "Certified_Media_List_File_Name" => $Certified_Media_List_File_Name,
            "Certified_Media_List" => $Certified_Media_List
        );
    }
    public function mediaAddressData(Request $request, $key)
    {
        $trainData = isset($request->Train_Data[$key]) ? explode("-", $request->Train_Data[$key]) : '';
        $Train_No = isset($request->Train_Data[$key]) ? trim($trainData[0]) : 0;
        $Train_Name = isset($request->Train_Data[$key]) ? trim($trainData[1]) : 0;

        return array(
            "OD Media Type" => $request->Applying_For_OD_Media_Type[$key] ?? 0,
            "City" => $request->MA_City[$key] ?? '',
            "State" => $request->MA_State[0] ?? '',
            "District" => $request->MA_District[$key] ?? '',
            "Zone" => 0,
            "Latitude" => 0,
            "Longitde" => 0,
            "Landmark" => 0,
            "Image File Name" => '',
            "OD Media ID" => $request->od_media_type[$key] ?? 0,
            "Display Size" => 0,
            "Illumination Type" => $request->Illumination_media[$key] ?? 0,
            "Availability Start Date" => '',
            "Availability End Date" => '',
            "Length" => 0,
            "Width" => 0,
            "Total Area" => 0,
            "Rental" => 0,
            "Rental Type" => 0,
            "Quantity" => $request->quantity[$key] ?? 0,
            "Train Number" => $Train_No,
            "Train Name" => $Train_Name,
            "Size Type" => $request->Size_Type[$key] ?? 0,
            "Duration" => 0,
            "No Of Spot" => $request->No_of_Spots[$key] ?? 0,
            "Lit Type" => $request->lit_type[$key] ?? 0
        );
    }

    public function detailsWorkDoneData(Request $request, $key)
    {
        return  array(
            "OD Media Type" => 0,
            "Work Name" => $request->Work_Name[$key] ?? '',
            "Year" => $request->ODMFO_Year[$key] ?? '',
            "Qty Of Display_Duration" => $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] ?? 0,
            "Billing Amount" => $request->ODMFO_Billing_Amount[$key] ?? 0,
            "Allocated Vendor Code" => '',
            "From Date" => $request->from_date[$key] ?? '',
            "To Date" =>  $request->to_date[$key] ?? ''
        );
    }

    public function branchOfficeData(Request $request, $key)
    {
        return  array(
            "OD Media Type" => 0,
            "State" => $request->BO_state[$key] ?? '',
            "BO Address" => $request->BO_Address[$key] ?? '',
            "BO Landline No_" => $request->BO_Landline_No[$key] ?? '',
            "BO E-mail" => $request->BO_Email[$key] ?? '',
            "BO Mobile No_" => $request->BO_Mobile[$key] ?? '',
            "User ID" => Session::get('UserID')
        );
    }

    public function authorizedData(Request $request, $key)
    {
        return  array(
            "OD Media Type" => 0,
            "AR Name" => $request->Authorized_Rep_Name[$key] ?? '',
            "AR Address" => $request->AR_Address[$key] ?? '',
            "AR Mobile" => $request->AR_Mobile_No[$key] ?? '',
            "AR Phone No_" => $request->AR_Landline_No[$key] ?? '',
            "AR Email" => $request->AR_Email[$key] ?? '',
            "Company Legal Status" => $request->Legal_Status_of_Company[$key] ?? 0,
            "Alternate Mobile No_" => $request->altername_mobile[$key] ?? '',
            "User ID" => Session::get('UserID')
        );
    }

    public function addLocationData($data)
    {
        $Train_No = isset($data->Train_Number) ? trim($data->Train_Number) : 0;
        $Train_Name = isset($data->Train_Name) ? trim($data->Train_Name) : '';
        return  array(
            'Latitude'             => '',
            'Longitude'            => '',
            'Created DateTime'     => '',
            'Image File Name'      => '',
            'Remarks'              => '',
            'OD Media Type'        => $data->media_cat ?? '',
            'Far Image File Name'  => '',
            'City'                 => '',
            'District'             => '',
            'OD Media UID'         => $data->media_subcat ?? '',
            'Near Picture'         => null,
            'Far Picture'          => null,
            'Tag Name'             => '',
            'Rental'               => 0,
            'Rental Type'          => 0,
            'Illumination Type'    => $data->Illumination_Type ?? 0,
            'Length'               => $data->Length ?? 0,
            'Width'                => $data->Width ?? 0,
            'Total Area'           => $data->Length * $data->Width,
            'Size Type'            => 0,
            'Lit Type'             => $data->Lit_Type ?? 0,
            'Location Name'        => $data->location_name ?? '',
            'Commercial Rate'      => $data->Commercial_Rate ?? '',
            'Train Number'         => $Train_No,
            'Train Name'           => $Train_Name,
            'Categorization'      => $data->Categorization ?? '',
        );
    }

    public function locationData(Request $request, $key)
    {
        $trainData = isset($request->Train_Data[$key]) ? explode("-", $request->Train_Data[$key]) : '';
        $Train_No = isset($request->Train_Data[$key]) ? trim($trainData[0]) : 0;
        $Train_Name = isset($request->Train_Data[$key]) ? trim($trainData[1]) : '';
        return  array(
            'Latitude'             => '',
            'Longitude'            => '',
            'Created DateTime'     => '',
            'Image File Name'      => '',
            'Remarks'              => '',
            'OD Media Type'        => $request->media_cat ?? '',
            'Far Image File Name'  => '',
            'City'                 => '',
            'District'             => '',
            'OD Media UID'         => $request->media_subcat ?? '',
            'Near Picture'         => null,
            'Far Picture'          => null,
            'Tag Name'             => '',
            'Rental'               => 0,
            'Rental Type'          => 0,
            'Illumination Type'    => $request->Illumination_media[$key] ?? 0,
            'Length'               => $request->length[$key] ?? 0,
            'Width'                => $request->width[$key] ?? 0,
            'Total Area'           => $request->length[$key] * $request->width[$key],
            'Size Type'            => 0,
            'Lit Type'             => $request->lit_type[$key] ?? 0,
            'Location Name'        => $request->location_name[$key] ?? '',
            'Commercial Rate'      => $request->Commercial_Rate[$key] ?? '',
            'Train Number'         => $Train_No,
            'Train Name'           => $Train_Name,
            'Categorization'      => $request->Categorization[$key] ?? '',
        );
    }
    //////////////////////// end outdoor media return data array /////////////////
    //////////////////////// start get data from database tables ////////////////
    public function getOwnerData()
    {
        $user_id = Session::get('UserID');
        $select = array(
            'Owner ID',
            'Owner Name',
            'Mobile No_',
            'Email ID',
            'Phone No_',
            'Fax No_',
            'Address 1',
            'Address 2',
            'City',
            'District',
            'State'
        );
        $where = array('User ID' => $user_id);
        $OD_owners = RateSettlementPersonalMedia::fetchAllRecords($this->tableOwner, $select, '', '',  $where, '', '');
        return $this->sendResponse($OD_owners, 'Data retrieved successfully.');
    }

    public function getOutdoorMediaData($where)
    {
        $user_id = Session::get('UserID');
        $select = array(
            'OD Category',
            'OD Media ID',
            'PM Agency Name',
            'HO Address',
            'HO Landline No_',
            'HO Fax No_',
            'HO E-Mail',
            'HO Mobile No_',
            // 'BO Address',
            // 'BO Landline No_',
            // 'BO Fax No_',
            // 'BO E-Mail',
            // 'BO Mobile No_',
            'DO Address',
            'DO Landline No_',
            'DO Fax No_',
            'DO E-Mail',
            'DO Mobile No_',
            'Legal Status of Company',
            'Other Relevant Information',
            'Authority Which granted Media',
            'Amount paid to Authority',
            'License From',
            'License To',
            'Duration',
            'Rental Agreement',
            'Applying For OD Media Type',
            'GST No_',
            'TIN_TAN_VAT No_',
            'DD Date',
            'DD No_',
            'DD Bank Name',
            'DD Bank Branch Name',
            'Application Amount',
            'PAN',
            'Bank Name',
            'Bank Branch',
            'IFSC Code',
            'Account No_',
            'Company Legal Documents',
            'Notarized Copy Of Agreement',
            'Photographs',
            'Affidavit Of Oath',
            'GST Registration',
            'CA Certified Balance Sheet',
            'Self-declaration',
            'Legal Doc File Name',
            'Notarized Copy File Name',
            'Photo File Name',
            'Affidavit File Name',
            'GST File Name',
            'Balance Sheet File Name',
            // 'Authorized Rep Name',
            // 'AR Address',
            // 'AR Landline No_',
            // 'AR FAX No_',
            // 'AR Mobile No_',
            // 'AR E-mail',
            'Contract No_',
            'Quantity Of Display',
            'License Fees',
            'Media Display size',
            'Illumination',
            'PAN Attached',
            'PAN File Name',
            'Status',
            'Modification',
            'Rate Status Date',
            'File Name',
            'Document Date',
            'Last License Fee Paid',
            'Rate Offered to BOC',
            'Categorization of Media',
            'Last License Fee Paid File',
            'Rate Offered to BOC File',
            'Categorization of Media File',
            'Notarized Copy File Name',
            'Notarized Copy Of Agreement',
            'Certified Media List',
            'Certified Media List File Name'
        );
        $OD_vendors = RateSettlementPersonalMedia::fetchAllRecords($this->tableVendorEmpODMedia, $select, '', '',  $where, '', '');
        return $this->sendResponse($OD_vendors, 'Data retrieved successfully.');
    }

    public function getMediaAddressData($sole_media_id)
    {
        $select = array(
            'OD Media Type',
            'Sole Media ID',
            'Line No_',
            'City',
            'State',
            'District',
            'Zone',
            'Latitude',
            'Longitde',
            'Landmark',
            'Image File Name',
            'OD Media ID',
            'Display Size',
            'Illumination Type',
            'Availability Start Date',
            'Availability End Date',
            'Length',
            'Width',
            'Total Area',
            'Quantity',
            'Train Number',
            'Train Name',
            'Size Type',
            'Duration',
            'No Of Spot',
            'Lit Type'
        );
        $where = array('Sole Media ID' => $sole_media_id);
        $OD_media_address = RateSettlementPersonalMedia::fetchAllRecords($this->tableSoleMediasAddress, $select, '', '',  $where, '', '');

        return $this->sendResponse($OD_media_address, 'Data retrieved successfully.');
    }

    public function getSubCategoryData($od_media_id = '')
    {
        $user_id = Session::get('UserID');
        $sub_cat = array();
        // $where = array();
        // if ($od_media_id != '') {
        // //     $where = array(
        // //         ["User ID", "=", $user_id],
        // //         ["OD Media ID", "!=", $od_media_id]
        // //     );
        // // } else {
        //     $where = array(
        //         ["Sole Media ID", "=", $od_media_id]
        //     );
        // }

        // $vendor_data = DB::table($this->tableSoleMediasAddress)->select('OD Media ID')->where($where)->get();

        // if (!empty($vendor_data)) {

        //     foreach ($vendor_data as $val) {
        //         $media_res = DB::table($this->tableSoleMediasAddress)->select('OD Media ID')->where(['Sole Media ID' => $val->{'OD Media ID'}])->get();
        //         if (!empty($media_res)) {
        //             foreach ($media_res as $media_data) {
        //                 array_push($sub_cat, $media_data->{'OD Media ID'});
        //             }
        //         }
        //     }
        // }
        if ($od_media_id != '') {
    $media_res = DB::table($this->tableSoleMediasAddress)->select('OD Media ID')->where(['Sole Media ID' => $od_media_id])->get();
    if (!empty($media_res)) {
        foreach ($media_res as $media_data) {
            array_push($sub_cat, $media_data->{'OD Media ID'});
        }
    }
}

// dd($sub_cat);
        return $this->sendResponse($sub_cat, 'Data retrieved successfully.');
    }

    public function getOutdoorMediaAuthorizedData($where)
    {
        $select = array(
            "OD Media ID",
            "Line No_",
            "AR Name",
            "AR Address",
            "AR Mobile",
            "AR Phone No_",
            "AR Email",
            "Company Legal Status",
            "Alternate Mobile No_"
        );
        $OD_authorized = RateSettlementPersonalMedia::fetchAllRecords($this->tableODAuthRepresentative, $select, '', '',  $where, '', '');
        return $this->sendResponse($OD_authorized, 'Data retrieved successfully.');
    }
    public function getOutdoorMediaBranchOfficeData($where)
    {
        $select = array(
            "OD Media ID",
            "Line No_",
            "State",
            "BO Address",
            "BO Landline No_",
            "BO E-mail",
            "BO Mobile No_"
        );
        $OD_branch = RateSettlementPersonalMedia::fetchAllRecords($this->tableODBranchOffices, $select, '', '',  $where, '', '');
        return $this->sendResponse($OD_branch, 'Data retrieved successfully.');
    }

    public function getDetailsWorkDone($od_mediaid)
    {

        $select = array(
            'Client Name',
            'Invoice Number',
            'GST Party 1',
            'GST Party 2',
            'Proof GST Submitted',
            'GST Receipts File Name',
            'GST Invoices File Name',
            'Work Done Status',
            'Non receipt file name',
        );
        $where = array('OD Media Type' => 0, 'OD Media ID' => $od_mediaid);
        $OD_work_dones = RateSettlementPersonalMedia::fetchAllRecords($this->tableODMediaWorkDone, $select, '', '',  $where, '', '');

        // if (empty($OD_work_dones)) {
        //     return $this->sendError('Data not found!.');
        //     exit;
        // }
        return $this->sendResponse($OD_work_dones, 'Data retrieved successfully.');
    }

    public function getLatlongDetails($user_id)
    {
        $select = array(
            'Latitude',
            'Longitude',
            'Image File Name',
            'Remarks',
            'Far Image File Name',
            'City',
            'Location Name'
        );
        $where = array('OD Vendor ID' => $user_id);
        $OD_vendor_details = RateSettlementPersonalMedia::fetchAllRecords($this->tableODLatlongDetail, $select, '', '',  $where, '', '');
        return $this->sendResponse($OD_vendor_details, 'Data retrieved successfully.');
    }

    public function getOutdoorMediaRenewalData($where)
    {
        $select = array(
            'OD Media ID',
            'PM Agency Name',
            'PM Agency Name as agency',
            'Line No_',
            'HO Address',
            'HO Landline No_',
            'HO Fax No_',
            'HO E-Mail',
            'HO Mobile No_',
            'BO Address',
            'BO Landline No_',
            'BO Fax No_',
            'BO E-Mail',
            'BO Mobile No_',
            'DO Address',
            'DO Landline No_',
            'DO Fax No_',
            'DO E-Mail',
            'DO Mobile No_',
            'Legal Status of Company',
            'Other Relevant Information',
            'Authority Which granted Media',
            'Amount paid to Authority',
            'License From',
            'License To',
            'Rental Agreement',
            'Applying For OD Media Type',
            'GST No_',
            'TIN_TAN_VAT No_',
            'DD Date',
            'DD No_',
            'DD Bank Name',
            'DD Bank Branch Name',
            'Application Amount',
            'PAN',
            'Bank Name',
            'Bank Branch',
            'IFSC Code',
            'Account No_',
            'Company Legal Documents',
            'Notarized Copy Of Agreement',
            'Photographs',
            'Affidavit Of Oath',
            'GST Registration',
            'CA Certified Balance Sheet',
            'Self-declaration',
            'Legal Doc File Name',
            'Notarized Copy File Name',
            'Photo File Name',
            'Affidavit File Name',
            'GST File Name',
            'Balance Sheet File Name',
            'Authorized Rep Name',
            'AR Address',
            'AR Landline No_',
            'AR FAX No_',
            'AR Mobile No_',
            'AR E-mail',
            'Contract No_',
            'Quantity Of Display',
            'License Fees',
            'Media Display size',
            'Illumination',
            'PAN Attached',
            'PAN File Name',
            'Status',
            'Modification',
            'Rate Status Date'
        );

        $OD_vendor_renewal = RateSettlementPersonalMedia::fetchAllRecords($this->tableODVendorRenewal, $select, 'Line No_', 'DESC',  $where, '', '');
        return $this->sendResponse($OD_vendor_renewal, 'Data retrieved successfully.');
    }

    public function getReceiverID()
    {
        $get_receiver_code = DB::table($this->tableMediaPlanSetup)->select("OD Vend Landing UID")->first();
        return $get_receiver_code->{"OD Vend Landing UID"};
    }

    public function getMediaList()
    {
        $userid = Session::get('UserID');
        return DB::table($this->tableVendorEmpODMedia . ' as odmedia')
            ->select('odmedia.OD Media ID as media_id', 'odmedia.HO E-Mail as ho_email', 'odmedia.GST No_ as gst', 'odmedia.HO Mobile No_ as mobile', 'odmedia.Modification', 'odmedia.Allocated Vendor Code as vendor_code', 'odmedia.License From as from_date', 'odmedia.License To as to_date', 'odmedia.User ID as user_id', 'odmedia.Modification as Modification', 'odmedia.OD Category as od_category', 'renewal.License From as renewal_license_from', 'renewal.License To as renewal_license_to', 'fee.Status as payment_status')
            ->leftJoin($this->tableODVendorRenewal . ' as renewal', "renewal.OD Media ID", "=", "odmedia.OD Media ID")
            ->leftJoin($this->tableVendorFees . ' as fee', "fee.Media ID", "=", "odmedia.OD Media ID")
            // ->leftJoin($this->tableSoleMediasAddress . ' as sole', 'sole.Sole Media ID', '=', 'odmedia.OD Media ID')
            ->where(["odmedia.User ID" => $userid, "odmedia.OD Category" => 0])
            ->where('odmedia.Notarized Copy File Name', '!=', '')
            ->orderBy('odmedia.OD Media ID', 'desc')
            ->get();
    }
    public function getApprovedMediaList()
    {
        $userid = Session::get('UserID');
        return DB::table($this->tableVendorEmpODMedia . ' as odmedia')
            ->select('odmedia.OD Media ID as media_id', 'odmedia.HO E-Mail as ho_email', 'odmedia.GST No_ as gst', 'odmedia.HO Mobile No_ as mobile', 'odmedia.Modification', 'odmedia.Allocated Vendor Code as vendor_code', 'odmedia.License From as from_date', 'odmedia.License To as to_date', 'odmedia.User ID as user_id', 'odmedia.Modification as Modification', 'odmedia.OD Category as od_category', 'renewal.License From as renewal_license_from', 'renewal.License To as renewal_license_to', 'fee.Status as payment_status')
            ->leftJoin($this->tableODVendorRenewal . ' as renewal', "renewal.OD Media ID", "=", "odmedia.OD Media ID")
            ->leftJoin($this->tableVendorFees . ' as fee', "fee.Media ID", "=", "odmedia.OD Media ID")
            // ->leftJoin($this->tableSoleMediasAddress . ' as sole', 'sole.Sole Media ID', '=', 'odmedia.OD Media ID')
            ->where(["odmedia.User ID" => $userid, "odmedia.Modification" => 1, "odmedia.OD Category" => 0, "odmedia.Status" => 3])
            ->orderBy('odmedia.OD Media ID', 'desc')
            ->get();
    }
    //////////////////////// end get data from database tables ////////////////
}
