<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Pvt. FM Application Receipt</title>
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
/*
 font-size:1200px;*/
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
            <td align="center"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80" colspan="6">
                <p><strong>GOVERNMENT OF INDIA <br />
                        CENTRAL BUREAU OF  COMMUNICATION<br />
                        Ministry of Information & Broadcasting</strong><br />
                    Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                </p>
            </td>
        </tr>
        </table>

                <table width="100%" >
                    <!-- <tr>
                        <td><strong>Profile Photo</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">
                            <div style="width:100px; height:100px; border:solid 1px #000;"></div>
                        </td>
                    </tr> -->
                    <tr>
                        <td><strong>Agency Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $Owner_Name = strtolower($OD_owners->{'Owner Name'}) @endphp 
                        <td>{{ucwords($Owner_Name) ?? '' }}</td>
                        <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Email ID'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Mobile No_'} ?? ''}}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Address 1'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if( $OD_owners->{'State'} !=''){{ $Owner_State ?? ''}}@endif</td>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'District'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>@php @$owcity = strtolower(@$OD_owners->{'City'}) @endphp {{ucwords(@$owcity) ?? ''}}</td>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Phone No_'} ? $OD_owners->{'Phone No_'} :'N/A' }}</td>
                    </tr>
                    <tr><td colspan="6"><hr /></td></tr>
                    <tr>
                        <td><strong>FM Station Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'FM Station Name'} ?? ''}}</td>
                        <td><strong>Broadcast City </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Broadcast City'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Company Belongs To</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Media Group'} }}</td>
                        <td><strong>Language of Broadcast</strong></td>
                        <td><strong>: @php //dd(@$getlang); @endphp</strong></td>
                        <td> @if(@$getlang > 0)
                        @foreach(@$getlang as $lag)
                        @if($FMdata->{'Language'} ==$lag['Code']){{$lag['Name'] ?? '' }}@endif
                        @endforeach
                        @endif</td>
                    </tr>
                    </table>
                    <table width="100%">
                    <tr><td colspan="6"><hr /></td></tr>
                    <tr>
                    <td colspan="2"><strong> Days <strong></td>
                    <td width="180px">Time Band 1</td>
                    <td colspan="2">Time Band 2</td>
                    <td width="180px">Time Band 3</td>
                    </tr>
                    <tr>
                    <td colspan="2"><strong>Monday</strong></td>
                    @php
                    $Mon_TB1_From =substr(@$Time_band->{'Mon TB1 From'}, 11,8);
                    $m_tb1_f ='';
                    if($Mon_TB1_From != '00:00:00.000'){
                        $m_tb1_f = $Mon_TB1_From;
                        }else{
                        $m_tb1_f ='';
                        }

                    @endphp
                    @php
                    $Mon_TB1_To =substr(@$Time_band->{'Mon TB1 To'}, 11,8);
                    $m_tb1_t ='';
                    if($Mon_TB1_To != '00:00:00.000'){
                        $m_tb1_t = $Mon_TB1_To;
                        }else{
                        $m_tb1_t ='';
                        }

                    @endphp
                    <td>{{ date('h:i:s A',strtotime($m_tb1_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($m_tb1_t)) ?? ''}}</td>
                    @php
                        $Mon_TB2_From =substr(@$Time_band->{'Mon TB2 From'}, 11,8);
                        $m_tb2_f ='';
                        if($Mon_TB2_From != '00:00:00.000'){
                            $m_tb2_f = $Mon_TB2_From;
                            }else{
                            $m_tb2_f ='';
                            }
                        @endphp

                    @php
                    $Mon_TB2_To =substr(@$Time_band->{'Mon TB2 To'}, 11,8);
                    $m_tb2_t ='';
                    if($Mon_TB2_From != '00:00:00.000'){
                        $m_tb2_t = $Mon_TB2_To;
                        }else{
                        $m_tb2_t ='';
                        }

                    @endphp
                    <td colspan="2">{{ date('h:i:s A',strtotime($m_tb2_f)) ?? ''}} ~ {{ date('h:i:s A',strtotime($m_tb2_t)) ?? ''}}</td>
                    @php
                    $Mon_TB3_From =substr(@$Time_band->{'Mon TB3 From'}, 11,8);
                    $m_tb3_f ='';
                    if($Mon_TB3_From != '00:00:00.000'){
                        $m_tb3_f = $Mon_TB3_From;
                        }else{
                        $m_tb3_f ='';
                        }
                    @endphp
                    @php
                    $Mon_TB3_To =substr(@$Time_band->{'Mon TB3 To'}, 11,8);
                    $m_tb3_t ='';
                    if($Mon_TB3_To != '00:00:00.000'){
                        $m_tb3_t = $Mon_TB3_To;
                        }else{
                        $m_tb3_t ='';
                        }
                    @endphp
                    <td>{{ date('h:i:s A',strtotime($m_tb3_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($m_tb3_t)) ?? ''}}</td>
                    </tr>
                    <!---Tuesday time band -->
                    <tr>
                    <td colspan="2"><strong>Tuesday</strong></td>
                    @php
                    $Tue_TB1_From =substr(@$Time_band->{'Tue TB1 From'}, 11,8);
                    $t_tb1_f ='';
                    if($Tue_TB1_From != '00:00:00.000'){
                        $t_tb1_f = $Tue_TB1_From;
                        }else{
                        $t_tb1_f ='';
                        }
                    @endphp
                    @php
                    $Tue_TB1_To =substr(@$Time_band->{'Tue TB1 To'}, 11,8);
                    $t_tb1_t ='';
                    if($Tue_TB1_To != '00:00:00.000'){
                        $t_tb1_t = $Tue_TB1_To;
                        }else{
                        $t_tb1_t ='';
                        }
                    @endphp
                    <td>{{ date('h:i:s A',strtotime($t_tb1_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($Tue_TB1_To)) ?? ''}}</td>
                    @php
                        $Tue_TB2_From =substr(@$Time_band->{'Tue TB2 From'}, 11,8);
                        $t_tb2_f ='';
                        if($Tue_TB2_From != '00:00:00.000'){
                            $t_tb2_f = $Tue_TB2_From;
                            }else{
                            $t_tb2_f ='';
                            }

                        @endphp
                    @php
                    $Tue_TB2_To =substr(@$Time_band->{'Tue TB2 To'}, 11,8);
                    $t_tb2_t ='';
                    if($Tue_TB2_To != '00:00:00.000'){
                        $t_tb2_t = $Tue_TB2_To;
                        }else{
                        $t_tb2_t ='';
                        }

                    @endphp
                    <td colspan="2">{{date('h:i:s A',strtotime($t_tb2_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($t_tb2_t)) ?? ''}}</td>
                    @php
                    $Tue_TB3_From =substr(@$Time_band->{'Tue TB3 From'}, 11,8);
                    $t_tb3_f ='';
                    if($Tue_TB3_From != '00:00:00.000'){
                        $t_tb3_f = $Tue_TB3_From;
                        }else{
                        $t_tb3_f ='';
                        }
                    @endphp
                    @php
                    $Tue_TB3_To =substr(@$Time_band->{'Tue TB3 To'}, 11,8);
                    $t_tb3_t ='';
                    if($Tue_TB3_To != '00:00:00.000'){
                        $t_tb3_t = $Tue_TB3_To;
                        }else{
                        $t_tb3_t ='';
                        }

                    @endphp
                    <td>{{ date('h:i:s A',strtotime($t_tb3_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($t_tb3_t)) ?? ''}}</td>
                    </tr>

                    <!-- Wednesday time band -->
                    <tr>
                    <td colspan="2"><strong>Wednesday</strong></td>
                    @php
                    $Wed_TB1_From =substr(@$Time_band->{'Wed TB1 From'}, 11,8);
                    $w_tb1_f ='';
                    if($Wed_TB1_From != '00:00:00.000'){
                        $w_tb1_f = $Wed_TB1_From;
                        }else{
                        $w_tb1_f ='';
                        }
                    @endphp
                    @php
                    $Wed_TB1_To =substr(@$Time_band->{'Wed TB1 To'}, 11,8);
                    $w_tb1_t ='';
                    if($Wed_TB1_To != '00:00:00.000'){
                        $w_tb1_t = $Wed_TB1_To;
                        }else{
                        $w_tb1_t ='';
                        }

                    @endphp
                    <td>{{ date('h:i:s A',strtotime($w_tb1_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($w_tb1_t)) ?? ''}}</td>
                    @php
                    $Wed_TB2_From =substr(@$Time_band->{'Wed TB2 From'}, 11,8);
                    $w_tb2_f ='';
                    if($Wed_TB2_From != '00:00:00.000'){
                        $w_tb2_f = $Wed_TB2_From;
                        }else{
                        $w_tb2_f ='';
                        }

                    @endphp
                    @php
                    $Wed_TB2_To =substr(@$Time_band->{'Wed TB2 To'}, 11,8);
                    $w_tb2_t ='';
                    if($Wed_TB2_To != '00:00:00.000'){
                        $w_tb2_t = $Wed_TB2_To;
                        }else{
                        $w_tb2_t ='';
                        }

                    @endphp
                    <td colspan="2">{{date('h:i:s A',strtotime($w_tb2_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($w_tb2_t)) ?? ''}}</td>
                    @php
                    $Wed_TB3_From =substr(@$Time_band->{'Wed TB3 From'}, 11,8);
                    $w_tb3_f ='';
                    if($Wed_TB3_From != '00:00:00.000'){
                        $w_tb3_f = $Wed_TB3_From;
                        }else{
                        $w_tb3_f ='';
                        }
                    @endphp
                    @php
                    $Wed_TB3_To =substr(@$Time_band->{'Wed TB3 To'}, 11,8);
                    $w_tb3_t ='';
                    if($Wed_TB3_To != '00:00:00.000'){
                        $w_tb3_t = $Wed_TB3_To;
                        }else{
                        $w_tb3_t ='';
                        }
                    @endphp
                    <td>{{ date('h:i:s A',strtotime($w_tb3_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($w_tb3_t)) ?? ''}}</td>
                    </tr>
                    <!------- Thursday ------->
                    <tr>
                    <td colspan="2"><strong>Thursday</strong></td>
                    @php
                        $Thur_TB1_From =substr(@$Time_band->{'Thur TB1 From'}, 11,8);
                        $thur_tb1_f ='';
                        if($Thur_TB1_From != '00:00:00.000'){
                            $thur_tb1_f = $Thur_TB1_From;
                            }else{
                            $thur_tb1_f ='';
                            }
                        @endphp

                    @php
                    $Thur_TB1_From =substr(@$Time_band->{'Thur TB1 To'}, 11,8);
                    $thur_tb1_t ='';
                    if($Thur_TB1_From != '00:00:00.000'){
                        $thur_tb1_t = $Thur_TB1_From;
                        }else{
                        $thur_tb1_t ='';
                        }
                    @endphp
                    <td>{{  date('h:i:s A',strtotime($thur_tb1_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($thur_tb1_t)) ?? ''}}</td>
                    @php
                    $Thur_TB2_From =substr(@$Time_band->{'Thur TB2 From'}, 11,8);
                    $thur_tb2_f ='';
                    if($Thur_TB2_From != '00:00:00.000'){
                        $thur_tb2_f = $Thur_TB2_From;
                        }else{
                        $thur_tb2_f ='';
                        }
                    @endphp

                    @php
                    $Thur_TB2_To =substr(@$Time_band->{'Thur TB2 To'}, 11,8);
                    $thur_tb2_t ='';
                    if($Thur_TB2_To != '00:00:00.000'){
                        $thur_tb2_t = $Thur_TB2_To;
                        }else{
                        $thur_tb2_t ='';
                        }
                    @endphp
                    <td colspan="2">{{ date('h:i:s A',strtotime($thur_tb2_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($thur_tb2_t)) ?? ''}}</td>
                    @php
                    $Thur_TB3_From =substr(@$Time_band->{'Thur TB3 From'}, 11,8);
                    $thur_tb3_f ='';
                    if($Thur_TB3_From != '00:00:00.000'){
                        $thur_tb3_f = $Thur_TB3_From;
                        }else{
                        $thur_tb3_f ='';
                        }
                    @endphp

                    @php
                    $Thur_TB3_To =substr(@$Time_band->{'Thur TB3 To'}, 11,8);
                    $thur_tb3_t ='';
                    if($Thur_TB3_To != '00:00:00.000'){
                        $thur_tb3_t = $Thur_TB3_To;
                        }else{
                        $thur_tb3_t ='';
                        }
                    @endphp
                    <td>{{ date('h:i:s A',strtotime($thur_tb3_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($thur_tb3_t)) ?? ''}}</td>
                    </tr>

                    <!---Friday--->
                    <tr>
                    <td colspan="2"><strong>Friday</strong></td>
                    @php
                        $Fri_TB1_From =substr(@$Time_band->{'Fri TB1 From'}, 11,8);
                        $fri_tb1_f ='';
                        if($Fri_TB1_From != '00:00:00.000'){
                            $fri_tb1_f = $Fri_TB1_From;
                            }else{
                            $fri_tb1_f ='';
                            }
                        @endphp
                    @php
                        $Fri_TB1_To =substr(@$Time_band->{'Fri TB1 To'}, 11,8);
                        $fri_tb1_t ='';
                        if($Fri_TB1_To != '00:00:00.000'){
                            $fri_tb1_t = $Fri_TB1_To;
                            }else{
                            $fri_tb1_t ='';
                            }
                        @endphp
                    <td>{{ date('h:i:s A',strtotime($fri_tb1_f)) ?? ''}} ~ {{ date('h:i:s A',strtotime($fri_tb1_t)) ?? ''}}</td>
                    @php
                    $Fri_TB2_From =substr(@$Time_band->{'Fri TB2 From'}, 11,8);
                    $fri_tb2_f ='';
                    if($Fri_TB2_From != '00:00:00.000'){
                        $fri_tb2_f = $Fri_TB2_From;
                        }else{
                        $fri_tb2_f ='';
                        }
                    @endphp

                    @php
                    $Fri_TB2_To =substr(@$Time_band->{'Fri TB2 To'}, 11,8);
                    $fri_tb2_t ='';
                    if($Fri_TB2_To != '00:00:00.000'){
                        $fri_tb2_t = $Fri_TB2_To;
                        }else{
                        $fri_tb2_t ='';
                        }
                    @endphp
                    <td colspan="2">{{ date('h:i:s A',strtotime($fri_tb2_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($fri_tb2_t)) ?? ''}}</td>
                    @php
                    $Fri_TB3_From =substr(@$Time_band->{'Fri TB3 From'}, 11,8);
                    $fri_tb3_f ='';
                    if($Fri_TB3_From != '00:00:00.000'){
                        $fri_tb3_f = $Fri_TB3_From;
                        }else{
                        $fri_tb3_f ='';
                        }
                    @endphp

                    @php
                    $Fri_TB3_To =substr(@$Time_band->{'Fri TB3 To'}, 11,8);
                    $fri_tb3_t ='';
                    if($Fri_TB3_To != '00:00:00.000'){
                        $fri_tb3_t = $Fri_TB3_To;
                        }else{
                        $fri_tb3_t ='';
                        }
                    @endphp
                    <td>{{ date('h:i:s A',strtotime($fri_tb3_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($fri_tb3_t)) ?? ''}}</td>
                    </tr>
                                    <!------Saturday----->
                    <tr>
                    <td colspan="2"><strong>Saturday</strong></td>
                    @php
                    $Sat_TB1_From =substr(@$Time_band->{'Sat TB1 From'}, 11,8);
                    $sat_tb1_f ='';
                    if($Sat_TB1_From != '00:00:00.000'){
                        $sat_tb1_f = $Sat_TB1_From;
                        }else{
                        $sat_tb1_f ='';
                        }
                    @endphp

                    @php
                    $Sat_TB1_To =substr(@$Time_band->{'Sat TB1 To'}, 11,8);
                    $sat_tb1_t ='';
                    if($Sat_TB1_To != '00:00:00.000'){
                        $sat_tb1_t = $Sat_TB1_To;
                        }else{
                        $sat_tb1_t ='';
                        }
                    @endphp
                    <td>{{  date('h:i:s A',strtotime($sat_tb1_f)) ?? ''}} ~ {{ date('h:i:s A',strtotime($sat_tb1_t))  ?? ''}}</td>
                    @php
                        $Sat_TB2_From =substr(@$Time_band->{'Sat TB2 From'}, 11,8);
                        $sat_tb2_f ='';
                        if($Sat_TB2_From != '00:00:00.000'){
                            $sat_tb2_f = $Sat_TB2_From;
                            }else{
                            $sat_tb2_f ='';
                            }
                        @endphp

                    @php
                        $Sat_TB2_To =substr(@$Time_band->{'Sat TB2 To'}, 11,8);
                        $sat_tb2_t ='';
                        if($Sat_TB2_To != '00:00:00.000'){
                            $sat_tb2_t = $Sat_TB2_To;
                            }else{
                            $sat_tb2_t ='';
                            }
                        @endphp
                    <td colspan="2">{{ date('h:i:s A',strtotime($sat_tb2_f)) ?? ''}} ~ {{ date('h:i:s A',strtotime($sat_tb2_t)) ?? ''}}</td>
                    @php
                    $Sat_TB3_From =substr(@$Time_band->{'Sat TB3 From'}, 11,8);
                    $sat_tb3_f ='';
                    if($Sat_TB3_From != '00:00:00.000'){
                        $sat_tb3_f = $Sat_TB3_From;
                        }else{
                        $sat_tb3_f ='';
                        }
                    @endphp

                    @php
                    $Sat_TB3_To =substr(@$Time_band->{'Sat TB3 To'}, 11,8);
                    $sat_tb3_t ='';
                    if($Sat_TB3_To != '00:00:00.000'){
                        $sat_tb3_t = $Sat_TB3_To;
                        }else{
                        $sat_tb3_t ='';
                        }
                    @endphp
                    <td>{{ date('h:i:s A',strtotime($sat_tb3_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($sat_tb3_t)) ?? ''}}</td>
                    </tr>
                    <!------sunday-------->
                    <tr>
                    <td colspan="2"><strong>Sunday</strong></td>

                    @php
                    $Sun_TB1_From =substr(@$Time_band->{'Sun TB1 From'}, 11,8);
                    $sun_tb1_f ='';
                    if($Sun_TB1_From != '00:00:00.000'){
                        $sun_tb1_f = $Sun_TB1_From;
                        }else{
                        $sun_tb1_f ='';
                        }
                    @endphp

                    @php
                    $Sun_TB1_To =substr(@$Time_band->{'Sun TB1 To'}, 11,8);
                    $sun_tb1_t ='';
                    if($Sun_TB1_To != '00:00:00.000'){
                        $sun_tb1_t = $Sun_TB1_To;
                        }else{
                        $sun_tb1_t ='';
                        }
                    @endphp
                    <td>{{date('h:i:s A',strtotime($sun_tb1_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($sun_tb1_t))  ?? ''}}</td>
                    @php
                    $Sun_TB2_From =substr(@$Time_band->{'Sun TB2 From'}, 11,8);
                    $sun_tb2_f ='';
                    if($Sun_TB2_From != '00:00:00.000'){
                        $sun_tb2_f = $Sun_TB2_From;
                        }else{
                        $sun_tb2_f ='';
                        }
                    @endphp
                    @php
                    $Sun_TB2_To =substr(@$Time_band->{'Sun TB2 To'}, 11,8);
                    $sun_tb2_t ='';
                    if($Sun_TB2_To != '00:00:00.000'){
                        $sun_tb2_t = $Sun_TB2_To;
                        }else{
                        $sun_tb2_t ='';
                        }
                    @endphp
                    <td colspan="2">{{date('h:i:s A',strtotime($sun_tb2_f)) ?? ''}} ~ {{date('h:i:s A',strtotime($sun_tb2_t)) ?? ''}}</td>
                    @php
                    $Sun_TB3_From =substr(@$Time_band->{'Sun TB3 From'}, 11,8);
                    $sun_tb3_f ='';
                    if($Sun_TB3_From != '00:00:00.000'){
                        $sun_tb3_f = $Sun_TB3_From;
                        }else{
                        $sun_tb3_f ='';
                        }
                    @endphp

                    @php
                    $Sun_TB3_To =substr(@$Time_band->{'Sun TB3 To'}, 11,8);
                    $sun_tb3_t ='';
                    if($Sun_TB3_To != '00:00:00.000'){
                        $sun_tb3_t = $Sun_TB3_To;
                        }else{
                        $sun_tb3_t ='';
                        }
                    @endphp
                    <td>{{date('h:i:s A',strtotime($sun_tb3_f)) ?? ''}} ~ {{ date('h:i:s A',strtotime($sun_tb3_t)) ?? ''}}</td>
                    </tr>
                    </table>
                    <table>
                    <!-----Start Time Band--------->
                   <tr><td colspan="6"><hr /></td></tr>
                    @php

                    $GOPA_Validity_Date = date('d/m/Y', strtotime(@$FMdata->{'GOPA Validity Date'}));
                    $gopa_v_d ='';
                    if($GOPA_Validity_Date != '1970-01-01'){
                        $gopa_v_d = $GOPA_Validity_Date;
                        }else{
                        $gopa_v_d ='';
                        }

                    @endphp
                    <tr>
                        <td><strong>GOPA Valid Upto </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{  $gopa_v_d ?? ''}}</td>

                    @php

                    $WOL_Validity_Date = date('d/m/Y', strtotime(@$FMdata->{'WOL Validity Date'}));
                    $WOL_v_d ='';
                    if($WOL_Validity_Date != '1970-01-01'){
                    $WOL_v_d = $WOL_Validity_Date;
                    }else{
                    $WOL_v_d ='';

                    }
                    @endphp
                        <td><strong>WOL Valid Upto</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $WOL_v_d ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Legal Status of Company</strong></td>
                        <td><strong>:</strong></td>
                        @php
                            $legal ='';
                            if($FMdata->{'Company Legal Status'} == 1){
                                $legal ='Partnership';
                            }elseif($FMdata->{'Company Legal Status'} == 2) {
                                $legal ='Proprietorship';
                            }elseif($FMdata->{'Company Legal Status'} == 3){
                                $legal ='Public Ltd';
                            }elseif($FMdata->{'Company Legal Status'} == 4){
                                $legal ='Pvt.Ltd';
                            }else{
                                $legal ='';
                            }

                            @endphp
                    <td>{{$legal ?? ''}}</td>
                    @php

                    $Commercial_Launch_Date = date('d/m/Y', strtotime(@$FMdata->{'Commercial Launch Date'}));

                    $Comm_v_d ='';
                    if($Commercial_Launch_Date != '1970-01-01'){
                    $Comm_v_d = $Commercial_Launch_Date;
                    }else{
                    $Comm_v_d ='';
                    }
                    @endphp
                        <td><strong>Pvt. FM Commercial Launch Date</strong></td>
                        <td><strong>:</strong></td>
                        <td >{{ $Comm_v_d ?? ''}}</td>
                    </tr>
                    <tr><td colspan="6"><hr /></td></tr>
                    <tr><td colspan="6"><strong>Delhi Office Address</strong></td></tr>
                    <tr>
                        <td><strong>Contact Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $DOContact_Name = strtolower($FMdata->{'DO Contact Name'}) @endphp 
                        <td>{{ ucwords( $DOContact_Name) ?? '' }}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'DO Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Designation</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'DO Designation'} ?? '' }}</td>
                        <td><strong>Landline No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'DO Landline No_(with STD)'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'DO Mobile No_'} ?? ''}}</td>
                        <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'DO E-Mail'} ?? '' }}</td>
                    </tr>
                    <tr><td colspan="6"><hr /></td></tr>
                    <tr><td colspan="6"><strong>Operating Address of Pvt. FM Station</strong></td></tr>
                    <tr>
                        <td><strong>Contact Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $OPContact_Name = strtolower($FMdata->{'OP Contact Name'}) @endphp 
                        <td>{{ ucwords($OPContact_Name) }}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'OP Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Designation</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'OP Designation'} ?? '' }}</td>
                        <td><strong>Landline No. </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'OP Landline No_(with STD)'} }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'OP Mobile No_'} ?? '' }}</td>
                        <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'OP E-Mail'} ?? '' }}</td>
                    </tr>
                    <tr><td colspan="6"><hr /></td></tr>
                    <tr><td colspan="6"><strong>Address of Head Office To Which Pvt. FM Station Belongs To</strong></td></tr>
                    <tr>
                        <td><strong>Contact Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $hoContact_Name = strtolower($FMdata->{'HO Contact Name'}) @endphp 
                        <td>{{ucwords($hoContact_Name); }}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'HO Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Designation</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'HO Designation'} ?? '' }}</td>
                        <td><strong>Landline No. </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'HO Landline No_(with STD)'} }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'HO Mobile No_'} ?? '' }}</td>
                        <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'HO E-Mail'} ?? '' }}</td>
                    </tr>
                    <tr><td colspan="6"><hr /></td></tr>
                    <tr>
                        <td><strong>Bank Account Number For Receiving Payment</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Bank A_c No_'} ?? '' }}</td>
                        <td><strong>Account Holder Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $Holder_Name = strtolower($FMdata->{'A_C Holder Name'}) @endphp 
                        <td>{{ucwords($Holder_Name) ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'IFSC Code'} ?? '' }}</td>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $bank = strtolower($FMdata->{'Bank Name'}) @endphp 
                        <td>{{ucfirst($bank) ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        @php $branch = strtolower($FMdata->{'Bank Branch'}) @endphp 
                        <td>{{ ucwords($branch) ?? '' }}</td>
                        <td><strong>Address of Account</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower($FMdata->{'Bank A_C Address'}) ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>PAN Card No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'PAN'} ?? ''}}</td>
                        <td><strong>GST No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $gst ?$gst  :'N/A'}}</td>
                    </tr>
                      <tr><td colspan="6"><strong>ESI Account Details</strong></td></tr>
                    <tr>
                    <td><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'ESI A_C No_'} ? $FMdata->{'ESI A_C No_'} :'N/A'}}</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$FMdata->{'ESI - No_ Of Employee'} !=0 ? @$FMdata->{'ESI - No_ Of Employee'} : 'N/A' }}</td>
                    </tr>
                      <tr><td colspan="6"><strong>EPF Account Details</strong></td></tr>
                    <tr>
                    <td ><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'EPF A_C No_'} ? $FMdata->{'EPF A_C No_'} :'N/A'}}</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$FMdata->{'EPF - No_ Of Employee'} !=0 ? @$FMdata->{'EPF - No_ Of Employee'} : 'N/A' }}</td>
                    </tr>   
                </table>
                <table>
                <tr>
                        <td colspan="6">
                            <h3><strong>Uploaded Documents</strong></h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Copy of valid wireless operating license (WOL) issued by WPC wing of ministry of communication and IT.</strong></td>
                        <td width="2%"><strong>:</strong></td>
                        <td width="7%" align="center">{{ $FMdata->{'WOL File Name'} != '' ? 'Yes' : 'No'}}</td>  
                    <tr>
                    </tr>                     
                        <td colspan="4"><strong>Copy of grant of permission agreement (GOPA) signed with the Ministry of information & broadcasting</strong></td>
                        <td><strong>:</strong></td>
                        <td align="center">{{ $FMdata->{'GOPA File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>An undertaking mentioning a Minimum Broadcast Period-The minimum broadcast period of 6 months of commercial broadcast with at least 16 hours broadcast per day i.e. 7 AM to 11 PM shall be the criterion for a private FM Radio Stations to be empanelled with CBC.</strong></td>
                        <td><strong>:</strong></td>
                        <td align="center">{{$FMdata->{'Undertaking File Name'} != '' ? 'Yes' : 'No'}}</td>
                    <tr>
                    </tr>
                        <td colspan="4"><strong>The programme scheduling for the previous 06 months from 7 AM to 11 PM, during which the FM stations operated. An external hard disk/ CD,station wise/Date wise in mp3 format, minimum 128 kbps (Bit rate) containing the programmes broadcast for the last one month preceding the date of
                        application.</strong></td>
                        <td><strong>:</strong></td>
                        <td align="center">{{$FMdata->{'Program Scheduling File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Upload scan copy of cancelled cheque</strong></td>
                        <td><strong>:</strong></td>
                        <td align="center">{{ $FMdata->{'Cancelled Cheque File Name'} != '' ? 'Yes' : 'No' }}</td>
                    <tr>
                    </tr>
                        <td colspan="4"><strong>Certificate duly signed by the Auditor/Company secretary for the prescribed revenue details, latest profit & loss accounts, balance sheet and actual tax payment including service tax for previous financial year and the amount of advertisement revenue generated by the private FM radio stations during the previous financial year preceding the date of application.</strong></td>
                        <td><strong>:</strong></td>
                        <td align="center">{{ $FMdata->{'Auditor File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>The private FM radio stations either provide the documentary proof of broadcast certificate (BC) or give an undertaking that they would provide the broadcasting certificate along with physical bills at the time of submission of application.</strong></td>
                        <td><strong>:</strong></td>
                        <td align="center">{{ $FMdata->{'Broadcasting Cert File Name'} != '' ? 'Yes' : 'No' }}</td>
                    <tr>
                    </tr>
                        <td colspan="4"><strong>A letter attested by Senior Management level executive of the FM Radio Station mention name, designation and signature of the authorized signature for bills/TC.</strong>
                        </td>
                        <td><strong>:</strong></td>
                        <td align="center">{{ $FMdata->{'SMA File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>A signed list mention the name of station, frequency and state of operation to be provided by the group/holding company/media house to which the applicant FM radio station belongs.</strong></td>
                        <td><strong>:</strong></td>
                        <td align="center">{{ $FMdata->{'Signed List File Name'} != '' ? 'Yes' : 'No' }}</td>
                <tr>
                </tr>
                        <td colspan="4"><strong>Acceptance of the policy.An undertaking of the acceptance of the policy guideline by Pvt FM Station.</strong></td>
                        <td><strong>:</strong></td>
                        <td align="center">{{ @$FMdata->{'Modification'} == 1 ? 'Yes' : 'No' }}</td>
                    </tr>
                    @if(@$FMdata->{'Bharatkosh Receipt File Name'} !='')
                    <tr>                        
                        <td colspan="4"><strong>Bharatkosh (Payment receipt) of WOL Extension</strong></td>
                        <td ><strong>:</strong></td>
                        <td align="center">{{ $FMdata->{'Bharatkosh Receipt File Name'} != '' ? 'Yes' : 'No'}}</td>      
                                         
                    </tr>
                    @endif
                    <tr style="border:none !important;">
                        <td  colspan="6" height="80px">
                        <h3 align="left">I confirm that all the information given by me is true and nothing has been concealed.</h3>
                        <p align="right" style="margin-top:100px">Authorized Signatory / Signature</p></td>
                    </tr>  
                </table>
                </div>
                </div>
</body>

</html>
