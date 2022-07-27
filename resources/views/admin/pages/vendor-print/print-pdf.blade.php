<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Application Receipt</title>
    <style>
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }

        body{
            font-size:12px;
        }
        table, th, td {
  border:1px solid #dee2e6;
  border-collapse: collapse;
}

    </style>
</head>
@php
$ownerdatas = $owner_datas['owner'];
$vendordatas = $vendor_datas['vendor'];
@endphp
<body>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%">
            <thead>
            <tr>
                    <td align="center" colspan="7"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                        <p><strong>GOVERNMENT OF INDIA <br />
                                CENTRAL BUREAU OF  COMMUNICATION<br />
                                Ministry of Information & Broadcasting</strong><br />
                            Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                        </p>
                    </td>
                </tr>
            </thead>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
                <tr>
                    <td width="150px"><strong>Profile Photo</strong></td>
                    <td><strong>:</strong></td>
                    <td colspan="4">
                    <div style="width:100px; height:100px; border:solid 1px #000;">
                    @if(@$vendordatas['Profile pic'] != '')
                    <img src="{{public_path('uploads/fresh-empanelment/'.$vendordatas['Profile pic'] ?? '')}}"   width="100px" height="100px"></div>
                    @else

                    @endif
                    </td>
                </tr>
                <tr>
                    <td><strong>Newspaper Name</strong></td>
                    <td><strong>:</strong></td>
                    @php $newname = strtolower($vendordatas['Newspaper Name']); @endphp
                    <td>{{ ucwords($newname) ?? 'N/A'}}</td>
                    <td><strong>Place of Publication</strong></td>
                    <td><strong>:</strong></td>
                    @php $publicationplace = strtolower($vendordatas['Place of Publication']); @endphp
                    <td>{{ ucwords($publicationplace) ?? 'N/A'}}</td>
                </tr>
                @php
                $Periodicity = '';
                $Periodicity_arr = array(0 => 'Daily(M)', 1 => 'Daily(E)', 2 => 'Daily Except Sunday', 3 => 'Bi-Weekly', 4 => 'Weekly', 5 => 'Fortnightly', 6 => 'Monthly');
                foreach($Periodicity_arr as $key => $val){
                if($vendordatas['Periodicity'] == $key){
                $Periodicity = $val;
                }
                }
                @endphp

                <tr>
                    <td><strong>Language</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['lang_name'] ?? 'N/A'}}</td>
                    <td><strong>Periodicity</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $Periodicity ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>No. of Pages</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['No_ Of pages'] !=0 ? @$vendordatas['No_ Of pages'] : 'N/A') }}</td>
                    <td><strong>Claimed Circulation No. </strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['ABC Circulation Number'] ?? 'N/A'}}</td>
                    <td><strong></strong></td>
                    <td><strong></strong></td>
                    <td></td>
                </tr>

                <tr>
                    @php
                    $cir_base = '';
                    $cir_base_arr = array(0 => 'RNI', 1 => 'CA', 2 => 'PIB', 3 => 'ABC');
                    foreach($cir_base_arr as $key => $val){
                    if($vendordatas['CIR Base'] == $key){
                    $cir_base = $val;
                    }
                    }
                    @endphp
                    <td><strong>Circulation Base</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{$cir_base ?? 'N/A'}}</td>
                    <td><strong>Page Width (in Sq. cms)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['Page Width'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Width'])),0),'.') : 'N/A') }}</td>
                </tr>

                <tr>
                    <td><strong>Page Length (in Sq. cms)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['Page Length'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Length'])),0),'.') : 'N/A') }}</td>
                    <td><strong>Print Area Per Page (in Sq. cms)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['Page Area per page'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Area per page'])),0),'.') : 'N/A') }}</td>
                </tr>

                <tr>
                    <td><strong>Total Print Area (in Sq. cms)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['Total Print Area'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Total Print Area'])),0),'.') : 'N/A') }}</td>
                </tr>

                <tr>
                    <th colspan="6"><hr /></th>
                </tr>

                <tr>
                    <td><strong>Printer Mobile</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Printer Mobile'] ?? 'N/A'}}</td>
                    <td><strong>Printer E-mail ID</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ strtolower($vendordatas['Printer Email']) ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Press Name</strong></td>
                    <td><strong>:</strong></td>
                    @php $NameofPress =strtolower($vendordatas['Name of Press']); @endphp
                    <td>{{ ucwords($NameofPress) ?? 'N/A'}}</td>
                    <td><strong>Press Mobile </strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Press Mobile'] ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <td><strong>Press E-mail ID</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ strtolower($vendordatas['Press Email']) ?? 'N/A'}}</td>
                    <td><strong>Press Phone No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Press Phone'] ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <td><strong>Address of Press</strong></td>
                    <td><strong>:</strong></td>
                    <td>
                    @if($vendordatas['Address of Press']!='')
                    {{ strtolower($vendordatas['Address of Press']) ?? 'N/A'}}
                    @else
                    {{'N/A'}}
                    @endif
                    </td>
                    <td><strong>Distance From Office to Press (in km.)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['Distance from office to press'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Distance from office to press'] )),0),'.') : 'N/A') }}</td>
                </tr>

                <tr>
                    <td><strong>CA Name</strong></td>
                    <td><strong>:</strong></td>
                    @php $CAName =strtolower($vendordatas['CA Name']); @endphp
                    <td>{{ ucwords($CAName) ?? 'N/A'}}</td>
                    <td><strong>CA Address</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ strtolower($vendordatas['CA Address']) ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>CA Registration No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['CA Registration No_'] ?? 'N/A'}}</td>
                    <td><strong>CA Mobile No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['CA Mobile No_'] ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>CA E-mail ID</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['CA Email'] ?? 'N/A'}}</td>
                    @php
                    $dm_date = ' ';
                    if((@$vendordatas['DM Declaration Date'] != '1970-01-01 00:00:00.000') && $vendordatas != null){
                    $dm_date = date('d-m-Y', strtotime(@$vendordatas['DM Declaration Date'] ));
                    }
                    @endphp
                    <td><strong>DM Declaration Date</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{$dm_date ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Is Past Address Changed ?</strong></td>
                    <td><strong>:</strong></td>
                    <td colspan="4">{{ $vendordatas['Change In Company Address'] == "0" ? 'N/A' : 'Yes'}}</td>
                </tr>

                <tr>
                    <td width="150px"><strong>Group Code</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $ownerdatas['Owner ID'] }}</td>
                    <td><strong>Reference Code </strong></td>
                    <td width="10px"><strong>:</strong></td>
                    <td>{{ $vendordatas['Newspaper Code'] }}</td>
                </tr>

                <tr>
                    <td><strong>GST No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['GST No_'] ?? 'N/A'}}</td>

                    <td><strong>Owner Name</strong></td>
                    <td><strong>:</strong></td>
                    @php $owname = strtolower($ownerdatas['Owner Name']); @endphp
                    <td>{{ ucwords($owname) ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <td><strong>E-mail ID(Owner)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ strtolower($ownerdatas['Email ID']) }}</td>
                    <td><strong>Mobile No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $ownerdatas['Mobile No_'] }}</td>
                </tr>

                <tr>
                    @php
                    $owner_type = '';
                    $owner_type_arr = array(0 => 'Individual', 1 => 'Partnership', 2 => 'Trust', 3 => 'Society', 4
                    => 'Proprietorship', 5 => 'Public Ltd.', 6 => 'Pvt. Ltd.');
                    foreach($owner_type_arr as $key => $val){
                    if($ownerdatas['Owner Type'] == $key){
                    $owner_type = $val;
                    }
                    }
                    @endphp
                    <td><strong>Owner Type</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $owner_type }}</td>
                    <td><strong>Address </strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ strtolower($ownerdatas['Address 1']) }}</td>
                </tr>

                <tr>
                    <td><strong>State</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $ownerdatas['state_code'] }} ~ {{ $ownerdatas['state_name'] }}</td>
                    <td><strong>District</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $ownerdatas['District'] }}</td>
                </tr>

                <tr>
                    <td><strong>City</strong></td>
                    <td><strong>:</strong></td>
                    @php $cityname = strtolower($ownerdatas['City']); @endphp
                    <td>{{ ucwords($cityname) }}</td>
                    <td><strong>Phone No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $ownerdatas['Phone No_'] ?? 'N/A'}}</td>
                </tr>

                @if(@$vendordatas['CIR Base'] == 0)
                <tr>
                    <td><strong>RNI Registration No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['RNI Registration No_'] ?? '' }}</td>
                    <td><strong>RNI E-filing Number</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['RNI E-filling No_'] ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Claimed Circulation </strong></td>
                    <td><strong>:</strong></td>
                    <td colspan="4">{{ $vendordatas['Claimed Circulation'] ?? 'N/A'}}</td>
                </tr>

                @endif
                @if(@$vendordatas['CIR Base'] == 1)
                <tr>
                    <td><strong>UDIN No. </strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['UDIN'] ?? '' }}</td>
                    <td><strong>Claimed Circulation  </strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['CA Circulation Number'] ?? 'N/A'}}</td>
                </tr>
                @endif
                @if(@$vendordatas['CIR Base'] == 3)
                    <tr>
                        <td><strong>ABC Certificate No. </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['ABC Number'] ?? ''}}</td>
                    </tr>
                @endif
                <tr>
                    <td><strong>Average Circulation Copies</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Average Circulation Copies'] ?? 'N/A' }}</td>
                    <td><strong>Date of First Publication</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['Date Of First Publication'] !='1753-01-01 00:00:00.000' && $vendordatas != null) ? date('d-m-Y', strtotime(@$vendordatas['Date Of First Publication'] )) : 'N/A' }}</td>
                </tr>

                <tr>
                    <td><strong>E-mail ID(Vendor)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ strtolower($vendordatas['E-mail ID']) }}</td>
                    <td><strong>Mobile No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Mobile No_'] ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Address</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ strtolower($vendordatas['Address']) ?? 'N/A'}}</td>
                    <td><strong>State</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['state_name'] ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>District</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['District'] ?? 'N/A'}}</td>
                    <td><strong>City</strong></td>
                    <td><strong>:</strong></td>
                    @php $cityplace = strtolower($vendordatas['City']); @endphp
                    <td>{{ ucwords($cityplace) ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Pin Code</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Pin Code'] }}</td>
                    <td><strong>Phone No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Phone No'] ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <td><strong>Black & White (Rs per Sq. cms)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['Minimum Current Card Rate(B_W)'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Minimum Current Card Rate(B_W)'] )),0),'.') : 'N/A' ) }}</td>
                    <td><strong>Color (Rs per Sq. cms)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['Minimum Current Card Rate(c)'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Minimum Current Card Rate(c)'] )),0),'.') : 'N/A') }}</td>
                </tr>

                <tr>
                    <td><strong>Price of Newspaper (Rs) </strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['Price of NewsPaper'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Price of NewsPaper'] )),0),'.') : 'N/A') }}</td>

                        @php
                        $Quality = '';
                        $Quality_arr = array(0 => 'Standard Newspaper', 1 => 'Glazed', 2 => 'Ordinary');
                        foreach($Quality_arr as $key => $val){
                        if($vendordatas['Quality of Paper'] == $key){
                        $Quality = $val;
                        }
                        }
                        $printing_color = '';
                        if($vendordatas['Printing in colour'] == 0){
                        $printing_color = 'Color';
                        }
                        if($vendordatas['Printing in colour'] == 1){
                        $printing_color = 'B/W';
                        }
                        @endphp

                    <td><strong>Quality of Paper Used</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $Quality ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Printing in Color</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $printing_color ?? 'N/A'}}</td>

                    @if($printing_color == 'Color')

                    <td><strong>How Many Pages in Color</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['No_ of pages in colour'] ?? 'N/A'}}</td>
                    @endif
                </tr>

                @php
                $Agencies = '';
                $Agencies_arr = array(0 => 'PTI', 1 => 'ANI', 2 => 'UNI', 3 => 'VAARTA', 4 => 'BHASHA', 5 => 'IANS', 6 => 'WEB VAARTA', 7 => 'GNS', 8 => 'Others');
                foreach($Agencies_arr as $key => $val){
                if($vendordatas['News Agencies Subscribed To'] == $key){
                $Agencies = $val;
                }
                }
                @endphp

                <tr>
                    <td><strong>News Agencies Subscribed to</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{$Agencies ?? 'N/A'}}</td>

                    <td><strong>Other Agency</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Agencies Name'] !='' ? $vendordatas['Agencies Name'] : 'N/A' }}</td>
                </tr>

                <tr>
                    <td><strong>Total Annual Turnover of the Newspaper in Rs</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ (@$vendordatas['Annual Turn-over'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Annual Turn-over'])),0),'.') : 'N/A') }}</td>

                    <td><strong>Editor Name</strong></td>
                    <td><strong>:</strong></td>
                    @php $EditorName =strtolower($vendordatas['Editor Name']); @endphp
                    <td>{{ ucwords($EditorName) ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Editor Mobile No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Editor Mobile'] ?? 'N/A'}}</td>

                    <td><strong>Editor E-mail ID</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ strtolower($vendordatas['Editor Email']) ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Publisher Name</strong></td>
                    <td><strong>:</strong></td>
                    @php $Publisher_sName =strtolower($vendordatas['Publisher_s Name']); @endphp
                    <td>{{ ucwords($Publisher_sName) ?? 'N/A'}}</td>

                    <td><strong>Publisher Mobile</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Publisher Mobile'] ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Publisher E-mail ID</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ strtolower($vendordatas['Publisher Email']) ?? 'N/A'}}</td>
                    <td><strong>Printer Name</strong></td>
                    <td><strong>:</strong></td>
                    @php $Printer_sName =strtolower($vendordatas['Printer_s Name']); @endphp
                    <td>{{ ucwords($Printer_sName) ?? 'N/A'}}</td>
                </tr>

            <tr>
                <th colspan="6"><hr /></th>
            </tr>

                <tr>
                    <td><strong>Account Type</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Account Type'] == 0 ? 'Savings' : 'Corporate'}}</td>
                    <td><strong>Bank Account No. for Receiving
                            Payments</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Bank Account No_'] ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Account Holder
                            Name</strong></td>
                    <td><strong>:</strong></td>
                    @php $AccountHolderName =strtolower($vendordatas['Account Holder Name']); @endphp
                    <td>{{ ucwords($AccountHolderName) ?? 'N/A'}}</td>
                    <td><strong>IFSC Code</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['IFSC Code'] ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Bank Name</strong></td>
                    <td><strong>:</strong></td>
                    @php $BankName =strtolower($vendordatas['Bank Name']); @endphp
                    <td>{{ ucwords($BankName) ?? 'N/A'}}</td>
                    <td><strong>Branch</strong></td>
                    <td><strong>:</strong></td>
                    @php $branch_name = strtolower($vendordatas['Branch'])@endphp
                    <td>{{ ucwords($branch_name) ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Address of Bank</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Account Address'] ?? 'N/A'}}</td>
                    <td><strong>PAN Card No.</strong                ></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['PAN'] ?? 'N/A'}}</td>
                </tr>

                <tr>
                    <td colspan="6">ESI Account Details</td>
                </tr>

                <tr>
                    <td><strong>Account No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['ESI Account No'] ?? 'N/A'}}</td>
                    <td><strong>No. of Employees Covered</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['No_of Employees covered'] !=0 ? @$vendordatas['No_of Employees covered'] : 'N/A' }}</td>
                </tr>

                <tr>
                    <td colspan="6">EPF Account Details</td>
                </tr>

                <tr>
                    <td><strong>Account No.</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['EPF Account No_'] ?? 'N/A'}}</td>
                    <td><strong>No. of Employees Covered</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{$vendordatas['No_ of EPF Employees covered'] !=0 ? @$vendordatas['No_ of EPF Employees covered'] : 'N/A' }}</td>
                </tr>
            <tr>
                <th colspan="6" align="left"><h3>Uploaded Documents</h3></th>
            </tr>
                <tr>
                    <td width="35%"><strong>Annexure – A (Signed by CA)</strong></td>
                    <td width="3%"><strong>:</strong></td>
                    <td>{{ $vendordatas['Annexure File Name'] != '' ? 'Yes' : 'N/A'}}</td>
                    <td><strong>Specimen Copies to be Sent with Application</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Specimen Copy File Name'] != '' ? 'Yes' : 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>Copy of Declaration Field by Before DM/DCP or Other Competent Authority</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{$vendordatas['Decl_ Filed Before File Name'] != '' ? 'Yes' : 'N/A'}}</td>
                    <td><strong>Owner’s PAN Number Self Attested Copy</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{$vendordatas['PAN Copy File Name'] != '' ? 'Yes' : 'N/A'}}</td>
                </tr>

                <tr>
                    <td><strong>No Dues Certificates of Press Council of India for the Last Financial Year Registration</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['No Dues Cert File Name'] != '' ? 'Yes' : 'N/A' }}</td>
                    <td><strong>Circulation Certificate as per Policy (Self-Attested) (if More Than 25,000 Than
                            RNI/ABC is Mandatory)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Circulation Cert File Name'] != '' ? 'Yes' : 'N/A' }}</td>
                </tr>

                <tr>
                    <td><strong>RNI (Self-Attested) Registration Certificate</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['RNI Reg File Name'] != '' ? 'Yes' : 'N/A' }}</td>
                    <td><strong>Copy of Annual Return Form-2 Submitted to RNI Along with Receiving Proof </strong>
                    </td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Annual Return File Name'] != '' ? 'Yes' : 'N/A' }}</td>
                </tr>

                <tr>
                    <td><strong>Copy of Commercial Rate Card of the Publication (1 copy)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Specimen Copy File Name'] != '' ? 'Yes' : 'N/A' }}</td>
                    <td><strong>Owner’s GST registration Certificate</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['GST Reg Cert File Name'] != '' ? 'Yes' : 'N/A' }}</td>
                </tr>

                <tr>
                    <td><strong>Change of Information for Existing Company</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Change in address File Name'] != '' && $vendordatas['Change in address uploaded'] == '1'? 'Yes' : 'N/A' }}</td>
                    <td><strong>Self Declaration</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $vendordatas['Self Declaration'] == 1 ? 'Yes' : 'N/A' }}</td>
                </tr>

                <tr style="border:none !important;">
                        <td  colspan="6" height="80px">
                        <h3 align="left">I Affirm that all the information given by me is true and nothing has been concealed.</h3>
                        <p align="right" style="margin-top:50px;margin-right: 14px;">
                        @if(@$vendordatas['Vendor Scan signature'] !='')
                        <img src="{{public_path('uploads/fresh-empanelment/'.$vendordatas['Vendor Scan signature'] ?? '')}}"   width="150px" height="100px" style="marign-left:180px">
                        @endif
                        </p>
                        <p align="right">Authorized Signatory  / Signature</p></td>
                        
                    </tr>
            </table>
        </div>
    </div>
</body>
</html>
