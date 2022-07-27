<span style="color:red;">* Upload documents only in PDF, Max Size 2MB should not exceed.<br>
  &nbsp;&nbsp;Profile picture & scanned signature of partner in JPG/PNG.(For signature, upload the image either with white or transparent background.) </span>


<fieldset class="fieldset-border">
  <legend>Please Upload Documents</legend>
  <div class="row">
    <div class="col-md-6">
      @php
      $speciman_copy = '';
      if (@count($owner_other_publications)>0 && $owner_other_publications != '') {
      $speciman_copy = 'Upload 4 Month Specimen Copy  / 4 महीने की नमूना प्रति अपलोड करें ';
      } else {
      if (@$vendor_datas->{'Periodicity'} == 0 || @$vendor_datas->{'Periodicity'} == 1 || @$vendor_datas->{'Periodicity'} == 2){
      $speciman_copy = 'Upload specimen copies of latest 10 days  / नवीनतम 10 दिनों की नमूना प्रतियां अपलोड करें ';
      }
      else if (@$vendor_datas->{'Periodicity'} == 3 || @$vendor_datas->{'Periodicity'} == 4 ){
        $speciman_copy = 'Upload specimen copies of latest 4 issues  / नवीनतम 4 मुद्दों की नमूना प्रतियां अपलोड करें ';
      }
      else if (@$vendor_datas->{'Periodicity'} == 5){
        $speciman_copy = 'Upload specimen copies of latest 2 issues  / नवीनतम 2 मुद्दों की नमूना प्रतियां अपलोड करें ';
      } 
      else if (@$vendor_datas->{'Periodicity'} == 6){
        $speciman_copy = 'Upload specimen copies of latest 1 issues  / नवीनतम 1 अंक की नमूना प्रतियां अपलोड करें ';
      } 
       else {
        $speciman_copy = 'Upload 1 Year Specimen Copy  / 1 साल का नमूना कॉपी अपलोड करें ';
      }
      }
      @endphp
      <div class="form-group">
        <label for="specimen_copy_file_name1">{{$speciman_copy}}</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="specimen_copy_file_name" id="specimen_copy_file_name" {{ @$read }} accept="application/pdf">
            <label class="custom-file-label" for="specimen_copy_file_name" id="specimen_copy_file_name2">{{ @$np_rate_renewal->{'Specimen Copy File Name'} ? $np_rate_renewal->{'Specimen Copy File Name'} : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="specimen_copy_file_name3">Upload</span>
          </div>

          @if(@$np_rate_renewal->{'Specimen Copy File Name'} != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'Specimen Copy File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="specimen_copy_file_name1" class="error invalid-feedback"></span>
        <span id="specimen_copy_file_name_modify1" class="error invalid-feedback"></span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="declaration_field_file_name1">Copy of declaration filled by before DM/DCP or other competent authority  /
        डीएम/डीसीपी या अन्य सक्षम प्राधिकारी के समक्ष घोषणा क्षेत्र की प्रति </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="declaration_field_file_name" id="declaration_field_file_name" {{ @$read }} accept="application/pdf">
            <label class="custom-file-label" for="declaration_field_file_name" id="declaration_field_file_name2">{{ @$np_rate_renewal->{'Decl_ Filed Before File Name'} ? $np_rate_renewal->{'Decl_ Filed Before File Name'} : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="declaration_field_file_name3">Upload</span>
          </div>
          @if(@$np_rate_renewal->{'Decl_ Filed Before File Name'} != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'Decl_ Filed Before File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="declaration_field_file_name1" class="error invalid-feedback"></span>
        <span id="declaration_field_file_name_modify1" class="error invalid-feedback"></span>
      </div>
    </div>
  </div>
  <div class="row">
   
    <div class="col-md-6" hidden>
      <div class="form-group"> <br>
        <label for="pan_copy_file_name1">Owner’s PAN Number self-attested copy  / पैन नंबर सेल्फ अटेस्टेड कॉपी </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="pan_copy_file_name" id="pan_copy_file_name" {{ @$read }} accept="application/pdf">
            <label class="custom-file-label" for="pan_copy_file_name" id="pan_copy_file_name2">{{ @$vendor_datas->{'PAN Copy File Name'} ? $vendor_datas->{'PAN Copy File Name'} : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="pan_copy_file_name3">Upload</span>
          </div>
          @if(@$vendor_datas->{'PAN Copy File Name'} != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'PAN Copy File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="pan_copy_file_name1" class="error invalid-feedback"></span>
        <span id="pan_copy_file_name_modify1" class="error invalid-feedback"></span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="rni_reg_file_name1">RNI (self-attested) registration certificate / आरएनआई (स्व-सत्यापित) पंजीकरण प्रमाण पत्र </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="rni_reg_file_name" {{ @$read }} id="rni_reg_file_name" accept="application/pdf">
            <label class="custom-file-label" for="rni_reg_file_name" id="rni_reg_file_name2">{{ @$np_rate_renewal->{'RNI Reg File Name'} ? @$np_rate_renewal->{'RNI Reg File Name'} : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="rni_reg_file_name3">Upload</span>
          </div>
          @if(@$np_rate_renewal->{'RNI Reg File Name'} != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'RNI Reg File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="rni_reg_file_name1" class="error invalid-feedback"></span>
        <span id="rni_reg_file_name_modify1" class="error invalid-feedback"></span>
      </div>
    </div>
    <div class="col-md-6"><br>
      @php
      $show_data = 'hide-msg';
      if($company_change_add == 1){
      $show_data = '';
      }
      @endphp
      <div class="form-group {{ $show_data }}" id="change_info_doc">
        <label for="change_in_address_file_name1">Change of information for existing company  / मौजूदा कंपनी के लिए सूचना का परिवर्तन </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="change_in_address_file_name" id="change_in_address_file_name" {{ @$read }} accept="application/pdf">
            <label class="custom-file-label" for="change_in_address_file_name" id="change_in_address_file_name2">{{ trim(@$vendor_datas->{'Change in address File Name'}) ? $vendor_datas->{'Change in address File Name'} : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="change_in_address_file_name3">Upload</span>
          </div>

          @if(@$company_change_add == '1')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'Change in address File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="change_in_address_file_name1" class="error invalid-feedback"></span>
        <span id="change_in_address_file_name_modify1" class="error invalid-feedback"></span>
      </div>
    </div>
  </div>
  <div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="annexure_file_name1">Annexure – A (Signed by C.A) / अनुलग्नक - ए (सीए द्वारा हस्ताक्षरित)</label>
      <div class="input-group">
        
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="annexure_file_name" id="annexure_file_name" {{ $read }} accept="application/pdf">
          <label class="custom-file-label" for="annexure_file_name" id="annexure_file_name2">{{ @$np_rate_renewal->{'Annexure File Name'} ? @$np_rate_renewal->{'Annexure File Name'} : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="annexure_file_name3">Upload</span>
        </div>
       
        @if(@$np_rate_renewal->{'Annexure - XII_A'} == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal->{'Annexure File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          <input type="hidden" name="annexure_filename" id="annexure_filename" value="{{ @$np_rate_renewal->{'Annexure File Name'} }}">
        </div>
        @endif
      </div>
      <span id="annexure_file_name1" class="error invalid-feedback"></span>
      <span id="annexure_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
  <div class="col-md-6" hidden>
      <div class="form-group">
        <label for="Circulation_File_Name1">Circulation File Upload  / सर्कुलेशन फ़ाइल अपलोड </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="Circulation_File_Name" id="Circulation_File_Name" {{ $read }} accept="application/pdf">
            <label class="custom-file-label" for="Circulation_File_Name" id="Circulation_File_Name2">{{ @$np_rate_renewal->{'Circulation File Name'} ? $np_rate_renewal->{'Circulation File Name'} : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="Circulation_File_Name3">Upload</span>
          </div>

          @if(@$np_rate_renewal->{'Circulation File Name'} != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal->{'Circulation File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="Circulation_File_Name1" class="error invalid-feedback"></span>
        <span id="Circulation_File_Name_modify1" class="error invalid-feedback"></span>
      </div>
    </div>
  <div class="col-md-6" >
    <div class="form-group">
      <label for="annual_return_file_name1">Copy of annual return form-2 submitted to RNI along with receiving proof(2021-2022)  / प्रमाण प्राप्त करने के साथ आरएनआई को जमा किए गए वार्षिक रिटर्न फॉर्म -2 की प्रति(2021-2022) </label>
      <br>
      <div class="input-group">
       
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="annual_return_file_name" id="annual_return_file_name" {{$read}} accept="application/pdf">
          <label class="custom-file-label" for="annual_return_file_name" id="annual_return_file_name2">{{ @$np_rate_renewal->{'Annual Return RNI File Name'} ? @$np_rate_renewal->{'Annual Return RNI File Name'} : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="annual_return_file_name3">Upload</span>
        </div>
       
        @if(@$np_rate_renewal->{'Annual Return Submitted to RNI'} == '1')
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal->{'Annual Return RNI File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="annual_return_file_name1" class="error invalid-feedback"></span>
      <span id="annual_return_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
  </div>
  <div class="row">
    
    @php
    $gst_field = 'hide-msg';
    if(@$np_rate_renewal->{'GST No_'} !='' || @$np_rate_renewal->{'GST FileName'} !=''){
    $gst_field = '';
    }
    @endphp
    <div class="col-md-6 {{$gst_field}}" id="gst_reg_file" hidden>
      <div class="form-group">
        <label for="gst_reg_cert_file_name1" style="width: 100%"> GST registration certificate  / जीएसटी पंजीकरण प्रमाणपत्र </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="gst_reg_cert_file_name" id="gst_reg_cert_file_name" {{ @$read }} accept="application/pdf">
            <label class="custom-file-label" for="gst_reg_cert_file_name" id="gst_reg_cert_file_name2">{{ @$np_rate_renewal->{'GST FileName'} ? $np_rate_renewal->{'GST FileName'} : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="gst_reg_cert_file_name3">Upload</span>
          </div>
          @if(@$np_rate_renewal->{'GST FileName'} != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal->{'GST FileName'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="gst_reg_cert_file_name1" class="error invalid-feedback"></span>
        <span id="gst_reg_cert_file_name_modify1" class="error invalid-feedback"></span>
      </div>
    </div>
   
  </div>
  <div class="row">
    @php
    $noDues = 'hide-msg';
    if(@$np_rate_renewal->{'No Dues Certificate'} == 1 || $solid_circulation > 25000){
    $noDues = '';
    }
    @endphp
    <div class="col-md-6 " id="no_dues_cert"><br>
      <div class="form-group">
        <label for="no_dues_cert_file_name1">No dues certificates of press council of India for the last financial year Registration  / पिछले वित्तीय वर्ष के पंजीकरण के लिए भारतीय प्रेस परिषद का कोई बकाया नहीं प्रमाण पत्र </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="no_dues_cert_file_name" id="no_dues_cert_file_name" accept="application/pdf" {{ $read }}>
            <label class="custom-file-label" for="no_dues_cert_file_name" id="no_dues_cert_file_name2">{{ @$np_rate_renewal->{'No Dues Cert File Name'} ? $np_rate_renewal->{'No Dues Cert File Name'} : 'Choose file' }}
            </label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="no_dues_cert_file_name3">Upload</span>
          </div>
          @if(@$np_rate_renewal->{'No Dues Cert File Name'} != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal->{'No Dues Cert File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="no_dues_cert_file_name1" class="error invalid-feedback"></span>
        <span id="no_dues_cert_file_name_modify1" class="error invalid-feedback"></span>
      </div>

    </div>

    <div class="col-md-6">
       <div class="form-group" id="abc_rni_cert" >
      <label for="circulation_cert_file_name1">Circulation certificate as per policy (self-attested) (if more than 25,000 than RNI/ABC is mandatory)  / पॉलिसी के अनुसार सर्कुलेशन सर्टिफिकेट (स्व-सत्यापित) (यदि आरएनआई/एबीसी से 25,000 से अधिक अनिवार्य है) </label>
      <div class="input-group">
      
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="circulation_cert_file_name" id="circulation_cert_file_name" {{$read}} accept="application/pdf">
          <label class="custom-file-label" for="circulation_cert_file_name" id="circulation_cert_file_name2">{{ @$np_rate_renewal->{'Circulation Cert File Name'} ? @$np_rate_renewal->{'Circulation Cert File Name'} : 'Choose file' }}</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="circulation_cert_file_name3">Upload</span>
        </div>
       
        @if(@$np_rate_renewal->{'Circulation Cert File Name'})
        <div class="input-group-append">
          <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal->{'Circulation Cert File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @endif
      </div>
      <span id="circulation_cert_file_name1" class="error invalid-feedback"></span>
      <span id="circulation_cert_file_name_modify1" class="error invalid-feedback"></span>
    </div>
  </div>
    @php
    $show_data1 = 'hide-msg';
    if(@$np_rate_renewal->{'DM Declaration'} == 1){
    $show_data1 = '';
    }
    @endphp
    <div class="col-md-6 {{$show_data1}}" id="dm_certificate">
      <div class="form-group">
        <label for="DMD_File_Name1">Latest DM certification uploaded in case of change ownership, printers, publisher, editor  /
          स्वामित्व, प्रिंटर, प्रकाशक, संपादक बदलने के मामले में नवीनतम डीएम प्रमाणीकरण अपलोड किया गया </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="DMD_File_Name" id="DMD_File_Name" {{ $read }} accept="application/pdf">
            <label class="custom-file-label" for="DMD_File_Name" id="DMD_File_Name2">{{ @$np_rate_renewal->{'DMD File Name'} ? $np_rate_renewal->{'DMD File Name'} : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="DMD_File_Name3">Upload</span>
          </div>

          @if(@$np_rate_renewal->{'DMD File Name'} != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal->{'DMD File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="DMD_File_Name1" class="error invalid-feedback"></span>
      </div>
    </div>


    <div class="col-md-6" id="profile_picture">
      <div class="form-group">
        <label for="profile_picture1">Profile picture / प्रोफ़ाइल फोटो </label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-img" name="profile_picture" id="profile_picture" {{ $read }} accept="image/png,image/jpeg">
            <label class="custom-file-label" for="profile_picture" id="profile_picture2">{{ @$np_rate_renewal->{'Profile pic'} ? $np_rate_renewal->{'Profile pic'} : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="profile_picture3">Upload</span>
          </div>

          @if(@$np_rate_renewal->{'Profile pic'} != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal->{'Profile pic'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="profile_picture1" class="error invalid-feedback"></span>
      </div>
    </div>

    <div class="col-md-6" id="vendor_scan_signature">
      <div class="form-group">
        <label for="vendor_scan_signature1">Scanned signature of partner / पार्टनर का स्कैन किया हुआ हस्ताक्षर</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-img" name="vendor_scan_signature" id="vendor_scan_signature" {{ $read }} accept="image/png,image/jpeg">
            <label class="custom-file-label" for="vendor_scan_signature" id="vendor_scan_signature2">{{ @$np_rate_renewal->{'Vendor Scan signature'} ? $np_rate_renewal->{'Vendor Scan signature'} : 'Choose file' }}</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text" id="vendor_scan_signature3">Upload</span>
          </div>

          @if(@$np_rate_renewal->{'Vendor Scan signature'} != '')
          <div class="input-group-append">
            <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal->{'Vendor Scan signature'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
          </div>
          @endif
        </div>
        <span id="vendor_scan_signature1" class="error invalid-feedback"></span>
      </div>
    </div>

   
  </div>
</fieldset>
<div class="col-md-12">
  <div class="form-group">
    <div class="icheck-success d-inline">
      <input type="checkbox" name="advertisement_policy" id="advertisement_policy" {{ $policy_check }} {{ $read }}>
      <label for="advertisement_policy">I affirm that all the information given by me is true and nothing has been concealed./ मैं पुष्टि करता हूं कि मेरे द्वारा दी गई सभी जानकारी सत्य है और कुछ भी छुपाया नहीं गया है। <a href="http://davp.nic.in/writereaddata/Final_Print_Media_Advt_Policy_Revision_dated_23072020.pdf" target="_blank">Print Media Advertisement Policy of the Government of India - 2020.</a><font color="red">*</font>

      </label>
    </div>
  </div>
</div>
<input type="hidden" name="doc[]" id="doc_data">
<input type="hidden" name="submit_btn" id="submit_btn" value="0">
<input type="hidden" name="newspaper_code" id="newspaper_code" value="{{ @$vendor_datas->{'Newspaper Code'} ?? ''}}">
<input type="hidden" name="modified" id="modified" value="{{ $read ? 1:''}}">
<div class="col-sm-12 text-right" style="padding: 0;">
  <a class="btn btn-primary reg-previous-button previousClass btn-sm m-0"><i class="fa fa-caret-left"></i> Previous</a>
  @if(@$read =='')
  <a class="btn btn-primary next-button btn-sm m-0" id="print_renewal" {{ $read }}> <i class="fa fa-save"></i> Submit</a>
  @endif
</div>
