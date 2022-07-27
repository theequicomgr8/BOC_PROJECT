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

<?php
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
@php

@$ownerdatas = $owner_datas['owner'] ?$owner_datas['owner'] :'';
@$vendordatas = $vendor_datas['vendor'];
@$renewaldatas = $renewal_datas['renewal'];
 //dd($ownerdatas);
$start_date = date('Y-m-d', strtotime($renewaldatas['Contract Start Date']));
$end_date = date('Y-m-d', strtotime($renewaldatas['Contract End Date']));


$reg_no = '';
$solid_circulation = '';
$efiling = 'none';
$reg_no_verified = '';
$solid_circulation_verified = '';
$turnover_verified = '';
$date_verified = '';
$rni_regist_no = 'none';
$abc_cert = 'none';
$abc_reg_no_verified = '';
// dd($np_rate_renewal);
if( $renewaldatas['CIR Base'] == 0  || ($renewaldatas['RNI Circulation'] == 1 && $renewaldatas !='')){
$reg_no = $renewaldatas['RNI Registration No_'] ?? '';
$solid_circulation = $renewaldatas['circulation'] ??'';
$reg_no_verified = $renewaldatas['RNI Registration Validation'] ?? '';
$solid_circulation_verified = $renewaldatas['RNI Circulation Validation'] ?? '';
$turnover_verified = $renewaldatas['RNI Annual Validation'] ?? '';
$date_verified = $renewaldatas['RNI Validation Date'] ?? '';
}
if($renewaldatas['CIR Base'] == 3  || ($renewaldatas['ABC Circulation'] == 1 && $renewaldatas !='')){
$solid_circulation = $renewaldatas['circulation'] ?? '';
$abc_reg_no_verified = $renewaldatas['ABC Registration Validation'] ?? '';
$solid_circulation_verified = $renewaldatas['ABC Circulation Validation'] ?? '';
$date_verified = $renewaldatas['ABC Validation Date'] ?? '';
}

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
                        <td colspan="6" align="center">
                            <h3>Print Renewal Receipt for the {{date('Y')}} is  <br/>{{@$renewaldatas['Application No_']}} </h3>
                        </td>
                    </tr>
                    <tr>
                        <td width="150px"><strong>Profile Photo</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">
                            <div style="width:100px; height:100px; border:solid 1px #000;">
                            @if($renewaldatas['Profile pic'] !='')
                            <img src="{{public_path('uploads/fresh-empanelment/'.$renewaldatas['Profile pic'] ?? '')}}"   width="100px" height="100px">
                            @endif
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                               <h2>Basic Information</h2>
                        </td>
                    </tr>
                    <tr>
                        <td width="150px"><strong>Newspaper Code</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="">{{ $np_code ?? '' }}</td> 
                        <td><strong>Newspaper Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $newname = strtolower($renewaldatas['Newspaper Name']); @endphp
                        <td>{{ ucwords(@$newname) ?? 'N/A'}}</td>  
                    </tr>
                    <tr>
                        <td><strong>Place of Publication</strong></td>
                        <td><strong>:</strong></td>
                        @php $publicationplace = strtolower(@$vendordatas['Place of Publication']); @endphp
                        <td>{{ ucwords(@$publicationplace) ?? 'N/A'}}</td>
                        @php
                        @$Periodicity = '';
                        @$Periodicity_arr = array(0 => 'Daily(M)', 1 => 'Daily(E)', 2 => 'Daily Except Sunday', 3 => 'Bi-Weekly', 4 => 'Weekly', 5 => 'Fortnightly', 6 => 'Monthly');
                        foreach(@$Periodicity_arr as $key => $val){
                        if(@$vendordatas['Periodicity'] == $key){
                        @$Periodicity = $val;
                        }
                        }
                        @endphp
                        <td><strong>Language</strong></td>
                        <td><strong>:</strong></td>
                        @if(@$lang > 0)
                            @foreach(@$lang as $language)
                                @if(@$vendordatas['Language'] == $language['Code'])
                                <td>{{ @$language['Name'] ? @$language['Name'] : 'N/A'}} </td>                             
                                @endif
                            @endforeach
                        @else
                            <td>{{ 'N/A' }} </td>
                        @endif
                    </tr>
                    <tr>
                    <td><strong>Periodicity</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$Periodicity ?? 'N/A'}}</td>
                        <td><strong>No. of Pages</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$renewaldatas['No_ Of pages'] !=0 ? @$renewaldatas['No_ Of pages'] : 'N/A') }}</td>
                    </tr>
                    @php
                        @$cir_base = '';
                        @$cir_base_arr = array(0 => 'RNI', 1 => 'CA', 2 => 'PIB', 3 => 'ABC');
                        foreach(@$cir_base_arr as $key => $val){
                        if(@$renewaldatas['CIR Base'] == $key){
                        @$cir_base = $val;
                        }
                        }
                        @endphp
                    <tr>
                        <td><strong>Circulation Base</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$cir_base ?? 'N/A'}}</td>
                        @if(@$renewaldatas['CIR Base'] == 0)
                        <td><strong>Claimed Circulation </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['circulation'] ?? 'N/A'}}</td>
                        @endif
                    </tr>
                    @if($renewaldatas['CIR Base'] == 0)
                    <tr>
                        <td><strong>RNI Registration No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['RNI Registration No_'] ?? '' }}</td>
                        <td><strong>RNI E-filing Number</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['RNI E-filling No_'] ?? 'N/A'}}</td>
                    </tr>
                    @endif
                    @if($renewaldatas['CIR Base'] == 1)
                    <tr>
                    <td><strong>Claimed Circulation </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendordatas['CA Circulation Number'] ?? 'N/A'}}</td>
                        <td><strong>UDIN No. </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendordatas['UDIN'] ?? '' }}</td>
                    </tr>
                    @endif
                    @if(@$renewaldatas['CIR Base'] == 3)
                    <tr>
                    <td><strong>Claimed Circulation  </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['circulation'] ?? 'N/A'}}</td>
                        <td><strong>ABC Certificate No. </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['ABC Certificate No_'] ?? ''}}</td>
                    </tr>
                    @endif
                    <tr>
                        @php
                        $dm_date = ' ';
                        if(($renewaldatas['DM Declaration Date'] != '1753-01-01 00:00:00.000') && $renewaldatas != null && ($renewaldatas['DM Declaration Date'] != '1900-01-01 00:00:00.000')){
                        $dm_date = date('d-m-Y', strtotime($renewaldatas['DM Declaration Date'] ));
                        }
                        @endphp
                        <td><strong>DM Declaration Date</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$dm_date ?? 'N/A' }}</td>    
                        <td><strong>Is there any changes on DM Declaration ?</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['DM Declaration'] == "0" ? 'N/A' : 'Yes'}}</td>                                
                    </tr>
                    <tr>
                        <td><strong>First Date of First Publication</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Date Of First Publication'] !='1753-01-01 00:00:00.000' && @$vendordatas != null) ? date('d-m-Y', strtotime(@$vendordatas['Date Of First Publication'] )) : 'N/A' }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="6">
                               <h2>Contact Details</h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h3>Owner Details</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Owner Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $owname = strtolower(@$payee_datas->{'Payee Name'}); @endphp
                        <td>{{ ucwords(@$owname) ?? 'N/A' }}</td>
                        <td><strong>E-mail ID(Owner)</strong></td>
                        <td width="10px"><strong>:</strong></td>
                        <td>{{ strtolower(@$payee_datas->{'Owner email'}) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$payee_datas->{'Owner mobile'} }}</td>
                        @php
                        $owner_type = '';
                        @$owner_type_arr = array(0 => 'Individual', 1 => 'Partnership', 2 => 'Trust', 3 => 'Society', 4
                        => 'Proprietorship', 5 => 'Public Ltd.', 6 => 'Pvt. Ltd.');
                        foreach($owner_type_arr as $key => $val){
                        if(@$payee_datas->{'Owner type'} == $key){
                        @$owner_type = $val;
                        }
                        }
                        @endphp
                        <td><strong>Owner Type</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$owner_type }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower(@$payee_datas->{'Owner address'}) }}</td>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$ownerdatas['state_name'] }} </td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$ownerdatas['District'] }}</td>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        @php $cityname = strtolower(@$ownerdatas['City']); @endphp
                        <td>{{ ucwords(@$cityname) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$ownerdatas['Phone No_'] ?@$ownerdatas['Phone No_'] :'N/A'}}</td>
                        <td><strong></strong></td>
                        <td><strong></strong></td>
                        <td></td>
                    </tr> 
                    
                    <tr>
                        <td colspan="6">
                            <h3>Publisher Details</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Publisher Name</strong></td>
                        <td><strong>:</strong></td>
                        @php @$PublisherName =strtolower(@$renewaldatas['Publisher Name']); @endphp
                        <td>{{ ucwords(@$PublisherName) ?? 'N/A'}}</td>
                        <td><strong>Publisher Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['Publisher Mobile'] ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Publisher E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower(@$renewaldatas['Publisher Email']) ?? 'N/A'}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h3>Printer Details</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Printer Name</strong></td>
                        <td><strong>:</strong></td>
                        @php @$Printer_sName =strtolower(@$renewaldatas['Printer Name']); @endphp
                        <td>{{ ucwords(@$Printer_sName) ?? 'N/A'}}</td>
                        <td><strong>Printer Mobile</strong></td>
                        <td><strong>:</strong></td>                        
                        <td>{{ @$renewaldatas['Printer Phone'] ?? ''}}</td>
                    </tr>
                    <tr>
                    <td><strong>Printer E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['Printer Email'] ?? 'N/A'}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h3>Editor Details</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Editor Name</strong></td>
                        <td><strong>:</strong></td>
                        @php @$EditorName =strtolower(@$renewaldatas['Editor Name']); @endphp
                        <td>{{ ucwords($EditorName) ?? 'N/A'}}</td>
                        <td><strong>Editor Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['Editor Mobile'] ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Editor E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower(@$renewaldatas['Editor Email']) ?? 'N/A'}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h3>Printing Press Details</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Press Name</strong></td>
                        <td><strong>:</strong></td>
                        @php @$PressName =strtolower($renewaldatas['Name of Press']); @endphp
                        <td>{{ ucwords(@$PressName) ?? 'N/A'}}</td>
                        <td><strong>Press Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['Press Mobile'] ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Press E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower(@$renewaldatas['Press Email']) ?? 'N/A'}}</td>
                        <td><strong>Press Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['Press Phone'] ?? 'N/A'}}</td>
                    </tr> 
                    <tr>
                        <td><strong>Address of Press</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower(@$renewaldatas['Address of Press']) ?strtolower(@$renewaldatas['Address of Press']) :'N/A'}}</td>
                        <td><strong>Distance From Office to Press (in km.)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$renewaldatas['Distance from office to press'] !=0 ? rtrim(rtrim(sprintf('%f', floatval(@$renewaldatas['Distance from office to press'] )),0),'.') : 'N/A') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Is the Press Owned by the Owner of Newspaper?</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['Press owned by owner'] == "0" ? 'N/A' : 'Yes'}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h3>CA Details</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><strong> CA Name</strong></td>
                        <td><strong>:</strong></td>
                        @php @$CAName =strtolower($renewaldatas['CA Name']); @endphp
                        <td>{{ ucwords(@$CAName) ?ucwords(@$CAName) :'N/A'}}</td>
                        <td><strong>CA Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['CA Mobile No_'] ?@$renewaldatas['CA Mobile No_'] :'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>CA E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['CA Email'] ?@$renewaldatas['CA Email'] :'N/A'}}</td>
                        <td><strong>CA Registration No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['CA Registration No_'] ?@$renewaldatas['CA Registration No_'] :'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong> CA Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower(@$renewaldatas['CA Address']) ?strtolower(@$renewaldatas['CA Address']) :'N/A'}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h3>Newspaper Details</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>E-mail ID(Vendor)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower($renewaldatas['E-mail ID']) }}</td>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Mobile No_'] ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower($renewaldatas['Address']) ?? 'N/A'}}</td>
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
                        <td>{{ $vendordatas['Pin Code'] ?? 'N/A' }}</td>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $renewaldatas['Phone No'] ? $renewaldatas['Phone No'] : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Is Past Address Changed ?</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $renewaldatas['Change In Company Address'] == "0" ? 'N/A' : 'Yes'}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h2>Technical Information</h2>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Page Width (in Sq. cms)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ ($renewaldatas['Breadth'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($renewaldatas['Breadth'])),0),'.') : 'N/A') }}</td>
                        <td><strong>Page Length (in Sq. cms)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ ($renewaldatas['Length'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($renewaldatas['Length'])),0),'.') : 'N/A') }}</td> 
                    </tr>
                    <tr>
                    <td><strong>Print Area Per Page (in Sq. cms)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ ($renewaldatas['Page Area per page'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($renewaldatas['Page Area per page'])),0),'.') : 'N/A') }}</td>
                        <td><strong>Total Print Area (in Sq. cms)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ ($renewaldatas['Print Area'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($renewaldatas['Print Area'])),0),'.') : 'N/A') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Black & White (Rs per Sq. cms)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ ($renewaldatas['Minimum Current Card Rate(B_W)'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($renewaldatas['Minimum Current Card Rate(B_W)'] )),0),'.') : 'N/A' ) }}</td>
                        <td><strong>Color (Rs per Sq. cms)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ ($renewaldatas['Minimum Current Card Rate(c)'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($renewaldatas['Minimum Current Card Rate(c)'] )),0),'.') : 'N/A') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Price of Newspaper (Rs) </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ ($renewaldatas['Price of NewsPaper'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($renewaldatas['Price of NewsPaper'] )),0),'.') : 'N/A') }}</td>

                            @php
                            $Quality = '';
                            $Quality_arr = array(0 => 'Standard Newspaper', 1 => 'Glazed', 2 => 'Ordinary');
                            foreach($Quality_arr as $key => $val){
                            if($renewaldatas['Quality of Paper'] == $key){
                            $Quality = $val;
                            }
                            }
                            $printing_color = '';
                            if(($vendordatas['Printing in colour'] == 0) || ($renewaldatas['Printing in color'] == 0)){
                            $printing_color = 'Color';
                            }
                            if(($vendordatas['Printing in colour'] == 1) || ($renewaldatas['Printing in color'] == 1)){
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
                        <td>{{ $renewaldatas['No_ of pages in colour'] ?? 'N/A'}}</td>
                        @endif
                        </tr>
                        @php
                        $Agencies = '';
                        $Agencies_arr = array(0 => 'PTI', 1 => 'ANI', 2 => 'UNI', 3 => 'VAARTA', 4 => 'BHASHA', 5 => 'IANS', 6 => 'WEB VAARTA', 7 => 'GNS', 8 => 'Others');
                        foreach($Agencies_arr as $key => $val){
                        if($renewaldatas['News Agencies Subscribed To'] == $key){
                        $Agencies = $val;
                        }
                        }
                        @endphp
                        <tr>
                            <td><strong>News Agencies Subscribed to</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{$Agencies ?? 'N/A'}}</td>

                            <td><strong>Total Annual Turnover of the Newspaper in Rs</strong></td>
                            <td><strong>:</strong></td>
                            @php $number = (@$renewaldatas['Annual Turn-over']); @endphp
                                <td>@if((@$renewaldatas['Annual Turn-over']) && (@$renewaldatas['Annual Turn-over'])!=0) 
                                {{moneyFormatIndia($number)}}
                                @else
                                N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Bound/Unbound</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $renewaldatas['bound_unbound'] == 0 ? 'Bound' : 'Unbound'}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <h2>Account Details</h2>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Account Type</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $vendordatas['Account Type'] == 0 ? 'Saving' : 'Corporate'}}</td>
                            <td><strong>Bank Account No. for Receiving Payments</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $vendordatas['Bank Account No_'] ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td><strong>Account Holder Name</strong></td>
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
                            <td><strong>Address of Account</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ strtolower($vendordatas['Account Address']) ?? 'N/A'}}</td>
                            <td><strong>PAN Card No.</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $vendordatas['PAN'] ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td><strong>GST No.</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $renewaldatas['GST No_'] ? $renewaldatas['GST No_'] : 'N/A'}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr><td colspan="6">ESI Account Details</td></tr>
                        <tr>
                            <td><strong>Account No.</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $vendordatas['ESI Account No'] ?$vendordatas['ESI Account No'] :'N/A'}}</td>
                            <td><strong>No. of Employees Covered</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $vendordatas['No_of Employees covered'] !=0 ? $vendordatas['No_of Employees covered'] : 'N/A' }}</td>
                        </tr>
                        <tr><td colspan="6">EPF Account Details</td></tr>
                        <tr>
                            <td><strong>Account No.</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $vendordatas['EPF Account No_'] ?$vendordatas['EPF Account No_'] :'N/A'}}</td>
                            <td><strong>No. of Employees Covered</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{$vendordatas['No_ of EPF Employees covered'] !=0 ? $vendordatas['No_ of EPF Employees covered'] : 'N/A' }}</td>
                        </tr>
                    <tr>
                    <tr>
                        <td colspan="6" >
                            <h2>Uploaded Documents</h2>
                        </td>
                    </tr>
                    @if(@$renewaldatas['DMD File Name'] != '')
                    <tr>
                        <!-- <td width="35%"><strong>Circulation File Upload</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ $renewaldatas['Circulation File Name'] != '' ? 'Yes' : 'N/A'}}</td> -->
                        <td colspan="4"><strong>Latest DM Certification Uploaded in Case of Change Ownership, Printers, Publisher, Editor</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$renewaldatas['DMD File Name'] != '' ? 'Yes' : 'N/A'}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="4"><strong>No Dues Certificates of Press Council of India for the Last Financial Year Registration</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $renewaldatas['No Dues Cert File Name'] != '' ? 'Yes' : 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Annexure – A (Signed by C.A)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $renewaldatas['Annexure File Name'] != '' ? 'Yes' : 'N/A'}}</td>
                        <!-- <td ><strong>GST Registration Certificate</strong></td>
                        <td ><strong>:</strong></td>
                        <td>{{ $renewaldatas['GST FileName'] != '' ? 'Yes' : 'N/A'}}</td> -->
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Copy of Annual Return Form-2 Submitted to RNI Along with Receiving Proof </strong>
                        </td>
                        <td><strong>:</strong></td>
                        <td>{{ $renewaldatas['Annual Return RNI File Name'] != '' ? 'Yes' : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Circulation Certificate as per Policy (Self-Attested) (if More Than 25,000 Than
                                RNI/ABC is Mandatory)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $renewaldatas['Circulation Cert File Name'] != '' ? 'Yes' : 'N/A' }}</td>
                    </tr>
                    <tr>
                            <td colspan="4"><strong>Specimen Copies to be Sent with Application</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $renewaldatas['Specimen Copy File Name'] != '' ? 'Yes' : 'N/A'}}</td>
                    </tr>
                    <tr>
                            <td colspan="4"><strong>Copy of Declaration Field by Before DM/DCP or Other Competent Authority</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{$renewaldatas['Decl_ Filed Before File Name'] != '' ? 'Yes' : 'N/A'}}</td>
                    </tr>
                    <tr>
                            <td colspan="4"><strong>RNI (Self-Attested) Registration Certificate</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ $renewaldatas['RNI Reg File Name'] != '' ? 'Yes' : 'N/A' }}</td>
                    </tr>
                    <tr>
                            <td colspan="4"><strong>Change of Information for Existing Company</strong></td>
                            <td><strong>:</strong></td>
                            <td>{{ @$renewaldatas['Change in address File Name'] != '' && @$renewaldatas['Change in address uploaded'] == '1'? 'Yes' : 'N/A' }}</td>
                    </tr>
                  
                       <tr style="border:none !important;">
                        <td  colspan="6" height="80px">
                        <h3 align="left">I confirm that all the information given by me is true and nothing has been concealed.</h3>
                        <p align="right" style="margin-top:50px;margin-right: 14px;">
                        @if($renewaldatas['Vendor Scan signature'] !='')
                        <img src="{{public_path('uploads/fresh-empanelment/'.$renewaldatas['Vendor Scan signature'] ?? '')}}"   width="150px" height="100px" style="marign-left:180px">
                        @endif
                        </p>
                        <p align="right">Authorized Signatory  / Signature</p></td>
                       
                    </tr>
                </table>
                </div>
                </div>

</body>

</html>
