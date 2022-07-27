<fieldset class="fieldset-border">
    <legend> Details of GST / जीएसटी का विवरण</legend>
    <input type="hidden" name="odmediaid" value="{{$vendor_data[0]['OD Media ID'] ?? ''}}">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="GST_No">GST No. / जीएसटी संख्या <font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm" name="GST_No" id="GST_No" placeholder="Enter GST No." maxlength="15" value="{{ Session::get('Gst') ?? @$vendor_data[0]['GST No_'] }}" onkeypress="return isAlphaNumeric(event)" readonly>
                <span class="gstvalidationMsg"></span>
                <span class="validcheck"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="PM_Agency_Name">Agency Name / एजेंसी का नाम<font color="red">*
                    </font></label>
                <input type="text" name="PM_Agency_Name" class="form-control form-control-sm" placeholder="Enter Agency Name" id="PM_Agency_Name" value="{{@$vendor_data[0]['PM Agency Name'] ?? ''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tin_tan_vat_no">TIN/TAN / टिन/टैन</label>
                <input type="text" class="form-control form-control-sm" name="TIN_TAN_VAT_No" id="tin_tan_vat_no" placeholder="Enter TIN/TAN (if Applicable)" maxlength="15" onkeypress="return isAlphaNumeric(event)" value="{{@$vendor_data[0]['TIN_TAN_VAT No_'] ?? ''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tin_tan_vat_no">Any Other Relevant Information / कोई
                    अन्य प्रासंगिक जानकारी</label>
                <input type="text" class="form-control form-control-sm" name="Other_Relevant_Information" id="tin_tan_vat_no" placeholder="Enter Any Other Relevant Information" maxlength="80" value="{{@$vendor_data[0]['Other Relevant Information'] ?? ''}}">
            </div>
        </div>
    </div>
</fieldset>