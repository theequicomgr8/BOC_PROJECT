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
$previous = url()->previous();
$selfurl ="http://127.0.0.1:8000/pre-active-form/".$data->Pk_id;
//dd($selfurl);
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
//dd(@$data->ministry_name);
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
                        <td><strong>:</strong></td>
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
                        <td width="10px"><strong>:</strong></td>
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
                        <td><strong>:</strong></td>
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
                        <td><strong>:</strong></td>
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
                            @if($data->duration_activity_from_date!='')
                            {{date('d/m/Y', strtotime(@$data->duration_activity_from_date)) ?? ''}}
                            @endif
                        </td>
                        <td><strong>To Date </strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            {{date('d/m/Y',strtotime(@$data->duration_activity_to_date)) ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>No. of Days</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->no_of_days ?? ''}}</td>

                        <td><strong> </strong></td>
                        <td><strong></strong></td>
                        <td></td>
                        <?php
                        // <td><strong>To Date </strong></td>
                        // <td><strong>:</strong></td>
                        // <td>{{date('d/m/Y',strtotime(@$data->event_description)) ?? ''}}</td>
                        ?>
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
                    @if(@$data->engagement_pre_event_activity=='1')
                    <tr>
                      <td>1</td>
                      <td>
                        <input id="GridView1_ctl02_ch_pre_event_activity_single" value="1" type="checkbox" name="engagement_pre_event_activity" {{@$data->engagement_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl02_lbl_pre_event_activity_single">ENGAGEMENT</span>
                      </td>
                      <td valign="middle" id="single">
                        <textarea maxlength="250" name="engagement_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev_single" style="height:50px;width:450px;resize: none; display:{{$engagement_pre}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->engagement_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    @endif
                    @if(@$data->nukkad_natak_pre_event_activity=='1')
                    <tr>
                      <td>1</td>
                      <td>
                        <input id="GridView1_ctl02_ch_pre_event_activity1" value="1" type="checkbox" name="nukkad_natak_pre_event_activity" {{@$data->nukkad_natak_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl02_lbl_pre_event_activity1">NUKKAD NATAK</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="nukkad_natak_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev1" style="height:50px;display:{{$nukkad_natak_pre}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->nukkad_natak_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    @endif
                    @if(@$data->public_meeting_pre_event_activity=='1')
                    <tr>
                      <td>2</td>
                      <td>
                        <input id="GridView1_ctl03_ch_pre_event_activity1" value="1" type="checkbox" name="public_meeting_pre_event_activity" {{@$data->public_meeting_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl03_lbl_pre_event_activity1">PUBLIC MEETING</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_meeting_txt_pre_event" rows="2" cols="20" id="GridView1_ctl03_txt_prev1" style="height:50px;display:{{$public_meeting_pre_event}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->public_meeting_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    @endif
                    @if(@$data->public_announcement_pre_event_activity=='1')
                    <tr>
                      <td>3</td>
                      <td>
                        <input id="GridView1_ctl04_ch_pre_event_activity1" value="1" type="checkbox" name="public_announcement_pre_event_activity" {{@$data->public_announcement_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl04_lbl_pre_event_activity1">PUBLIC ANNOUNCEMENTS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_announcement_txt_pre_event" rows="2" cols="20" id="GridView1_ctl04_txt_prev1" style="height:50px;display:{{$public_announcement_pre}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->public_announcement_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    @endif
                    @if(@$data->distribution_pamphlets_pre_event_activity=='1')
                    <tr>
                      <td>4</td>
                      <td>
                        <input id="GridView1_ctl05_ch_pre_event_activity1" value="1" type="checkbox" name="distribution_pamphlets_pre_event_activity" {{@$data->distribution_pamphlets_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl05_lbl_pre_event_activity1">DISTRIBUTION OF PAMPHLETS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="distribution_pamphlets_txt_pre_event" rows="2" cols="20" id="GridView1_ctl05_txt_prev1" style="height:50px;display:{{$distribution_pamphlets}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->distribution_pamphlets_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    @endif
                    @if(@$data->social_media_pre_event_activity=='1')
                    <tr>
                      <td>5</td>
                      <td>
                        <input id="GridView1_ctl06_ch_pre_event_activity1" value="1" type="checkbox" name="social_media_pre_event_activity" {{@$data->social_media_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl06_lbl_pre_event_activity1">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="social_media_txt_pre_event" rows="2" cols="20" id="GridView1_ctl06_txt_prev1" style="height:50px;display:{{$social_media_pre}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->social_media_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    @endif
                    <!-- add 26 Apr-->
                    @if(@$data->other_media_pre_event_activity=='1')
                    <tr>
                      <td>6</td>
                      <td>
                        <input id="GridView12_ctl06_ch_pre_event_activity1" value="1" type="checkbox" name="other_media_pre_event_activity" {{@$data->other_media_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl06_lbl_pre_event_activity1">OTHER</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="other_media_txt_pre_event" rows="2" cols="20" id="GridView1r_ctl06_txt_prev1" style="height:50px;display:{{$other_media_pre}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->other_media_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    @endif
                    <tr><td colspan="6">
                       <h3>Social Media Campaign</h3>
                    </td></tr>
                    <tr>
                        <td><strong>Success Stories</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->success_stories=='1' ? 'Yes': 'No'}}</td>
                        <td><strong>Local inputs about the programme </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->local_input_about_program=='1' ? 'Yes': 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Facebook/Twitter/Instagram</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->fb_twitter_instagram=='1' ? 'Yes': 'No'}}</td>
                        <td><strong>Web Streaming</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->web_streaming=='1' ? 'Yes': 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Talkathons</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->live_chat_session=='1' ? 'Yes': 'No'}}</td>
                        <td><strong>Selfie Points</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->selfie_points=='1' ? 'Yes': 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Social Media Wall</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->social_media_wall=='1' ? 'Yes': 'No'}}</td>
                        <td><strong>Other</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->other=='1' ? 'Yes': 'No'}}</td>
                    </tr>
                </tr>
                <tr>
                        <td><strong>Media Coverage</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->media_coverage_txt ?? ''}}</td>
                        <td><strong>Approx Size of Audience </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$data->approx_size_of_audience ?? ''}}</td>
                    </tr>
                    <tr><td colspan="6">
                       <h3>Programme Details</h3>
                    </td></tr>
                    <tr>
                    @php
                    $ary=
                        array(
                            0=> array('sareavalue'=>1,
                            'saname'=>'BORDER AREA' ),
                            1=> array('sareavalue'=>2,
                            'saname'=>'LWE AREA'),
                            2=> array('sareavalue'=>3,
                            'saname'=>'MINORITIES AREA'),
                            3=> array('sareavalue'=>4,
                            'saname'=>'NORTH-EASTERN AREA'),
                            4=> array('sareavalue'=>5,
                            'saname'=>'ASPIRATIONAL DISTRICTS'),
                            5=> array('sareavalue'=>6,
                            'saname'=>'OTHER AREA')
                    );
                    $special=explode(",",@$data->Special_Areas);
                    $temp ='';
                    foreach($ary as $key=>$val){
                        if(in_array($val['sareavalue'],$special)){
                            $temp =$val['saname'];
                        }

                    }
                $arr =['PIC','VID','NEW'];
                  @endphp
                        <td><strong>Special Area(if any)</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">{{$temp}}</td>
                    </tr>
                    <tr>
                    <td><strong>Document Type</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">
                           {{@$data->document_type ?@$data->document_type :'N/A'}}
                        </td>
                    </tr>
                    <tr>
                    <tr><td colspan="6"><h3>Programme Details</h3>
                    </td>
                    </tr>
                    @if(@$data->status=='2')
                    <tr><td colspan="6"><h3><h4>Video: </h4></td></tr>
                    <tr style="background: #456bd8;color: white;">
                      <th style="width: 5%;">S.No</th>
                      <th style="width: 10%;">Date</th>
                      <th style="width: 10%;">Venue</th>
                      <th style="width: 15%;">File</th>
                      <th style="width: 15%;">Caption Name</th>
                      <th style="width: 15%;">Show on Website</th>
                    </tr>
                    @foreach(@$video as $key=>$rob_document)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{date('d/m/Y',strtotime(@$rob_document->venue_date))}}</td>
                      <td>{{@$rob_document->venue_address}}</td>
                      <td>
                       {{@$rob_document->document_name ?'Yes' :'No'}}
                      </td>
                      <td>
                        {{@$rob_document->caption_name}}
                      </td>

                      @if(Session::get('UserType')!='3')
                      <td>
                       {{@$rob_document->rob_form_id ?'Yes' :'No'}}
                      </td>
                      @endif
                    </tr>
                    @endforeach

                @endif
                    @if(@$data->status=='2')
                    <tr><td colspan="6"><h4>Photograph: </h4></td></tr>
                    <tr style="background: #456bd8;color: white;">
                      <th style="width: 5%;">S.No</th>
                      <th style="width: 10%;">Date</th>
                      <th style="width: 10%;">Venue</th>
                      <th style="width: 15%;">File</th>
                      <th style="width: 15%;">Caption Name</th>
                      <th style="width: 15%;">Show on Website</th>
                    </tr>
                    @foreach(@$rob_documents as $key=>$rob_document)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{date('d/m/Y',strtotime(@$rob_document->venue_date))}}</td>
                      <td>{{@$rob_document->venue_address}}</td>
                      <td>
                        <a target="_blank" href="{{asset('rob/'.$rob_document->document_name)}}">
                          View Document
                        </a>
                      </td>
                      <td>
                        {{@$rob_document->caption_name}}
                      </td>
                      @if(Session::get('UserType')!='3')
                      <td>
                       {{@$rob_document->rob_form_id ?'Yes' :'No'}}
                      </td>
                      @endif
                    </tr>
                    @endforeach

                  @endif
                    @if(@$data->status=='2')
                    <tr><td colspan="6"><h4>Press Release : </h4></td></tr>
                    <tr style="background: #456bd8;color: white;">
                      <th style="width: 5%;">S.No</th>
                      <th style="width: 10%;">Date</th>
                      <th style="width: 10%;">Venue</th>
                      <th style="width: 15%;">File</th>
                      <th style="width: 15%;">Caption Name</th>
                      <th style="width: 15%;">Show on Website</th>
                    </tr>
                    @foreach(@$press as $key=>$rob_document)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{date('d/m/Y',strtotime(@$rob_document->venue_date))}}</td>
                      <td>{{@$rob_document->venue_address}}</td>
                      <td>
                        <a target="_blank" href="{{asset('rob/'.$rob_document->document_name)}}">
                          View Document
                        </a>
                      </td>
                      <td>
                        {{@$rob_document->caption_name}}
                      </td>
                      @if(Session::get('UserType')!='3')
                      <td>{{@$rob_document->rob_form_id ?'Yes' :'No'}}</td>
                      @endif
                    </tr>
                    @endforeach
                  @endif
                </table>
        </div>
    </div>
</body>
</html>
