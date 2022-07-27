$(document).ready(function(){
    //when click first next
    var email_err=true;
    var name_err=true;
    $("#email").on('blur focus',function(){
        check_email();
    });
    function check_email()
    {
        var email= $("#email").val();
        if(email.length=="")
        {
            $("#email_err").show();
            // $("#email_err").html("Please Fill This Field");
            email_err=false;
            return false;
        }
        else
        {
            $("#email_err").hide();
        }
    }

    // $("#name_executive_producers").on('blur focus',function(){
    //     check_name();
    // });
    // function check_name()
    // {
    //     var name= $("#name_executive_producers").val();
    //     if(empty(name))
    //     {
    //         $("#name_err").show();
    //         // $("#email_err").html("Please Fill This Field");
    //         name_err=false;
    //         return false;
    //     }
    //     else
    //     {
    //         $("#name_err").hide();
    //     }
    // }

   

    // $("#tab_1").click(function(){
    //     // var tab_one_id=$("#tab_1").attr('tab-one');
    //     // var tab_one_id=$("#tab-one").val();
    //     email_err=true;
    //     check_email();
    //     if(email_err==true)
    //     {
    //         var data =new FormData($("#av_media_producers")[0]);
    //         $.ajax({
    //             url :'/first_insert',
    //             type: 'POST',
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    //             },
    //             data: data,
    //             contentType:false,
    //             cache:false,
    //             processData:false,
    //             success:function(data)
    //             {
    //                 console.log(data);
    //             }
    //         });
    //     }
    // });


    $("#previous_one").click(function(){
        $("#tab-one").attr('value',0);
    });


    // $("#tab_2,#tab_3").click(function(){
    //     $("#tab-one").attr('value',0);
    //     var data =new FormData($("#av_media_producers")[0]);
    //     $.ajax({
    //         url :'/first_insert',
    //         type: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    //         },
    //         data: data,
    //         contentType:false,
    //         cache:false,
    //         processData:false,
    //         success:function(data)
    //         {
    //             console.log(data);
    //         }
    //     });
    // });

    // $("#av_media_producers").on('submit',function(){
        $("#submit").click(function(){
        $("#tab-one").attr('value',0);
        var data =new FormData($("#av_media_producers")[0]);
        $.ajax({
            url :'/first_insert',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            data: data,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data)
            {
                console.log(data);   
            }
        });
    });






    // $("#av_media_producers").on('submit',function(){
    $("#submit").click(function(){
        $("#tab-one").attr('value',0);
        var data =new FormData($("#av_media_producers")[0]);
            $.ajax({
                url: '/final_submit',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                },
                data: data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(res)
                {
                    // console.log('Final Submit2');
                    $("#show_box").show();
                    $("#show_msg").html(res);
                    setTimeout(function() {
                        $('.alert-success').fadeOut("slow");
                        $("#show_box").hide();
                        window.location.reload();
                    }, 5000);
                }
            });
        });
    

});