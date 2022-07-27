<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>AVTV Application Receipt</title>
    <style>
        /* body{
            text-transform:capitalize;
        } */
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

@endphp
<body>
<div class="card-body">
     <div class="table-responsive">
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
    </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td ><strong>Profile Photo</strong></td>
                        <td ><strong>:</strong></td>
                        <td colspan="4">
                            <div style="width:100px; height:100px; border:solid 1px #000;"></div>
                        </td>
                    </tr>
                    <tr>

                        <td ><strong>Agency Name</strong></td>
                        <td ><strong>:</strong></td>
                        <td>{{$OD_owners->{'Owner Name'} ?? '' }}</td>

                        <td><strong>E-mail ID </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Email ID'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Mobile No_'} ?? ''}}</td>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Phone No_'} ?$OD_owners->{'Phone No_'} :'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if($OD_owners->{'State'} !=''){{$Owner_State ?? ''}}@endif</td>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'District'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        @php $city = strtolower(@$OD_owners->{'City'});@endphp
                        <td>{{ucwords($city) ?? ''}}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Address 1'} ?? ''}}</td>
                    </tr>
                    <tr><td colspan="6"><hr /></td></tr>
                    <tr>
                        <td><strong>Name of Parent Company/Group</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Parent Company Name'} ?? ''}}</td>
                        <td><strong>Channel Name </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Channel Name'} ?? ''}}</td>
                    </tr>
                    @php

                        $Uplinking_Validity_Date = date('d/m/Y', strtotime(@$Chanal_Details->{'Uplinking Validity Date'}));
                        $U_V_D ='';
                        if($Uplinking_Validity_Date != '1970-01-01'){
                          $U_V_D  = $Uplinking_Validity_Date;
                          }else{
                          $U_V_D  ='';
                          }
                        @endphp
                    <tr>
                        <td><strong>Uplinking Valid Upto </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$U_V_D  ?? ''}}</td>

                    {{-- @php
                        $Downlinking_Validity_Date = date('d/m/Y', strtotime(@$Chanal_Details->{'Downlinking Validity Date'}));

                        $D_V_D ='';
                        if($Downlinking_Validity_Date != '1970-01-01'){
                          $D_V_D  = $Downlinking_Validity_Date;
                          }else{
                          $D_V_D  ='';
                          }
                        @endphp --}}

                        @php
                        $Downlinking_Validity_Date =substr(@$Chanal_Details->{'Downlinking Validity Date'}, 0,10);
                        $D_V_D ='';
                        if($Downlinking_Validity_Date != '1970-01-01'){
                          $D_V_D  = $Downlinking_Validity_Date;
                          }else{
                          $D_V_D  ='';
                          }
                          $format_date = date('d/m/Y',strtotime($D_V_D));
                        @endphp

                        <td><strong>Downlinking Valid Upto </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{  $D_V_D  ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>EMMC License No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'EMMC License No_'} ?? '' }}</td>


                    {{-- @php
                        $EMMC_Date = date('d/m/Y', strtotime(@$Chanal_Details->{'EMMC Date'}));

                        $EM_DA ='';
                        if($EMMC_Date = '1753-01-01'){
                          $EM_DA  = $EMMC_Date;
                          }else{
                          $EM_DA  ='NA';
                          }
                      @endphp --}}

                      @php
                        $EMMC_Date =substr(@$Chanal_Details->{'EMMC Date'}, 0,10);
                        $EM_DA ='';
                        if($EMMC_Date != '1970-01-01' && $EMMC_Date != '1900-01-01'){
                            $EM_DA  = $EMMC_Date;
                            }else{
                            $EM_DA  ='';
                        }
                      @endphp

                        <td><strong>EMMC Date </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $EM_DA ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Regional/Language of Classification (In Case of Regional Channel)</strong></td>
                        <td><strong>:</strong></td>
                        @if(count($getlang) > 0)
                        @foreach($getlang as $stdata)
                           @if(@$Chanal_Details->{'Regional_Language Type'} == $stdata['Code'])
                           <td>{{$stdata['Name']}}</td>
                           @endif
                        @endforeach
                      @endif
                        {{-- <td>@if($Chanal_Details->{'Regional_Language Type'}){{ $getlang ?? ''}}@endif</td> --}}
                        <td><strong>Legal status of company</strong></td>
                        <td><strong>:</strong></td>
                        @php
                            $legal ='';
                            if($Chanal_Details->{'Company Legal Status'} == 1){
                                $legal ='Pvt.';
                            }elseif($Chanal_Details->{'Company Legal Status'} == 2) {
                                $legal ='Ltd.';
                            }elseif($Chanal_Details->{'Company Legal Status'} == 3){
                                $legal ='Others';
                            }else{
                                $legal ='';
                            }

                            @endphp
                        <td>{{  $legal ?? '' }}</td>
                    </tr>
                    <tr>
                        <td ><strong>Director/CEO/Head of Company /Channel</strong></td>
                        <td ><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Channel Director_CEO'} ?? '' }}</td>
                        <td><strong>Launch of Month </strong></td>
                        <td><strong>:</strong></td>
                        @php
                        $months ='';
                        if($Chanal_Details->{'Launch Month'} == 1){$months ='January';}
                        elseif($Chanal_Details->{'Launch Month'} == 2){$months ='February';}
                        elseif($Chanal_Details->{'Launch Month'} == 3){$months ='March';}
                        elseif($Chanal_Details->{'Launch Month'} == 4){$months ='April';}
                        elseif($Chanal_Details->{'Launch Month'} == 5){$months ='May';}
                        elseif($Chanal_Details->{'Launch Month'} == 6){$months ='June';}
                        elseif($Chanal_Details->{'Launch Month'} == 7){$months ='July';}
                        elseif($Chanal_Details->{'Launch Month'} == 8){$months ='August';}
                        elseif($Chanal_Details->{'Launch Month'} == 9){$months ='September';}
                        elseif($Chanal_Details->{'Launch Month'} == 10){$months ='October';}
                        elseif($Chanal_Details->{'Launch Month'} == 11){$months ='November';}
                        elseif($Chanal_Details->{'Launch Month'} == 12){$months ='December';}
                        else{$months ='';}
                        @endphp
                        <td>{{ $months ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Launch of Year </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Launch Year'} ?? '' }}</td>
                        <td><strong>Genre of Channel </strong></td>
                        <td><strong>:</strong></td>
                        @php
                        $Genre ='';
                        if($Chanal_Details->{'Channel Genre'} == 1){
                           $Genre ='NON-GEC';
                        }else{
                            $Genre ='GEC';
                        }
                        @endphp
                        <td>{{ $Genre ?? ''}}</td>
                    </tr>
                    <tr>
                    @php
                        $Strimg_start = date('d/m/Y', strtotime(@$Chanal_Details->{'Streaming Start Date'}));
                        $streaming ='';
                        if($Strimg_start != '1970-01-01'){
                          $streaming  = $Strimg_start;
                          }else{
                          $streaming  ='';
                          }
                      @endphp
                        <td><strong>Streaming Start Date</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $streaming ?? '' }}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>State </strong></td>
                        <td><strong>:</strong></td>
                        <td>@if($Chanal_Details->{'DO State'} != ''){{ $DO_State ?? '' }}@endif</td>
                        <td><strong>District </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO District'} }}</td>
                    </tr>

                        <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        @php $docity = strtolower(@$Chanal_Details->{'DO City'}); @endphp
                        <td>{{ ucwords($docity) ?? '' }}</td>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO Mobile No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO E-Mail'} ?? '' }}</td>
                        <td><strong>Landline No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO Landline No_(with STD)'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'HO Address'} ?? '' }}</td>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if($Chanal_Details->{'HO State'} !=''){{$HO_State ?? '' }}@endif</td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'HO District'} }}</td>
                        <td><strong>City</strong></td>
                        @php $hocity = strtolower(@$Chanal_Details->{'HO City'}); @endphp
                        <td><strong>:</strong></td>
                        <td>{{ ucwords($hocity) ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'HO Mobile No_'} ?? '' }}</td>
                        <td><strong>E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'HO E-Mail'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Landline No.</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{ $Chanal_Details->{'HO Landline No_(with STD)'} ?? '' }}</td>
                    </tr>
                    <tr><td colspan="6"><hr /></td></tr>
                    <tr>
                        <td><strong>Bank Account Number for Receiving Payment</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Account No_'} ?? '' }}</td>
                        <td><strong>Account Holder Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$Chanal_Details->{'A_C Holder Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'IFSC Code'} ?? '' }}</td>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Bank Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Bank Branch'} ?? '' }}</td>
                        <td><strong>Address of Account</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Bank A_C Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>PAN Card No.</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{ $Chanal_Details->{'PAN'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>GST No.</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{ $Chanal_Details->{'GST No_'} ?? ''}}</td>
                    </tr>
                    <tr><td colspan="6">ESI Account Details</td></tr>
                    <tr>
                        <td ><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'ESI A_C No_'} ? $Chanal_Details->{'ESI A_C No_'} :'N/A'}}</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$Chanal_Details->{'ESI - No_ Of Employee'} !=0 ? @$Chanal_Details->{'ESI - No_ Of Employee'} : 'N/A' }}</td>
                    </tr>
                    <tr><td colspan="6">EPF Account Details</td></tr>
                    <tr>
                        <td ><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'EPF A_C No_'} ? $Chanal_Details->{'EPF A_C No_'} :'N/A'}}</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$Chanal_Details->{'EPF - No_ Of Employee'} !=0 ? @$Chanal_Details->{'EPF - No_ Of Employee'} : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <h3><strong>Uploaded Documents</strong></h3>
                        </td>
                    </tr>
                    <tr>
                        <td ><strong>Uplinking & Downlinking certificate of the channel</strong></td>
                        <td ><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Linking Certificate File Name'} != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>EMMC certificate telecasting over the last 6 months </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'EMMC File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Fixed point chart (FPC) for the previous 6 months from 6AM to 11PM, during which the channel operated</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$Chanal_Details->{'FP Chart File Name'} != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>Scan Copy of Cancelled Cheque</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$Chanal_Details->{'Cancelled Cheque File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Teleport operator certificate</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'TOC File Name'} != '' ? 'Yes' : 'No' }}</td>
                        <td><strong>Last year's certificate duly signed by the Auditor /Company</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Auditor File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>A letter attested by senior management level executive,giving name, designation & signatures</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'SMA File Name'} != '' ? 'Yes' : 'No' }}</td>
                        <td><strong>A letter indicating whether or not the channel would be able to provide a third party certification of the advertisement telecast for DAVP/ Government of india</strong>
                        </td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'TPC File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>A signed list of the different C&S. TV channel in the Group/Holding Company/ Company to which the applicant channel belongs to</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DC&SL File Name'} != '' ? 'Yes' : 'No' }}</td>
                        <td><strong>I confirm that all the information given by me is true and nothing has been concealed</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$Chanal_Details->{'Self-declaration'} == 1 ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr style="border:none !important;">
                        <td  colspan="6" height="80px">
                        <h3 align="left">I confirm that all the information given by me is true and nothing has been concealed</h3>
                        <p align="right" style="margin-top:100px">Authorized Signatory / Signature</p></td>
                    </tr>
                </table>

    </div>
</div>
</body>

</html>
