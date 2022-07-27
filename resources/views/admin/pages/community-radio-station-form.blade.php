@extends('admin.layouts.layout')
<style>
  a.disabled {
    pointer-events: none;
    color: #ccc;
}
  .error {
  color: red;
  font-size: 14px;
  }
  body {
    color: #6c757d !important;
  }

  .hide-msg {
    display: none !important;
  }

  .fa-check {
    color: green;
  }

  .input-group-text {
    height: 32px !important;
  }

  .custom-file-label {
    height: 32px !important;
    overflow: hidden;
  }

  .custom-file-label::after {
    height: 30px !important;
  }

  .input-group-text {
    font-size: 0.8rem !important;
  }

  /* .input-group {
     width: 80% !important;
     float: right !important;
  } */

  .flexview {
    display: inline-flex;
  }
  .eyecolor{
    color: #007bff !important;
  }
  .iframemargin{
    margin-bottom: -50px;
  }
  .fieldset-border {
    width: 100%;
    border: solid 1px #ccc;
    border-radius: 5px;
    margin: 0 10px 15px 10px;
    padding: 0 15px;
}
.fieldset-border legend {
  width: auto;
  background: #fff;
  padding: 0 10px;
  font-size: 14px;
  font-weight: 600;
  color: #3d63d2;
}
.subheading {
  font-size: 16px;
  font-weight: 500;
  color: #4066d4;
  border-bottom: solid 1px #4066d4;
  margin-bottom: 15px;
}
.divmargin {
  margin-top: 19px;
}

.alert-info-msg{
  color: green;
}
.alert-info-msg2{
  color: red;
}
</style>
@section('content')
@php
                  $OD_owners=$OD_owners ?? [1];
                  $CM_radio =$CM_radio ?? [1];
                  $Time_Band =$Time_Band ?? [1];
                  $readonly = ' ';
                  $disabled = ' ';
                  $checked = ' ';
                 $disablestatus= isset($CM_radio[0]->Modification)? $CM_radio[0]->Modification:'';
                 if($disablestatus ==1){
                    $readonly = 'readonly';
                    $checked = 'checked';
                    $disabled = 'disabled';
                  }
                  $mondayData=[];
                foreach($Time_Band as $timeBandList){
                  if($timeBandList->{'Weekday'}==0){
                      $mondayData['sTime'][]=date('H:i:s',strtotime(@$timeBandList->{'Start Time'}));
                      $mondayData['endTime'][]=date('H:i:s',strtotime(@$timeBandList->{'End Time'}));
                    }

                }
                 $tuedayData=[];
                foreach($Time_Band as $timeBandListtue){
                  if($timeBandListtue->{'Weekday'}==1){
                      $tuedayData['sTime'][]=date('H:i:s',strtotime(@$timeBandListtue->{'Start Time'}));
                      $tuedayData['endTime'][]=date('H:i:s',strtotime(@$timeBandListtue->{'End Time'}));
                    }

                }
                 $wednesdayData=[];
                foreach($Time_Band as $timeBandListwed){
                  if($timeBandListwed->{'Weekday'}==2){
                      $wednesdayData['sTime'][]=date('H:i:s',strtotime(@$timeBandListwed->{'Start Time'}));
                      $wednesdayData['endTime'][]=date('H:i:s',strtotime(@$timeBandListwed->{'End Time'}));
                    }

                }
                 $thusdayData=[];
                foreach($Time_Band as $timeBandListthus){
                  if($timeBandListthus->{'Weekday'}==3){
                      $thusdayData['sTime'][]=date('H:i:s',strtotime(@$timeBandListthus->{'Start Time'}));
                      $thusdayData['endTime'][]=date('H:i:s',strtotime(@$timeBandListthus->{'End Time'}));
                    }

                }
                 $fridayData=[];
                foreach($Time_Band as $timeBandListfri){
                  if($timeBandListfri->{'Weekday'}==4){
                      $fridayData['sTime'][]=date('H:i:s',strtotime(@$timeBandListfri->{'Start Time'}));
                      $fridayData['endTime'][]=date('H:i:s',strtotime(@$timeBandListfri->{'End Time'}));
                    }

                }
                 $saturdayData=[];
                foreach($Time_Band as $timeBandListstu){
                  if($timeBandListstu->{'Weekday'}==5){
                      $saturdayData['sTime'][]=date('H:i:s',strtotime(@$timeBandListstu->{'Start Time'}));
                      $saturdayData['endTime'][]=date('H:i:s',strtotime(@$timeBandListstu->{'End Time'}));
                    }

                }
                 $sundayData=[];
                foreach($Time_Band as $timeBandListsun){
                  if($timeBandListsun->{'Weekday'}==6){
                      $sundayData['sTime'][]=date('H:i:s',strtotime(@$timeBandListsun->{'Start Time'}));
                      $sundayData['endTime'][]=date('H:i:s',strtotime(@$timeBandListsun->{'End Time'}));
                    }

                }

 @endphp

  <div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="Final_idea">
      <h4 class="m-0 font-weight-normal text-primary">Community radio station
       </h4>
      </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="alert alert-success alert-dismissible text-center fade show" id="Final_submi" style="display: none;" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>

    <!-- /.end card-header -->
<form action="" method="POST" id="community_radio_station" enctype="multipart/form-data">
          @csrf
            <!-- your steps here -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active show" href="#tab1">Basic Information</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#tab2">CRS Information</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#tab3">Account Details</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#tab4">Upload Document</a>
    </li>
  </ul>
    <div class="tab-content">
      <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
        <div class="row" id="details_of_owners" class="pt-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="owner_name">Publication Name / प्रकाशन का नाम <span style="color: red;">*</span></label>
                <input {{$disabled}} type="text" class="form-control form-control-sm"  name="owner_name" id="owner_name" placeholder="Enter Name" onkeypress="return onlyAlphabets(event,this);" maxlength="40" value="{{@$OD_owners[0]['Owner Name'] ?? ''}}">
            </div>
          </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="email">E-mail ID / ई मेल आईडी <span style="color: red;">*</span></label>
            <input {{$disabled}} type="email" class="form-control form-control-sm" name="email" id="email0" placeholder="Enter Email" maxlength="150" value="{{@$OD_owners[0]['Email ID'] ?? ''}}">
            <span id="first_email" class="text-danger"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="mobile">Mobile No. / मोबाइल नंबर</label>
            <input {{$disabled}} type="text" class="form-control form-control-sm" name="mobile" id="mobile0" placeholder="Enter Mobile No." maxlength="10" onkeypress="return onlyNumberKey(event)" value="{{@$OD_owners[0]['Mobile No_'] ?? ''}}" {{$disabled}}>
          </div>
        </div>
       <div class="col-md-4">
          <div class="form-group">
            <label for="address">Address / पता <span style="color: red;">*</span></label>
            <textarea {{$disabled}} name="address1" id="address1" rows="1" cols="50" class="form-control form-control-sm" maxlength="140" placeholder="Enter Address">{{$OD_owners[0]['Address 1']?? ''}}</textarea>
          </div>
        </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="state">State / राज्य <span style="color: red;">*</span></label>
           <select {{$disabled}} id="state_id" name="state" class="form-control form-control-sm">
            <option value="">Select State</option>
              @if(count($result) > 0)
              @foreach($result as $statesData)
            <option value="{{ $statesData['Code'] }}" @if(@$OD_owners[0]['State'] == $statesData['Code']) selected="selected" @endif>{{$statesData['Description']}}</option>
              @endforeach
              @endif

           </select>

        </div>
      </div>
      <div class="col-md-4">
       <div class="form-group">
         <label for="district">District / जिला <span style="color: red;">*</span></label>
          <select {{$disabled}} id="district_id0" name="district" class="form-control form-control-sm">
          <option value="">Select Option</option>
          @if(!empty(@$OD_owners[0]['District']))
          <option selected="selected">{{@$OD_owners[0]['District'] ?? ''}}</option>
          @endif
          </select>

        </div>
      </div>
      <div class="col-md-4">
          <div class="form-group">
           <label for="city">City / नगर <span style="color: red;">*</span></label>
           <input {{$disabled}} type="text" id="city0" name="city"class="form-control form-control-sm" placeholder="Enter City" value="{{$OD_owners[0]['City']?? ''}}">
          </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
         <label for="phone">Phone No. / फोन नंबर</label>
         <input {{$disabled}} type="text" class="form-control form-control-sm" name="phone" id="phone" placeholder="Enter Phon No." maxlength="15" onkeypress="return onlyNumberKey(event)" value="{{$OD_owners[0]['Phone No_']?? ''}}">
        </div>
      </div>
      {{-- <div class="col-md-4">
        <div class="form-group">
          <label for="fax">Fax No. / फैक्स नंबर</label>
          <input {{$disabled}} type="text" class="form-control form-control-sm" name="fax_no" id="fax0" placeholder="Enter Fax No." maxlength="15" onkeypress="return onlyNumberKey(event)" value="{{$OD_owners[0]['Fax No_']?? ''}}">
        </div>
      </div> --}}
      </div>
      <input type="hidden" name="ownerid" id="ownerid" value="{{@$OD_owners[0]['Owner ID'] ?? ''}}">

      <input type="hidden" name="next_tab_1" id="next_tab_1"  value="0">
        <a class="btn btn-primary community-next-button" id="tab_1">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
        <!-- <input type="submit" name="submit" value="submit"> -->
      </div>

      <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
      <div class="row">
       <div class="col-md-6">
        <div class="form-group">
          <label for="Name">Channel Name / चैनल का नाम <span style="color: red;">*</span></label>
          <input {{$disabled}} type="text" name="Name" class="form-control form-control-sm" id="Name" maxlength="80" placeholder="Enter Channel Name" value="{{@$CM_radio[0]->{'Name'} ?? ''}}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="Agency_Code">Agency code (if empaneled with boc) / एजेंसी कोड (यदि बीओसी . के साथ पैनलबद्ध किया गया है) <span style="color: red;">*</span></label>
            <input {{$disabled}} type="text" name="Agency_Code" class="form-control form-control-sm" id="Agency_Code" maxlength="20" placeholder="Enter Agency Code" value="{{@$CM_radio[0]->{'Agency Code'} ?? ''}}">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="Frequency">Frequency of broadcast / प्रसारण की आवृत्ति <span style="color: red;">*</span></label>
            <input {{$disabled}} type="text" name="Frequency" class="form-control form-control-sm" id="Frequency" onkeypress="return onlyDotNumberKey(event)" placeholder="Enter Frequency" value="{{substr(@$CM_radio[0]->{'Frequency'},0,20) ?? ''}}" maxlength="20">
          </div>
        </div>
        <!-- @php
        $arr1= array(1=>'Hindi', 2=>'English');
        @endphp -->
        <div class="col-md-6">
          <div class="form-group">
          <label for="Language">Language of channel / चैनल की भाषा <span style="color: red;">*</span></label>
            <select {{$disabled}} name="Language" class="form-control form-control-sm" id="Language">
              <option value="">Select Language of Channel</option>
              @if(count($languag) > 0)
              @foreach($languag as $stdata)
              <option  value="{{ $stdata['Code'] }}" @if(@$CM_radio[0]->{'Language'} == $stdata['Code']) selected="selected" @endif>{{$stdata['Name']}}</option>
              @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label for="place_of_publication">Time Band 1 / टाइम बैंड 1</label>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label for="place_of_publication">Time Band 2 / टाइम बैंड 2</label>

          </div>
        </div>

        <div class="col-md-3">
         <div class="form-group">
          <label for="place_of_publication">Time Band 3 / टाइम बैंड 3</label>
          </div>
        </div>

<!---Start Time Band --->


    <div class="col-sm-2">
      <div class="form-group">
        <label for="place_of_publication">Monday/सोमवार: <span style="color: red;">*</span></label>
        <input type="hidden" name="weekday[]" value="0">
      </div>
    </div>
  <div class="col-sm-10">
    <div class="row">


      <div class="col-sm-2">
          <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From1[]" id="Mon_TB1_From" data-id="Mon_TB1_" value="{{ $mondayData['sTime'][0]?? '' }}" >
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To1[]" id="Mon_TB1_To" data-deep="Mon_TB2_" value="{{ $mondayData['endTime'][0] ?? '' }}" data-id="Mon_TB1_">
            </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From2[]" id="Mon_TB2_From" data-id="Mon_TB2_" value="{{ $mondayData['sTime'][1]?? '' }}">
            </p>
        </div>
       </div>
      <div class="col-sm-2">
          <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To2[]" id="Mon_TB2_To" data-deep="Mon_TB3_"  value="{{ @$mondayData['endTime'][1]?? '' }}" data-id="Mon_TB2_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="from">From:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From3[]" id="Mon_TB3_From" data-id="Mon_TB3_" value="{{ $mondayData['sTime'][2]?? '' }}">
          </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="to">To:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To3[]" id="Mon_TB3_To" data-id="Mon_TB3_" value="{{ $mondayData['endTime'][2]?? ''}}">
          </p>
        </div>
      </div>

    </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label for="place_of_publication">Tuesday/मंगलवार: <span style="color: red;">*</span></label>
        <input type="hidden" name="weekday[]" value="1">
      </div>
    </div>
  <div class="col-sm-10">
    <div class="row">
      <div class="col-sm-2">
          <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From1[]" id="Tue_TB1_From" data-id="Tue_TB1_" value="{{ $tuedayData['sTime'][0]?? ''}}">
          </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To1[]" id="Tue_TB1_To"  value="{{ $tuedayData['endTime'][0]?? ''}}" data-id="Tue_TB1_" data-deep="Tue_TB2_">
          </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From2[]" id="Tue_TB2_From" value="{{ $tuedayData['sTime'][1]?? ''}}" data-id="Tue_TB2_">
            </p>
        </div>
       </div>
      <div class="col-sm-2">
          <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To2[]" id="Tue_TB2_To" value="{{ $tuedayData['endTime'][1]?? ''}}" data-id="Tue_TB2_" data-deep="Tue_TB3_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="from">From:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From3[]" id="Tue_TB3_From" value="{{ $tuedayData['sTime'][2]?? ''}}" data-id="Tue_TB3_">
          </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="to">To:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To3[]" id="Tue_TB3_To" value="{{ $tuedayData['endTime'][2]?? ''}}" data-id="Tue_TB3_">
          </p>
        </div>
      </div>
    </div>

    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label for="place_of_publication">Wednesday/बुधवार: <span style="color: red;">*</span></label>
        <input type="hidden" name="weekday[]" value="2">
      </div>
    </div>
  <div class="col-sm-10">
    <div class="row">
      <div class="col-sm-2">
          <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From1[]" id="Wed_TB1_From" value="{{ $wednesdayData['sTime'][0]?? ''}}" data-id="Wed_TB1_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To1[]" id="Wed_TB1_To" value="{{ $wednesdayData['endTime'][0]?? ''}}" data-id="Wed_TB1_" data-deep="Wed_TB2_">
            </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From2[]" id="Wed_TB2_From" value="{{ $wednesdayData['sTime'][1]?? ''}}" data-id="Wed_TB2_">
            </p>
        </div>
       </div>
      <div class="col-sm-2">
          <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To2[]" id="Wed_TB2_To" value="{{ $wednesdayData['endTime'][1]?? ''}}" data-id="Wed_TB2_" data-deep="Wed_TB3_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="from">From:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From3[]" id="Wed_TB3_From" value="{{ $wednesdayData['sTime'][2]?? ''}}" data-id="Wed_TB3_">
          </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="to">To:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To3[]" id="Wed_TB3_To" value="{{ $wednesdayData['endTime'][2]?? ''}}" data-id="Wed_TB3_">
          </p>
        </div>
      </div>
    </div>
  </div>

    <div class="col-sm-2">
      <div class="form-group">
        <label for="place_of_publication">Thursday/गुरूवार: <span style="color: red;">*</span></label>
        <input type="hidden" name="weekday[]" value="3">
      </div>
    </div>
  <div class="col-sm-10">
    <div class="row">
      <div class="col-sm-2">
          <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From1[]" id="Thur_TB1_From" value="{{ $thusdayData['sTime'][0]?? ''}}" data-id="Thur_TB1_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To1[]" id="Thur_TB1_To" value="{{ $thusdayData['endTime'][0]?? ''}}" data-id="Thur_TB1_" data-deep="Thur_TB2_">
            </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From2[]" id="Thur_TB2_From" value="{{ $thusdayData['sTime'][1]?? ''}}" data-id="Thur_TB2_">
            </p>
        </div>
       </div>
      <div class="col-sm-2">
          <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To2[]" id="Thur_TB2_To" value="{{ $thusdayData['endTime'][1]?? ''}}" data-id="Thur_TB2_" data-deep="Thur_TB3_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="from">From:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From3[]" id="Thur_TB3_From" value="{{ $thusdayData['sTime'][2]?? ''}}" data-id="Thur_TB3_">
          </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="to">To:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To3[]" id="Thur_TB3_To" value="{{ $thusdayData['endTime'][2]?? ''}}" data-id="Thur_TB3_">
          </p>
        </div>
      </div>
    </div>

    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label for="place_of_publication">Friday/शुक्रवार: <span style="color: red;">*</span></label>
        <input type="hidden" name="weekday[]" value="4">
      </div>
    </div>
  <div class="col-sm-10">
    <div class="row">
      <div class="col-sm-2">
          <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From1[]" id="Fri_TB1_From" value="{{ $fridayData['sTime'][0]?? ''}}" data-id="Fri_TB1_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To1[]" id="Fri_TB1_To" value="{{ $fridayData['endTime'][0]?? ''}}" data-id="Fri_TB1_" data-deep="Fri_TB2_">
            </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From2[]" id="Fri_TB2_From" value="{{ $fridayData['sTime'][1]?? ''}}" data-id="Fri_TB2_">
            </p>
        </div>
       </div>
      <div class="col-sm-2">
          <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To2[]" id="Fri_TB2_To" value="{{ $fridayData['endTime'][1]?? ''}}" data-id="Fri_TB2_" data-deep="Fri_TB3_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="from">From:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From3[]" id="Fri_TB3_From" value="{{ $fridayData['sTime'][2]?? ''}}" data-id="Fri_TB3_">

          </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="to">To:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To3[]" id="Fri_TB3_To" value="{{ $fridayData['endTime'][2]?? ''}}" data-id="Fri_TB3_">
          </p>
        </div>
      </div>
    </div>

  </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label for="place_of_publication">Saturday/शनिवार: <span style="color: red;">*</span></label>
        <input type="hidden" name="weekday[]" value="5">
      </div>
    </div>
  <div class="col-sm-10">
    <div class="row">
      <div class="col-sm-2">
          <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From1[]" id="Sat_TB1_From" value="{{ $saturdayData['sTime'][0]?? ''}}" data-id="Sat_TB1_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To1[]" id="Sat_TB1_To" value="{{ $saturdayData['endTime'][0]?? ''}}" data-id="Sat_TB1_" data-deep="Sat_TB2_">
            </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From2[]" id="Sat_TB2_From" value="{{ $saturdayData['sTime'][1]?? ''}}" data-id="Sat_TB2_">
            </p>
        </div>
       </div>
      <div class="col-sm-2">
          <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To2[]" id="Sat_TB2_To" value="{{ $saturdayData['endTime'][1]?? ''}}" data-id="Sat_TB2_" data-deep="Sat_TB3_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="from">From:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From3[]" id="Sat_TB3_From" value="{{ $saturdayData['sTime'][2]?? ''}}" data-id="Sat_TB3_">
          </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="to">To:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To3[]" id="Sat_TB3_To" value="{{ $saturdayData['endTime'][2]?? ''}}" data-id="Sat_TB3_">
          </p>
        </div>
      </div>
    </div>
  </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label for="place_of_publication">Sunday/रविवार: <span style="color: red;">*</span></label>
        <input type="hidden" name="weekday[]" value="6">
      </div>
    </div>
  <div class="col-sm-10">
    <div class="row">
      <div class="col-sm-2">
          <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From1[]" id="Sun_TB1_From" value="{{ $sundayData['sTime'][0]?? ''}}" data-id="Sun_TB1_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To1[]" id="Sun_TB1_To" value="{{ $sundayData['endTime'][0]?? ''}}" data-id="Sun_TB1_" data-deep="Sun_TB2_">
            </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label for="from">From:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From2[]" id="Sun_TB2_From" value="{{ $sundayData['sTime'][1]?? ''}}" data-id="Sun_TB2_">
            </p>
        </div>
       </div>
      <div class="col-sm-2">
          <div class="form-group">
            <label for="to">To:</label>
            <p>
            <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To2[]" id="Sun_TB2_To" value="{{ $sundayData['endTime'][1]?? ''}}" data-id="Sun_TB2_" data-deep="Sun_TB3_">
            </p>
          </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="from">From:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_From3[]" id="Sun_TB3_From" value="{{ $sundayData['sTime'][2]?? ''}}" data-id="Sun_TB3_">
          </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label for="to">To:</label>
          <p>
          <input type="time" {{$disabled}} class="form-control form-control-sm"  name="TB_To3[]" id="Sun_TB3_To" value="{{ $sundayData['endTime'][2]?? ''}}" data-id="Sun_TB3_">
          </p>
        </div>
      </div>
    </div>
  </div>
  <!---End Time Band--->

    <div class="row col-md-12 ml-1" >
      <h4 class="subheading">GOPA Details / गोपा विवरण</h4>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="GOPA_Signing_Date">Date of signing  / हस्ताक्षर करने की दिनांक <span style="color: red;">*</span></label>
        <input {{$disabled}} type="date" name="GOPA_Signing_Date" class="form-control form-control-sm" id="GOPA_Signing_Date" min="{{ date('Y-m-d', strtotime('-10 years')) }}" max="{{date('Y-m-d')}}" value="{{ @$CM_radio[0]->{'GOPA Signing Date'} ? date('Y-m-d', strtotime(@$CM_radio[0]->{'GOPA Signing Date'})) : ''}}">
     </div>
   </div>
   <div class="col-md-6">
    <div class="form-group">
      <label for="GOPA_Valid_upto">Date valid upto / दिनांक तक मान्य है <span style="color: red;">*</span></label>
      <input {{$disabled}} type="date" name="GOPA_Valid_upto" class="form-control form-control-sm" id="GOPA_Valid_upto" min="{{ date('Y-m-d',strtotime('-10 years')) }}" value="{{ @$CM_radio[0]->{'GOPA Signing Date'} ? date('Y-m-d', strtotime(@$CM_radio[0]->{'GOPA Signing Date'})) : ''}}">
     </div>
    </div>

    <div class="row col-md-12 ml-1">
      <h4 class="subheading">WOL Details / वोलो विवरण</h4>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="WOL_Number">Number / संख्या <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" name="WOL_Number" class="form-control form-control-sm" id="WOL_Number" maxlength="5" onkeypress="return onlyNumberKey(event)" placeholder="Enter Number" value="{{@$CM_radio[0]->{'WOL Number'} ?? ''}}">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="WOL_Signing_Date">Date of signing  / हस्ताक्षर करने की दिनांक <span style="color: red;">*</span></label>
        <input {{$disabled}} type="date" name="WOL_Signing_Date" class="form-control form-control-sm" id="WOL_Signing_Date" min="{{ date('Y-m-d', strtotime('-10 years')) }}" max="{{date('Y-m-d')}}" value="{{ @$CM_radio[0]->{'WOL Signing Date'} ? date('Y-m-d', strtotime(@$CM_radio[0]->{'WOL Signing Date'})) : ''}}">
      </div>
    </div>
    <div class="col-md-4">
       <div class="form-group">
        <label for="WOL_Valid_Upto">Date valid upto / दिनांक तक मान्य है <span style="color: red;">*</span></label>
        <input {{$disabled}} type="date" name="WOL_Valid_Upto" class="form-control form-control-sm" id="WOL_Valid_Upto" min="{{ date('Y-m-d',strtotime('-10 years')) }}" value="{{ @$CM_radio[0]->{'WOL Valid Upto'} ? date('Y-m-d', strtotime(@$CM_radio[0]->{'WOL Valid Upto'})) : ''}}">
      </div>
    </div>
    @php
        $aar =array(1=>'Pvt', 2=>'Ltd',3=>'Others');
    @endphp
   <div class="col-md-4">
      <div class="form-group">
        <label for="Company_Legal_Status">Legal status of company / कंपनी की कानूनी स्थिति <span style="color: red;">*</span></label>
          <select {{$disabled}}  id="Company_Legal_Status" class="form-control form-control-sm" name="Company_Legal_Status">
          <option value="">Select legal status of company</option>

           @foreach($aar as $key=>$value){
          <option value="{{$key}}" @if(@$CM_radio[0]->{'Company Legal Status'} == $key)  selected="selected" @endif> {{$value}}</option>
          @endforeach
        }
          </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="Cnannel_Head">Director/ceo/head of company /channel / निदेशक/सीईओ/कंपनी/चैनल के प्रमुख <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" name="Cnannel_Head" class="form-control form-control-sm" id="Cnannel_Head" maxlength="40" placeholder="Enter Head of Company" value="{{@$CM_radio[0]->{'Cnannel Head'} ?? ''}}">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="Channel_Launch_Date">Date of launch of channel / चैनल के शुभारंभ की दिनांक <span style="color: red;">*</span></label>
        <input {{$disabled}} type="date" name="Channel_Launch_Date" class="form-control form-control-sm" id="Channel_Launch_Date" value="{{ @$CM_radio[0]->{'Channel Launch Date'} ? date('Y-m-d', strtotime(@$CM_radio[0]->{'Channel Launch Date'})) : ''}}" max="{{ date('Y-m-d') }}">
      </div>
    </div>
    </div>
      <!-- Start Channel Office ---->
    <div class="row col-md-12">
    <!-- <h4 class="subheading">Address Details / पते का विवरण:</h4> -->
    <h4 class="subheading">Channel Office / चैनल कार्यालय</h4>
    </div>
    <div class="row">
    <div class="col-md-4">
    <div class="form-group">
    <label for="Address">Address / पता <span style="color: red;">*</span></label>
      <textarea {{$disabled}} class="form-control form-control-sm" name="Address" maxlength="140" id="Address" cols="50" placeholder="Enter Address">{{@$CM_radio[0]->{'Address'} ?? ''}}</textarea>
     </div>
    </div>

     <div class="col-md-4">
       <div class="form-group">
        <label for="State">State / राज्य <span style="color: red;">*</span></label>
        <select {{$disabled}}  id="state_id1" name="State" class="form-control form-control-sm">
            <option value="">Select State</option>
                @if(count($result) > 0)
                @foreach($result as $statesData)
                <option value="{{ $statesData['Code'] }}" @if(@$CM_radio[0]->{'State'} == $statesData['Code']) selected="selected" @endif>{{$statesData['Description']}}</option>
                @endforeach
                @endif
        </select>
       </div>
     </div>
    <div class="col-md-4">
        <div class="form-group">
        <label for="District">District / जिला <span style="color: red;">*</span></label>
        <select {{$disabled}}  id="district_id1" name="District" class="form-control form-control-sm">
          <option value="">Select Option</option>
       @if(!empty(@$CM_radio[0]->{'District'}))
        <option selected="selected">{{@$CM_radio[0]->{'District'} ?? ''}}</option>
            @endif
        </select>
       </div>
      </div>
      <div class="col-md-4">
      <div class="form-group">
        <label for="City">City / नगर <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" id="City"  name="City" class="form-control form-control-sm" placeholder="Enter City" value="{{@$CM_radio[0]->{'City'} ?? ''}}" maxlength="20">

       </div>
    </div>
    <div class="col-md-4">
       <div class="form-group">
        <label for="PIN_Code">Pin Code / पिन कोड <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="PIN_Code" id="PIN_Code" placeholder="Enter Pin Code" maxlength="6" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'PIN Code'} ?? ''}}">
      </div>
     </div>


    <div class="col-md-4">
       <div class="form-group">
        <label for="Phone_No">Phone No.(with std) / फोन नंबर (एसटीडी के साथ)</label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="Phone_No" id="Phone_No" placeholder="Enter Phone No." maxlength="15" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'Phone No_(with STD)'} ?? ''}}">
      </div>
    </div>

     {{-- <div class="col-md-4">
       <div class="form-group">
        <label for="Fax">Fax No./ फैक्स नंबर</label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="Fax" id="Fax" placeholder="Enter Fax No." maxlength="15" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'Fax'} ?? ''}}">
      </div>
     </div> --}}

     <div class="col-md-4">
        <div class="form-group">
          <label for="Mobile_No">Mobile No. / मोबाइल नंबर</label>
          <input {{$disabled}} type="text" class="form-control form-control-sm" name="Mobile_No" id="Mobile_No" placeholder="Enter Mobile" maxlength="10" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'Mobile No_'} ?? ''}}">
        </div>
    </div>

     <div class="col-md-4">
        <div class="form-group">
          <label for="E_Mail">E-mail ID / ई मेल आईडी <span style="color: red;">*</span></label>
          <input {{$disabled}} type="email" class="form-control form-control-sm" name="E_Mail" id="E_Mail" placeholder="Enter Email" maxlength="150" value="{{@$CM_radio[0]->{'E-Mail'} ?? ''}}">
        </div>
      </div>
 </div>
    <!---- End Channel Office ---->
    <!---- Start Channel Head Office ---->
    <div class="row col-md-12">
    <h4 class="subheading">Channel head office / चैनल प्रधान कार्यालय</h4>
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- checkbox -->
        <div class="form-group clearfix">
          <div class="icheck-primary d-inline">
            @if(@$CM_radio[0]->{'HO Same Address DO'}== '1')
            <input {{$disabled}} type="checkbox" id="HO_Same_Address_DO" name="HO_Same_Address_DO" value="1" checked="checked">
            @else
            <input {{$disabled}} type="checkbox" id="HO_Same_Address_DO" name="HO_Same_Address_DO" value="1">
            @endif
            <label for="HO_Same_Address_DO">Same as channel office / चैनल कार्यालय के समान</label>
          </div>
        </div>
      </div>
     </div>
    <div class="row">
    <div class="col-md-4">
    <div class="form-group">
    <label for="HO_Address">Address / पता <span style="color: red;">*</span></label>
      <textarea {{$disabled}} class="form-control form-control-sm" name="HO_Address" maxlength="140" id="HO_Address" cols="50" placeholder="Enter Address">{{@$CM_radio[0]->{'HO Address'} ?? ''}}</textarea>
     </div>
    </div>

     <div class="col-md-4">
       <div class="form-group">
        <label for="HO_State">State / राज्य <span style="color: red;">*</span></label>
        <select {{$disabled}}  id="HO_State" name="HO_State" class="form-control form-control-sm">
            <option value="">Select State</option>
             @if(count($result) > 0)
                @foreach($result as $statesData)
                <option value="{{ $statesData['Code'] }}" @if(@$CM_radio[0]->{'State'} == $statesData['Code']) selected="selected" @endif>{{$statesData['Description']}}</option>
                @endforeach
                @endif
        </select>
       </div>
     </div>
    <div class="col-md-4">
        <div class="form-group">
        <label for="HO_District">District / जिला <span style="color: red;">*</span></label>
      <select {{$disabled}}  id="HO_District" name="HO_District" class="form-control form-control-sm">
          <option value="">Select Option</option>
       @if(!empty(@$CM_radio[0]->{'District'}))
        <option selected="selected">{{@$CM_radio[0]->{'District'} ?? ''}}</option>
            @endif

        </select>
       </div>
      </div>
      <div class="col-md-4">
      <div class="form-group">
        <label for="HO_City">City / नगर <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" id="HO_City" name="HO_City" class="form-control form-control-sm" placeholder="Enter City" value="{{@$CM_radio[0]->{'HO City'} ?? ''}}">
        </div>
    </div>
      <div class="col-md-4">
       <div class="form-group">
        <label for="HO_PIN_Code">Pin Code / पिन कोड <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="HO_PIN_Code" id="HO_PIN_Code" placeholder="Enter Pin Code" maxlength="6" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'HO PIN Code'} ?? ''}}">
      </div>
     </div>


    <div class="col-md-4">
       <div class="form-group">
        <label for="HO_Phone_No">Phone No.(with std) / फोन नंबर (एसटीडी के साथ)</label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="HO_Phone_No" id="HO_Phone_No" placeholder="Enter Phon Number" maxlength="15" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'HO Phone No_(with STD)'} ?? ''}}">
      </div>
    </div>

     {{-- <div class="col-md-4">
       <div class="form-group">
        <label for="HO_Fax">Fax No. / फैक्स नंबर</label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="HO_Fax" id="HO_Fax" placeholder="Enter Fax No." maxlength="15" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'HO Fax'} ?? ''}}">
      </div>
     </div> --}}

     <div class="col-md-4">
        <div class="form-group">
          <label for="HO_Mobile_No">Mobile No. / मोबाइल नंबर</label>
          <input {{$disabled}} type="text" class="form-control form-control-sm" name="HO_Mobile_No" id="HO_Mobile_No" placeholder="Enter Mobile No." maxlength="10" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'HO Mobile No_'} ?? ''}}">
        </div>
    </div>

     <div class="col-md-4">
        <div class="form-group">
          <label for="HO_E_Mail">E-mail ID / ई मेल आईडी <span style="color: red;">*</span></label>
          <input {{$disabled}} type="email" class="form-control form-control-sm" name="HO_E_Mail" id="HO_E_Mail" placeholder="Enter Email" maxlength="150" value="{{@$CM_radio[0]->{'HO E-Mail'} ?? ''}}">
        </div>
      </div>
 </div>
    <!---- End Channel Head Office ---->

     <!---- Start Owner Head Office ---->
     <div class="row col-md-12">
    <h4 class="subheading">Owner head office / मालिक प्रधान कार्यालय</h4>
  </div>
    <div class="row">
      <div class="col-md-12">
        <!-- checkbox -->
        <div class="form-group clearfix">
          <div class="icheck-primary d-inline">

             @if(@$CM_radio[0]->{'OHO Same Address DO'} == '1')
            <input {{$disabled}} type="checkbox" id="checkbox1" name="OHO_Same_Address_DO" value="1" checked="checked">
            @else
            <input {{$disabled}} type="checkbox" id="checkbox1" name="OHO_Same_Address_DO" value="1">
            @endif
            <label for="checkbox1">Same as channel office / चैनल कार्यालय के समान</label>
          </div>
        </div>
      </div>
     </div>
    <div class="row">
    <div class="col-md-4">
    <div class="form-group">
    <label for="OHO_Address">Address / पता<span style="color: red;">*</span></label>
      <textarea {{$disabled}} class="form-control form-control-sm" name="OHO_Address" maxlength="140" id="OHO_Address" placeholder="Enter Address" cols="50">{{@$CM_radio[0]->{'OHO Address'} ?? ''}}</textarea>
     </div>
    </div>
     <div class="col-md-4">
       <div class="form-group">
        <label for="OHO_State
        ">State / राज्य <span style="color: red;">*</span></label>
        <select {{$disabled}}  id="OHO_State" name="OHO_State" class="form-control form-control-sm">
            <option value="">Select State</option>
            @if(count($result) > 0)
                @foreach($result as $statesData)
                <option value="{{ $statesData['Code'] }}" @if(@$CM_radio[0]->{'State'} == $statesData['Code']) selected="selected" @endif>{{$statesData['Description']}}</option>
                @endforeach
                @endif
        </select>
       </div>
     </div>
    <div class="col-md-4">
    <div class="form-group">
    <label for="OHO_District">District / जिला <span style="color: red;">*</span></label>
      <select {{$disabled}}  id="OHO_District" name="OHO_District" class="form-control form-control-sm">
            <option value="">Select Option</option>
       @if(!empty(@$CM_radio[0]->{'District'}))
        <option selected="selected">{{@$CM_radio[0]->{'District'} ?? ''}}</option>
            @endif
        </select>
       </div>
      </div>
      <div class="col-md-4">
      <div class="form-group">
        <label for="OHO_City">City / नगर <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" id="OHO_City" name="OHO_City" class="form-control form-control-sm" placeholder="Enter City" value="{{@$CM_radio[0]->{'OHO City'} ?? ''}}">
    </div>
    </div>
      <div class="col-md-4">
       <div class="form-group">
        <label for="OHO_PIN_Code">Pin Code / पिन कोड <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="OHO_PIN_Code" id="OHO_PIN_Code" placeholder="Enter Pin Code" maxlength="6" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'OHO PIN Code'} ?? ''}}">
      </div>
     </div>
    <div class="col-md-4">
       <div class="form-group">
        <label for="OHO_Phone_No">Phone No.(with std) / फोन नंबर (एसटीडी के साथ)</label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="OHO_Phone_No" id="OHO_Phone_No" placeholder="Enter Phone No." maxlength="15" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'OHO Phone No_(with STD)'} ?? ''}}">
      </div>
    </div>

     {{-- <div class="col-md-4">
       <div class="form-group">
        <label for="OHO_Fax">Fax No./ फैक्स नंबर</label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="OHO_Fax" id="OHO_Fax" placeholder="Enter Fax No." maxlength="15" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'OHO Fax'} ?? ''}}">
      </div>
     </div> --}}

     <div class="col-md-4">
        <div class="form-group">
          <label for="OHO_Mobile_No">Mobile No. / मोबाइल नंबर</label>
          <input {{$disabled}} type="text" class="form-control form-control-sm" name="OHO_Mobile_No" id="OHO_Mobile_No" placeholder="Enter Mobile No." maxlength="10" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'OHO Mobile No_'} ?? ''}}">
        </div>
    </div>

     <div class="col-md-4">
        <div class="form-group">
          <label for="OHO_E_Mail">E-mail ID / ई मेल आईडी <span style="color: red;">*</span></label>
          <input {{$disabled}} type="email" class="form-control form-control-sm" name="OHO_E_Mail" id="OHO_E_Mail" placeholder="Enter Email" maxlength="150" value="{{@$CM_radio[0]->{'OHO E-Mail'} ?? ''}}">
        </div>
      </div>
 </div>
<!--  <input type="hidden" name="cummchannel" id="cummchannel" > -->
@if(@$CM_radio[0]->{'Community Radio ID'} != '')
  <input type="hidden" name="CMRadio" id="CMRadio" value="{{@$CM_radio[0]->{'Community Radio ID'} ?? ''}}">
  @else
    <input type="hidden" name="CMRadio" id="CMRadio" >
  @endif
 <input type="hidden" name="next_tab_2" id="next_tab_2"  value="0">
    <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
    <a class="btn btn-primary community-next-button" id="tab_2">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
</div>

  <div id="tab3" class="content content pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
    <br>
  <div class="row">
   <div class="col-md-6">
     <div class="form-group">
      <label for="Bank_Ac_No">Bank account no. for receiving payments / भुगतान प्राप्त करने के लिए बैंक खाता संख्या <span style="color: red;">*</span></label>
      <input {{$disabled}} type="text" class="form-control form-control-sm" id="Bank_Ac_No" name="Bank_Ac_No" placeholder="Enter Bank Account Number" maxlength="20" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'Bank A_c No_'} ?? ''}}">
      </div>
    </div>

    <div class="col-md-6">
     <div class="form-group">
      <label for="AC_Holder_Name">Account holder name / खाता धारक का नाम <span style="color: red;">*</span></label>
      <input {{$disabled}} type="text" class="form-control form-control-sm" name="AC_Holder_Name" id="AC_Holder_Name" placeholder="Enter Account holder Name" onkeypress="return onlyAlphabets(event,this);" maxlength="80" value="{{@$CM_radio[0]->{'A_C Holder Name'} ?? ''}}">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="IFSC_Code">IFSC Code / IFSC कोड <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="IFSC_Code" id="IFSC_Code" placeholder="Enter IFSC Code" maxlength="15" value="{{@$CM_radio[0]->{'IFSC Code'} ?? ''}}">
        <span id="alert_IFSC_Code" style="color:red;display: none;"></span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="Bank_Name">Bank Name / बैंक का नाम <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="Bank_Name" id="Bank_Name" placeholder="Enter Bank Name" maxlength="50" value="{{@$CM_radio[0]->{'Bank Name'} ?? ''}}">
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="Bank_Branch">Branch / शाखा <span style="color: red;">*</span></label>
        <input {{$disabled}} type="text" class="form-control form-control-sm" name="Bank_Branch" id="Bank_Branch" placeholder="Enter Branch" maxlength="50" value="{{@$CM_radio[0]->{'Bank Branch'} ?? ''}}">
      </div>
    </div>

    <div class="col-md-6">
       <div class="form-group">
        <label for="Bank_AC_Address">Address of account / खाते पर पता <span style="color: red;">*</span></label>
       <textarea {{$disabled}}  name="Bank_AC_Address" class="form-control form-control-sm" placeholder="Enter Address of account" maxlength="250" id="Bank_AC_Address">{{@$CM_radio[0]->{'Bank A_C Address'} ?? ''}}</textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="PAN">Pan card no. / पैन कार्ड नंबर <span style="color: red;">*</span></label>
       <input {{$disabled}} type="text" name="PAN" class="form-control form-control-sm" id="pan_card" placeholder="Enter Pan card No." maxlength="10" value="{{@$CM_radio[0]->{'PAN'} ?? ''}}">
       <span id=" " style="color:red;display: none;"></span>
      </div>

    </div>
    <div class="col-md-6">
     <div class="form-group">
        <label for="GST_No">GST No. / जीएसटी संख्या <span style="color: red;">*</span></label>
       <input {{$disabled}} type="text" name="GST_No" class="form-control form-control-sm" id="GST_No" placeholder="Enter GST No" onkeypress="return isAlphaNumeric(event)" maxlength="15" value="{{@$CM_radio[0]->{'GST No_'} ?? ''}}">
       <span class="gstvalidationMsg"></span>
       <span class="validcheck"></span>
     </div>
    </div>
    <!-- <div class="row col-md-12 ml-1">
      <h4 class="subheading">ESI Account Details / ईएसआई खाता विवरण</h4>
    </div> -->
    <fieldset class="fieldset-border">
      <legend>ESI account details / ईएसआई खाता विवरण:</legend>
      <div class="row">
    <div class="col">
      <div class="form-group">
        <label for="ESI_AC_No">Account no. / खाता नंबर<span style="color: red;">*</span></label>
       <input {{$disabled}} type="text" name="ESI_AC_No" class="form-control form-control-sm" placeholder="Enter Account no" maxlength="20" id="ESI_AC_No" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'ESI A_C No_'} ?? ''}}">
     </div>
    </div>

    <div class="col">
       <div class="form-group">
        <label for="ESI_No_Of_Employee">No. of employees covered / कवर किए गए कर्मचारियों की संख्या <span style="color: red;">*</span></label>
       <input {{$disabled}} type="text" name="ESI_No_Of_Employee" id="ESI_No_Of_Employee" class="form-control form-control-sm" placeholder="Enter No of employees covered" onkeypress="return onlyNumberKey(event)" maxlength="6" value="@if(@$CM_radio[0]->{'ESI - No_ Of Employee'} > 0){{@$CM_radio[0]->{'ESI - No_ Of Employee'} ?? ''}}@endif">
      </div>
    </div>
  </div>
</fieldset>
    <!-- <div class="row col-md-12 ml-1">
      <h4 class="subheading">EPF Account Details / ईपीएफ खाता विवरण</h4>
    </div> -->
    <fieldset class="fieldset-border">
      <legend>EPF account details / ईपीएफ खाता विवरण</legend>
      <div class="row">
    <div class="col">
       <div class="form-group">
        <label for="EPF_AC_No">Account no. / खाता नंबर <span style="color: red;">*</span></label>
       <input {{$disabled}} type="text" name="EPF_AC_No" class="form-control form-control-sm" placeholder="Enter Account no." maxlength="20" id="EPF_AC_No" onkeypress="return onlyNumberKey(event)" value="{{@$CM_radio[0]->{'EPF A_C No_'} ?? ''}}">
      </div>
    </div>
    <div class="col">
       <div class="form-group">
        <label for="EPF_No_Of_Employee">No. of employees covered / कवर किए गए कर्मचारियों की संख्या <span style="color: red;">*</span></label>
       <input {{$disabled}} type="text" name="EPF_No_Of_Employee" id="EPF_No_Of_Employee" class="form-control form-control-sm" placeholder="Enter No. of employees covered" onkeypress="return onlyNumberKey(event)" maxlength="6" value="@if(@$CM_radio[0]->{'EPF - No_ Of Employee'} > 0){{@$CM_radio[0]->{'EPF - No_ Of Employee'} ?? ''}}@endif">
      </div>
    </div>
    </div>
  </fieldset>
</div>
   <input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3" >

    <input type="hidden" name="next_tab_3" id="next_tab_3" value="0">
    <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
    <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
    <a class="btn btn-primary community-next-button" id="tab_3">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
  </div>
  <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="information-part-trigger">
<!--   <div class="form-group">
    <label for="FPC_File_Name">Upload attached Fixed Point Chart (FPC) for one week (Excel File) / एक सप्ताह के लिए संलग्न फिक्स्ड प्वाइंट चार्ट (एफपीसी) अपलोड करें (एक्सेल फाइल) <span style="color: red;">*</span></label>
    <div class="input-group">
      <div class="custom-file">
        <input {{$disabled}} type="file" class="custom-file-input" id="FPC_File_Name" name="FPC_File_Name" {{$disabled}}>
        <label class="custom-file-label" for="FPC_File_Name" id="FPC_File_Name2">Choose file</label>
      </div>
      @if(@$CM_radio[0]->{'FPC File Name'} != '')
    <div class="input-group-append">
      <span class="input-group-text"><a href="{{ url('/uploads') }}/cm_radio_station/{{ @$CM_radio[0]->{'FPC File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
    </div>
    @else
    <div class="input-group-append">
      <span class="input-group-text" id="FPC_File_Name3">Upload</span>
    </div>
    @endif
  </div>
    <span id="FPC_File_Name1" class="error invalid-feedback"></span>
  </div> -->
  <div class="form-group">
    <label for="GOPA_File_Name">Copy of grant of permission agreement(gopa) signed with the ministry of I&B. / सूचना एवं प्रसारण मंत्रालय के साथ हस्ताक्षरित अनुमति समझौते (gopa) की प्रति। <span style="color: red;">*</span></label>
    <div class="input-group">
      <div class="custom-file">
        <input {{$disabled}} type="file" class="custom-file-input" id="GOPA_File_Name" name="GOPA_File_Name">
        <label class="custom-file-label" for="GOPA_File_Name" id="GOPA_File_Name2">{{ @$CM_radio[0]->{'GOPA File Name'} ?? 'Choose file' }}</label>
      </div>
      @if(@$CM_radio[0]->{'GOPA File Name'} != '')
    <div class="input-group-append">
      <span class="input-group-text"><a href="{{ url('/uploads') }}/cm_radio_station/{{ @$CM_radio[0]->{'GOPA File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
    </div>
    @else
    <div class="input-group-append">
      <span class="input-group-text" id="GOPA_File_Name3">Upload</span>
    </div>
    @endif
    </div>
    <span id="GOPA_File_Name1" class="error invalid-feedback"></span>
  </div>

  <div class="form-group">
    <label for="GST_Cert_File_Name">Upload gst certificate/जीएसटी प्रमाणपत्र अपलोड करें <span style="color: red;">*</span></label>
    <div class="input-group">
      <div class="custom-file">
        <input {{$disabled}} type="file" class="custom-file-input" id="GST_Cert_File_Name" name="GST_Cert_File_Name">
        <label class="custom-file-label" for="GST_Cert_File_Name" id="GST_Cert_File_Name2">{{ @$CM_radio[0]->{'GST Cert File Name'} ?? 'Choose file' }}</label>
      </div>
      @if(@$CM_radio[0]->{'GST Cert File Name'} != '')
    <div class="input-group-append">
      <span class="input-group-text"><a href="{{ url('/uploads') }}/cm_radio_station/{{ @$CM_radio[0]->{'GST Cert File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
    </div>
    @else
    <div class="input-group-append">
      <span class="input-group-text" id="GST_Cert_File_Name3">Upload</span>
    </div>
    @endif
   </div>
    <span id="GST_Cert_File_Name1" class="error invalid-feedback"></span>
  </div>
  <div class="form-group">
    <label for="PAN_Card_File_Name">Upload pan card / पैन कार्ड अपलोड करें <span style="color: red;">*</span></label>
    <div class="input-group">
      <div class="custom-file">
        <input {{$disabled}} type="file" class="custom-file-input" id="PAN_Card_File_Name" name="PAN_Card_File_Name">
        <label class="custom-file-label" for="PAN_Card_File_Name" id="PAN_Card_File_Name2">{{ @$CM_radio[0]->{'PAN Card File Name'} ?? 'Choose file' }}</label>
      </div>
      @if(@$CM_radio[0]->{'PAN Card File Name'} != '')
    <div class="input-group-append">
      <span class="input-group-text"><a href="{{ url('/uploads') }}/cm_radio_station/{{ @$CM_radio[0]->{'PAN Card File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
    </div>
    @else
    <div class="input-group-append">
      <span class="input-group-text" id="PAN_Card_File_Name3">Upload</span>
    </div>
    @endif
    </div>
        <span id="PAN_Card_File_Name1" class="error invalid-feedback"></span>
  </div>

  <div class="form-group">
    <label for="CRS_Cert_File_Name">Self-certification by the head of crs certifying that the crs is functional and is continuously broadcasting at least two hours of programmes per day since last three months / सीआरएस के प्रमुख द्वारा स्व-प्रमाणन यह प्रमाणित करता है कि सीआरएस काम कर रहा है और पिछले तीन महीनों से प्रतिदिन कम से कम दो घंटे के कार्यक्रमों का लगातार प्रसारण कर रहा है। <span style="color: red;">*</span></label>
     <div class="input-group">
      <div class="custom-file">
        <input {{$disabled}} type="file" class="custom-file-input" id="CRS_Cert_File_Name" name="CRS_Cert_File_Name">
        <label class="custom-file-label" for="CRS_Cert_File_Name" id="CRS_Cert_File_Name2">{{ @$CM_radio[0]->{'CRS Cert File Name'} ?? 'Choose file' }}</label>
      </div>
      @if(@$CM_radio[0]->{'CRS Cert File Name'} != '')
      <div class="input-group-append">
        <span class="input-group-text"><a href="{{ url('/uploads') }}/cm_radio_station/{{ @$CM_radio[0]->{'CRS Cert File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
      </div>
      @else
      <div class="input-group-append">
        <span class="input-group-text" id="CRS_Cert_File_Name3">Upload</span>
      </div>
      @endif
      </div>
    <span id="CRS_Cert_File_Name1" class="error invalid-feedback"></span>
  </div>
  <div class="row">
    <div class="col-md-12">
        <!-- checkbox -->
      <div class="form-group clearfix">
        <div class="icheck-primary d-inline">
          @if(@$CM_radio[0]->{'Acceptance'} == '1')
          <input {{$disabled}} type="checkbox" id="self_declaration" name="Acceptance" value="1" checked="checked">
          @else
          <input {{$disabled}} type="checkbox" id="self_declaration" name="Acceptance" value="1">
          @endif
          <label for="self_declaration">I confirm that all the information given by me is true and nothing has been concealed. / मैं पुष्टि करता हूं कि मेरे द्वारा दी गई सभी जानकारी सत्य है और कुछ भी छुपाया नहीं गया है। <span style="color: red;">*</span></label>
        </div>
      </div>
    </div>
  </div>
        <input type="hidden" name="doc[]" id="doc_data">
        <input type="hidden" name="submit_btn" id="submit_btn" value="0" >
        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg" ></i> Previous</a>@if(@$FMdata[0]['Status'] == 1)
        <a class="btn btn-primary community-next-button" style="pointer-events: none;"><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</a>
        @else
        <a class="btn btn-primary community-next-button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</a>
        @endif
                  </div>
                </div>
               </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


@section('custom_js')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{ url('/js') }}/validator.js"></script>
<script src="{{ url('/js') }}/community-radio-station.js"></script>
<script src="{{ url('/js') }}/validation_comman.js"></script>
<script src="{{ url('/js') }}/avtv_common.js"></script>

<script>

$(document).ready(function(){
$("#state_id").on('change',function(){
  var state_code =$(this).val();
  //alert(state_code);
  $.ajax({
    url:'getDistrictcomm1',
    type:'GET',
    data:{state_code:state_code},
    success: function(data){
      // console.log(data);
      $("#district_id0").html(data);
    }
  });
});



$("#state_id1").on('change',function(){
  var state_code =$(this).val();
  //alert(state_code);
  $.ajax({
    url:'getDistrictcomm1',
    type:'GET',
    data:{state_code:state_code},
    success: function(data){
      // console.log(data);
      $("#district_id1").html(data);
    }
  });


});
$("#HO_State").on('change',function(){
  var state_code =$(this).val();
  //alert(state_code);
  $.ajax({
    url:'getDistrictcomm1',
    type:'GET',
    data:{state_code:state_code},
    success: function(data){
      // console.log(data);
      $("#HO_District").html(data);
    }
  });
});
$("#OHO_State").on('change',function(){
  var state_code =$(this).val();
  //alert(state_code);
  $.ajax({
    url:'getDistrictcomm1',
    type:'GET',
    data:{state_code:state_code},
    success: function(data){
      // console.log(data);
      $("#OHO_District").html(data);
    }
  });
});
});
function nextSaveData(id) {
  var formeditable='<?php
    echo $disabled;
  ?>';
  console.log(formeditable);
  if(formeditable=='disabled'){
    return false;
  }

    ///console.log($("#" + id).val());
    if ($("#" + id).val() == 0) {
      $("#" + id).val(1);
    } else {
      $("#" + id).val(1);
    }

    var data = new FormData($("#community_radio_station")[0]);
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    }
  });
    $.ajax({
      type: "post",
      url: "{{Route('saveCommRadio')}}",
      data: data,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function(data) {
       console.log(data);
        if (data['success'] == true) {
          if (id == 'next_tab_1') {
            // console.log(data);
           $("#ownerid").val(data.data);
          // console.log(data);
           }
          //  else {
          //   $("#CMRadio").val(data.data);
          //   console.log(data.data);
          //   //   $("#next_tab_3").val(data.data);
          //   // $("#vendorid_tab_4").val(data.data);

          // }
          if(id=='next_tab_2'){
            $("#CMRadio").val(data.data);
            //console.log(data);
          }
          if(id=='next_tab_3'){
             $("#vendorid_tab_3").val(data.data);
             $("#vendorid_tab_4").val(data.data);
          }
           if(id=='submit_btn'){
            $('html, body').animate({
         scrollTop: $(".content-inside").offset().top
    }, 1000);
            //$(".content-inside").focus();
            $("#Final_submi").show();
            $("#Final_submi").text(data.message);

            setTimeout(function(){
              window.location.href ='community-radio-station';
             },5000);
            console.log(data.message);
          }
        }
      },
      error: function(error) {
        console.log('error');
      }
    });
  }


 //Pan card validation
function validatePanNumber2(pan) {
  let pannumber = $(pan).val().toUpperCase();
  if (pannumber.match(/^[A-z]{5}\d{4}[A-Z]{1}$/)) {
    $(pan).val(pannumber);
    $("#alert_"+pan.id).text(" Valid PAN number").show().css("color", "green");
  } else {
    $("#alert_"+pan.id).text(" Invalid PAN number").show().css("color", "red");
   // $(pan).val("");
  }
}
//IFSC Code validation
function validateIfscCode(ifsc) {
  let ifscnumber = $(ifsc).val().toUpperCase();
  if (ifscnumber.match(/^[A-Z]{4}0[0-9]{6}$/)) {
    $(ifsc).val(ifscnumber);
    $("#alert_"+ifsc.id).text(" Valid IFSC code").show().css("color", "green");
  } else {
    $("#alert_"+ifsc.id).text(" Invalid IFSC code").show().css("color", "red");
  }
}
//GST No Validation

function checkcmradio(gst_no) {
  let regTest = /\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/.test(gst_no);
  if (regTest) {
    var gstMsg = 'GST No. is valid format';
    $('.gstvalidationMsg').removeClass('alert-info-msg2');
    $('.gstvalidationMsg').addClass('alert-info-msg');
    $('.gstvalidationMsg').text(gstMsg);
    $('.validcheck').html("<i class='fa fa-check' aria-hidden='true'></i>");
    return true;
  } else {
    var gstMsg = 'Enter Valid format GST No. like(18AABCU9603R1ZM)';
    $('.gstvalidationMsg').removeClass('alert-info-msg');
    $('.gstvalidationMsg').addClass('alert-info-msg2');
    $('.gstvalidationMsg').text(gstMsg);
    $('.validcheck').html("");
    return false;
  }
}
//IFSC Code get data through api

$("#IFSC_Code").on('blur', function() {
    var IFSC = $(this).val();
    console.log(IFSC);
    $.ajax({
        url:'/getIFSC',
        type: 'get',
        dataType: "json",
        data:{IFSC:IFSC},
        success: function(data) {
        if (data.UPI == true && IFSC != '') {
           console.log(data);
            $("#Bank_Name").val(data.BANK);
            $("#Bank_Branch").val(data.BRANCH);
            $("#Bank_AC_Address").val(data.ADDRESS);
        }else {
           $("#Bank_Name").val('');
            $("#Bank_Branch").val('');
            $("#Bank_AC_Address").val('');
        }
        },
        error: function(error) {
            console.log(error);
        }
    })
})
</script>
@endsection
