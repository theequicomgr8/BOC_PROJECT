<div class="row">
  <div class="col-md-4"><br>
    <div class="form-group">
      <label for="account_type">Account Type / खाते का प्रकार<font color="red">*</font></label>
      <select class="form-control  form-control-sm" name="account_type" id="account_type" {{$disabledall}}>
         <option value="">Please Select</option>
        <option value="0" {{ (@$vendordatas['Account Type'] == 0 && @$vendordatas['Account Type'] != "" ? 'selected' : '') }}>Saving</option>
        <option value="1" {{ (@$vendordatas['Account Type'] == 1 ? 'selected' : '') }}>Corporate</option>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="bank_account_no">Bank Account Number for Receiving Payments / भुगतान प्राप्त करने के लिए बैंक खाता संख्या<font color="red">*</font></label>
      <input type="text" class="form-control  form-control-sm" name="bank_account_no" maxlength="20" id="bank_account_no" placeholder="Enter Bank Account Number" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Bank Account No_'] ?? '' }}" {{$disabledall}}>
      <span id="alert_bank_account_no" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group divmargin">
      <label for="account_holder_name">Account Holder Name / खाता धारक का नाम<font color="red">*</font></label>
      <input type="text" class="form-control  form-control-sm" name="account_holder_name" maxlength="70" id="account_holder_name" placeholder="Enter Account Holder Name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Account Holder Name'] ?? '' }}" {{$disabledall}}>
      <span id="alert_account_holder_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="ifsc_code">IFSC Code / आईएफएससी कोड<font color="red">*</font></label>
      <input type="text" class="form-control  form-control-sm" name="ifsc_code" id="ifsc_code" maxlength="11" placeholder="Enter IFSC Code" value="{{ $vendordatas['IFSC Code'] ?? '' }}" {{$disabledall}}>
      <span id="alert_ifsc_code" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
      <input type="text" class="form-control  form-control-sm" name="bank_name" id="bank_name" maxlength="50" placeholder="Enter Bank Name" value="{{ $vendordatas['Bank Name'] ?? '' }}" {{$disabledall}}>
      <span id="alert_bank_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="branch_name">Branch / शाखा<font color="red">*</font></label>
      <input type="text" class="form-control  form-control-sm" name="branch_name" id="branch_name" maxlength="40" placeholder="Enter Branch" value="{{ $vendordatas['Branch'] ?? '' }}" {{$disabledall}}>
      <span id="alert_branch_name" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="address_of_account">Address of Bank / बैंक का पता<font color="red">*</font></label>
      <textarea class="form-control  form-control-sm" placeholder="Enter Address of Account" maxlength="220" name="address_of_account" id="address_of_account" {{$disabledall}}>{{ $vendordatas['Account Address'] ?? '' }}</textarea>
      <span id="alert_address_of_account" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="pan_card">PAN Card No./ पैन कार्ड नंबर<font color="red">*</font></label>
      <input type="text" name="pan_card" id="pan_card" class="form-control  form-control-sm" maxlength="10" placeholder="Enter Pan Card" value="{{ $vendordatas['PAN'] ?? '' }}" {{$disabledall}} onchange="validatePanNumber(this)">
      <span id="alert_pan_card" style="color:red;display: none;"></span>
    </div>
  </div>
  <fieldset class="fieldset-border">
    <legend>ESI Account Details / ईएसआई खाता विवरण</legend>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="ESI_account_no">Account No. / खाता नंबर</label>
          <input type="text" name="ESI_account_no" id="ESI_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter Account No." onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['ESI Account No'] ?? '' }}" {{$disabledall}}>
          <span id="alert_address_of_account" style="color:red;display: none;"></span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="ESI_no_employees">No. of Employees Covered / कवर किए गए कर्मचारियों की संख्या</label>
          <input type="text" name="ESI_no_employees" id="ESI_no_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter No. of Employees Covered" onkeypress="return onlyNumberKey(event)" value="{{ ((@$vendordatas['No_of Employees covered'] && @$vendordatas['No_of Employees covered'] !=0) ? @$vendordatas['No_of Employees covered'] : '')  }}" {{$disabledall}}>
          <span id="alert_ESI_no_employees" style="color:red;display: none;"></span>
        </div>
      </div>
    </div>
  </fieldset>
  <fieldset class="fieldset-border">
    <legend>EPF Account Details / ईपीएफ खाता विवरण</legend>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="Name">Account No. / खाता नंबर</label>
          <input type="text" name="EPF_account_no" id="EPF_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter Account No." onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['EPF Account No_'] ?? '' }}" {{$disabledall}}>
        </div>
        <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="Name">No. of Employees Covered / कवर किए गए कर्मचारियों की संख्या</label>
          <input type="text" name="EPF_no_of_employees" id="EPF_no_of_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter No. of Employees Covered" onkeypress="return onlyNumberKey(event)" value="{{ ((@$vendordatas['No_ of EPF Employees covered'] && @$vendordatas['No_ of EPF Employees covered'] !=0) ? @$vendordatas['No_ of EPF Employees covered'] : '')  }}" {{$disabledall}}>
          <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
        </div>
      </div>
    </div>
  </fieldset>
</div>
<input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3" value="{{$vendordatas['Newspaper Code'] ?? ''}}" {{$disabledall}}>
<input type="hidden" name="next_tab_3" id="next_tab_3" value="0" {{$disabledall}}>
<div class="col-sm-12 text-right" style="padding: 0;">
  <a class="btn btn-primary reg-previous-button previousClass btn-sm m-0" data="11"><i class="fa fa-caret-left"></i> Previous</a>
  <a class="btn btn-primary next-button btn-sm m-0" id="tab_3">Next <i class="fa fa-caret-right"></i></a>
</div>