<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Personal Media Application Receipt</title>
    <style>
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }

    </style>
</head>

<body>
    <table width="100%" border="1" style="border-collapse: collapse;" cellspacing="0" cellpadding="5" class="tree">
        <tr>
            <td align="center"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                <p><strong>GOVERNMENT OF INDIA <br />
                        CENTRAL BUREAU OF  COMMUNICATION<br />
                        Ministry of Information & Broadcasting</strong><br />
                    Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                </p>
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>Basic Information</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Profile Photo</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>
                            <div style="width:180px; height:220px; border:solid 1px #000;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Owner Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $owner_data[0]['Owner Name'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-mail ID(Owner)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $owner_data[0]['Email ID'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $owner_data[0]['Mobile No_'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $owner_data[0]['Address 1'] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color: #fff;"><strong>Outdoor Information</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>GST No</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['GST No_'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Agency Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['PM Agency Name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>TIN/TAN No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['TIN_TAN_VAT No_'] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        @if(count($branch) > 0)
        <tr>
            <td style="background:#f2f2f2;" colspan="3">
                <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Branch Office (if any) </strong></h4>
            </td>
        </tr>
      
        <tr>
            <td colspan="1">
               
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
               
            @foreach($branch as $branches)
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        @foreach($getmultiple as $getmul) 
                        @if($getmul->{'Code'} == $branches->{'State'})
                        <td>{{ $getmul->{'Description'} ?? '' }}</td>
                        @endif
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $branches->{'BO Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $branches->{'BO Landline No_'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email Id</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $branches->{'BO E-Mail'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $branches->{'BO Mobile No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr /></td>
                    </tr>
                    @endforeach
                </table>
              
            </td>
        </tr>
        @endif
       @if($vendor_data[0]['DO Address'] > 0)
        <tr>
            <td style="background:#f2f2f2;" colspan="3">
                <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Delhi Office (If any) </strong></h4>
            </td>
        </tr>
        <tr>
            <td colspan="1">
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$vendor_data[0]['DO Address'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$vendor_data[0]['DO Landline No_'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email Id</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$vendor_data[0]['DO E-Mail'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$vendor_data[0]['DO Mobile No_'] ?? ''}}</td>
                    </tr>
                </table>
            </td>
        </tr>
      @endif
        <tr>
            <td style="background:#f2f2f2;" colspan="3">
                <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Authority Details  </strong></h4>
            </td>
        </tr>
        <tr>
            <td colspan="1">
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Authority Which Granted Media With Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['Authority Which granted Media'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Amount Paid to Authority For The Current Year</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['Amount paid to Authority'] ? round(@$vendor_data[0]['Amount paid to Authority'],2) : ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>License start date </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['License From'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License From'])) : ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>License end date </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['License To'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License To'])) : ''}}</td>
                    </tr>
                    @php
                    $arr =array(0=>'Size per unit', 1=>'Size per sqft',2=> 'Spot per unit');
                    @endphp
                    <tr>
                        <td><strong>Rental Type  </strong></td>
                        <td><strong>:</strong></td>
                        @foreach($arr as $key =>$value)
                        >@if(@$vendor_data[0]['Rental Agreement']==$key)
                        <td>{{$value}}</td>
                        @endif
                        @endforeach
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background:#f2f2f2;" colspan="3">
                <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Details Of Outdoor Media Formatted Offered   </strong></h4>
            </td>
        </tr>
        <tr>
            <td colspan="1">
               
            <table width="100%" border="0" cellspacing="0" cellpadding="4">

            @foreach($soleaddress as $mediaaddress)
                    <tr>
                        @php
                        $odmediatype =''; 
                        if($mediaaddress->{'OD Media Type'} == 0){
                            $odmediatype ='Airport';
                        }elseif($mediaaddress->{'OD Media Type'} == 1){
                            $odmediatype ='Railway Station';
                        }elseif($mediaaddress->{'OD Media Type'} ==2){
                            $odmediatype ='Road side';
                        }elseif($mediaaddress->{'OD Media Type'} ==3){
                            $odmediatype ='Moving Media';
                        }elseif($mediaaddress->{'OD Media Type'} ==4){
                            $odmediatype ='Public utility';
                        }else{
                            $odmediatype ='';
                        }
                        echo $odmediatype;
                        @endphp
                        <td><strong>Media Category </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $odmediatype ?? ''}}</td>
                    </tr>
                    <tr>
                    <td><strong>Media Sub-Category</strong></td>
                        <td><strong>:</strong></td>
                        @if(@$mediaaddress->{'OD Media Type'}!='')
                                                @foreach($getcat as $cat)
                                                @if(@$mediaaddress->{'OD Media ID'}==$cat->media_uid)
                                                 
                                                    <td>{{$cat->name ?? ''}}</td>
                                                    @endif
                                                @endforeach
                                                @endif
                        
                    </tr>
                   
                    <tr>
                        <td colspan="3"><hr /></td>
                    </tr>
                    @endforeach
                </table>
              
            </td>
        </tr>
        <tr>
            <td style="background:#f2f2f2;" colspan="3">
                <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Details of work in last six months </strong></h4>
            </td>
        </tr>
      
        <tr>
            <td colspan="1">
             
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
            @foreach($OD_work_dones_data as $work_done_data)    
                    <tr>
                        <td><strong>Year</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$work_done_data['Year']  ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Quantity of Display or Duration</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$work_done_data['Qty Of Display_Duration'] ?? ''}}</td>
                    </tr>
                     
                    <tr>
                    @php
                                        if(@$work_done_data['Billing Amount'] == 0)
                                        {
                                        $work_done_data1 = '';
                                        }
                                        else
                                        {
                                        $work_done_data1 = round(@$work_done_data['Billing Amount'],2);
                                        }
                                        @endphp
                        <td><strong>Billing Amount(Rs)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $work_done_data1 ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>From Date </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (!empty(@$work_done_data['From Date']) && @$work_done_data['From Date'] != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$work_done_data['From Date'])) : ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>To Date </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (!empty(@$work_done_data['To Date']) && @$work_done_data['To Date'] != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$work_done_data['To Date'])) : ''}}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr /></td>
                    </tr>
                    @endforeach
                </table>
               
            </td>
        </tr>
        <tr>
            <td colspan="1">
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
         
                    <tr>
                        <td><strong>Upload Document</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['File Name'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>

                </table>
               
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>Account Details</strong></h3>
            </td>
        </tr>
        <tr>  
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                   
                <tr>
                        <td><strong>PAN No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['PAN'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['IFSC Code'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['Bank Name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['Bank Branch'] }}</td>
                    </tr>
                   
                    <tr>
                        <td><strong>Account no </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendor_data[0]['Account No_'] }}</td>
                    </tr>
                </table>
            </td>
        </tr>   
        <tr>
            <td style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>Upload Document</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Upload document of legal status of company</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['Legal Doc File Name'] != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Attach copy of Pan Number and authorization of Bank for NEFT payment</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendor_data[0]['PAN File Name'] != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Upload document of outdoor media format(attach supportive documents viz, Notarized copy of agreement of sole right indicating location, receipt of amount paid, validity etc/ allotment letter where agreement is not executed)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendor_data[0]['Notarized Copy File Name'] != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Submit an affidavit on stamp paper stating
                                on oath that the details submitted by you on performa are true and
                                correct.Mention the application no. in affidavit </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendor_data[0]['Affidavit File Name'] != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Photographs of displayed medium (Separate photo for each property)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendor_data[0]['Photo File Name'] != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>GST registration Certificate</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['GST File Name'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Self declaration</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendor_data[0]['Self-declaration'] == 1 ? 'Yes' : 'No' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>