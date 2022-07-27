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

    </style>
</head>
@php

@endphp
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
                        <td width="35%"><strong>Owner Name</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{$OD_owners->{'Owner Name'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email Id </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Email ID'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Mobile No_'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Phone No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if( $OD_owners->{'State'} !=''){{ $Owner_State ?? ''}}@endif</td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'District'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'City'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'City'} ?? ''}}</td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                 <h3 style="text-align: center; color: #fff;"><strong>Community radio station information :-</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Channel Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Agency code </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'Agency Code'} ?? ''}}</td>
                    </tr>

                    <tr>
                        <td><strong>Frequency of broadcast </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ !empty($commudata) ? round($commudata->{'Frequency'},2) : ''}}</td>
                    </tr>

                    {{-- <tr>
                        <td><strong>Language of broadcast</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if($commudata->{'Language'} !=''){{$getlang ?? '' }}@endif</td>
                    </tr> --}}
                </table>
            </td>
        </tr>
        @php
         $weekdays = array(0 => 'Monday',1 => 'Tuesday',2 => 'Wednesday',3 => 'Thursday',4 => 'Friday',5 => 'Saturday',6 => 'Sunday');
        @endphp
        <tr>
            <td colspan="1">
                <table width="100%" style="border:1px solid gray" cellspacing="0" cellpadding="4">
                <!-----Start Time Band--------->
                <tr style="padding-top:100px;"></tr>
                <tr>
                    <th>Week Days</th>
                    <th colspan="2">Time Band 1</th>
                    <th colspan="2">Time Band 2</th>
                    <th colspan="2">Time Band 3</th>
                </tr>
                  @foreach($weekdays as $key=>$value)
                    <tr>
                        <td>{{$value}}</td>
                        @foreach($Time_band as $key1=>$value1)
                        @if($value1->{'Weekday'} == $key)
                        <td>{{date('H:i:s',strtotime(@$value1->{'Start Time'}))}}</td>
                        <td>{{date('H:i:s',strtotime(@$value1->{'End Time'}))}}</td>
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                    </table>
                </td>
            </tr>
                <!-----End Time Band--------->
                <tr>
                    <td style="background: #2268B2;" colspan="3">
                         <h3 style="text-align: center; color: #fff;"><strong>GOPA Details :-</strong></h3>
                    </td>
                </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    @php
                    $GOPA_Validity_Date =substr(@$commudata->{'GOPA Signing Date'}, 0,10);
                    $gopa_v_d ='';
                    if($GOPA_Validity_Date != '1970-01-01'){
                        $gopa_v_d = $GOPA_Validity_Date;
                        }else{
                        $gopa_v_d ='';
                        }
                    @endphp
                    <tr>
                        <td><strong>GOPA valid upto </strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="7">{{  $gopa_v_d ?? ''}}</td>
                    </tr>
                    @php
                    $WOL_Validity_Date =substr(@$commudata->{'WOL Signing Date'},0,10);
                    $WOL_v_d ='';
                    if($WOL_Validity_Date != '1970-01-01'){
                    $WOL_v_d = $WOL_Validity_Date;
                    }else{
                    $WOL_v_d ='';
                    }
                    @endphp
                    <tr>
                        <td><strong>WOL valid upto</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="7">{{ $WOL_v_d ?? ''}}</td>
                    </tr>

                    @php
                    $Commercial_Launch_Date =substr(@$commudata->{'WOL Validity Date'}, 0,10);
                    $Comm_v_d ='';
                    if($Commercial_Launch_Date != '1970-01-01'){
                    $Comm_v_d = $Commercial_Launch_Date;
                    }else{
                    $Comm_v_d ='';
                    }
                    @endphp
                {{-- <tr>
                    <td style="background: #2268B2;" colspan="3">
                         <h3 style="text-align: center; color: #fff;"><strong>WOL Details :-</strong></h3>
                    </td>
                </tr> --}}

                <tr>
                    <td><strong>Number</strong></td>
                    <td><strong>:</strong></td>
                    <td colspan="5">{{ $commudata->{'WOL Number'} ?? '' }}</td>
                </tr>

                @php
                $WOL_Validity_Date =substr(@$commudata->{'WOL Signing Date'},0,10);
                $WOL_v_d ='';
                if($WOL_Validity_Date != '1970-01-01'){
                $WOL_v_d = $WOL_Validity_Date;
                }else{
                $WOL_v_d ='';

                }
                @endphp
                <tr>
                    <td><strong>WOL valid upto</strong></td>
                    <td><strong>:</strong></td>
                    <td colspan="7">{{ $WOL_v_d ?? ''}}</td>
                </tr>

                 <tr>
                        <td><strong>Legal status of company</strong></td>
                        <td><strong>:</strong></td>
                        @php
                            $legal ='';
                            if($commudata->{'Company Legal Status'} == 1){
                                $legal ='Pvt';
                            }elseif($commudata->{'Company Legal Status'} == 2) {
                                $legal ='Ltd';
                            }elseif($commudata->{'Company Legal Status'} == 3){
                                $legal ='Others';
                            }else{
                                $legal ='';
                            }
                            @endphp
                        <td colspan="7">{{$legal ?? ''}}</td>
                    </tr>

                    <tr>
                        <td><strong>Director/ceo/head of company /channel</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'Cnannel Head'} ?? '' }}</td>
                    </tr>

                    <tr>
                        <td><strong>Date of launch of channel</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'Channel Launch Date'} ?? '' }}</td>
                    </tr>

                </table>
                </td>
                </tr>
                    <!-- <tr>
                    <td style="background:#f2f2f2;" colspan="7">
                            <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Delhi office address:-</strong></h4>
                        </td>
                    </tr> -->
                    <tr>
                        <td style="background: #2268B2;" colspan="3">
                             <h3 style="text-align: center; color: #fff;"><strong>Channel Office :-</strong></h3>
                        </td>
                    </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">

                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'Address'} ?? '' }}</td>
                    </tr>

                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'City'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pin Code</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'PIN Code'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.(with std)</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'Phone No_(with STD)'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'Mobile No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'E-Mail'} ?? '' }}</td>
                    </tr>
                </table>
                </td>
                </tr>
                <tr>
                    <th style="background: #2268B2;" colspan="3">
                        <h3 style="text-align: center; color:#fff;"><strong>Channel head office:-</strong></h3>
                    </th>
                </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Pin Code</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'HO PIN Code'} }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.(with std)</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'HO Phone No_(with STD)'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'HO Mobile No_'} ?? '' }}</td>
                    </tr>

                    <tr>
                        <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'HO E-Mail'} ?? '' }}</td>
                    </tr>
                    <tr>
                </table>
                </td>

                <tr>
                    <th style="background: #2268B2;" colspan="3">
                        <h3 style="text-align: center; color:#fff;"><strong>Owner head office:-</strong></h3>
                    </th>
                </tr>

            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="7">
                    {{-- <tr>
                        <td><strong>Contact Name</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'HO Contact Name'} }}</td>
                    </tr> --}}
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'OHO Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pin Code</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'OHO PIN Code'} ?? '' }}</td>
                    </tr>
                    {{-- <tr>
                        <td><strong>Landline No. </strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'HO Landline No_(with STD)'} }}</td>
                    </tr> --}}
                    <tr>
                        <td><strong>Phone No.(with std)</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'OHO Phone No_(with STD)'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'OHO Mobile No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $commudata->{'OHO E-Mail'} ?? '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>Account Details</strong></h3>
            </th>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Bank account no. for receiving payments</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'Bank A_c No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Account holder name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$commudata->{'A_C Holder Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'IFSC Code'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'Bank Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'Bank Branch'} ?? '' }}</< /td>
                    </tr>
                    <tr>
                        <td><strong>Address of Account</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'Bank A_C Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>PAN Card No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'PAN'} ?? ''}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>ESI Account Details</strong></h3>
            </th>
        </tr>

        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'ESI A_C No_'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$commudata->{'ESI - No_ Of Employee'} !=0 ? @$commudata->{'ESI - No_ Of Employee'} : '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>EPF Account Details</strong></h3>
            </th>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'EPF A_C No_'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$commudata->{'EPF - No_ Of Employee'} !=0 ? @$commudata->{'EPF - No_ Of Employee'} : '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>Upload Document</strong></h3>
            </th>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Copy of grant of permission agreement(gopa) signed with the ministry of I&B.</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ $commudata->{'GOPA File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Upload gst certificate</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'GST Cert File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Upload pan card</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$commudata->{'PAN Card File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Self-certification by the head of crs certifying that the crs is functional and is continuously broadcasting at least two hours of programmes per day since last three months</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$commudata->{'CRS Cert File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    {{-- <tr>
                        <td><strong>Upload scan copy Of cancelled cheque</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'Cancelled Cheque File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Certificate duly signed by the Auditor/Company secretary for the prescribed revenue details, latest profit & loss accounts, balance sheet and actual tax payment including service tax for previous financial year and the amount of advertisement revenue generated by the private FM radio stations during the previous financial year preceding the date of application.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'Auditor File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>The private FM radio stations either provide the documentary proof of broadcast certificate (BC) or give an undertaking that they would provide the broadcasting certificate along with physical bills at the time of submission of application.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'Broadcasting Cert File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>A letter attested by Senior Management level executive of the FM Radio Station mention name, designation and signature of the authorized signature for bills/TC.</strong>
                        </td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'SMA File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>A signed list mention the name of station, frequency and state of operation to be provided by the group/holding company/media house to which the applicant FM radio station belongs.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $commudata->{'Signed List File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr> --}}
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
