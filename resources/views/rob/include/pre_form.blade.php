@if(Session::get('UserType')=='2')
            <input type="hidden" name="rob_name" value="{{Session::get('UserName')}}">
            @else
            <input type="hidden" name="rob_name" value="{{Session::get('rob_name')}}">
            @endif
            <div class="row">
              <div class="col-xl-4">
                <div class="form-group">
                  <label for="">Category of Programme Activity :<span style="color: red;">*</span></label>
                  <select name="programme_activity" id="ddl_pro_activity" tabindex="{{$tab}}" style="pointer-events:{{$non}};" class="form-control form-control-sm" {{$block}}>
                    <option value="">--Select--</option>
                    <option value="1" {{@$data->programme_activity=='1' ? 'selected': ''}}>Programme Activites (under ICOP) under DCID fund of M/O I&B</option>
                    <option value="6" {{@$data->programme_activity=='6' ? 'selected': ''}}>Programme Activites (other than ICOP) under DCID fund of M/O I&B</option>
                    <option value="2" {{@$data->programme_activity=='2' ? 'selected': ''}}>Programme Activites on SAP under DCID fund of M/O I&B</option>
                    <option value="3" {{@$data->programme_activity=='3' ? 'selected': ''}}>Programme Activites under Establishment fund</option>
                    <option value="4" {{@$data->programme_activity=='4' ? 'selected': ''}}>Programme Activites (ICOP) for Client Ministries</option>
                    <option value="5" {{@$data->programme_activity=='5' ? 'selected': ''}}>Programme Activites (Other than ICOP) for Client Ministries</option>
                    <option value="7" {{@$data->programme_activity=='7' ? 'selected': ''}} >Mann Ki Baat</option>
                  </select>
                </div>
                <span id="ddl_pro_activity_err_" style="color: red;"></span>
              </div>

              @php
              if(@$data->ministry_name=='')
              {
                $ministry_show='none';
              }
              else
              {
                $ministry_show='';
              }
              @endphp
              <div class="col-xl-4" id="ministry_section" style="display: {{$ministry_show}};">
                <div class="form-group">
                  <label>Ministry Name : </label>
                  <select name="ministry_name" class="form-control form-control-sm" id="ministry_name" style="pointer-events:{{$non}};" {{$block}}>
                    <option value="">Select Ministry Name</option>
                    @foreach(@$ministry_data as $ministry_list)
                    <option value="{{$ministry_list->ministry_name}}" {{@$data->ministry_name==$ministry_list->ministry_name ? 'selected' : ''}}>{{$ministry_list->ministry_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              @php
              if(@$data->programme_activity=='1' || @$data->programme_activity=='2' || @$data->programme_activity=='3' || @$data->programme_activity=='4')
              {
                $icop_disp='';
              }
              else
              {
                $icop_disp='none';
              }
              @endphp
              <div class="col-xl-4" id="icop" style="display: {{$icop_disp}}">
                <div class="form-group">
                  <label for="">Category under ICOP :</label>
                  <select name="category_icop" id="ddl_categ_icop" tabindex="{{$tab}}" style="pointer-events:{{$non}};" class="form-control form-control-sm" {{$block}}>
                    <option value="">--Select--</option>
                    <option  value="MI" {{@$data->category_icop=='MI' ? 'selected': ''}}>MINI</option>
                    <option  value="SM" {{@$data->category_icop=='SM' ? 'selected': ''}}>SMALL</option>
                    <option  value="ME" {{@$data->category_icop=='ME' ? 'selected': ''}}>MEDIUM</option>
                    <option  value="BI" {{@$data->category_icop=='BI' ? 'selected': ''}}>BIG </option>
                    <option  value="OT" {{@$data->category_icop=='OT' ? 'selected': ''}}>OTHER </option>
                  </select>
                </div>
            </div>
            @php
            if(@$data->activity_checkbox1!='')
            {
              $check=explode(",",$data->activity_checkbox1);
            }
            @endphp
              <div class="col-xl-4">
                <div class="form-group">
                  <label for="">Type of Activity : <span style="color: red;">*</span></label><br>
                  <input id="CheckBoxList1_0" value="FIELD" type="checkbox" name="activity_checkbox1[]" {{@in_array('FIELD',$check) ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> FIELD COMMUNICATION<br>
                  <input id="CheckBoxList1_1" value="FOLK" type="checkbox" name="activity_checkbox1[]" {{@in_array('FOLK',$check) ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> FOLK COMMUNICATION <br>
                  <input id="CheckBoxList1_2" value="EXHIBITION" type="checkbox" name="activity_checkbox1[]" {{@in_array('EXHIBITION',$check) ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> EXHIBITION<br>
                </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Theme of Activity/Programme : <span style="color: red;">*</span></label>
                <input name="sop_theme" type="text" tabindex="-1" value="{{@$data->sop_theme ?? ''}}" id="txt_sop_theme"  class="form-control form-control-sm" placeholder="Theme of Activity/Programme" onMaxLength="100" {{$block}}/>
                <span id="txt_sop_theme_err_" style="color: red;"></span>
              </div>
            </div>
            @if(@$user_ype=='2')
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Office Type : <span style="color: red;">*</span></label>
                <select name="office_type" id="ddl_off_type" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                  <option value="">--Select--</option>  
                  <!-- <option id="ot1" value="HQ" {{@$data->office_type == "HQ"  ? 'selected' : ''}}>ROB {{@$offTyp->rob_hq}}  HEADQUARTER</option>
                  <option id="ot2" value="FO" {{@$data->office_type == "FO"  ? 'selected' : ''}}>{{@$offTyp->rob_hq}} FOB</option> -->
                  <option id="ot1" value="HQ" {{@$data->office_type == "HQ"  ? 'selected' : ''}}>RO</option>
                  <option id="ot2" value="FO" {{@$data->office_type == "FO"  ? 'selected' : ''}}>FOs</option>
                  
                  <!-- <option>{{@$offTyp->rob_hq}}</option> -->
                  
                </select>
                <span id="ddl_off_type_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Region : <span style="color: red;">*</span></label>
                <select name="region_id" id="ddl_rob_region" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                  <option value="">---Select----</option>
                  @if(@$data->office_type=='HQ')
                    @if (@$data->region_id!='') 
                      @foreach($offRegion as $reg)
                        @if(@trim($reg->rob_hq)!='')
                          <option value="{{$reg->rob_hq}}" {{@$reg->rob_hq==$data->region_id ? 'selected' : ''}}>{{$reg->rob_hq}}</option>
                        @endif
                      @endforeach  
                    @endif
                  @endif

                  @if(@$data->office_type=='FO')
                    @if (@$data->region_id!='') 
                      @foreach($offRegion as $reg)
                      <option value="{{$reg->rob_fo}}" {{@$reg->rob_fo==$data->region_id ? 'selected' : ''}}>{{$reg->rob_fo}}</option>                  
                      @endforeach  
                    @endif
                  @endif


                </select>
                <span id="ddl_rob_region_err_" style="color: red;"></span>
              </div>
            </div>
            @endif

            @php

            $search=explode(",",@$data->demography);
            //dd($search);
            @endphp
            
            <div class="col-xl-4" style="pointer-events:{{$non}};">
              <div class="form-group">  <!-- Demography -->
                <label for="">Target Area Description : <span style="color: red;">*</span></label>
                <select name="demography[]" id="ddl_area_nature" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}  multiple="multiple">

                  @foreach($demographys as $demogra)
                    <option {{ @in_array($demogra->demography,$search) ? 'selected': '' }}>{{ @$demogra->demography }}</option>
                  @endforeach
                </select>
                <span id="ddl_area_nature_err_" style="color: red;"></span>
              </div>
            </div>
            @php
            $area_search=explode(",",@$data->activity_area);
            @endphp
            <div class="col-xl-4" style="pointer-events:{{$non}};">
              <div class="form-group">
                <label for="">Area of Activities : <span style="color: red;">*</span></label>
                <select name="activity_area[]" id="ddl_area_act" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} multiple="multiple" required>

                  @foreach($area_data as $area)
                    <option value="{{ @$area->activity_name }}" {{ @in_array($area->activity_name,$area_search) ? 'selected': '' }}>{{ @$area->activity_name }}</option>
                  @endforeach
                  
                </select>
                <span id="ddl_area_act_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Coverage (Village/Town Covered) : <span style="color: red;">*</span></label>
                <input name="coverage" {{$block}} type="text" value="{{@$data->coverage ?? ''}}" onkeypress="return onlyNumberKey(event)" maxlength="10" id="txt_no_covered" placeholder="No. of Village/Towns Covered" class="numeric form-control form-control-sm"/>
                <span id="txt_no_covered_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Name of Village/Town Covered :<span style="color: red;">*</span></label>
                <!-- <input type="text" name="village_name" value="{{@$data->village_name ?? ''}}" id="txt_vilage_name" placeholder="Name of Village/Town covered" class="form-control form-control-sm" {{$block}}> -->
                <textarea name="village_name" id="txt_vilage_name" {{$block}} placeholder="Name of Village/Town covered" class="form-control form-control-sm">{{@$data->village_name ?? ''}}</textarea>
                <span id="txt_vilage_name_err_" style="color: red;"></span>
              </div>
            </div>


            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Block :<span style="color: red;">*</span></label>
                <input type="text" name="block" value="{{@$data->block ?? ''}}" id="block" onkeypress="return alphaOnly(event);" placeholder="Enter Block" class="form-control form-control-sm" {{$block}}>
                <span id="block_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">District :<span style="color: red;">*</span></label>
                <input type="text" name="district" value="{{@$data->district ?? ''}}" id="district" onkeypress="return alphaOnly(event);" placeholder="Enter District" class="form-control form-control-sm" {{$block}}>
                <span id="district_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Distance Covered (in km) :<span style="color: red;">*</span></label>
                <input type="text" name="distance_covered" value="{{@$data->distance_covered ?? ''}}" id="distance_covered" onkeypress="return onlyNumberKey(event);" placeholder="Enter Distance" class="form-control form-control-sm" {{$block}} maxlength="3">
                <span id="distance_covered_err_" style="color: red;"></span>
              </div>
            </div>
            
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Date of Last Visit :<span style="color: red;"></span></label>
                <input type="date" name="last_visit_date" value="{{@$data->last_visit_date ?? ''}}" id="last_visit_date"  class="form-control form-control-sm" {{$block}} max="{{ date('Y-m-d'); }}">
                <span id="last_visit_date_err_" style="color: red;"></span>
              </div>
            </div>



            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Name of VIP :<span style="color: red;"></span></label>
                <input type="text" name="vip_name" value="{{@$data->vip_name ?? ''}}" id="vip_name" onkeypress="return alphaOnly(event);" placeholder="Name of VIP" class="form-control form-control-sm" {{$block}}>
                <span id="vip_name_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Designation of VIP :<span style="color: red;"></span></label>
                <input type="text" name="vip_designation" value="{{@$data->vip_designation ?? ''}}" id="vip_designation" onkeypress="return alphaOnly(event);" placeholder="VIP Designation" class="form-control form-control-sm" {{$block}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>

            

            <div class="col-xl-4">
              @include('rob.include.venue')
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Event Description : </label>
                <textarea maxlength="250" name="event_description" rows="2" cols="20" id="TextBox1" placeholder="Enter Event Description" class="alph form-control" style="height: 100px;" {{$block}}>{{@$data->event_description ?? ''}}</textarea>
              </div>
            </div>



            <!-- <div class="jls-field-wrapper jls-address-lookup col-xl-6">
              <label>
                <div>Venue : </div>
                <textarea  placeholder="Start typing your full address" rows="2" cols="20" style="height: 70px; width: 340px;" class="jls-address-lookup__field alph form-control" autocomplete="off"  name="venue_event" {{$block}}>{{@$data->venue_event ?? ''}}</textarea>
              </label>
            </div>
            <div class="jls-address-preview jls-address-preview--hidden">
              <div class="jls-address-preview__header">
                <div class="jls-address-preview__title"></div>
                <a href="#" class="jls-address-lookup__manual-link"></a>
              </div>
              <div class="jls-address-preview__content">
                
              </div>
            </div> -->



            <div class="col-xl-12">
              <h5 style="color: blue;"><u>Duration For Activity/Programme Organized</u></h5>
              @php
              $today = date('Y-m-d');
              @endphp
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <div class="form-group">
                  <label for="">From Date : <span style="color: red;">*</span></label> 
                  <input name="duration_activity_from_date" value="{{@$data->duration_activity_from_date ?? ''}}" type="date" maxlength="10" id="txt_from" class="calendar1 form-control form-control-sm {{ $click }}" {{$block}} min="{{$today}}" />
                  <span id="txt_from_err_" style="color: red;"></span>
                </div>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">To Date :<span style="color: red;">*</span></label>
                <input name="duration_activity_to_date" type="date" value="{{@$data->duration_activity_to_date ?? ''}}" maxlength="10" id="txt_to" class="calendar1 form-control form-control-sm {{ $click }}" {{$block}}/>
                <span id="txt_to_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">No. of Days:</label>
                <input name="no_of_days" type="text" value="{{@$data->no_of_days ?? ''}}" maxlength="10" id="txt_tot_prog_day" readonly class="numeric form-control form-control-sm" />
              </div>
            </div>
            <!-- Pre activity section include  -->
            
            
              @include('rob.include.pre_event_activities')
            
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
            
            <!-- fixed end-->
            
          


          </div> 
          <div class="row">
            <div class="col-xl-4">
          <label>Photo upload (Accept only : jpg, png, gif)  : </label>
          <div class="form-group">
              <!-- <label for="exampleInputFile">Detail Report Of Program : <font color="red">*</font></label> -->
              @php
                  if(@$data->pre_photo!='')
                  {
                    $str=$data->pre_photo;
                    // $pre_photo=mb_strimwidth($str, 0, 11, ".pdf");
                    $ext=substr($str, -4, 4);
                    // $pre_photo=substr($str, 0, 19) . $ext;
                    $pre_photo="photo". $ext;
                  }
                  else
                  {
                    $pre_photo='Choose file';
                  }
                  
              @endphp
              <div class="input-group">
                  <div class="custom-file">
                      <input type="file" name="pre_photo" class="custom-file-input {{$click}}" id="pre_photo" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} accept="image/png, image/gif, image/jpeg">
                      <label class="custom-file-label" id="pre_photo2" for="pre_photo">{{ $pre_photo ?? 'Choose file'}}</label>
                  </div>
                  @if(@$data->pre_photo != '')
                  <div class="input-group-append">
                      <span class="input-group-text"><a href="{{asset('rob/'.@$data->pre_photo)}}" target="_blank">View</a></span>
                  </div>
                  @else
                  <div class="input-group-append">
                      <span class="input-group-text" id="pre_photo3">Upload</span>
                  </div>
                  @endif
              </div>
              <span id="pre_photo1" class="error invalid-feedback"></span>
          </div>
        </div>


        @php
        if(@$data->pre_show_website=='1')
        {
          $check='checked';
          $disabled='disabled';
        }
        else
        {
          $check='';
          $disabled='';
        }
        @endphp
        @if(Session::get('UserType')==2)
        <div class="col-xl-4"><br>
          <input type="checkbox" name="pre_show_website" value="1" {{$check}}> Update on Event Calendar
        </div>
        @endif
          </div>

          <!--  Organizer detail start -->
            @include('rob.include.organizer_detail')
            <!--  Organizer detail end -->