@extends('admin.layouts.layout')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
  body{
    color: #6c757d !important;
    p,
    label {
      font: 1rem 'Fira Sans', sans-serif;
    }

    input {
      margin: .4rem;
    }
  }
  .multiselect-search{
    width:100% !important;
    margin-right: 10px;
  }
  .dropdown-menu.show {
    display: block;
    width: 100% !important;
  }
  .multiselect-clear-filter{
    display: none !important;
  }
  .hide-msg {
    display: none !important;
  }

  .fa-check {
    color: green;
  }
  a.disabled {
    pointer-events: none;
  }
  .ui-datepicker-trigger{
    width: 25;
    height: 25;
    float: right;
    margin-top: -28px;
    margin-right: 4px;
  }
  .borderless table {
    border-top-style: none;
    border-left-style: none;
    border-right-style: none;
    border-bottom-style: none;
}


// For Location

   /* Core CSS */

  .jls-address-preview--hidden,
  .jls-address-lookup--hidden,
  .jls-manual-address--hidden {
    display: none;
  }

  .jls-manual-address {
    border: 0;
    padding: 0;
    margin: 0;
  }
  .jls-field-wrapper textarea {
    width: 100%;
    padding: 20px;
    background-color: #fff;
    border-radius: 4px;
    border: 2px solid #ced6e0;
    box-shadow: 0 2px 4px rgba(0,0,0,.1);
    margin-top: 10px;
    margin-bottom: 10px;
  }

  /* Custom Google Popout CSS */
  .pac-container {
    margin-top: 10px;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0,0,0,.2);
  }

  .pac-item {
    padding: 10px;
  }

  .pac-item:hover {
    background-color: #1e90ff;
    color: rgba(255,255,255,.7)
  }

  .pac-item:hover .pac-item-query {
    color: #fff;
  }

  .pac-icon-marker {
    display: none;
  }

  .pac-item:first-child {
    border-top: 0;
  }

  .pac-logo:after {
    background-color: #f7f7f7;
      padding: 10px;
      height: 40px;
      background-position: calc(100% - 10px);
    border-top: solid 1px rgba(0,0,0,.1);
  }


</style>
@section('content')
<!-- !empty(@$data->document_type) -->
<!-- if(trim(@$data->document_type) !='') -->
<!-- if(@$rob_documents[0]->event_date!='') -->
@php


if(@$data->status=='11')
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


$user_ype=Session::get('UserType');
@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Pre Event Information</h6> 

    </div>
    <!-- Card Body -->
    <div class="row">
        <div class="col-xl-12">
          <h6 class="alert alert-success" style="width: 100%;display: none; text-align: center;" id="msg"></h6>
        </div>
      </div>
    <div class="card-body">
      
     <div  style ="display: none;"align="center" class="alert alert-success"></div>
     <div style ="display: none;" align="center" class="alert alert-danger"></div>
     <form method="POST" class="client_request"  id="rob_request" enctype="multipart/form-data" >
      @csrf

      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item active show" data-target="#logins-part">
          <a class="nav-link " aria-controls="logins-part" id="logins-part-trigger">Activity / Program</a>
        </li>
      </ul>

      <div class="tab-content">
        <div id="logins-part" class="tab-pane active show">
          <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">
            
            <input type="hidden" name="getid" value="{{Request::segment(2)}}">
            <div class="row">
              <div class="col-xl-4">
                <div class="form-group">
                  <label for="">Category of Programme Activity :<span style="color: red;">*</span></label>
                  <select name="programme_activity" id="ddl_pro_activity" tabindex="{{$tab}}" style="pointer-events:{{$non}};" class="form-control form-control-sm" {{$block}}>
                    <option value="">--Select--</option>
                    <option value="1" {{@$data->programme_activity=='1' ? 'selected': ''}}>Programme Activites(under ICOP) under DCID fund of M/O I&B</option>
                    <option value="6" {{@$data->programme_activity=='6' ? 'selected': ''}}>Programme Activites(other than ICOP) under DCID fund of M/O I&B</option>
                    <option value="2" {{@$data->programme_activity=='2' ? 'selected': ''}}>Programme Activites on SAP under DCID fund of M/O I&B</option>
                    <option value="3" {{@$data->programme_activity=='3' ? 'selected': ''}}>Programme Activites under Establishment fund</option>
                    <option value="4" {{@$data->programme_activity=='4' ? 'selected': ''}}>Programme Activites (ICOP) for other Ministries</option>
                    <option value="5" {{@$data->programme_activity=='5' ? 'selected': ''}}>Programme Activites (Other than ICOP) for other Ministries</option>
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
                    <option id="mi" value="MI" {{@$data->category_icop=='MI' ? 'selected': ''}}>MINI</option>
                    <option id="sm" value="SM" {{@$data->category_icop=='SM' ? 'selected': ''}}>SMALL</option>
                    <option id="me" value="ME" {{@$data->category_icop=='ME' ? 'selected': ''}}>MEDIUM</option>
                    <option id="bi" value="BI" {{@$data->category_icop=='BI' ? 'selected': ''}}>BIG </option>
                    <option id="ot" value="OT" {{@$data->category_icop=='OT' ? 'selected': ''}}>OTHER </option>
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
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Office Type : <span style="color: red;">*</span></label>
                <select name="office_type" id="ddl_off_type2" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                  <option value="">--Select--</option>  
                  <option  value="HQ" {{@$data->office_type == "HQ"  ? 'selected' : ''}}>HEADQUARTER</option>
                  <option  value="FO" {{@$data->office_type == "FO"  ? 'selected' : ''}}>FOBs</option>
                  
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

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Demography : <span style="color: red;">*</span></label>
                <select name="demography" id="ddl_area_nature" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                  <option value="">--Select--</option>
                  <option id="demography1" value="U" {{@$data->demography=='U' ? 'selected' : ''}}>URBAN</option>
                  <option id="demography2" value="R" {{@$data->demography=='R' ? 'selected' : ''}}>RURAL</option>
                  <option id="demography3" value="M" {{@$data->demography=='M' ? 'selected' : ''}}>MINORITY AREA</option>
                  <option id="demography3" value="L" {{@$data->demography=='L' ? 'selected' : ''}}>LWE AREA </option>
                </select>
                <span id="ddl_area_nature_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Area of Activites : <span style="color: red;">*</span></label>
                <select name="activity_area" id="ddl_area_act" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                  <option value="">--Select--</option>
                  <option id="area1" value="V" {{@$data->activity_area=='V' ? 'selected' : ''}}>VILLAGE LEVEL</option>
                  <option id="area2" value="B" {{@$data->activity_area=='B' ? 'selected' : ''}}>BLOCK LEVEL</option>
                  <option id="area3" value="D" {{@$data->activity_area=='D' ? 'selected' : ''}}>DISTRICT LEVEL</option>
                  <option id="area4" value="C" {{@$data->activity_area=='C' ? 'selected' : ''}}>CITY LEVEL</option>
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
                <label for="">Name of Village/Town Covered :<span style="color: red;"></span></label>
                <!-- <input type="text" name="village_name" value="{{@$data->village_name ?? ''}}" id="txt_vilage_name" placeholder="Name of Village/Town covered" class="form-control form-control-sm" {{$block}}> -->
                <textarea name="village_name" id="txt_vilage_name" {{$block}} placeholder="Name of Village/Town covered" class="form-control form-control-sm">{{@$data->village_name ?? ''}}</textarea>
                <span id="txt_vilage_name_err_" style="color: red;"></span>
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
              <div class="form-group">
                <label for="">E-mail ID :<span style="color: red;">*</span></label>
                <input type="text" name="email" value="{{@$data->email ?? ''}}" id="email" placeholder="Enter Your Email" class="form-control form-control-sm" {{$block}}>
                <span id="email_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Venue : </label>
                <textarea maxlength="250" name="venue_event" rows="2" cols="20" id="TextBox1" placeholder="Enter Venue Address" class="alph form-control" style="height: 100px;" {{$block}}>{{@$data->venue_event ?? ''}}</textarea>
              </div>
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
              <h5 style="color: blue;"><u>Duration For Activity/Programme Organised</u></h5>
              @php
              $today = date('Y-m-d');
              @endphp
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <div class="form-group">
                  <label for="">From : <span style="color: red;">*</span></label> 
                  <input name="duration_activity_from_date" value="{{@$data->duration_activity_from_date ?? ''}}" type="date" maxlength="10" id="txt_from" class="calendar1 form-control form-control-sm {{ $click }}" {{$block}} min="{{$today}}" />
                  <span id="txt_from_err_" style="color: red;"></span>
                </div>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">To :<span style="color: red;">*</span></label>
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
            <div class="row text-center" id="preEvent">
              <div class="col-xl-12" style="margin-left: 10px;">
                <h5 style="color: blue;"><u>Pre Event Activities</u></h5>
              </div>
            </div>
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
              <div class="col-xl-10">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width:10%;">Sr. No. : </th>
                      <th style="width:40%;">Activity</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl02_lbl_pre_event_activity_single">ENGAGEMENT</span>
                      </td>
                      <td valign="middle" id="single">
                        <textarea maxlength="250" name="engagement_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev_single" style="height:50px;width:450px;resize: none; display:{{$engagement_pre}};" class="form-control" {{$block}}>{{@$data->engagement_txt_pre_event ?? ''}}</textarea>
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
              <div class="col-xl-10">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width:10%;">Sr</th>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl02_lbl_pre_event_activity1">NUKKAD NATAK</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="nukkad_natak_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev1" style="height:50px;display:{{$nukkad_natak_pre}};" class="form-control" {{$block}}>{{@$data->nukkad_natak_txt_pre_event ?? ''}}</textarea>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl03_lbl_pre_event_activity1">PUBLIC MEETING</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_meeting_txt_pre_event" rows="2" cols="20" id="GridView1_ctl03_txt_prev1" style="height:50px;display:{{$public_meeting_pre_event}};" class="form-control" {{$block}}>{{@$data->public_meeting_txt_pre_event ?? ''}}</textarea>
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
                        <input id="GridView1_ctl04_ch_pre_event_activity1" value="1" type="checkbox" name="public_announcement_pre_event_activity" {{@$data->public_announcement_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl04_lbl_pre_event_activity1">PUBLIC ANNOUNCEMENTS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_announcement_txt_pre_event" rows="2" cols="20" id="GridView1_ctl04_txt_prev1" style="height:50px;display:{{$public_announcement_pre}};" class="form-control" {{$block}}>{{@$data->public_announcement_txt_pre_event ?? ''}}</textarea>
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
                        <input id="GridView1_ctl05_ch_pre_event_activity1" value="1" type="checkbox" name="distribution_pamphlets_pre_event_activity" {{@$data->distribution_pamphlets_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl05_lbl_pre_event_activity1">DISTRIBUTION OF PAMPHLETS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="distribution_pamphlets_txt_pre_event" rows="2" cols="20" id="GridView1_ctl05_txt_prev1" style="height:50px;display:{{$distribution_pamphlets}};" class="form-control" {{$block}}>{{@$data->distribution_pamphlets_txt_pre_event ?? ''}}</textarea>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl06_lbl_pre_event_activity1">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="social_media_txt_pre_event" rows="2" cols="20" id="GridView1_ctl06_txt_prev1" style="height:50px;display:{{$social_media_pre}};" class="form-control" {{$block}}>{{@$data->social_media_txt_pre_event ?? ''}}</textarea>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl06_lbl_pre_event_activity1">OTHER</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="other_media_txt_pre_event" rows="2" cols="20" id="GridView1r_ctl06_txt_prev1" style="height:50px;display:{{$other_media_pre}};" class="form-control" {{$block}}>{{@$data->other_media_txt_pre_event ?? ''}}</textarea>
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
              <div class="col-xl-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10%;">Sr</th>
                      <th style="width: 30%;">Activity</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>
                        <input id="GridView1_ctl02_ch_pre_event_activity9" value="1" type="checkbox" name="nukkad_natak1_pre_event_activity" {{@$data->nukkad_natak1_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
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
                        <textarea maxlength="250" name="nukkad_natak1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev9" style="height:50px;display:{{$nukkad_natak1}};" class="form-control" {{$block}}>{{@$data->nukkad_natak1_txt_pre_event ?? ''}}</textarea>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl03_lbl_pre_event_activity">PUBLIC MEETING</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_meeting1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl03_txt_prev9" style="height:50px;display:{{$public_meeting1}};" class="form-control" {{$block}}>{{@$data->public_meeting1_txt_pre_event ?? ''}}
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
                        <input id="GridView1_ctl04_ch_pre_event_activity9" value="1" type="checkbox" name="public_announcement1_pre_event_activity" {{@$data->public_announcement1_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl04_lbl_pre_event_activity">PUBLIC ANNOUNCEMENTS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_announcement1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl04_txt_prev9" style="height:50px;display:{{$public_announcement1}};" class="form-control" {{$block}}>{{@$data->public_announcement1_txt_pre_event ?? ''}}</textarea>
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
                        <input id="GridView1_ctl05_ch_pre_event_activity9" value="1" type="checkbox" name="distribution_pamphlets1_pre_event_activity" {{@$data->distribution_pamphlets1_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl05_lbl_pre_event_activity">DISTRIBUTION OF PAMPHLETS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="distribution_pamphlets1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl05_txt_prev9" style="height:50px;display:{{$distribution_pamphlets1}};" class="form-control" {{$block}}>{{@$data->distribution_pamphlets1_txt_pre_event ?? ''}}</textarea>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl06_lbl_pre_event_activity">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="social_media_campaign1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl06_txt_prev9" style="height:50px;display:{{$social_media1}};" class="form-control" {{$block}}>{{@$data->social_media_campaign1_txt_pre_event ?? ''}}</textarea>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl07_lbl_pre_event_activity">PUBLIC RALLY IN NEARBY VILLAGE/TOWNS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="public_rally_txt_pre_event" rows="2" cols="20" id="GridView1_ctl07_txt_prev9" style="height:50px;display:{{$public_rally}};" class="form-control" {{$block}}>{{@$data->public_rally_txt_pre_event ?? ''}}</textarea>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl08_lbl_pre_event_activity">MEDIA BRIEFING</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="media_briefing_txt_pre_event" rows="2" cols="20" id="GridView1_ctl08_txt_prev9" style="height:50px;display:{{$media_briefing}};" class="form-control" {{$block}}>{{@$data->media_briefing_txt_pre_event ?? ''}}</textarea>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl09_lbl_pre_event_activity">DD/AIR SCROLL/CURTAIN RAISERS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="dd_air_curtain_txt_pre_activity" rows="2" cols="20" id="GridView1_ctl09_txt_prev9" style="height:50px;display:{{$dd_air_curtain}};" class="form-control" {{$block}}>{{@$data->dd_air_curtain_txt_pre_activity ?? ''}}</textarea>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl10_lbl_pre_event_activity">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="social_media_campaign_txt_pre_event" rows="2" cols="20" id="GridView1_ctl10_txt_prev9" style="height:50px;display:{{$social_media_campaign}};" class="form-control" {{$block}}>{{@$data->social_media_campaign_txt_pre_event ?? ''}}</textarea>
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
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl10_lbl_pre_event_activity">OTHER</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="250" name="other_media_campaign_txt_pre_event" rows="2" cols="20" id="GridView1_ctl105_txt_prev9" style="height:50px;display:{{$other_media_campaign}};" class="form-control" {{$block}}>{{@$data->other_media_campaign_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>

                  </tbody>
                </table>


              </div>
            </div>
            <!-- 9 tab end-->
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
          <label>Photo upload (Accept only : jpg,png,gif)  : </label>
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
                      <input type="file" name="pre_photo" class="custom-file-input {{$click}}" id="pre_photo" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} >
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
        <div class="col-xl-4"><br>
          <input type="checkbox" name="pre_show_website" value="1" {{$check}}> Update on Event Calendar
        </div>
          </div>


          <div class="row">
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Officer Person :<span style="color: red;"></span></label>
                <input type="text" name="officer_name_person" value="{{@$data->officer_name_person ?? ''}}" id="vip_designation" onkeypress="return alphaOnly(event);" placeholder="Officer Name" class="form-control form-control-sm" {{$block}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Contact No. :<span style="color: red;"></span></label>
                <input type="text" name="contact_no" value="{{@$data->contact_no ?? ''}}" id="contact_no" onkeypress="return onlyNumberKey(event)" maxlength="10" placeholder="Contact No." class="form-control form-control-sm" {{$block}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Designation :<span style="color: red;"></span></label>
                <input type="text" name="person_designation" value="{{@$data->person_designation ?? ''}}" id="person_designation" onkeypress="return alphaOnly(event)" maxlength="10" placeholder="Designation" class="form-control form-control-sm" {{$block}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>
            @php
            if(@$data->system_date==null)
            {
              $none='none';
            }
            else
            {
              $none='';
            }
            @endphp
            <div class="col-xl-4" style="display: {{$none}}">
              <div class="form-group">
                <label for="">Date:<span style="color: red;"></span></label>
                <input type="date" name="system_date" value="{{@$data->system_date ?? ''}}" class="form-control form-control-sm" {{$block}}>
                <span id="system_date_err_" style="color: red;"></span>
              </div>
            </div>

          </div>


          @if(@$data->sop_theme=='')
          <input type="hidden" name="get_id" id="get_id" value="0"> 
          @else
          <input type="hidden" name="url_id" value="{{@$data->Pk_id ?? ''}}">
          <input type="hidden" name="get_id" id="get_id" value="1">
          @endif 
          <div class="row">
            <div class="col-sm-12 text-right">
               <input type="hidden" id="next_tab_1">
               @if(@$data->status=='11')
               {{-- <a class="btn btn-primary client-next-button btn-sm m-0" >Save <i class="fa fa-caret-right"></i></a> --}}
               @else
               <a class="btn btn-primary client-next-button btn-sm m-0" id="tab_1">Save <i class="fa fa-caret-right"></i></a>
               @endif
              
              
              <!-- <input type="hidden" name="fetch_id" value="{{@$data->Pk_id}}"> -->
              <!-- <a class="btn btn-primary client-next-button btn-sm m-0"   id="tab_1">Next1 <i class="fa fa-caret-right"></i></a> -->
              
            </div>
          </div>
        </div>  <!-- tab-pane close -->



       </div> <!-- tab-content close -->
     </form>
   </div>  <!-- card-body close -->
 </div>  <!-- card shadow close -->
</div>   <!-- content-inside close -->
@endsection
@section('custom_js')
<script src="{{ url('/js') }}/validator.js"></script>
<script src="{{ url('/arogi/js') }}/pre_rob_form.js"></script>
<script src="{{asset('arogi/js/adg_pre.js')}}" type="text/javascript"></script>
<!-- <script src="{{asset('arogi/js/pre_custom.js')}}" type="text/javascript"></script> -->

<script>

$(document).ready(function(){
    var i=1;
    $("#Button1").click(function(e){
        e.preventDefault();
        i++;
        $("#FileUploadContainer").append('<tr id="row'+i+'"><td>File : <input type="file"  name="document_name[]" id="pic" class="form-control form-control-sm" style="width: 336px;"></td><td> Caption Name: <input type="text" name="caption_name[]" id="caption_name" class="form-control form-control-sm" style="width: 334px;margin-left: -10px;"></td><td><br><input type="checkbox" name="show_website[]" id="show_website" value="1"> Show On Website</td><td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td></tr>'+"<br><br>");
    });

    $(document).on("click",'.remove',function(e){
        e.preventDefault();
        var id=$(this).attr('id');
        $("#row"+id).remove();
    });

    //for day count
      $("#txt_to").blur(function() {
        var start = $("#txt_from").val();
        var end = $("#txt_to").val();
        var days = (Date.parse(end) - Date.parse(start)) / 86400000+1;
        $("#txt_tot_prog_day").attr('value', days);
      });

      $("#txt_from").blur(function(){
        $("#txt_tot_prog_day").attr("value",'');

        var $el = $('#txt_to');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();

      });
});



$(document).ready(function(){
    var i=1;
    $("#press").click(function(e){
        e.preventDefault();
        i++;
        $("#PressUploadContainer").append('<tr id="row'+i+'"><td>File : <input type="file"  name="press_document_name[]" id="press_pic" class="form-control form-control-sm" style="width: 336px;"></td><td> Caption Name: <input type="text" name="press_caption_name[]" id="press_caption_name" class="form-control form-control-sm" style="width: 334px;margin-left: -10px;"></td><td><br><input type="checkbox" name="press_show_website[]" id="press_show_website" value="1"> Show On Website</td><td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td></tr>'+"<br><br>");
    });

    $(document).on("click",'.remove',function(e){
        e.preventDefault();
        var id=$(this).attr('id');
        $("#row"+id).remove();
    });

    //for day count
      // $("#txt_to").blur(function() {
      //   var start = $("#txt_from").val();
      //   var end = $("#txt_to").val();
      //   var days = (Date.parse(end) - Date.parse(start)) / 86400000+1;
      //   $("#txt_tot_prog_day").attr('value', days);
      // });

      // $("#txt_from").blur(function(){
      //   $("#txt_tot_prog_day").attr("value",'');

      //   var $el = $('#txt_to');
      //   $el.wrap('<form>').closest('form').get(0).reset();
      //   $el.unwrap();

      // });
});




function nextSaveData(tab='') {
    // console.log(tab);
   // e.preventDefault();
   if(tab=='next_tab_1'){
    $('#next_tab_1').val(tab);

  }
  if(tab =='submit_btn')
  {
      /*var value=$('#multi_langauge_select').val();
      console.log('value',value);
      return false;*/

      $('#next_tab_2').val(tab);

    }
    
    

  }




  
  

</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script type="text/javascript">
function nextSaveData(id){

}
nextSaveData();

</script>
<style type="text/css">
  .multiselect-container {
    overflow-x:scroll;
    height: 400px;
  }
  .multiselect-container>li>a>label {
    height: auto;
  }
</style>
<script type="text/javascript">
  function alphadash(event) {
    var inputValue = event.charCode;
    if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0) && (inputValue!=45)){
      event.preventDefault();
    }
  }


  $(document).ready(function() {
        $('.preventLeftClick').on('click', function(e) {
            e.preventDefault();
            return false;
        });
    });
</script>
@endsection