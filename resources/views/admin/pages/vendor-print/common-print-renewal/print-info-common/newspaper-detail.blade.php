<div class="row">
  <div class="col-md-4">
    <?php
    $gst_readonly = '';
    if (!empty($np_rate_renewal) && @$np_rate_renewal->{'DM Declaration'} == 0) {
      //$gst_readonly = 'readonly';
    }

    ?>
    <div class="form-group">
      <label for="GST_No">GST No. / जीएसटी संख्या</label>
      <input type="text" class="form-control form-control-sm" name="GST_No" id="GST_No" placeholder="Enter GST No." maxlength="15" value="{{ !empty(trim(@$np_rate_renewal->{'GST No_'})) ? @$np_rate_renewal->{'GST No_'} : (@$vendor_datas->{'GST No_'} ? @$vendor_datas->{'GST No_'} : '') }}" {{$gst_readonly}} onchange="return checksum(this.value), checkGstUnique(this.value)" {{$renewal_readonly}}>
      <span class="gstvalidationMsg"></span>
      <span class="validcheck"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Circulation Base / परिसंचरण आधार <font color="red">*</font></label>
      <select name="cir_base" id="cir_base" class="form-control form-control-sm pointer css" style="width: 100%;" {{ @$read }}>
        <option value="">Select circulation base</option>
        <option value="0" {{ ( !empty(@$np_rate_renewal) && @$np_rate_renewal->{'CIR Base'} == 0 )  ? 'selected' : ((@$vendor_datas->{'CIR Base'} == 0 && @$vendor_datas->{'CIR Base'} != "")  ? 'selected' : '') }}>RNI</option>
        <option value="1" {{ @$np_rate_renewal->{'CIR Base'} == 1  ? 'selected' : (@$vendor_datas->{'CIR Base'} == 1  ? 'selected' : '') }}>CA</option>
        <option value="2" {{ @$np_rate_renewal->{'CIR Base'} == 2  ? 'selected' : (@$vendor_datas->{'CIR Base'} == 2  ? 'selected' : '') }}>PIB</option>
        <option value="3" {{ @$np_rate_renewal->{'CIR Base'} == 3  ? 'selected' : (@$vendor_datas->{'CIR Base'} == 3  ? 'selected' : '') }}>ABC</option>
      </select>
      <input type="hidden" name="date_verified_old" id="date_verified_old" value="{{ $date_verified }}">
    </div>
  </div>
  <div class="col-md-4" id="rni_regist_no" style="display: {{$rni_regist_no}};">
    <div class="form-group">
      <label for="rni_registration_no">RNI Registration No. / पंजीकरण संख्या <font color="red">*</font></label>
      <input type="text" name="rni_registration_no" maxlength="25" placeholder="Enter RNI Registration No." class="form-control  form-control-sm" onkeyup="return checkRegCIRBase(this.value)" id="rni_registration_no" value="{{ $reg_no }}" {{ @$read }}>
      <input type="hidden" name="rni_reg_no_verified" id="rni_reg_no_verified" value="{{ $reg_no_verified }}">
      <span id="rni_reg_no" style="color:green;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="abc-certificate" style="display: {{$abc_cert}};">
    <div class="form-group">
      <label for="abc_certificate_no">ABC Certificate No. / एबीसी प्रमाणपत्र संख्या <font color="red">*</font></label>
      <input type="text" name="abc_certificate_no" maxlength="15" placeholder="Enter ABC Certificate No." class="form-control form-control-sm" onchange="return checkRegCIRBase(this.value)" id="abc_certificate_no" value="{{ @$np_rate_renewal->{'ABC Certificate No_'} ?? $vendor_datas->{'ABC Number'} ?? ''}}" {{ @$read }}>
      <input type="hidden" name="abc_reg_no_verified" id="abc_reg_no_verified" value="{{ $abc_reg_no_verified }}">
      <span id="abc_cert_no" style="color:green;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="udin_number" style="display: {{$udin_number}};">
    <div class="form-group">
      <label for="ca_udin_number">UDIN No. / यूडीआईएन नं.<font color="red">*</font></label>
      <input type="text" name="ca_udin_number" maxlength="20" placeholder="Enter UDIN No." class="form-control form-control-sm" id="ca_udin_number" value="{{ $vendordatas['UDIN'] ?? ''}}" {{ $read }}>
      <span id="udin_cert_no" style="color:green;display: none;"></span>
    </div>
  </div>
</div>
<div class="row" >
  <div class="col-md-4" id="rni-efilling" style="display: {{$efiling}};" hidden>
    <div class="form-group">
      <label for="rni_efiling_no">RNI E-filing Number / आरएनआई ई-फाइलिंग नंबर</label>
      <input type="text" name="rni_efiling_no" maxlength="19" placeholder="Enter RNI E-filing Number" class="form-control  form-control-sm" id="rni_efiling_no" value="{{ @$rni_efiling_no}}" {{ @$turnover_verified != '0' && @$turnover_verified != '' ? @$read : '' }} {{ @$read }}>
      <input type="hidden" name="rni_annual_valid" id="rni_annual_valid" value="{{ $turnover_verified }}">
      <span id="rni_efill_no" style="color:green;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="newspaper_name">Newspaper Name / अखबार का नाम</label>
      <input type="text" name="newspaper_name" placeholder="Enter Newspaper Name"  class="form-control  form-control-sm" id="newspaper_name" onkeypress="return onlyAlphabets(event,this)" value="{{ @$np_rate_renewal->{'Newspaper Name'} ?? $vendor_datas->{'Newspaper Name'} ?? '' }}" {{ @$readonly }}>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="place_of_publication">Place of Publication / प्रकाशन का स्थान <font color="red">*</font></label>
      <input type="text" name="place_of_publication" maxlength="25" placeholder="Enter Place of Publication" class="form-control  form-control-sm" id="place_of_publication" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendor_datas->{'Place of Publication'} ?? '' }}" {{ @$read }}>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_email">E-mail ID(Vendor) / ई-मेल आईडी <font color="red">*</font></label>
      <input type="email" class="form-control  form-control-sm" maxlength="40" id="v_email" name="v_email" placeholder="Enter E-mail ID" value="{{ @$np_rate_renewal->{'E-mail ID'} !='' ? $np_rate_renewal->{'E-mail ID'} : @$vendor_datas->{'E-mail ID'} }}" onchange="checkUniqueEmailVendor('email', this.value)" {{$read}}>
      <span id="v_alert_email" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
      <input type="text" class="form-control  form-control-sm" id="v_mobile" name="v_mobile" placeholder="Enter Mobile No." onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{ @$np_rate_renewal->{'Mobile No'} ?? $vendor_datas->{'Mobile No_'} ?? '' }}" {{ @$read }}>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_address">Address / पता <font color="red">*</font></label>
      <textarea name="v_address" id="v_address" maxlength="220" placeholder="Enter Address" cols="50" class="form-control  form-control-sm" {{ $read }}>{{ @$np_rate_renewal->{'Address'} !='' ? $np_rate_renewal->{'Address'} : @$vendor_datas->{'Address'} }}</textarea>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_state">State / राज्य <font color="red">*</font></label>
      <select id="v_state" name="v_state" class="form-control form-control-sm call_district pointercss" data="v_district" style="width: 100%;" {{ @$readonly }}>
        <option value="">Please Select</option>
        @foreach($states as $state)
        <option value="{{$state['Code']}}" {{ (@$vendor_datas->{'State'} == $state['Code']  ? 'selected' : '') }}>{{$state['Code']}} ~ {{$state['Description']}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_district">District / ज़िला </label>
      <select id="v_district" name="v_district" class="form-control form-control-sm pointercss" {{ @$readonly }}>
        <option value="">Please Select</option>
        @if(@$vendor_datas->{'District'} != '')
        @foreach($districts as $district)
        <option value="{{$district['District']}}" {{ (@$vendor_datas->{'District'} === $district['District']  ? 'selected' : '') }}>{{ $district['District'] }}</option>
        @endforeach
        @endif
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_city">City / नगर </label>
      <select name="v_city" id="v_city" class="form-control form-control-sm pointercss" {{@$readonly}}>
        <option value="">Please Select</option>
        @if(@$vendor_datas->{'City'} != '')
        <option selected="selected">
          {{ $vendor_datas->{'City'} }}
        </option>
        @endif
      </select>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="pin_code">Pin Code / पिन कोड <font color="red">*</font></label>
      <input type="text" id="pin_code" name="pin_code" class="form-control  form-control-sm" placeholder="Enter Pin Code" onkeypress="return onlyNumberKey(event)" maxlength="6" value="{{ @$np_rate_renewal->{'Pin code'} ?? $vendor_datas->{'Pin ode'} ?? '' }}" {{ @$read }}>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_phone">Phone No. / फोन नंबर</label>
      <input type="text" class="form-control  form-control-sm" id="v_phone" name="v_phone" placeholder="Enter Phone No." onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$np_rate_renewal->{'Phone No'} != '' ? $np_rate_renewal->{'Phone No'} : @$vendor_datas->{'Phone No'} }}" {{ $read }}>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Language / भाषा <font color="red">*</font></label>
      <select name="language" id="language" class="form-control  form-control-sm pointercss" style="width: 100%;" {{ @$readonly }}>
        <option value="">Please Select</option>
        @foreach($languages as $language)
        <option value="{{$language['Code']}}" {{(@$vendor_datas->{'Language'} == $language['Code']) ? 'selected' :'' }}>{{$language['Code']}} ~ {{$language['Name']}}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="claimed_circulation">Claimed Circulation / दावा किया गया संचलन </label>
      <input type="text" name="claimed_circulation" maxlength="8" placeholder="Enter Claimed Circulation" class="form-control  form-control-sm" id="claimed_circulation" onkeypress="return onlyNumberKey(event)" onkeyup="return removezero(this.value),checkCirculation(this.value)" value="{{ $solid_circulation !=0 ? $solid_circulation : '' }}" {{ $read }}>
      <span id="alert_claimed_circulation" class="error invalid-feedback" style="display: none;"></span>
      <input type="hidden" name="claimed_circulation_verified" id="claimed_circulation_verified" value="{{ $solid_circulation_verified }}">
      <input type="hidden" name="claimed_circulation_hidden" id="claimed_circulation_hidden" value="{{ $solid_circulation_verified == 1 ? $solid_circulation : ''}}">
      <span id="rni_claimed_cirl" style="color:green;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label>Periodicity / अवधि</label>
      <select name="periodicity" id="periodicity" class="form-control form-control-sm pointercss" {{ @$readonly }}>
        <option value="" {{ @$vendor_datas->{'Periodicity'} == ""   ? 'selected' : ''}}>Please Select</option>
        <option value="0" {{ (@$vendor_datas->{'Periodicity'} == 0 && @$vendor_datas->{'Periodicity'} != "" ? 'selected' : '') }}>Daily(M)</option>
        <option value="1" {{ @$vendor_datas->{'Periodicity'} == 1  ? 'selected' : '' }}>Daily(E)</option>
        <option value="2" {{ @$vendor_datas->{'Periodicity'} == 2  ? 'selected' : '' }}>Daily Except Sunday</option>
        <option value="3" {{ @$vendor_datas->{'Periodicity'} == 3  ? 'selected' : '' }}>Bi-Weekly</option>
        <option value="4" {{ @$vendor_datas->{'Periodicity'} == 4  ? 'selected' : '' }}>Weekly</option>
        <option value="5" {{ @$vendor_datas->{'Periodicity'} == 5  ? 'selected' : '' }}>Fortnightly</option>
        <option value="6" {{ @$vendor_datas->{'Periodicity'} == 6  ? 'selected' : '' }}>Monthly</option>
      </select>
    </div>
  </div>
  @php
    $PageArea = '';
    if(@$np_rate_renewal != '' && @$np_rate_renewal->{'Page Area per page'} !=''){
    $PageArea = @$np_rate_renewal->{'Page Area per page'};
    }elseif(@$vendor_datas != '' && @$vendor_datas->{'Page Area per page'} !=''){
    $PageArea = @$vendor_datas->{'Page Area per page'};
    }
@endphp
  <div class="col-md-4">
    <div class="form-group">
      <label for="print_area">Print Area Per Page (in Sq. cms) /प्रति पृष्ठ प्रिंट क्षेत्र (वर्ग सेंटी.) </label>
      <input type="text" name="print_area" placeholder="Enter Print Area" maxlength="15" class="form-control  form-control-sm" id="print_area" onkeypress="return onlyNumberKey(event)" value="{{ $PageArea != '' ? rtrim(rtrim(sprintf('%f', floatval($PageArea)),0),'.') : ''}}
" {{ @$read }}>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    @php
    $length = '';
    if(@$np_rate_renewal != '' && @$np_rate_renewal->{'Length'} !=''){
    $length = @$np_rate_renewal->{'Length'};
    }elseif(@$vendor_datas != '' && @$vendor_datas->{'Page Length'} !=''){
    $length = @$vendor_datas->{'Page Length'};
    }
    @endphp
    <div class="form-group">
      <label for="page_length">Page Length (in Sq. cms) / पृष्ठ की लंबाई (वर्ग सेंटी.) <font color="red">*</font></label>
      <input type="text" name="page_length" placeholder="Enter Page Length" maxlength="4" class="form-control  form-control-sm" id="page_length" onkeypress="return isNumber(event,this)" value="{{ $length != '' ? rtrim(rtrim(sprintf('%f', floatval($length)),0),'.') : ''}}" {{ $read }}>
      <span id="alert_page_length" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    @php
    $width = '';
    if(@$np_rate_renewal != '' && @$np_rate_renewal->{'Breadth'} !=''){
    $width = @$np_rate_renewal->{'Breadth'};
    }elseif(@$vendor_datas != '' && @$vendor_datas->{'Page Width'} !=''){
    $width = @$vendor_datas->{'Page Width'};
    }
    @endphp
    <div class="form-group">
      <label for="page_width">Page Width (in Sq. cms) / पृष्ठ की चौड़ाई (वर्ग सेंटी.) <font color="red">*</font></label>
      <input type="text" name="page_width" placeholder="Enter Page Width" maxlength="4" class="form-control  form-control-sm" id="page_width" onkeypress="return isNumber(event,this)" value="{{ $width != '' ? rtrim(rtrim(sprintf('%f', floatval($width)),0),'.') : ''}}" {{ $read }}>
      <span id="alert_page_width" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="no_of_page">No. of Pages / पृष्ठों की संख्या <font color="red">*</font></label>
      <input type="text" name="no_of_page" placeholder="Enter No. Of Pages" maxlength="7" class="form-control form-control-sm" id="no_of_page" onkeypress="return onlyNumberKey(event)" value="{{ @$np_rate_renewal->{'No_ Of pages'} ?? $vendor_datas->{'No_ Of pages'} ?? '' }}" {{ $read }}>
      <span id="alert_no_of_page" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    @php
    $no_of_pages = @$vendor_datas->{'No_ Of pages'} !=0 ? @$vendor_datas->{'No_ Of pages'} : 1;
    $total_print_area = '';
    if(@$np_rate_renewal != '' && @$np_rate_renewal->{'Print Area'} !=''){
    $total_print_area = $length * $width * $no_of_pages;
    }elseif(@$vendor_datas != '' && @$vendor_datas->{'Total Print Area'} !=''){
    $total_print_area = $length * $width * $no_of_pages;
    }
    @endphp
    <div class="form-group">
      <label for="total_print_area">Total Print Area (in Sq. cms) / कुल प्रिंट क्षेत्र (वर्ग सेंटी.)</label>
      <input type="text" name="total_print_area" placeholder="Enter Total Print Area" maxlength="20" class="form-control  form-control-sm" id="total_print_area" onkeypress="return onlyNumberKey(event)" value="{{ $total_print_area != '' ? rtrim(rtrim(sprintf('%f', floatval($total_print_area)),0),'.') : '0'}}" {{ $readonly }}>
      <span id="alert_total_print_area" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
