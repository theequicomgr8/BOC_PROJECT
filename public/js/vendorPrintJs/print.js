
///////////// calculate total print area /////////

$(document).ready(function () {
    $('#page_length').keyup(calculate);
    $('#page_width').keyup(calculate);
    $('#no_of_page').keyup(calculate);

});
function calculate(e) {
    var num = $('#page_length').val() * $('#page_width').val() * $('#no_of_page').val();
    var areaperpage = $('#page_length').val() * $('#page_width').val();
    $('#print_area').val(areaperpage.toFixed(2));
    $('#total_print_area').val(num.toFixed(2));
}

// show document when upload 
$(document).ready(function () {
    $(".custom-file-input").change(function () {
    });
});

// change print area value based on periodicity
$(document).ready(function () {
    $("#periodicity").change(function () {
        $("#print_area").val("");
    });
});

function printArea(val) {
    var periodicity_val = $("#periodicity :selected").val();
    if (periodicity_val == 0 && val < 7600) {
        $("#print_area").val("");
        $("#alert_print_area").text("Enter value should not be less than 7600").show();
        return false;
    } else {
        $("#alert_print_area").text("Enter value should not be less than 7600").hide();
    }

    if (periodicity_val == 1 && val < 3500) {
        $("#print_area").val("");
        $("#alert_print_area").text("Enter value should not be less than 3500").show();
        return false;
    } else {
        $("#alert_print_area").text("Enter value should not be less than 3500").hide();
    }
    if (periodicity_val == 2 && val < 4800) {
        $("#print_area").val("");
        $("#alert_print_area").text("Enter value should not be less than 4800").show();
        return false;
    } else {
        $("#alert_print_area").text("Enter value should not be less than 4800").hide();
    }
}

// DM Declaration
function dmDeclaration(val) {
    if (val == 1) {
        $("#dm_dec_date").show();
    } else {
        $("#dm_dec_date").hide();
    }
}

// vendor will specify
function vendorEdition(val) {
    if (val == 0) {
        $("#davp_panel").attr('disabled', true);
        $('#davp_panel').prop('checked', false);
        $("#add_davp").hide();
        $("#add_row_davp").hide();
    } else {
        $("#davp_panel").attr('disabled', false);
    }
}
// change company address
function changeCompAddr(val) {
    if (val == 1) {
        $("#change_info_doc").removeClass("hide-msg");
    } else {
        $("#change_info_doc").addClass("hide-msg");
    }
}

////////////// file upload validation ////////////////
$(document).ready(function () {
    $(".custom-file-input").change(function () {
        var id = $(this).attr("id");
        var file = this.files[0].name;
        var file1 = $('#' + id + 2).text();

        var totalBytes = this.files[0].size;
        var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
        var ext = file.split('.').pop();
        var nolimit = '';
        if (id == 'specimen_copy_file_name' || id == 'rni_reg_file_name' || id == 'annual_return_file_name') {
            nolimit = id;
        }
        if (file != '' && (sizemb <= 2 || nolimit != '') && ext == "pdf") {
            $("#" + id + 2).empty();
            $("#" + id + 2).text(file);
            $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
            $("#" + id + 4).show();
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
            $("#" + id + 1).text('File size should be 2MB and file should be pdf!');
            $("#" + id + 1).show();
            $("#" + id + 3).html("Upload").addClass("input-group-text");
            $("#" + id + "-error").addClass("hide-msg");
            $("#" + id + 4).hide();
        }
    });
});
function isInArray(value, array) {
    return array.indexOf(value) > -1;
}


// Existing owner
function existOwner(val) {
    if (val == 1) {
        $("#email").val('');
        $("#mobile").val('');
        $("#address").val('');
        $("#city").val('');
        $("#phone").val('');
        $("#fax").val('');
        $("#district").html("<option value=''>Please District</option>");
        $("#state").html("<option value=''>Please State</option>");
        $("#exist_owner_ids").show();
        $("#is_primary2").prop("checked", false);
    } else {
        location.reload();
        $("#exist_owner_ids").hide();
    }
}

$(document).ready(function () {

    //color pages less than or equal to pages 
    $("#colour_pages").keyup(function () {
        var pages = $("#no_of_page").val();
        if (pages == '' || parseInt($(this).val()) > parseInt(pages)) {
            $("#alert_colour_pages").text('Color pages value should be less than or equal to no. of pages').show();
        } else {
            $("#alert_colour_pages").hide();
        }
    });

    // pages
    $("#no_of_page").on('keyup', function () {
        var color = $("#colour_pages").val();
        var bwc = $("#black_white").val();
        if (parseInt(color) > parseInt($(this).val())) {
            $("#alert_colour_pages").text('Color pages value should be less than or equal to no. of pages').show();
        } else {
            $("#alert_colour_pages").hide();
        }
    });
});


// start check annual turn over of newspaper and show and hide file of GST at tab 4 
$(document).ready(function () {
    $("#gst_reg_file").hide();
    $("#total_annual").on('keyup', function () {
        if (parseInt($(this).val()) > 4000000) {
            $("#alert_total_annual_turn").text("GST Registration and certificate is mandatory at tab 4").show();
            $("#gst_reg_file").show();
        } else {
            $("#alert_total_annual_turn").hide();
            $("#gst_reg_file").hide();
        }
    });
});
// end check annual turn over of newspaper and show and hide file of GST at tab 4

// start check window load claim circulation and annual tornover based show and hide file of GST and No dues PCI at tab 4
$(document).ready(function () {

    if (parseInt($("#claimed_circulation").val()) > 25000) {
        $("#no_dues_cert").show();
        $("#abc_rni_cert").show();
    } else {
        $("#no_dues_cert").hide();
        $("#abc_rni_cert").hide();
    }
    if (parseInt($("#total_annual").val()) > 4000000) {
        $("#gst_reg_file").show();
    } else {
        $("#gst_reg_file").hide();
    }
    if ($("#cir_base").val() == 0 && $("#cir_base").val() != '') {
        $("#rni_cert").show();
        $("#form2_rni_cert").show();
    } else {
        $("#rni_cert").hide();
        $("#form2_rni_cert").hide();
    }
});
//end check window load claim circulation and annual tornover based show and hide file of GST and No dues PCI at tab 4


function checkCirculation(val) {
    if (val != '') {
        if (parseInt(val) == parseInt($("#claimed_circulation_hidden").val()) && parseInt(val) < 25000) {
            $("#rni_claimed_cirl").text("Verified").show().css("color", "green");
            $("#claimed_circulation_verified").val(1);
        } else {
            var msg = '';
            if (parseInt(val) > 25000) {
                msg = 'PCI no dues certificate is mandatory at tab 4';
                $("#no_dues_cert").show();
                $("#abc_rni_cert").show();
            } else {
                if ($("#cir_base").val() == 1) {
                    msg = '';
                } else {
                    msg = 'Not verified';
                }
                $("#no_dues_cert").hide();
                $("#abc_rni_cert").hide();
            }
            $("#rni_claimed_cirl").text(msg).show().css("color", "#f8b739");
            $("#claimed_circulation_verified").val(0);
        }
    }
}
// end cir based validation

// start cir based validation
$(document).ready(function () {
    $("#cir_base").change(function () {
        $("#rni_reg_no_verified").val(0);
        $("#claimed_circulation_verified").val(0);
        $("#rni_annual_valid").val(0);
        $("#abc_reg_no_verified").val(0);
        $("#rni_claimed_cirl").hide();
        $("#rni_efill_no").hide();
        $("#abc_cert_no").hide();
        $("#abc-certificate").hide();
        $("#dateoffirstpublication").hide();
        $("#tab_1").css('pointer-events', 'visible');
        if ($(this).val() == 0) {
            $("#rni-efilling").show();
            $("#rni_reg_no").hide();
            $("#rni_registration_no").val('');
            $("#rni_efiling_no").val('');
            $("#claimed_circulation").val('');
            $("#rni_efiling_no").prop("readonly", false);
            $("#claimed_circulation").prop("readonly", false);
            $("#rni_cert").show();
            $("#form2_rni_cert").show();
            $("#abc-certificate").hide();
            $("#rni_regist_no").show();
            $("#udin_number").hide();

        } else if ($(this).val() == 3) {
            $("#rni-efilling").hide();
            $("#rni_reg_no").hide();
            $("#rni_registration_no").val('');
            $("#rni_efiling_no").val('');
            $("#claimed_circulation").val('');
            $("#rni_efiling_no").prop("readonly", false);
            $("#claimed_circulation").prop("readonly", false);
            $("#newspaper_name").val('');
            $("#rni_cert").hide();
            $("#form2_rni_cert").hide();
            $("#abc-certificate").show();
            $("#rni_regist_no").hide();
            $("#udin_number").hide();
        } else if ($(this).val() == 1) {
            $("#rni-efilling").hide();
            $("#rni_reg_no").hide();
            $("#rni_registration_no").val('');
            $("#rni_efiling_no").val('');
            $("#claimed_circulation").val('');
            $("#rni_efiling_no").prop("readonly", false);
            $("#claimed_circulation").prop("readonly", false);
            $("#newspaper_name").val('');
            $("#rni_cert").hide();
            $("#form2_rni_cert").hide();
            $("#abc-certificate").hide();
            $("#rni_regist_no").hide();
            $("#udin_number").show();
        } else {
            $("#rni-efilling").hide();
            $("#rni_reg_no").hide();
            $("#rni_registration_no").val('');
            $("#rni_efiling_no").val('');
            $("#claimed_circulation").val('');
            $("#rni_efiling_no").prop("readonly", false);
            $("#claimed_circulation").prop("readonly", false);
            $("#newspaper_name").val('');
            $("#rni_cert").hide();
            $("#form2_rni_cert").hide();
            $("#rni_regist_no").hide();
            $("#udin_number").hide();
        }
    });
});

$(document).ready(function () {
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});
$(document).ready(function () {
    $("#name").change(function () {
        $("#owner_input_clean").val(1);
    });
});


$(document).ready(function () {
    $("#printing_colour").change(function () {
        if ($(this).val() == 0 && $(this).val() != '') {
            $("#colour_page").show();
        } else {
            $("#colour_page").hide();
        }
    });
});

//agencies show hide
$('#agenciesDiv').hide();
var news_agencies_subscribed = $('#news_agencies_subscribed option:selected').val();

if (news_agencies_subscribed == "8") {
    $('#agenciesDiv').show();
} else {
    $('#agenciesDiv').hide();
}
$('#news_agencies_subscribed').change(function () {
    var news_agencies_subscribed = $('#news_agencies_subscribed option:selected').val();
    if (news_agencies_subscribed == "") {
        $('#agenciesDiv').hide();
    } else if (news_agencies_subscribed == "8") {
        $('#agenciesDiv').show();
    } else {
        $('#agenciesDiv').hide();
    }
})

// use for first letter to upper case
function titleCase(string) {
    return string[0].toUpperCase() + string.slice(1).toLowerCase();
}

/// date fromate yyyy-mm-dd
function dateFormate(date) {
    var dd = String(date.getDate()).padStart(2, '0');
    var mm = String(date.getMonth() + 1).padStart(2, '0');
    var yyyy = date.getFullYear();
    return date = yyyy + '-' + mm + '-' + dd;
}

// use for text blink into doc section
var blink = document.getElementById('blink');
setInterval(function () {
    blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
}, 1500);


// use for document
function funPeriodicity(val) {
    var checkedValue = $('.messageCheckbox:checked').val();
    if (checkedValue == 1) {
        $("#speciman_copy").text('Upload 4 month specimen copy / 4 महीने की नमूना प्रति अपलोड करें');
    } else {
        if (val == 0 || val == 1 || val == 2) {
            $("#speciman_copy").text('Upload 6 month specimen copy / 6 महीने की नमूना प्रति अपलोड करें');
        } else {
            $("#speciman_copy").text('Upload 1 year specimen copy / 1 साल का नमूना कॉपी अपलोड करें');
        }
    }
}