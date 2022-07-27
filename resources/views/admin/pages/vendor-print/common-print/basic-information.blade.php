<div class="row">
  <div class="col-md-4">
    <div class="form-group clearfix">
      <label for="exist_owner">Applying for First Time / पहली बार आवेदन करना<font color="red">*</font></label><br>
      <div class="icheck-primary d-inline">
        <input type="radio" id="exist_owner2" name="exist_owner" onclick="existOwner(this.value)" value="0" {{$check1}} {{$disabledall}}>
        <label for="exist_owner2"> Fresh User / नया उपयोगकर्ता</label>
      </div>&nbsp;&nbsp;
      <div class="icheck-primary d-inline">
        <input type="radio" id="exist_owner1" name="exist_owner" onclick="existOwner(this.value)" value="1" {{$check2}} {{$disabledall}}>
        <label for="exist_owner1"> Existing User / मौजूदा उपयोगकर्ता </label>
      </div>
    </div>
    <span id="alert_exist_owner" style="color:red;display: none;"></span>
  </div>
  <div class="col-md-4" id="exist_owner_ids" style="display:{{$check2 ? 'block' : 'none'}}">
    <div class="form-group">
      <label for="exist_owner_id">Group Code / समूह कोड<font color="red">*</font></label>
      <input type="text" class="form-control form-control-sm" id="exist_owner_id" name="exist_owner_id" placeholder="Enter Group Code" onkeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{ @$ownerdatas['Owner ID'] ?? '' }}" maxlength="20" {{$disabledall}} {{$readonlyvendor}} {{$readonlyowner}}>
      <span id="alert_exist_owner_id" class="error invalid-feedback" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="GST_No">GST No. / जीएसटी संख्या<font color="red"></font></label>
      <input type="text" class="form-control form-control-sm" name="GST_No" id="GST_No" placeholder="Enter GST No." onkeypress="return isAlphaNumeric(event)" onchange="return checksum(this.value), checkGstUnique(this.value)" maxlength="15" value="{{ $vendordatas['GST No_'] ?? ''}}" {{$disabledall}}>
      <span class="gstvalidationMsg"></span>
      <span class="validcheck"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="owner_name">Owner Name / मालिक का नाम</label>
      <input type="text" class="form-control form-control-sm" id="name" name="owner_name" placeholder="Enter Owner Name" onkeypress="return onlyAlphabets(event,this)" maxlength="80" value="{{ @$ownerdatas['Owner Name'] ?? '' }}" {{$disabledall}}>
      <span id="alert_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="email">E-mail ID(Owner) / ई-मेल आईडी<font color="red">*</font></label>
      <input type="email" class="form-control form-control-sm" id="email" name="email" maxlength="50" placeholder="Enter E-mail ID" value="{{ @$ownerdatas['Email ID'] ?? '' }}" onchange="return checkUniqueOwner('email', this.value)" {{$disabledall}} {{$readonlyvendor}} {{$readonlyowner}}>
      <span id="alert_email" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
      <input type="text" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="Enter Mobile No." onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{ @$ownerdatas['Mobile No_'] ?? '' }}" onchange="return checkUniqueOwner('mobile', this.value)" {{$disabledall}} {{$readonlyvendor}} {{$readonlyowner}}>
      <input type="hidden" name="ownermobilecheck" id="ownermobilecheck" value="{{ @$ownerdatas['Mobile No_'] ?? '' }}">
      <span id="alert_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Owner Type / मालिक का प्रकार<font color="red">*</font></label>
      <select name="owner_type" id="owner_type" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}} {{$readonlyowner}} style="pointer-events: {{@$pointer}};">
        <option value="">Please Select</option>
        <option value="0" <?= (!empty($ownerdatas) && @$ownerdatas['Owner Type'] == 0 && @$ownerdatas['Owner Type'] != "") ? 'selected' : '' ?>>Individual</option>
        <option value="1" <?= (@$ownerdatas['Owner Type'] == 1) ? 'selected' : '' ?>>Partnership</option>
        <option value="2" <?= (@$ownerdatas['Owner Type'] == 2) ? 'selected' : '' ?>>Trust</option>
        <option value="3" <?= (@$ownerdatas['Owner Type'] == 3) ? 'selected' : '' ?>>Society</option>
        <option value="4" <?= (@$ownerdatas['Owner Type'] == 4) ? 'selected' : '' ?>>Proprietorship</option>
        <option value="5" <?= (@$ownerdatas['Owner Type'] == 5) ? 'selected' : '' ?>>Public Ltd</option>
        <option value="6" <?= (@$ownerdatas['Owner Type'] == 6) ? 'selected' : '' ?>>Pvt Ltd</option>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="address">Address / पता<font color="red">*</font></label>
      <textarea name="address" id="address" placeholder="Enter Address" cols="50" maxlength="220" class="form-control form-control-sm" {{$disabledall}} {{$readonlyowner}}>{{ @$ownerdatas['Address 1'] ?? '' }}</textarea>
      <span id="alert_address" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="state_div">
    <div class="form-group">
      <label for="state">State / राज्य<font color="red">*</font></label>
      <select id="state" name="state" class="form-control form-control-sm call_district" data="district" cityid="city" style="width: 100%;" {{$disabledall}} {{$readonlyowner}} style="pointer-events: {{@$pointer}};">
        <option value="">Please Select</option>
        @foreach($states as $state)
        <option value="{{$state['Code']}}" {{( @$ownerdatas['State'] === $state['Code'] ? 'selected' : '') }}>{{$state['Code']}} ~ {{$state['Description']}}</option>
        @endforeach
      </select>
      <span id="alert_state" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="district">District / ज़िला<font color="red">*</font></label>
      <select id="district" name="district" class="form-control form-control-sm" {{$disabledall}} {{$readonlyowner}} style="pointer-events: {{@$pointer}};">
        <option value="">Please Select</option>
        @if(@$ownerdatas['District'] !='')
        @foreach($owner_districts as $district)
        <option value="{{$district['District']}}" {{ (@$ownerdatas['District'] === @$district['District'] ? 'selected' : '') }}>{{ $district['District'] }}</option>
        @endforeach
        @endif
      </select>
      <span id="alert_district" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="city">City / नगर<font color="red">*</font></label>
      <select name="city" id="city" class="form-control form-control-sm" {{@$disabledall}} {{@$readonlyowner}} style="pointer-events: {{@$pointer}};">
        <option value="">Please Select</option>
        @if(@$ownerdatas['City'] != '')
        <option selected="selected">
          {{$ownerdatas['City']}}
        </option>
        @endif
      </select>
      <span id="alert_city" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="phone">Phone No. / फोन नंबर</label>
      <input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Enter Phone No." onkeypress="return onlyNumberKey(event)" minlength="10" maxlength="15" value="{{ @$ownerdatas['Phone No_'] ?? '' }}" {{$disabledall}} {{$readonlyowner}}>
      <span id="alert_phone" style="color:red;display: none;"></span>
    </div>
  </div>
  <!-- <div class="col-md-4">
    <div class="form-group">
      <label for="fax_no">Fax / फैक्स </label>
      <input type="text" class="form-control form-control-sm" id="fax" name="fax_no" placeholder="Enter Fax" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$ownerdatas['Fax No_'] ?? '' }}" {{$disabledall}} {{$readonlyowner}}>
      <span id="alert_fax" style="color:red;display: none;"></span>
    </div>
  </div> -->
  <div class="col-md-4">
    <div class="form-group">
      <label>Circulation Base / प्रसार बेस<font color="red">*</font></label>
      <select name="cir_base" id="cir_base" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}}>
        <option value="">Select Circulation Base</option>
        <option value="0" <?= (@$vendordatas['CIR Base'] == 0 && @$vendordatas['CIR Base'] != "") ? 'selected' : '' ?>>RNI</option>
        <option value="1" <?= (@$vendordatas['CIR Base'] == 1 ? 'selected' : '') ?>>CA</option>
        <option value="2" <?= (@$vendordatas['CIR Base'] == 2 ? 'selected' : '') ?>>PIB</option>
        <option value="3" <?= (@$vendordatas['CIR Base'] == 3 ? 'selected' : '') ?>>ABC</option>
      </select>
      <input type="hidden" name="cir_base_old" id="cir_base_old" value="{{ @$vendordatas['CIR Base'] ?? '' }}">
      <input type="hidden" name="date_verified_old" id="date_verified_old" value="{{ date('Y-m-d', strtotime($date_verified)) }}">
      <span id="alert_cir_base" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="rni_regist_no" style="display: {{$rni_regist_no}};">
    <div class="form-group">
      <label for="rni_registration_no">RNI Registration No. / पंजीकरण संख्या<font color="red">*</font></label>
      <input type="text" name="rni_registration_no" maxlength="17" placeholder="Enter RNI Registration No." class="form-control form-control-sm" onkeyup="return checkRegCIRBase(this.value)" id="rni_registration_no" value="{{ $reg_no }}" {{$disabledall}}>
      <input type="hidden" name="rni_reg_no_verified" id="rni_reg_no_verified" value="{{ $reg_no_verified }}">
      <span id="alert_rni_registration_no" style="color:red;display: none;"></span>
      <span id="rni_reg_no" style="color:green;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="abc-certificate" style="display: {{$abc_cert}};">
    <div class="form-group">
      <label for="abc_certificate_no">ABC Certificate No. / एबीसी प्रमाणपत्र संख्या<font color="red">*</font></label>
      <input type="text" name="abc_certificate_no" maxlength="15" placeholder="Enter ABC Certificate No." class="form-control form-control-sm" onkeyup="return checkRegCIRBase(this.value)" id="abc_certificate_no" value="{{ $vendordatas['ABC Number'] ?? ''}}" {{ $disabledall }}>
      <input type="hidden" name="abc_reg_no_verified" id="abc_reg_no_verified" value="{{ $abc_reg_no_verified }}">
      <span id="abc_cert_no" style="color:green;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="udin_number" style="display: {{$udin_number}};">
    <div class="form-group">
      <label for="ca_udin_number">UDIN No. / यूडीआईएन नं.<font color="red">*</font></label>
      <input type="text" name="ca_udin_number" maxlength="20" placeholder="Enter UDIN No." class="form-control form-control-sm" id="ca_udin_number" value="{{ $vendordatas['UDIN'] ?? ''}}" {{ $disabledall }}>
      <span id="udin_cert_no" style="color:green;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="rni-efilling" style="display: {{$efiling}};">
    <div class="form-group">
      <label for="rni_efiling_no">RNI E-filing Number / आरएनआई ई-फाइलिंग नंबर</label>
      <input type="text" name="rni_efiling_no" maxlength="15" placeholder="Enter RNI E-filing Number" class="form-control  form-control-sm" id="rni_efiling_no" value="{{ $vendordatas['RNI E-filling No_'] ?? '' }}" {{ @$readonlyvalid }} {{$disabledall}}>
      <input type="hidden" name="rni_annual_valid" id="rni_annual_valid" value="{{ $turnover_verified }}">
      <span id="rni_efill_no" style="color:green;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="claimed_circulation">Claimed Circulation / दावा प्रसार संचलन <font color="red">*</font></label>
      <input type="text" name="claimed_circulation" maxlength="8" placeholder="Enter Claimed Circulation" class="form-control  form-control-sm" id="claimed_circulation" onkeyup="return checkCirculation(this.value)" onkeypress="return onlyNumberKey(event)" value="{{ $solid_circulation }}" {{$disabledall}}>
      <span id="alert_claimed_circulation" class="error invalid-feedback" style="display: none;"></span>
      <input type="hidden" name="claimed_circulation_verified" id="claimed_circulation_verified" value="{{ $solid_circulation_verified }}">
      <input type="hidden" name="claimed_circulation_hidden" id="claimed_circulation_hidden">
      <span id="rni_claimed_cirl" style="color:green;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="average_circulation_copies">Average Circulation Copies / औसत संचलन प्रतियां <font color="red">*</font></label>
      <input type="text" name="average_circulation_copies" maxlength="18" value="{{ $vendordatas['Average Circulation Copies'] ?? '' }}" placeholder="Enter Average Circulation Copies" class="form-control  form-control-sm" id="average_circulation_copies" onkeypress="return onlyNumberKey(event)" {{$disabledall}}>
    </div>
  </div>
  <?php
  // if (@count($ownerotherdata) >= 1 && $ownerotherdata != '') {
  //   $count = count($ownerotherdata) - 1;
  //   $firstpublicationdate = $ownerotherdata[$count]['Date Of First Publication'];
  // }
  ?>

  <div class="col-md-4">
    <div class="form-group">
      <label for="date_of_first_publication">First Date of Publication (for Current Edition) / प्रकाशन की पहली तिथि (वर्तमान संस्करण के लिए) <font color="red">*</font></label>
      <input type="date" name="date_of_first_publication" class="form-control  form-control-sm" id="date_of_first_publication" max="{{date('Y-m-d')}}" value="{{ (@$vendordatas['Date Of First Publication'] !='1753-01-01 00:00:00.000' && $vendordatas != null) ? date('Y-m-d', strtotime(@$vendordatas['Date Of First Publication'] )) : '' }}" {{$disabledall}}>
      <input type="hidden" id="firstpublicationdate" name="firstpublicationdate" value="">
      <span id="dateoffirstpublication" class="error invalid-feedback"></span>
    </div>
  </div>
</div>
<div class="col-sm-12 text-right" style="padding: 0;">
  <input type="hidden" name="owner_input_clean" id="owner_input_clean">
  <input type="hidden" name="ownerid" id="ownerid" value="{{ @$ownerdatas['Owner ID'] }}" {{$disabledall}}>
  <input type="hidden" name="Modification" id="Modification" value="{{ $vendordatas['Modification'] ?? ''}}">
  <input type="hidden" name="next_tab_1" id="next_tab_1" value="0" {{$disabledall}}>
  <a class="btn btn-primary next-button btn-sm m-0" id="tab_1">Next <i class="fa fa-caret-right"></i></a>
</div>
