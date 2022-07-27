<fieldset class="fieldset-border">
    <legend> Authorized Representative / अधिकृत प्रतिनिधि</legend>
    <div id="radioar">
        @foreach($authorize_data as $key => $auth)
        @if(($key - 1) >= 0)
        <hr id="hrline_authorized_{{$key}}">
        @endif
        <div class="row" id="auth_detail">
        <div class="col-md-4">
                <div class="form-group">
                    <label for="AR_Email">E-mail ID / ई-मेल आईडी <font color="red">*</font></label>
                    <p>
                        <input type="text" name="AR_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="AR_Email" maxlength="30" value="{{ Session::get('email') ?? $auth['AR Email']}}">
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="AR_Mobile_No">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                    <p>
                        <input type="text" name="AR_Mobile_No[]" placeholder="Enter Mobile No." class="form-control form-control-sm" id="AR_Mobile_No" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" value="{{ Session::get('Mobile') ?? $auth['AR Mobile'] }}">
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Authorized_Rep_Name">Name / नाम <font color="red">*</font></label>
                    <p>
                        <input type="text" name="Authorized_Rep_Name[]" id="Authorized_Rep_Name" placeholder="Enter Name" class="form-control form-control-sm" maxlength="40" onkeypress="return onlyAlphabets(event)" value="{{$auth['AR Name'] ??''}}">
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="AR_Address">Address / पता <font color="red">*</font></label>
                    <p>
                        <textarea type="text" name="AR_Address[]" id="AR_Address" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm">{{$auth['AR Address'] ??''}}</textarea>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="AR_Landline_No">Landline No. / लैंडलाइन नंबर <font color="red"></font></label>
                    <p>
                        <input type="text" name="AR_Landline_No[]" id="AR_Landline_No" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_no" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$auth['AR Phone No_'] ??''}}">
                    </p>
                </div>
            </div>            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="altername_mobile"> Alternate Mobile No. / वैकल्पिक मोबाइल नंबर <font color="red"></font></label>
                    <p>
                        <input type="text" name="altername_mobile[]" placeholder="Enter Alternate Mobile No." class="form-control form-control-sm" id="altername_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" value="{{$auth['Alternate Mobile No_'] ??''}}">
                    </p>
                </div>
            </div>
            <div class="col-md-10"></div>
            <div class="col-md-2" style="padding: 0% 0 0 7%; display: {{$key==0 ? 'none' :'block'}}"><button class="btn btn-danger btn-sm m-0 remove_row" id="{{$key}}" style="font-size: 13px;"><i class="fa fa-minus"></i> Remove</button>
            </div>
            <input type="hidden" value="{{$auth['Line No_'] ?? ''}}" name="auth_line_no[]" id="auth_line_no_{{$key}}">
            <input type="hidden" value="{{$auth['OD Media ID'] ?? ''}}" name="auth_odmedia_id[]" id="auth_odmedia_id_{{$key}}">
        </div>
        @endforeach
    </div>
    <!-- For Add function 8-Feb -->
    <!-- <div class="row" style="float:right;padding: 6px 8px 6px 0px;">
        <input type="hidden" name="count_id" id="countID" value="{{$key ?? 0}}">
        <a class="btn btn-primary btn-sm m-0" id="add_Auth" style="font-size: 13px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
    </div> -->
    <!--  here remove include file -->
</fieldset>