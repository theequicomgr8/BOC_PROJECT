$(document).ready(function () {

    $(".save_location").click(function () {
        var form = $("#outdoor_media_form");
        form.validate({
            rules: {
                "location_name[]": {
                    mytst1: true,
                },
                "length[]": {
                    mytst1: true,
                },
                "width[]": {
                    mytst1: true,
                },
                "Categorization[]": {
                    mytst1: true,
                },
                "Commercial_Rate[]": {
                    mytst1: true,
                },
                "Train_Data[]": {
                    mytst1: true,
                },
            },
            messages: {
                "location_name[]": {
                    required: "Please Fill required Field!",
                },
                "length[]": {
                    rrequired: "Please Fill required Field!",
                },
                "width[]": {
                    required: "Please Fill required Field!",
                },
                "Categorization[]": {
                    required: "Please Fill required Field!",
                },
                "Commercial_Rate[]": {
                    required: "Please Fill required Field!",
                },
                "Train_Data[]": {
                    rrequired: "Please Fill required Field!",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }

        });
        if (form.valid() === false) {
            return false;
        }
    });
    $(".add_location").click(function () {
        var form = $("#outdoor_media_form");
        form.validate({
            rules: {
                "location_name[]": {
                    mytst1: true,
                },
                "length[]": {
                    mytst1: true,
                },
                "width[]": {
                    mytst1: true,
                },
                "Categorization[]": {
                    mytst1: true,
                },
                "Commercial_Rate[]": {
                    mytst1: true,
                },
                "Train_Data[]": {
                    mytst1: true,
                },
            },
            messages: {
                "location_name[]": {
                    required: "Please Fill required Field!",
                },
                "length[]": {
                    rrequired: "Please Fill required Field!",
                },
                "width[]": {
                    required: "Please Fill required Field!",
                },
                "Categorization[]": {
                    required: "Please Fill required Field!",
                },
                "Commercial_Rate[]": {
                    required: "Please Fill required Field!",
                },
                "Train_Data[]": {
                    rrequired: "Please Fill required Field!",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }

        });
        if (form.valid() === false) {
            return false;
        }
    });
});
// validation multiple fields
$.validator.addMethod("mytst1", function (value, element) {
    var flag = true;
    var name = element.name;
    var id = element.id;
    var rename = name.substring(0, name.length - 2);
    var reid = id.substring(0, id.length - 1);

    $("[name^=" + rename + "]").each(function (i, j) {
        $(this).parent('p').find('span.error').remove();
        $(this).parent('p').find('span.error').remove();
        $("#" + reid + i).removeClass('is-invalid');

        if ($.trim($(this).val()) == '') {
            flag = false;
            $("#" + reid + i).addClass('is-invalid');
            $(this).parent('p').append('<span  id="' + reid + i + i + '-error" class="error invalid-feedback">Please fill required field!</span>');
        }
        $("#" + reid + i + "-error").hide();
    });

    return flag;
}, "");

//location details ajax call
$(document).on("click", ".location-modal", function () {
    var ind = $(this).attr('indexkey');
    var odmediaid = $("#odmedia_id_m" + ind).val();
    var lineNo = $("#line_no_m" + ind).val();
    var catval = $("#applying_media_" + ind + " option:selected").val();
    var subcatval = $("#showcategory_" + ind + " option:selected").val();
    var subcattxt = $("#showcategory_" + ind + " option:selected").text();
    var qty = $("#quantity_" + ind).val();
    $("#sub_cat_text").text(subcattxt);
    $("#media_cat").text(catval);
    $("#media_subcat").text(subcatval);

    if (odmediaid != '' && lineNo != '' && catval != '' && subcatval != '') {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            url: '/get-location-details',
            type: 'POST',
            data: {
                od_media_id: odmediaid, lineNo: lineNo, cat: catval, subcat: subcatval, subcattxt: subcattxt
            },
            success: function (location_data) {
                $("#model-location").html(location_data);
            }
        });
    }

});

// add and remove location data
$(document).ready(function () {
    $("#addnewrow").click(function () {
        var trdata1 = $('tr th:eq(7)').html();
        var trdata2 = $('tr th:eq(8)').html();
        var ind = $('tr:last td:eq(0)').html();
        var i = ind; i++;
        var train_field = ''; lit_type = '';
        var displaylit = 'none';

        if (trdata1 == 'Lit Type') {
            lit_type = "<td><select name='lit_type[]' id='lit_type_" + ind + "' class='form-control form-control-sm' tabindex='" + ind + "'><option value=''>Please Select</option><option value='1' >Front Lit</option><option value='2' >Back Lit</option></select></td>";
            displaylit = 'block';
        } else if (trdata1 == 'Train Number/Name<font color="red">*</font>') {
            train_field = "<td><p><input type='text' name='Train_Data[]' placeholder='Search By Train Number/Name' class='form-control form-control-sm traindata ui-autocomplete-input' id='Train_Data_" + ind + "' value='' tabindex='" + ind + "' autocomplete='off'></p></td>";
        }
        if (trdata2 == 'Train Number/Name<font color="red">*</font>') {
            train_field = "<td><p><input type='text' name='Train_Data[]' placeholder='Search By Train Number/Name' class='form-control form-control-sm traindata ui-autocomplete-input' id='Train_Data_" + ind + "' value='' tabindex='" + ind + "' autocomplete='off'></p></td>";
        }

        $("#TableId").append("<tr><td>" + i + "</td><td><p><textarea type='text' name='location_name[]' placeholder='Enter Location' class='form-control form-control-sm' id='location_name_" + ind + "' tabindex='" + ind + "' rows='1' maxlength='150'></textarea></p></td><td><p><input type='text' name='length[]' placeholder='Enter Length' class='form-control form-control-sm size_area size_len_digit' id='length_" + ind + "' maxlength='3' tabindex='" + ind + "' value='' onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='width[]' placeholder='Enter Width' class='form-control form-control-sm size_area size_width_digit' id='width_" + ind + "' tabindex='" + ind + "' value='' maxlength='3' onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='total_area[]' placeholder='Enter Total Area' class='form-control form-control-sm' id='Total_Area_" + ind + "' value='' readonly onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='Categorization[]' placeholder='Enter Categorization' class='form-control form-control-sm' id='Categorization" + ind + "' value='' onkeypress='return onlyAlphabets(event,this);'></p></td><td><p><input type='text' name='Commercial_Rate[]' placeholder='Enter Rate Offered to CBC' class='form-control form-control-sm' id='Commercial_Rate_" + ind + "' value='' onkeypress='return onlyNumberKey(event)'></p></td><td><p><select name='Illumination_media[]' id='Illumination_media_" + ind + "' class='form-control form-control-sm illuminationType' tabindex='" + ind + "'><option value=''>Select Illumination</option><option value='1' $illumination1  style='display:" + displaylit + "'>Lit</option><option value='2' $illumination2 >Non Lit</option></select></p></td>" + lit_type + train_field + " <td><a href='javascript:void(0);' class='btn btn-danger btn-sm m-0 remove_trrow' data='" + ind + "' style='font-size: 12px;'><i class='fa fa-minus'></i> Remove</a></td><input type='hidden' name='od_asset_id[]' id='od_asset_id_" + ind + "' value=''><input type='hidden' name='od_vendor_id[]' id='od_vendor_id_" + ind + "' value=''></tr>");
    });
});
$(document).on('click', '.remove_trrow', function () {

    var ind = $(this).attr('data');
    var asset_id = $("#od_asset_id_" + ind).val();
    var odmedia_id = $("#od_vendor_id_" + ind).val();
    var i = $("#count_id").val();
    var qty = $("#quantity_"+i).val();

    if (asset_id != '' && odmedia_id != '' || odmedia_id != undefined) {
        if (confirm("Are you sure you want to delete this?")) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                },
                type: 'get',
                url: '/remove-location-data',
                data: {
                    asset_id: asset_id,
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
    qty--;
    console.log('qty:' + qty);
    $("#quantity_"+i).val(qty);
});

$(document).on('change', '.illuminationType', function () {
    var indd = $(this).attr('tabindex');
    if ($(this).val() == 2) {
        $("#lit_type_" + indd).attr('readonly', true).css('pointer-events', 'none');
    } else {
        $("#lit_type_" + indd).attr('readonly', false).css('pointer-events', 'visible');
    }
});
// update media location data
$(document).ready(function () {
    $(".save_location").click(function () {
        var i = $("#count_id").val();
        $("#addLocation").hide();
        var od_assetid = [];
        var odmediaid_data = $("#odmediaid_data").val();
        var location_val = [];
        var empty = 0;       
       
        $("textarea[name='location_name[]']").each(function (i) {
            if ($(this).val() != '') {
                location_val.push($(this).val());
            } else {
                empty = 1;
            }
        });

        $("input[name='od_asset_id[]']").each(function (i) {
            od_assetid.push($(this).val());
        });

        if (location_val.length == 0 || (empty == 1 && location_val.length > 0)) {
            // alert('Please add location!');
            // $("textarea[name='location_name[]']").each(function (i) {
            //   if ($(this).val() == '') {
            //     $(this).focus();
            //     return false;
            //   }
            // });
            return false;
        }
        var form_data = $('#outdoor_media_form').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'POST',
            url: '/save-location-data',
            data: form_data,
            success: function (response) {
                $(".addLocation").text('Data save successfully').show();
                if(response.status == true){
                    $("#quantity_"+i).val(location_val.length);
                  //  $(".save_location").attr('readonly', true).css('pointer-events', 'none');
                  $("#quantity_"+i).attr('readonly', true);
                }
            }
        });
       });
});
// add media location data
$(document).ready(function () {
    $(".add_location").click(function () {
        var i = $("#count_id").val();
        var EMP_OD_Media_ID = $("#EMP_OD_Media_ID").val();
        if(EMP_OD_Media_ID != ''){
        $("#addLocation").hide();
        var od_assetid = [];
        var odmediaid_data = $("#odmediaid_data").val();
        var location_val = [];
        var empty = 0;       
       
        $("textarea[name='location_name[]']").each(function (i) {
            if ($(this).val() != '') {
                location_val.push($(this).val());
            } else {
                empty = 1;
            }
        });

        $("input[name='od_asset_id[]']").each(function (i) {
            od_assetid.push($(this).val());
        });

        if (location_val.length == 0 || (empty == 1 && location_val.length > 0)) {
            // alert('Please add location!');
            // $("textarea[name='location_name[]']").each(function (i) {
            //   if ($(this).val() == '') {
            //     $(this).focus();
            //     return false;
            //   }
            // });
            return false;
        }
        var form_data = $('#outdoor_media_form').serialize();
        if (confirm("Are you sure you want to save this data? After saving this data then you cannot add, modify, and remove this data. Please ensure before saving this data?")) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'POST',
            url: '/save-location-data',
            data: form_data,
            success: function (response) {
                $(".addLocation").text('Data Added Successfully').show();
                if(response.status == true){
                    $("#quantity_"+i).val(location_val.length);
                   // $(".save_location").attr('readonly', true).css('pointer-events', 'none');
                   $("#quantity_"+i).attr('readonly', true);
                   $("#OD_media_asset_ID_"+i).val(response.asset_ids);
                   $("#add_location").attr('disabled',true);
                   $(".remove_trrow").attr('disabled',true).css('pointer-events','none');
                }
            }
        });
    }else{
        return false;
    }
    }else{
        var form_data = $('#outdoor_media_form').serialize();
        if (confirm("Are you sure you want to save this data? After saving this data then you cannot add, modify, and remove this data. Please ensure before saving this data?")) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'POST',
            url: '/save-location-data',
            data: form_data,
            success: function (response) {
                $(".addLocation").text('Data Added Successfully').show();
                console.log(response.asset_ids)
                console.log("#OD_media_asset_ID_"+i)
                if(response.status == true){
                    $("#OD_media_asset_ID_"+i).val(response.asset_ids);
                    $("#add_location").attr('disabled',true);
                    $(".remove_trrow").attr('disabled',true).css('pointer-events','none');
                    // $(".save_location").attr('readonly', true).css('pointer-events', 'none');
                }
         }
        });
        }else{
            return false;
        }
    }
    });
});
///////////// calculate total area /////////

$(document).on('keyup', '.size_area', function () {
    var tabindex = $(this).attr("tabindex");
    var areaperpage = $('#length_' + tabindex).val() * $('#width_' + tabindex).val();
    $('#Total_Area_' + tabindex).val(areaperpage.toFixed(2));
});


// add location process
$(document).on('keyup', '.lat_media', function () {
    var tabindex = $(this).attr("tabindex");
    var val = $(this).val();
    var subcat = $("#showcategory_" + tabindex + " option:selected").val();
    if (subcat == '') {
        alert("Please select sub-category");
        $("#quantity_" + tabindex).val('');
    } else {
        if (val != '') {
            $("#location_type_" + tabindex).show();
            $("#edit_location_data_" + tabindex).hide();
        } else {
            $("#location_type_" + tabindex).hide();
            $("#edit_location_data_" + tabindex).show();
        }
    }
});

// add location according to sub category
$(document).on("click", ".add-location-modal", function () {
    var tabindex = $(this).attr("tabindex");
    var od_media_id = $("#EMP_OD_Media_ID").val();
    var OD_media_asset_ID = $("#OD_media_asset_ID_" + tabindex).val();
    if(OD_media_asset_ID == ''){
    var catval = $("#applying_media_" + tabindex + " option:selected").val();
    var subcatval = $("#showcategory_" + tabindex + " option:selected").val();
    var subcattxt = $("#showcategory_" + tabindex + " option:selected").text();

    $("#sub_cat_textt").text(subcattxt);

    var trainArrdata = $("#trainArr").val();
    var trainArrs = trainArrdata.split(',');
    var train_tab_data = '';
    var train_field_data = '';
    if ($.inArray(subcatval, trainArrs) !== -1) {
        train_tab_data = "<th width='20%' class='train_field_display'>Train Number/Name<font color='red'>*</font></th>";
    }

    var litStr = $("#litArr").val();
    var litArrs = litStr.split(',');

    var Illumination_media = '';
    var lit_type_tab = '';
    var lit_type_field = '';
    $.each(litArrs, function (key, val) {
        if (subcattxt.indexOf(val) != -1) {
            Illumination_media = 'none';
            lit_type_tab = '';
            return false;
        } else {
            Illumination_media = 'block';
            lit_type_tab = "<th width='11%' class='lit_type_display'>Lit Type</th>";
        }
    });

    $("#addLocationmedia").hide();
    var qty = $("#quantity_" + tabindex).val();
    var locationtxt = '';
    for (i = 1, j = 0; qty >= i; i++, j++) {
        if (train_tab_data != '') {
            train_field_data = "<td class='train_field_display'><p><input type='text' name='Train_Data[]' placeholder='Search By Train Number/Name' class='form-control form-control-sm traindata ui-autocomplete-input' id='Train_Data_" + j + "' value='' tabindex='" + j + "' autocomplete='off'></p></td>";
        }
       
        if (lit_type_tab != '') {
            lit_type_field = "<td class='lit_type_display'><p><select name='lit_type[]' id='lit_type_" + j + "' class='form-control form-control-sm' tabindex='" + j + "'><option value=''>Please Select</option><option value='1' $Lit_Type1 >Front Lit</option><option value='2' $Lit_Type2 >Back Lit</option></select></p></td>";
        }
        locationtxt += "<tr><td>" + i + "</td><td><p><textarea type='text' name='location_name[]' placeholder='Enter Location' class='form-control form-control-sm' id='location_name_" + j + "' tabindex='" + j + "' rows='1' maxlength='150'></textarea></p></td><td><p><input type='text' name='length[]' placeholder='Enter Length' class='form-control form-control-sm size_area size_len_digit' id='length_" + j + "' maxlength='3' tabindex='" + j + "' value='' onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='width[]' placeholder='Enter Width' class='form-control form-control-sm size_area size_width_digit' id='width_" + j + "' tabindex='" + j + "' value='' maxlength='3' onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='total_area[]' placeholder='Enter Total Area' class='form-control form-control-sm' id='Total_Area_" + j + "' value='' readonly onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='Categorization[]' placeholder='Enter Categorization' class='form-control form-control-sm' id='Categorization" + j + "' value='' onkeypress='return onlyAlphabets(event,this);'></p></td><td><p><input type='text' name='Commercial_Rate[]' placeholder='Enter Rate Offered to CBC' class='form-control form-control-sm' id='Commercial_Rate_" + j + "' value='' onkeypress='return onlyNumberKey(event)'></p></td><td><p><select name='Illumination_media[]' id='Illumination_media_" + j + "' class='form-control form-control-sm illuminationType' tabindex='" + j + "'><option value=''>Select Illumination</option><option value='1' style='display:" + Illumination_media + "'>Lit</option><option value='2'>Non Lit</option></select></p></td>"+ lit_type_field + train_field_data + "<td><a href='javascript:void(0);' class='btn btn-danger btn-sm m-0 remove_trrow' data='" + j + "' style='font-size: 12px;'><i class='fa fa-minus'></i> Remove</a></td><input type='hidden' name='od_asset_id[]' id='od_asset_id_" + j + "' value=''><input type='hidden' name='od_vendor_id[]' id='od_vendor_id_" + j + "' value='" + od_media_id + "'></tr>";
    }
    var locationtab = "<input type='hidden' name='odmediaid_data' value='" + od_media_id + "' id='odmediaid_data'><input type='hidden' name='media_cat' id='media_cat' value='" + catval + "'><input type='hidden' name='media_subcat' id='media_subcat' value='" + subcatval + "'><table class='table' style='border: 1px solid gainsboro;' id='TableId'><thead><tr><th scope='col'>Sr.No.</th><th scope='col' width='24%'>Location<font color='red'>*</font></th><th scope='col'>Length<font color='red'>*</font></th><th scope='col'>Width<font color='red'>*</font></th><th scope='col' width='14%'>Total Area (sq. ft)<font color='red'>*</font></th><th scope='col' width='12%'>Categorization<font color='red'>*</font></th><th scope='col' width='12%'>Rate Offered to CBC<font color='red'>*</font></th><th>Illumination</th>" + lit_type_tab + train_tab_data + "<th>Remove</th></tr></thead><tbody>";
    $("#media-model-location").html(locationtab + locationtxt + "</tbody></table>");
    // $("#add_location").attr('tabindex', tabindex);
    $("#add_location").attr('disabled',false);
    $(".remove_trrow").attr('disabled',false).css('pointer-events','visible');
}else{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: '/get-location-tempdata',
        data: {asset_ID : OD_media_asset_ID,EMP_OD_Media_ID:od_media_id},
        success: function (location_data) {
            $(".addLocation").hide();
            $("#media-model-location").html(location_data);
            $("#add_location").attr('disabled',true);
        }
    });
}
});

// save media location data
// $(document).ready(function () {
//     $("#add_location").click(function () {
//         // $("#location_data_" + tabindex).val('');
//         // var location_val = [];
//         // var empty = 0;
//         // $("textarea[name='location_model[]']").each(function (i) {
//         //     if ($(this).val() != '') {
//         //         location_val.push($(this).val());
//         //     } else {
//         //         empty = 1;
//         //     }
//         // });

//         // if (location_val.length == 0 || (empty == 1 && location_val.length > 0)) {
//         //     // alert('Please add location!');
//         //     $("textarea[name='location_model[]']").each(function (i) {
//         //         if ($(this).val() == '') {
//         //             $(this).focus();
//         //             return false;
//         //         }
//         //     });
//         //     return false;
//         // }
//         // var tabindex = $(this).attr("tabindex");
//         // var location_val = [];
//         // $("textarea[name='location_model[]']").each(function () {
//         //     if ($(this).val() != '') {
//         //         location_val.push($(this).val());
//         //     }
//         // });
//         // $("#location_data_" + tabindex).val(location_val);
//         // $("#addLocationmedia").text("Location added").show();

       
//     });
// });