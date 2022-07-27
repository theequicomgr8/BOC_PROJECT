
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
        
        var Duration = '<div class="col-md-4 Duration_' + i + '" ' + css + '><div class="form-group"><label for="year">Duration / अवधि<font color="red"></font></label><p><input type="text" name="duration[]" placeholder="Enter Duration" class="form-control form-control-sm" id="Duration_' + i + '" onkeypress="return onlyNumberKey(event)" tabindex="' + i + '"></p></div></div>';

        train_number_full_html = '<div class="col-md-4 train_no_' + i + '" ' + css + '><div class="form-group"><label for = "Train_No"> Train Number/Name / गाड़ी संख्या/नाम <font color = "red">  </font></label><p><input type="text" name="Train_Data[]" placeholder="Search By Train Number/Name" class="form-control form-control-sm traindata" id="Train_Data_' + i + '"  tabindex="' + i + '"></p></div></div>';
  
        var lit_type = '<div class="col-md-4 lit_type_' + i + '" ' + css + '><div class="form-group"><label for="lit_type">Lit Type<font color="red"></font></label><p><select name="lit_type[]" id="lit_type_' + i + '" class="form-control form-control-sm" tabindex="' + i + '"><option value="">Please Select</option><option value="1">Front Lit</option><option value="2" >Back Lit</option></select></p></div></div>';
  
        var no_of_spots = '<div class="col-md-4 no_of_spots_' + i + '" ' + css + '><div class="form-group"><label for="year">No. of Spots / स्पॉट की संख्या<font color="red"></font></label><p><input type="text" name="No_of_Spots[]" placeholder="Enter No of Spots" class="form-control form-control-sm" id="No_of_Spots_' + i + '" onkeypress="return onlyNumberKey(event)" tabindex="' + i + '"></p></div></div>';
        
        var size_area = '<div class="col-md-4 area_size_' + i + '" ' + css + '><div class="form-group"><label>Size Type / आकार प्रकार <font color="red"></font></label><p><select name="Size_Type[]" class="form-control form-control-sm" style="width: 100%;" id="Size_Type_' + i + '" tabindex="' + i + '"><option value="">Select Size Type</option><option value="1">CM </option><option value="2">FT</option></select></p></div></div><div class="col-md-4 area_size_' + i + '" ' + css + '><div class="form-group"><label for="license_to">Length / लंबाई</label><p><input type="text" name="length[]" size="5" placeholder="Enter Length" class="form-control form-control-sm size_area size_len_digit"  id="length_' + i + '" onkeypress="return onlyNumberKey(event)" tabindex="' + i + '"><span id="length_error_' + i + '" class="error invalid-feedback"></span></p></div></div><div class="col-md-4 area_size_' + i + '" ' + css + '><div class="form-group"><label for="year">Width / चौड़ाई<font color="red"></font></label><p><input type="text" name="width[]" placeholder="Enter Width" class="form-control form-control-sm size_area size_width_digit" size="5" id="width_' + i + '" onkeypress="return onlyNumberKey(event)" tabindex="' + i + '"><span id="width_error_' + i + '" class="error invalid-feedback"></span></p></div></div><div class="col-md-4 area_size_' + i + '" ' + css + '><div class="form-group"><label for="year">Total Area (sq. ft) / कुल क्षेत्रफल<font color="red"></font></label><p><input type="text" name="Total_Area[]" placeholder="Total Area" class="form-control form-control-sm" id="Total_Area_' + i + '" onkeypress="return onlyNumberKey(event)" style="pointer-events: none;" readonly></p></div></div>';
        $.ajax({
          url: '/fetchStates',
          type: "GET",
          dataType: 'json',
          success: function (result) {
            // var obj = JSON.parse(data);
            var html = '';
            var html = '<option value="">Select any state</option>';
            $.each(result.data, function (key, value) {
              html += '<option value="' + value.Code + '">' + value
                .Description + '</option>';
            });
            
            $("#media_address").append(
              '<hr id="hrline_' + i + '"><div class="row"><div class="col-md-4"><div class="form-group"><label for="Name">State / राज्य<font color="red">*</font></label><p><select name="MA_State[]" class="form-control form-control-sm call_district" id="state_id_' +
              i + '" data="dist_id_' + i + '" cityid="MA_City' + i + '">' + html +
              '</select></p><span id="alert_state_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="Name">District / ज़िला<font color="red">*</font></label><p><select  name="MA_District[]" id="dist_id_' +
              i + '" class=" form-control form-control-sm"><option value="">Select District</option></select></p><span id="alert_dist_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="Name">City / नगर<font color="red">*</font></label><p><select name="MA_City[]" id="MA_City' + i + '" class=" form-control form-control-sm"><option value="">Select City</option></select></p></span></div></div><div class="col-md-4"><div class="form-group"><label>Media category / मीडिया श्रेणी <font color="red">*</font></label><p><select name="Applying_For_OD_Media_Type[]" tabindex="' + i + '" id="applying_media_' + i + '" data-val="showcategory_' + i + '" class="form-control form-control-sm prmediaclass" style="width: 100%;"><option value="">Select Category</option><option value="' + catvalue + '">' + cattext + '</option></select></p></div></div><div class="col-md-4" id="subcategory" ><div class="form-group"><label>Media Sub-Category / मीडिया उप-श्रेणी <font color="red">*</font> </label><p><select name="od_media_type[]" class="form-control-sm form-control subcategory dynemicsub_cat' + i + '" tabindex="' + i + '" data-eid="showcategory_' + i + '" id="showcategory_' + i + '"><option value="">Select Sub-Category</option></select></p></div></div>' +  Duration + '<div class="col-md-4"><div class="form-group"><label for="year">Quantity/No. Of Location / मात्रा/सं. का स्थान<font color="red">*</font></label><p><input type="text" name="quantity[]" placeholder="Location Quantity" tabindex="' + i + '" class="form-control form-control-sm empty lat_media" id="quantity_' + i + '" onkeypress="return onlyNumberKey(event)"></p></div></div><div class="col-md-4"><div class="form-group"><label for="year">Illumination / रोशनी</label><p><select name="Illumination_media[]" id="Illumination_media_' + i + '"class="form-control form-control-sm illuminationType" tabindex="' + i + '"><option value="">Select Illumination</option><option value="1">Lit</option><option value="2">Non Lit</option></select></p></div></div>' + lit_type + size_area + '<div class="col-md-10"></div><div class="col-md-2" style="padding: 0% 0 0 6%;"><button class="btn btn-danger remove_row" data="' + i + '" style="font-size: 13px;"><i class="fa fa-minus"></i> Remove</button></div></div>'
            );
            $('.select2').select2();
          }
        });
      }
  
      $("#count_id").val(i);
    });
    $("#media_address").on('click', '.remove_row', function () {
  
      var ind = $(this).attr('data');
      var line_no = $("#line_no_m" + ind).val();
      var odmedia_id = $("#odmedia_id_m" + ind).val();
      if (line_no != '' && odmedia_id != '') {
        if (confirm("Are you sure you want to delete this?")) {
  
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'get',
            url: '/remove-mediaaddress-data',
            data: {
              line_no: line_no,
              od_media_id: odmedia_id
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
      $("#hrline_"+ind).remove();
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
  
  $(document).on('change', '.prmediaclass', function () {
    if ($(this).val() != '') {
  
      var id = $(this).attr("data-val");
      var i;
      var dyn_sub = [];
      var tabindex = $(this).attr("tabindex");
  
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
        url: '/perfetchmedia',
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
      $("#details_of_work_done").hide();
      $("#add_row_next").hide();
    }
  
  });
  $("#xlxno2").click(function () {
    var xlsvalue = $(this).val();
    if (xlsvalue == '0') {
      $("#xls_show2").hide();
      $("#details_of_work_done").show();
      $("#add_row_next").show();

      var $el = $('#media_address_import2'); //for refresh excel import field add 21 Apr 
      $el.wrap('<form>').closest('form').get(0).reset(); //add 21 Apr 
      $el.unwrap(); //add 21 Apr
    }
  });
  
  $(document).ready(function () {
    var currentYear = (new Date()).getFullYear();
    for (var i = 1980; i <= currentYear; i++) {
      var option = document.createElement("OPTION");
      option.innerHTML = i;
      option.value = i;
      $(".ddlYears").append(option);
    }
    $("#add_row_next").click(function () {
      var i = $("#count_i").val();
      i++;
      var html =
        '<hr id="hrline_workdone_' + i + '"><div class="row" id="workid' + i + '"><div class="col-md-4"><br><div class="form-group"><label for="year">Year / वर्ष<font color="red">*</font></label><p><select name="ODMFO_Year[]" id="Years' +
        i +
        '" class="form-control form-control-sm ddlYears"><option value="">Select Year</option></select></p></div></div><div class="col-md-4"><div class="form-group"><label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label><p><input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" maxlength="8" id="quantity_duration' +
        i +
        '" onkeypress="return onlyNumberKey(event)" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm"></p></div></div><div class="col-md-4"><br><div class="form-group"><label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु)<font color="red">*</font></label><p><input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount' +
        i +
        '" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" maxlength="14" onkeypress="return onlyNumberKey(event)"></p></div></div><div class="col-md-4"><div class="form-group"><label for="from_date">From date / की दिनांक से : <font color="red">*</font></label><p><input type="date" name="from_date[]" id="from_date' +
        i +
        '" class="form-control form-control-sm" maxlength="14"></p></div></div><div class="col-md-4"><div class="form-group"><label for="to_date">To date / तारीख तक : <font color="red">*</font></label><p><input type="date" name="to_date[]" id="to_date' +
        i +
        '" class="form-control form-control-sm" maxlength="14"></p></div></div><div class="col-md-6"></div><div class="col-md-6"><button class="btn btn-danger remove_row_next" data="' + i + '" style="margin: 8% 0 0 81%; font-size: 13px;"><i class="fa fa-minus"></i> Remove</button></div></div>';
      $("#details_of_work_done").append(html);
      $("#count_i").val(i);
      for (var i = 1980; i <= currentYear; i++) {
        var option = document.createElement("OPTION");
        option.innerHTML = i;
        option.value = i;
        $(".ddlYears").append(option);
      }
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
      $("#hrline_workdone_"+ind).remove();
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
  
  $(document).on('change', '.subcategory', function () {
    var tabindex = $(this).attr("tabindex");
    var val = $(this).val();
  
    // var trainArrdata = $("#trainArr").val();
    // var trainArrs = trainArrdata.split(',');
  
    var durationsArr = $("#durationArr").val();
    console.log(durationArr);
    var durationArr = durationsArr.split(',');
  
    // var LWArr = $("#LWArr").val();
    // var LWArray = LWArr.split(',');
  
    $(".Duration_" + tabindex).hide();
    // $(".area_size_" + tabindex).hide();
    // $("#Size_Type_" + tabindex).val('');
    // $("#length_" + tabindex).val('');
    // $('#width_' + tabindex).val('');
    // $('#Total_Area_' + tabindex).val('');
    $('#Duration_' + tabindex).val('');
    // $('.train_no_' + tabindex).hide();
    // $('#Train_Data_' + tabindex).val('');
  
    if ($.inArray(val, durationArr) !== -1) {
      $(".Duration_" + tabindex).show();
    } 
    
  
    // start show and hide lit
    var litStr = $("#litArr").val();
    var litArrs = litStr.split(',');
    var catStr = $("#showcategory_" + tabindex).find(":selected").text();
    $.each(litArrs, function (key, val) {
      if (catStr.indexOf(val) != -1) {
  
        $("#Illumination_media_" + tabindex + " option[value='1']").hide();
        $("#Illumination_media_" + tabindex).val('');
        return false;
      } else {
        $("#Illumination_media_" + tabindex + " option[value='1']").show();
        $("#Illumination_media_" + tabindex).val('');
      }
    });
    $(".lit_type_" + tabindex).hide();
    $("#lit_type_" + tabindex).val('');
  
    // end show and hide lit
  
  });
  
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
  
  
  $(document).ready(function () {
    $(".mediasub").change(function () {
      var catvalue = $(this).val();
      console.log(catvalue);
      var ary2 = ["OD001", "OD002", "OD003", "OD004", "OD005", "OD008", "OD015", "OD016", "OD022", "OD024", "OD029", "OD030", "OD032", "OD033", "OD034", "OD039", "OD043", "OD058", "OD059", "OD060", "OD061", "OD062", "OD063", "OD064", "OD065", "OD069", "OD070", "OD080", "OD081", "OD083", "OD091", "OD100", "OD101", "OD104", "OD105", "OD106", "OD109", "OD111", "OD112", "OD114", "OD115", "OD116", "OD119", "OD121", "OD128", "OD130", "OD129", "OD124", "OD052", "OD067", "OD132", "OD058", "OD059", "OD060", "OD111", "OD064", "OD088", "OD119", "OD028", "OD022"];
  
      var ary3 = ["OD053", "OD010", "OD011", "OD014", "OD017", "OD018", "OD019", "OD135", "OD020", "OD023", "OD024", "OD025", "OD036", "OD037", "OD038", "OD044", "OD047", "OD048", "OD054", "OD055", "OD057", "OD071", "OD082", "OD084", "OD088", "OD089", "OD090", "OD092", "OD095", "OD108", "OD113", "OD117", "OD041", "OD120"];
  
      var ary4 = ["OD006", "OD013", "OD072", "OD073", "OD110", "OD122", "OD086", "OD087", "OD123", "OD127"];
  
      if (jQuery.inArray(catvalue, ary2) !== -1) {
        $("#second").show();
        $("#three").hide();
        $("#four").hide();
      }
      else if (jQuery.inArray(catvalue, ary3) !== -1) {
        $("#three").show();
        $("#second").hide();
        $("#four").hide();
      }
      else if (jQuery.inArray(catvalue, ary4) !== -1) {
        $("#four").show();
        $("#second").hide();
        $("#three").hide();
      }
      else {
        $("#second").hide();
        $("#three").hide();
        $("#four").hide();
      }
  
  
  
    });
  });
  
  $(document).on('change', '.downloadclass', function () {
    if ($(this).val() != '') {
  
      var id = $(this).attr("data-val");
      var i;
      var dyn_sub = []; 
      console.log(dyn_sub);
      $("#" + id).empty();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: '/perfetchmedia',
        data: {
          media_code: $(this).val(),
        },
        success: function (response) {
          $("#" + id).html(response);
  
        }
      });
    }
  });