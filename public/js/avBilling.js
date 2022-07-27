$(document).ready(function(){
  $("#submit2").click(function(){
        jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Letters only please");
        var form=$("#AVradioMediaBillingFrm");
          form.validate({
            rules : {
              Invoice_id : {
                required: true
              },
              Invoice_date : {
                required: true
              },
              Order_id : {
                required: true
              },
              Account_rep : {
                required: true
              },
              billOfficerName : {
                required: true,
                lettersonly: true,
              },
              billOfficerDesign : {
                required: true
              },
              email : {
                required: true
              },
              from_date : {
                required: true
              },
              to_date : {
                required: true
              },
              "bill_claim_amount[]" : {
                required : true
              },
              "date[]" : {
                required : true
              },
              "time[]" : {
                required : true
              },
              "duration[]" : {
                required : true
              },

            },
            messages : {
              Invoice_id : {
                required : "This field is required"
              },
              Invoice_date : {
                required : "This field is required"
              },
              Order_id : {
                required : "This field is required"
              },
              Account_rep : {
                required : "This field is required"
              },
              billOfficerName : {
                required : "This field is required"
              },
              billOfficerDesign : {
                required : "This field is required"
              },
              email : {
                required : "This field is required"
              },
              from_date : {
                required : "This field is required"
              },
              to_date : {
                required : "This field is required"
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
            },

            submitHandler: function(form) {
              finaldataSave();
              // dataSave();
            }


            
            


          });
      });



  

    

});