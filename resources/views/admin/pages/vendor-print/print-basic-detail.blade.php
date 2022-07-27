@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
@section('content')

<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Company Detail </h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      @if(Session::has('update_msg')) 
      <div align="center" class="alert alert-success">
        {{ Session('update_msg') }}
      </div>
      @endif
      @if(Session::has('update_err'))
      <div align="center" class="alert alert-danger">
        {{ Session('update_err') }}
      </div>
      @endif

      <!-- <div style="display: none;" align="center" class="alert alert-danger"></div> -->
      <form method="POST" action="{{Route('basic-detail-save')}}" enctype="multipart/form-data" autocomplete="off" id="owner_details_form">
        {{ csrf_field() }}

        <div class="tab-content">
          <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="owner_name">Owner Name / मालिक का नाम</label>
                  <input type="text" class="form-control form-control-sm" id="name" name="owner_name" placeholder="Enter Owner Name" onkeypress="return onlyAlphabets(event,this)" maxlength="40" value="{{ @$ownerdatas['Owner Name'] ?? '' }}">
                  @error('owner_name')
                  <span style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">E-mail ID(Owner) / ई-मेल आईडी<font color="red">*</font></label>
                  <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" maxlength="50" placeholder="Enter E-mail ID" value="{{ @$ownerdatas['Email ID'] ?? '' }}" onchange="return checkUniqueOwner('email', this.value)">
                  <span id="alert_email" style="color:red;display: none;"></span>
                  @error('email')
                  <span style="color:red;" class="invalid-feedback"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm @error('mobile') is-invalid @enderror " id="mobile" name="mobile" placeholder="Enter Mobile No." onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{ @$ownerdatas['Mobile No_'] ?? '' }}" onchange="return checkUniqueOwner('mobile', this.value)">
                  <span id="alert_mobile" style="color:red;display: none;"></span>
                  @error('mobile')
                  <span style="color:red;" class="invalid-feedback"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Owner Type / मालिक का प्रकार<font color="red">*</font></label>
                  <select name="owner_type" id="owner_type" class="form-control  form-control-sm" style="width: 100%;">
                    <option value="">Please Select</option>
                    <option value="0" <?= (@$ownerdatas['Owner Type'] == 0 && @$ownerdatas['Owner Type'] != "") ? 'selected' : '' ?>>Individual</option>
                    <option value="1" <?= (@$ownerdatas['Owner Type'] == 1) ? 'selected' : '' ?>>Partnership</option>
                    <option value="2" <?= (@$ownerdatas['Owner Type'] == 2) ? 'selected' : '' ?>>Trust</option>
                    <option value="3" <?= (@$ownerdatas['Owner Type'] == 3) ? 'selected' : '' ?>>Society</option>
                    <option value="4" <?= (@$ownerdatas['Owner Type'] == 4) ? 'selected' : '' ?>>Proprietorship</option>
                    <option value="5" <?= (@$ownerdatas['Owner Type'] == 5) ? 'selected' : '' ?>>Public Ltd.</option>
                    <option value="6" <?= (@$ownerdatas['Owner Type'] == 6) ? 'selected' : '' ?>>Pvt. Ltd.</option>
                  </select>
                  @error('owner_type')
                  <span style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="address">Address / पता<font color="red">*</font></label>
                  <textarea name="address" id="address" placeholder="Enter Address" cols="50" maxlength="220" class="form-control form-control-sm">{{ @$ownerdatas['Address 1'] ?? '' }}</textarea>
                  @error('address')
                  <span style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4" id="state_div">
                <div class="form-group">
                  <label for="state">State / राज्य<font color="red">*</font></label>
                  <select id="state" name="state" class="form-control form-control-sm call_district" data="district" cityid="city" style="width: 100%;">
                  <option value="">Please Select</option>
                    @foreach($states as $state)
                    <option value="{{$state['Code']}}" {{( @$ownerdatas['State'] === $state['Code'] ? 'selected' : '') }}>{{$state['Code']}} ~ {{$state['Description']}}</option>
                    @endforeach
                  </select>
                  @error('state')
                  <span style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="district">District / ज़िला<font color="red">*</font></label>
                  <select id="district" name="district" class="form-control form-control-sm">
                  <option value="">Please Select</option>
                    @if(@$ownerdatas['District'] !='')
                    @foreach($districts as $district)
                    <option value="{{$district['District']}}" {{ (@$ownerdatas['District'] === @$district['District'] ? 'selected' : '') }}>{{ $district['District'] }}</option>
                    @endforeach
                    @endif
                  </select>
                  @error('district')
                  <span style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="city">City / नगर<font color="red">*</font></label>
                  <select name="city" id="city" class="form-control form-control-sm">
                    <option value="">Please Select</option>
                    @if(@$ownerdatas['City'] != '')
                    @foreach($cities as $city)
                    <option value="{{$city['cityName']}}" {{ (@$ownerdatas['City'] === @$city['cityName'] ? 'selected' : '') }}>{{ $city['cityName'] }}</option>
                    @endforeach
                    @endif
                  </select>
                  @error('city')
                  <span style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="phone">Phone No. / फोन नंबर</label>
                  <input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Enter Phone No." onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$ownerdatas['Phone No_'] ?? '' }}">
                  <span id="alert_phone" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="pan_copy_file_name1">Owner’s PAN Number Self-Attested Copy (Only PDF) / पैन नंबर सेल्फ अटेस्टेड कॉपी (केवल पीडीएफ)<font color="red">*</font></label>
                  <div class="input-group">
                    @if( (@$vendordatas->{'PAN Copy File Name'} !='') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="pan_copy_file_name_modify" id="pan_copy_file_name_modify" accept="application/pdf">
                      <label class="custom-file-label" for="pan_copy_file_name_modify" id="pan_copy_file_name_modify2">{{ @$vendordatas->{'PAN Copy File Name'} ? $vendordatas->{'PAN Copy File Name'} : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="pan_copy_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="pan_copy_file_name" id="pan_copy_file_name" accept="application/pdf">
                      <label class="custom-file-label" for="pan_copy_file_name" id="pan_copy_file_name2">{{ @$vendordatas->{'PAN Copy File Name'} ? $vendordatas->{'PAN Copy File Name'} : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="pan_copy_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas->{'PAN Copy File Name'} != '')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas->{'PAN Copy File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="pan_copy_file_name1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-8"></div>
              <div class="col-md-12 text-right">
                <input type="hidden" name="ownerid" id="ownerid" value="{{ @$ownerdatas['Owner ID'] }}">
                <button type="submit" class="btn btn-primary submit-button btn-sm m-0" {{ (!session()->has('UserName') || empty($vendordatas))  ? 'disabled':'' }}><i class="fa fa-save"></i> Update</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.content-->
@endsection
@section('custom_js')
<script src="{{ url('/js/vendorPrintJs') }}/fresh-em-validation_ownerdetails.js"></script>
@endsection