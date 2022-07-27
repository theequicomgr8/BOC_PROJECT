<div class="row">
    <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">From Date / दिनांक से<span style="color:red">*</span></label>
      <input {{ $disabled }} style="{{$style}}" type="text" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" name="crsRadiofrom_date" id="crsRadiofrom_date" value="{{ date('d/m/Y',strtotime(@$crsRadiocr->{'From Date'})) && date('d/m/Y',strtotime(@$crsRadiocr->{'From Date'}))!='01/01/1970' ?date('d/m/Y',strtotime(@$crsRadiocr->{'From Date'})): '' }}" placeholder="DD/MM/YYYY" autocomplete="off">
      <span id="date_error" style="color:red;display: none;"></span>
    </div>
  </div>    
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">To Date / दिनांक तक<span style="color:red">*</span></label>
      <input {{ $disabled }} style={{ $style }} type="text" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" name="crsRadioto_date" id="crsRadioto_date" value="{{ date('d/m/Y',strtotime(@$crsRadiocr->{'To Date'})) && date('d/m/Y',strtotime(@$crsRadiocr->{'To Date'}))!='01/01/1970' ?date('d/m/Y',strtotime(@$crsRadiocr->{'To Date'})): '' }}" placeholder="DD/MM/YYYY" autocomplete="off">
      <span id="date_error" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
  <div class="row">
     <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Advertisement Medium / विज्ञापन माध्यम<span style="color:red">*</span></label>
      <select {{ $disabled }} name="crsRadioMedium" id="crsRadioMedium" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">
        <option value="">Select Medium</option>
        <option value="0" {{@$crsRadiocr->{'Radio Type'} ==0 && @$crsRadiocr->{'Radio Type'} != ""  ? 'selected' : ''}}>CRS / सीआरएस</option>
        <option value="1"{{@$crsRadiocr->{'Radio Type'} ==1 && @$crsRadiocr->{'Radio Type'} != ""  ? 'selected' : ''}} >PVT. FM / प्राइवेट. एफएम</option>
        
      </select>
    </div>
  </div>
  <!--------Start Tentative--------->
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label"> Budget/संभावित बजट<span style="color:red">*</span></label>
      <input {{ $disabled }} type="text" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" name="crsTentative_budget" maxlength="20" id="crsTentative_budget" placeholder="Enter Budget" onkeypress="return onlyNumberKey(event)" value="{{round(@$crsRadiocr->{'Budget Amount'}) && round(@$crsRadiocr->{'Budget Amount'})!=0 ? IND_money_format(@$crsRadiocr->{'Budget Amount'}) :''}}">
    </div>
  </div><!--------end Tentative--------->
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Target Area / लक्षित इलाका <span style="color:red">*</span>
        </label>
        <select {{$disabled }} name="crsRadioTargetArea" id="crsRadioTargetArea" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">
          <option value="">Select Target Area </option>
          <option value="0" {{@$crsRadiocr->{'Target Area'} == "0" && @$crsRadiocr->{'Target Area'} != ""  ? 'selected' : ''}}>PAN India</option>
          <option value="1" {{@$crsRadiocr->{'Target Area'} == "1" && @$crsRadiocr->{'Target Area'} != ""  ? 'selected' : ''}}>State</option>
          <option value="2" {{@$crsRadiocr->{'Target Area'} == "2" && @$crsRadiocr->{'Target Area'} != ""  ? 'selected' : ''}}>City</option>
          <option value="3" {{@$crsRadiocr->{'Target Area'} == "3" && @$crsRadiocr->{'Target Area'} != ""  ? 'selected' : ''}}>State & City</option>
        </select>
      </div>
    </div>
    
    <div class="col-md-4" id="divcrsRadioState"style="display: none;" >
      <div class="form-group" id="crsRadio_state" >
        <label class="form-control-label">State/राज्य <span style="color:red">*</span></label>
        <select {{ $disabled }}  name="crsRadioState[]" id="crsRadioState" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" multiple>
         @foreach(@$states as $state)
          <option value="{{$state->Code}}" {{in_array( $state->Code, str_replace(' ', '', $fmStateSelectionData)) ? 'selected' :'' }}>{{$state->Code}} ~ {{$state->Description}}</option>
          @endforeach
        </select>
      </div>
    </div>
    @php
    if($getAllCityForFMStationOne==null)
    {
      $getAllCityForFMStationOne=[1];
    }
    else
    {
      $getAllCityForFMStationOne=$getAllCityForFMStationOne;
    }
    
    @endphp
    <div class="col-md-4" id="divcrsRadioCity" style="display: none;">
      <div class="form-group">
        <label class="form-control-label">City/शहर<span style="color:red">*</span></label>
        <select {{ $disabled }} name="crsRadioCity[]" id="crsRadioCity" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" multiple>
         @foreach(@$getAllCityForFMStationOne as $allCity)
        <option value="{{@$allCity->CityName}}" {{ in_array(@$allCity->CityName,str_replace(' ', '',$fmCitySelectionData) )? 'selected' :'' }}>{{@$allCity->CityName}} </option>
        @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Duration(in seconds) / अवधि (सेकंड में) <span style="color:red">*</span>
        <input {{$disabled}} type="text" id="crsRadioDuration" name="crsRadioDuration" value="{{@$crsRadiocr->{'Duration(Sec)'} ?? ''}}" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" placeholder="Enter Duration" onkeypress="return onlyNumberKey(event)">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Number of Spot/स्पॉट की संख्या <span style="color:red">*</span>
        </label>
        <input {{$disabled}} type="text" name="crsRadioSpotsNo" id="crsRadioSpotsNo" value="{{ @$crsRadiocr->spots ?? ''}}" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" placeholder="Enter Spots No" onkeypress="return onlyNumberKey(event)">
      </div>
    </div>
    <!-- <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Genre / शैली <span style="color:red">*</span></label>
        <select {{$disabled }} name="crsRadioGeneral" id="crsRadioGeneral" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">
          <option value="">Select General </option>
          <option value="ZEE News" selected="selected">ZEE News</option>
        </select>
      </div>
    </div> -->
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label"> Caption(1000 characters max) / कैप्शन (अधिकतम 1000 वर्ण)</label>
        <textarea {{$disabled}} name="crsRadioRequirment" id="crsRadioRequirment" placeholder="Enter Requirement" rows="2" style="height: 30px;" cols="50" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">{{@$crsRadiocr->{'Requirement'} ?? ''}}</textarea>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label"> Remarks (100 characters max) / रिमार्क्स (अधिकतम 100 वर्ण)</label>
        <textarea {{$disabled}} name="crsRadioRemark" style="height: 30px;" id="crsRadioRemark" placeholder="Enter Remarks" rows="2" cols="50" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">{{@$crsRadiocr->{'Remarks'} ?? ''}}</textarea>
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Is Creative Available/क्या रचनात्मक उपलब्ध है? <span style="color:red">*</span></label>
        <select {{ $disabled }} name="crsRadioCreativeAvail" id="crsRadioCreativeAvail" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" >
          <option value="">Select any one option</option>
          <option value="0" {{@$crsRadiocr->{'Creative Available'} == 0 && @$crsRadiocr->{'Creative Available'} != ""  ? 'selected' : ''}}>Available</option>
          <option value="1" {{@$crsRadiocr->{'Creative Available'} == 1 && @$crsRadiocr->{'Creative Available'} != ""  ? 'selected' : ''}}>Not Available</option>
          <!-- <option value="2" {{@$crsRadiocr->{'Creative Available'} == 2 && @$crsRadiocr->{'Creative Available'} != ""  ? 'selected' : ''}}>Creative to be developed by CBC</option>
          <option value="3" {{@$crsRadiocr->{'Creative Available'} == 3 && @$crsRadiocr->{'Creative Available'} != ""  ? 'selected' : ''}}>Photographs Available</option> -->
        </select>
      </div>
    </div>
    @if(@$crsRadiocr->{'Creative File Name'}=='' || @$crsRadiocr->{'Creative File Name'}==null)
    <div class="col-md-4" id="crsRadioUploadCreativeDiv">
      <div class="form-group">
        <label class="form-control-label">Upload Creative/क्रिएटिव अपलोड करें<span style="color:red">*</span></label>
        <input {{ $disabled }} type="file" accept="audio/*" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" name="crsRadioCreativeFileName" id="crsRadioCreativeFileName" ><span id="upload_doc_error" class="error invalid-feedback"></span>
      </div>
    </div>
    @endif
    @if(@$crsRadiocr->{'Creative File Name'}!='' || @$crsRadiocr->{'Creative File Name'}!=null)
    <div class="col-md-4" id="crsRadioUploadCreativeDiv">
      <div class="form-group">
        <label class="form-control-label">Uploaded Creative/क्रिएटिव अपलोड करें<span style="color:red">*</span></label>
        <audio  width="200" height="200" controls>
          <source src="{{ url('/uploads') }}/client-request/{{ $crsRadiocr->{'Creative File Name'} }}" type="audio/ogg">
          Your browser does not support the video tag.
        </audio >
      </div>
    </div>
    @endif
  </div>
