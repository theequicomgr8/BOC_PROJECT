function onlyAlphabets(e, t) {
  try {
    if (window.event) {
      var charCode = window.event.keyCode;
    } else if (e) {
      var charCode = e.which;
    } else {
      return true;
    }
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode == 32))
      return true;
    else
      return false;
  } catch (err) {
    alert(err.Description);
  }

}

///alpha numeric
function isAlphaNumeric(e) { // Alphanumeric only
  var k;
  document.all ? k = e.keycode : k = e.which;
  return ((k > 47 && k < 58) || (k > 64 && k < 91) || (k > 96 && k < 123) || (k == 32) || k == 0 || k == 46);
}

function onlyNumberKey(evt) {

  // Only ASCII character in that range allowed
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode
  if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
    return false;
  return true;
}
//Validation for number and .(Dot)
function onlyDotNumberKey(evt) {
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode
  if (ASCIICode > 31 && (ASCIICode < 46 || ASCIICode > 57))
    return false;
  return true;
}


function isInArray(value, array) {
    return array.indexOf(value) > -1;
  }
////////////// file upload size  512kb ////////////////
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
        var doc_array = $("#doc_data").val();

        if (doc_array == '') {
            console.log(file)
          $("#doc_data").val(file);
        } else {
            console.log("hii")
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
