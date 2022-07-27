  <div class="row">
     <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Advertisement Medium / विज्ञापन माध्यम<font color="red">*</font></label>
      <select {{ $disabled }} name="crsRadioMedium" id="crsRadioMedium" class="form-control form-control-sm">
        <option value="">Select Medium</option>
        <option value="0" {{@$crsRadiocr->{'Radio Type'} ==0 && @$crsRadiocr->{'Radio Type'} != ""  ? 'selected' : ''}}>CRS / सीआरएस</option>
        <option value="1"{{@$crsRadiocr->{'Radio Type'} ==1 && @$crsRadiocr->{'Radio Type'} != ""  ? 'selected' : ''}} >PVT. FM / प्राइवेट. एफएम</option>
        
      </select>
    </div>
  </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Target Area / लक्षित इलाका <font color="red">*</font>
        </label>
        <select {{$disabled }} name="crsRadioTargetArea" id="crsRadioTargetArea" class="form-control form-control-sm">
          <option value="">Select Target Area </option>
          <option value="0" {{@$crsRadiocr->{'Target Area'} == "0" && @$crsRadiocr->{'Target Area'} != ""  ? 'selected' : ''}}>PAN India</option>
          <option value="1" {{@$crsRadiocr->{'Target Area'} == "1" && @$crsRadiocr->{'Target Area'} != ""  ? 'selected' : ''}}>Specific Regional</option>
          <option value="2" {{@$crsRadiocr->{'Target Area'} == "2" && @$crsRadiocr->{'Target Area'} != ""  ? 'selected' : ''}}>Group Regional</option>
        </select>
      </div>
    </div>
    <!--------Start Tentative--------->
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Tentative budget/संभावित बजट<font color="red">*</font></label>
      <input {{ $disabled }} type="text" class="form-control form-control-sm" name="crsTentative_budget" maxlength="20" id="crsTentative_budget" placeholder="Enter Tentative Budget." onkeypress="return onlyNumberKey(event)" value="{{round(@$crsRadiocr->{'Budget Amount'}) && round(@$crsRadiocr->{'Budget Amount'})!=0 ? round(@$crsRadiocr->{'Budget Amount'}) :''}}">
    </div>
  </div><!--------end Tentative--------->
    <div class="col-md-4" id="crsRadioSpecificRegionDiv" style="display: none;">
      <div class="form-group">
        <label class="form-control-label">Specific Regional / क्षेत्रों का समूह <font color="red"></font>
        </label>
        <select {{$disabled }} name="crsRadioRegion[]" id="crsRadioSpecificRegion"  class="form-control form-control-sm">
          <option value="">Select Specific Regional</option>
          @foreach($regionalLang as $regionLang)
          <option value="{{$regionLang->Code}}" {{ 
          in_array( $regionLang->Code, str_replace(' ', '', $radioLangSelectionData )) ? 'selected' : '' }}>{{$regionLang->Code}} ~ {{$regionLang->Name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-4" id="crsRadioGroupRegionDiv" style="display: none;">
      <div class="form-group">
        <label class="form-control-label"> Group Regional / क्षेत्रों का समूह <font color="red"></font>
        </label>
        <select {{$disabled }} name="crsRadioRegion[]" id="crsRadioGroupRegion"  class="form-control form-control-sm" multiple>
         @foreach($regionalLang as $regionLang)
          <option value="{{$regionLang->Code}}" {{ 
          in_array( $regionLang->Code, str_replace(' ', '', $radioLangSelectionData )) ? 'selected' : '' }}>{{$regionLang->Code}} ~ {{$regionLang->Name}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Duration(in seconds) / अवधि (सेकंड में) <font color="red">*</font>
        <input {{$disabled}} type="text" id="crsRadioDuration" name="crsRadioDuration" value="{{@$crsRadiocr->{'Duration(Sec)'} ?? ''}}" class="form-control form-control-sm" placeholder="Enter Duration" onkeypress="return onlyNumberKey(event)">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Spots No./स्पॉट नंबर <font color="red">*</font>
        </label>
        <input {{$disabled}} type="text" name="crsRadioSpotsNo" id="crsRadioSpotsNo" value="{{ @$crsRadiocr->spots ?? ''}}" class="form-control form-control-sm" placeholder="Enter Spots No" onkeypress="return onlyNumberKey(event)">
      </div>
    </div>
    <!-- <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Genre / शैली <font color="red">*</label>
        <select {{$disabled }} name="crsRadioGeneral" id="crsRadioGeneral" class="form-control form-control-sm">
          <option value="">Select General </option>
          <option value="ZEE News" selected="selected">ZEE News</option>
        </select>
      </div>
    </div> -->
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label"> Requirement(s) (1000 characters max) / आवश्यकताएँ (अधिकतम 1000 वर्ण)</label>
        <textarea {{$disabled}} name="crsRadioRequirment" id="crsRadioRequirment" placeholder="Enter Requirement" rows="2" cols="50" class="form-control form-control-sm">{{@$crsRadiocr->{'Requirement'} ?? ''}}</textarea>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label"> Remarks (100 characters max) / रिमार्क्स (अधिकतम 100 वर्ण)</label>
        <textarea {{$disabled}} name="crsRadioRemark" id="crsRadioRemark" placeholder="Enter Remarks" rows="2" cols="50" class="form-control form-control-sm">{{@$crsRadiocr->{'Remarks'} ?? ''}}</textarea>
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Is creative available/क्या रचनात्मक उपलब्ध है? <font color="red">*</font></label>
        <select {{ $disabled }} name="crsRadioCreativeAvail" id="crsRadioCreativeAvail" class="form-control form-control-sm" >
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
        <label class="form-control-label">Upload creative/क्रिएटिव अपलोड करें<font color="red">*</font></label>
        <input {{ $disabled }} type="file" accept="audio/*" class="form-control form-control-sm" name="crsRadioCreativeFileName" id="crsRadioCreativeFileName" ><span id="upload_doc_error" class="error invalid-feedback"></span>
      </div>
    </div>
    @endif
    @if(@$crsRadiocr->{'Creative File Name'}!='' || @$crsRadiocr->{'Creative File Name'}!=null)
    <div class="col-md-4" id="crsRadioUploadCreativeDiv">
      <div class="form-group">
        <label class="form-control-label">Uploaded creative/क्रिएटिव अपलोड करें<font color="red">*</font></label>
        <audio  width="200" height="200" controls>
          <source src="{{ url('/uploads') }}/client-request/{{ $crsRadiocr->{'Creative File Name'} }}" type="audio/ogg">
          Your browser does not support the video tag.
        </audio >
      </div>
    </div>
    @endif
  </div>
