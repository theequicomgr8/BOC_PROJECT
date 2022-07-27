<fieldset class="fieldset-border">
    <legend> Branch Office / शाखा कार्यालय</legend>
    <div class="row col-md-12">
        <div class="row col-md-6">
            <strong><font style="color: red;">Provide details of all branch offices.</font></strong>

            <h6>Branch Office (if any) / शाखा कार्यालय (यदि कोई हो) : </h6>
        </div>
        <div class="row col-md-4">
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input h5" name="boradio" value="1" {{$branchcheckyes}}> Yes &nbsp;
                    <input type="radio" class="form-check-input h5" name="boradio" value="0" {{$branchcheckno}}>No
                </label>
            </div>
        </div>
    </div>
    <br>

    <div id="radio" style="display: {{$branchdisplayform}};">

        @foreach($branch_data as $key => $branch)
        @if(($key - 1) >= 0)
        <hr id="hrline_radio_{{$key}}">
        @endif
        <div class="row">
        <div class="col-md-4">
                <div class="form-group">
                    <label for="email">E-mail ID / ई-मेल आईडी <font color="red">*</font></label>
                    <p>
                        <input type="text" name="BO_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="BO_Email" maxlength="30" value="{{ $branch['BO E-mail'] ??''}}">
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                    <p>
                        <input type="text" name="BO_Mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" value="{{$branch['BO Mobile No_'] ??''}}">
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Name">State / राज्य<font color="red">*</font></label>
                    <p>
                        <select id="BO_state" name="BO_state[]" class="form-control form-control-sm">
                            <option value="">Select State</option>
                            @if(count($states) > 0)
                            @foreach($states as $statesData)
                            <option value="{{ $statesData['Code'] }}" {{@$branch['State'] == $statesData['Code'] ? 'selected' : ''}}>
                                {{$statesData['Description']}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="address">Address / पता <font color="red">*</font></label>
                    <p>
                        <textarea type="text" name="BO_Address[]" id="BO_Address" maxlength=" 120" placeholder="Enter Address" rows="1" class="form-control form-control-sm">{{$branch['BO Address'] ??''}}</textarea>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red"></font></label>
                    <p>
                        <input type="text" name="BO_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="bo_landline_no" maxlength="14" onkeypress="return onlyNumberKey(event)" value="{{$branch['BO Landline No_'] ??''}}">
                    </p>
                </div>
            </div>            
            <div class="col-md-10"></div>
            <div class="col-md-2" style="padding: 0% 0 0 7%; display: {{$key==0 ? 'none' :'block'}}"><button class="btn btn-danger btn-sm m-0 remove_branch_row" id="{{$key}}" style="font-size: 13px;"><i class="fa fa-minus"></i> Remove</button>
            </div>
            <input type="hidden" value="{{$branch['Line No_'] ?? ''}}" name="br_line_no[]" id="br_line_no_{{$key}}">
            <input type="hidden" value="{{$branch['OD Media ID'] ?? ''}}" name="br_odmedia_id" id="br_odmedia_id_{{$key}}">
        </div>
        @endforeach
    </div>
    <!-- For Add function 8-Feb -->
    <div class="row" style="float:right;padding: 6px 8px 6px 0px;" id="addid">
        <input type="hidden" name="count_branch_id" id="count_branch_id" value="{{$key ?? 0}}">
        <a class="btn btn-primary btn-sm m-0" id="add_branch" style="font-size: 13px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
    </div>
    <!-- For Add function 8-Feb end -->
</fieldset>