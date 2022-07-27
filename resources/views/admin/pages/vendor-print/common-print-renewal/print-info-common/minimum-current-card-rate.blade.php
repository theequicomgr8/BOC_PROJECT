<h4 class="subheading">Minimum Current Card Rate/न्यूनतम वर्तमान कार्ड दर</h4>
<div class="row">
@php
    $black = '';
    if(@$np_rate_renewal != '' && @$np_rate_renewal->{'Minimum Current Card Rate(B_W)'} !=''){
    $black = @$np_rate_renewal->{'Minimum Current Card Rate(B_W)'};
    }elseif(@$vendor_datas != '' && @$vendor_datas->{'Minimum Current Card Rate(B_W)'} !=''){
    $black = @$vendor_datas->{'Minimum Current Card Rate(B_W)'};
    }
    @endphp
  <div class="col-md-4">
    <div class="form-group">
      <label for="black_white">Black & White (Rs per Sq. cms) / ब्लैक एंड व्हाइट (रुपये प्रति वर्ग सेंटी.)</label>
      <input type="text" name="black_white" maxlength="15" placeholder="Enter Black & White" class="form-control form-control-sm" id="black_white" onkeypress="return onlyNumberKey(event)" value="{{$black != '' ? rtrim(rtrim(sprintf('%f', floatval($black)),0),'.') : ''}}" {{ @$read }}>
      <span id="alert_black_white" style="color:red;display: none;"></span>
    </div>
  </div>
  @php
    $color = '';
    if(@$np_rate_renewal != '' && @$np_rate_renewal->{'Minimum Current Card Rate(c)'} !=''){
    $color = @$np_rate_renewal->{'Minimum Current Card Rate(c)'};
    }elseif(@$vendor_datas != '' && @$vendor_datas->{'Minimum Current Card Rate(c)'} !=''){
    $color = @$vendor_datas->{'Minimum Current Card Rate(c)'};
    }
    @endphp
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="colour">Color (Rs per Sq. cms) / रंग (रुपये प्रति वर्ग सेंटी.)</label>
      <input type="text" name="colour" placeholder="Enter Color" maxlength="15" class="form-control form-control-sm" id="colour" onkeypress="return onlyNumberKey(event)" value="{{$color != '' ? rtrim(rtrim(sprintf('%f', floatval($color)),0),'.') : ''}}" {{ @$read }}>
      <span id="alert_colour" style="color:red;display: none;"></span>
    </div>
  </div>
  @php
    $priceNewspaper = '';
    if(@$np_rate_renewal != '' && @$np_rate_renewal->{'Price of NewsPaper'} !=''){
    $priceNewspaper = @$np_rate_renewal->{'Price of NewsPaper'};
    }elseif(@$vendor_datas != '' && @$vendor_datas->{'Price of NewsPaper'} !=''){
    $priceNewspaper = @$vendor_datas->{'Price of NewsPaper'};
    }
    @endphp
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="price_newspaper">Price of Newspaper (Rs) / अखबार की कीमत (रु)<font color="red">*</font></label>
      <input type="text" name="price_newspaper" maxlength="15" placeholder="Enter Price of Newspaper" class="form-control form-control-sm" id="price_newspaper" onkeypress="return isNumber(event,this)" value="{{$priceNewspaper != '' ? rtrim(rtrim(sprintf('%f', floatval($priceNewspaper)),0),'.') : ''}}" {{ @$read }}>
      <span id="alert_price_newspaper" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-4">
    <div class="form-group clearfix">
      <label for="quality_paper_used">Quality of Paper Used / प्रयुक्त कागज की गुणवत्ता<font color="red">*</font></label><br>
      <div class="icheck-primary d-inline">
        <input type="radio" id="radioPrimary1" name="quality_paper_used" value="0" {{(@$np_rate_renewal->{'Quality of Paper'} == "0")  ? 'checked' : (@$vendor_datas->{'Quality of Paper'} == "0" ? 'checked' : '') }} {{ $read }}>
        <label for="radioPrimary1">Standard Newspaper / मानक समाचार पत्र </label>
      </div><br>
      <div class="icheck-primary d-inline">
        <input type="radio" id="radioPrimary2" name="quality_paper_used" value="1" {{(@$np_rate_renewal->{'Quality of Paper'} == "1")  ? 'checked' : (@$vendor_datas->{'Quality of Paper'} == "1" ? 'checked' : '') }} {{ $read }}>
        <label for="radioPrimary2">Glazed / चमकता हुआ </label>
      </div>
      <div class="icheck-primary d-inline">
        <input type="radio" id="radioPrimary3" name="quality_paper_used" value="2" {{(@$np_rate_renewal->{'Quality of Paper'} == "2")  ? 'checked' : (@$vendor_datas->{'Quality of Paper'} == "2" ? 'checked' : '') }} {{ $read }}>
        <label for="radioPrimary3">Ordinary / साधारण </label>
      </div>

    </div>
    <span id="alert_quality_paper_used" style="color:red;display: none;"></span>
  </div>
  <div class="col-md-4" >
    <div class="form-group">
      <label>Printing in Color / रंग में मुद्रण <font color="red">*</font></label>
      <select name="printing_colour" id="printing_colour" class="form-control form-control-sm" style="width: 100%; pointer-events: {{$read}};" {{ $read }} >
        <option value="">Please Select</option>
        <option value="0" {{(@$np_rate_renewal->{'Color'} == "0")  ? 'selected' : (@$vendor_datas->{'Printing in colour'} == "0" ? 'selected' : '') }}>Color</option>
        <option value="1" {{ (@$np_rate_renewal->{'Color'} == "1") ? "selected" : (@$vendor_datas->{'Printing in colour'} == "1" ? "selected" : '') }}>B/W</option>
      </select>
      <span id="alert_printing_colour" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    @php
    $display = 'none';
    if(@$np_rate_renewal->{'Printing in color'} == "0"){
    $display = 'block';
    } else if(empty(@$np_rate_renewal) && @$vendor_datas->{'Printing in colour'} == "0"){
    $display = 'block';
    }
    @endphp
    <div class="form-group" id="colour_page" style="display:{{ @$display }}">
      <label for="colour_pages">How Many Pages in Color / कितने पृष्ठ रंगीन है</label>
      <input type="text" name="colour_pages" maxlength="8" placeholder="Enter Pages in Color" class="form-control  form-control-sm" id="colour_pages" onkeypress="return onlyNumberKey(event)" value="{{ @$np_rate_renewal->{'No_ of pages in colour'} ?? @$vendor_datas->{'No_ of pages in colour'} }}" {{ $read }}>
      <span id="alert_colour_pages" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>News Agencies Subscribed to / समाचार एजेंसियों ने सदस्यता ली<font color="red">*</font></label>
      <select name="news_agencies_subscribed" id="news_agencies_subscribed" class="form-control  form-control-sm pointer css" style="width: 100%;" {{ @$read }}>
        <option value="">Select Any One</option>
        <option value="0" <?= (@$vendor_datas->{'News Agencies Subscribed To'} == 0 || @$np_rate_renewal->{'News Agencies Subscribed To'} == 0 && @$vendor_datas->{'Newspaper Name'} != '' ? 'selected' : ''); ?>>PTI</option>
        <option value="1" <?= (@$vendor_datas->{'News Agencies Subscribed To'} == 1 || @$np_rate_renewal->{'News Agencies Subscribed To'} ==1  ? 'selected' : ''); ?>>ANI</option>
        <option value="2" <?= (@$vendor_datas->{'News Agencies Subscribed To'} == 2 || @$np_rate_renewal->{'News Agencies Subscribed To'} == 2  ? 'selected' : ''); ?>>UNI</option>
        <option value="3" <?= (@$vendor_datas->{'News Agencies Subscribed To'} == 3 || @$np_rate_renewal->{'News Agencies Subscribed To'} == 3 ? 'selected' : ''); ?>>VAARTA</option>
        <option value="4" <?= (@$vendor_datas->{'News Agencies Subscribed To'} == 4 || @$np_rate_renewal->{'News Agencies Subscribed To'} == 4 ? 'selected' : ''); ?>>BHASHA</option>
        <option value="5" <?= (@$vendor_datas->{'News Agencies Subscribed To'} == 5 || @$np_rate_renewal->{'News Agencies Subscribed To'} == 5 ? 'selected' : ''); ?>>IANS</option>
        <option value="6" <?= (@$vendor_datas->{'News Agencies Subscribed To'} == 6 || @$np_rate_renewal->{'News Agencies Subscribed To'} == 6 ? 'selected' : ''); ?>>WEB VAARTA</option>
        <option value="7" <?= (@$vendor_datas->{'News Agencies Subscribed To'} == 7 ||  @$np_rate_renewal->{'News Agencies Subscribed To'} == 7  ? 'selected' : ''); ?>>GNS</option>
        <option value="8" <?= (@$vendor_datas->{'News Agencies Subscribed To'} == 8 || @$np_rate_renewal->{'News Agencies Subscribed To'} == 8 ? 'selected' : ''); ?>>Others</option>
      </select>
      <span id="alert_news_agencies_subscribed" style="color:red;display: none;"></span>
    </div>
  </div>
  
  <div class="col-md-4" id="agenciesDiv"><br>
    <div class="form-group">
      <label for="agencies">Agency / एजेंसी</label>
      <input type="text" name="agencies" maxlength="60" id="agencies" placeholder="Enter Agency" class="form-control  form-control-sm" id="agencies" onkeypress="return onlyAlphabets(event,this)" value="{{ @$np_rate_renewal->{'Agencies Name'} ? @$vendor_datas->{'Agencies Name'}: '' }}" {{ @$read }}>
      <span id="alert_agencies" style="color:red;display: none;"></span>
    </div>
  </div>


  @php
    $annualTurn = '';
    if(@$np_rate_renewal != '' && @$np_rate_renewal->{'Annual Turn-over'} !=''){
    $annualTurn = @$np_rate_renewal->{'Annual Turn-over'};
    }elseif(@$vendor_datas != '' && @$vendor_datas->{'Annual Turn-over'} !=''){
    $annualTurn = @$vendor_datas->{'Annual Turn-over'};
    }
    @endphp
  <div class="col-md-4">
    <div class="form-group">
      <label for="total_annual">Total Annual Turnover of the Newspaper in (Rs) / अखबार का कुल वार्षिक कारोबार (रु)</label>
      <input type="text" name="total_annual_turn_over" maxlength="10" placeholder="Enter Total Annual Turnover of The Newspaper in Rs" class="form-control  form-control-sm" id="total_annual" onkeypress="return onlyNumberKey(event)" value="{{$annualTurn != '' ? rtrim(rtrim(sprintf('%f', floatval($annualTurn)),0),'.') : ''}}" {{ @$read }}>
      <span id="alert_total_annual" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="bound_unbound">Bound/Unbound</label>
      <select name="bound_unbound" id="bound_unbound" class="form-control form-control-sm" style="width: 100%; pointer-events: {{$read}};" {{ $read }} >
        <option value="">Please Select</option>
        <option value="0" {{(@$np_rate_renewal->{'bound_unbound'} == "0")  ? 'selected' : (@$vendor_datas->{'bound_unbound'} == "0" ? 'selected' : '') }}>Bound</option>
        <option value="1" {{ (@$np_rate_renewal->{'bound_unbound'} == "1") ? "selected" : (@$vendor_datas->{'bound_unbound'} == "1" ? "selected" : '') }}>Unbound</option>
      </select>
      <span id="alert_bound_unbound" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="name_of_editor">Editor Name/ संपादक का नाम<font color="red">*</font></label>
      <input type="text" name="name_of_editor" maxlength="40" placeholder="Enter Editor Name" class="form-control form-control-sm" id="name_of_editor" onkeypress="return onlyAlphabets(event,this)" value="{{ @$np_rate_renewal->{'Editor Name'} ?? $vendor_datas->{'Editor Name'} ?? '' }}" {{ @$read }}>
      <span id="alert_name_of_editor" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="editor_mobile">Editor Mobile No. / संपादक का मोबाइल नंबर<font color="red">*</font></label>
      <input type="text" name="editor_mobile" maxlength="10" placeholder="Enter Editor Mobile No." class="form-control form-control-sm" id="editor_mobile" onkeypress="return onlyNumberKey(event)" value="{{ @$np_rate_renewal->{'Editor Mobile'} ?? $vendor_datas->{'Editor Mobile'} ?? '' }}" {{ @$read }}>
      <span id="alert_editor_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="editor_email">Editor E-mail ID / संपादक का ई-मेल आईडी<font color="red">*</font></label>
      <input type="email" name="editor_email" maxlength="40" placeholder="Enter Editor E-mail ID" class="form-control form-control-sm" id="editor_email" value="{{ @$np_rate_renewal->{'Editor Email'} ?? $vendor_datas->{'Editor Email'} ?? '' }}" {{ @$read }}>
      <span id="alert_editor_email" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="publisher_name">Publisher Name / प्रकाशक का नाम<font color="red">*</font></label>
      <input type="text" name="publisher_name" maxlength="40" placeholder="Enter Publisher Name" class="form-control form-control-sm" id="publisher_name" onkeypress="return onlyAlphabets(event,this)" value="{{ @$np_rate_renewal->{'Publisher Name'} != '' ? $np_rate_renewal->{'Publisher Name'} : @$vendor_datas->{'Publisher_s Name'} }}" {{ $read }}>
      <span id="alert_publisher_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="publisher_mobile">Publisher Mobile No. / प्रकाशक का मोबाइल नंबर<font color="red">*</font></label>
      <input type="text" name="publisher_mobile" maxlength="10" placeholder="Enter Publisher Mobile No." class="form-control form-control-sm" id="publisher_mobile" onkeypress="return onlyNumberKey(event)" value="{{@$np_rate_renewal->{'Publisher Mobile'} != '' ? $np_rate_renewal->{'Publisher Mobile'} : $vendor_datas->{'Publisher Mobile'} }}" {{ $read }}>
      <span id="alert_publisher_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="publisher_email">Publisher E-mail ID / प्रकाशक का ई-मेल आईडी<font color="red">*</font></label>
      <input type="email" name="publisher_email" maxlength="40" placeholder="Enter Publisher E-mail ID" class="form-control form-control-sm" id="publisher_email" value="{{@$np_rate_renewal->{'Publisher Email'} != '' ? $np_rate_renewal->{'Publisher Email'} : $vendor_datas->{'Publisher Email'} }}" {{ $read }}>
      <span id="alert_publisher_email" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
 
  <div class="col-md-4">
    <div class="form-group">
      <label for="printer_name">Printer Name / प्रिंटर का नाम<font color="red">*</font></label>
      <input type="text" name="printer_name" maxlength="50" placeholder="Enter Printer Name" class="form-control form-control-sm" id="printer_name" onkeypress="return onlyAlphabets(event,this)" value="{{@$np_rate_renewal->{'Printer Name'} != '' ? $np_rate_renewal->{'Printer Name'} : $vendor_datas->{'Printer_s Name'} }}" {{ $read }}>
      <span id="alert_printer_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="printer_mobile">Printer Mobile No. / प्रिंटर का मोबाइल नंबर<font color="red">*</font></label>
      <input type="text" name="printer_mobile" maxlength="10" placeholder="Enter Printer Mobile No." class="form-control form-control-sm" id="printer_mobile" onkeypress="return onlyNumberKey(event)" value="{{@$np_rate_renewal->{'Printer Phone'} != '' ? $np_rate_renewal->{'Printer Phone'} : $vendor_datas->{'Printer Mobile'} }}" {{ @$read }}>
      <span id="alert_printer_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="printer_email">Printer E-mail ID / प्रिंटर का ई-मेल आईडी<font color="red">*</font></label>
      <input type="email" name="printer_email" maxlength="40" placeholder="Enter Printer E-mail ID" class="form-control form-control-sm" id="printer_email" value="{{ @$np_rate_renewal->{'Printer Email'} != '' ? $np_rate_renewal->{'Printer Email'} : $vendor_datas->{'Printer Email'} }}" {{ $read }}>
      <span id="alert_printer_email" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
 
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group clearfix">
      <label for="owner_newspaper">Is the Press Owned by the Owner of Newspaper? / क्या प्रेस का स्वामित्व अखबार के मालिक के पास है? </label><br>
      <div class="icheck-primary d-inline">
        <input type="radio" id="owner_newspaper2" name="press_owned_by_owner" class="owner_press" value="0" {{(@$np_rate_renewal->{'Press owned by owner'} == "0")  ? 'checked' : (@$vendor_datas->{'Press owned by owner'} == "0" ? 'checked' : '') }} {{ @$read }}>
        <label for="owner_newspaper2">No / नहीं</label>
      </div>
      <div class="icheck-primary d-inline">
        <input type="radio" id="owner_newspaper1" name="press_owned_by_owner" class="owner_press" value="1" {{(@$np_rate_renewal->{'Press owned by owner'} == "1")  ? 'checked' : (@$vendor_datas->{'Press owned by owner'} == "1" ? 'checked' : '') }}  {{ @$read }}>
        <label for="owner_newspaper1">Yes / हाँ </label>&nbsp;&nbsp;
      </div>
    </div>
    <span id="alert_owner_newspaper" style="color:red;display: none;"></span>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="name_of_press">Press Name/ प्रेस का नाम <font color="red">*</font></label>
      <input type="text" name="name_of_press" maxlength="40" placeholder="Press Name" class="form-control form-control-sm" id="name_of_press" onkeypress="return onlyAlphabets(event,this)" value="{{ @$np_rate_renewal->{'Name of Press'} != '' ? $np_rate_renewal->{'Name of Press'} : $vendor_datas->{'Name of Press'} }}" {{ @$read }}>
      <span id="alert_name_of_press" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="press_mobile">Press Mobile No. / प्रेस का मोबाइल नंबर <font color="red">*</font></label>
      <input type="text" name="press_mobile" maxlength="10" placeholder="Enter Press Mobile No." class="form-control form-control-sm" id="press_mobile" onkeypress="return onlyNumberKey(event)" value="{{ @$np_rate_renewal->{'Press Mobile'} != '' ? $np_rate_renewal->{'Press Mobile'} : $vendor_datas->{'Press Mobile'} }}" {{ @$read }}>
      <span id="alert_press_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="press_email">Press E-mail ID / प्रेस का ई-मेल आईडी <font color="red">*</font></label>
      <input type="text" name="press_email" maxlength="40" placeholder="Enter Press E-mail ID" class="form-control form-control-sm" id="press_email" value="{{ @$np_rate_renewal->{'Press Email'} != '' ? $np_rate_renewal->{'Press Email'} : $vendor_datas->{'Press Email'} }}" {{ @$read }}>
      <span id="alert_press_email" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="press_phone">Press Phone No. / प्रेस का फोन नंबर <font color="red">*</font></label>
      <input type="text" name="press_phone" maxlength="15" placeholder="Enter Press Phone No." class="form-control form-control-sm" id="press_phone" onkeypress="return onlyNumberKey(event)" value="{{ @$np_rate_renewal->{'Press Phone'} != '' ? $np_rate_renewal->{'Press Phone'} : $vendor_datas->{'Press Phone'} }}" {{ @$read }}>
      <span id="alert_press_phone" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="address_of_press">Address of Press / प्रेस का पता</label>
      <textarea type="text" class="form-control form-control-sm" maxlength="220" placeholder="Enter Address of Press" name="address_of_press" id="address_of_press" {{ @$read }}>{{@$np_rate_renewal->{'Address of Press'} != '' ? $np_rate_renewal->{'Address of Press'}:$vendor_datas->{'Address of Press'} }}</textarea>
      <span id="alert_address_of_press" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
@php
    $distance = '';
    if(@$np_rate_renewal != '' && @$np_rate_renewal->{'Distance from office to press'} !=''){
    $distance = @$np_rate_renewal->{'Distance from office to press'};
    }elseif(@$vendor_datas != '' && @$vendor_datas->{'Distance from office to press'} !=''){
    $distance = @$vendor_datas->{'Distance from office to press'};
    }
@endphp
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="distance_press">Distance From Office to Press (in km.) / कार्यालय से प्रेस की दूरी (किमी. में)</label>
      <input type="text" name="distance_office_to_press" maxlength="15" placeholder="Enter Distance From Office to Press" class="form-control form-control-sm" id="distance_press" onkeypress="return onlyNumberKey(event)" value="{{ $distance != '' ? rtrim(rtrim(sprintf('%f', floatval($distance)),0),'.') : ''}}" {{ @$read }}>
      <span id="alert_distance_press" style="color:red;display: none;"></span>
    </div>
  </div>

  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="ca_name">CA Name / सीए का नाम</label>
      <input type="text" name="ca_name" maxlength="40" placeholder="Enter CA Name" class="form-control form-control-sm" id="ca_name" onkeypress="return onlyAlphabets(event,this)" value="{{@$np_rate_renewal->{'CA Name'} != '' ?$np_rate_renewal->{'CA Name'}:$vendor_datas->{'CA Name'} }}" {{ @$read }}>
      <span id="alert_ca_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="ca_address">CA Address / सीए का पता</label>
      <textarea type="text" class="form-control form-control-sm" placeholder="Enter CA Address" name="ca_address" id="ca_address" maxlength="220" {{ @$read }}>{{@$np_rate_renewal->{'CA Address'} != '' ?$np_rate_renewal->{'CA Address'}:$vendor_datas->{'CA Address'} }}</textarea>
      <span id="alert_ca_address" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="ca_registration_no">CA Registration No. / सीए पंजीकरण संख्या</label>
      <input type="text" name="ca_registration_no" maxlength="20" placeholder="Enter CA Registration No." class="form-control form-control-sm" id="ca_registration_no" onkeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{@$np_rate_renewal->{'CA Registration No_'} != '' ?$np_rate_renewal->{'CA Registration No_'}:$vendor_datas->{'CA Registration No_'} }}" {{ @$read }}>
      <span id="alert_ca_registration_no" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="ca_mobile">CA Mobile No. / सीए का मोबाइल नंबर</label>
      <input type="text" name="ca_mobile" maxlength="10" placeholder="Enter CA Mobile No." class="form-control form-control-sm" id="ca_mobile" onkeypress="return onlyNumberKey(event)" value="{{@$np_rate_renewal->{'CA Mobile No_'} != '' ? $np_rate_renewal->{'CA Mobile No_'} : $vendor_datas->{'CA Mobile No_'} }}" {{ @$read }}>
      <span id="alert_ca_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="ca_email">CA E-mail ID / सीए का ई-मेल आईडी</label>
      <input type="email" name="ca_email" maxlength="40" placeholder="Enter CA E-mail ID" class="form-control form-control-sm" id="ca_email" value="{{ @$np_rate_renewal->{'CA Email'} != '' ? $np_rate_renewal->{'CA Email'} : $vendor_datas->{'CA Email'} }}" {{ @$read }}>
      <span id="alert_ca_email" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  @php
  
  $dm_date = '';
  if((@$latest_dm_declaration_date != '1753-01-01 00:00:00.000') && @$latest_dm_declaration_date != ''){

  $dm_date = date('Y-m-d', strtotime(@$latest_dm_declaration_date));

  }else{

  $dm_date = date('Y-m-d', strtotime(@$vendor_datas->{'DM Declaration Date'}));

  }
  @endphp
  <div class="col-md-4" hidden>
    <div class="form-group">
      <label for="dm_declaration_date">DM Declaration Date / डीएम घोषणा तिथि </label>
      <input type="date" name="dm_declaration_date" class="form-control  form-control-sm" id="dm_declaration_date" value="{{$dm_date}}" {{ $read }}>
    </div>
  </div>
  
  <div class="col-md-4">
    <div class="form-group">
      <label for="date_of_first_publication">First Date of Publication (for Current Edition) / प्रकाशन की पहली तिथि (वर्तमान संस्करण के लिए) </label>
      <input type="date" name="date_of_first_publication" class="form-control  form-control-sm" id="date_of_first_publication" value="{{ (@$vendor_datas->{'Date Of First Publication'} !='1753-01-01 00:00:00.000' && $vendor_datas != null) ? date('Y-m-d', strtotime(@$vendor_datas->{'Date Of First Publication'} )) : '' }}" {{ $renewal_readonly }}>
    </div>
  </div>
  
  <!--<div class="col-md-4">
    <div class="form-group clearfix">
      <label for="edition">Vendor Edition / विक्रेता संस्करण</label><br>
      <div class="icheck-primary d-inline">
        @php
        $vendor_edition_check =  count(@$owner_other_publications) == 0 ? "checked" : "";
        @endphp
        <input type="radio" id="edition2" name="vendor_edition" value="0" {{ $vendor_edition_check }} {{ @$renewal_disabled }}>
        <label for="edition2">Single Edition/एकल संस्करण</label>
      </div><br>
      <div class="icheck-primary d-inline">
        <input type="radio" id="edition1" name="vendor_edition" value="1" {{ (@count(@$owner_other_publications)>0  ? "checked" :  "") }} {{ @$renewal_disabled }}>
        <label for="edition1">Multiple Edition/एकाधिक संस्करण</label>
      </div>
    </div>
  </div> -->
  <div class="col-md-4">
    <div class="form-group clearfix">
      <label for="change_address">Is Past Address Changed? / क्या पिछला पता बदल गया है? </label><br>
      <div class="icheck-primary d-inline">
        <input  type="radio" id="change_address2" name="change_address" onclick="changeCompAddr(this.value)" value="0" {{(@$np_rate_renewal->{'Change In Company Address'} == "0")  ? 'checked' : (@$vendor_datas->{'Change In Company Address'} == "0" ? 'checked' : '') }}  {{ @$read }}>
        <label for="change_address2">No / नहीं</label>
      </div>&nbsp;&nbsp;
      <div class="icheck-primary d-inline">
        <input  type="radio" id="change_address1" name="change_address"  onclick="changeCompAddr(this.value)" value="1" {{(@$np_rate_renewal->{'Change In Company Address'} == "1")  ? 'checked' : (@$vendor_datas->{'Change In Company Address'} == "1" ? 'checked' : '') }} {{ @$read }}>
        <label for="change_address1">Yes / हाँ </label>
      </div>
    </div>
  </div>
</div>
<div class="row" hidden>
  <div class="col-md-4">
    <div class="form-group clearfix">
      <label for="latest_dm_cert"> Is there any Changes on DM Declaration? / क्या डीएम की घोषणा में कोई बदलाव है? </label>
      <div class="icheck-primary d-inline">
        <input type="radio" id="latest_dm_cert2" name="latest_dm_cert" value="0" onclick="latestDmCertificate(this.value)" <?= (@$np_rate_renewal->{'DM Declaration'} == "0")  ? 'checked' : (@$vendor_datas->{'DM Declaration'} == "0" ? 'checked' : ''); ?> {{ $read}}>
        <label for="latest_dm_cert2">No / नहीं</label>
      </div>&nbsp;&nbsp;
      <div class="icheck-primary d-inline">
        <input type="radio" id="latest_dm_cert1" name="latest_dm_cert" value="1" onclick="latestDmCertificate(this.value)" <?= (@$np_rate_renewal->{'DM Declaration'} == "1")  ? 'checked' : (@$vendor_datas->{'DM Declaration'} == "1" ? 'checked' : ''); ?> {{$read}}>
        <label for="latest_dm_cert1">Yes / हाँ </label>
      </div>
    </div>
  </div>
</div>
