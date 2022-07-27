<div class="col-md-6">
  <div class="form-group">
    <label for="Notarized_Copy_File_Name1">
      <div class="tool_tip"> Notarized Copy of Agreement / समझौते की नोटरीकृत प्रति <i class="fa fa-info-circle"></i>
        <font color="red">*</font>
        <span class="tooltip_text">
          <p>Notarized copy of agreement with sole rights authority. The agreement should contain the following details:</p>
          <p>
            i. License fees paid to the sole rights authority.<br>
            ii. Validity of sole rights.<br>
            iii. Location, quantity, size and illumination of media.
          </p>
          <p>
            <b>Note</b>: In case any of the above details are not mentioned in the agreement, the same should be certified separately by the <b>sole rights authority</b> and submitted with the application.
          </p>
          <p>
            <b>Note</b>: If agreement will not be executed, notarized allotment letter or similar document from sole right authority containing the above details should be submitted along with a self-certified letter by the agency that as per the terms and conditions of the contract with the sole rights authority agreement will not be submitted.
          </p>
        </span>
      </div>
    </label>
    <div class="input-group">
      @if(@$vendor_data[0]['Notarized Copy File Name'] != '')
      <div class="custom-file">
        <input type="file" name="Notarized_Copy_File_Name_modify" class="custom-file-input" id="Notarized_Copy_File_Name" accept="application/pdf">
        <label class="custom-file-label" id="Notarized_Copy_File_Name2" for="Notarized_Copy_File_Name">{{@$vendor_data[0]['Notarized Copy File Name'] != '' ? $vendor_data[0]['Notarized Copy File Name'] : 'Choose file'}}</label>
      </div>
      @else
      <div class="custom-file">
        <input type="file" name="Notarized_Copy_File_Name" class="custom-file-input" id="Notarized_Copy_File_Name" accept="application/pdf">
        <label class="custom-file-label" id="Notarized_Copy_File_Name2" for="Notarized_Copy_File_Name">Choose file</label>
      </div>
      @endif

      @if(@$vendor_data[0]['Notarized Copy File Name'] != '')
      <div class="input-group-append">
        <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Notarized Copy File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;"></i></a></span>
      </div>
      @else
      <div class="input-group-append">
        <span class="input-group-text" id="Notarized_Copy_File_Name3">Upload</span>
      </div>
      @endif
    </div>
    <span id="Notarized_Copy_File_Name1" class="error invalid-feedback"></span>
    <span id="Notarized_Copy_File_Name_modify1" class="error invalid-feedback"></span>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label for="Affidavit_File_Name1">
      <div class="tool_tip">
        Affidavit of Oath / शपथ का शपथ पत्र (<a href="{{asset('uploads/footer_document/AFFIDAVIT.pdf')}}" download="Affidavit Certificate"><i class="fa fa-download" aria-hidden="true"></i> Sample Certificate</a>) <i class="fa fa-info-circle"></i>
        <font color="red">*</font>
        <span class="tooltip_text">On stamp paper of Rs. 100 as per the performa provided in the application.</span>
      </div>
    </label>
    <div class="input-group">
      @if(@$vendor_data[0]['Affidavit File Name'] != '')
      <div class="custom-file">
        <input type="file" name="Affidavit_File_Name_modify" class="custom-file-input" id="Affidavit_File_Name" accept="application/pdf">
        <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">{{@$vendor_data[0]['Affidavit File Name'] != '' ? $vendor_data[0]['Affidavit File Name'] : 'Choose file'}}</label>
      </div>
      @else
      <div class="custom-file">
        <input type="file" name="Affidavit_File_Name" class="custom-file-input" id="Affidavit_File_Name" accept="application/pdf">
        <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">Choose file</label>
      </div>
      @endif

      @if(@$vendor_data[0]['Affidavit File Name'] != '')
      <div class="input-group-append">
        <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Affidavit File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;"></i></a></span>
      </div>
      @else
      <div class="input-group-append">
        <span class="input-group-text" id="Affidavit_File_Name3">Upload</span>
      </div>
      @endif
    </div>
    <span id="Affidavit_File_Name1" class="error invalid-feedback"></span>
    <span id="Affidavit_File_Name_modify1" class="error invalid-feedback"></span>
  </div>
</div>
<!-- <div class="col-md-6">
  <div class="form-group">
    <label for="Categorization_of_Media1">
      <div class="tool_tip"> Categorization of Media (Only PDF) / मीडिया का वर्गीकरण (केवल पीडीएफ) <i class="fa fa-info-circle"></i>
        <font color="red">*</font>
        <span class="tooltip_text">If the number of properties in a particular city/cluster/zone in an agreement is more than fifty (50), then provide a categorization of the media with differential rates offered to BOC based on visibility of individual locations along with documentary proof.</span>
      </div>
    </label>
    <div class="input-group">
      @if(@$vendor_data[0]['Categorization of Media File'] != '')
      <div class="custom-file">
        <input type="file" name="Categorization_of_Media_modify" class="custom-file-input" id="Categorization_of_Media" accept="application/pdf">
        <label class="custom-file-label" id="Categorization_of_Media2" for="Categorization_of_Media">{{@$vendor_data[0]['Categorization of Media File'] != '' ? $vendor_data[0]['Categorization of Media File'] : 'Choose file'}}</label>
      </div>
      @else
      <div class="custom-file">
        <input type="file" name="Categorization_of_Media" class="custom-file-input" id="Categorization_of_Media" accept="application/pdf">
        <label class="custom-file-label" id="Categorization_of_Media2" for="Categorization_of_Media">Choose file</label>
      </div>
      @endif

      @if(@$vendor_data[0]['Categorization of Media File'] != '')
      <div class="input-group-append">
        <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Categorization of Media File'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;"></i></a></span>
      </div>
      @else
      <div class="input-group-append">
        <span class="input-group-text" id="Categorization_of_Media3">Upload</span>
      </div>
      @endif
    </div>
    <span id="Categorization_of_Media1" class="error invalid-feedback"></span>
    <span id="Categorization_of_Media_modify1" class="error invalid-feedback"></span>
  </div>
</div> -->
<div class="col-md-6">
  <div class="form-group">
    <label for="Last_License_Fee_Paid1">
      <div class="tool_tip">Latest License Fees Paid / नवीनतम लाइसेंस शुल्क का भुगतान <i class="fa fa-info-circle"></i>
        <font color="red">*</font>
        <span class="tooltip_text">Notarized copy of the receipt of the last License fee paid to the sole rights authority.</span>
      </div>
    </label>
    <div class="input-group">
      @if(@$vendor_data[0]['Last License Fee Paid File'] != '')
      <div class="custom-file">
        <input type="file" name="Last_License_Fee_Paid_modify" class="custom-file-input" id="Last_License_Fee_Paid" accept="application/pdf">
        <label class="custom-file-label" id="Last_License_Fee_Paid2" for="Last_License_Fee_Paid">{{@$vendor_data[0]['Last License Fee Paid File'] != '' ? $vendor_data[0]['Last License Fee Paid File'] : 'Choose file'}}</label>
      </div>
      @else
      <div class="custom-file">
        <input type="file" name="Last_License_Fee_Paid" class="custom-file-input" id="Last_License_Fee_Paid" accept="application/pdf">
        <label class="custom-file-label" id="Last_License_Fee_Paid2" for="Last_License_Fee_Paid">Choose file</label>
      </div>
      @endif

      @if(@$vendor_data[0]['Last License Fee Paid File'] != '')
      <div class="input-group-append">
        <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Last License Fee Paid File'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;"></i></a></span>
      </div>
      @else
      <div class="input-group-append">
        <span class="input-group-text" id="Last_License_Fee_Paid3">Upload</span>
      </div>
      @endif
    </div>
    <span id="Last_License_Fee_Paid1" class="error invalid-feedback"></span>
    <span id="Last_License_Fee_Paid_modify1" class="error invalid-feedback"></span>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label for="Rate_Offered_to_BOC1">
      <div class="tool_tip"> Justification of Rate Offered to CBC / सीबीसी को दी जाने वाली दर <i class="fa fa-info-circle"></i>
        <font color="red">*</font>
        <span class="tooltip_text">Elaborate justification/rationale for the rates (along with documentary proof) sought from CBC, on the agency/company letter head. </span>
      </div>
    </label>
    <div class="input-group">
      @if(@$vendor_data[0]['Rate Offered to BOC File'] != '')
      <div class="custom-file">
        <input type="file" name="Rate_Offered_to_BOC_modify" class="custom-file-input" id="Rate_Offered_to_BOC" accept="application/pdf">
        <label class="custom-file-label" id="Rate_Offered_to_BOC2" for="Rate_Offered_to_BOC">{{@$vendor_data[0]['Rate Offered to BOC File'] != '' ? $vendor_data[0]['Rate Offered to BOC File'] : 'Choose file'}}</label>
      </div>
      @else
      <div class="custom-file">
        <input type="file" name="Rate_Offered_to_BOC" class="custom-file-input" id="Rate_Offered_to_BOC" accept="application/pdf">
        <label class="custom-file-label" id="Rate_Offered_to_BOC2" for="Rate_Offered_to_BOC">Choose file</label>
      </div>
      @endif
      @if(@$vendor_data[0]['Rate Offered to BOC File'] != '')
      <div class="input-group-append">
        <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Rate Offered to BOC File'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;"></i></a></span>
      </div>
      @else
      <div class="input-group-append">
        <span class="input-group-text" id="Rate_Offered_to_BOC3">Upload</span>
      </div>
      @endif
    </div>
    <span id="Rate_Offered_to_BOC1" class="error invalid-feedback"></span>
    <span id="Rate_Offered_to_BOC_modify1" class="error invalid-feedback"></span>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label for="Certified_Media_List_File_Name1">
    <div class="tool_tip"> Certified Media List / प्रमाणित मीडिया सूची
        <i class="fa fa-info-circle"></i>
        <font color="red">*</font>
        <span class="tooltip_text">
          i) Location, quantity, size and illumination of media.<br>
          ii) In case this information is available in the agreement, only the corresponding pages of the agreement should be uploaded.<br>
          iii) In case any of the above details are not mentioned in the agreement, the same should be certified separately by the sole rights authority and submitted with the application.
        </span>
      </div>
    </label>
    <div class="input-group">
      @if(@$vendor_data[0]['Certified Media List File Name'] != '')
      <div class="custom-file">
        <input type="file" name="Certified_Media_List_File_Name_modify" class="custom-file-input" id="Certified_Media_List_File_Name" accept="application/pdf">
        <label class="custom-file-label" id="Certified_Media_List_File_Name2" for="Certified_Media_List_File_Name">{{@$vendor_data[0]['Certified Media List File Name'] != '' ? $vendor_data[0]['Certified Media List File Name'] : 'Choose file'}}</label>
      </div>
      @else
      <div class="custom-file">
        <input type="file" name="Certified_Media_List_File_Name" class="custom-file-input" id="Certified_Media_List_File_Name" accept="application/pdf">
        <label class="custom-file-label" id="Certified_Media_List_File_Name2" for="Certified_Media_List_File_Name">Choose file</label>
      </div>
      @endif
      @if(@$vendor_data[0]['Certified Media List File Name'] != '')
      <div class="input-group-append">
        <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Certified Media List File Name'] }}" target="_blank"><i class="fa fa-eye" style="font-size:17px;"></i></a></span>
      </div>
      @else
      <div class="input-group-append">
        <span class="input-group-text" id="Certified_Media_List_File_Name3">Upload</span>
      </div>
      @endif
    </div>
    <span id="Certified_Media_List_File_Name1" class="error invalid-feedback"></span>
    <span id="Certified_Media_List_File_Name_modify1" class="error invalid-feedback"></span>
  </div>
</div>
