<div class="row">
  <div class="col-md-12">
    <p id="blink">Physical Submission of Documents are Also Required at CBC.</p>
    <span style="color:red;">* Upload documents only in PDF, Max Size 2MB and profile picture, scanned signature of vendor in JPG/PNG. For signature upload the image with white background or transparent.</span>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label for="annexure_file_name1">Annexure – A (Signed by CA)  / अनुलग्नक - ए (सीए द्वारा हस्ताक्षरित)  अधिकतम आकार 2MB<font color="red">*</font></label>
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Annexure - XII_A'] == '1') )
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="annexure_file_name_modify" id="annexure_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="annexure_file_name_modify" id="annexure_file_name_modify2">{{ @$vendordatas['Annexure File Name'] ? $vendordatas['Annexure File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="annexure_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="annexure_file_name" id="annexure_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="annexure_file_name" id="annexure_file_name2">{{ @$vendordatas['Annexure File Name'] ? $vendordatas['Annexure File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="annexure_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['Annexure - XII_A'] == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Annexure File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          <input type="hidden" name="annexure_filename" id="annexure_filename" value="{{ @$vendordatas['Annexure File Name'] }}">
        </div>
        @endif
      </div>
      <span id="annexure_file_name1" class="error invalid-feedback"></span>
      <span id="annexure_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
  <div class="col-md-6">
    @php
    $speciman_copy = '';
    if (@count($ownerotherdata)>=1 && $ownerotherdata != '') {
    $speciman_copy = 'Upload 4 month specimen copy  / 4 महीने की नमूना प्रति अपलोड करें ';
    } else {
    if (@$vendordatas['Periodicity'] == 0 || @$vendordatas['Periodicity'] == 1 || @$vendordatas['Periodicity'] == 2){
    $speciman_copy = 'Upload 6 month specimen copy  / 6 महीने की नमूना प्रति अपलोड करें ';
    } else {
    $speciman_copy = 'Upload 1 year specimen copy  / 1 साल का नमूना कॉपी अपलोड करें ';
    }
    }
    @endphp  
    <div class="form-group">
      <label for="specimen_copy_file_name1"> <span id="speciman_copy">{{$speciman_copy}}</span><font color="red">*</font>
      </label>
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Specimen Copies'] == '1') )
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="specimen_copy_file_name_modify" id="specimen_copy_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="specimen_copy_file_name_modify" id="specimen_copy_file_name_modify2">{{ @$vendordatas['Specimen Copy File Name'] ? $vendordatas['Specimen Copy File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="specimen_copy_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="specimen_copy_file_name" id="specimen_copy_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="specimen_copy_file_name" id="specimen_copy_file_name2">{{ @$vendordatas['Specimen Copy File Name'] ? $vendordatas['Specimen Copy File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="specimen_copy_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['Specimen Copies'] == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Specimen Copy File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="specimen_copy_file_name1" class="error invalid-feedback"></span>
      <span id="specimen_copy_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>

</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="declaration_field_file_name1">Copy of declaration field by before DM/DCP or other competent authority  /
        डीएम/डीसीपी या अन्य सक्षम प्राधिकारी के समक्ष घोषणा क्षेत्र की प्रति <font color="red">*</font></label>
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Declaration Filed Before Auth_'] == '1') )
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="declaration_field_file_name_modify" id="declaration_field_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="declaration_field_file_name_modify" id="declaration_field_file_name_modify2">{{ @$vendordatas['Decl_ Filed Before File Name'] ? $vendordatas['Decl_ Filed Before File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="declaration_field_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="declaration_field_file_name" id="declaration_field_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="declaration_field_file_name" id="declaration_field_file_name2">{{ @$vendordatas['Decl_ Filed Before File Name'] ? $vendordatas['Decl_ Filed Before File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="declaration_field_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['Declaration Filed Before Auth_'] == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Decl_ Filed Before File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="declaration_field_file_name1" class="error invalid-feedback"></span>
      <span id="declaration_field_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group"><br>
      <label for="pan_copy_file_name1">Owner’s PAN Number self-attested copy  / पैन नंबर सेल्फ अटेस्टेड कॉपी <font color="red">*</font></label>      
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['PAN Copy'] == '1') )
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="pan_copy_file_name_modify" id="pan_copy_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="pan_copy_file_name_modify" id="pan_copy_file_name_modify2">{{ @$vendordatas['PAN Copy File Name'] ? $vendordatas['PAN Copy File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="pan_copy_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="pan_copy_file_name" id="pan_copy_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="pan_copy_file_name" id="pan_copy_file_name2">{{ @$vendordatas['PAN Copy File Name'] ? $vendordatas['PAN Copy File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="pan_copy_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['PAN Copy'] == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['PAN Copy File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="pan_copy_file_name1" class="error invalid-feedback"></span>
      <span id="pan_copy_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group" id="no_dues_cert" style="display: none;"><br>
      <label for="no_dues_cert_file_name1">No dues certificates of press council of India for the last financial year registration  /
        पिछले वित्तीय वर्ष के पंजीकरण के लिए भारतीय प्रेस परिषद का कोई बकाया नहीं प्रमाण पत्र <font color="red">*</font></label>
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['No Dues Certificate'] == '1') )
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="no_dues_cert_file_name_modify" id="no_dues_cert_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="no_dues_cert_file_name_modify" id="no_dues_cert_file_name_modify2">{{ @$vendordatas['No Dues Cert File Name'] ? $vendordatas['No Dues Cert File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="no_dues_cert_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="no_dues_cert_file_name" id="no_dues_cert_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="no_dues_cert_file_name" id="no_dues_cert_file_name2">{{ @$vendordatas['No Dues Cert File Name'] ? $vendordatas['No Dues Cert File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="no_dues_cert_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['No Dues Certificate'] === '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['No Dues Cert File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="no_dues_cert_file_name1" class="error invalid-feedback"></span>
      <span id="no_dues_cert_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group {{$abc_cert}}" id="abc_rni_cert" style="display: none;">
      <label for="circulation_cert_file_name1">Circulation certificate as per policy (self-attested) (if more than 25,000 than RNI/ABC is mandatory)  / पॉलिसी के अनुसार सर्कुलेशन सर्टिफिकेट (स्व-सत्यापित) (यदि आरएनआई/एबीसी से 25,000 से अधिक अनिवार्य है) <font color="red">*</font></label>
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Circulation Certificate'] == '1'))
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="circulation_cert_file_name_modify" id="circulation_cert_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="circulation_cert_file_name_modify" id="circulation_cert_file_name_modify2">{{ @$vendordatas['Circulation Cert File Name'] ? $vendordatas['Circulation Cert File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="circulation_cert_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="circulation_cert_file_name" id="circulation_cert_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="circulation_cert_file_name" id="circulation_cert_file_name2">{{ @$vendordatas['Circulation Cert File Name'] ? $vendordatas['Circulation Cert File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="circulation_cert_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['Circulation Certificate'] == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Circulation Cert File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="circulation_cert_file_name1" class="error invalid-feedback"></span>
      <span id="circulation_cert_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6" id="rni_cert" style="display: none;">
    <div class="form-group">
      <label for="rni_reg_file_name1">RNI (self-attested) registration certificate  / आरएनआई (स्व-सत्यापित) पंजीकरण प्रमाणपत्र <font color="red">*</font></label>
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['RNI Registration Certificate'] == '1') )
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="rni_reg_file_name_modify" id="rni_reg_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="rni_reg_file_name_modify" id="rni_reg_file_name_modify2">{{ @$vendordatas['RNI Reg File Name'] ? $vendordatas['RNI Reg File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="rni_reg_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="rni_reg_file_name" id="rni_reg_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="rni_reg_file_name" id="rni_reg_file_name2">{{ @$vendordatas['RNI Reg File Name'] ? $vendordatas['RNI Reg File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="rni_reg_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['RNI Registration Certificate'] == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['RNI Reg File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="rni_reg_file_name1" class="error invalid-feedback"></span>
      <span id="rni_reg_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
  <div class="col-md-6" id="form2_rni_cert" style="display: none;">
    <div class="form-group">
      <label for="annual_return_file_name1">Copy of annual return form-2 submitted to RNI along with receiving proof  / प्रमाण प्राप्त करने के साथ आरएनआई को जमा किए गए वार्षिक रिटर्न फॉर्म -2 की प्रति <font color="red">*</font></label>
      <br>
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Annual Return Submitted to RNI'] == '1') )
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="annual_return_file_name_modify" id="annual_return_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="annual_return_file_name_modify" id="annual_return_file_name_modify2">{{ @$vendordatas['Annual Return File Name'] ? $vendordatas['Annual Return File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="annual_return_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="annual_return_file_name" id="annual_return_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="annual_return_file_name" id="annual_return_file_name2">{{ @$vendordatas['Annual Return File Name'] ? $vendordatas['Annual Return File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="annual_return_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['Annual Return Submitted to RNI'] == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Annual Return File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="annual_return_file_name1" class="error invalid-feedback"></span>
      <span id="annual_return_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="commercial_rate_file_name1">Copy of commercial rate card of the publication (1 Copy)  / प्रकाशन के वाणिज्यिक दर कार्ड की प्रति (1 प्रति) <font color="red">*</font></label>
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Commercial Rate'] == '1') )
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="commercial_rate_file_name_modify" id="commercial_rate_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="commercial_rate_file_name_modify" id="commercial_rate_file_name_modify2">{{ @$vendordatas['Commercial Rate File Name'] ? $vendordatas['Specimen Copy File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="commercial_rate_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="commercial_rate_file_name" id="commercial_rate_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="commercial_rate_file_name" id="commercial_rate_file_name2">{{ @$vendordatas['Commercial Rate File Name'] ? $vendordatas['Specimen Copy File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="commercial_rate_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['Commercial Rate'] == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Commercial Rate File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="commercial_rate_file_name1" class="error invalid-feedback"></span>
      <span id="commercial_rate_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group" id="gst_reg_file">
      <label for="gst_reg_cert_file_name1" style="width: 100%"> Owner’s GST registration certificate  / जीएसटी पंजीकरण प्रमाणपत्र <font color="red">*</font></label>
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['GST Registration Certificate'] == '1') )
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="gst_reg_cert_file_name_modify" id="gst_reg_cert_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="gst_reg_cert_file_name_modify" id="gst_reg_cert_file_name_modify2">{{ @$vendordatas['GST Reg Cert File Name'] ? $vendordatas['GST Reg Cert File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="gst_reg_cert_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="gst_reg_cert_file_name" id="gst_reg_cert_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="gst_reg_cert_file_name" id="gst_reg_cert_file_name2">{{ @$vendordatas['GST Reg Cert File Name'] ? $vendordatas['GST Reg Cert File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="gst_reg_cert_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['GST Registration Certificate'] == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['GST Reg Cert File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="gst_reg_cert_file_name1" class="error invalid-feedback"></span>
      <span id="gst_reg_cert_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    @php
    $show_data = 'hide-msg';
    if(@$vendordatas['Change In Company Address'] == 1){
    $show_data = '';
    }
    @endphp
    <div class="form-group {{ $show_data }}" id="change_info_doc">
      <label for="change_in_address_file_name1">Change of information for existing company  / मौजूदा कंपनी के लिए सूचना का परिवर्तन <font color="red">*</font></label>
      <div class="input-group">
        @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Change in address uploaded'] == '1') )
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="change_in_address_file_name_modify" id="change_in_address_file_name_modify" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="change_in_address_file_name_modify" id="change_in_address_file_name_modify2">{{ trim(@$vendordatas['Change in address File Name']) !='' ? $vendordatas['Change in address File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="change_in_address_file_name_modify3">Upload</span>
        </div>
        @else
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="change_in_address_file_name" id="change_in_address_file_name" {{$disabledall}} accept="application/pdf">
          <label class="custom-file-label" for="change_in_address_file_name" id="change_in_address_file_name2">{{ trim(@$vendordatas['Change in address File Name']) !='' ? $vendordatas['Change in address File Name'] : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="change_in_address_file_name3">Upload</span>
        </div>
        @endif
        @if(@$vendordatas['Change in address uploaded'] == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Change in address File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="change_in_address_file_name1" class="error invalid-feedback"></span>
      <span id="change_in_address_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-6" id="profile_picture">
      <div class="form-group">
        <label for="profile_picture1">Profile picture / प्रोफ़ाइल फोटो </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-img" name="profile_picture" id="profile_picture" {{$disabledall}} accept="image/png,image/jpeg">
            <label class="custom-file-label" for="profile_picture" id="profile_picture2">{{ @$vendordatas['Profile pic'] ? $vendordatas['Profile pic'] : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="profile_picture3">Upload</span>
          </div>

          @if(@$vendordatas['Profile pic'] != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Profile pic'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="profile_picture1" class="error invalid-feedback"></span>
      </div>
    </div>

    <div class="col-md-6" id="vendor_scan_signature">
      <div class="form-group">
        <label for="vendor_scan_signature1">Scanned signature of vendor / विक्रेता के स्कैन किए गए हस्ताक्षर </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-img" name="vendor_scan_signature" id="vendor_scan_signature" {{$disabledall}} accept="image/png,image/jpeg">
            <label class="custom-file-label" for="vendor_scan_signature" id="vendor_scan_signature2">{{ @$vendordatas['Vendor Scan signature'] ? @$vendordatas['Vendor Scan signature'] : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="vendor_scan_signature3">Upload</span>
          </div>

          @if(@$vendordatas['Vendor Scan signature'] != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Vendor Scan signature'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="vendor_scan_signature1" class="error invalid-feedback"></span>
      </div>
    </div>
</div>
<div class="col-md-12">
  <div class="form-group">
    <div class="icheck-success d-inline">
      <input type="checkbox" name="self_declaration" {{$disabledall}} id="self_declaration" <?= (@$vendordatas['Self Declaration'] == 1 ? "checked" : ""); ?>>
      <label for="self_declaration">Self Declaration / स्वयं घोषित<font color="red">*</font></label></label>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="form-group">
    <div class="icheck-success d-inline">
      <input type="checkbox" name="advertisement_policy" {{$disabledall}} id="advertisement_policy" {{ @$checked }}>
      <label for="advertisement_policy">I affirm that all the information given by me is true and nothing has been concealed./ मैं पुष्टि करता हूं कि मेरे द्वारा दी गई सभी जानकारी सत्य है और कुछ भी छुपाया नहीं गया है। <a href="http://davp.nic.in/writereaddata/Final_Print_Media_Advt_Policy_Revision_dated_23072020.pdf" target="_blank">Print Media Advertisement Policy of the Government of India - 2020.</a>
        <font color="red">*</font>
      </label>
    </div>
  </div>
</div>
<input type="hidden" name="doc[]" id="doc_data">
<input type="hidden" name="vendorid_tab_4" id="vendorid_tab_4" value="{{$vendordatas['Newspaper Code'] ?? ''}}" {{$disabledall}}>
<input type="hidden" name="submit_btn" id="submit_btn" value="0" {{$disabledall}}>

<div class="col-sm-12 text-right" style="padding: 0;">
<a class="btn btn-primary reg-previous-button previousClass  btn-sm m-0" data="12"><i class="fa fa-caret-left"></i>  Previous</a>
@if(@$disabledall =='')
<a id="sub_btn" class="btn btn-primary next-button  btn-sm m-0" {{$disabledall}}> <i class="fa fa-save"></i> Submit</a>
@endif
<span id="response_wait"></span>
</div>