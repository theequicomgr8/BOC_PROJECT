@php
            if(@$data->programme_activity=='3' || @$data->programme_activity=='4' || @$data->programme_activity=='5' || @$data->programme_activity=='6' || @$data->category_icop=='MI' || @$data->category_icop=='SM' || @$data->category_icop=='ME' || @$data->category_icop=='BI' || @$data->category_icop=='OT')
            {
              $fix_display='';
            }
            else
            {
              $fix_display='none';
            }
            @endphp
            <!-- fixed start-->
            <div id="fixed" style="display: {{$fix_display}};">
              <div class="row">
                <div class="col-xl-12 text-left"><h5 style="color: blue;"><u>ATP Event Activity</u></h5></div>
              </div>
              <div class="row">
                <div class="col-xl-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 5%;">Sr. No.</th>
                        <th style="width: 8%;">Component</th>
                        <th style="width: 30%;">Activity/Details</th>
                        <th style="width: 10%;">No. of Programme</th>
                        <th >Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>
                          <span id="GridView2_ctl02_lbl_main_event_activity">MOBILIZATION <br><span style="cursor: pointer;color: blue;" id="mobilisation">More..</span></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl02_ch_main_event_activity" value="1" type="checkbox" name="mobile_station_main_event_activity" {{@$data->mobile_station_main_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl02_lbl_main_event_desc">In Competition, Sports/Yoga/Quiz/Rangoli/Painting etc</span>
                        </td>
                        @php
                        if(@$data->mobile_station_main_event_activity=='1')
                        {
                          $mobile_station='';
                        }
                        else
                        {
                          $mobile_station='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="mobile_station_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl02_txt_main_no_program" {{$mobile_station}} value="{{@$data->mobile_station_main_no_program ?? ''}}" class="numeric form-control" style="height:50px;" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="mobile_station_main_remark" rows="2" cols="20" id="GridView2_ctl02_txt_main_remarl" {{$mobile_station}} style="height:50px;" class="form-control" {{$block}}>{{@$data->mobile_station_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      
                      <tr id="mobilisation3">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl04_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl04_ch_main_event_activity" value="1" type="checkbox" name="debate_seminar_symposium_main_event" {{@$data->debate_seminar_symposium_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl04_lbl_main_event_desc">Debate/Seminar/Symposium/Expert Lecture</span>
                        </td>
                        @php
                        if(@$data->debate_seminar_symposium_main_event=='1')
                        {
                          $debate_seminar='';
                        }
                        else
                        {
                          $debate_seminar='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="debate_seminar_symposium_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl04_txt_main_no_program"  {{$debate_seminar}} value="{{@$data->debate_seminar_symposium_main_no_program ?? ''}}" class="numeric form-control" style="height:50px;" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="debate_seminar_symposium_main_remark" rows="2" cols="20" id="GridView2_ctl04_txt_main_remarl" {{$debate_seminar}} style="height:50px;" class="form-control" {{$block}}>{{@$data->debate_seminar_symposium_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr id="mobilisation4">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl05_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl05_ch_main_event_activity" value="1" type="checkbox" name="testimonials_main_event" {{@$data->testimonials_main_event=='1' ? 'checked' : ''}} 
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl05_lbl_main_event_desc">Testimonials/Success Stories</span>
                        </td>
                        @php
                        if(@$data->testimonials_main_event=='1')
                        {
                          $testimonials_main='';
                        }
                        else
                        {
                          $testimonials_main='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="testimonials_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl05_txt_main_no_program" {{$testimonials_main}} value="{{@$data->testimonials_main_no_program ?? ''}}" class="numeric form-control" style="height:50px;" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="testimonials_main_remark" rows="2" cols="20" id="GridView2_ctl05_txt_main_remarl"  style="height:50px;" {{$testimonials_main}} class="form-control" {{$block}}>{{@$data->testimonials_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr id="mobilisation5">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl06_lbl_main_event_activity"></span> 
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl06_ch_main_event_activity" value="1" type="checkbox" name="felicitiation_main_event" {{@$data->felicitiation_main_event=='1' ? 'checked' : ''}}
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl06_lbl_main_event_desc">Communication Network (Traditional/Virtual)</span>
                        </td>
                        @php
                        if(@$data->felicitiation_main_event=='1')
                        {
                          $felicitiation_main='';
                        }
                        else
                        {
                          $felicitiation_main='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="felicitiation_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl06_txt_main_no_program" {{$felicitiation_main}} class="numeric form-control" value="{{@$data->felicitiation_main_no_program ?? ''}}" style="height:50px;" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="felicitiation_main_remark" rows="2" cols="20" id="GridView2_ctl06_txt_main_remarl" {{$felicitiation_main}} style="height:50px;" class="form-control" {{$block}}>{{@$data->felicitiation_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      
                      
                      <tr id="mobilisation8">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl09_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl09_ch_main_event_activity" value="1" type="checkbox" name="workshop_main_event" {{@$data->workshop_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl09_lbl_main_event_desc">Public Meeting/Workshop </span>
                        </td>
                        @php
                        if(@$data->workshop_main_event=='1')
                        {
                          $workshop_main='';
                        }
                        else
                        {
                          $workshop_main='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="workshop_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl09_txt_main_no_program" {{$workshop_main}} class="numeric form-control" style="height:50px;" value="{{@$data->workshop_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="workshop_main_remark" rows="2" cols="20" id="GridView2_ctl09_txt_main_remarl" {{$workshop_main}} style="height:50px;" class="form-control" {{$block}}>{{@$data->workshop_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr id="mobilisation9">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl10_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl10_ch_main_event_activity" value="1" type="checkbox" name="media_station_workshop_main_event" {{@$data->media_station_workshop_main_event=='1' ? 'checked' : ''}}
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl10_lbl_main_event_desc">MEDIA SENSITIONS WORKSHOPS</span>
                        </td>
                        @php
                        if(@$data->media_station_workshop_main_event=='1')
                        {
                          $media_station='';
                        }
                        else
                        {
                          $media_station='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="media_station_workshop_main_no_programm" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl10_txt_main_no_program" {{$media_station}} class="numeric form-control" style="height:50px;" value="{{@$data->media_station_workshop_main_no_programm ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="media_station_workshop_main_remark" rows="2" cols="20" id="GridView2_ctl10_txt_main_remarl" {{$media_station}} style="height:50px;" class="form-control" {{$block}}>{{@$data->media_station_workshop_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      
                      <tr id="mobilisation11">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl12_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl12_ch_main_event_activity" value="1" type="checkbox" name="public_meeting_main_event" {{@$data->public_meeting_main_event=='1' ? 'checked' : ''}}
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl12_lbl_main_event_desc">Social Media</span>
                        </td>
                        @php
                        if(@$data->public_meeting_main_event=='1')
                        {
                          $public_meeting='';
                        }
                        else
                        {
                          $public_meeting='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="public_meeting_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl12_txt_main_no_program" {{$public_meeting}} class="numeric form-control" style="height:50px;" value="{{@$data->public_meeting_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="public_meeting_main_remark" rows="2" cols="20" id="GridView2_ctl12_txt_main_remarl" {{$public_meeting}} style="height:50px;" class="form-control" {{$block}}>{{@$data->public_meeting_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr id="mobilisation10">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl11_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl11_ch_main_event_activity" value="1" type="checkbox" name="quiz_competitions_main_event" {{@$data->quiz_competitions_main_event=='1' ? 'checked' : ''}}
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl11_lbl_main_event_desc">Film Show/Other AV Material </span>
                        </td>
                        @php
                        if(@$data->quiz_competitions_main_event=='1')
                        {
                          $quiz_competitions='';
                        }
                        else
                        {
                          $quiz_competitions='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="quiz_competitions_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl11_txt_main_no_program" {{$quiz_competitions}} class="numeric form-control" style="height:50px;" value="{{@$data->quiz_competitions_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="quiz_competitions_main_remark" rows="2" cols="20" id="GridView2_ctl11_txt_main_remarl" {{$quiz_competitions}} style="height:50px;" class="form-control" {{$block}}>{{@$data->quiz_competitions_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr id="mobilisation12">
                        <td></td><!-- Add field-->
                        <td>
                          <span id="GridView2_ctl12_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="mobilisation_other_check" value="1" type="checkbox" name="mobilisation_other_check" {{@$data->mobilisation_other_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl12_lbl_main_event_desc">OTHER</span>
                        </td>
                        @php
                        if(@$data->mobilisation_other_check=='1')
                        {
                          $mobilisation_other='';
                        }
                        else
                        {
                          $mobilisation_other='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="mobilisation_other_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="mobilisation_other_program" {{$mobilisation_other}} class="numeric form-control" style="height:50px;" value="{{@$data->mobilisation_other_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="mobilisation_other_remark" rows="2" cols="20" id="mobilisation_other_remark" {{$mobilisation_other}} style="height:50px;" class="form-control" {{$block}}>{{@$data->mobilisation_other_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      

                      <tr>
                        <td>2</td>
                        <td>
                          <span id="GridView2_ctl13_lbl_main_event_activity">EXHIBITIONS <br><span style="cursor: pointer;color: blue;" id="exhibitions">More..</span></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl13_ch_main_event_activity" value="1" type="checkbox" name="multimedia_component_main_event" {{@$data->multimedia_component_main_event=='1' ? 'checked' : ''}}
                           tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl13_lbl_main_event_desc">Multimedia/Exhibition</span>
                        </td>
                        @php
                        if(@$data->multimedia_component_main_event=='1')
                        {
                          $multimedia_component='';
                        }
                        else
                        {
                          $multimedia_component='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="multimedia_component_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl13_txt_main_no_program" {{$multimedia_component}} class="numeric form-control" style="height:50px;" value="{{@$data->multimedia_component_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="multimedia_component_main_remark" rows="2" cols="20" id="GridView2_ctl13_txt_main_remarl" {{$multimedia_component}} style="height:50px;" class="form-control" {{$block}}>{{@$data->multimedia_component_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr id="exhibitions2"><!-- add new field -->
                        <td></td>
                        <td>
                          <span id="GridView2_ctl13_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="photo_check" value="1" type="checkbox" name="photo_check" {{@$data->photo_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl13_lbl_main_event_desc">PHOTOS/POSTER</span>
                        </td>
                        @php
                        if(@$data->photo_check=='1')
                        {
                          $photo_c='';
                        }
                        else
                        {
                          $photo_c='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="photo_program" type="text" maxlength="5" onkeypress="return onlyNumberKey(event)" id="photo_program" {{$photo_c}} class="numeric form-control" style="height:50px;" value="{{@$data->photo_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="photo_program_remark" rows="2" cols="20" id="photo_program_remark" {{$photo_c}} style="height:50px;" class="form-control" {{$block}}>{{@$data->photo_program_remark ?? ''}}</textarea>
                        </td>
                      </tr>


                      

                      


                      <tr id="exhibitions4">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl13_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="exhibition_other_check" value="1" type="checkbox" name="exhibition_other_check" {{@$data->exhibition_other_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl13_lbl_main_event_desc">OTHER</span>
                        </td>
                        @php
                        if(@$data->exhibition_other_check=='1')
                        {
                          $exhibition_o='';
                        }
                        else
                        {
                          $exhibition_o='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="exhibition_other_program" type="text" maxlength="5" onkeypress="return onlyNumberKey(event)" id="exhibition_other_program" {{$exhibition_o}} class="numeric form-control" style="height:50px;" value="{{@$data->exhibition_other_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="exhibition_other_program_remark" rows="2" cols="20" id="exhibition_other_program_remark" {{$exhibition_o}} style="height:50px;" class="form-control" {{$block}}>{{@$data->exhibition_other_program_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      

                      




                      <tr>
                        <td>3</td>
                        <td>
                          <span id="GridView2_ctl14_lbl_main_event_activity">CULTURAL PERFORMANCE/FOLK COMMUNICATION <br><span style="cursor: pointer;color: blue;" id="cultural">More..</span></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl14_ch_main_event_activity" value="1" type="checkbox" name="nukkad_natak_main_event" {{@$data->nukkad_natak_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl14_lbl_main_event_desc">NUKKAD NATAK</span>
                        </td>
                        @php
                        if(@$data->nukkad_natak_main_event=='1')
                        {
                          $nukkad_na='';
                        }
                        else
                        {
                          $nukkad_na='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="nukkad_natak_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl14_txt_main_no_program" {{$nukkad_na}} class="numeric form-control" style="height:50px;" value="{{@$data->nukkad_natak_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="nukkad_natak_main_remark" rows="2" cols="20" id="GridView2_ctl14_txt_main_remarl" {{$nukkad_na}} style="height:50px;" class="form-control" {{$block}}>{{@$data->nukkad_natak_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr id="cultural2">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl15_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl15_ch_main_event_activity" value="1" type="checkbox" name="property_show_main_event" {{@$data->property_show_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl15_lbl_main_event_desc">PUPPETRY/MAGIC SHOW</span>
                        </td>
                        @php
                        if(@$data->property_show_main_event=='1')
                        {
                          $property_show='';
                        }
                        else
                        {
                          $property_show='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="property_show_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl15_txt_main_no_program" {{$property_show}} class="numeric form-control" style="height:50px;" value="{{@$data->property_show_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="property_show_main_remark" rows="2" cols="20" id="GridView2_ctl15_txt_main_remarl" {{$property_show}} style="height:50px;" class="form-control" {{$block}}>{{@$data->property_show_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      
                      <tr id="cultural4">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl17_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl17_ch_main_event_activity" value="1" type="checkbox" name="folk_song_main_event" {{@$data->folk_song_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl17_lbl_main_event_desc">Folk Song/Folk Dance/Drama</span>
                        </td>
                        @php
                        if(@$data->folk_song_main_event=='1')
                        {
                          $folk_song='';
                        }
                        else
                        {
                          $folk_song='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="folk_song_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl17_txt_main_no_program" {{$folk_song}} class="numeric form-control" style="height:50px;" value="{{@$data->folk_song_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="folk_song_main_remark" rows="2" cols="20" id="GridView2_ctl17_txt_main_remarl" {{$folk_song}} style="height:50px;" class="form-control" {{$block}}>{{@$data->folk_song_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      
                      
                      <tr id="cultural7">
                        <td></td><!-- Add new field -->
                        <td>
                          <span id="GridView2_ctl19_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle"> 
                          <input id="cultural_other_check" value="1" type="checkbox" name="cultural_other_check" {{@$data->cultural_other_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl19_lbl_main_event_desc">OTHER</span>
                        </td>
                        @php
                        if(@$data->cultural_other_check=='1')
                        {
                          $cultural_other='';
                        }
                        else
                        {
                          $cultural_other ='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="cultural_other_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="cultural_other_program" {{$cultural_other}} class="numeric form-control" style="height:50px;" value="{{@$data->cultural_other_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="cultural_other_remark" rows="2" cols="20" id="cultural_other_remark" {{$cultural_other}} style="height:50px;" class="form-control" {{$block}}>{{@$data->cultural_other_remark ?? ''}}</textarea>
                        </td>
                      </tr>


                      <!-- <tr>
                        <td> 4 </td>
                        <td>
                          <span id="GridView2_ctl20_lbl_main_event_activity">AV MEDIUM <br><span style="cursor: pointer;color: blue;" id="av_medium">More..</span></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl20_ch_main_event_activity" value="1" type="checkbox" name="av_medium_main_event" {{@$data->av_medium_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl20_lbl_main_event_desc">FILM SHOW</span>
                        </td>
                        @php
                        if(@$data->av_medium_main_event=='1')
                        {
                          $mobile_station='';
                        }
                        else
                        {
                          $mobile_station='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="av_medium_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl20_txt_main_no_program" {{$mobile_station}} class="numeric form-control" style="height:50px;" value="{{@$data->av_medium_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="av_medium_main_remark" rows="2" cols="20" id="GridView2_ctl20_txt_main_remarl" {{$mobile_station}} style="height:50px;" class="form-control" {{$block}}>{{@$data->av_medium_main_remark ?? ''}}</textarea>
                        </td>
                      </tr> -->

                      <!-- <tr id="av_medium2">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl21_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl21_ch_main_event_activity" value="1" type="checkbox" name="snippet_air_dd_main_event" {{@$data->snippet_air_dd_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl21_lbl_main_event_desc">SNIPPET OF AIR/DD</span>
                        </td>
                        @php
                        if(@$data->snippet_air_dd_main_event=='1')
                        {
                          $snippet_air='';
                        }
                        else
                        {
                          $snippet_air='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="snippet_air_dd_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl21_txt_main_no_program" {{$snippet_air}} class="numeric form-control" style="height:50px;" value="{{@$data->snippet_air_dd_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="snippet_air_dd_main_remark" rows="2" cols="20" id="GridView2_ctl21_txt_main_remarl" {{$snippet_air}} style="height:50px;" class="form-control" {{$block}}>{{@$data->snippet_air_dd_main_remark ?? ''}}</textarea>
                        </td>
                      </tr> -->
                      <!-- <tr id="av_medium3">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl22_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl22_ch_main_event_activity" value="1" type="checkbox" name="other_av_meterial_main_event" {{@$data->other_av_meterial_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl22_lbl_main_event_desc">OTHER AV MATERIAL</span>
                        </td>
                        @php
                        if(@$data->other_av_meterial_main_event=='1')
                        {
                          $other_av='';
                        }
                        else
                        {
                          $other_av='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="other_av_meterial_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl22_txt_main_no_program" {{$other_av}} class="numeric form-control" style="height:50px;" value="{{@$data->other_av_meterial_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="other_av_meterial_main_remark" rows="2" cols="20" id="GridView2_ctl22_txt_main_remarl" {{$other_av}} style="height:50px;" class="form-control" {{$block}}>{{@$data->other_av_meterial_main_remark ?? ''}}</textarea>
                        </td>
                      </tr> -->
                      <!-- <tr>
                        <td>5</td>
                        <td>
                          <span id="GridView2_ctl23_lbl_main_event_activity">FACILIATION THROUGH DEPARTMENTAL STALL <br><span style="cursor: pointer;color: blue;" id="faciliation">More..</span></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl23_ch_main_event_activity" value="1" type="checkbox" name="ten_twelve_stalls_main_event" {{@$data->ten_twelve_stalls_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl23_lbl_main_event_desc">10-12 STALLS</span>
                        </td>
                        @php
                        if(@$data->ten_twelve_stalls_main_event=='1')
                        {
                          $ten_twelve='';
                        }
                        else
                        {
                          $ten_twelve='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="ten_twelve_stalls_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl23_txt_main_no_program" {{$ten_twelve}} class="numeric form-control" style="height:50px;" value="{{@$data->ten_twelve_stalls_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="ten_twelve_stalls_main_remark" rows="2" cols="20" id="GridView2_ctl23_txt_main_remarl" {{$ten_twelve}} style="height:50px;" class="form-control" {{$block}}>{{@$data->ten_twelve_stalls_main_remark ?? ''}}</textarea>
                        </td>
                      </tr> -->

                      <!-- <tr id="faciliation2">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl23_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="stalls_other_check" value="1" type="checkbox" name="stalls_other_check" {{@$data->stalls_other_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl23_lbl_main_event_desc">OTHER</span>
                        </td>
                        @php
                        if(@$data->stalls_other_check=='1')
                        {
                          $stalls_other='';
                        }
                        else
                        {
                          $stalls_other='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="stalls_other_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="stalls_other_program" {{$stalls_other}} class="numeric form-control" style="height:50px;" value="{{@$data->stalls_other_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="stalls_other_remark" rows="2" cols="20" id="stalls_other_remark" {{$stalls_other}} style="height:50px;" class="form-control" {{$block}}>{{@$data->stalls_other_remark ?? ''}}</textarea>
                        </td>
                      </tr> -->
                      <?php 
                      //dd($govts[0]->govt_event);
                      ?>
                      @foreach($govts as $keys => $val)
                      <tr class="govtt">
                        <?php 
                        $govt_ary=array("DISTRIBUTION OF UJWALA GAS CONNECTIONS","DISTRUBUTION OF MUDRA LOANS","DISTRUBUTION OF KISAN CREDITS CARDS","DISTRUBUTION OF OPENING OF ACCOUNTS","DISTRUBUTION OF ANY OTHER GOVT SCHEME","OTHER");
                        ?>
                        @if($keys ==0)
                        <td> 4 </td>
                        <td>
                          <span id="GridView2_ctl24_lbl_main_event_activity">DISTRIBUTION OF GOVT BENEFITS</span>
                        </td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        <td valign="middle">
                          <select name="govt_event[]" class="form-control" style="pointer-events: {{$non}};">
                            <option value="">--------- Select ---------</option>
                            @foreach($govt_ary as $key => $govt)
                            <option {{@$govt==@$val->govt_event ? 'selected' : '' }}>{{$govt}}</option>
                            @endforeach
                          </select>
                        </td>
                        
                        <td valign="middle">
                          <input name="ujwala_gas_main_no_program_[]" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl24_txt_main_no_program"  class="numeric form-control" style="height:50px;" value="{{@$val->ujwala_gas_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="ujwala_gas_main_remark_[]" data-id="{{$keys}}" rows="2" cols="20" id="GridView2_ctl24_txt_main_remarl"  style="height:50px; width: 340px;" class="form-control float-left" {{$block}}>{{@$val->ujwala_gas_main_remark ?? ''}}</textarea>
                          <input type="hidden" name="id_[]" class="id_" value="{{@$val->id ?? ''}}">
                          @if($keys==0 && @$data->status!='2')
                          <span class="btn btn-info" id="govt_add" style="margin-left: 10px;">Add</span>
                          @endif

                        </td>
                        
                      </tr>
                      @endforeach
                      <input type="hidden" name="" id="total_id" value="">
                      <!--  add 2022 7 apr -->
                      <tr>
                        <td> 5 </td>
                        <td>
                          <span id="GridView2_ctl20_lbl_main_event_activity_mobile">MOBILE VAN <br><span style="cursor: pointer;color: blue;" id="mobile_medium">More..</span></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl20_ch_main_event_activity_mobile" value="1" type="checkbox" name="led_main_event" {{@$data->led_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl20_lbl_main_event_desc_mobile">LED van/Digital van</span>
                        </td>
                        @php
                        if(@$data->led_main_event=='1')
                        {
                          $led_station='';
                        }
                        else
                        {
                          $led_station='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="led_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl20_txt_main_no_program_mobile" {{$led_station}} class="numeric form-control" style="height:50px;" value="{{@$data->led_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="led_main_remark" rows="2" cols="20" id="GridView2_ctl20_txt_main_remarl_mobile" {{$led_station}} style="height:50px;" class="form-control" {{$block}}>{{@$data->led_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr id="mobile_medium2">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl21_lbl_main_event_activity_mobile"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl21_ch_main_event_activity_mobile" value="1" type="checkbox" name="auto_main_event" {{@$data->auto_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl21_lbl_main_event_desc_mobile">E-Rickshaw/Auto-Rickshaw</span>
                        </td>
                        @php
                        if(@$data->auto_main_event=='1')
                        {
                          $auto_air='';
                        }
                        else
                        {
                          $auto_air='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="auto_dd_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl21_txt_main_no_program_mobile" {{$auto_air}} class="numeric form-control" style="height:50px;" value="{{@$data->auto_dd_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="auto_dd_main_remark" rows="2" cols="20" id="GridView2_ctl21_txt_main_remarl_mobile" {{$auto_air}} style="height:50px;" class="form-control" {{$block}}>{{@$data->auto_dd_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr id="mobile_medium3">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl21_lbl_main_event_activity_mobile_mini"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl21_ch_main_event_activity_mobile_mini" value="1" type="checkbox" name="mini_auto_main_event" {{@$data->mini_auto_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl21_lbl_main_event_desc_mini">Mini mobile van</span>
                        </td>
                        @php
                        if(@$data->mini_auto_main_event=='1')
                        {
                          $mini_auto_air='';
                        }
                        else
                        {
                          $mini_auto_air='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="mini_auto_dd_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl21_txt_main_no_program_mobile_mini" {{$mini_auto_air}} class="numeric form-control" style="height:50px;" value="{{@$data->mini_auto_dd_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="mini_auto_dd_main_remark" rows="2" cols="20" id="GridView2_ctl21_txt_main_remarl_mobile_mini" {{$mini_auto_air}} style="height:50px;" class="form-control" {{$block}}>{{@$data->mini_auto_dd_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr id="mobile_medium4">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl21_lbl_main_event_activity_mobile_video"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl21_ch_main_event_activity_mobile_video" value="1" type="checkbox" name="video_auto_main_event" {{@$data->video_auto_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl21_lbl_main_event_desc_video">Video van announcement</span>
                        </td>
                        @php
                        if(@$data->video_auto_main_event=='1')
                        {
                          $video_auto_air='';
                        }
                        else
                        {
                          $video_auto_air='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="video_auto_dd_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl21_txt_main_no_program_mobile_video" {{$video_auto_air}} class="numeric form-control" style="height:50px;" value="{{@$data->video_auto_dd_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="video_auto_dd_main_remark" rows="2" cols="20" id="GridView2_ctl21_txt_main_remarl_mobile_video" {{$video_auto_air}} style="height:50px;" class="form-control" {{$block}}>{{@$data->video_auto_dd_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>



                      <tr id="mobile_medium5">
                        <td></td>
                        <td>
                          <span id="GridView2_ctl21_lbl_main_event_activity_mobile_other"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl21_ch_main_event_activity_mobile_other" value="1" type="checkbox" name="other_auto_main_event" {{@$data->other_auto_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl21_lbl_main_event_desc_other">Other option along with textbox</span>
                        </td>
                        @php
                        if(@$data->other_auto_main_event=='1')
                        {
                          $other_auto_air='';
                        }
                        else
                        {
                          $other_auto_air='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="other_auto_dd_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl21_txt_main_no_program_mobile_other" {{$other_auto_air}} class="numeric form-control" style="height:50px;" value="{{@$data->other_auto_dd_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="other_auto_dd_main_remark" rows="2" cols="20" id="GridView2_ctl21_txt_main_remarl_mobile_other" {{$other_auto_air}} style="height:50px;" class="form-control" {{$block}}>{{@$data->other_auto_dd_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      
                      
                      <!-- end 7 apr -->









                    </tbody>
                  </table>
                </div>
              </div>

              <div class="row">
                <div class="col-xl-6">
                  <div class="form-group">
                    <label for="">Social Media Campaign:</label><br>
                    <input id="chk_success" type="checkbox" value="1" name="success_stories" {{@$data->success_stories=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Success Stories <br>
                    <input id="chk_local" type="checkbox" value="1" name="local_input_about_program" {{@$data->local_input_about_program=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Local inputs about the programme<br>
                    <input id="chk_fb" type="checkbox" value="1" name="fb_twitter_instagram" {{@$data->fb_twitter_instagram=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Facebook/Twitter/Instagram<br>
                    <input id="chk_web" type="checkbox" value="1" name="web_streaming" {{@$data->web_streaming=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Web Streaming <br>
                    <input id="chk_live" type="checkbox" value="1" name="live_chat_session" {{@$data->live_chat_session=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Live Chat sessions <br>
                    <input id="chk_talk" type="checkbox" value="1" name="talkathons" {{@$data->talkathons=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>Talkathons<br>
                    <input id="chk_self" type="checkbox" value="1" name="selfie_points" {{@$data->selfie_points=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>Selfie Points <br>
                    <input id="chk_social" type="checkbox" value="1" name="social_media_wall" {{@$data->social_media_wall=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>Social Media Wall<br>
                    <input id="chkoth" type="checkbox" value="1" name="other" {{@$data->other=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Other
                    <span style="display:none;" id="other_field">
                    <!-- <input name="txt_smc_oth" type="text" maxlength="40" id="txt_smc_oth" placeholder="Specify only" class="alph" style="width:120px; "> -->
                    </span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <label for="">Media Coverage : </label>
                    <textarea maxlength="120" name="media_coverage_txt" rows="2" cols="20" id="TextBox1" placeholder="Specify Media Coverage " class="alph form-control" style="height: 170px;" {{$block}}>{{@$data->media_coverage_txt ?? ''}}</textarea>
                  </div>
                </div>
              </div>
            </div>
            <!-- fixed end-->