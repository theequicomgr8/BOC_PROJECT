<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Pre Rob Application Receipt</title>
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

if(@$data->status=='1' || @$data->status=='2')
{
  $block='readonly';
  $non='none';
  $tab='-1';
  $click='preventLeftClick';
}
else
{
  $block='';
  $non='';
  $tab='';
  $click='';
}
$mouse='';
$user_ype=Session::get('UserType');

@endphp
<body>
<div class="card-body">
     <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%">
                <thead>
                <tr>
                        <td align="center" colspan="7"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                            <p><strong>GOVERNMENT OF INDIA <br />
                                    CENTRAL BUREAU OF COMMUNICATION<br />
                                    Ministry of Information & Broadcasting</strong><br />
                                Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                            </p>
                        </td>
                    </tr>
                </thead>
                </table>

                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    @php
                    if(@$data->ministry_name !=null || @$data->ministry_name !=''){
                        $colspan ="";
                    }
                    else{
                        $colspan ="4";
                    }
                    @endphp
                <tr>
                        <td><strong>Category of Programme Activity</strong></td>
                        <td ><strong>:</strong></td>
                        <td colspan="{{$colspan}}">
                        {{@$data->programme_activity=='1' ? 'Programme Activites(under ICOP) under DCID fund of M/O I&B': ''}}
                        {{@$data->programme_activity=='6' ? 'Programme Activites(other than ICOP) under DCID fund of M/O I&B': ''}}
                        {{@$data->programme_activity=='2' ? 'Programme Activites on SAP under DCID fund of M/O I&B': ''}}
                        {{@$data->programme_activity=='3' ? 'Programme Activites under Establishment fund': ''}}
                        {{@$data->programme_activity=='4' ? 'Programme Activites (ICOP) for Client Ministries': ''}}
                        {{@$data->programme_activity=='5' ? 'Programme Activites (Other than ICOP) for Client Ministries': ''}}
                        {{@$data->programme_activity=='7' ? 'Mann Ki Baat': ''}}</td>
                        @if(@$data->ministry_name !=null || @$data->ministry_name !='')
                        <td><strong>Category under ICOP</strong></td>
                        <td width="2%"><strong>:</strong></td>
                        <td> @foreach(@$ministry_data as $ministry_list)
                       {{@$data->ministry_name==$ministry_list->ministry_name ? '$ministry_list->ministry_name' : ''}}
                        @endforeach
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <td><strong>Type of Activity</strong></td>
                        <td><strong>:</strong></td>
                        @php
                        if(@$data->activity_checkbox1!='')
                        {
                        $check=explode(",",@$data->category_icop);
                        $activity =['MI','SM','ME','BI','OT'];
                        $acti = array_intersect($activity,$check);
                        $Type_of_Activity =implode(',', $acti);

                        }
                        @endphp
                        <td colspan="4">{{ $Type_of_Activity ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Type of Activity</strong></td>
                        <td width="2%"><strong>:</strong></td>
                        @php
                        if(@$data->activity_checkbox1!='')
                        {
                        $check=explode(",",$data->activity_checkbox1);
                        $activity =['FIELD','FOLK','EXHIBITION'];
                        $acti = array_intersect($activity,$check);
                        $Type_of_Activity =implode(',', $acti);
                        }
                        @endphp
                        <td>{{ $Type_of_Activity ?? ''}}</td>
                        <td><strong>Theme of Activity/Programme</strong></td>
                        <td width="2%"><strong>:</strong></td>
                        <td>{{@$data->sop_theme ?? ''}}</td>
                    </tr>
                    @if(@$user_ype=='2')
                    <tr>
                        <td><strong>Type of Activity</strong></td>
                        <td><strong>:</strong></td>
                        @php
                        $temp ='';
                        if(@$data->office_type == 'HQ'){
                            $temp ='ROB';
                        } else{
                            $temp ='FOBs';
                        }
                        @endphp
                        <td>{{$temp ?? ''}}</td>
                        <td><strong>Region</strong></td>
                        <td><strong>:</strong></td><td>
                        @if(@$data->office_type=='HQ')
                            @if (@$data->region_id!='')
                            @foreach($offRegion as $reg)
                            @if(@trim($reg->rob_hq)!='')
                            {{@$reg->rob_hq==$data->region_id ? $reg->rob_hq : ''}}
                            @endif
                            @endforeach
                            @endif
                        @elseif(@$data->office_type=='FO')
                            @if (@$data->region_id!='')
                            @foreach($offRegion as $reg)
                            {{@$reg->rob_fo==$data->region_id ? $reg->rob_fo : ''}}
                            @endforeach
                            @endif
                        @endif
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <td><strong>Target Area Description</strong></td>
                        <td><strong>:</strong></td>
                        <td>  @foreach($demographys as $demogra)
                                @if($demogra->demography == @$data->demography) {{@$data->demography}} @else  @endif
                             @endforeach</td>
                        <td><strong>Area of Activities</strong></td>
                        <td><strong>:</strong></td>
                         @foreach($area_data as $area)
                          @if($area->activity_name == @$data->activity_area)<td>{{$area->activity_name}}</td> @else {{'' }}@endif
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>Coverage (Village/Town Covered)</strong></td>
                        <td><strong>:</strong></td>
                        <td> {{@$data->coverage ?? ''}}</td>
                        <td><strong>Name of Village/Town Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->village_name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Block</strong></td>
                        <td><strong>:</strong></td>
                        <td> {{@$data->block ?? ''}}</td>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->district ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Distance Covered (in km)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->distance_covered ?? ''}}</td>
                        <td><strong>Date of Last Visit</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{date('d/m/Y',strtotime(@$data->last_visit_date)) ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Name of VIP</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->vip_name ?? ''}}</td>
                        <td><strong>Designation of VIP </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->vip_designation ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Venue</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->venue_event ?? ''}}</td>
                        <td><strong>Event Description </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->event_description ?? ''}}</td>
                    </tr>
                    <tr><th colspan="6"><h3>ATP Event Activity</h3></th></tr>
                    <tr>
                        <td><strong>From Date</strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            @if(@$data->duration_activity_from_date !='')
                            {{date('d/m/Y', strtotime(@$data->duration_activity_from_date)) ?? ''}}
                            @endif
                        </td>
                        <td><strong>To Date </strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            @if(@$data->event_description !='')
                            {{date('d/m/Y',strtotime(@$data->duration_activity_to_date)) ?? ''}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>No. of Days</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->no_of_days ?? ''}}</td>
                        <td><strong> </strong></td>
                        <td><strong></strong></td>
                        <td></td>
                    </tr>
                    <tr><th colspan="6"><h3>Pre Event Activities</h3></th></tr>
                    <tr>
                        <td><strong>Photo upload (Accept only : jpg, png, gif)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->pre_photo? 'Yes':'No'}}</td>
                        <td><strong>Update on Event Calendar </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->pre_show_website=='1' ? 'Yes':'No'}}</td>
                    </tr>
                    <tr>
                        <th colspan="6">Organizer Details</th>
                    </tr>
                    <tr>
                        <td><strong>Name of Officer</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->officer_name_person ?? ''}}</td>
                        <td><strong>Designation </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->person_designation ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Contact No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->contact_no ?? ''}}</td>
                        <td><strong>E-mail ID </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->email ?? ''}}</td>
                    </tr>
                    @if(@$data->system_date !='')
                    <tr>
                        <td><strong>Date</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{@$data->system_date ?date('d/m/Y',strtotime(@$data->system_date)):'N/A'}}</td>
                    </tr>
                    @endif
                      </table>
                    <table width="100%">
                    <tr>
                      <th style="width: 10%;">Sr. No. </th>
                      <th style="width: 10%;">Check</th>
                      <th colspan="3" style="width: 30%;">Activity</th>
                      <th>Remarks</th>
                    </tr>

                    <tr>
                      <td>1</td>
                      <td>
                        {{@$data->nukkad_natak1_pre_event_activity=='1' ? 'Yes' : 'No'}}
                      </td>
                      <td colspan="3"><span id="GridView1_ctl02_lbl_pre_event_activity">NUKKAD NATAK</span></td>
                      <td valign="middle">
                        {{@$data->nukkad_natak1_txt_pre_event ?@$data->nukkad_natak1_txt_pre_event :'N/A'}}
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>

                      <td>
                        {{@$data->public_meeting1_pre_event_activity=='1' ? 'Yes' : 'No'}}
                      </td>
                      <td colspan="3"> <span id="GridView1_ctl03_lbl_pre_event_activity">PUBLIC MEETING</span></td>
                      <td>
                      {{@$data->public_meeting1_txt_pre_event ?@$data->public_meeting1_txt_pre_event :'N/A'}}
                    </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>
                     {{@$data->public_announcement1_pre_event_activity=='1' ? 'Yes' : 'No'}}

                      </td>
                      <td colspan="3"><span id="GridView1_ctl04_lbl_pre_event_activity">PUBLIC ANNOUNCEMENTS</span></td>
                      <td>
                        {{@$data->public_announcement1_txt_pre_event ?@$data->public_announcement1_txt_pre_event: 'N/A'}}
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>
                         {{@$data->distribution_pamphlets1_pre_event_activity=='1' ? 'Yes' : 'No'}}

                      </td>
                      <td colspan="3"> <span id="GridView1_ctl05_lbl_pre_event_activity">DISTRIBUTION OF PAMPHLETS</span></td>
                      <td>
                        {{@$data->distribution_pamphlets1_txt_pre_event ?@$data->distribution_pamphlets1_txt_pre_event :'N/A'}}
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>
                      {{@$data->social_media_campaign1_pre_event=='1' ? 'Yes' : 'No'}}
                      </td>
                      <td colspan="3"> <span id="GridView1_ctl06_lbl_pre_event_activity">SOCIAL MEDIA CAMPAIGN</span></td>
                      <td>
                      {{@$data->social_media_campaign1_txt_pre_event ?@$data->social_media_campaign1_txt_pre_event :'N/A'}}
                      </td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>
                         {{@$data->public_rally_pre_event_activity=='1' ? 'Yes' : 'No'}}

                      </td>
                      <td colspan="3"><span id="GridView1_ctl07_lbl_pre_event_activity">PUBLIC RALLY IN NEARBY VILLAGE/TOWNS</span></td>
                      <td valign="middle">
                       {{@$data->public_rally_txt_pre_event ?@$data->public_rally_txt_pre_event :'N/A'}}
                      </td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>
                         {{@$data->media_briefing_pre_event_activity=='1' ? 'Yes' : 'No'}}
                      </td>
                      <td colspan="3">  <span id="GridView1_ctl08_lbl_pre_event_activity">MEDIA BRIEFING</span></td>
                      <td valign="middle">
                        {{@$data->media_briefing_txt_pre_event ?@$data->media_briefing_txt_pre_event :'N/A'}}
                      </td>
                    </tr>
                    <tr>
                      <td>8</td>
                      <td>
                       {{@$data->dd_air_curtain_pre_activity=='1' ? 'Yes' : 'No'}}

                      </td>
                      <td colspan="3"><span id="GridView1_ctl09_lbl_pre_event_activity">DD/AIR SCROLL/CURTAIN RAISERS</span></td>
                      <td valign="middle">
                      {{@$data->dd_air_curtain_txt_pre_activity ?@$data->dd_air_curtain_txt_pre_activity :'N/A'}}
                      </td>
                    </tr>
                    <tr>
                      <td>9</td>
                      <td>
                        {{@$data->social_media_campaign_pre_event=='1' ? 'Yes' : 'No'}}
                        </td>
                        <td colspan="3"><span id="GridView1_ctl10_lbl_pre_event_activity">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                       {{@$data->social_media_campaign_txt_pre_event ?@$data->social_media_campaign_txt_pre_event :'N/A'}}
                      </td>
                    </tr>
                    <!--  add 26 Apr -->
                    <tr>
                      <td>10</td>
                      <td>
                        {{@$data->other_media_campaign_pre_event=='1' ? 'Yes' : 'No'}}
                      </td>
                      <td colspan="3"><span id="GridView1_ctl10_lbl_pre_event_activity">OTHER</span>
                      </td>
                      <td valign="middle">
                       {{@$data->other_media_campaign_txt_pre_event ?@$data->other_media_campaign_txt_pre_event :'N/A'}}
                      </td>
                    </tr>

                </table>

        </div>
    </div>
</body>
</html>
