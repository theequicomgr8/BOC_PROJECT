@extends('admin.layouts.layout')
<style>
  body {
    color: #6c757d !important;

    p,
    label {
      font: 1rem 'Fira Sans', sans-serif;
    }

    input {
      margin: .4rem;
    }
  }

  .multiselect-search {
    width: 100% !important;
    margin-right: 10px;
  }

  .dropdown-menu.show {
    display: block;
    width: 100% !important;
  }

  .multiselect-clear-filter {
    display: none !important;
  }

  .hide-msg {
    display: none !important;
  }

  .fa-check {
    color: green;
  }

  a.disabled {
    pointer-events: none;
  }

  .ui-datepicker-trigger {
    width: 25;
    height: 25;
    float: right;
    margin-top: -28px;
    margin-right: 4px;
  }
  .fieldset-border {
    border: solid 1px #ccc;
    padding: 10px;
    margin-bottom: 10px;
  }
  .fieldset-border legend {
    width: auto;
    padding: 0 10px;
    font-size: 16px;
    color: #007bff!important;
  }
  .remove-arrow-select {

    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
  }
  .remove-button {color: #fff !important;}
</style>
@section('content')
@php
$disabled= isset($disabled ) ? $disabled :'' ;
$crh=isset($client_req_header)? $client_req_header:'';
$prch=isset($print_client_req)? $print_client_req:'';
$codm=isset($clientOutdoorData)? $clientOutdoorData:[1];
$tvcr=isset($clientTVData)? $clientTVData:'';
$crsRadiocr=isset($clientRadioData)? $clientRadioData:'';
$mhead=isset($ministries_head) ? $ministries_head:'';
@$Client_ReqNo = $crh->{'Client Request No'};
@$print_reqid1 = @$prch->{'Client Request No_'};
$readonly = ' ';
$checked = ' ';
if(@$Client_Request_No != ''){
$readonly = 'readonly';

$checked = 'checked';
}
$emailreadonly = '';
if(@$email !=''){
$emailreadonly = 'readonly';
}
if(round(@$prch->{'Length'})==0){
$Length='' ;
}else{
$Length=@round(@$prch->{'Length'});
}
if(round(@$prch->{'Breadth'})==0){
$Breadth='' ;
}else{
$Breadth=round(@$prch->{'Breadth'});
}
if( round(@$prch->{'Size of Advt_'})==0){
$SizeofAdvt ='';
}else{
$SizeofAdvt = round(@$prch->{'Size of Advt_'});
}
if( @$prch->{'Plan Count'}==0){
$pcount='';

}else{
$pcount= @$prch->{'Plan Count'};
}
if(@$prch->{'From Date'}=='' ){
$fromDate='';

}else{
$fromDate= date('d-m-Y',strtotime(@$prch->{'From Date'}));
}
if(@$prch->{'To Date'}=='' ){
$toDate='';
}else{
$toDate= date('d-m-Y',strtotime(@$prch->{'To Date'}));
}
if($disabled=='disabled'){
$style="pointer-events:none;";

}else{
$style='';
}
$printCitySelectionData1 = (!empty($printCitySelectionData)) ? explode(',', $printCitySelectionData):[];
$printStateSelectionData1 = (!empty($printStateSelectionData)) ? explode(',', $printStateSelectionData):[];
$langSelectionData1 = (!empty($langSelectionData))?explode(',', $langSelectionData):[];

$tvLangSelectionData =(!empty($tvLangSelectionData))? explode(',', $tvLangSelectionData):[];
$radioLangSelectionData=(!empty($radioLangSelectionData))? explode(',', $radioLangSelectionData):[];
$fmStateSelectionData=(!empty($fmStateSelectionData))? explode(',', $fmStateSelectionData):[];
$fmCitySelectionData=(!empty($fmCitySelectionData))? explode(',', $fmCitySelectionData):[];

$mediaArray=array(
0=>array('mdNameVal'=>"1",'mdName'=>'Print'),
1=>array('mdNameVal'=>"2",'mdName'=>'Outdoor'),
2=>array('mdNameVal'=>"3",'mdName'=>'AV-TV'),
3=>array('mdNameVal'=>"4",'mdName'=>'AV-Radio')
);
if(@$Client_ReqNo!=''){
$dynamicmname[]=$crh->Print=="1" ? $crh->Print="1":'';
$dynamicmname[]=$crh->Outdoor=="1" ? $crh->Outdoor="2":'';
$dynamicmname[]=$crh->{'AV - TV'}=="1" ? $crh->{'AV-TV'}="3":'';
$dynamicmname[]=$crh->{'AV - Radio'}=="1"? $crh->{'AV-Radio'}="4":'';
$mediaTabArray=array(
0=>array('mdNameVal'=>$crh->Print!="" ? $crh->Print:'','mdName'=>'Print'),
1=>array('mdNameVal'=>$crh->Outdoor!="" ? $crh->Outdoor:'','mdName'=>'Outdoor'),
2=>array('mdNameVal'=>$crh->{'AV - TV'}!="" ? $crh->{'AV - TV'}:'','mdName'=>'AV-TV'),
3=>array('mdNameVal'=>$crh->{'AV - Radio'}!="" ? $crh->{'AV - Radio'}:'','mdName'=>'AV-Radio')
);
}else{
$mediaTabArray=$mediaArray;
$dynamicmname=array();
}

//Convert Indian formats
function IND_money_format($num){
$explrestunits = "" ;
$num = preg_replace('/,+/', '', $num);
$words = explode(".", $num);
$des = "00";
if(count($words)<=2){
    $num=$words[0];
    if(count($words)>=2){$des=$words[1];}
    if(strlen($des)<2){$des="$des";}else{$des=substr($des,0,2);}
}
if(strlen($num)>3){
    $lastthree = substr($num, strlen($num)-3, strlen($num));
    $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
    $expunit = str_split($restunits, 2);
    for($i=0; $i<sizeof($expunit); $i++){
      
        if($i==0)
        {
            $explrestunits .= (int)$expunit[$i].","; 
        }else{
            $explrestunits .= $expunit[$i].",";
        }
    }
    $thecash = $explrestunits.$lastthree;
} else {
    $thecash = $num;
}
return "$thecash";

}

@endphp
<div class="content-inside p-3">
  <div class="" id="plzWait"><i class="" id="formloader"></i></div>
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Media Request Detail</h6>
      <p><a href="{{url('GeneratePDFclientReq/'.@$crh->{'Client Request No'})}}" class="m-0 font-weight-normal text-primary"> <i class="fa fa-download"></i> Media Request Application Receipt</a></p>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane content pt-3 mcontenttab show active" id="BasicInformation-tab" role="tabpanel" aria-labelledby="BasicInformation-tab">
             <fieldset class="fieldset-border">
              <legend><i class="fa fa-file-text-o"></i> Basic Details</legend>
            <div class="row">
              <input type="hidden" class="form-control form-control-sm" id="Ministry_Code" name="Ministry_Code"  maxlength="20" readonly value="{{@$mhead->{'New Ministry Code'} ?? ''}}">
               <input  type="hidden" class="form-control form-control-sm" id="Department_Code" name="Department_Code" maxlength="10" readonly value="{{@$mhead->{'Department'} ?? ''}}">
            </div>
            <div class="row">
               <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Ministry Head Code/मंत्रालय प्रमुख कोड</label>
                  <input {{ $disabled }} type="text" maxlength="20" class="form-control form-control-sm" name="Ministry_Head" id="Ministry_Head" placeholder="Enter Ministry Head" value="{{@$mhead->{'Ministries Head'} ?? ''}}" readonly>
                  <span id="first_email" style="color:red;display:none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Officer Name/अधिकारी का नाम<span style="color:red">*</span></label>
                  <input {{ $disabled }} name="Name_of_Officer" id="Name_of_Officer" placeholder="Enter Name of Officer " maxlength="40" minlength="3" class="form-control form-control-sm" onkeypress="return onlyAlphabets(event,this)" value="{{ session()->get('profile_name') }}" readonly>
                  <span id="first_address" style="color:red;display:none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Designation/पद <span style="color:red">*</span></label>
                  <input {{ $disabled }} name="Designation" id="Designation" placeholder="Enter Designation " class="form-control form-control-sm" minlength="2" maxlength="40" onkeypress="return onlyAlphabets(event,this)" value="{{ session()->get('profile_designation') }}" readonly>
                  <span id="disgnation_address" style="color:red;display:none;"></span>
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">E-mail ID/ई मेल आईडी<span style="color:red">*</span></label>
                  <input {{ $disabled }} type="email" class="form-control form-control-sm" maxlength="40" name="email" id="email" placeholder="Enter Email ID" value="{{ session()->get('email') }}" readonly>

                  <span id="first_email" style="color:red;display:none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Govt. E-mail ID/सरकारी ई मेल आईडी</label>
                  <input {{ $disabled }} type="email" class="form-control form-control-sm" maxlength="40" name="govt_email_id" id="govt_email_id" placeholder="Enter Govt. Email ID" value="{{ $crh->{'Govt E-mail ID'} ?? '' }}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Mobile No./मोबाइल नंबर<span style="color:red">*</span></label>
                  <input {{ $disabled  }} type="text" class="form-control form-control-sm" name="mobile" placeholder="Enter Mobile No." onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{ session()->get('Mobile') }}">
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Phone No.(with STD code)/ फोन नंबर (एसटीडी कोड के साथ)</label>
                  <input {{ $disabled }} type="text" class="form-control form-control-sm" name="phone" placeholder="Enter Phone No." onkeypress="return onlyNumberKey(event)" maxlength="12" value="{{$crh->{'Phone No_'} ??''}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Address/पता<span style="color:red">*</span></label>
                  <textarea {{ $disabled }} name="address" id="address" placeholder="Enter Address" rows="2" cols="50" minlength="2" maxlength="120" class="form-control form-control-sm">{{session()->get('profile_address')}}</textarea>
                  <span id="alert_address" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Department File Ref.No./विभाग फाइल संदर्भ संख्या</label>
                  <input {{ $disabled }} type="text" class="form-control form-control-sm" id="department_Ref_No" name="department_Ref_No" placeholder="Enter Department File Ref.No." minlength="2" maxlength="40" value="{{ $crh->{'Client Refrence No_'} ?? '' }}">
                </div>
              </div>
            </div>

            <div class="row">
               <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label"> Campaign/Add Theme/अभियान/थीम जोड़ें </label>
                  <input {{ $disabled }} name="subject" id="subject" placeholder="Enter Campaign/Theme " class="form-control form-control-sm" minlength="2" maxlength="40" onkeypress="return onlyAlphabets(event,this)" value="{{ $crh->{'Subject'} ?? '' }}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Campaign Type/अभियान प्रकार<span style="color:red">*</span></label>
                  <select {{ $disabled }} id="Campaign_Type" name="Campaign_Type" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">
                    <option value="">Select Campaign Type</option>
                    <option value="0" {{@$crh->{'Campaign Type'} == 0 && @$crh->{'Campaign Type'} != ""  ? 'selected' : ''}}> Single Media </option>
                    <option value="1" {{@$crh->{'Campaign Type'} == 1 && @$crh->{'Campaign Type'} != ""  ? 'selected' : ''}}> Multiple Media </option>
                  </select>
                </div>
              </div>
              <div class="col-md-4" id="singlemediaNameDiv" style="display: none;">
                <div class="form-group">
                  <label class="form-control-label">Media Name/ मीडिया का नाम<span style="color:red">*</span></label>
                  <select {{$disabled}} id="singlemediaName" name="media_name_s[]" class="form-control form-control-sm {{$disabled=='disabled' ? 'remove-arrow-select':'' }}">
                    <option value="">Select Media Name</option>
                    @foreach($mediaArray as $md)
                    <option value="{{$md['mdNameVal'] }}" {{ in_array( $md['mdNameVal'], str_replace(' ', '', $dynamicmname)) ? 'selected' :'' }}> {{$md['mdName']}} </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4" id="mediaNameDiv" style="display: none;">
                <div class="form-group">
                  <label class="form-control-label">Media Name/ मीडिया का नाम<span style="color:red">*</span></label>
                  <select {{$disabled}} id="mediaName" name="media_name_s[]" class="form-control form-control-sm multi_select_mandatory {{$disabled=='disabled' ? 'remove-arrow-select':'' }}" multiple>
                    @foreach($mediaArray as $md)
                    <option value="{{$md['mdNameVal'] }}" {{ in_array( $md['mdNameVal'], str_replace(' ', '', $dynamicmname)) ? 'selected' :'' }}> {{$md['mdName']}} </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group clearfix"><label for="owner_newspaper"></label><br>
                  <div class="icheck-primary d-inline"></div>
                </div>
              </div>
            </div>
          </div>
           </fieldset> <!-- Print media tab -->
          <!-- <div class="dynamicForm"> -->
          @foreach($mediaTabArray as $mindex => $mtab)
          @if($mtab['mdNameVal']!=0)
            <div class="" value="{{$mtab['mdNameVal']}}" id="{{@$mtab['mdName'] }}-tab" role="tabpanel" aria-labelledby="{{@$mtab['mdName'] }}-tab">
              <fieldset class="fieldset-border">
              <legend><i class="fa fa-file-text-o"></i> {{ @$mtab['mdName'] }} Media Details</legend>
            @include('admin.pages.client-request.mediaName/'.$mtab["mdName"])
             </fieldset>
          </div>
          @endif
          @endforeach
          <!-- </div> -->
          <!--  crsRadio media tab -->
          <input {{ $disabled }} type="hidden" name="nextTabName" id="nextTabName" value="">
          @if(@$Client_ReqNo == '')
          <input {{ $disabled }} type="hidden" name="Client_ReqNo" id="Client_ReqNo" value="">
          @else
          <input {{ $disabled }} type="hidden" name="Client_ReqNo" id="Client_ReqNo" value="{{$Client_ReqNo}}">
          @endif
          <div class="row">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('custom_js')

<script src="{{ url('/js/clientRequestjs') }}/submission-of-advertisement.js"></script>
<script src="{{ url('/js/clientRequestjs') }}/printMedia.js"></script>
<script src="{{ url('/js/clientRequestjs') }}/outdoorMedia.js"></script>
<script src="{{ url('/js/clientRequestjs') }}/avjs/tv.js"></script>
<script src="{{ url('/js/clientRequestjs') }}/avjs/crsAndRadio.js"></script>
<!-- <script src="{{ url('/js') }}/validator.js"></script> -->

<script>
  //Set selected on hindi & English selection
  $("#language_sm").change(function(){
    var lang=$('#language_sm').val();

    var single_lang=$("#single_langauge_select").val();
    var mult_language=$("#multi_langauge_select").val();
    if(lang==1)
    {
      var $el = $('#single_langauge_select');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
    }
    else if(lang==2)
    {
      var $el = $('#multi_langauge_select');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
    }
    

    
    
    
  });

  $('#language_sm').change(function() {
    var language_sm = $('#language_sm').val();
    if (language_sm == 2) {
      $('#langauge_select_hindi_english').html('<option value="HND" selected="selected">Hindi</option><option value="ENU" selected="selected">English</option>');
    } else {
      $('#langauge_select_hindi_english').html('');
    }
  });
  $('#media_plan').change(function() {
    var media_plan = $('#media_plan').val();

    if (media_plan == 1) {
      $('#page_length').val(1);
    } else {
      $('#page_length').val("");
    }
  });

  function titleCase(string) {
    return string[0].toUpperCase() + string.slice(1).toLowerCase();
  }
  function btnSubmit(btnval=''){
    if (btnval == 'Submit') {
      $('.btntab1').hide();
    }
  }
  function btnprev(){
    if ($('#previous_btn').text() == 'Previous') {
      $('.btntab1').show();
    }
  }
    


  function MediaNameLengthCount() {
    var val = [];
    $('select[name="media_name_s[]"] option:selected').each(function() {
      var mNameval1 = $(this).val();
      val.push(mNameval1);
    });
    return val.length;

  }
  //  next and previous function for save 
  $('.alert-success').hide();
  $('.alert-danger').hide();

  function nextSaveData(tab = '') {
    var formvalidation = '<?php
                          if ($disabled == 'disabled') {
                            echo 'noteditable';
                          }
                          ?>';
    if (formvalidation == "noteditable") {
      btnSubmit($('#btnloader').text());
      return false;
    }

    $('#nextTabName').val(tab);
    $('#formloader').addClass('fa fa-refresh fa-spin fa-3x fa-fw');
    $('#plzWait').addClass('plz-wait');
    //$('#btntab').addClass('fa fa-circle-o-notch fa-spin fa-fw');
    var formData = new FormData($('#client_request')[0]);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "POST",
      url: "{{Route('client-submission-form')}}",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function(data) {
        if (data.success == true) {
          var $message ='data successfully saved';
          $("#app").scrollTop(0);
          $('#formloader').removeClass('fa fa-refresh fa-spin fa-3x fa-fw');
          $('#plzWait').removeClass('plz-wait');
          //$('#btntab').removeClass('fa fa-circle-o-notch fa-spin fa-fw');
          if ($('#submit').val() == 'submit') {

            $('.alert-success').fadeIn().html($message);
            setTimeout(function() {
              //$('.alert-success').fadeOut("slow"); this.text=='Submit' ? $('#client_request').trigger("reset") :''}, 7000);
              $('.alert-success').fadeOut("slow");
              // this.text == 'Submit' ? $('#client_request').trigger("reset") : ''
              //location.reload();
              //window.location.href='';
              window.location ='client-submission-list';
            }, 3000);  
          }else{
            /*$('.alert-success').fadeIn().html($message);
            setTimeout(function() {
              //$('.alert-success').fadeOut("slow"); this.text=='Submit' ? $('#client_request').trigger("reset") :''}, 7000);
              $('.alert-success').fadeOut("slow");
             }, 2000);*/
          }


          $('#Client_ReqNo').val(data.data.Client_ReqNo);
        } else if (data.success == false) {
          var $message = tab + ' not successfully saved, server issue';
          $("#app").scrollTop(0);
          $('#formloader').removeClass('fa fa-refresh fa-spin fa-3x fa-fw');
          $('#plzWait').removeClass('plz-wait');
          //$('#btntab').removeClass('fa fa-circle-o-notch fa-spin fa-fw');
          $('.alert-danger').fadeIn().html($message);
          setTimeout(function() {
            $('.alert-danger').fadeOut("slow");
          }, 2000);
        }
      },
      error: function(error) {
        console.log('error');
      }
    });
  }
  $("#previous_btn").click(function() {


  });

  function uploadFile(i, thiss) {
    var file = thiss.files[0].name;
    var totalBytes = thiss.files[0].size;
    var sizemb = (totalBytes / (1024 * 1024));
    // console.log('totalBytes',totalBytes);
    console.log('sizemb', sizemb);
    // console.log('file',file);
    var ext = file.split('.').pop();

    // if ((sizemb <= 2) && (ext == "jpeg" || ext == "jpg" || ext == "png")) 
    if ((file != "" && sizemb <= 2)) {
      console.log("if");
      $("#choose_file" + i).empty();
      $("#choose_file" + i).text(file);
      $("#upload_file" + i).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#upload_doc_error" + i).hide();
    } else {
      $("#upload_doc" + i).val('');
      $("#choose_file" + i).text(file);
      $("#upload_doc_error" + i).text('File size should be 2MB');
      $("#upload_doc_error" + i).show();
      $("#upload_file" + i).html("Upload").addClass("input-group-text");
      $("#upload_doc" + i + "-error").addClass("hide-msg");
    }
  }
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  var disabledcalicon = '<?php echo $disabled; ?>';
    if(disabledcalicon=='disabled'){
      var showOn='button1'
    }else{
       var showOn= 'button'
    }
</script>
<script type="text/javascript">
  $(document).ready(function(){
      //start Radio date picker
    var CURL = {!! json_encode(url('/')) !!};
    var dateFormat = "mm/dd/yy",
      from = $("#crsRadiofrom_date")
      .datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        showOn:showOn,
        buttonImage: CURL + "/img/calendar.gif",
        buttonImageOnly: true,
        buttonText: "Select date",
        //dateFormat: 'dd-mm-yy',

      })
      .on("change", function() {
        to.datepicker("option", "minDate", getDate(this));
      }),
      to = $("#crsRadioto_date").datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        showOn:showOn,
        buttonImage: CURL + "/img/calendar.gif",
        buttonImageOnly: true,
        buttonText: "Select date",
        //dateFormat: 'dd-mm-yy',
      })
      .on("change", function() {
        from.datepicker("option", "maxDate", getDate(this));
      });

    function getDate(element) {
      var date = null;

      try {
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }

      return date;
    }

    function onSelect(dateText, inst) {
      var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#crsRadiofrom_date").val());
      var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#crsRadioto_date").val());
      var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);

      if (!date1 || date2) {
        $("#crsRadiofrom_date").val(dateText);
        $("#crsRadioto_date").val("");
        $(this).datepicker();
      } else if (selectedDate < date1) {
        $("#crsRadioto_date").val($("#crsRadiofrom_date").val());
        $("#crsRadiofrom_date").val(dateText);
        $(this).datepicker();
      } else {
        $("#crsRadioto_date").val(dateText);
        $(this).datepicker();
      }
    }

    $('#crsRadiofrom_date').click(function() {
      $('#crsRadiofrom_date').datepicker("show");
    });
    $('#crsRadioto_date').click(function() {
      $('#crsRadioto_date').datepicker("show");
    });
    });
  </script>
<script type="text/javascript">
  $(document).ready(function(){
  //hide calendor icon on view
  
    var CURL = {!! json_encode(url('/')) !!};
    var dateFormat = "mm/dd/yy",
      from = $("#from_date")
      .datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        showOn:showOn,
        buttonImage: CURL + "/img/calendar.gif",
        buttonImageOnly: true,
        buttonText: "Select date",
        //dateFormat: 'dd-mm-yy',

      })
      .on("change", function() {
        to.datepicker("option", "minDate", getDate(this));
      }),
      to = $("#to_date").datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        showOn:showOn,
        buttonImage: CURL + "/img/calendar.gif",
        buttonImageOnly: true,
        buttonText: "Select date",
        //dateFormat: 'dd-mm-yy',
      })
      .on("change", function() {
        from.datepicker("option", "maxDate", getDate(this));
      });

    function getDate(element) {
      var date = null;

      try {
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }

      return date;
    }

    function onSelect(dateText, inst) {
      var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#from_date").val());
      var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#to_date").val());
      var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);

      if (!date1 || date2) {
        $("#from_date").val(dateText);
        $("#to_date").val("");
        $(this).datepicker();
      } else if (selectedDate < date1) {
        $("#to_date").val($("#from_date").val());
        $("#from_date").val(dateText);
        $(this).datepicker();
      } else {
        $("#to_date").val(dateText);
        $(this).datepicker();
      }
    }

    $('#from_date').click(function() {
      $('#from_date').datepicker("show");
    });
    $('#to_date').click(function() {
      $('#to_date').datepicker("show");
    });
  });
</script>
  
<script type="text/javascript">
  $(document).ready(function(){

  //outdoor date picker
    
    var CURL = {!! json_encode(url('/')) !!};
    var dateFormat = "mm/dd/yy",
      from = $("#outdoorfrom_date")
      .datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        showOn:showOn,
        buttonImage: CURL + "/img/calendar.gif",
        buttonImageOnly: true,
        buttonText: "Select date",
        //dateFormat: 'dd-mm-yy',

      })
      .on("change", function() {
        to.datepicker("option", "minDate", getDate(this));
      }),
      to = $("#outdoorto_date").datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        showOn:showOn,
        buttonImage: CURL + "/img/calendar.gif",
        buttonImageOnly: true,
        buttonText: "Select date",
        //dateFormat: 'dd-mm-yy',
      })
      .on("change", function() {
        from.datepicker("option", "maxDate", getDate(this));
      });

    function getDate(element) {
      var date = null;

      try {
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }

      return date;
    }

    function onSelect(dateText, inst) {
      var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#outdoorfrom_date").val());
      var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#outdoorto_date").val());
      var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);

      if (!date1 || date2) {
        $("#outdoorfrom_date").val(dateText);
        $("#outdoorto_date").val("");
        $(this).datepicker();
      } else if (selectedDate < date1) {
        $("#outdoorto_date").val($("#outdoorfrom_date").val());
        $("#outdoorfrom_date").val(dateText);
        $(this).datepicker();
      } else {
        $("#outdoorto_date").val(dateText);
        $(this).datepicker();
      }
    }

    $('#outdoorfrom_date').click(function() {
      $('#outdoorfrom_date').datepicker("show");
    });
    $('#outdoorto_date').click(function() {
      $('#outdoorto_date').datepicker("show");
    });
  });


  //end outdoor date picker
  </script>
<script type="text/javascript">
  $(document).ready(function(){
   //av tv start date picker
    var CURL = {!! json_encode(url('/')) !!};
    var dateFormat = "mm/dd/yy",
      from = $("#tvfrom_date")
      .datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        showOn:showOn,
        buttonImage: CURL + "/img/calendar.gif",
        buttonImageOnly: true,
        buttonText: "Select date",
        //dateFormat: 'dd-mm-yy',

      })
      .on("change", function() {
        to.datepicker("option", "minDate", getDate(this));
      }),
      to = $("#tvto_date").datepicker({
        //defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        showOn:showOn,
        buttonImage: CURL + "/img/calendar.gif",
        buttonImageOnly: true,
        buttonText: "Select date",
        //dateFormat: 'dd-mm-yy',
      })
      .on("change", function() {
        from.datepicker("option", "maxDate", getDate(this));
      });

    function getDate(element) {
      var date = null;

      try {
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }

      return date;
    }

    function onSelect(dateText, inst) {
      var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#tvfrom_date").val());
      var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#tvto_date").val());
      var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);

      if (!date1 || date2) {
        $("#tvfrom_date").val(dateText);
        $("#tvto_date").val("");
        $(this).datepicker();
      } else if (selectedDate < date1) {
        $("#tvto_date").val($("#tvfrom_date").val());
        $("#tvfrom_date").val(dateText);
        $(this).datepicker();
      } else {
        $("#tvto_date").val(dateText);
        $(this).datepicker();
      }
    }

    $('#tvfrom_date').click(function() {
      $('#tvfrom_date').datepicker("show");
    });
    $('#tvto_date').click(function() {
      $('#tvto_date').datepicker("show");
    });
  });
  //end AV TV date picker

  // start email autocomplete input search
  $(function() {
    $("#email").autocomplete({
      source: function(request, response) {
        // Fetch data
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          url: "get-email",
          type: 'post',
          dataType: "json",
          data: {
            email: request.term
          },
          success: function(data) {
            var emails = [];
            for (var i = 0; i < data.length; ++i) {
              emails.push(data[i]['Email ID']);
            }
            response(emails);
          }
        });
      },
      select: function(event, ui) {
        // Set selection
        $('#email').val(ui.item.value);
        return false;
      },
      focus: function(event, ui) {
        $("#email").val(ui.item.value);
        return false;
      },
    });
  });
  // end email autocomplete input search

  // start custom size cros check
  function customSize(thiss) {
    if ($("#pageSize").val() == 0) {
      var length = $("#un_advertise_length").val();
      var breadth = $("#un_advertise_breadth").val();

      if (length < 4 && length != '') {
        $("#ctm_" + thiss.id).text("Size should not be less than 4x8");
        $("#ctm_un_advertise_length").show();
      } else {
        $("#ctm_un_advertise_length").hide();
      }
      if (breadth < 8 && breadth != '') {
        $("#ctm_" + thiss.id).text("Size should not be less than 4x8");
        $("#ctm_un_advertise_breadth").show();
      } else {
        $("#ctm_un_advertise_breadth").hide();
      }
    }
  }
  //end custom size cros check
  
</script>
<script type="text/javascript">
//   $("document").ready(function(){

//     $("#outdoorCreativeFileName").change(function() {
//         var fileName = document.getElementById("outdoorCreativeFileName").value;
//         var idxDot = fileName.lastIndexOf(".") + 1;
//         var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
//         if (extFile=="png" || extFile=="jpg" || extFile=="jpeg"){
//             //TO DO
//         }else{
//             alert("Only JPG OR PNG files are allowed!");
//             $("#outdoorCreativeFileName").val('');
//         } 
//     });
// });
  </script>
<script type="text/javascript">
  $("document").ready(function(){

    $("#tvCreativeFileName").change(function() {
        var fileName = document.getElementById("tvCreativeFileName").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="mp4" || extFile=="mp4v" || extFile=="mov" || extFile=="webm"){
            //TO DO
        }else{
            alert("Only video files are allowed!");
            $("#tvCreativeFileName").val('');
        } 
    });
});
  </script>
  <script type="text/javascript">
  $("document").ready(function(){

    $("#crsRadioCreativeFileName").change(function() {
        var fileName = document.getElementById("crsRadioCreativeFileName").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="mp3" || extFile=="wav" || extFile=="webm"){
            //TO DO
        }else{
            alert("Only audio files are allowed!");
            $("#crsRadioCreativeFileName").val('');
        } 
    });
});
  </script>
<style type="text/css">
  .multiselect-container {
    overflow-x: scroll;
    height: 400px;
  }

  .multiselect-container>li>a>label {
    height: auto;
  }
</style>

<script type="text/javascript">
  // add row
  var i = 0;
  var j=0;
  $("#addRow").click(function() {
    var html = '';
    ++i;
    ++j
    html += '<div class="addmore" id="inputFormRow"><fieldset class="fieldset-border"><legend><i class="fa fa-file-text-o"></i> Media Details</legend>';
   /*html += '<h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Media Details</h6>';*/
    /*html += '<div class="row">'; //Advertise row
    html += '<div class="col-md-4"><div class="form-group"><label class="form-control-label">Advertise length/विज्ञापन की लंबाई<span style="color:red">*</span></label><input  type="text" maxlength="20" name="outdoorAdvLength[]" placeholder="Advertise Length(CM)" class="form-control form-control-sm" id="outdoorAdvLength' + i + '" onkeypress="return isNumber(event)" value=""></div></div>';
    html += '<div class="col-md-4"><div class="form-group"><label class="form-control-label">Advertise breadth)/विज्ञापन चौड़ाई<span style="color:red">*</span></label><input  type="text" maxlength="20" name="outdoorAdvBreadth[]" id="outdoorAdvBreadth' + i + '" placeholder="Advertise Breadth(CM)" class="form-control form-control-sm" onkeypress="return isNumber(event)" value=""></div></div>';
    html += '<div class="col-md-4" ><div class="form-group"><label class="form-control-label">Advertise area/विज्ञापन क्षेत्र<span style="color:red">*</span></label><input  type="text"  name="outdoorAdvArea[]" id="outdoorAdvArea' + i + '" placeholder="Advertise Area(Sq Cm)" class="form-control form-control-sm" onkeypress="return isNumber(event)" value="" ></div></div>';
    html += '</div>'; // end Advertise row*/
    html += '<div class="row">'; //Start  from Media Category to target area row
    html += '<div class="col-md-4"><div class="form-group"><label class="form-control-label">Media Category/ मीडिया श्रेणी<span style="color:red">*</span><br></label><select  name="outdoorMediaCategory[]" id="outdoorMediaCategory[' + i + ']" class="form-control form-control-sm outdoorMediaCategory  "><option value="">Select media category</option><option value="0" >Airport </option><option value="1" >Railways</option><option value="2" > Road Side </option><option value="3" >Transit Media </option> <option value="4">Others </option><option value="5" >Metro</option><option value="6" >Bus & Station</option>></select></div></div>';
    html += '<input type="hidden" value="" name="hiddensubcatid[]" id ="hiddensubcatid' + i + '">';
   /* html += '<div class="col-md-4"><div class="form-group"><label class="form-control-label">Media subcategory/मीडिया उपश्रेणी</label><select  name="outdoorMediaSubCategory[]" id="outdoorMediaSubCategory' + i + '" class="form-control form-control-sm"><option >Select media subcategory</option></select></div></div>';*/
    html+='<div class="col-md-4" id="divOutdoor_train' + i + '" style="display: none;"><div class="form-group"><label class="form-control-label">Train No/ट्रेन संख्या<span style="color:red">*</span></label><select  name="outdoortrain[]" id="outdoortrain' + i + '" class="form-control form-control-sm"><option value="">Select train No.</option> @foreach(@$allTrainData as $allTrain)<option value="{{@$allTrain->{"Train No_"} }}">{{@$allTrain->{"Train No_"} }} - {{@$allTrain->trainName}} </option> @endforeach</select></div></div>';
    html += '<div class="col-md-4"><div class="form-group"><label class="form-control-label">Target Area / लक्षित इलाका<span style="color:red">*</span></label><select  name="outdoorTArea[]" id="outdoorTArea' + i + '" class="form-control form-control-sm"><option value="">Select Target Area</option><option value="0" >Pan India</option><option value="1">Individual State</option><option value="2" >Group States</option><option value="3" >Group City</option><option value="4" >City/Town</option></select></div></div>';
    html += '</div>'; // end from  Media Category to target row

    html += '<div class="row">'; //Start slected target row
    html += '<div class="col-md-4 selectedTgroup' + i + '" id="divOutdoor_PanIndia' + i + '" style="display: none;"></div>';
    html += '<div class="col-md-4 selectedTgroup' + i + '" id="divOutdoor_SelectTargetArea ' + i + '" style="display: none;"></div>';
    html += '<div class="col-md-4 selectedTgroup' + i + '" id="divOutdoor_CityTown' + i + '" style="display:none"><div class="form-group"><label class="form-control-label">City/Town/शहर/कस्बा<span style="color:red">*</span></label><select {{$disabled}} name="outdoorTown[]" id="outdoorTown' + i + '" class="form-control form-control-sm" ><option value="">Select</option> @foreach($allCityData as $allCity)<option value="{{$allCity->CityName}}" >{{$allCity->CityName}} </option> @endforeach</select></div></div>';
    /*html += '<div class="col-md-4 selectedTgroup' + i + '" id="divOutdoor_Zone' + i + '" style="display:none"><div class="form-group"><label class="form-control-label">Zone/क्षेत्र<span style="color:red">*</span></label><input  type="text" maxlength="20" name="outdoorZone[]" id="outdoorZone" placeholder="Enter Zone" class="form-control form-control-sm" value=""></div></div>';
    html += '<div class="col-md-4 selectedTgroup' + i + '" id="divOutdoor_PostalCode' + i + '" style="display:none"><div class="form-group"><label class="form-control-label">Postal Code/डाक कोड<span style="color:red">*</span></label><input  type="text" maxlength="20" name="outdoorPostalCode[]" id="outdoorPostalCode" placeholder="Enter postal code" class="form-control form-control-sm" value=""></div></div>';
    html += '<div class="col-md-4 selectedTgroup' + i + '" id="divOutdoor_District' + i + '" style="display:none"><div class="form-group"><label class="form-control-label">District/ज़िला<span style="color:red">*</span></label><select {{$disabled}} name="outdoorDistrict[]" id="outdoorDistrict' + i + '" class="form-control form-control-sm"><option value="">Select</option>@foreach($districts as $district)<option value="{{$district->District}}">{{$district->District}} ~ {{$district->District}}</option>@endforeach</select></div></div>';*/
    html += '<div class="col-md-4 selectedTgroup' + i + '" id="divOutdoor_GroupStates' + i + '" style="display:none"><div class="form-group"><label class="form-control-label">Group of States/राज्यों का समूह<span style="color:red">*</span></label><select  name="outdoorGroupState[' + i + '][]" id="outdoorGroupState' + i + '" class="form-control form-control-sm" multiple="multiple">@foreach($states as $state)<option value="{{$state->Code}}" >{{$state->Code}} ~ {{$state->Description}}</option>@endforeach</select></div></div>';
    html += '<div class="col-md-4 selectedTgroup' + i + '" id="divOutdoor_GroupCity' + i + '" style="display:none"><div class="form-group"><label class="form-control-label">Group of Cities/शहर का समूह<span style="color:red">*</span></label><select  name="outdoorGroupCity[]" id="outdoorGroupCity' + i + '" class="form-control form-control-sm"><option value="">Select</option><option value="0" >Metro</option><option value="1">Capital</option><option value="2" >Class A</option><option value="3" >Class B</option><option value="4" >Class C</option><option value="5" >Random</option></select></div></div>';
    html += '<div class="col-md-4 selectedTgroupCity' + i + '" id="divOutdoor_RandomCity' + i + '" style="display:none"><div class="form-group"><label class="form-control-label">Random Cities/अनियमित शहर</label><select  name="outdoorRandomCityList[' + i + '][]" id="outdoorRandomCityList' + i + '" class="form-control form-control-sm" multiple="multiple">@foreach($allCityData as $allCity)<option value="{{@$allCity->CityName}}">{{@$allCity->CityName}}</option>@endforeach</select></div></div>';
    html += '</div>'; // end selected target row
    html += '<div class="row">'; //Start slected target for indivisual state with city row
    html += '<div class="col-md-4 selectedTgroup' + i + '" id="divOutdoor_IndividualState' + i + '" style="display:none"><div class="form-group" id="outdoor_individual_state"><label class="form-control-label">Individual State/व्यक्तिगत राज्य<span style="color:red">*</span></label><select  name="outdoorIndividualState[]" id="outdoorIndividualState' + i + '" class="form-control form-control-sm"><option value="">Select State</option>@foreach($states as $state)<option value="{{$state->Code}}" >{{$state->Code}} ~ {{$state->Description}}</option>@endforeach</select></div></div>';
    html += '<div class="col-md-4 outdoorCityWithStateHide' + i + '" id="outdoor_city_with_stateDiv' + i + '" style="display:none"><div class="form-group"><label class="form-control-label">City With State/राज्य के साथ शहर</label><input style="width:21px;height:23px" class="form-control form-control-sm"  type="checkbox" id="outdoorCityWithState' + i + '" name="outdoorCityWithState[]" ></div></div>';
    html += '<div class="col-md-4 selectedTgroup' + i + '" id="outdoorgetCityDiv' + i + '" style="display:none"><div class="form-group"><label class="form-control-label">City/शहर</label><select  name="outdoorCityList[]" id="outdoorCityList' + i + '" class="form-control form-control-sm"><option value=""></option></select></div></div>';
    html += '<div class="col-md-4" id="spotnoDiv' + i + '" style="display:none"><div class="form-group"><label class="form-control-label">Spots No. /स्पॉट संख्या<span style="color:red">*</span></label><input  type="text" maxlength="20" name="outdoorSpotsno[]" id="outdoorSpotsno' + i + '" placeholder="Enter Spots No." class="form-control form-control-sm" value="" onkeypress="return isNumber(event)"></div></div>';
    html += '</div>'; //end slected target for indivisual state with city row
    html += '<div class="row"><div class="col-sm-12 text-right"><a class="btn btn-danger remove-button btn-sm" id="removeRow"><i class="fa fa-caret-left"></i> Remove</a></div></div>';
    html += ' </fieldset> </div>';


    $('#newRow').append(html);
  });

  // remove row
  $(document).on('click', '#removeRow', function() {
    $(this).closest('#inputFormRow').remove();
  });

  
// start add js code for print employment
$(document).ready(function () {
  var val = $('#newspaper_type option:selected').val();
  if (val == 1) {
    $("#demography").hide();
    $("#targetArea").hide();
    $("#languageName").hide();
    $("#multiple_media_plan").hide();
    $("#requirement").hide();
    $(".is_creative_available").hide();
    $(".print_size_option").hide();
    $("#single_langauge_select_div").hide();
  }
});
function getMediaType(val) {
  if (val == 1) {
    $('#pageSize option').removeAttr('selected').filter('[value=""]').attr('selected', true);
    $("#is_create_available option").removeAttr('selected').filter('[value=""]').attr('selected', true);

    $("#demography").hide();
    $("#targetArea").hide();
    $("#languageName").hide();
    $("#multiple_media_plan").hide();
    $("#requirement").hide();
    $(".is_creative_available").hide();
    $(".print_size_option").hide();
  } else {
    $('#pageSize option').attr('selected', false);
    $("#is_create_available option").attr('selected', false);
    $("#demography").show();
    $("#targetArea").show();
    $("#languageName").show();
    $("#requirement").show();
    $(".is_creative_available").show();
    $(".print_size_option").show();
  }
}
 // end add js code for print employment
</script>
@endsection