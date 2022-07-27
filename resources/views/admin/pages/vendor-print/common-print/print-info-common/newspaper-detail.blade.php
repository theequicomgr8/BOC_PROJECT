<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="newspaper_name">Newspaper Name / अखबार का नाम<font color="red">*</font></label>
      <input type="text" name="newspaper_name" placeholder="Enter Newspaper Name" maxlength="40" class="form-control  form-control-sm" id="newspaper_name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Newspaper Name'] ?? '' }}" {{$disabledall}}>
      <span id="alert_newspaper_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="place_of_publication">Place of Publication / प्रकाशन का स्थान<font color="red">*</font></label>
      <input type="text" name="place_of_publication" maxlength="25" placeholder="Enter Place of Publication" class="form-control  form-control-sm" id="place_of_publication" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Place of Publication'] ?? '' }}" {{$disabledall}}>
      <span id="alert_place_of_publication" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"> 
    <div class="form-group">
      <label for="v_email">E-mail ID(Vendor) / ई-मेल आईडी<font color="red">*</font></label>
      <input type="email" class="form-control  form-control-sm" maxlength="40" id="v_email" name="v_email" placeholder="Enter E-mail ID" value="{{ $vendordatas['E-mail ID'] ?? session('email') }}" onchange="return checkUniqueVendor('email', this.value)" {{$disabledall}}>
      <input type="hidden" name="vendor_v_email" id="vendor_email" value="{{ $vendordatas['E-mail ID'] ?? '' }}">
      <span id="v_alert_email" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
      <input type="text" class="form-control  form-control-sm" id="v_mobile" name="v_mobile" placeholder="Enter Mobile No." onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{ $vendordatas['Mobile No_'] ?? '' }}" onchange="return checkUniqueVendor('mobile', this.value)" {{$disabledall}}>
      <input type="hidden" name="vendor_v_mobile" id="vendor_mobile" value="{{ $vendordatas['Mobile No_'] ?? '' }}">
      <span id="v_alert_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_address">Address / पता<font color="red">*</font></label>
      <textarea name="v_address" id="v_address" maxlength="220" placeholder="Enter Address" cols="50" class="form-control  form-control-sm" {{$disabledall}}>{{ $vendordatas['Address'] ?? '' }}</textarea>
      <span id="v_alert_address" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="v_state_div">
    <div class="form-group">
      <label for="v_state">State / राज्य<font color="red">*</font></label>
      <select id="v_state" name="v_state" class="form-control  form-control-sm call_district" data="v_district" cityid="v_city" style="width: 100%;" {{$disabledall}}>
        <option value="">Select State</option>
        @foreach($states as $state)
        <option value="{{$state['Code']}}" {{( @$vendordatas['State'] === $state['Code'] ? 'selected' : '') }}>{{$state['Code']}} ~ {{$state['Description']}}</option>
        @endforeach
      </select>
      <span id="v_alert_state" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_district">District / ज़िला<font color="red">*</font></label>
      <select id="v_district" name="v_district" class="form-control  form-control-sm" {{$disabledall}}>
        <option value="">Please Select</option>
        @if(@$vendordatas['District'] != '')
        @foreach($vendor_districts as $district)
        <option value="{{$district['District']}}" {{ (@$vendordatas['District'] == $district['District'] ? 'selected' :'') }}>{{ $district['District'] }}</option>
        @endforeach
        @endif
      </select>
      <span id="v_alert_district" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_city">City / नगर<font color="red">*</font></label>
      <select name="v_city" id="v_city" class="form-control form-control-sm" {{@$disabledall}}>
        <option value="">Please Select</option>
        @if(@$vendordatas['City'] != '')
        <option selected="selected">
          {{$vendordatas['City']}}
        </option>
        @endif
      </select>
      <span id="v_alert_city" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="pin_code">Pin Code / पिन कोड<font color="red">*</font></label>
      <input type="text" id="pin_code" name="pin_code" class="form-control  form-control-sm" placeholder="Enter Pin Code" onkeypress="return onlyNumberKey(event)" maxlength="6" value="{{ $vendordatas['Pin Code'] ?? '' }}" {{$disabledall}}>
      <span id="v_alert_pin_code" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="v_phone">Phone No. / फोन नंबर</label>
      <input type="text" class="form-control  form-control-sm" id="v_phone" name="v_phone" placeholder="Enter Phone No." onkeypress="return onlyNumberKey(event)" minlength="10" maxlength="15" value="{{ $vendordatas['Phone No'] ?? '' }}" {{$disabledall}}>
      <span id="v_alert_phone" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="language_div">
    <div class="form-group">
      <label>Language / भाषा<font color="red">*</font></label>
      <select name="language" id="language" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}}>
        <option value="">Select language</option>
        @foreach($languages as $language)
        <option value="{{$language['Code']}}" {{( @$vendordatas['Language'] == $language['Code'] ? 'selected' :'') }}>{{$language['Code']}} ~ {{$language['Name']}}</option>
        @endforeach
      </select>
      <span id="alert_language" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="periodicity_div">
    <div class="form-group">
      <label>Periodicity / अवधि<font color="red">*</font></label>
      <select name="periodicity" id="periodicity" class="form-control  form-control-sm" {{$disabledall}} onchange="funPeriodicity(this.value)">
        <option value="">Select Periodicity</option> 
        <option value="0" {{ @$vendordatas['Periodicity'] == 0  ? 'selected' : '' }} >Daily(M)</option>
        <option value="1" {{ @$vendordatas['Periodicity'] == 1  ? 'selected' : '' }}>Daily(E)</option>
        <option value="2" {{ @$vendordatas['Periodicity'] == 2  ? 'selected' : '' }}>Daily Except Sunday</option>
        <option value="3" {{ @$vendordatas['Periodicity'] == 3  ? 'selected' : '' }}>Bi-Weekly</option>
        <option value="4" {{ @$vendordatas['Periodicity'] == 4  ? 'selected' : '' }}>Weekly</option>
        <option value="5" {{ @$vendordatas['Periodicity'] == 5  ? 'selected' : '' }}>Fortnightly</option>
        <option value="6" {{ @$vendordatas['Periodicity'] == 6  ? 'selected' : '' }}>Monthly</option>
      </select>
      <span id="alert_periodicity" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="page_length">Page Length (in Sq. cms) / पृष्ठ की लंबाई (वर्ग सेमी.)<font color="red">*</font></label>
      <input type="text" name="page_length" placeholder="Enter Page Length" maxlength="4" class="form-control  form-control-sm" id="page_length" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Page Length'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Length'])),0),'.') : '') }}" {{$disabledall}}>
      <span id="alert_page_length" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"> 
    <div class="form-group">
      <label for="page_width">Page Width (in Sq. cms) / पृष्ठ की चौड़ाई (वर्ग सेमी.)<font color="red">*</font></label>
      <input type="text" name="page_width" placeholder="Enter Page Width" maxlength="4" class="form-control  form-control-sm" id="page_width" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Page Width'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Width'])),0),'.') : '') }}" {{$disabledall}}>
      <span id="alert_page_width" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="no_of_page">No. of Pages / पृष्ठों की संख्या<font color="red">*</font></label>
      <input type="text" name="no_of_page" placeholder="Enter No. of Pages" maxlength="4" class="form-control  form-control-sm" id="no_of_page" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['No_ Of pages'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['No_ Of pages'])),0),'.') : '') }}" {{$disabledall}}>
      <span id="alert_no_of_page" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="print_area">Print Area Per Page (in Sq. cms) /प्रति पृष्ठ प्रिंट क्षेत्र (वर्ग सेमी.)</label>
      <input type="text" name="print_area" placeholder="Enter Print Area" maxlength="20" class="form-control  form-control-sm" id="print_area" onchange="return printArea(this.value)" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Page Area per page'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Area per page'])),0),'.') : '') }}" {{$disabledall}}>
      <span id="alert_print_area" class="error invalid-feedback" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="total_print_area">Total Print Area (in Sq. cms) / कुल प्रिंट क्षेत्र (वर्ग सेमी.)</label>
      <input type="text" name="total_print_area" placeholder="Enter Total Print Area" maxlength="20" class="form-control  form-control-sm" id="total_print_area" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Total Print Area'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Total Print Area'])),0),'.') : '') }}" readonly>
      <span id="alert_total_print_area" style="color:red;display: none;"></span>
    </div>
  </div>
</div><br>