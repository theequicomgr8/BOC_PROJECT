
$(document).ready(function(){
  $(".submit-button").click(function(){
    var form = $("#outdoorCompliancefrm");      
    form.validate({
      rules: {   
        agencyCode: {
          required:true,
        },
        rocode: {
          required:true,
        },
        startpublished_date: {
          required:true,

        }, 
        print_upload_creative_fileName : {
          required:true,
        },
                              
      },
      messages: {      
        agencyCode: {
          required:"Please fill required field!",

        },
        rocode: {
          required:"Please fill required field!",

        },
        startpublished_date: {
          required:"Please fill required field!",

        },

        print_upload_creative_fileName: {
          required:"Please fill required field!",

        },
        
        //   terms: "Please accept our terms"
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
    if (form.valid() === true){
     SaveData();
    }else{
      
    }

  });
});