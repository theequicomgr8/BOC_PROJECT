
<h4 class="subheading">Minimum Current Card Rate/न्यूनतम वर्तमान कार्ड दर</h4>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="black_white">Black & White (Rs per Sq. cms ) / ब्लैक एंड व्हाइट (रुपये प्रति वर्ग सेमी.)</label>
      <input type="text" name="black_white" maxlength="15" placeholder="Enter Black & White" class="form-control  form-control-sm" id="black_white" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Minimum Current Card Rate(B_W)'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Minimum Current Card Rate(B_W)'] )),0),'.') : '' ) }}" {{$disabledall}}>
      <span id="alert_black_white" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="colour">Color (Rs per Sq. cms) / रंग (रुपये प्रति वर्ग सेमी.)</label>
      <input type="text" name="colour" placeholder="Enter Color" maxlength="15" class="form-control  form-control-sm" id="colour" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Minimum Current Card Rate(c)'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Minimum Current Card Rate(c)'] )),0),'.') : '') }}" {{$disabledall}}>
      <span id="alert_colour" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="price_newspaper">Price of Newspaper (Rs) / अखबार की कीमत (रु)<font color="red">*</font></label>
      <input type="text" name="price_newspaper" maxlength="15" placeholder="Enter Price of Newspaper" class="form-control  form-control-sm" id="price_newspaper" onkeypress="return isNumber(event,this)" value="{{ (@$vendordatas['Price of NewsPaper'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Price of NewsPaper'] )),0),'.') : '') }}" {{$disabledall}}>
      <span id="alert_price_newspaper" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-4">
    <div class="form-group clearfix">
      <label for="quality_paper_used">Quality of Paper Used / प्रयुक्त कागज की गुणवत्ता<font color="red">*</font></label><br>
      <div class="icheck-primary d-inline">
        <input type="radio" id="radioPrimary1" name="quality_paper_used" value="0" <?= (@$vendordatas['Quality of Paper'] == "0" && @$vendordatas['Newspaper Name'] != '' ? "checked" : ""); ?> {{$disabledall}}>
        <label for="radioPrimary1">Standard Newspaper / मानक समाचार पत्र </label>
      </div><br>
      <div class="icheck-primary d-inline">
        <input type="radio" id="radioPrimary2" name="quality_paper_used" value="1" <?= (@$vendordatas['Quality of Paper'] == "1" ? "checked" : ""); ?> {{$disabledall}}>
        <label for="radioPrimary2">Glazed / चमकता हुआ </label>
      </div>
      <div class="icheck-primary d-inline">
        <input type="radio" id="radioPrimary3" name="quality_paper_used" value="2" <?= (@$vendordatas['Quality of Paper'] == "2" ? "checked" : ""); ?> {{$disabledall}}>
        <label for="radioPrimary3">Ordinary / साधारण </label>
      </div>
    </div>
    <span id="alert_quality_paper_used" style="color:red;display: none;"></span>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Printing in Color / रंग में मुद्रण<font color="red">*</font></label>
      <select name="printing_colour" id="printing_colour" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}}>
        <option value="">Please Select </option>
        <option value="0" <?= (@$vendordatas['Printing in colour'] == 0 && @$vendordatas['Printing in colour'] != "" && @$vendordatas['Newspaper Name'] != '' ? 'selected' : ''); ?>>Color</option>
        <option value="1" <?= (@$vendordatas['Printing in colour'] == "1" ? "selected" : ""); ?>>B/W</option>
      </select>
      <span id="alert_printing_colour" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    @php
    if(@$vendordatas['Printing in colour'] == "0"){
    $display = 'block';
    }else{
    $display = 'none';
    }
    @endphp
    <div class="form-group" id="colour_page" style="display:{{ @$display }}">
      <label for="colour_pages">How Many Pages in Color / कितने पृष्ठ रंगीन है </label>
      <input type="text" name="colour_pages" maxlength="8" placeholder="Enter Pages in Color" class="form-control  form-control-sm" id="colour_pages" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['No_ of pages in colour'] !=0 ? $vendordatas['No_ of pages in colour'] : '') }}" {{ $disabledall }}>
      <span id="alert_colour_pages" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>News Agencies Subscribed to / समाचार एजेंसियों ने सदस्यता ली<font color="red">*</font></label>
      <select name="news_agencies_subscribed" id="news_agencies_subscribed" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}}>
        <option value="">Select any one</option>
        <option value="0" <?= (@$vendordatas['News Agencies Subscribed To'] == 0 && @$vendordatas['News Agencies Subscribed To'] != "" && @$vendordatas['Newspaper Name'] != '' ? 'selected' : ''); ?>>PTI</option>
        <option value="1" <?= (@$vendordatas['News Agencies Subscribed To'] == 1  ? 'selected' : ''); ?>>ANI</option>
        <option value="2" <?= (@$vendordatas['News Agencies Subscribed To'] == 2  ? 'selected' : ''); ?>>UNI</option>
        <option value="3" <?= (@$vendordatas['News Agencies Subscribed To'] == 3  ? 'selected' : ''); ?>>VAARTA</option>
        <option value="4" <?= (@$vendordatas['News Agencies Subscribed To'] == 4  ? 'selected' : ''); ?>>BHASHA</option>
        <option value="5" <?= (@$vendordatas['News Agencies Subscribed To'] == 5  ? 'selected' : ''); ?>>IANS</option>
        <option value="6" <?= (@$vendordatas['News Agencies Subscribed To'] == 6  ? 'selected' : ''); ?>>WEB VAARTA</option>
        <option value="7" <?= (@$vendordatas['News Agencies Subscribed To'] == 7  ? 'selected' : ''); ?>>GNS</option>
        <option value="8" <?= (@$vendordatas['News Agencies Subscribed To'] == 8  ? 'selected' : ''); ?>>Others</option>
      </select> 
      <span id="alert_news_agencies_subscribed" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="agenciesDiv"><br>
    <div class="form-group">
      <label for="agencies">Enter Agency / एजेंसी दर्ज करें<font color="red">*</font></label>
      <input type="text" name="agencies" maxlength="60" id="agencies" placeholder="Enter Agency" class="form-control  form-control-sm" id="agencies" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Agencies Name'] ?? '' }}" {{$disabledall}}>
      <span id="alert_agencies" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="total_annual">Total Annual Turnover of the Newspaper in Rs / अखबार का कुल वार्षिक कारोबार रु</label>
      <input type="text" name="total_annual_turn_over" maxlength="10" placeholder="Enter Total Annual Turnover of the Newspaper in Rs" class="form-control  form-control-sm" id="total_annual" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Annual Turn-over'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Annual Turn-over'])),0),'.') : '') }}" {{$disabledall}}>
      <span id="alert_total_annual" style="color:red;display: none;"></span>
      <span id="alert_total_annual_turn" style="color:#f8b739;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="name_of_editor">Editor Name/ संपादक का नाम<font color="red">*</font></label>
      <input type="text" name="name_of_editor" maxlength="40" placeholder="Enter Editor Name" class="form-control  form-control-sm" id="name_of_editor" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Editor Name'] ?? '' }}" {{$disabledall}}>
      <span id="alert_name_of_editor" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="editor_mobile">Editor Mobile No. / संपादक का मोबाइल नंबर<font color="red">*</font></label>
      <input type="text" name="editor_mobile" maxlength="10" placeholder="Enter Editor Mobile No." class="form-control  form-control-sm" id="editor_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Editor Mobile'] ?? '' }}" {{$disabledall}}>
      <span id="alert_editor_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="editor_email">Editor E-mail ID / संपादक का ई-मेल आईडी<font color="red">*</font></label>
      <input type="text" name="editor_email" maxlength="40" placeholder="Enter Editor E-mail ID" class="form-control  form-control-sm" id="editor_email" value="{{ $vendordatas['Editor Email'] ?? '' }}" {{$disabledall}}>
      <span id="alert_editor_email" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="publisher_name">Publisher Name / प्रकाशक का नाम<font color="red">*</font></label>
      <input type="text" name="publisher_name" maxlength="40" placeholder="Enter Publisher Name" class="form-control  form-control-sm" id="publisher_name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Publisher_s Name'] ?? '' }}" {{$disabledall}}>
      <span id="alert_publisher_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="publisher_mobile">Publisher Mobile No. / प्रकाशक का मोबाइल नंबर<font color="red">*</font></label>
      <input type="text" name="publisher_mobile" maxlength="10" placeholder="Enter Publisher Mobile No." class="form-control  form-control-sm" id="publisher_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Publisher Mobile'] ??'' }}" {{$disabledall}}>
      <span id="alert_publisher_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="publisher_email">Publisher E-mail ID / प्रकाशक का ई-मेल आईडी<font color="red">*</font></label>
      <input type="text" name="publisher_email" maxlength="40" placeholder="Enter Publisher E-mail ID" class="form-control  form-control-sm" id="publisher_email" value="{{ $vendordatas['Publisher Email'] ?? '' }}" {{$disabledall}}>
      <span id="alert_publisher_email" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="printer_name">Printer Name / प्रिंटर का नाम<font color="red">*</font></label>
      <input type="text" name="printer_name" maxlength="50" placeholder="Enter Printer Name" class="form-control  form-control-sm" id="printer_name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Printer_s Name'] ?? '' }}" {{$disabledall}}>
      <span id="alert_printer_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="printer_mobile">Printer Mobile No. / प्रिंटर का मोबाइल नंबर<font color="red">*</font></label>
      <input type="text" name="printer_mobile" maxlength="10" placeholder="Enter Printer Mobile No." class="form-control  form-control-sm" id="printer_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Printer Mobile'] ?? '' }}" {{$disabledall}}>
      <span id="alert_printer_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="printer_email">Printer E-mail ID / प्रिंटर का ई-मेल आईडी<font color="red">*</font></label>
      <input type="text" name="printer_email" maxlength="40" placeholder="Enter Printer E-mail ID" class="form-control  form-control-sm" id="printer_email" value="{{ $vendordatas['Printer Email'] ?? '' }}" {{$disabledall}}>
      <span id="alert_printer_email" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group clearfix">
      <label for="owner_newspaper">Is the Press Owned by the Owner of Newspaper? / क्या प्रेस का स्वामित्व अखबार के मालिक के पास है?<font color="red">*</font> </label><br>
      <div class="icheck-primary d-inline">
        <input type="radio" id="owner_newspaper2" name="press_owned_by_owner" class="owner_press" value="0" <?= (@$vendordatas['Press owned by owner'] === "0" && @$vendordatas['Newspaper Name'] != '' ? "checked" : ""); ?> {{$disabledall}}>
        <label for="owner_newspaper2">No / नहीं</label>
      </div>
      <div class="icheck-primary d-inline">
        <input type="radio" id="owner_newspaper1" name="press_owned_by_owner" class="owner_press" value="1" <?= (@$vendordatas['Press owned by owner'] == "1" ? "checked" : ""); ?> {{$disabledall}}>
        <label for="owner_newspaper1">Yes / हाँ </label>&nbsp;&nbsp;
      </div>
    </div>
    <span id="alert_owner_newspaper" style="color:red;display: none;"></span>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="name_of_press">Press Name/ प्रेस का नाम<font color="red">*</font></label>
      <input type="text" name="name_of_press" maxlength="40" placeholder="Enter Press Name" class="form-control  form-control-sm" id="name_of_press" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Name of Press'] ?? '' }}" {{$disabledall}}>
      <span id="alert_name_of_press" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="press_mobile">Press Mobile No. / प्रेस का मोबाइल नंबर<font color="red">*</font></label>
      <input type="text" name="press_mobile" maxlength="10" placeholder="Enter Press Mobile No." class="form-control  form-control-sm" id="press_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Press Mobile'] ?? '' }}" {{$disabledall}}>
      <span id="alert_press_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="press_email">Press E-mail ID / प्रेस का ई-मेल आईडी<font color="red">*</font></label>
      <input type="text" name="press_email" maxlength="40" placeholder="Enter Press E-mail ID" class="form-control  form-control-sm" id="press_email" value="{{ $vendordatas['Press Email'] ?? '' }}" {{$disabledall}}>
      <span id="alert_press_email" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="press_phone">Press Phone No. / प्रेस का फोन नंबर<font color="red">*</font></label>
      <input type="text" name="press_phone" maxlength="15" placeholder="Enter Press Phone No." class="form-control  form-control-sm" id="press_phone" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Press Phone'] ?? '' }}" {{$disabledall}}>
      <span id="alert_press_phone" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="address_of_press">Address of Press / प्रेस का पता</label>
      <textarea type="text" class="form-control  form-control-sm" maxlength="220" placeholder="Enter Address of Press" name="address_of_press" id="address_of_press" {{$disabledall}}>{{ $vendordatas['Address of Press'] ?? '' }}</textarea>
      <span id="alert_address_of_press" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="distance_press">Distance From Office to Press (in km.) / कार्यालय से प्रेस की दूरी (किमी. में)</label>
      <input type="text" name="distance_office_to_press" maxlength="15" placeholder="Enter Distance From Office to press" class="form-control  form-control-sm" id="distance_press" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Distance from office to press'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Distance from office to press'] )),0),'.') : '') }}" {{$disabledall}}>
      <span id="alert_distance_press" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="ca_name">CA Name / सीए का नाम</label>
      <input type="text" name="ca_name" maxlength="40" placeholder="Enter CA Name" class="form-control  form-control-sm" id="ca_name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['CA Name'] ?? '' }}" {{$disabledall}}>
      <span id="alert_ca_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="ca_address">CA Address / सीए का पता</label>
      <textarea type="text" class="form-control  form-control-sm" placeholder="Enter CA Address" name="ca_address" id="ca_address" maxlength="220" {{$disabledall}}>{{ $vendordatas['CA Address'] ?? '' }}</textarea>
      <span id="alert_ca_address" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="ca_registration_no">CA Registration No. / सीए पंजीकरण संख्या</label>
      <input type="text" name="ca_registration_no" maxlength="20" placeholder="Enter CA Registration No." class="form-control  form-control-sm" id="ca_registration_no" onkeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{ $vendordatas['CA Registration No_'] ?? '' }}" {{$disabledall}}>
      <span id="alert_ca_registration_no" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="ca_mobile">CA Mobile No. / सीए का मोबाइल नंबर</label>
      <input type="text" name="ca_mobile" maxlength="10" placeholder="Enter CA Mobile No." class="form-control  form-control-sm" id="ca_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['CA Mobile No_'] ?? '' }}" {{$disabledall}}>
      <span id="alert_ca_mobile" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="ca_email">CA E-mail ID / सीए का ई-मेल आईडी</label>
      <input type="email" name="ca_email" maxlength="40" placeholder="Enter CA E-mail ID" class="form-control  form-control-sm" id="ca_email" value="{{ $vendordatas['CA Email'] ?? '' }}" {{$disabledall}}>
      <span id="alert_ca_email" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  @php
  $dm_date = ' ';
  if((@$vendordatas['DM Declaration Date'] != '1970-01-01 00:00:00.000') && $vendordatas != null){
  $dm_date = date('Y-m-d', strtotime(@$vendordatas['DM Declaration Date'] ));
  }
  @endphp
  <div class="col-md-4">
    <div class="form-group">
      <label for="dm_declaration_date">DM Declaration Date / डीएम घोषणा तिथि<font color="red">*</font></label>
      <input type="date" name="dm_declaration_date" class="form-control  form-control-sm" id="dm_declaration_date" value="{{$dm_date}}" {{$disabledall}}>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group clearfix">
      <label for="edition">Vendor Edition / विक्रेता संस्करण</label><br>
      <div class="icheck-primary d-inline">
        @php
        $vendor_edition_check = (@$ownerotherdata == '' && @$vendordatas['Newspaper Name'] !='' ? "checked" : "");
        @endphp
        <input type="radio" id="edition2" name="vendor_edition" value="0" class="messageCheckbox" {{ $vendor_edition_check }} {{$disabledall}}>
        <label for="edition2">Single Edition/एकल संस्करण</label>
      </div><br>
      <div class="icheck-primary d-inline">
        <input type="radio" id="edition1" name="vendor_edition" value="1" class="messageCheckbox" {{ (@count($ownerotherdata)>=1 && $ownerotherdata != '')  ? "checked" : "" }} {{$disabledall}}>
        <label for="edition1">Multiple Edition/एकाधिक संस्करण</label>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group clearfix">
      <label for="change_address">Is Past Address Changed? / क्या पिछला पता बदल गया है? </label><br>
      <div class="icheck-primary d-inline">
        <input type="radio" id="change_address2" name="change_address" onclick="changeCompAddr(this.value)" value="0" <?= (@$vendordatas['Change In Company Address'] == "0" && @$vendordatas['Newspaper Name'] != '' ? "checked" : ""); ?> {{$disabledall}}>
        <label for="change_address2">No / नहीं</label>
      </div>&nbsp;&nbsp;
      <div class="icheck-primary d-inline">
        <input type="radio" id="change_address1" name="change_address" value="1" onclick="changeCompAddr(this.value)" <?= (@$vendordatas['Change In Company Address'] == "1"  ? "checked" : ""); ?> {{$disabledall}}>
        <label for="change_address1">Yes / हाँ </label>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <!-- checkbox -->
    <div class="form-group clearfix">
    </div>
  </div>
</div>