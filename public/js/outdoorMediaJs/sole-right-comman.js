
//start section Media Address
$(document).ready(function () {
  $("#add_row_media_add").click(function () {
    var i = $("#count_id").val();

    //get selected cat and subcat 
    var $catoption = $('#applying_media_0').find('option:selected');
    var catvalue = $catoption.val(); //to get content of "value" 
    var cattext = $catoption.text(); //to get <option>Text</option> content
    //get train number textbox based cat ID == 1
    if (catvalue != '') {
      $('#applying_media_0').attr('readonly', true).css('pointer-events', 'none');
      var train_number_full_html = '';
      i++;

      var css = 'style="display:none"';
      var size_area = '';
      train_number_full_html = '<div class="col-md-4 train_no_' + i + '" ' + css + '><div class="form-group"><label for = "Train_No"> Train Number/Name / गाड़ी संख्या/नाम <font color = "red">  </font></label><p><input type="text" name="Train_Data[]" placeholder="Search By Train Number/Name" class="form-control form-control-sm traindata" id="Train_Data_' + i + '"  tabindex="' + i + '"></p></div></div>';

      var lit_type = '<div class="col-md-4 lit_type_' + i + '" ' + css + '><div class="form-group"><label for="lit_type">Lit Type<font color="red"></font></label><p><select name="lit_type[]" id="lit_type_' + i + '" class="form-control form-control-sm" tabindex="' + i + '"><option value="">Please Select</option><option value="1">Front Lit</option><option value="2" >Back Lit</option></select></p></div></div>';

      var no_of_spots = '<div class="col-md-4 no_of_spots_' + i + '" ' + css + '><div class="form-group"><label for="year">No. of Spots / स्पॉट की संख्या<font color="red"></font></label><p><input type="text" name="No_of_Spots[]" placeholder="Enter No of Spots" class="form-control form-control-sm" id="No_of_Spots_' + i + '" onkeypress="return onlyNumberKey(event)" tabindex="' + i + '"></p></div></div>';
      var size_area = '<div class="col-md-4 area_size_' + i + '" ' + css + '><div class="form-group"><label>Size Type / आकार प्रकार <font color="red"></font></label><p><select name="Size_Type[]" class="form-control form-control-sm" style="width: 100%;" id="Size_Type_' + i + '" tabindex="' + i + '"><option value="">Select Size Type</option><option value="1">CM </option><option value="2">FT</option></select></p></div></div>';
      var Illumination = '<div class="col-md-4"><div class="form-group"><label for="year">Illumination / रोशनी</label><p><select name="Illumination_media[]" id="Illumination_media_' + i + '"class="form-control form-control-sm illuminationType" tabindex="' + i + '"><option value="">Select Illumination</option><option value="1">Lit</option><option value="2">Non Lit</option></select></p></div></div>';

      var lenwidth_area = '<div class="col-md-4"><div class="form-group"><label for="license_to">Length / लंबाई</label><p><input type="text" name="length[]" size="5" placeholder="Enter Length" class="form-control form-control-sm size_area size_len_digit"  id="length_' + i + '" onkeypress="return onlyNumberKey(event)" tabindex="' + i + '"><span id="length_error_' + i + '" class="error invalid-feedback"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="year">Width / चौड़ाई<font color="red"></font></label><p><input type="text" name="width[]" placeholder="Enter Width" class="form-control form-control-sm size_area size_width_digit" size="5" id="width_' + i + '" onkeypress="return onlyNumberKey(event)" tabindex="' + i + '"><span id="width_error_' + i + '" class="error invalid-feedback"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="year">Total Area (sq. ft) / कुल क्षेत्रफल<font color="red"></font></label><p><input type="text" name="Total_Area[]" placeholder="Total Area" class="form-control form-control-sm" id="Total_Area_' + i + '" onkeypress="return onlyNumberKey(event)" style="pointer-events: none;" readonly></p></div></div>';
      var distcity = '<div class="col-md-4"><div class="form-group"><label for="Name">District / ज़िला<font color="red">*</font></label><p><select  name="MA_District[]" id="dist_id_' +
        i + '" class=" form-control form-control-sm"><option value="">Select District</option></select></p><span id="alert_dist_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="Name">City / नगर<font color="red">*</font></label><p><select name="MA_City[]" id="MA_City' + i + '" class=" form-control form-control-sm"><option value="">Select City</option></select></p></span></div></div>';

      // $.ajax({
      //   url: '/fetchStates',
      //   type: "GET",
      //   dataType: 'json',
      //   success: function (result) {
          // var obj = JSON.parse(data);
          var html = '';
          // var html = '<option value="">Select any state</option>';
          // $.each(result.data, function (key, value) {
          //   html += '<option value="' + value.Code + '">' + value
          //     .Description + '</option>';
          // });
          var state = '<div class="col-md-4"><div class="form-group"><label for="Name">State / राज्य<font color="red">*</font></label><p><select name="MA_State[]" class="form-control form-control-sm call_district" id="state_id_' +
            i + '" data="dist_id_' + i + '" cityid="MA_City' + i + '">' + html + '</select></p><span id="alert_state_dd" style="color: red;"></span></div></div>';

          $("#media_address").append(
            '<hr id="hrline_' + i + '"><div class="row"><div class="col-md-4"><div class="form-group"><label>Media Category / मीडिया श्रेणी <font color="red">*</font></label><p><select name="Applying_For_OD_Media_Type[]" tabindex="' + i + '" id="applying_media_' + i + '" data-val="showcategory_' + i + '" class="form-control form-control-sm mediaclass" style="width: 100%;"><option value="">Select Category</option><option value="' + catvalue + '">' + cattext + '</option></select></p></div></div><div class="col-md-4" id="subcategory"><div class="form-group"><label>Media Sub-Category / मीडिया उप-श्रेणी <font color="red">*</font> </label><p><select name="od_media_type[]" class="form-control-sm form-control subcategory dynemicsub_cat' + i + '" tabindex="' + i + '" data-eid="showcategory_' + i + '" id="showcategory_' + i + '"><option value="">Select Sub-Category</option></select></p></div></div>' + train_number_full_html + no_of_spots + '<div class="col-md-4"><div class="form-group"><label for="year">Quantity/No. of Location / मात्रा/सं. का स्थान<font color="red">*</font></label><p><input type="text" name="quantity[]" placeholder="Enter Quantity/No. of Location" tabindex="' + i + '" class="form-control form-control-sm empty lat_media" id="quantity_' + i + '" onkeypress="return onlyNumberKey(event)"  maxlength="4"></p></div></div><div class="col-md-4" id="location_type_' + i + '" style="display: none;margin-top: 30px;"><h6><button type="button" id="" tabindex="' + i + '" data-toggle="modal" data-target="#myLocationModal"  class="btn btn-primary btn-sm m-0 add-location-modal"><i class="fa fa-edit" aria-hidden="true"></i>Add Location</button></h6></div><input type="hidden" name="location_data[]" id="location_data_' + i + '"><input type="hidden" name="OD_media_asset_ID[]" id="OD_media_asset_ID_' + i + '"><div class="col-md-10"></div><div class="col-md-2" style="padding: 0% 0 0 7%;"><button class="btn btn-danger btn-sm m-0 remove_row" data="' + i + '" style="font-size: 13px;"><i class="fa fa-minus"></i> Remove</button></div></div>'
          );
          $('.select2').select2();
        // }
      // });
    }

    $("#count_id").val(i);
  });
  $("#media_address").on('click', '.remove_row', function (event) {
    var ind = $(this).attr('data');
    var line_no = $("#line_no_m" + ind).val();
    var odmedia_id = $("#odmedia_id_m" + ind).val();
    var subcatval = $("#showcategory_"+ind).find('option:selected').val();

    if (line_no != '' && odmedia_id != '') {
      if (confirm("Are you sure you want to delete this??")) {
        event.preventDefault()
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'post',
          url: '/remove-mediaaddress-data',
          data: {
            line_no: line_no,
            od_media_id: odmedia_id,
            subcatval: subcatval
          },
          success: function (response) {
            console.log(response);
          }
        });
      } else {
        return false;
      }
    }
    $(this).parent().parent().remove();
    $("#hrline_" + ind).remove();
    var add_count = $("#count_id").val();
    $("#count_id").val(add_count - 1);
    if ($("#count_id").val() == 0) {
      $('#applying_media_0').attr('readonly', false).css('pointer-events', '');
    }
  });
});

$("#xls_show").hide();
$("#xlxyes").click(function () {
  var xlsvalue = $(this).val();
  if (xlsvalue == '1') {
    $("#xls_show").show();

    $("#choose_category").show(); //add 20 Apr	
    $("#download").show(); //add 20 apr	
    $("#media_address").hide();
    $("#add_row_media_add").hide();
  }
});
$("#xlxno").click(function () {
  var xlsvalue = $(this).val();
  if (xlsvalue == '0') {
    $("#xls_show").hide();
    $("#choose_category").hide();  //add 20 Apr	
    $("#download").hide(); //add 20 apr	
    $("#media_address").show();
    $("#add_row_media_add").show();
    var $el = $('#media_address_import'); //for refresh excel import field add 21 Apr	
    $el.wrap('<form>').closest('form').get(0).reset(); //add 21 Apr	
    $el.unwrap(); //add 21 Apr	
  }
});
//end section Media Address

//get district based state
$(document).on('change', '.call_district', function () {
  if ($(this).val() != '') {
    var id = $(this).attr("data");
    var cityid = $(this).attr("cityid");
    $("#" + id).empty();
    $("#" + cityid).empty();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'POST',
      url: '/fetchDistricts',
      data: {
        state_code: $(this).val()
      },
      success: function (response) {
        $("#" + id).html(response.districts);
        $("#" + cityid).html(response.cities);
      }
    });
  }
});
//end get district based state

//get subcategory based category

$(document).on('change', '.mediaclass', function () {
  if ($(this).val() != '') {

    var id = $(this).attr("data-val");
    var i;
    var dyn_sub = [];
    var tabindex = $(this).attr("tabindex");
    $("#quantity_"+tabindex).val('');
    $("#edit_location_data_" + tabindex).hide();
    for (i = 0; i <= tabindex; i++) {
      if (i > 0) {
        var autoid = i - 1;
        var idattrdynsub = $('.dynemicsub_cat' + autoid).attr('id');
        var id_attrdyn_sub12 = idattrdynsub.slice(0, 13);
        var id_attrdyn_sub = id_attrdyn_sub12.concat(autoid);
        dyn_sub.push($('#' + id_attrdyn_sub).val());
      }
    }
    console.log(dyn_sub);
    $("#" + id).empty();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'POST',
      url: '/get-sub-category',
      data: {
        media_code: $(this).val(),
        dyn_sub: dyn_sub
      },
      success: function (response) {
        $("#" + id).html(response);
      }
    });
  }
});
//end get subcategory based category

//start section Details of work
$("#xlxyes2").click(function () {
  var xlsvalue = $(this).val();
  if (xlsvalue == '1') {
    $("#xls_show2").show();
    $("#xls_show3").hide();
    $("#details_of_work_done").hide();
    $("#add_row_next").hide();
    $("#sample_file").show();
  }

});
$("#xlxno2").click(function () {
  var xlsvalue = $(this).val();
  if (xlsvalue == '0') {
    $("#xls_show2").hide();
    $("#xls_show3").show();
    $("#details_of_work_done").show();
    $("#add_row_next").show();
    $("#sample_file").hide();
  }
});

$(document).ready(function () {

  var today = (new Date()).toISOString().split('T')[0];
  $("#add_row_next").click(function () {
    var i = $("#count_i").val();
    i++;
    var html =
      '<hr id="hrline_workdone_' + i + '"><div class="row" id="workid' + i + '"><div class="col-md-4"><div class="form-group"><label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label><p><input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" maxlength="8" id="quantity_duration' +
      i + '" onkeypress="return onlyNumberKey(event)" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm"></p></div></div><div class="col-md-4"><br><div class="form-group"><label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु)<font color="red">*</font></label><p><input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount' +
      i +
      '" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" maxlength="14" onkeypress="return onlyNumberKey(event)"></p></div></div><div class="col-md-4"><br><div class="form-group"><label for="from_date">From date / दिनांक से : <font color="red">*</font></label><p><input type="date" name="from_date[]" id="from_date' + i + '" class="form-control form-control-sm" maxlength="14"   max="' + today + '"></p></div></div><div class="col-md-4"><div class="form-group"><label for="to_date">To date / तारीख तक : <font color="red">*</font></label><p><input type="date" name="to_date[]" id="to_date' + i + '" class="form-control form-control-sm" maxlength="14"  max="' + today + '"></p></div></div><div class="col-md-8"></div><div class="col-md-10"></div><div class="col-md-2" style="padding: 0% 0 0 7%;"><button class="btn btn-danger  btn-sm m-0 remove_row_next" data="' + i + '" style="font-size: 13px;"><i class="fa fa-minus"></i> Remove</button></div></div>';
    $("#details_of_work_done").append(html);
    $("#count_i").val(i);

  });
  $("#details_of_work_done").on('click', '.remove_row_next', function () {
    var ind = $(this).attr('data');

    var hide = $(this).attr('data-hide'); //for hide after delete

    var line_no = $("#line_no_" + ind).val();
    var odmedia_id = $("#odmedia_id_" + ind).val();
    if (line_no != '' && odmedia_id != '') {
      if (confirm("Are you sure you want to delete this?")) {

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'get',
          url: '/remove-workdone-data',
          data: {
            line_no: line_no,
            od_media_id: odmedia_id
          },
          success: function (response) {
            console.log(response);
            $("#" + hide).hide(); //for hide after delete
          }
        });
      } else {
        return false;
      }
    }
    $(this).parent().parent().remove();
    $("#hrline_workdone_" + ind).remove();
    var add_count = $("#count_i").val();
    $("#count_i").val(add_count - 1);
  });
  //Loop and add the Year values to DropDownList.
});
//end section Details of work

$(document).on('change', '.illuminationType', function () {
  var tabindex = $(this).attr("tabindex");
  if ($(this).val() == '1') {
    $(".lit_type_" + tabindex).show();
  } else {
    $(".lit_type_" + tabindex).hide();
    $("#lit_type_" + tabindex).val('');
  }
});

// $(document).on('change', '.subcategory', function () {
//   var tabindex = $(this).attr("tabindex");
//   var val = $(this).val();

//   // var trainArrdata = $("#trainArr").val();
//   // var trainArrs = trainArrdata.split(',');

//   // var noOfSpotsArr = $("#noOfSpotsArr").val();
//   // var SpotsArr = noOfSpotsArr.split(',');

//   var LWArr = $("#LWArr").val();
//   // var LWArray = LWArr.split(',');
//   var LWArray;
//   // $(".no_of_spots_" + tabindex).hide();
//   $(".area_size_" + tabindex).hide();
//   $("#Size_Type_" + tabindex).val('');
//   $("#length_" + tabindex).val('');
//   $('#width_' + tabindex).val('');
//   $('#Total_Area_' + tabindex).val('');
//   $('#No_of_Spots_' + tabindex).val('');
//   $('.train_no_' + tabindex).hide();
//   $('#Train_Data_' + tabindex).val('');

//   // if ($.inArray(val, SpotsArr) !== -1) {
//   //   $(".no_of_spots_" + tabindex).show();
//   // } else 
//   if ($.inArray(val, LWArray) !== -1) {
//     $(".area_size_" + tabindex).show();
//     if ($.inArray(val, trainArrs) !== -1) {
//       $('.train_no_' + tabindex).show();
//     } else {
//       $('.train_no_' + tabindex).hide();
//     }
//   } else if ($.inArray(val, trainArrs) !== -1) {
//     $('.train_no_' + tabindex).show();
//   }

//   // start show and hide lit
//   var litStr = $("#litArr").val();
//   var litArrs = litStr.split(',');
//   var catStr = $("#showcategory_" + tabindex).find(":selected").text();
//   $.each(litArrs, function (key, val) {
//     if (catStr.indexOf(val) != -1) {

//       $("#Illumination_media_" + tabindex + " option[value='1']").hide();
//       $("#Illumination_media_" + tabindex).val('');
//       return false;
//     } else {
//       $("#Illumination_media_" + tabindex + " option[value='1']").show();
//       $("#Illumination_media_" + tabindex).val('');
//     }
//   });
//   $(".lit_type_" + tabindex).hide();
//   $("#lit_type_" + tabindex).val('');

//   // end show and hide lit

// });

///////////// calculate total area /////////

$(document).on('keyup', '.size_area', function () {
  var tabindex = $(this).attr("tabindex");
  var areaperpage = $('#length_' + tabindex).val() * $('#width_' + tabindex).val();
  $('#Total_Area_' + tabindex).val(areaperpage.toFixed(2));
});

//start enter 0 to 5 digits for length and width

var maxLength = 5;
$(document).on("keydown keyup change", '.size_len_digit', function () {
  var tabindex = $(this).attr("tabindex");
  var value = $(this).val();
  if (value.length > maxLength) {
    $('#length_' + tabindex).val('');
    $("#len_error_" + tabindex).text("Please enter only 0 to 5 digits!").show();
  } else {
    $("#len_error_" + tabindex).text("").hide();
  }
});

$(document).on("keydown keyup change", '.size_width_digit', function () {
  var tabindex = $(this).attr("tabindex");
  var value = $(this).val();
  if (value.length > maxLength) {
    $('#width_' + tabindex).val('');
    $("#width_error_" + tabindex).text("Please enter only 0 to 5 digits!").show();
  } else {
    $("#width_error_" + tabindex).text("").hide();
  }
});
//end enter 0 to 5 digits for length and width

$(document).on('keyup', '.traindata', function () {
  var tabindex = $(this).attr("tabindex");
  $("#Train_Data_" + tabindex).autocomplete({
    source: function (request, response) {
      $.ajax({
        url: '/autocompletetrain',
        data: {
          term: request.term
        },
        dataType: "json",
        success: function (data) {
          var resp = $.map(data, function (obj) {
            return obj.train_no + ' - ' + obj.name;
          });
          response(resp);
        }
      });
    },
    minLength: 2,
  });
});

$(document).on('change', '.downloadclass', function () {
  if ($(this).val() != '') {

    var id = $(this).attr("data-val");
    $("#" + id).empty();
    $("#" + id).multiselect('rebuild');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'POST',
      url: '/get-subcategory-excel',
      data: {
        media_code: $(this).val(),
      },
      success: function (response) {
        $("#" + id).html(response);
        $("#" + id).multiselect('rebuild');
      }
    });
  }
});

$(document).ready(function () {
  // show add qty model
  $(".mediasub").change(function () {
    var subcatvalue = $(this).val();
    var subcattext = $("#mediasubcategory option:selected").map(function () {
      return $(this).text();
    }).get().join(',');

    $("#viewexcel").hide();
    $("#addQty").hide();
    if (subcatvalue != '' && subcattext != '') {
      $("#addqty_model").show();
    } else {
      $("#addqty_model").hide();
    }
  });

  // add qty according to sub category
  $(document).on("click", "#add_qty_model", function () {
    var subcattext = $("#mediasubcategory option:selected").map(function () {
      return '<div class="col-md-6"><div class="form-group"><label for="sub_category_model">Sub Category / उप श्रेणी<font color="red"></font></label><input type="text" name="sub_category_model[]" placeholder="Enter Sub Category" class="form-control form-control-sm" id="sub_category_model" value="' + $(this).text() + '" readonly></div></div><div class="col-md-6"><div class="form-group"><label for="quantity_model">Quantity / मात्रा<font color="red"></font></label><input type="text" name="quantity_model[]" placeholder="Enter Quantity" class="form-control form-control-sm" id="quantity_model" maxlength="4" onkeypress="return onlyNumberKey(event)"></div></div>';
    }).get();
    $("#model-addqty").html(subcattext);
  });

  // show media excel for download
  $("#save_qty").click(function () {

    var cattext = $("#mediacategory option:selected").text();
    var stateval = $("#stateid option:selected").val();
    var subcattext = $("#mediasubcategory option:selected").map(function () {
      return $(this).text();
    }).get().join(',');

    var subcatvalue = $("#mediasubcategory option:selected").map(function () {
      return $(this).val();
    }).get();

    var quantity_val = [];
    var empty = 0;
    $("input[name='quantity_model[]']").each(function (i) {
      if ($(this).val() != '') {
        quantity_val.push($(this).val());
      } else {
        empty = 1;
      }
    });

    console.log(empty);
    if (quantity_val.length == 0 || (empty == 1 && quantity_val.length > 0)) {
      alert('Please add quantity!');
      $("input[name='quantity_model[]']").each(function (i) {
        if ($(this).val() == '') {
          $(this).focus();
          return false;
        }
      });
      $("#viewexcel").hide();
      return false;
    }

    if (subcatvalue.length > 0) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: '/get-media-excel',
        data: { subcatvalue: subcatvalue, subcattext: subcattext, cattext: cattext, quantity: quantity_val, MAState: stateval },
        success: function (response) {
          $("#addQty").show();
          $("#viewexcel").show();
          $("#downloadexcel").attr("href", response.file);
          $("#downloadexcel").attr("download", response.name);
          $("#addqty_model").hide();
        }
      });
    } else {
      $("#viewexcel").hide();
    }
  });
});

$('#mediasubcategory').multiselect({
  nonSelectedText: 'Select Sub-Category',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth: '100%',
  textleft: true,
  includeSelectAllOption: true,
});

$(document).on("change", ".subcategory", function () {
  var getID = $(this).attr('data-eid');
  var sub_category_val = $("#" + getID).val();
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    },
    url: '/find-sub-category',
    type: 'GET',
    data: { sub_category_val: sub_category_val },
    success: function (data) {
      if (data.status == '1') {
        swal("Error", "You can not select this value!", "error");
        $("#" + getID).val('');
        // sweet alert
      }

    }
  });

});

////////////// file upload size  2 mb ////////////////
$(document).ready(function () {
  $(".custom-file-input").change(function () {
    var id = $(this).attr("id");
    id.slice(1);
    var file = this.files[0].name;
    var file1 = $('#' + id + 2).text();
    var totalBytes = this.files[0].size;
    var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
    var ext = file.split('.').pop();
    if (file != '' && sizemb <= 2 && ext == "pdf") {
      $("#" + id + 2).empty();
      $("#" + id + 2).text(file);
      $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#" + id + 1).hide();
      if ($("#doc_data").val() == '') {
        $("#doc_data").val(file);
      } else {
        var names = $("#doc_data").val();
        var numbersArray = names.split(',');

        if (isInArray(file, numbersArray) == false) {
          $("#doc_data").val(function () {
            return $("#doc_data").val() + ',' + file;
          });
          var namess = $("#doc_data").val();
          var numbersArray1 = namess.split(',');
          numbersArray1 = $.grep(numbersArray1, function (value) {
            return value != file1;
          });
          $("#doc_data").val(numbersArray1);
          $("#" + id + 1).hide();
        } else {
          var namess = $("#doc_data").val();
          var numbersArray1 = namess.split(',');
          numbersArray1 = $.grep(numbersArray1, function (value) {
            return value != file1;
          });
          $("#doc_data").val(numbersArray1);
          $("#" + id).val('');
          $("#" + id + 2).text("Choose file");
          $("#" + id + 3).html("Upload").addClass("input-group-text");
          $("#" + id + 1).text('File already selected!');
          $("#" + id + 1).show();
          $("#" + id + "-error").addClass("hide-msg");
        }
      }
    } else {
      $("#" + id).val('');
      $("#" + id + 2).text("Choose file");
      $("#" + id + 1).text('File size should be less than 2MB and file should be pdf!');
      $("#" + id + 1).show();
      $("#" + id + 3).html("Upload").addClass("input-group-text");
      $("#" + id + "-error").addClass("hide-msg");
    }
  });
});



