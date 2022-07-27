<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="owner_name">Owner Name / मालिक का नाम<font color="red">*</font></label>
      <input type="text" class="form-control form-control-sm" id="name" name="owner_name" placeholder="Enter Owner Name" onkeypress="return onlyAlphabets(event,this)"  value="{{ @$payee_datas->{'Payee Name'} != '' ? $payee_datas->{'Payee Name'} : @$owner_datas->{'Owner Name'} }}" {{ $read }}>
      <input type="hidden" name="ownerid" id="ownerid" value="{{ @$owner_datas->{'Owner ID'} ??'' }}">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Owner Type / मालिक का प्रकार <font color="red">*</font></label>
      <select name="owner_type" id="owner_type" class="form-control form-control-sm pointer css" style="width: 100%;" {{$read}}>
        <option value="">Please Select</option>
        <option value="0" <?= (@$owner_datas->{'Owner Type'} == 0 && @$owner_datas->{'Owner Type'} != "" || @$payee_datas->{'Owner type'} == 0) ? 'selected' : '' ?>>Individual</option>
        <option value="1" <?= (@$owner_datas->{'Owner Type'} == 1 || @$payee_datas->{'Owner type'} == 1) ? 'selected' : '' ?>>Partnership</option>
        <option value="2" <?= (@$owner_datas->{'Owner Type'} == 2 || @$payee_datas->{'Owner type'} == 2) ? 'selected' : '' ?>>Trust</option>
        <option value="3" <?= (@$owner_datas->{'Owner Type'} == 3 || @$payee_datas->{'Owner type'} == 3) ? 'selected' : '' ?>>Society</option>
        <option value="4" <?= (@$owner_datas->{'Owner Type'} == 4 || @$payee_datas->{'Owner type'} == 4) ? 'selected' : '' ?>>Proprietorship</option>
        <option value="5" <?= (@$owner_datas->{'Owner Type'} == 5 || @$payee_datas->{'Owner type'} == 5) ? 'selected' : '' ?>>Public Ltd</option>
        <option value="6" <?= (@$owner_datas->{'Owner Type'} == 6 || @$payee_datas->{'Owner type'} == 6) ? 'selected' : '' ?>>Pvt Ltd</option>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="email">E-mail ID(Owner) / ई-मेल आईडी <font color="red">*</font></label>
      <input type="email" class="form-control form-control-sm" id="email" name="email" maxlength="50" placeholder="Enter E-mail ID" value="{{ @$payee_datas->{'Owner email'} != '' ? $payee_datas->{'Owner email'} : @$owner_datas->{'Email ID'} }}" {{ $read }}>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label> 
      <input type="text" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="Enter Mobile No." onkeypress="return onlyNumberKey(event)"  maxlength="10" value="{{@$payee_datas->{'Owner mobile'} != '' ? $payee_datas->{'Owner mobile'}:@$owner_datas->{'Mobile No_'} }}" {{ @$read }}>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="address">Address / पता <font color="red">*</font></label>
      <textarea name="address" id="address" placeholder="Enter Address" cols="50" maxlength="220" class="form-control form-control-sm" {{ @$read }}>{{@$payee_datas->{'Owner address'} != '' ?$payee_datas->{'Owner address'}:@$owner_datas->{'Address 1'} }}</textarea>
    </div>
  </div>
  <div class="col-md-4" id="state_div">
    <div class="form-group">
      <label for="state">State / राज्य</label>
      <select id="state" name="state" class="form-control form-control-sm call_district pointercss" data="district" style="width: 100%;" {{ @$readonly }}>
        <option value="" {{@$owner_datas->{'State'} == ""  ? 'selected' : ''}}>Please Select</option>
        @foreach($states as $state)
        <option value="{{$state['Code']}}" {{ (@$owner_datas->{'State'} === $state['Code'])  ? 'selected' : '' }}>{{$state['Code']}} ~ {{$state['Description']}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="district">District / ज़िला</label>
      <select id="district" name="district" class="form-control form-control-sm pointercss" {{ @$readonly }}>
        <option value="" {{@$owner_datas->{'District'} == ""  ? 'selected' : ''}}>Please Select</option>
        @if(@$owner_datas->{'District'} != '')
        @foreach($districts as $district)
        <option value="{{$district['District']}}" {{ (@$owner_datas->{'District'} == $district['District']  ?  'selected' : '') }}>{{ $district['District'] }}</option>
        @endforeach
        @endif
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="city">City / नगर</label>
      <select name="city" id="city" class="form-control form-control-sm pointercss" {{@$readonly}}>
        <option value="">Please Select</option>
        @if(@$owner_datas->{'City'} != '')
        <option selected="selected">
          {{ $owner_datas->{'City'} }}
        </option>
        @endif
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="phone">Phone No. / फोन नंबर</label>
      <input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Enter Phone No." onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$owner_datas->{'Phone No_'} ?? '' }}" {{ @$readonly }}>
    </div>
  </div>
  <!-- <div class="col-md-4">
    <div class="form-group">
      <label for="fax_no">Fax / फैक्स </label>
      <input type="text" class="form-control form-control-sm" id="fax" name="fax_no" placeholder="Enter Fax" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$owner_datas->{'Fax No_'} ?? '' }}" {{ @$readonly }}>
    </div>
  </div> -->
</div>
<div class="col-sm-12 text-right" style="padding: 0;">
<input type="hidden" name="next_tab_1" id="next_tab_1" value="0">
<a class="btn btn-primary next-button btn-sm m-0" id="tab_1">Next <i class="fa fa-caret-right"></i></a>
</div>
