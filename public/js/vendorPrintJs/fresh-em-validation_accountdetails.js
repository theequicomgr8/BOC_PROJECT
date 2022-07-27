$(document).ready(function () {
    $("form").on('submit', function () {
        var form = $("#account_detail_form");
        form.validate({
            rules: {
                account_type: {
                    required: true
                },
                bank_account_no: {
                    required: true,
                    minlength: 9,
                    maxlength: 20,
                    number: true
                },
                account_holder_name: {
                    required: true,
                }, 
                bank_name: {
                    required: true,
                },
                ifsc_code: {
                    required: true
                },
                branch_name: {
                    required: true
                },
                address_of_account: {
                    required: true
                },
                pan_card: {
                    required: true
                },
            },
            messages: {
                account_type: {
                    required: "Please fill required field!"
                },
                bank_account_no: {
                    required: "Please fill required field!",
                    minlength: "Bank Account length min 9 digit!",
                    maxlength: "Bank Account length max 20 digit!",
                    number: "Users can enter only integer numbers!"
                },
                account_holder_name: {
                    required: "Please fill required field!"
                },
                bank_name: {
                    required: "Please fill required field!"
                },
                ifsc_code: {
                    required: "Please fill required field!"
                },
                branch_name: {
                    required: "Please fill required field!"
                },
                address_of_account: {
                    required: "Please fill required field!"
                },
                pan_card: {
                    required: "Please fill required field!"
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
    $("#ifsc_code").css('pointer-event','none');
    ifscCodeFunction($("#ifsc_code").val());
});


function ifscCodeFunction(IFSC){
    $("#ifsc_code").css('pointer-event','visible');
if(IFSC !=''){
    $.ajax({
        url:'https://ifsc.razorpay.com/'+IFSC,
        type:'get',
        success:function(data){
          if(data.UPI ==true && IFSC !=''){
             console.log(data);
          $("#bank_name").val(data.BANK);
          $("#branch_name").val(data.BRANCH);
          $("#address_of_account").val(data.ADDRESS);
        }else{
          $("#bank_name").val('');
          $("#branch_name").val('');
          $("#address_of_account").val('');
        }
        },
         error: function (error) {
            console.log(error);
            $("#bank_name").val('');
            $("#branch_name").val('');
            $("#address_of_account").val('');
    
        }
      
      })
}
}

$(document).ready(function () {
    if ($('.alert-success').text() != '') {
        $('.alert-success').fadeIn();
        setTimeout(function () {
            $('.alert-success').fadeOut("slow");
            // window.location.reload();
        }, 7000);
    }
    if ($('.alert-danger').text() != '') {
        $('.alert-danger').fadeIn();
        setTimeout(function () {
            $('.alert-danger').fadeOut("slow");
            // window.location.reload();
        }, 7000);
    }
});