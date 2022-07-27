<span id="include">
            <!-- <div class="row text-center" id="preEvent">
              <div class="col-xl-12" style="margin-left: 10px;">
                <h5 style="color: blue;"><u>Pre Event Activities</u></h5>
              </div>
            </div> -->
            </div><!-- row close-->
            @php 
            if(@$data->category_icop=='MI')
            {
              $single_disp='';
            }
            else
            {
              $single_disp='none';
            }
            @endphp
            <!--  for single start-->
            <div class="row" style="align-content: center;display: {{$single_disp}};" id="engagement" id="single">
              <div class="row text-center" id="preEvent">
                <div class="col-xl-12" style="margin-left: 10px;">
                  <h5 style="color: blue;"><u>Pre Event Activities</u></h5>
                </div><br>
              </div>

              <div class="col-xl-10">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width:10%;">Sr. No. : </th>
                      <th style="width:40%;">Activity</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody id="single_one">
                    <tr>
                      <td>1</td>
                      @php
                      if(@$data->engagement_pre_event_activity=='1')
                      {
                        $engagement_pre='';
                      }
                      else
                      {
                        $engagement_pre='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl02_ch_pre_event_activity_single" value="1" type="checkbox" name="engagement_pre_event_activity" {{@$data->engagement_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl02_lbl_pre_event_activity_single">ENGAGEMENT</span>
                      </td>
                      <td valign="middle" id="single">
                        <textarea maxlength="250" name="engagement_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev_single" style="height:50px;width:450px;resize: none; display:{{$engagement_pre}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->engagement_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!--  for single end-->
            @php
            if(@$data->category_icop=='SM')
            {
              $five_disp='';
            }
            else
            {
              $five_disp='none';
            }
            @endphp
            <!-- for 5tab start  -->
            <div class="row" style="align-content: center; display:{{$five_disp}};" id="five1" id="fivemain">
              <div class="row text-center" id="preEvent">
                <div class="col-xl-12" style="margin-left: 10px;">
                  <h5 style="color: blue;"><u>Pre Event Activities </u>  <span style="cursor: pointer; " id="show_five" class="blink_me">Show</span></h5>
                </div>
              </div>
               <div class="col-xl-10" id="five_one">
                <table class="table table-bordered">
                  <thead >
                    <tr>
                      <th style="width:10%;">Sr. No.</th>
                      <th style="width:40%;">Activity</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      @php
                      if(@$data->nukkad_natak_pre_event_activity=='1')
                      {
                        $nukkad_natak_pre='';
                      }
                      else
                      {
                        $nukkad_natak_pre='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl02_ch_pre_event_activity1" value="1" type="checkbox" name="nukkad_natak_pre_event_activity" {{@$data->nukkad_natak_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl02_lbl_pre_event_activity1">NUKKAD NATAK</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="nukkad_natak_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev1" style="height:50px;display:{{$nukkad_natak_pre}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->nukkad_natak_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      @php
                      if(@$data->public_meeting_pre_event_activity=='1')
                      {
                        $public_meeting_pre_event='';
                      }
                      else
                      {
                        $public_meeting_pre_event='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl03_ch_pre_event_activity1" value="1" type="checkbox" name="public_meeting_pre_event_activity" {{@$data->public_meeting_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl03_lbl_pre_event_activity1">PUBLIC MEETING</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_meeting_txt_pre_event" rows="2" cols="20" id="GridView1_ctl03_txt_prev1" style="height:50px;display:{{$public_meeting_pre_event}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->public_meeting_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      @php
                      if(@$data->public_announcement_pre_event_activity=='1')
                      {
                        $public_announcement_pre='';
                      }
                      else
                      {
                        $public_announcement_pre='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl04_ch_pre_event_activity1" value="1" type="checkbox" name="public_announcement_pre_event_activity" {{@$data->public_announcement_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl04_lbl_pre_event_activity1">PUBLIC ANNOUNCEMENTS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_announcement_txt_pre_event" rows="2" cols="20" id="GridView1_ctl04_txt_prev1" style="height:50px;display:{{$public_announcement_pre}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->public_announcement_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      @php
                      if(@$data->distribution_pamphlets_pre_event_activity=='1')
                      {
                        $distribution_pamphlets='';
                      }
                      else
                      {
                        $distribution_pamphlets='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl05_ch_pre_event_activity1" value="1" type="checkbox" name="distribution_pamphlets_pre_event_activity" {{@$data->distribution_pamphlets_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl05_lbl_pre_event_activity1">DISTRIBUTION OF PAMPHLETS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="distribution_pamphlets_txt_pre_event" rows="2" cols="20" id="GridView1_ctl05_txt_prev1" style="height:50px;display:{{$distribution_pamphlets}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->distribution_pamphlets_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      @php
                      if(@$data->social_media_pre_event_activity=='1')
                      {
                        $social_media_pre='';
                      }
                      else
                      {
                        $social_media_pre='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl06_ch_pre_event_activity1" value="1" type="checkbox" name="social_media_pre_event_activity" {{@$data->social_media_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl06_lbl_pre_event_activity1">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="social_media_txt_pre_event" rows="2" cols="20" id="GridView1_ctl06_txt_prev1" style="height:50px;display:{{$social_media_pre}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->social_media_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>

                    <!-- add 26 Apr-->
                    <tr>
                      <td>6</td>
                      @php
                      if(@$data->other_media_pre_event_activity=='1')
                      {
                        $other_media_pre='';
                      }
                      else
                      {
                        $other_media_pre='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView12_ctl06_ch_pre_event_activity1" value="1" type="checkbox" name="other_media_pre_event_activity" {{@$data->other_media_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl06_lbl_pre_event_activity1">OTHER</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="other_media_txt_pre_event" rows="2" cols="20" id="GridView1r_ctl06_txt_prev1" style="height:50px;display:{{$other_media_pre}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->other_media_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
            <!-- for 5tab end  -->
            @php
            if(@$data->programme_activity=='6' || @$data->programme_activity=='5' || @$data->category_icop=='ME' || @$data->category_icop=='BI' || @$data->category_icop=='OT')
            {
              $nine_disp='';
            }
            else
            {
              $nine_disp='none';
            }
            @endphp
            
            <!-- 9 tab start-->
            <div class="row" style="align-content: center;display:{{$nine_disp}};" id="nine">
              <div class="row text-center" id="preEvent">
                <div class="col-xl-12" style="margin-left: 10px;">
                  <h5 style="color: blue;"><u>Pre Event Activities </u> <span style="cursor: pointer;" id="show_nine" class="blink_me">Show</span></h5>
                </div>
              </div>
              <div class="col-xl-12" id="nine_one">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10%;">Sr. No. </th>
                      <th style="width: 30%;">Activity</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody >
                    <tr>
                      <td>1</td>
                      <td>
                        <input id="GridView1_ctl02_ch_pre_event_activity9" value="1" type="checkbox" name="nukkad_natak1_pre_event_activity" {{@$data->nukkad_natak1_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl02_lbl_pre_event_activity">NUKKAD NATAK</span>
                      </td>
                      @php
                      if(@$data->nukkad_natak1_pre_event_activity=='1')
                      {
                        $nukkad_natak1='';
                      }
                      else
                      {
                        $nukkad_natak1='none';
                      }
                      @endphp
                      <td valign="middle">
                        <textarea maxlength="250" name="nukkad_natak1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev9" style="height:50px;display:{{$nukkad_natak1}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->nukkad_natak1_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      @php
                      if(@$data->public_meeting1_pre_event_activity=='1')
                      {
                        $public_meeting1='';
                      }
                      else
                      {
                        $public_meeting1='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl03_ch_pre_event_activity9" value="1" type="checkbox" name="public_meeting1_pre_event_activity" {{@$data->public_meeting1_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl03_lbl_pre_event_activity">PUBLIC MEETING</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_meeting1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl03_txt_prev9" style="height:50px;display:{{$public_meeting1}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->public_meeting1_txt_pre_event ?? ''}}
                        </textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      @php
                      if(@$data->public_announcement1_pre_event_activity=='1')
                      {
                        $public_announcement1='';
                      }
                      else
                      {
                        $public_announcement1='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl04_ch_pre_event_activity9" value="1" type="checkbox" name="public_announcement1_pre_event_activity" {{@$data->public_announcement1_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl04_lbl_pre_event_activity">PUBLIC ANNOUNCEMENTS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_announcement1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl04_txt_prev9" style="height:50px;display:{{$public_announcement1}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->public_announcement1_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      @php
                      if(@$data->distribution_pamphlets1_pre_event_activity=='1')
                      {
                        $distribution_pamphlets1='';
                      }
                      else
                      {
                        $distribution_pamphlets1='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl05_ch_pre_event_activity9" value="1" type="checkbox" name="distribution_pamphlets1_pre_event_activity" {{@$data->distribution_pamphlets1_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl05_lbl_pre_event_activity">DISTRIBUTION OF PAMPHLETS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="distribution_pamphlets1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl05_txt_prev9" style="height:50px;display:{{$distribution_pamphlets1}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->distribution_pamphlets1_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      @php
                      if(@$data->social_media_campaign1_pre_event=='1')
                      {
                        $social_media1='';
                      }
                      else
                      {
                        $social_media1='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl06_ch_pre_event_activity9" value="1" type="checkbox" name="social_media_campaign1_pre_event" {{@$data->social_media_campaign1_pre_event=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl06_lbl_pre_event_activity">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="social_media_campaign1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl06_txt_prev9" style="height:50px;display:{{$social_media1}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->social_media_campaign1_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>6</td>
                      @php
                      if(@$data->public_rally_pre_event_activity=='1')
                      {
                        $public_rally='';
                      }
                      else
                      {
                        $public_rally='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl07_ch_pre_event_activity9" value="1" type="checkbox" name="public_rally_pre_event_activity" {{@$data->public_rally_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl07_lbl_pre_event_activity">PUBLIC RALLY IN NEARBY VILLAGE/TOWNS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_rally_txt_pre_event" rows="2" cols="20" id="GridView1_ctl07_txt_prev9" style="height:50px;display:{{$public_rally}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->public_rally_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>7</td>
                      @php
                      if(@$data->media_briefing_pre_event_activity=='1')
                      {
                        $media_briefing='';
                      }
                      else
                      {
                        $media_briefing='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl08_ch_pre_event_activity9" value="1" type="checkbox" name="media_briefing_pre_event_activity" {{@$data->media_briefing_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl08_lbl_pre_event_activity">MEDIA BRIEFING</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="media_briefing_txt_pre_event" rows="2" cols="20" id="GridView1_ctl08_txt_prev9" style="height:50px;display:{{$media_briefing}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->media_briefing_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>8</td>
                      @php
                      if(@$data->dd_air_curtain_pre_activity=='1')
                      {
                        $dd_air_curtain='';
                      }
                      else
                      {
                        $dd_air_curtain='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl09_ch_pre_event_activity9" value="1" type="checkbox" name="dd_air_curtain_pre_activity" {{@$data->dd_air_curtain_pre_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl09_lbl_pre_event_activity">DD/AIR SCROLL/CURTAIN RAISERS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="dd_air_curtain_txt_pre_activity" rows="2" cols="20" id="GridView1_ctl09_txt_prev9" style="height:50px;display:{{$dd_air_curtain}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->dd_air_curtain_txt_pre_activity ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>9</td>
                      @php
                      if(@$data->social_media_campaign_pre_event=='1')
                      {
                        $social_media_campaign='';
                      }
                      else
                      {
                        $social_media_campaign='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl10_ch_pre_event_activity9" value="1" type="checkbox" name="social_media_campaign_pre_event" {{@$data->social_media_campaign_pre_event=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl10_lbl_pre_event_activity">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="social_media_campaign_txt_pre_event" rows="2" cols="20" id="GridView1_ctl10_txt_prev9" style="height:50px;display:{{$social_media_campaign}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->social_media_campaign_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>

                    <!--  add 26 Apr -->
                    <tr>
                      <td>10</td>
                      @php
                      if(@$data->other_media_campaign_pre_event=='1')
                      {
                        $other_media_campaign='';
                      }
                      else
                      {
                        $other_media_campaign='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl104_ch_pre_event_activity9" value="1" type="checkbox" name="other_media_campaign_pre_event" {{@$data->other_media_campaign_pre_event=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} {{$mouse}}/>
                        <span id="GridView1_ctl10_lbl_pre_event_activity">OTHER</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="other_media_campaign_txt_pre_event" rows="2" cols="20" id="GridView1_ctl105_txt_prev9" style="height:50px;display:{{$other_media_campaign}};" class="form-control" {{$block}} {{$mouse}}>{{@$data->other_media_campaign_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>

                  </tbody>
                </table>


              </div>
            </div>
            <!-- 9 tab end-->
</span>