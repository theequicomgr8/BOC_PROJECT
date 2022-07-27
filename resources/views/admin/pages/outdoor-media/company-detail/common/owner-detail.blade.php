<fieldset class="fieldset-border">
    <legend> Owner Detail / मालिक का विवरण</legend>
    <div id="details_of_owner">
        @foreach($owner_data as $key => $ownerlist)

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="owner_name">Owner/Managing Partner Name / मालिक/प्रबंध भागीदार का नाम <font color="red">*</font>
                    </label>
                        <input type="text" name="owner_name" id="owner_name" placeholder="Enter Owner name" class="form-control form-control-sm owner_name" onkeypress="return onlyAlphabets(event,this);" maxlength="40" value="{{$ownerlist['Owner Name']?? ''}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email">E-mail ID / ई-मेल आईडी<font color="red">*</font></label>
                        <input type="email" class="form-control form-control-sm owner_email" id="owner_email" name="owner_email" maxlength="50" placeholder="Enter E-mail ID" value="{{$ownerlist['Email ID']?? ''}}" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,0)">
                        <span id="alert_owner_email" style="color:red;display: none;"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                        <input type="text" name="owner_mobile" id="owner_mobile" maxlength="10" minlength="10" placeholder="Enter Mobile No." class="form-control form-control-sm input-imperial owner_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$ownerlist['Mobile No_']?? ''}}" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,0)">
                        <span id="alert_owner_mobile" style="color:red;display: none;"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="address">Address / पता<font color="red">*</font></label>
                        <textarea type="text" name="address" id="owner_address" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm owner_address">{{$ownerlist['Address 1']?? ''}}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Name">State / राज्य<font color="red">*</font></label>
                        <select id="owner_state" name="state" class="form-control form-control-sm call_district owner_state" data="owner_district" cityid="owner_city">
                            <option value="">Select State</option>
                            @if(count($states) > 0)
                            @foreach($states as $statesData)
                            <option value="{{ $statesData['Code'] }}" {{@$ownerlist['State'] == $statesData['Code'] ? 'selected' : '' }}>
                                {{$statesData['Description']}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Name">District / ज़िला<font color="red">*</font></label>
                        <select id="owner_district" name="district" class="form-control form-control-sm owner_district">
                        <option value="">Select District</option>
                            @if(@$ownerlist['District'] != '')
                            @foreach($ownerDistricts as $district)
                            <option value="{{$district['District']}}" {{ @$ownerlist['District'] == $district['District']  ?  'selected' : '' }}>
                                {{ $district['District'] }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="Name">City / नगर<font color="red">*</font></label>
                        <select id="owner_city" name="city" class="form-control form-control-sm owner_city">
                            <option value="">Select City</option>
                            @if(@$ownerlist['City'] != '')
                            @foreach($ownerCities as $city)
                            <option value="{{$city['cityName']}}" {{ @$ownerlist['City'] == $city['cityName']  ?  'selected' : '' }}>
                                {{ ucfirst(strtolower($city['cityName'])) }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone">Phone No. / फोन नंबर<font color="red">*</font></label>
                    <input type="text" name="phone" id="owner_phone" maxlength="14" onkeypress="return onlyNumberKey(event)" placeholder="Enter Phone No." class="form-control form-control-sm input-imperial owner_phone" value="{{$ownerlist['Phone No_']?? ''}}">
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <input type="hidden" name="ownerid" id="ownerid" value="{{$ownerlist['Owner ID'] ?? ''}}">
    </div>
    <input type="hidden" name="mobilecheck" id="mobilecheck">
    <input type="hidden" name="owner_input_clean" id="owner_input_clean">
    <input type="hidden" name="user_id" value="{{ session('id') }}">
    <input type="hidden" name="user_email" value="{{ session('email') }}">
    <input type="hidden" name="emailarr[]" id="emailarr" value="">
</fieldset>