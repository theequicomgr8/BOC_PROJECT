// use for check GST unique
function checkGstUnique(val) {
    if (val != '') {
        $("#name").val("Please Wait...");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: "get",
            url: "check-gstno",
            data: {
                gst_no: val
            },
            success: function (data) {
                if (data['status'] == true) {
                    if ($('.gstvalidationMsg').hasClass('alert-info-msg') == true) {
                        $('.gstvalidationMsg').addClass('alert-info-msg2');
                        $('.gstvalidationMsg').text(data['message']);
                        $('.validcheck').html("");
                    }
                } else {
                    $.ajax({
                        url: '/checkgstprint',
                        type: 'GET',
                        data: { gstNumber: val },
                        success: function (data) {
                            console.log(data);
                            if (data != '') {
                                $("#name").val(data.legalName);
                            }
                        }
                    });
                }
            },
            error: function (error) {
                console.log('error');
            }
        });
    }
}

// use for verify (RNI,ABC) data based on Circulation Base
function checkRegCIRBase(val) {
  var cir_no = $("#cir_base").val();
  if (val != '' && cir_no != '') {
    $("#rni_reg_no").hide();
    $("#abc_cert_no").hide();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "get",
      url: 'check-regno-cir-base',
      data: {
        cir_no: cir_no,
        reg_no: val
      },
      success: function (data) {
        if (data.status == true) {
          console.log(data);

          if (data.message) {
            $("#claimed_circulation").css("border-color", "#ced4da");
            $("#claimed_circulation-error").hide();
          }
          $("#rni_reg_no").text(data.message).show().css("color", "green");
          $("#abc_cert_no").text(data.message).show().css("color", "green");
          if (cir_no == 0) {
            $("#rni_efiling_no").val(data.data['Efile Number']);
            $("#rni_efiling_no").prop("readonly", true);
            $("#rni_efill_no").text(data.message).show().css("color", "green");
            if (($.trim(data.data['Efiling Number Valid']) == 'Yes') && ($.trim(data.data['Efiling veryfied']) == 'Yes')) {
              $("#rni_annual_valid").val(1);
            }
            $("#newspaper_name").val(data.data['Publication Name']);
            $("#rni_reg_no_verified").val(1);
          } else if (cir_no == 3) {
            $("#abc_reg_no_verified").val(1);
            $("#newspaper_name").val(data.data['Publication Name']);
          }
          $("#claimed_circulation").val(data.data['Sold Circulation']);
          $("#claimed_circulation_hidden").val(data.data['Sold Circulation']);
          $("#claimed_circulation_verified").val(1);
          if (parseInt(data.data['Sold Circulation']) > 25000) {
            $("#rni_claimed_cirl").text('PCI no dues certificate is mandatory at tab 4').show().css("color", "#f8b739");
            $("#no_dues_cert").show();
            $("#abc_rni_cert").show();

          } else {
            $("#rni_claimed_cirl").text(data.message).show().css("color", "green");
            $("#no_dues_cert").hide();
            $("#abc_rni_cert").hide();
          }
          // }
          console.log("success");
          $("#tab_1").css('pointer-events', 'visible');
        } else {
          console.log("fail");
          $("#tab_1").css('pointer-events', 'none');
          if (data.message == 'Data already exist!' && cir_no == 0) {

            $("#rni_reg_no").text(data.message).show().css("color", "red");
          } else if (data.message == 'Data already exist!' && cir_no == 3) {

            $("#abc_cert_no").text(data.message).show().css("color", "red");
          } else {
            $("#rni_reg_no").text(data.message).show().css("color", "#f8b739");
            $("#abc_cert_no").text(data.message).show().css("color", "#f8b739");
            $("#rni_claimed_cirl").hide();
            $("#rni_efill_no").hide();
            if (cir_no == 0) {
              $("#rni_efiling_no").val('');
            }
            $("#claimed_circulation").val('');
            $("#rni_efiling_no").prop("readonly", false);
            $("#rni_reg_no_verified").val(0);
            $("#claimed_circulation_verified").val(0);
            $("#rni_annual_valid").val(0);
            $("#newspaper_name").val('');
          }
        }
      },
      error: function (error) {
        console.log('error');
      }
    });

    checkFirstPublication(cir_no);
    return true;
  } else {
    $("#rni_reg_no").hide();
    $("#abc_cert_no").hide();
    $("#rni_claimed_cirl").hide();
    $("#rni_efill_no").hide();
    $("#rni_efiling_no").val('');
    $("#rni_annual_valid").val('');
    $("#rni_reg_no_verified").val('');
    $("#claimed_circulation").val('');
    $("#claimed_circulation_verified").val('');
    $("#claimed_circulation_hidden").val('');
  }
}

//check date of first publication
function checkFirstPublication(cir_no){
    if (cir_no == 0 && $("#rni_efiling_no").val() == '') {
        // date of first publication grether than 4 months
        let today = new Date();
        today.setMonth(today.getMonth() - 4);
        let date1 = dateFormate(today);
        var date_offirst_publication = $("#firstpublicationdate").val();
        if (date_offirst_publication != '') {
          var date_offirst_publication1 = new Date(date_offirst_publication);
          var date = dateFormate(date_offirst_publication1);
          if (date >= date1) {
            $("#dateoffirstpublication").text('Date of first publication should be grether than 4 months').show();
            $("#tab_1").css('pointer-events', 'none');
          } else {
            $("#dateoffirstpublication").hide();
            $("#tab_1").css('pointer-events', 'visible');
          }
        } else {
          $("#dateoffirstpublication").hide();
        }
      }
}

//start code of display owner press data 
$(document).ready(function () {
    $(".owner_press").on('click', function () {
        var owner_id = $("#ownerid").val();
        if (owner_id != '' && $(this).val() == 1) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                },
                type: "get",
                url: 'get-press-owner-data',
                data: {
                    owner_id: owner_id
                },
                success: function (data) {
                    // console.log(data);
                    if (data['status'] == true) {
                        console.log("success");
                        $("#name_of_press").val(data.data['Name of Press']).prop("readonly", true);
                        $("#press_email").val(data.data['Press Email']).prop("readonly", true);
                        $("#press_mobile").val(data.data['Press Mobile']).prop("readonly", true);
                        $("#press_phone").val(data.data['Press Phone']).prop("readonly", true);
                        $("#address_of_press").val(data.data['Address of Press']).prop("readonly", true);
                        $("#distance_press").val(Math.round(data.data['Distance from office to press'])).prop("readonly", true);
                    } else {
                        $("#name_of_press").val('').prop("readonly", false);
                        $("#press_email").val('').prop("readonly", false);
                        $("#press_mobile").val('').prop("readonly", false);
                        $("#press_phone").val('').prop("readonly", false);
                        $("#address_of_press").val('').prop("readonly", false);
                        $("#distance_press").val('').prop("readonly", false);
                    }
                },
                error: function (error) {
                    console.log('error');
                }
            });
        } else {
            $("#name_of_press").prop("readonly", false);
            $("#press_email").prop("readonly", false);
            $("#press_mobile").prop("readonly", false);
            $("#press_phone").prop("readonly", false);
            $("#address_of_press").prop("readonly", false);
            $("#distance_press").prop("readonly", false);
        }
    });
});
//end code of display owner press data 

// use for save previous activity
$(document).ready(function () {
    $(".previousClass").click(function () {
        var activity_id = $(this).attr("data");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: "get",
            url: 'fresh-empanelment-previous',
            data: {
                activity_id: activity_id
            },
            success: function (data) {
                console.log(data);
                if (data['success'] == true) {
                    console.log("success");
                }
            },
            error: function (error) {
                console.log('error');
            }
        });
    });
});

// Check Unique Data of vendor
function checkUniqueVendor(id, val) {
    if (val != '') {
        var email = val;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'GET',
            url: 'checkuniquevendor/' + email,
            data: {},
            success: function (response) {
                if (response.status == 0 && val != $("#vendor_" + id).val()) {
                    $("#v_alert_" + id).html(titleCase(id) + ' ' + response.message);
                    $("#v_alert_" + id).show();
                    $("#v_" + id).val('');
                } else {
                    $("#v_alert_" + id).hide();
                }
            }
        });
    }
}

// get district and city based on state 
$(document).ready(function () {
    $(".call_district").change(function () {
        if ($(this).val() != '') {
            var id = $(this).attr("data");
            var cityid = $(this).attr("cityid");
            $("#" + id).empty();
            $("#" + cityid).empty();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                },
                type: 'get',
                url: 'getdistrictcity',
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
});

//  get exist owner details
$(document).ready(function () {
    $("#add_davp").hide();
    $("#add_davp").empty();
    $("#exist_owner_id").on('keyup', function () {
        $("#is_primary2").prop("checked", false);
        if ($(this).val() != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                },
                type: 'get',
                url: 'existownerdata',
                data: {
                    owner_id: $(this).val()
                },
                success: function (response) {

                    if (response.status == 0) {
                        // $("#name").val(response.message['owner_datas']['Owner Name']);
                        $("#ownerid").val(response.message['owner_datas']['Owner ID']);
                        $("#email").val(response.message['owner_datas']['Email ID']);
                        $("#mobile").val(response.message['owner_datas']['Mobile No_']);
                        $("#address").val(response.message['owner_datas']['Address 1']);                       
                        $("#phone").val(response.message['owner_datas']['Phone No_']);
                        $("#fax").val(response.message['owner_datas']['Fax No_']);
                        // $("#name").prop("readonly", true);
                        $("#email").prop("readonly", true);
                        $("#mobile").prop("readonly", true);
                        $("#address").prop("readonly", true);                        
                        $("#phone").prop("readonly", true);
                        $("#fax").prop("readonly", true);

                        var option_state = "<option value='" + response.message['owner_datas']['Code'] + "'> " + response.message['owner_datas']['Code'] + " ~ " + response.message['owner_datas']['Description'] + "</option>";
                        
                        var option_district = "<option value='" + response.message['owner_datas']['District'] + "'>" + response.message['owner_datas']['District'] + "</option>";

                        var owner_type_arr = ['Individual', 'Partnership', 'Trust', 'Society', 'Proprietorship', 'Public Ltd', 'Pvt Ltd'];
                        var owner_type = [];
                        $.each(owner_type_arr, function (index, item) {
                            owner_type.push("<option value='" + index + "' " + (index == response.message['owner_datas']['Owner Type'] ? 'selected' : '') + ">" + item + "</option>");
                        });

                        var option_city = "<option value='" + response.message['owner_datas']['City'] + "'>" + response.message['owner_datas']['City'] + "</option>";

                        $("#owner_type").html(owner_type).addClass('pointercss');
                        $("#state").html(option_state).addClass('pointercss');
                        $("#district").html(option_district).addClass('pointercss');
                        $("#city").html(option_city).addClass('pointercss');
                        $("#owner_type").prop("readonly", true);
                        $("#state").prop("readonly", true);
                        $("#district").prop("readonly", true);
                        $("#city").prop("readonly", true);
                        $("#alert_exist_owner_id").hide();
                        $("#edition1").prop('checked', true);
                        $("#edition2").prop('checked', false);
                        $("#davp_panel").prop('checked', true);
                        $("#add_davp").show();
                        $("#add_davp").empty();
                        var len = response.message['owner_other_datas'].length - 1;
                        var date_offirst_publication = response.message['owner_other_datas'][len]['Date Of First Publication'];
                        let today = new Date();
                        today.setMonth(today.getMonth() - 4);
                        let date1 = dateFormate(today);

                        if (date_offirst_publication != '') {
                            $("#firstpublicationdate").val(date_offirst_publication);
                            if (date_offirst_publication >= date1) {
                                $("#tab_1").css('pointer-events', 'none');
                            } else {
                                $("#dateoffirstpublication").hide();
                                $("#tab_1").css('pointer-events', 'visible');
                            }
                        } else {
                            $("#dateoffirstpublication").hide();
                        }

                        $.each(response.message['owner_other_datas'], function (index, item) {
                            var periocity_val = item['Periodicity'];
                            var dis = item['Distance from office to press'];
                            $("#add_davp").append('<div class="row"><div class="col-md-12"><h4 class="subheading">Details of other publications of same owner or Publisher-----/एक ही मालिक या प्रकाशक के अन्य प्रकाशनों का विवरण ----</h4></div><div class="col-md-4"><div class="form-group"><label for="title">Title / शीषक</label><input type="text" name="title" placeholder="Enter Title" maxlength="40" class="form-control form-control-sm" id="title" value="' + item['Newspaper Name'] + '" readonly></div></div><div class="col-md-4"><div class="form-group"><label>Language / भाषा</label><select name="lang" class="form-control form-control-sm" style="width: 100%;" disabled><option value="' + item['Language'] + '">' + item['Language'] + '~' + item['lang_name'] + '</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="publication">Place of Publication / प्रकाशन का स्थान</label><input maxlength="30" type="text" placeholder="Enter Place of Publication" name="place_of_publication_davp" class="form-control form-control-sm" id="publication" value="' + item['Place of Publication'] + '" readonly></div></div><div class="col-md-4"><br><div class="form-group"><label>Periodicity / अवधि</label><select name="periodicity_davp" class="form-control form-control-sm" style="width: 100%;" disabled><option value="0" ' + (periocity_val == 0 ? 'selected' : '') + '>Daily(M)</option><option value="1" ' + (periocity_val == 1 ? 'selected' : '') + '>Daily(E)</option><option value="2" ' + (periocity_val == 2 ? 'selected' : '') + '>Daily Except Sunday</option><option value="3" ' + (periocity_val == 3 ? 'selected' : '') + '>Bi-Weekly</option><option value="4" ' + (periocity_val == 4 ? 'selected' : '') + '>Weekly</option><option value="5" ' + (periocity_val == 5 ? 'selected' : '') + '>Fortnightly</option><option value="6" ' + (periocity_val == 6 ? 'selected' : '') + '>Monthly</option></select></div></div><div class="col-md-4"><br><div class="form-group"><label for="davp">Owner/Group ID / मालिक/समूह कोड</label><input type="text" name="davp" placeholder="Enter Owner/Group ID" maxlength="8" class="form-control form-control-sm" id="davp" value="' + item['Newspaper Code'] + '" readonly></div></div><div class="col-md-4"><div class="form-group"><label for="edition_distance">Distance from this Edition(In Km) / इस संस्करण से दूरी (किमी. में)</label><input type="text" maxlength="15" Place of placeholder="Enter Distance" name="distance_from_edition" value="' + Math.round(dis) + '" readonly class="form-control form-control-sm" id="edition_distance" onkeypress="return onlyNumberKey(event)"></div></div></div><br>');
                        });
                    } else {
                        $("#ownerid").val('');
                        $("#owner_type").html("<option value=''>No Data Found!</option>");
                        $("#email").val('');
                        $("#mobile").val('');
                        $("#address").val('');
                        $("#city").val('');
                        $("#phone").val('');
                        $("#fax").val('');
                        $("#state").html("<option value=''>No Data Found!</option>");
                        $("#district").html("<option value=''>No Data Found!</option>");
                        $("#city").html("<option value=''>No Data Found!</option>");
                        $("#owner_type").prop("readonly", false).removeClass('pointercss');
                        $("#district").prop("readonly", false).removeClass('pointercss');
                        $("#state").prop("readonly", false).removeClass('pointercss');
                        $("#city").prop("readonly", false).removeClass('pointercss');
                        $("#name").prop("readonly", false);
                        $("#email").prop("readonly", false);
                        $("#mobile").prop("readonly", false);
                        $("#address").prop("readonly", false);                        
                        $("#phone").prop("readonly", false);
                        $("#fax").prop("readonly", false);
                        $("#alert_exist_owner_id").text(response.message).show();
                        $("#add_davp").hide();
                    }
                }
            });
        }
    });
});

