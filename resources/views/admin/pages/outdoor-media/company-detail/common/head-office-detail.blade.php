<fieldset class="fieldset-border">
    <legend> Head Office / प्रधान कार्यालय</legend>
    <div class="row">
            <div class="col-md-8">
                <h6>(Email/Mobile No.) Same as Owner / (ईमेल/मोबाइल नंबर) मालिक के समान : </h6>
            </div>
            <div class="col-md-4">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input h5" name="headradio" value="1" onclick="return ownerDetail(this.value)"> Yes &nbsp;
                        <input type="radio" class="form-check-input h5" name="headradio" value="0" onclick="return ownerDetail(this.value)">No
                    </label>
                </div>
            </div><br><br>
        <div class="col-md-4">
            <div class="form-group">
                <label for="email_1">E-mail ID / ई-मेल आईडी<font color="red">*</font></label>
                <input type="text" name="HO_Email" placeholder="Enter E-mail ID" class="form-control form-control-sm" id="HO_Email" value="{{$vendor_data[0]['HO E-Mail']??''}}" maxlength="50" onkeyup="return checkUniqueVendor('email', this.value)">
                <span id="v_alert_email" style="color:red;display: none;"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="HO_Mobile_No">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm" id="HO_Mobile_No" name="HO_Mobile_No" placeholder="Enter Mobile No." onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" value="{{$vendor_data[0]['HO Mobile No_']??''}}" onkeyup="return checkUniqueVendor('mobile', this.value)">
                <span id="v_alert_mobile" style="color:red;display: none;"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="landline_no">Landline No. / लैंडलाइन नंबर<font color="red"></font>
                </label>
                <input type="text" name="HO_Landline_No" id="landline_no" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_head_office" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{$vendor_data[0]['HO Landline No_']??''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="address">Address / पता<font color="red">*</font></label>
                <textarea type="text" name="HO_Address" id="address1" maxlength="120" placeholder="Enter Address" rows="2" class="form-control form-control-sm">{{$vendor_data[0]['HO Address']??''}}</textarea>
            </div>
        </div>
    </div>
</fieldset>