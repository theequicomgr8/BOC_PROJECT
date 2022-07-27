<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <style type="text/css">
         /* tr:nth-child(even) {
         background-color: #f2f2f2;
         } */
         table {
         font-size: 13px;
         }
         .row{
          display:table;
          width:100%;
          clear:both;
         }
         .col-md-6{
          float:left;
          width:50%;
          border:1px solid grey;
          height:300px;
         }
         .col-sm-6{
          float:left;
          width:50%;
          /* border:1px solid grey;
          height:300px; */
         }
      </style>
   </head>
   @php
   $results = isset($response) ? $response:'';
   $ASperRO =isset($ROdata) ? $ROdata :'';
   //dd($ASperRO);
   @endphp

   <?php
//convertNumber into words
function convertNumber($number){
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " .
          $words[$point = $point % 10] : '';
  return $result . "Rupees  " . $points."Only";
}

//Convert Indian formats
function moneyFormatIndia($num){
$explrestunits = "" ;
$num = preg_replace('/,+/', '', $num);
$words = explode(".", $num);
$des = "00";
if(count($words)<=2){
    $num=$words[0];
    if(count($words)>=2){$des=$words[1];}
    if(strlen($des)<2){$des="$des";}else{$des=substr($des,0,2);}
}
if(strlen($num)>3){
    $lastthree = substr($num, strlen($num)-3, strlen($num));
    $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
    $expunit = str_split($restunits, 2);
    for($i=0; $i<sizeof($expunit); $i++){
        // creates each of the 2's group and adds a comma to the end
        if($i==0)
        {
            $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
        }else{
            $explrestunits .= $expunit[$i].",";
        }
    }
    $thecash = $explrestunits.$lastthree;
} else {
    $thecash = $num;
}
return "$thecash"; // writes the final format where $currency is the currency symbol.

}


?>
   <body>

      <div class="card-body" style="margin-top:-10%">
         <h5 style="margin-left:250px"><i class="fa fa-user" aria-hidden="true"></i></h5>
         <div style="overflow-x: auto;">
            <table width="100%" style="border-collapse: none;">
               <thead>
                  <tr>
                     <td align="center" colspan="3">
                        <img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                        <p><strong>GOVERNMENT OF INDIA <br />
                           CENTRAL BUREAU OF  COMMUNICATION<br />
                           Ministry of Information & Broadcasting</strong><br />
                           Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                        </p>
=========================================================================================================
                     </td>
                  </tr>
                  <tr>
                     <td align="center" colspan="3">
                        <h5 class="text-center">
                        <u>{{$results->{'NP Name'} }}</u> , <u>{{$results->{'Publishing City'} }}</u></h5>
                        <h3 class="text-center">
                        CNTL No. : {{$results->{'Control No_'} ?$results->{'Control No_'} :'N/A'}}
                     </h3>
                     </td>
                  </tr>

                  <!-- <tr>
                     <td align="center" colspan="3">
                        <h2 class="text-left">
                        <u>Billing Details</u></h2>
                     </td>
                  </tr> -->
               </thead>
            </table>
            <div class="row">
              <div class="col-md-6">
               <table style="border-collapse: none;">
                  <thead>
                  <!-- <tr>
                        <th align="center" colspan="3">Detail As Per RO</th>
                     </tr> -->
                     <tr>
                        <th align="center" colspan="3"><u style="color:black !important;"> Detail As Per RO</u>
                        </th>

                     </tr>
                     <tr>
                        <th align="center" colspan="3"> </th>
                     </tr>
                  </thead>
                  <tbody>
                  <tr>
                        <td>Newspaper Code</td>
                        <td><strong>:</strong></td>
                        <td>{{$ASperRO->{'npcode'} ?$ASperRO->{'npcode'} :'N/A'}}</td>
                     </tr>

                     <tr>
                        <td>GST No</td>
                        <td><strong>:</strong></td>
                        <td>{{ $results->{'Vendor GST No_'} }}</td>
                     </tr>

                     <tr>
                        <td>Relese Order No.</td>
                        <td><strong>:</strong></td>
                        <td>{{$ASperRO->{'RoCode'} ?$ASperRO->{'RoCode'} :'N/A'}}</td>
                     </tr>
                     <tr>
                        <td>Display Key</td>
                        <td><strong>:</strong></td>
                        <td>{{$ASperRO->{'RoCode'} ?$ASperRO->{'RoCode'} :'N/A'}}</td>
                     </tr>
                     <tr>
                        <td>Insertion Date</td>
                        <td><strong>:</strong></td>
                        <td>{{ date('d/m/Y', strtotime($ASperRO->{'PublicationFromDate'}))}}</td>
                     </tr>
                     <tr>
                        <td>Not Later Than </td>
                        <td><strong>:</strong></td>
                        <td>{{ date('d/m/Y', strtotime($ASperRO->{'PublicationToDate'}))}}</td>
                     </tr>
                     <tr>
                        <td>Type of advertisement</td>
                        <td><strong>:</strong></td>

                        @if($ASperRO->{'Advertisement Type'}==0)
                        <td> Classified</td>
                        @elseif($ASperRO->{'Advertisement Type'}==1)
                        <td> Display</td>
                        @elseif($ASperRO->{'Advertisement Type'}==2)
                        <td>UPSC</td>
                        @endif

                     </tr>
                     <tr>
                        <td>AVDTG. Space In SQ. CM</td>
                        <td><strong>:</strong></td>
                        <td>{{$ASperRO->{'Size Of Advt_'} ?round($ASperRO->{'Size Of Advt_'}) :'N/A'}}</td>
                     </tr>
                     <tr>
                        <td>To Be Published In</td>
                        <td><strong>:</strong></td>
                        <td>{{ $ASperRO->{'Billing Advertisement Type'} == 'Color' ? 'Color' : 'Black & white' }}</td>
                     </tr>
                     <tr>
                        <td>Rate Per in SQ.</td>
                        <td><strong>:</strong></td>
                        <td>{{ round(@$ASperRO->{'CRate'},2)  }}</td>
                     </tr>
                     <tr>
                        <td>Amount</td>
                        <td><strong>:</strong></td>
                        <td>{{ round(@$ASperRO->{'ROAmount'},2)  }}</td>
                     </tr>

                  </tbody>
               </table>
              </div>
              <div class="col-md-6">
              <table>
                  <thead>
                  <!-- <tr>
                        <th align="center" colspan="3">Detail Entered By Publisher</th>

                     </tr> -->
                     <tr>
                        <th align="center" colspan="3"> <u>Detail As Per Publisher</u></th>
                        <hr/>
                     </tr>
                     <tr>
                        <th align="center" colspan="3"> </th>
                     </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>Bill No.</td>
                      <td><strong>:</strong></td>
                      <td>{{ $results->{'Vendor Bill No_'} }}</td>
                    </tr>
                    <tr>
                      <td>Bill Date</td>
                      <td><strong>:</strong></td>
                      <td>{{ date('d/m/Y', strtotime($results->{'Vendor Bill Date'})) }}</td>
                    </tr>
                    <tr>
                        <td>Publication Date</td>
                        <td><strong>:</strong></td>
                        <td>{{ date('d/m/Y', strtotime($results->{'Publishing Date'})) }}</td>
                      </tr>
                      <tr>
                        <td>Published In</td>
                        <td><strong>:</strong></td>
                        <td>{{ $results->{'Billing Advertisement Type'} == 'Color' ? 'Color' : 'Black & white' }}</td>
                      </tr>
                     <tr>
                        <td>Page No. on which Ad. Published</td>
                        <td><strong>:</strong></td>
                        <td>{{ $results->{'Page No_'} ?$results->{'Page No_'} :'N/A'}}</td>
                      </tr>
                      <tr>
                        <td>Advertisement Length(in CM)</td>
                        <td><strong>:</strong></td>
                        <td>{{ round($results->{'Advertisement Length'}), 2 }}</td>
                      </tr>
                      <tr>
                        <td>Width(In CM)</td>
                        <td><strong>:</strong></td>
                        <td>{{ round($results->{'Advertisement Width'}), 2 }}</td>
                      </tr>
                      <tr>
                        <td>Difference in Sq.</td>
                        <td><strong>:</strong></td>
                        <td>{{ round($results->{'Advertisement Diff_'}), 2 }}</td>
                      </tr>
                      <tr>
                        <td>Bill Officer Name</td>
                        <td><strong>:</strong></td>
                        <td>{{ $results->{'Bill Officer Name'} }}</td>
                      </tr>
                      <tr>
                        <td>Bill Officer Designation</td>
                        <td><strong>:</strong></td>
                        <td>{{ $results->{'Bill Officer Designation'} }}</td>
                      </tr>
                      <tr>
                        <td>E-mail ID</td>
                        <td><strong>:</strong></td>
                        <td>{{ $results->{'Email Id'} }}</td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                      </tr>
                      <tr>
                      <td>Claimed Amount</td>
                      <td><strong>:</strong></td>
                        <td>{{ moneyFormatIndia(round($results->{'Bill Claim Amount'})), 2 }}</td>
                     </tr>
                     <tr>
                        <td>GST In Claimed Amount</td>
                        <td><strong>:</strong></td>
                        @php $GST = round($results->{'Bill Claim Amount'}); @endphp
                        <td>{{(5/100) * $GST}}</td>
                     </tr>
                  </tbody>
               </table>
              </div>
            </div>
            <div class="row" style="">
            <hr style="border:1px dashed" />
            <p style="font-size:13px;text-align:left; font-weight: bold;">Declaration</p>
                <p style="font-size:13px;text-align:justify;">
                We hereby declare that, information given above are as per our newspaper log, and amounts claimed are as per rate contract with CBC. in case of any discrepancy therein we will be liable for the same and shall
                          refund the excess amounts to CBC, exact hard copies of this bill are being submitted to CBC along with
                          seal and authorized signature, as agreed in the rate contract with CBC.
                          </p>
                  </div>
            <div class="row" style="text-align:center;font-size:13px;width:50%; margin-left:200px;font-weight: bold;">
                    <div class="col-sm-6" style="text-align:right;">
                        <p>Auth. Signatory Name<br />Auth. Signatory Designation<br />For  :->>>></p>
                    </div>
                    <div class="col-sm-6" style="text-align:left; margin-left:30px">
                    @php $authn = strtolower($results->{'Bill Submitted By'}); $authd =strtolower($results->{'Bill Submitted - Designation'}); $npname =strtolower ($results->{'NP Name'}); $npcity = strtolower($results->{'Publishing City'}); @endphp
                     <p>{{ ucwords($authn) }} <br />{{ ucwords($authd) }} <br />{{ucwords($npname) }}, {{ucwords($npcity) }}</p>
                    </div>
                    </div>
                    <div class="row" style="text-align:center;font-size:13px;">
                    <p><b>======================= For Official use CBC =======================</b></p>
                    <p align="left"><b>Note : </b>Prereceipt bill most be sent to CBC, after taking its printout with signature & seal  along
                    with copy of RO & Manual/Agency's bill otherwise,
                    bill will not be considered,
                    </p>
            </div>
            <div class="row" style="text-align:left;font-size:13px;margin-left:50px">
                     <p>Pay Rs. {{ moneyFormatIndia(round($results->{'Bill Claim Amount'})), 2 }}  <br />
                     Rupees. {{ convertNumber(round($results->{'Bill Claim Amount'})) }} </p>

            </div>
            <div class="row" style="text-align:left;font-size:13px; margin-left:100px">
                     <p>Account Officer, CBC </p>
            </div>
        </div>
        </div>

   </body>
</html>
