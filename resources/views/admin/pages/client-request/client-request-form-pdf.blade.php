<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Client Request Application Receipt</title>
    <style>
        /* tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }
        #content1::before{
    content: "\a";
    white-space: pre;
} */

body{
            font-size:13px;
        }
        table, th, td {
  border:1px solid #dee2e6;
  border-collapse: collapse;
}
.cap{
    text-transform:capitalize;
}
    </style>
</head>

<body>

@php
$disabled= isset($disabled ) ? $disabled :'' ;
$crh=isset($client_req_header)? $client_req_header:'';
$prch=isset($print_client_req)? $print_client_req:'';
$codm=isset($clientOutdoorData)? $clientOutdoorData:[1];
$tvcr=isset($clientTVData)? $clientTVData:'';
$crsRadiocr=isset($clientRadioData)? $clientRadioData:'';
//dd($tvcr);
$mhead=isset($ministries_head) ? $ministries_head:'';
//dd($mhead);
@$Client_ReqNo = $crh->{'Client Request No'};
@$print_reqid1 = @$prch->{'Client Request No_'};
$readonly = ' ';
$checked = ' ';
if(@$Client_Request_No != ''){
$readonly = 'readonly';
$checked = 'checked';
}
$emailreadonly = '';
if(@$email !=''){
$emailreadonly = 'readonly';
}
if(round(@$prch->{'Length'})==0){
$Length='' ;
}else{
$Length=@round(@$prch->{'Length'});
}
if(round(@$prch->{'Breadth'})==0){
$Breadth='' ;
}else{
$Breadth=round(@$prch->{'Breadth'});
}
if( round(@$prch->{'Size of Advt_'})==0){
$SizeofAdvt ='';
}else{
$SizeofAdvt = round(@$prch->{'Size of Advt_'});
}
if( @$prch->{'Plan Count'}==0){
$pcount='';

}else{
$pcount= @$prch->{'Plan Count'};
}
if(@$crh->{'From Date'}=='' ){
$fromDate='';

}else{
$fromDate= date('d/m/Y',strtotime(@$crh->{'From Date'}));
}
if(@$crh->{'To Date'}=='' ){
$toDate='';
}else{
$toDate= date('d/m/Y',strtotime(@$crh->{'To Date'}));
}
if($disabled=='disabled'){
$style="pointer-events:none;";

}else{
$style='';
}
$printCitySelectionData1 = (!empty($printCitySelectionData)) ? explode(',', $printCitySelectionData):[];
$printStateSelectionData1 = (!empty($printStateSelectionData)) ? explode(',', $printStateSelectionData):[];
$langSelectionData1 = (!empty($langSelectionData))?explode(',', $langSelectionData):[];
$tvLangSelectionData =(!empty($tvLangSelectionData))? explode(',', $tvLangSelectionData):[];
$radioLangSelectionData=(!empty($radioLangSelectionData))? explode(',', $radioLangSelectionData):[];

$mediaArray=array(
0=>array('mdNameVal'=>"1",'mdName'=>'Print'),
1=>array('mdNameVal'=>"2",'mdName'=>'Outdoor'),
2=>array('mdNameVal'=>"3",'mdName'=>'AV-TV'),
3=>array('mdNameVal'=>"4",'mdName'=>'AV-Radio')
);
if(@$Client_ReqNo!=''){
$dynamicmname[]=$crh->Print=="1" ? $crh->Print="1":'';
$dynamicmname[]=$crh->Outdoor=="1" ? $crh->Outdoor="2":'';
$dynamicmname[]=$crh->{'AV - TV'}=="1" ? $crh->{'AV-TV'}="3":'';
$dynamicmname[]=$crh->{'AV - Radio'}=="1"? $crh->{'AV-Radio'}="4":'';

$mediaTabArray=array(
0=>array('mdNameVal'=>$crh->Print!="" ? $crh->Print:'','mdName'=>'Print'),
1=>array('mdNameVal'=>$crh->Outdoor!="" ? $crh->Outdoor:'','mdName'=>'Outdoor'),
2=>array('mdNameVal'=>$crh->{'AV - TV'}!="" ? $crh->{'AV - TV'}:'','mdName'=>'AV-TV'),
3=>array('mdNameVal'=>$crh->{'AV - Radio'}!="" ? $crh->{'AV - Radio'}:'','mdName'=>'AV-Radio')
);
}else{
$mediaTabArray=$mediaArray;
$dynamicmname=array();
}
    //echo"<pre>";
    //print_r($fmStateSelectionData);
   // exit;
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
  return $result . "Rupees  " . $points;
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
<div class="card-body">
     <div class="table-responsive">
     <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
     <thead>
      <tr>
            <td align="center" colspan="6"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                <p><strong>GOVERNMENT OF INDIA <br />
                        CENTRAL BUREAU OF  COMMUNICATION<br />
                        Ministry of Information & Broadcasting</strong><br />
                    Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <h3 align="center"><span>      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Online Media Request of Client </span>
               <span style="float:right">Dated : {{date('d/m/Y',strtotime($client_req_header->{'Request Date'})) }}</span></h3>
            </td>
           
        </tr>
    </thead>
    </table>
      <table class="table table-striped table-bordered table-hover order-list" id="myTable" width="100%">   
        <tbody>
        <tr>
                        <td><strong>Ministry Head</strong></td>
                        <td width="10px"><strong>:</strong></td>
                        <td width="245px">{{@$mhead->{'Ministries Head'} ?@$mhead->{'Ministries Head'} :'N/A'}}, ({{@$dbresponse->ministry_name ? @$dbresponse->ministry_name :'N/A'}}) <br /> {{@$mhead->{'Head Name'} ?@$mhead->{'Head Name'} :'N/A'}}</td>
                        <td><strong>Officer Name</strong></td>
                        <td width="10px"><strong>:</strong></td>
                        <td width="245px">{{@$crh->{'Requesting officer Name'} ?ucwords(@$crh->{'Requesting officer Name'}) :'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Designation</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->{'Designation'} ?@$crh->{'Designation'} :'N/A' }}</td>
                        <td><strong>E-mail ID </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->{'Email Id'} ?@$crh->{'Email Id'} :'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Govt. E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->{'Govt E-mail ID'} ?@$crh->{'Govt E-mail ID'} :'N/A' }}</td>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->{'Mobile No_'} ?@$crh->{'Mobile No_'} :'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.(with STD code)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->{'Phone No_'} ?@$crh->{'Phone No_'} :'N/A'}}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->Address ?@$crh->Address :'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Department File. Ref. No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $crh->{'Client Refrence No_'} ?$crh->{'Client Refrence No_'} :'N/A' }}</td>
                        <td><strong>Campaign Type</strong></td>
                        <td ><strong>:</strong></td>
                        @php
                            $capi='';
                        if(@$crh->{'Campaign Type'} == 0 && @$crh->{'Campaign Type'} != "") {
                            $capi ='Single media';
                        }elseif(@$crh->{'Campaign Type'} == 1 && @$crh->{'Campaign Type'} != ""){
                            $capi ='Multiple media';
                        }else{
                            $capi='N/A';
                        }
                        @endphp
                        <td>{{$capi}}</td>
                    </tr><tr>
                        <td><strong>Media Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $mediaplantype =[]; @endphp
                        @foreach($mediaArray as  $key => $md)
                            @if(in_array( $md['mdNameVal'], str_replace(' ', '', $dynamicmname)))
                                @if($key !== 0) {{','}}
                                @endif
                                @php $mediaplantype[] =$md['mdName'];@endphp
                            @endif
                        @endforeach 
                        <td>
                            @foreach(@$mediaplantype as $key=>$mediaplantype)
                            @if($key !== 0) {{','}}
                            @endif
                            {{$mediaplantype}}
                            @endforeach
                        </td>
                        <td><strong>Campaign/Add Theme</strong></td>
                        <td ><strong>:</strong></td>
                        <td>{{ $crh->{'Subject'} ?$crh->{'Subject'} :'N/A' }}</td>
                         
                    </tr>
        
        @if(@$crh->Print == 0)
        
                        @else
        <tr>
            <td colspan="6">
            <hr /> 
            </td>
        </tr>
        <tr>
                <td><strong>Publication Start Date </strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ date('d/m/Y',strtotime(@$prch->{'Publication From Date'})) && date('d/m/Y',strtotime(@$prch->{'Publication From Date'}))!='01-01-1970'  ?date('d/m/Y',strtotime(@$prch->{'Publication From Date'})): 'N/A' }}</td>
                <td><strong>Publication End Date </strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ date('d/m/Y',strtotime(@$prch->{'Publication  To Date'})) && date('d/m/Y',strtotime(@$prch->{'Publication  To Date'}))!='01-01-1970' ?date('d/m/Y',strtotime(@$prch->{'Publication  To Date'})): 'N/A' }}</td>
                    
            </tr>
            <tr>
            
                <td><strong>Media Plan Type</strong></td>
                 <td><strong>:</strong></td>
                    @php 
                    $data ='';        
                    if(@$prch->{'Media Plan Type'} == 0 && @$prch->{'Media Plan Type'} != "" ){
                        $data ="Single Plan";
                    }elseif(@$prch->{'Media Plan Type'} == 1 && @$prch->{'Media Plan Type'} != "" ){
                        $data ="Multiple Plan"; 
                    }else{
                        $data ='N/A';
                    }
                    @endphp
                
                    <td>{{ $data }} </td> 
        <td><strong>Print Size Selection</strong></td>
                <td><strong>:</strong></td>
        @php 
        $print_size ='';
        if(@$prch->{'Print Size Selection'} ==0 && @$prch->{'Print Size Selection'} != ""  ){
            $print_size ="Custom size";
        }elseif(@$prch->{'Print Size Selection'} ==1 && @$prch->{'Print Size Selection'} != ""){
            $print_size ="Half Page Horizontal";
        }elseif(@$prch->{'Print Size Selection'} ==2 && @$prch->{'Print Size Selection'} != ""){
            $print_size ="Full Page";
        }elseif(@$prch->{'Print Size Selection'} ==3 && @$prch->{'Print Size Selection'} != "" ){
            $print_size ="Half Page Vertical";
        }elseif(@$prch->{'Print Size Selection'} ==4 && @$prch->{'Print Size Selection'} != ""){
            $print_size ="Quarter Page";
        }else{
            $print_size ='N/A';
        }
        @endphp
        <td >{{ $print_size }} </td>   
    </tr>
        <tr>  
                <td><strong>Advertise Length(Cm.)</strong></td>
                    <td><strong>:</strong></td>
                    
                    <td >{{$Length ?$Length :'N/A'}}</td>
                <td><strong>Advertise Breadth(Cm.)</strong></td>
                    <td><strong>:</strong></td>
                    
                    <td >{{$Breadth ?$Breadth :'N/A'}}</td>  
            </tr>
            <tr>
                <td><strong>Advertise Area(Sq Cm)</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ $SizeofAdvt ?$SizeofAdvt :'N/A'}}</td>
                <td><strong>Color Type</strong></td>
                    <td><strong>:</strong></td>
                    @php
                    $Colorp ='';
                   if(@$prch->{'Color'} ==0 && @$prch->{'Color'} != ""){$Colorp ="Color";}
                   elseif(@$prch->{'Color'} ==1 && @$prch->{'Color'} != ""){$Colorp ="B/W";}
                   else{$Colorp ='N/A';}
                   @endphp
                    <td >{{ $Colorp }}</td>
            </tr>
           <tr>

                     <td><strong>Budget(In Numbers)</strong></td>
                    <td><strong>:</strong></td>
                    @php $number = round(@$prch->{'Print Budget'}); @endphp
                    <td>@if(round(@$prch->{'Print Budget'}) && round(@$prch->{'Print Budget'})!=0) 
                       {{moneyFormatIndia($number)}}
                       @else
                       N/A
                       @endif
                    </td>
                    <td><strong>Budget(In Words)</strong></td>
                    <td><strong>:</strong></td>
                    @php $number = round(@$prch->{'Print Budget'}); @endphp
                    <td>@if(round(@$prch->{'Print Budget'}) && round(@$prch->{'Print Budget'})!=0) 
                       {{"(".convertNumber($number).")"}}
                       @else
                       N/A
                       @endif
                    </td>
                   </tr> <tr>
                    <td><strong>Target Area</strong></td>
                    <td><strong>:</strong></td>
                    @php
                    $target_area ='';
                    if(@$prch->{'Target Area'} ==0 && @$prch->{'Target Area'} != ""){
                        $target_area ="Pan India";
                    }elseif(@$prch->{'Target Area'} ==1 && @$prch->{'Target Area'} != ""){
                        $target_area ="Individual State";
                    }elseif(@$prch->{'Target Area'} ==2 && @$prch->{'Target Area'} != ""){
                        $target_area ="Group of States";
                    }elseif(@$prch->{'Target Area'} ==3 && @$prch->{'Target Area'} != ""){
                        $target_area ="Cities";
                    }else{
                        $target_area ='N/A';
                    }
                    @endphp
                    <td>{{$target_area }}</td>

                    <td><strong>Newspaper Type</strong></td>
                    <td><strong>:</strong></td>
                        @php 
                        $data ='';        
                        if(@$prch->{'Newspaper Type'} == 0 && @$prch->{'Newspaper Type'} != "" ){
                            $data ="Daily";
                        }elseif(@$prch->{'Newspaper Type'} == 1 && @$prch->{'Newspaper Type'} != "" ){
                            $data ="Employment News"; 
                        }else{
                            $data ='N/A';
                        }
                        @endphp
                    
                        <td>{{ $data }} </td> 
            </tr>
            <tr>
            @if(@$prch->{'Target Area'} ==2 && @$prch->{'Target Area'} != "")
                <td><strong>Group of States</strong></td>
                    <td><strong>:</strong></td>
                    @php $pgroups =[]; @endphp
                    @foreach($states as $key => $state)
                    @if(in_array( $state->Code, str_replace(' ', '', $printStateSelectionData1)))
                    @php $pgroups[] = $state->Description; @endphp
                    @endif
                    @endforeach
                  <td> @foreach(@$pgroups as $key =>$pgsvalue)
            @if($key !== 0) {{','}}
            @endif
            {{$pgsvalue}}
            @endforeach  </td>
                    
            @elseif(@$prch->{'Target Area'} == 1 && @$prch->{'Target Area'} != "")
                <td><strong>Individual State</strong></td>
                    <td><strong>:</strong></td>
                    <td> @foreach($states as $key => $state)
                    @if(@$prch->{'State'} === $state->Code)
                  
                    {{$state->Description}}  
                    @endif
                    @endforeach</td>
            @elseif(@$prch->{'Target Area'} ==3 && @$prch->{'Target Area'} != "")
                
                    <!-- @php $City_Groups =''; @endphp             
                    @if(@$prch->{'City Groups'} ==0 && @$prch->{'City Groups'} != "") $City_Groups ="Metro";
                    @elseif(@$prch->{'City Groups'} ==1 && @$prch->{'City Groups'} != "") $City_Groups ="Capital" ;
                    @elseif(@$prch->{'City Groups'} ==2 && @$prch->{'City Groups'} != "" ) $City_Groups ="Class A";
                    @elseif(@$prch->{'City Groups'} ==3 && @$prch->{'City Groups'} != "") $City_Groups ="Class B";
                    @elseif(@$prch->{'City Groups'} ==4 && @$prch->{'City Groups'} != "") $City_Groups ="Class C";
                    @elseif(@$prch->{'City Groups'} ==5 && @$prch->{'City Groups'} != "") $City_Groups ="Random";
                    @else $City_Groups ='';
                    @endif -->
                    @if(@$prch->{'City Groups'} ==5 && @$prch->{'City Groups'} != "")
                    <td><strong>Random Cities</strong></td>
                    <td><strong>:</strong></td>
                    <td> @foreach(@$allCityData as  $key => $allCity)
                    @if(in_array($allCity->CityName,str_replace(' ', '',$printCitySelectionData1) ))
                    @php $allc =strtolower($allCity->CityName) @endphp
                    @if($key !== 0) {{','}}
                        @endif
                    {{ucwords($allc)}} 
                    @endif
                    @endforeach
                    </td> 
                    @else
                    
                    <td><strong>Group of Cities</strong></td>
                    <td><strong>:</strong></td> 
                    <td>   
                    @foreach($IndianCi as $indcity)
                    @if($indcity->{'City Class'} == @$prch->{'City Groups'})
                    @php $namecity = strtolower($indcity->{'Name'}) @endphp
                    {{ucwords($namecity) ?? 'N/A'}}  
                    @endif
                    @endforeach
                    </td>
                    @endif
            @else
         
            @endif
            @if(@$prch->{'Target Area'} !=0)
             <td><strong>Language(S/M)</strong></td>
                    <td><strong>:</strong></td>
                    @if(@$prch->{'Language'} == "0")
                    <td>Single</td>
                    @elseif(@$prch->{'Language'} == "1")
                    <td>Multiple</td>
                    @elseif(@$prch->{'Language'} == "2")
                    <td>Hindi & English</td>
                    @elseif(@$prch->{'Language'} == "3")
                    <td >State Language Preference</td>
                    @else
                    <td>N/A</td>
                    @endif
                @else
                <td><strong>Language(S/M)</strong></td>
                    <td><strong>:</strong></td>
                    @if(@$prch->{'Language'} == "0")
                    <td colspan="4">Single</td>
                    @elseif(@$prch->{'Language'} == "1")
                    <td colspan="4">Multiple</td>
                    @elseif(@$prch->{'Language'} == "2")
                    <td colspan="4">Hindi & English</td>
                    @elseif(@$prch->{'Language'} == "3")
                    <td colspan="4">State Language Preference</td>
                    @else
                    <td colspan="4">N/A</td>
                    @endif
                @endif    
            </tr> 
            <tr>
            @if(@$prch->{'Language'} == 0 && @$prch->{'Language'} != "")
                
                <td><strong>Single Language</strong></td>
                    <td><strong>:</strong></td>
                    <td colspan="4"> @php $i = 1; @endphp
                    @foreach($languages as  $key => $language)
                    @if(in_array( $language->Code, str_replace(' ', '', $langSelectionData1 )))
                    @if($key !== 0) {{','}}
                        @endif
                    {{$language->Name}} 
                    @endif
                   @php
                   $i++;
                   @endphp
                    @endforeach
                    </td>

            @elseif(@$prch->{'Language'} == "1" && @$prch->{'Language'} != "")
                <td ><strong>Multiple Language</strong></td>
                    <td><strong>:</strong></td>
                    @php $i = 1; @endphp
                    <td colspan="4">
                    @foreach($languages as $key => $language) 
                    @if(in_array( $language->Code, str_replace(' ', '', $langSelectionData1)))
                    @if($key !== 0) {{','}}
                        @endif
                     {{$language->Name}} 
                    @endif
                    @endforeach
                    </td>
            @elseif(@$prch->{'Language'} == 2 && @$prch->{'Language'} != "")
           
                <td><strong>Language Hindi & English</strong></td>
                    <td><strong>:</strong></td>
                   @php $hindi="Hindi"; $english ="English"; @endphp
                    <td colspan="4">{{$hindi}} ~ {{$english}}</td>
            @else
            @endif
            </tr>
            <tr>
            <td><strong>Demography</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ @$prch->{'Demography'} ? @$prch->{'Demography'} :'N/A' }}</td>
            <td><strong>No. of Plan</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{@$pcount ?@$pcount :'N/A' }}</td>
            </tr>
            <tr>
            <td><strong>Requirement(s)</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ @$prch->{'Requirement'}?@$prch->{'Requirement'} :'N/A'}}</td>
            <td><strong>Remarks for Revision</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ @$prch->{'Remarks'} ?@$prch->{'Remarks'} :'N/A'}}</td>
             </tr>
        <tr>
        <!-- <td><strong>Is creative available</strong></td>
        @php $creative_Avail =""; @endphp            <td><strong>:</strong></td>
        @if(@$prch->{'Creative Availability'} == 0 && @$prch->{'Creative Availability'} != "" ) $creative_Avail ="Available";
        @elseif(@$prch->{'Creative Availability'} == 1 && @$prch->{'Creative Availability'} != "") $creative_Avail ="Not Available";
        @elseif(@$prch->{'Creative Availability'} == 2 && @$prch->{'Creative Availability'} != "")
        $creative_Avail ="Creative to be developed by CBC";
        @elseif(@$prch->{'Creative Availability'} == 3 && @$prch->{'Creative Availability'} != "" )
        $creative_Avail ="Photographs Available";
        @else $creative_Avail ="";
        @endif
                    <td >{{$creative_Avail}}</td> -->
                    @if(@$prch->{'Creative Availability'} == 0 && @$prch->{'Creative Availability'} != '')
                    <td><strong>Creative Uploaded</strong></td>
                    <td><strong>:</strong></td> 
                    <td colspan="4">{{ (@$prch->{'Crative File Name'} !='')? "Yes" : "N/A" }} </td>  
                 @endif
            
                 
             </tr>
             <tr>
             <td><strong>Advertisement Display Type</strong></td>
                    <td><strong>:</strong></td> 
            
                @if(@$prch->{'Advertisement Type'} == 0 && @$prch->{'Advertisement Type'} != "")
                 <td >Classified </td> 
                @elseif(@$prch->{'Advertisement Type'} == 1 && @$prch->{'Advertisement Type'} != "" )
                 <td >Display</td> 
                @elseif(@$prch->{'Advertisement Type'} == 2 && @$prch->{'Advertisement Type'} != "")
                <td >UPSC</td> 
                @else <td >N/A</td> 
                @endif
                 
             <td><strong>Highlight</strong></td>
                    <td><strong>:</strong></td> 
                    <td>{{@$prch->{'Highlight'} ?@$prch->{'Highlight'} :'N/A'}}</td> 
             </tr>
        
         
        @endif
        
        @if($crh->Outdoor == 0)
@else
        <tr>
            <td colspan="6">
            <hr />
            </td>
        </tr>
<tr>
    <td><strong>Publication Start Date </strong></td>
        <td><strong>:</strong></td>
        
        <td >{{ date('d/m/Y',strtotime(@$codm[0]->{'From Date'})) && date('d/m/Y',strtotime(@$codm[0]->{'From Date'}))!='01-01-1970'  ? date('d/m/Y',strtotime(@$codm[0]->{'From Date'})) : 'N/A' }}</td>
    <td><strong>Publication End Date </strong></td>
        <td><strong>:</strong></td>
        <td >{{ date('d/m/Y',strtotime(@$codm[0]->{'To Date'})) && date('d/m/Y',strtotime(@$codm[0]->{'To Date'}))!='01-01-1970' ?date('d/m/Y',strtotime(@$codm[0]->{'To Date'})): 'N/A'}}</td>
</tr>
<tr>
    <td><strong>Budget (In Numbers)</strong></td>
        <td><strong>:</strong></td>
        @php $Outdoorbud = round(@$codm[0]->{'OD Budget'}) @endphp
        <td>@if(round(@$codm[0]->{'OD Budget'}) && round(@$codm[0]->{'OD Budget'})!=0) 
            {{moneyFormatIndia($Outdoorbud)}} @else {{'N/A'}} @endif</td>
            <td><strong>Budget (In Words)</strong></td>
        <td><strong>:</strong></td>
        @php $Outdoorbud = round(@$codm[0]->{'OD Budget'}) @endphp
        <td>@if(round(@$codm[0]->{'OD Budget'}) && round(@$codm[0]->{'OD Budget'})!=0) 
             {{"(".convertNumber($Outdoorbud).")"}} @else {{'N/A'}} @endif</td>
</tr>
@foreach(@$codm as $key=>$codmDetail)
<tr>
    <td><strong>Media Category</strong></td>
        <td><strong>:</strong></td>
        @if(@$codmDetail->{'Category Group'} ==0 && @$codmDetail->{'Category Group'} != "")<td  >Airport</td>
        @elseif(@$codmDetail->{'Category Group'} ==1 && @$codmDetail->{'Category Group'} != "")
        <td >Railways</td>
        @elseif(@$codmDetail->{'Category Group'} ==2 && @$codmDetail->{'Category Group'} != "") <td >Road side </td>
        @elseif(@$codmDetail->{'Category Group'} ==3 && @$codmDetail->{'Category Group'} != "") <td >Transit Media </td>
        @elseif(@$codmDetail->{'Category Group'} ==4 && @$codmDetail->{'Category Group'} != "") <td >Others</td>
        @elseif(@$codmDetail->{'Category Group'} ==5 && @$codmDetail->{'Category Group'} != "") <td >Metro</td>
        @elseif(@$codmDetail->{'Category Group'} ==6 && @$codmDetail->{'Category Group'} != "") <td >Bus & Station</td>
        @else <td >N/A</td>
        @endif
    <td><strong>Target Area</strong></td>
        <td><strong>:</strong></td>
            @if(@$codmDetail->{"Target Area"} ==0 && @$codmDetail->{"Target Area"} != "" ) 
            <td >Pan India</td>
            @elseif(@$codmDetail->{"Target Area"} ==1 && @$codmDetail->{"Target Area"} != "") 
            <td >Individual State</td>
            @elseif(@$codmDetail->{"Target Area"} ==2 && @$codmDetail->{"Target Area"} != "") 
            <td >Group States</td>
            @elseif(@$codmDetail->{"Target Area"} ==3 && @$codmDetail->{"Target Area"} != "") 
            <td >Group City</td>
            @elseif(@$codmDetail->{"Target Area"} ==4 && @$codmDetail->{"Target Area"} != "") 
            <td >City/Town</td>
           <!--  @else <td>N/A</td> -->
            @endif      
    </tr>
    <tr>
@if(@$codmDetail->{"Target Area"} ==2 && @$codmDetail->{"Target Area"} != "")

    <td><strong>Group of States</strong></td>
        <td><strong>:</strong></td>
        
            @php $Groupstate =[]; @endphp
        @foreach($states as $key => $state)
        @if(in_array( $state->Code, str_replace(' ', '', explode(',', @$codmDetail->{'Multiple StateName'}) ))) 
    
        @php  $Groupstate[] = $state->Description; @endphp
        @endif
        @endforeach
        <td colspan="4" width="500px">
            @foreach(@$Groupstate as $key =>$gsvalue)
            @if($key !== 0) {{','}}
            @endif
            {{$gsvalue}}
            @endforeach
        </td>
@elseif(@$codmDetail->{"Target Area"} ==3 && @$codmDetail->{"Target Area"} != "")
    <td><strong>Group of Cities</strong></td>
        <td><strong>:</strong></td>
        <!-- @if(@$codmDetail->{"City Groups"} ==0 && @$codmDetail->{"City Groups"} != "") <td colspan="4">Metro</td>
        @elseif(@$codmDetail->{"City Groups"} ==1 && @$codmDetail->{"City Groups"} != "") 
        <td colspan="4">Capital</td>
        @elseif(@$codmDetail->{"City Groups"} ==2 && @$codmDetail->{"City Groups"} != "")
        <td colspan="4">lass A</td>
        @elseif(@$codmDetail->{"City Groups"} ==3 && @$codmDetail->{"City Groups"} != "") 
        <td colspan="4">Class B</td>
        @elseif(@$codmDetail->{"City Groups"} ==4 && @$codmDetail->{"City Groups"} != "") 
        <td colspan="4">Class C</td>
        @elseif(@$codmDetail->{"City Groups"} ==5 && @$codmDetail->{"City Groups"} != "") 
        <td colspan="4">Random</td>
        @else <td colspan="4"></td>
        @endif -->
        <td colspan="4" width="500px">
        @foreach($IndianCi as $key => $indcity)
        @if($indcity->{'City Class'} == @$codmDetail->{"City Groups"})
        @php $namecity = strtolower($indcity->{'Name'}) @endphp

        @if($key !== 0) {{','}}
        @endif
        {{ucwords($namecity) ?ucwords($namecity) :'N/A'}}
        @endif
        @endforeach
        </td>

@elseif(@$codmDetail->{"Target Area"} ==1 && @$codmDetail->{"Target Area"} != "") 

    <td><strong>Individual State</strong></td>
        <td><strong>:</strong></td>
        <td colspan="4" width="500px">
        @foreach($states as $key => $state)
        @if(@$codmDetail->{'State'} == $state->Code )
        {{$state->Description}} 
        @endif
        @endforeach     
        </td>
@elseif(@$codmDetail->{"Target Area"} ==4 && @$codmDetail->{"Target Area"} != "")
    <td><strong>City</strong></td>
        <td><strong>:</strong></td>
        <td colspan="4" width="500px">{{$codmDetail->{'City'} ?? 'N/A'}} </td>
@elseif(@$codmDetail->{"Target Area"} ==0 && @$codmDetail->{"Target Area"} != "")

@endif 
</tr>  
@endforeach
<tr>
    <td><strong>Requirements</strong></td>
        <td><strong>:</strong></td>
        <td colspan="4">{{@$codm[0]->{'Requirement'} ?@$codm[0]->{'Requirement'} :'N/A'}}</td>
 </tr>
 <tr>
    <td><strong>Remarks</strong></td>
        <td><strong>:</strong></td>
        <td colspan="4">{{@$codm[0]->{'Remarks'} ?@$codm[0]->{'Remarks'} :'N/A'}}</td>
 </tr>
<tr>
<td><strong>Creative Uploaded</strong></td>
        <td><strong>:</strong></td>
@if(@$codm[0]->{'Creative Availability'} == 0 && @$codm[0]->{'Creative Availability'} != "")
    
        <td >{{ @$codm[0]->{'Creative File Name'} !='' ? 'Yes':'N/A' }}</td>
@else 
<td >N/A</td>
@endif
    <td><strong>Language</strong></td>
        <td><strong>:</strong></td>
        @if(@$codm[0]->{'Language'} == 0 && @$codm[0]->{'Language'} != "") 
        <td>Hindi</td>
        @elseif(@$codm[0]->{'Language'} == 1 && @$codm[0]->{'Language'} != "")
        <td>English</td> 
        @else<td>N/A</td>
        @endif
</tr>
@endif
    @if(@$crh->{'AV - TV'} == 0)  
    @else  
    <tr>
        <td colspan="6">
        <hr />
        </td>
    </tr>  
    <tr>
            <td><strong>Publication Start Date</strong></td>
                <td><strong>:</strong></td>
                     <td >{{ date('d/m/Y',strtotime(@$tvcr->{'From Date'})) && date('d/m/Y',strtotime(@$tvcr->{'From Date'}))!='01-01-1970' ? date('d/m/Y',strtotime(@$tvcr->{'From Date'})) :'N/A' }}</td> 
            <td><strong>Publication End Date</strong></td>
                <td><strong>:</strong></td>
                     <td >{{ date('d/m/Y',strtotime(@$tvcr->{'To Date'})) && date('d/m/Y',strtotime(@$tvcr->{'To Date'}))!='01-01-1970' ? date('d/m/Y',strtotime(@$tvcr->{'To Date'})):'N/A' }}</td>  
        </tr>
        <tr>
            <td><strong>Target Area</strong></td>
                <td><strong>:</strong></td>
                    @if(@$tvcr->{'Target Area'} == "0" && @$tvcr->{'Target Area'} != "") 
                    <td colspan="4">PAN India</td>
                    @elseif(@$tvcr->{'Target Area'} == "1" && @$tvcr->{'Target Area'} != "") 
                    <td colspan="4">Specific Regional</td>
                    @elseif(@$tvcr->{'Target Area'} == "2" && @$tvcr->{'Target Area'} != "") 
                    <td colspan="4">Group Regional</td>
                    @else <td>N/A</td> 
                    @endif
        </tr>
        <tr>
        <td><strong>Budget (In Numbers)</strong></td>
                <td><strong>:</strong></td>
                @php $avtvbudget =round(@$tvcr->{'Allocated Budget'}); @endphp
                   <td >@if(round(@$tvcr->{'Allocated Budget'}) && round(@$tvcr->{'Allocated Budget'})!=0)  
                       {{moneyFormatIndia($avtvbudget)}}
                       @else {{'N/A'}} @endif</td> 

               <td><strong>Budget (In Words)</strong></td>
                <td><strong>:</strong></td>
                @php $avtvbudget =round(@$tvcr->{'Allocated Budget'}); @endphp
                   <td >@if(round(@$tvcr->{'Allocated Budget'}) && round(@$tvcr->{'Allocated Budget'})!=0)  
                      {{"(".convertNumber($avtvbudget).")"}}
                       @else {{'N/A'}} @endif</td>   
        </tr>
        <tr>
        @if(@$tvcr->{'Target Area'} == "1" && @$tvcr->{'Target Area'} != "" )
        
            <td><strong>Specific Regional</strong></td>
                <td><strong>:</strong></td>
                <td >
                @foreach($regionalLang as $key => $regionLang)
                @if(in_array( $regionLang->Code, str_replace(' ', '', $tvLangSelectionData ))) 
                @if($key !== 0) {{','}}
                @endif
                {{$regionLang->Name}} 
                @endif
                @endforeach
                </td>
        
        @elseif(@$tvcr->{'Target Area'} == "2" && @$tvcr->{'Target Area'} != "")
        
            <td><strong>Group Regional </strong></td>
                <td><strong>:</strong></td>
                <td>
                @php //dd($tvLangSelectionData); @endphp
                @foreach($regionalLang as $key => $regionLang)
                @if(in_array( $regionLang->Code, str_replace(' ', '', $tvLangSelectionData ))) 
                @if($key !== 0) {{','}}
                @endif
                {{$regionLang->Name}} 
                @endif
                @endforeach
                </td>
        @elseif(@$tvcr->{'Target Area'} == "0" && @$tvcr->{'Target Area'} != "")

        @endif
        @if(@$tvcr->{'Target Area'} == "0" && @$tvcr->{'Target Area'} != "")
            <td><strong>Duration(in seconds)</strong></td>
                <td><strong>:</strong></td>
               <td colspan="4">{{@$tvcr->{'Duration'} ?@$tvcr->{'Duration'} :'N/A'}}</td>
               @else
               <td><strong>Duration(in seconds)</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$tvcr->{'Duration'} ?@$tvcr->{'Duration'} :'N/A'}}</td>
               @endif
        </tr>
        <tr>
            <td><strong>Spots No.</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$tvcr->{'Spot Per Day'} ?@$tvcr->{'Spot Per Day'} :'N/A'}}</td>
        
            <td><strong>Genre</strong></td>
                <td><strong>:</strong></td>
                @if(@$tvcr->{'Genre Category'} =='0') <td> Both</td>
                @elseif(@$tvcr->{'Genre Category'} =='1') <td>GEC</td>
                @elseif(@$tvcr->{'Genre Category'} =='2') <td>Non-GEC</td>
                @else <td >N/A</td>
                @endif
        </tr>
        <tr>
            <td><strong>Requirement(s) (1000 characters max)</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$tvcr->{'Requirement'} ?@$tvcr->{'Requirement'} :'N/A'}}</td>
            <td><strong>Remarks (100 characters max)</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$tvcr->{'Remarks'} ?@$tvcr->{'Remarks'} :'N/A'}}</td>
        </tr>
        <tr>
            <!-- <td><strong>Is advertisement available</strong></td>
                <td><strong>:</strong></td>
                @if(@$tvcr->{'Creative Available'} == 0 && @$tvcr->{'Creative Available'} != "") 
                <td >Available</td>
                @elseif(@$tvcr->{'Creative Available'} == 1 && @$tvcr->{'Creative Available'} != "") <td >Not Available</td>
                @else <td ></td>
                @endif -->
       
            @if(@$tvcr->{'Creative Available'} == 0 && @$tvcr->{'Creative Available'} != "")        
      
            <td><strong>Creative Uploaded </strong></td>
                <td><strong>:</strong></td>
                <td colspan="4">{{ $tvcr->{'Creative File Name'} !='' ? 'Yes':'N/A' }}</td>
        
        @endif 
        </tr>        
    @endif
@if(@$crh->{'AV - Radio'} == 0)
    @else
    <tr>
        <td  colspan="6">
           <hr />
        </td>
    </tr>
    <tr>
            <td><strong>Publication Start Date</strong></td>
                <td><strong>:</strong></td>
                     <td >{{ date('d/m/Y',strtotime(@$crsRadiocr->{'From Date'})) && date('d/m/Y',strtotime(@$crsRadiocr->{'From Date'}))!='01-01-1970' ?date('d/m/Y',strtotime(@$crsRadiocr->{'From Date'})): 'N/A' }}</td> 
        
            <td><strong>Publication End Date</strong></td>
                <td><strong>:</strong></td>
                     <td >{{ date('d/m/Y',strtotime(@$crsRadiocr->{'To Date'})) && date('d/m/Y',strtotime(@$crsRadiocr->{'To Date'}))!='01-01-1970' ?date('d/m/Y',strtotime(@$crsRadiocr->{'To Date'})): 'N/A' }}</td>  
        </tr>    
        <tr>
            <td><strong>Advertisement Medium</strong></td>
                <td><strong>:</strong></td>
                    @if(@$crsRadiocr->{'Radio Type'} ==0 && @$crsRadiocr->{'Radio Type'} != "") 
                    <td >CRS</td>
                    @elseif(@$crsRadiocr->{'Radio Type'} ==1 && @$crsRadiocr->{'Radio Type'} != "") 
                    <td>Private FM</td>
                    @else <td>N/A</td> 
                    @endif
            <td><strong>Target Area</strong></td>
                <td><strong>:</strong></td>
                    @if(@$crsRadiocr->{'Target Area'} == "0" && @$crsRadiocr->{'Target Area'} != "") 
                    <td >PAN India</td>
                    @elseif(@$crsRadiocr->{'Target Area'} == "1" && @$crsRadiocr->{'Target Area'} != "") 
                    <td >Specific Regional</td>
                    @elseif(@$crsRadiocr->{'Target Area'} == "2" && @$crsRadiocr->{'Target Area'} != "") 
                    <td >Group Regional</td>
                    @else <td></td>
                    @endif              
        </tr>
        <tr>
            <td><strong>Budget (In Numbers)</strong></td>
                <td><strong>:</strong></td>
                @php $radiobudget = round(@$crsRadiocr->{'Budget Amount'}); @endphp
               <td>@if(round(@$crsRadiocr->{'Budget Amount'}) && round(@$crsRadiocr->{'Budget Amount'})!=0) 
                   {{moneyFormatIndia($radiobudget)}} @else 
                   {{'N/A'}}@endif</td>
                
                <td><strong>Budget (In Words)</strong></td>
                <td><strong>:</strong></td>
                @php $radiobudget = round(@$crsRadiocr->{'Budget Amount'}); @endphp
               <td>@if(round(@$crsRadiocr->{'Budget Amount'}) && round(@$crsRadiocr->{'Budget Amount'})!=0) 
                   {{"(".convertNumber($radiobudget).")"}}@else 
                   {{'N/A'}}@endif</td>
                 
        </tr>
        <tr>
        @if(@$crsRadiocr->{'Target Area'} == "1" && @$crsRadiocr->{'Target Area'} != "")
            <td><strong>State</strong></td>
                <td><strong>:</strong></td>
                <td colspan="4"> {{$fmStateSelectionData ?? ''}}</td>
        @elseif(@$crsRadiocr->{'Target Area'} == "2" && @$crsRadiocr->{'Target Area'} != "") 
            <td><strong>City</strong></td>
                <td><strong>:</strong></td>
                @php $radiocitysta =strtolower($fmCitySelectionData);@endphp 
                <td colspan="4" class="cap">{{$radiocitysta ?? ''}}
                </td>
             @elseif(@$crsRadiocr->{'Target Area'} == "3" && @$crsRadiocr->{'Target Area'} != "") 
            <td><strong>State</strong></td>
                <td><strong>:</strong></td>
                <td colspan="" > {{$fmStateSelectionData ?? ''}} 
                </td>
                <td><strong>City</strong></td>
                <td><strong>:</strong></td>
                @php $radiocity =strtolower($fmCitySelectionData);@endphp 
                <td colspan="" class="cap">  {{$radiocity ?? ''}}
                </td>
        @elseif(@$crsRadiocr->{'Target Area'} == "0" && @$crsRadiocr->{'Target Area'} != "") 
        @else
        @endif
        </tr>
        <tr>
        <td><strong>Duration(in Seconds)</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$crsRadiocr->{'Duration(Sec)'} ?@$crsRadiocr->{'Duration(Sec)'} :'N/A'}}</td>
            <td><strong>Spots No.</strong></td>
                <td><strong>:</strong></td>
               <td >{{ @$crsRadiocr->spots ?@$crsRadiocr->spots :'N/A'}}</td>
        </tr>
        <tr>
        <td><strong>Requirement(s) (1000 characters max)</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$crsRadiocr->{'Requirement'} ?@$crsRadiocr->{'Requirement'} :'N/A'}}</td>
                <td><strong> Remarks (100 characters max) </strong></td>
                <td><strong>:</strong></td>
               <td >{{@$crsRadiocr->{'Remarks'} ?@$crsRadiocr->{'Remarks'} :'N/A'}}</td>
        </tr>
        <!-- <td><strong>Is advertisement available</strong></td>
                <td><strong>:</strong></td>
                @if(@$crsRadiocr->{'Creative Available'} == 0 && @$crsRadiocr->{'Creative Available'} != "") 
                <td>Available</td>
                @elseif(@$crsRadiocr->{'Creative Available'} == 1 && @$crsRadiocr->{'Creative Available'} != "") <td>Not Available</td>
                @else <td ></td>
                @endif -->
                @if(@$crsRadiocr->{'Creative Available'} == 0 && @$crsRadiocr->{'Creative Available'} != "")  
                <tr> 
                <td><strong>Creative Uploaded</strong></td>
                <td><strong>:</strong></td>
                <td colspan="4"> {{ $crsRadiocr->{'Creative File Name'} !='' ? 'Yes':'N/A'}}</td>
                </tr>
                @endif
        @endif
          </tbody>
        </table>
    
      </div>
    
    </div>
</body>

</html>