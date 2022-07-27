@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
@section('content')
<!-- /.end card-header -->

@php
$readonlyowner = '';
$pointer = '';
if(@count($ownerotherdata)>=1 && $ownerotherdata !=''){
$readonlyowner = 'readonly';
$pointer = 'none';
}

$ispcheck1 = '';
$ispcheck2 = '';
if(!empty($vendordatas) && $vendordatas['Primary Edition'] == 1){
$ispcheck2 = 'checked="checked"';
}else if(!empty($vendordatas) && $vendordatas['Primary Edition'] == 0){
$ispcheck1 = 'checked="checked"';
}

$check1 = '';
$check2 = '';
if(@$ownerdatas['Owner ID'] != ''){
$check2 = 'checked="checked"';
}else{
$check1 = 'checked="checked"';
}

$disabledall = '';
$checked = '';
if(@$vendordatas['Modification'] == 0 && $vendordatas !=''){
$disabledall = 'disabled';
$checked = 'checked';
}

$readonlyvendor = '';
if(@$vendordatas['Modification'] == 1 && ( @$vendordatas['Newspaper Name'] !="" || @$vendordatas['Newspaper Name'] !=null)){
$readonlyvendor = 'readonly';

}

$efiling = 'block';
$readonlyvalid = '';
if(@$vendordatas['CIR Base'] == 0 && @$vendordatas['CIR Base'] != ''){
$readonlyvalid = 'readonly';
}

$reg_no = '';
$solid_circulation = '';
$reg_no_verified = '';
$abc_reg_no_verified = '';
$solid_circulation_verified = '';
$turnover_verified = '';
$date_verified = '';
$efiling = 'none';
$abc_cert = 'none';
$rni_regist_no = 'none';
$udin_number = 'none';
if(@$vendordatas['CIR Base'] == 0 && @$vendordatas['CIR Base'] != ''){
$reg_no = $vendordatas['RNI Registration No_'] ?? '';
$solid_circulation = $vendordatas['Claimed Circulation'] ?? '';
$efiling = 'block';
$abc_cert = 'none';
$rni_regist_no = 'block';
$udin_number = 'none';
$reg_no_verified = $vendordatas['RNI Registration Validation'] ?? '';
$solid_circulation_verified = $vendordatas['RNI Circulation Validation'] ?? '';
$turnover_verified = $vendordatas['RNI Annual Validation'] ?? '';
$date_verified = $vendordatas['RNI Validation Date'] ?? '';
}

if(@$vendordatas['CIR Base'] == 3 && @$vendordatas['CIR Base'] != ''){
$reg_no = $vendordatas['ABC Number'] ?? '';
$solid_circulation = $vendordatas['ABC Circulation Number'] ?? '';
$efiling = 'none';
$abc_cert = 'block';
$rni_regist_no = 'none';
$udin_number = 'none';
$abc_reg_no_verified = $vendordatas['ABC Registration Validation'] ?? '';
$solid_circulation_verified = $vendordatas['ABC Circulation Validation'] ?? '';
$turnover_verified = $vendordatas['ABC Annual Validation'] ?? '';
$date_verified = $vendordatas['ABC Validation Date'] ?? '';
}

if(@$vendordatas['CIR Base'] == 1 && @$vendordatas['CIR Base'] != ''){
$udin_number = 'block';
$solid_circulation = $vendordatas['CA Circulation Number'] ?? '';
}

@endphp

<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Application Form for Fresh Empanelment of Newspaper</h6>
      <p>
        @if($vendordatas != '' && @$vendordatas['Modification'] == 0)
        <a href="{{url('print-pdf/'.@$vendordatas['Newspaper Code'])}}" class="m-0 font-weight-normal text-primary" download><i class="fa fa-download"></i> Print Application Receipt</a>
        @endif
      </p> 
    </div>

    <!-- Card Body -->
    <div class="card-body">
      <div style="display: none;" align="center" class="alert alert-success"></div>
      <div style="display: none;" align="center" class="alert alert-danger"></div>
      <form method="POST" enctype="multipart/form-data" autocomplete="off" id="fress_emp_form">
        {{ csrf_field() }}
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active show" id="#tab1">Basic Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="#tab2">Print Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="#tab3">Account Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="#tab4">Upload Document</a>
          </li>
        </ul>

        <div class="tab-content">
          <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
            @include('admin.pages.vendor-print.common-print.basic-information')
          </div>
          <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab2-trigger">
            @include('admin.pages.vendor-print.common-print.print-information')
          </div>
          <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab3-trigger">
            @include('admin.pages.vendor-print.common-print.account-information')
          </div>
          <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab4-trigger">
            @include('admin.pages.vendor-print.common-print.upload-document')
          </div>
        </div>
    </div>
    </form>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.content-->
@endsection

@section('custom_js')
<script src="{{ url('/js/vendorPrintJs') }}/fresh-em-validation.js"></script>
<script src="{{ url('/js/vendorPrintJs') }}/fresh-em-ajax.js"></script>
<script src="{{ url('/js/vendorPrintJs') }}/print.js"></script>
<script>
  function checkUniqueOwner(id, val) {
    if (val != '') {
      var email = val;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'GET',
        url: 'checkuniqueowner/' + email,
        data: {},
        success: function(response) {
          // console.log(response);
          if (response.status == 1 && id == 'email') {
            $("#owner_type").attr("readonly", false).removeClass('pointercss');
            $("#mobile").prop("readonly", false);
            $("#address").prop("readonly", false);
            $("#state").attr("readonly", false).removeClass('pointercss');
            $("#district").attr("readonly", false).removeClass('pointercss');
            $("#city").attr("readonly", false).removeClass('pointercss');
            $("#phone").prop("readonly", false);
            $("#fax").prop("readonly", false);
            $("#davp_panel").prop('checked', false);
            $("#edition1").prop('checked', false);
            $("#edition2").prop('checked', true);
            $("#dateoffirstpublication").hide();
            $("#firstpublicationdate").val('');
            $("#tab_1").css('pointer-events', 'visible');
            // owner not exit clean data
            if ($("#owner_input_clean").val() == 0) {
              $("#state").val('');
              $("#district").val('');
              $("#owner_type").val('');
              $("#mobile").val('');
              $("#address").val('');
              $("#city").val('');
              $("#phone").val('');
              $("#fax").val('');
              $("#ownerid").val('');
              $("#exist_owner_id").val('');
              $("#add_davp").hide();
              $("#ownermobilecheck").val('');
            }
          }
          if (response.status == 0 && id == 'email') {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
              },
              type: 'POST',
              url: "{{Route('fetchownerrecord')}}",
              data: {
                data: val
              }, 
              dataType: 'json', 
              success: function(response) {
                // console.log(response.cities);
                if (response.status == 1) {
                  $("#name").val(response.message['Owner Name']);
                  $("#state").empty();
                  $("#district").empty();
                  $("#mobile").val(response.message['Mobile No_']);
                  $("#address").val(response.message['Address 1']);
                  $("#state").html(response.state);
                  $("#district").html(response.districts);
                  $("#city").html(response.cities);
                  $("#phone").val(response.message['Phone No_']);
                  $("#fax").val(response.message['Fax No_']);
                  $("#ownerid").val(response.message['Owner ID']);
                  $("#ownermobilecheck").val(response.message['Mobile No_']);
                  $("#add_davp").show();
                  $("#add_davp").empty();
                  var owner_type_arr = ['Individual', 'Partnership', 'Trust', 'Society', 'Proprietorship', 'Public Ltd', 'Pvt Ltd'];
                  var owner_type = [];
                  $.each(owner_type_arr, function(index, item) {
                    owner_type.push("<option value='" + index + "' " + (index == response.message['Owner Type'] ? 'selected' : '') + ">" + item + "</option>");
                  });
                  if (response.vendordatas.length >= 1) {
                    var len = response.vendordatas.length - 1;
                    var date_offirst_publication = response.vendordatas[len]['Date Of First Publication'];
                    $("#firstpublicationdate").val(date_offirst_publication);
                  }

                  $("#owner_type").html(owner_type);
                  var i;
                  for (i = 0; i < response.countvendordatas; ++i) {
                     var item = response.vendordatas[i];
                    var periocity_val = item['Periodicity'];
                    var dis = item['Distance from office to press'];
                    var langval = item['Language'];
                    $("#add_davp").append('<div class="row"><div class="col-md-12"><h4 class="subheading">Details of Other Publications of Same Owner or Publisher-----/एक ही मालिक या प्रकाशक के अन्य प्रकाशनों का विवरण ----</h4></div><div class="col-md-4"><div class="form-group"><label for="title">Title / शीषक</label><input type="text" name="title" placeholder="Enter Title" class="form-control form-control-sm" id="title" value="' + item['Newspaper Name'] + '" readonly></div></div><div class="col-md-4"><div class="form-group"><label>Language / भाषा</label><select name="lang" class="form-control form-control-sm pointercss" style="width: 100%;" data="' + langval + '" readonly><?php foreach ($languages as $language) { ?><option value="<?= $language['Code']; ?>" ' + (langval == "<?php echo $language['Code'] ?>" ? 'selected' : '') + ' ><?= $language['Code'] . ' ~ ' . $language['Name']; ?></option><?php } ?></select></div></div><div class="col-md-4"><div class="form-group"><label for="publication">Place of Publication / प्रकाशन का स्थान</label><input type="text" placeholder="Enter Place of Publication" name="place_of_publication_davp" class="form-control form-control-sm" id="publication" value="' + item['Place of Publication'] + '" readonly></div></div><div class="col-md-4"><br><div class="form-group"><label>Periodicity / अवधि</label><select name="periodicity_davp" class="form-control form-control-sm pointercss" style="width: 100%;" readonly><option value="0" ' + (periocity_val == 0 ? 'selected' : '') + '>Daily(M)</option><option value="1" ' + (periocity_val == 1 ? 'selected' : '') + '>Daily(E)</option><option value="2" ' + (periocity_val == 2 ? 'selected' : '') + '>Daily Except Sunday</option><option value="3" ' + (periocity_val == 3 ? 'selected' : '') + '>Bi-Weekly</option><option value="4" ' + (periocity_val == 4 ? 'selected' : '') + '>Weekly</option><option value="5" ' + (periocity_val == 5 ? 'selected' : '') + '>Fortnightly</option><option value="6" ' + (periocity_val == 6 ? 'selected' : '') + '>Monthly</option></select></div></div><div class="col-md-4"><br><div class="form-group"><label for="davp">Owner/Group ID / मालिक/समूह कोड</label><input type="text" name="davp" placeholder="Enter Owner/Group ID" class="form-control form-control-sm" id="davp" value="' + item['Newspaper Code'] + '" readonly></div></div><div class="col-md-4"><div class="form-group"><label for="edition_distance">Distance from this Edition(In Km) / इस संस्करण से दूरी (किमी. में)</label><input type="text" Place of placeholder="Enter Distance" name="distance_from_edition" value="' + Math.round(dis) + '" readonly class="form-control form-control-sm" id="edition_distance" onkeypress="return onlyNumberKey(event)"></div></div></div><br>');
                  }
                }

                if (response.countvendordatas > 0) {
                  $("#owner_type").attr("readonly", true).addClass('pointercss');
                  $("#mobile").prop("readonly", true);
                  $("#address").prop("readonly", true);
                  $("#state").attr("readonly", true).addClass('pointercss');
                  $("#district").attr("readonly", true).addClass('pointercss');
                  $("#city").attr("readonly", true).addClass('pointercss');
                  $("#phone").prop("readonly", true);
                  $("#fax").prop("readonly", true);
                  $("#edition2").prop('checked', false);
                  $("#edition1").prop('checked', true);
                  $("#davp_panel").prop('checked', true);
                  $("#owner_input_clean").val(0);
                }

              }
            });

          } else if (response.status == 0 && id == 'mobile' && val != $("#ownermobilecheck").val()) {
            $("#alert_" + id).html(titleCase(id) + ' ' + response.message);
            $("#alert_" + id).show();
            $("#mobile").val('');
          } else {
            $("#alert_" + id).hide();
          }
          if (id == 'mobile') {
            $("#owner_input_clean").val(1);
          }
        }
      });
    }
  }

  //  next and previous function for save 
  function nextSaveData(id) {
    // console.log(id);
    if ($("#Modification").val() == 1 || $("#Modification").val() == '') {
      console.log($("#" + id).val());
      if ($("#" + id).val() == 0) {
        $("#" + id).val(1);
      }
      if (id == 'submit_btn') {
        $("#sub_btn").css('pointer-events', 'none')
        $("#response_wait").text('Please Wait...');
      }

      var formData = new FormData($('#fress_emp_form')[0]);
      $.ajax({
        type: "post",
        url: "{{Route('fresh-empanelment-save')}}",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data) {
          // console.log(data);
          if (data.success == true) {
            if (id == 'next_tab_1') {
              $("#ownerid").val(data['data']);
            } else {
              $("#vendorid_tab_2").val(data['data']);
              $("#vendorid_tab_3").val(data['data']);
              $("#vendorid_tab_4").val(data['data']);
            }
            // if (id == 'next_tab_1') {
            //   $("#ownerid").val(data['message']['Owner_ID']);            
            //   $("#vendorid_tab_2").val(data['message']['np_code']);
            //   $("#vendorid_tab_3").val(data['message']['np_code']);
            //   $("#vendorid_tab_4").val(data['message']['np_code']);
            // }
            if (id == 'submit_btn') {
              $("html, body").animate({
                scrollTop: 0
              }, 1000);

              $('.alert-success').fadeIn().html(data.message);
              setTimeout(function() {
                $('.alert-success').fadeOut("slow");
                window.location.reload();
              }, 7000);
            }

          }
          if (data.success == false) {
            if (id == 'submit_btn') {
              $("html, body").animate({
                scrollTop: 0
              }, 1000);

              $('.alert-danger').fadeIn().html(data.message);
              setTimeout(function() {
                $('.alert-danger').fadeOut("slow");
              }, 7000);
            }

          }
        },
      });
    } else {
      console.log('Modification');
    }
  }
  // end next and previous function for save   
</script>

@endsection