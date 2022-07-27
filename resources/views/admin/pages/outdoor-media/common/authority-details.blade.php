@php
$Authority_Media = '';
$Contract_No = '';
$License_Fee = '';
$License_From = '';
$License_To = '';
if(!empty($vendor_data)){
$Authority_Media = $vendor_data[0]['Authority Which granted Media'];
$Contract_No = $vendor_data[0]['Contract No_'];
$License_Fee = $vendor_data[0]['License Fees'];
$License_From = $vendor_data[0]['License From'];
$License_To = $vendor_data[0]['License To'];
}


$today_date = date('Y-m-d');
@endphp

<!-- <div class="row col-md-12">
    <h4 class="subheading">Authority Details / प्राधिकरण विवरण :-</h4>
</div> -->
<fieldset class="fieldset-border">
    <legend> Authority Details / प्राधिकरण विवरण</legend>
    <div class="row" id="authority_details">
        <div class="col-md-4">
            <div class="form-group">
                <label for="authority">Authority Which Granted Media Rights / प्राधिकरण जिसने मीडिया अधिकार प्रदान करता है
                    <font color="red">*</font>
                </label>
                <input type="text" name="Authority_Which_granted_Media" placeholder="Enter Authority Which Granted Media Rights" class="form-control form-control-sm" id="authority" maxlength="120" value="{{ $Authority_Media ?? '' }}">
            </div>
        </div>
        <div class="col-md-4"><br>
            <div class="form-group">
                <label for="Contract_No">Contract No. / अनुबंध क्रमांक<font color="red">*</font>
                </label>
                <input type="text" name="Contract_No" placeholder="Enter Contract No." onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" id="Contract_No" maxlength="13" value="{{ $Contract_No !='' && $Contract_No !=0 ? $Contract_No : '' }}">
            </div>
        </div>
        <div class="col-md-4"><br>
            <div class="form-group">
                <label for="License_Fee">License Fee / लाइसेंस शुल्क<font color="red">*</font></label>
                <input type="text" name="License_Fee" id="license_fee" placeholder="Enter License Fee" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" maxlength="8" value="{{ $License_Fee !='' && $License_Fee !=0 ? round($License_Fee,2) : ''}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="license_from">License Start Date / लाइसेंस शुरू होने
                    की दिनांक<font color="red">*</font></label>
                <input type="date" name="License_From" maxlength="10" id="txt_from" maxlength="10" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ $License_From != '' && $License_From != '1900-01-01 00:00:00.000' ? date('Y-m-d', strtotime($License_From)) : ''}}" max="{{$today_date}}">
                <span id="date_error" style="color:red;display: none;"></span>
            </div>
        </div>
        @if(@$vendor_data[0]['Modification']!='1')
        <div class="col-md-4">
            <div class="form-group">
                <label for="license_to">License End Date / लाइसेंस समाप्ति दिनांक
                    <font color="red">*</font>
                </label>
                <input type="date" name="License_To" maxlength="10" id="txt_to1" maxlength="10" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ $License_To !='' && $License_To != '1900-01-01 00:00:00.000' ? date('Y-m-d', strtotime($License_To)) : ''}}" min="{{$today_date}}">
                <span id="date_error" style="color:red;display: none;"></span>
            </div>
        </div>
        @else
        <div class="col-md-4">
            <div class="form-group">
                <label for="license_to">License end date / लाइसेंस समाप्ति दिनांक
                    <font color="red">*</font>
                </label>
                <input type="date" name="License_To" maxlength="10" id="txt_to1" maxlength="10" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ $License_To !='' ? date('Y-m-d', strtotime($License_To)) : ''}}">
                <span id="date_error" style="color:red;display: none;"></span>
            </div>
        </div>
        @endif
    </div>
</fieldset>