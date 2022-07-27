// var expanded = false;

// function showCheckboxes() {
//   var checkboxes = document.getElementById("checkboxes");
//   if (!expanded) {
//     checkboxes.style.display = "block";
//     expanded = true;
//   } else {
//     checkboxes.style.display = "none";
//     expanded = false;
//   }
// }


// $("#ddl_area_nature").on("blur",function()
// {
// 	$("#checkboxes").hide();
// });


$(function() {

  $('#ddl_area_nature').multiselect({
    includeSelectAllOption: true
  });


  $('#ddl_area_act').multiselect({
    includeSelectAllOption: true
  });

  // $('#btnget').click(function() {
  //   alert($('#ddl_area_nature').val());
  // });
});
