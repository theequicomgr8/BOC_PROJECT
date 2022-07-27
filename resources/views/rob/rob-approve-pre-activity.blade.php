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
  animation: blinker 3s linear infinite;
  color: red;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
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


if(@$data->approve=='1')
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
//dd(Request::segment(2));

$user_ype=Session::get('UserType');
@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> TTP Information </h6>
     <h6 class="m-0 text-primary"><a href="{{url('fob-ttp-form-pdf/'.@$data->Pk_id)}}"><i class="fa fa-edit"></i> TTP reciept download</a></h6>
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
      <input type="hidden" name="getid" value="{{@$data->Pk_id ?? '' }}">
      <div class="tab-content">
        <div id="logins-part" class="tab-pane active show">
          <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">
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
                    <option value="1" {{@$data->programme_activity=='1' ? 'selected': ''}}>Programme Activites(under ICOP) under DCID fund of M/O I&B</option>
                    <option value="6" {{@$data->programme_activity=='6' ? 'selected': ''}}>Programme Activites(other than ICOP) under DCID fund of M/O I&B</option>
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


            @php

            $search=explode(",",@$data->demography);
            //dd($search);
            @endphp

            <div class="col-xl-4" style="pointer-events:{{$non}};">
              <div class="form-group">  <!-- Demography -->
                <label for="">Target Area Description : <span style="color: red;">*</span></label>
                <select name="demography[]" id="ddl_area_nature" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}  multiple="multiple">
                  <!-- <option id="demography1" value="U" {{@$data->demography=='U' ? 'selected' : ''}}>URBAN</option>
                  <option id="demography2" value="R" {{@$data->demography=='R' ? 'selected' : ''}}>RURAL</option>
                  <option id="demography3" value="M" {{@$data->demography=='M' ? 'selected' : ''}}>MINORITY AREA</option>
                  <option id="demography3" value="L" {{@$data->demography=='L' ? 'selected' : ''}}>LWE AREA </option> -->
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
                <label for="">Area of Activites : <span style="color: red;">*</span></label>
                <select name="activity_area[]" id="ddl_area_act" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}} multiple="multiple">

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
                <input type="text" name="distance_covered" value="{{@$data->distance_covered ?? ''}}" id="distance_covered" onkeypress="return onlyNumberKey(event);" placeholder="Enter Distance" class="form-control form-control-sm" {{$block}}>
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
        <div class="col-xl-4" style="pointer-events:{{$non}};"><br>
          <input type="checkbox" name="pre_show_website" value="1" {{$check}} > Update on Event Calendar
        </div>
          </div>

          <div class="row">
            <div class="col-xl-12">
              <h5 style="color: blue;"><u>Organizer Details</u></h5>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Name of Officer :<span style="color: red;"></span></label>
                <input type="text" name="officer_name_person" value="{{@$data->officer_name_person ?? ''}}" id="vip_designation" onkeypress="return alphaOnly(event);"  class="form-control form-control-sm" {{$block}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Designation :<span style="color: red;"></span></label>
                <input type="text" name="person_designation" value="{{@$data->person_designation ?? ''}}" id="person_designation" onkeypress="return alphaOnly(event)" maxlength="10" class="form-control form-control-sm" {{$block}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Contact No. :<span style="color: red;"></span></label>
                <input type="text" name="contact_no" value="{{@$data->contact_no ?? ''}}" id="contact_no" onkeypress="return onlyNumberKey(event)" maxlength="10"  class="form-control form-control-sm" {{$block}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">E-mail ID :<span style="color: red;">*</span></label>
                <input type="text" name="email" value="{{@$data->email ?? ''}}" id="email" class="form-control form-control-sm" {{$block}}>
                <span id="email_err_" style="color: red;"></span>
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

               <?php
               //dd(Request::segment(1));
               ?>
               @if($data->approve!='1')
               <a class="btn btn-primary client-next-button btn-sm m-0" id="save">Save <i class="fa fa-caret-right"></i></a>
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
@if(Request::segment(2)=='')
<script src="{{ url('/arogi/js') }}/pre_rob_form.js"></script>
@endif
<!-- <script src="{{asset('arogi/js/rob_approve.js')}}" type="text/javascript"></script> -->
@if(Session::get('UserType')!='5')
<script src="{{asset('arogi/js/pre_custom.js')}}" type="text/javascript"></script>
@else
<script src="{{asset('arogi/js/pre_custom_adg.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/adg_pre_update.js')}}" type="text/javascript"></script>
@endif
<script src="{{ url('/arogi/js') }}/location.js"></script>
<script src="{{asset('arogi/js/multiple_selection.js')}}" type="text/javascript"></script>


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
