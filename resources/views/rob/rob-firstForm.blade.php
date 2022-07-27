@extends('admin.layouts.layout')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('arogi/css/rob_style.css')}}">
<style>
  body{
    color: #6c757d !important;
    p,
    label {
      font: 1rem 'Fira Sans', sans-serif;
    }

    .mouse
    {
      pointer-events:none;
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


.blink_me {
  animation: blinker 1s linear infinite;
  color: red;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}

/* Core location CSS */

  

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
<style type="text/css">
  .multiselect-container>li>a>label {
  padding: 4px 20px 3px 20px;
}
</style>
@section('content')
<!-- !empty(@$data->document_type) -->
<!-- if(trim(@$data->document_type) !='') -->
<!-- if(@$rob_documents[0]->event_date!='') -->
@php

if(count($govts)==0)
{
  $govts=[1];
}
else
{
  $govts=$govts;
}

$today = date('Y-m-d');
if(@$data->status=='2')
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

if(@$data->status=='1')
{
  $mouse='readonly';
}
else
{
  $mouse='';

}

if(Session::get('UserType') =='7')
{
  $block='readonly';
  $non='none';
  $tab='-1';
  $click='preventLeftClick';
}


$user_ype=Session::get('UserType');
@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i>ATP Form</h6> 
      <h6 class="m-0 text-primary"><a href="{{url('post-form-pdf/'.@$data->Pk_id)}}"><i class="fa fa-download"></i> ATP reciept download</a></h6>
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
          <a class="nav-link " aria-controls="logins-part" id="logins-part-trigger">TTP Activity</a>
        </li>
        <li class="nav-item" data-target="#logins-part1">
          <a class="nav-link " aria-controls="logins-part1" id="logins-part1-trigger">ATP Activity</a>
        </li> 
        <li class="nav-item" data-target="#logins-part2">
          <a class="nav-link " aria-controls="logins-part2" id="logins-part2-trigger">Photo/Videos upload</a>
        </li> 
        <!-- <li class="nav-item" data-target="#logins-part3">
          <a class="nav-link " aria-controls="logins-part3" id="logins-part3-trigger">Photo/Videos upload</a>
        </li>  -->
      </ul>

      <div class="tab-content">
        <div id="logins-part" class="tab-pane active show">
          <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">
            @if(Session::get('UserType')=='2')
            <input type="hidden" name="rob_name" value="{{Session::get('UserName')}}">
            @else
            <input type="hidden" name="rob_name" value="{{Session::get('rob_name')}}">
            @endif
            <input type="hidden" name="getid" value="{{Request::segment(2)}}">
            <div class="row">
              <div class="col-xl-4">
                <div class="form-group">
                  <label for="">Category of Programme Activity :<span style="color: red;">*</span></label>
                  <select name="programme_activity" id="ddl_pro_activity" tabindex="{{$tab}}" style="pointer-events:none;" class="form-control form-control-sm" readonly>
                    <option value="">--Select--</option>
                    <option value="1" {{@$data->programme_activity=='1' ? 'selected': ''}}>Programme Activites(under ICOP) under DCID fund of M/O I&amp; B</option>
                    <option value="6" {{@$data->programme_activity=='6' ? 'selected': ''}}>Programme Activites(other than ICOP) under DCID fund of M/O I&amp; B</option>
                    <option value="2" {{@$data->programme_activity=='2' ? 'selected': ''}}>Programme Activites on SAP under DCID fund of M/O I&amp; B</option>
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
                  <select name="ministry_name" class="form-control form-control-sm" id="ministry_name" style="pointer-events:none;" readonly>
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
                  <select name="category_icop" id="ddl_categ_icop" tabindex="{{$tab}}" style="pointer-events:none;" class="form-control form-control-sm" readonly>
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
                  <input id="CheckBoxList1_0" value="FIELD" type="checkbox" name="activity_checkbox1[]" {{@in_array('FIELD',$check) ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:none;" {{$block}}/> FIELD COMMUNICATION<br>
                  <input id="CheckBoxList1_1" value="FOLK" type="checkbox" name="activity_checkbox1[]" {{@in_array('FOLK',$check) ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:none;" {{$block}}/> FOLK COMMUNICATION <br>
                  <input id="CheckBoxList1_2" value="EXHIBITION" type="checkbox" name="activity_checkbox1[]" {{@in_array('EXHIBITION',$check) ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:none;" {{$block}}/> EXHIBITION<br>
                </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Theme of Activity/Programme : <span style="color: red;">*</span></label>
                <input name="sop_theme" type="text" tabindex="-1" value="{{@$data->sop_theme ?? ''}}" id="txt_sop_theme" class="form-control form-control-sm" placeholder="Theme of Activity/Programme" onMaxLength="100" readonly />
                <span id="txt_sop_theme_err_" style="color: red;"></span>
              </div>
            </div>
            @if(@$user_ype=='2')
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Office Type : <span style="color: red;"></span></label>
                <select name="office_type" id="ddl_off_type" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:none;" readonly>
                  <option value="">--Select--</option>
                  <option value="HQ" {{@$data->office_type == "HQ"  ? 'selected' : ''}}>RO {{@$offTyp->rob_hq}} HEADQUARTER</option>
                  <option value="FO" {{@$data->office_type == "FO"  ? 'selected' : ''}}>{{@$offTyp->rob_hq}} FO</option>
                  
                  <!-- <option>{{@$offTyp->rob_hq}}</option> -->
                  
                </select>
                <span id="ddl_off_type_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Region : <span style="color: red;"></span></label>
                <select name="region_id" id="ddl_rob_region" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:none;" readonly>
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
            @endphp
            <div class="col-xl-4" style="pointer-events:none;">
              <div class="form-group">
                <label for="">Target Area Description : <span style="color: red;">*</span></label>
                <select name="demography[]" id="ddl_area_nature" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:none;" readonly multiple="multiple">
                  <!-- <option value="">--Select--</option>
                  <option  value="U" {{@$data->demography=='U' ? 'selected' : ''}}>URBAN</option>
                  <option  value="R" {{@$data->demography=='R' ? 'selected' : ''}}>RURAL</option>
                  <option  value="M" {{@$data->demography=='M' ? 'selected' : ''}}>MINORITY AREA</option>
                  <option  value="L" {{@$data->demography=='L' ? 'selected' : ''}}>LWE AREA </option> -->
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

            <div class="col-xl-4" style="pointer-events:none;">
              <div class="form-group">
                <label for="">Area of Activites : <span style="color: red;">*</span></label>
                <select name="activity_area[]" id="ddl_area_act" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:none;" readonly multiple="multiple">
                  <!-- <option value="">--Select--</option>
                  <option  value="V" {{@$data->activity_area=='V' ? 'selected' : ''}}>VILLAGE LEVEL</option>
                  <option  value="B" {{@$data->activity_area=='B' ? 'selected' : ''}}>BLOCK LEVEL</option>
                  <option  value="D" {{@$data->activity_area=='D' ? 'selected' : ''}}>DISTRICT LEVEL</option>
                  <option  value="C" {{@$data->activity_area=='C' ? 'selected' : ''}}>CITY LEVEL</option> -->
                  @foreach($area_data as $area)
                    <option {{ @in_array($area->activity_name,$area_search) ? 'selected': '' }}>{{ @$area->activity_name }}</option>
                  @endforeach
                </select>
                <span id="ddl_area_act_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Coverage (Village/Town Covered) : <span style="color: red;">*</span></label>
                <input name="coverage" type="text" value="{{@$data->coverage ?? ''}}" onkeypress="return onlyNumberKey(event)" maxlength="10" id="txt_no_covered" placeholder="No. of Village/Towns Covered" class="numeric form-control form-control-sm" readonly />
                <span id="txt_no_covered_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Name of Village/Town Covered :<span style="color: red;">*</span></label>
                <!-- <input type="text" name="village_name" value="{{@$data->village_name ?? ''}}" id="txt_vilage_name" onkeypress="return alphaOnly(event);" placeholder="Name of Village/Town covered" class="form-control form-control-sm" {{$block}}> -->
                <textarea name="village_name" id="txt_vilage_name" readonly placeholder="Name of Village/Town covered" class="form-control form-control-sm">{{@$data->village_name ?? ''}}</textarea>
                <span id="txt_vilage_name_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Block :<span style="color: red;"></span></label>
                <input type="text" name="block" value="{{@$data->block ?? ''}}" id="block" onkeypress="return alphaOnly(event);" placeholder="Enter Block" class="form-control form-control-sm" readonly>
                <span id="block_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">District :<span style="color: red;"></span></label>
                <input type="text" name="district" value="{{@$data->district ?? ''}}" id="district" onkeypress="return alphaOnly(event);" placeholder="Enter District" class="form-control form-control-sm" readonly>
                <span id="district_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Distance Covered (in km) :<span style="color: red;"></span></label>
                <input type="text" name="distance_covered" value="{{@$data->distance_covered ?? ''}}" id="distance_covered" onkeypress="return onlyNumberKey(event);" placeholder="Enter Distance" class="form-control form-control-sm" readonly>
                <span id="distance_covered_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Date of Last Visit :<span style="color: red;"></span></label>
                <input type="date" name="last_visit_date" value="{{@$data->last_visit_date ?? ''}}" id="last_visit_date"  class="form-control form-control-sm" readonly>
                <span id="last_visit_date_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Name of VIP :<span style="color: red;"></span></label>
                <input type="text" name="vip_name" value="{{@$data->vip_name ?? ''}}" id="vip_name" onkeypress="return alphaOnly(event);" placeholder="Name of VIP" class="form-control form-control-sm" readonly>
                <span id="vip_name_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Designation of VIP :<span style="color: red;"></span></label>
                <input type="text" name="vip_designation" value="{{@$data->vip_designation ?? ''}}" id="vip_designation" onkeypress="return alphaOnly(event);" placeholder="VIP Designation" class="form-control form-control-sm" readonly>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>
            <!-- <div class="col-xl-4">
              <div class="form-group">
                <label for="">Venue : </label>
                <textarea maxlength="250" name="venue_event" rows="2" cols="20" id="TextBox1" placeholder="Enter Venue Address" class="alph form-control" style="height: 100px;" {{$block}}>{{@$data->venue_event ?? ''}}</textarea>
              </div>
            </div> -->
            <div class="col-xl-4">
              @include('rob.include.venue')
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Event Description : </label>
                <textarea maxlength="250" name="event_description" rows="2" cols="20" id="TextBox1" placeholder="Enter Event Description" class="alph form-control" style="height: 100px;" readonly>{{@$data->event_description ?? ''}}</textarea>
              </div>
            </div>

            <div class="col-xl-12">
              <h5 style="color: blue;"><u>Duration For Activity/Programme Organized</u></h5>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <div class="form-group">
                  <label for="">From Date : <span style="color: red;">*</span></label>
                  <input name="duration_activity_from_date" value="{{@$data->duration_activity_from_date ?? ''}}" type="date" maxlength="10" id="txt_from" class="calendar1 form-control form-control-sm" readonly  /> <!-- max="{{$today}}" -->
                  <span id="txt_from_err_" style="color: red;"></span>
                </div>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">To Date :<span style="color: red;">*</span></label>
                <input name="duration_activity_to_date" type="date" value="{{@$data->duration_activity_to_date ?? ''}}" maxlength="10" id="txt_to" class="calendar1 form-control form-control-sm" readonly /> <!-- max="{{$today}}" -->
                <span id="txt_to_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">No. of Days:</label>
                <input name="no_of_days" type="text" value="{{@$data->no_of_days ?? ''}}" maxlength="10" id="txt_tot_prog_day" readonly class="numeric form-control form-control-sm" />
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label>Remark : </label>
                <textarea class="form-control form-control-sm" name="pre_remark">{{@$data->pre_remark}}</textarea>
              </div>
            </div>
            @include('rob.include.pre_event_activities')
            <div class="row">
                <div class="col-xl-4" >
                  <label>Photo upload (Accept only : jpg, png, gif)  : </label>
                    <div class="form-group">
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
                            <div class="custom-file" style="pointer-events:none;">
                                <input type="file" name="pre_photo" class="custom-file-input {{$click}}" id="pre_photo" tabindex="{{$tab}}" style="pointer-events:none;" accept="image/png, image/gif, image/jpeg">
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
               @if(Session::get('UserType') !='7')
                 @if(@$data->status=='2')
                 <a class="btn btn-primary client-next-button btn-sm m-0" >Next <i class="fa fa-caret-right"></i></a>
                 @else
                 <a class="btn btn-primary client-next-button btn-sm m-0" id="tab_1">Next <i class="fa fa-caret-right"></i></a>
                 @endif
               @else
               <a class="btn btn-primary client-next-button btn-sm m-0" >Next <i class="fa fa-caret-right"></i></a>
               @endif
              
              
              <!-- <input type="hidden" name="fetch_id" value="{{@$data->Pk_id}}"> -->
              <!-- <a class="btn btn-primary client-next-button btn-sm m-0"   id="tab_1">Next1 <i class="fa fa-caret-right"></i></a> -->
              
            </div>
          </div>
        </div>  <!-- tab-pane close -->

          <div id="logins-part1" class="tab-pane">
           <div id="logins-part1" class="content pt-3" role="tabpanel" aria-labelledby="logins-part1-trigger">
            <div id="show_only_print_details1">
              <!-- fixed start -->
              @include('rob.include.post_event')
              <!-- fixed end -->
              <div class="row">
                <div class="col-xl-12 text-center"><h4>Programme Details</h4></div>
              </div>
              <div class="row">
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Approx Size of Audience : <span style="color: red;">*</span></label>
                    <input name="approx_size_of_audience" value="{{@$data->approx_size_of_audience ?? ''}}" type="text" maxlength="10" id="txt_aud_size" onkeypress="return onlyNumberKey(event)" class="numeric form-control form-control-sm" {{$block}} />
                    <span id="txt_aud_size_err_" style="color: red" ;></span>
                  </div>
                </div>
                <div class="col-xl-4">
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
                  @endphp
                  <!-- @in_array($val['sareavalue'],$list)? 'selected':'' -->
                  <div class="form-group">
                    <label for="">Special Area(if any) :</label>
                    <select size="4" name="special_area[]" multiple="multiple" id="ddl_area_type" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}}; height: 150px;" {{$block}}>
                      @foreach($ary as $val)
                        <option value="{{$val['sareavalue']}}" {{ @in_array($val['sareavalue'],$special)? 'selected':''}}>{{$val['saname']}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

              </div>    

            </div>
              <div class="row">
                <input type="hidden" name="get_status" id="get_status">
                <div class="col-sm-12 text-right">
                 <a class="btn btn-primary reg-previous-button  btn-sm m-0" id="previous_btn_2"><i class="fa fa-caret-left"></i> Previous</a>
                 <!-- <a class="btn btn-primary client-next-button btn-sm m-0"><i class="fa fa-save"></i> Submit </a> -->
                 <input type="hidden" id="next_tab_2">
                 @if(Session::get('UserType') !='7')
                   @if(@$data->status=='2')
                   <a class="btn btn-primary client-next-button btn-sm m-0" >Next <i class="fa fa-caret-right"></i></a>
                   @else
                   <a class="btn btn-primary client-next-button btn-sm m-0" id="tab_2">Next <i class="fa fa-caret-right"></i></a>
                   @endif
                  @else
                  <a class="btn btn-primary client-next-button btn-sm m-0" >Next <i class="fa fa-caret-right"></i></a>
                  @endif
                 
                 
               </div>
             </div>
           </div>   
         </div>


         



         <div id="logins-part2" class="tab-pane">
           <div id="logins-part2" class="content pt-3" role="tabpanel" aria-labelledby="logins-part2-trigger">
            <div id="show_only_print_details1">
              
              @include('rob.include.video_image_section')

            </div>
              <div class="row">
                <div class="col-sm-12 text-right">
                 <a class="btn btn-primary reg-previous-button  btn-sm m-0" id="previous_btn"><i class="fa fa-caret-left"></i> Previous</a>
                 <!-- @$rob_documents[0]->event_date=='' -->
                 @if(@$data->status=='1' && Session::get('UserType') !='7')
                 <a class="btn btn-primary client-next-button btn-sm m-0" id="submit"><i class="fa fa-save"></i> Submit </a>
                 <!-- <input type="submit" name="" class="btn btn-primary client-next-button btn-sm m-0" id="submit" value="Submit"> -->
                 
                 @endif
                 <!-- <a class="btn btn-primary client-next-button btn-sm m-0"   id="tab_4">Next <i class="fa fa-caret-right"></i></a> -->
                 
               </div>
             </div>
           </div>   
         </div>


         <?php 
         $post_events=explode(",",@$data->village_name);
         ?>


       </div> <!-- tab-content close -->
     </form>
   </div>  <!-- card-body close -->
 </div>  <!-- card shadow close -->
</div>   <!-- content-inside close -->
@endsection
@section('custom_js')
<!-- <script src="{{ url('/js') }}/validator.js"></script> -->
<script src="{{ url('/arogi/js') }}/rob_form.js"></script>
<script src="{{asset('arogi/js/custom.js')}}" type="text/javascript"></script>


<script src="{{ url('/arogi/js') }}/location.js"></script>
<script src="{{asset('arogi/js/multiple_selection.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/common.js')}}" type="text/javascript"></script>

<script>

$(document).ready(function(){
    var i=1;
    
    $("#photobtn").click(function(e){
        e.preventDefault();
        i++;
        var html='';
        html+='<td> Date <input type="date" name="venue_date[]" min="{{$data->duration_activity_from_date}}" max="{{@$data->duration_activity_to_date}}" class="form-control form-control-sm" value="{{@$data->duration_activity_from_date ?? ''}}"></td>';
        html+='<td>Venue <span style="color: red;">*</span>  <select class="form-control form-control-sm" name="venue_address[]" required> <option value="">Select venue event</option>@foreach($post_events as $post)<option>{{$post}}</option>@endforeach</select></td>';
        html+='<td>File : <span style="color: red;">*</span> <input type="file"  name="document_name[]" id="pic" class="form-control form-control-sm" style="" accept="image/png, image/gif, image/jpeg" required></td>';
        html+='<td> Caption Name: <span style="color: red;">*</span> <input type="text" name="caption_name[]" id="caption_name" class="form-control form-control-sm" style="margin-left: -10px;" required></td>';
        @if(Session::get('user_ype')!=3)
        html+='<td><br><input type="checkbox" name="show_website[]" id="show_website" value="1"> Show on Website</td>';
        @endif
        html+='<td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td>';


        $("#FileUploadContainer").append('<tr id="row'+i+'"> '+html+' </tr>'+"<br><br>");
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
        var days = (Date.parse(end) - Date.parse(start)) / 86400000 + 1 ;
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
        var html='';
        html+='<td> Date <input type="date" name="venue_date_pr[]" min="{{$data->duration_activity_from_date}}" max="{{@$data->duration_activity_to_date}}" class="form-control form-control-sm" value="{{@$data->duration_activity_from_date ?? ''}}"></td>';
        html+='<td>Venue <span style="color: red;">*</span> <select class="form-control form-control-sm" name="venue_address_pr[]" required> <option value="">Select venue event</option>@foreach($post_events as $post)<option>{{$post}}</option>@endforeach</select></td>';
        html+='<td>File : <span style="color: red;">*</span> <input type="file"  name="press_document_name[]" id="press_pic" class="form-control form-control-sm" style="" accept="image/png, image/gif, image/jpeg" required></td>';
        html+='<td> Caption Name: <span style="color: red;">*</span> <input type="text" name="press_caption_name[]" id="press_caption_name" class="form-control form-control-sm" style="margin-left: 0px;" required></td>';
        @if(Session::get('user_ype')!=3)
        html+='<td><br><input type="checkbox" name="press_show_website[]" id="press_show_website" value="1"> Show on Website</td>';
        @endif
        html+='<td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td>';

        $("#PressUploadContainer").append('<tr id="row'+i+'">'+html+'</tr>'+"<br><br>");
    });

    $(document).on("click",'.remove',function(e){
        e.preventDefault();
        var id=$(this).attr('id');
        $("#row"+id).remove();
    });

    // //for day count
    //   $("#txt_to").blur(function() {
    //     var start = $("#txt_from").val();
    //     var end = $("#txt_to").val();
    //     var days = (Date.parse(end) - Date.parse(start)) / 86400000;
    //     $("#txt_tot_prog_day").attr('value', days);
    //   });
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

  $(document).ready(function(){
    $('#click').click(function(e){
           e.preventDefault()
           e.stopImmediatePropagation() //charles ma is right about that, but stopPropagation isn't also needed
    });
  });
</script>

<script>
  $(document).ready(function(){
    var i=1;
    $("#video_add").click(function(e){
        e.preventDefault();
        i++;
        var html='';
        // html+='<div class="col-xl-2"><label>Date : </label><input type="date" name="video_date[]" class="form-control form-control-sm"></div>';

        // html+='<div class="col-xl-2"><label>Venue : </label><select class="form-control form-control-sm" name="venue_address[]"><option value="">Select venue event</option>@foreach($post_events as $post)<option {{  @$post == @$data->post_venue ? 'selected': '' }} >{{@$post}}</option>@endforeach</select></div>';

        // html+='<div class="col-xl-2"><label>Video upload : </label><input type="file" name="video[]" id="video" class="form-control form-control-sm" accept="video/mp4,video/x-m4v,video/*" style="width: 267px;margin-left: -12px;"><span id="video_err" style="color: red;display: none;"></span></div>';

        // html+='<div class="col-xl-2"><label style="margin-left: 87px;">Caption : </label><input type="text" name="video_caption[]" id="video_caption" class="form-control form-control-sm" style="margin-left: 87px;"><span id="video_caption_err" style="color: red;display: none;"></span></div>';

        // html+='<div class="col-xl-3"><br><input type="checkbox" name="video_show_website[]" id="video_show_website" value="1" style="margin-left: 87px;"> Show on Website</div>';
        // html+='<div class="col-xl-1"><br><button class="btn btn-danger remove" id="'+i+'">X</button></div>';
        html+='<td>Date :<input type="date" name="video_date[]" min="{{$data->duration_activity_from_date}}" max="{{@$data->duration_activity_to_date}}" class="form-control form-control-sm" value="{{@$data->duration_activity_from_date ?? ''}}"></td>';
        html+='<td>Venue : <select class="form-control form-control-sm" name="venue_address[]"><option value="">Select venue event</option>@foreach($post_events as $post)<option {{  @$post == @$data->post_venue ? 'selected': '' }} >{{@$post}}</option>@endforeach</select></td>';
        html+='<td>Video Uppload :<input type="file" name="video[]" id="video" class="form-control form-control-sm" accept="video/mp4,video/x-m4v,video/*" style="width: 267px;margin-left: -12px;"><span id="video_err" style="color: red;display: none;"></span></td>';
        html+='<td>Caption :<input type="text" name="video_caption[]" id="video_caption" class="form-control form-control-sm"><span id="video_caption_err" style="color: red;display: none;"></span></td>';
        @if(Session::get('user_ype')!=3)
        html+='<td><br><input type="checkbox" name="video_show_website[]" id="show_website" value="1" style="margin-left: 0px;"> Show on Website</td>';
        @endif
        html+='<td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td>';

        $("#VideoUploadContainer").append('<tr  id="row'+i+'"> '+html+' </tr>');
        // $("#VideoUploadContainer").append('<div class="row" id="row'+i+'"> '+html+' </div>');
    });

    $(document).on("click",'.remove',function(e){
        e.preventDefault();
        var id=$(this).attr('id');
        $("#row"+id).remove();
    });
  });



$(document).ready(function(){
    var i=1;
    
    $("#govt_add").click(function(e){
        e.preventDefault();
        i++;
        var html='';
        html+='<td></td>';
        html+='<td></td>';
        html+='<td valign="middle"><select name="govt_event[]" class="form-control"><option value="">--------- Select ---------</option><option>DISTRIBUTION OF UJWALA GAS CONNECTIONS</option><option>DISTRUBUTION OF MUDRA LOANS</option><option>DISTRUBUTION OF KISAN CREDITS CARDS</option><option>DISTRUBUTION OF OPENING OF ACCOUNTS</option><option>DISTRUBUTION OF ANY OTHER GOVT SCHEME</option><option>OTHER</option></select></td>';
        html+='<td valign="middle"><input name="ujwala_gas_main_no_program_[]" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl24_txt_main_no_program" class="numeric form-control" style="height:50px;"/></td>';
        html+='<td valign="middle"><textarea maxlength="120" name="ujwala_gas_main_remark_[]" rows="2" cols="20" id="GridView2_ctl24_txt_main_remarl" style="height:50px; width: 340px;" class="form-control float-left"></textarea><span class="btn btn-danger remove" id="'+i+'" style="margin-left: 10px;">X</span></td>';

        
        //table tbody
        $(".govtt").last().after('<tr class="govtt" id="row'+i+'">'+html+'</tr>'+"<br><br>");
    });

    $(document).on("click",'.remove',function(e){
        e.preventDefault();
        var id=$(this).attr('id');
        $("#row"+id).remove();
    });

    // //for day count
    //   $("#txt_to").blur(function() {
    //     var start = $("#txt_from").val();
    //     var end = $("#txt_to").val();
    //     var days = (Date.parse(end) - Date.parse(start)) / 86400000;
    //     $("#txt_tot_prog_day").attr('value', days);
    //   });



});
</script>
<!-- ToasterJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script>
  $(document).ready(function(){
    $(document).on("click",".video_check",function(){
      if ($(this).is(":checked")) {
        var id=1;
        var pk_id=$(this).attr('data-pk');
        var rob_id=$(this).attr('data-id');
      }
      else
      {
        var id=0;
        var pk_id=$(this).attr('data-pk');
        var rob_id=$(this).attr('data-id');
      }
      // alert(id+' '+ pk_id+ ' '+ rob_id);
      $.ajax({
        url : "/showWebsite",
        type: "GET",
        data: {id:id,pk_id:pk_id,rob_id:rob_id},
        success:function(data)
        {
          console.log(data);

        }
      });
    });
  });
</script>
@endsection

