<div class="row">
    <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">From Date / दिनांक से<span style="color:red">*</span></label>
      <input {{ $disabled }} style="{{$style}}" type="text" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" name="tvfrom_date" id="tvfrom_date" value="{{ date('d/m/Y',strtotime(@$tvcr->{'From Date'})) && date('d/m/Y',strtotime(@$tvcr->{'From Date'}))!='01/01/1970' ? date('d/m/Y',strtotime(@$tvcr->{'From Date'})) :'' }}" placeholder="DD/MM/YYYY" autocomplete="off">
      <span id="date_error" style="color:red;display: none;"></span>
    </div>
  </div>    
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">To Date / दिनांक तक<span style="color:red">*</span></label>
      <input {{ $disabled }} style={{ $style }} type="text" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" name="tvto_date" id="tvto_date" value="{{ date('d/m/Y',strtotime(@$tvcr->{'To Date'})) && date('d/m/Y',strtotime(@$tvcr->{'To Date'}))!='01/01/1970' ? date('d/m/Y',strtotime(@$tvcr->{'To Date'})):'' }}" placeholder="DD/MM/YYYY" autocomplete="off">
      <span id="date_error" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Target Area / लक्षित इलाका <span style="color:red">*</span>
        </label>
        <select {{$disabled}} name="tvTargetArea" id="tvTargetArea" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">
          <option value="">Select Target Area </option>
          <option value="0" {{@$tvcr->{'Target Area'} == "0" && @$tvcr->{'Target Area'} != ""  ? 'selected' : ''}}>National</option>
         <!--  <option value="1" {{@$tvcr->{'Target Area'} == "1" && @$tvcr->{'Target Area'} != ""  ? 'selected' : ''}}>Specific Regional</option> -->
          <option value="1" {{@$tvcr->{'Target Area'} == "1" && @$tvcr->{'Target Area'} != ""  ? 'selected' : ''}}>Regional</option>
        </select>
      </div>
    </div>
    <!--------Start Tentative--------->
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Budget/संभावित बजट<span style="color:red">*</span></label>
      <input {{ $disabled }} type="text" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" name="tvTentative_budget" maxlength="20" id="tvTentative_budget" placeholder="Enter Budget" onkeypress="return onlyNumberKey(event)" value="{{round(@$tvcr->{'Allocated Budget'}) && round(@$tvcr->{'Allocated Budget'})!=0 ? IND_money_format(@$tvcr->{'Allocated Budget'}) :''}}">
    </div>
  </div><!--------end Tentative--------->
    
    <div class="col-md-4" id="tvGroupRegionDiv" style="display: none;">
      <div class="form-group">
        <label class="form-control-label"> Group Regional / क्षेत्रों का समूह <span style="color:red">*</span>
        </label>
        <select {{$disabled}} name="tvRegion[]" id="tvGroupRegion"  class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" multiple>
         @foreach($regionalLang as $regionLang)
          <option value="{{$regionLang->Code}}" {{ 
          in_array( $regionLang->Code, str_replace(' ', '', $tvLangSelectionData )) ? 'selected' : '' }}>{{$regionLang->Code}} ~ {{$regionLang->Name}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Duration(in seconds) / अवधि (सेकंड में) <span style="color:red">*</span>
        <input type="text" {{$disabled}} id="tvDuration" name="tvDuration" value="{{@$tvcr->{'Duration'} ?? ''}}" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" placeholder="Enter Duration" onkeypress="return onlyNumberKey(event)">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Number of Spot/स्पॉट की संख्या<span style="color:red">*</span>
        </label>
        <input type="text" {{$disabled}} name="tvSpotsNo" id="tvSpotsNo" value="{{@$tvcr->{'Spot Per Day'} ?? ''}}" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" placeholder="Enter Spots No" onkeypress="return onlyNumberKey(event)">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Genre / शैली <span style="color:red">*</span></label>
        <select {{$disabled}} name="tvGener" id="tvGener" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">
          <option value="" {{@$tvcr->{'Genre Category'} =='' ? 'selected':'' }}>Select Genre </option>
          <option value="0" {{@$tvcr->{'Genre Category'} =='0' ? 'selected':'' }}>Both</option>
          <option value="1" {{@$tvcr->{'Genre Category'} =='1' ? 'selected':'' }}>GEC</option>
          <option value="2" {{@$tvcr->{'Genre Category'} =='2' ? 'selected':'' }}>Non-GEC</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label"> Caption (1000 characters max) / आवश्यकताएँ (अधिकतम 1000 वर्ण)</label>
        <textarea {{$disabled}} name="tvRequirment" id="tvRequirment" placeholder="Enter Requirement" rows="2" cols="50" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">{{@$tvcr->{'Requirement'} ?? ''}}</textarea>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label"> Remarks (100 characters max) / रिमार्क्स (अधिकतम 100 वर्ण)</label>
        <textarea {{$disabled}} name="tvRemark" id="tvRemark" placeholder="Enter Remarks" rows="2" cols="50" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">{{@$tvcr->{'Remarks'} ?? ''}}</textarea>
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Is Advertisement Available/क्या रचनात्मक उपलब्ध है? <span style="color:red">*</span></label>
        <select {{$disabled}}  name="tvCreativeAvail" id="tvCreativeAvail" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" >
          <option value="">Select any one option</option>
          <option value="0" {{@$tvcr->{'Creative Available'} == 0 && @$tvcr->{'Creative Available'} != ""  ? 'selected' : ''}}>Available</option>
          <option value="1" {{@$tvcr->{'Creative Available'} == 1 && @$tvcr->{'Creative Available'} != ""  ? 'selected' : ''}}>Not Available</option>
        <!--   <option value="2" {{@$tvcr->{'Creative Available'} == 2 && @$tvcr->{'Creative Available'} != ""  ? 'selected' : ''}}>Creative to be developed by CBC</option>
          <option value="3" {{@$tvcr->{'Creative Available'} == 3 && @$tvcr->{'Creative Available'} != ""  ? 'selected' : ''}}>Photographs Available</option> -->
        </select>
      </div>
    </div>
    @if(@$tvcr->{'Creative File Name'}=='' || @$tvcr->{'Creative File Name'}==null)
    <div class="col-md-4" id="tvUploadCreativeDiv">
      <div class="form-group">
        <label class="form-control-label">Upload Advertisement/विज्ञापन अपलोड करें<span style="color:red">*</span></label>
        <input {{ $disabled }} type="file" accept="video/*" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" name="tvCreativeFileName" id="tvCreativeFileName"  >
      </div>
    </div>
    @endif
    @if(@$tvcr->{'Creative File Name'}!='' || @$tvcr->{'Creative File Name'}!=null)
    <div class="col-md-4" id="tvUploadCreativeDiv">
      <div class="form-group">
        <label class="form-control-label">Uploaded Advertisement/अपलोड किया गया विज्ञापन<span style="color:red">*</span></label>
        <video width="200" height="200" controls>
          <source src="{{ url('/uploads') }}/client-request/{{ $tvcr->{'Creative File Name'} }}" type="video/mp4">
          Your browser does not support the video tag.
        </video>

       
      </div>
    </div>
    @endif
  </div>
