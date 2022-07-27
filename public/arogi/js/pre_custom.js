$(document).ready(function(){
    $("#ddl_off_type").change(function(){
        var off_type_value=$("#ddl_off_type").val();
        if(off_type_value=="HQ")
        {
            $.ajax({
                url: 'hq_region',
                type: 'GET',
                success:function(data)
                {
                    $("#ddl_rob_region").html(data);
                }
            });
        }
        if(off_type_value=="FO")
        {
            $.ajax({
                url: 'fo_region',
                type: 'GET',
                success:function(data)
                {
                    $("#ddl_rob_region").html(data);
                }
            });
        }
    });


    //for Category under ICOP show
    $("#preEvent").hide();
    $("#ddl_pro_activity").change(function(){
        var ddl_pro=$("#ddl_pro_activity").val();
        if(ddl_pro=='1' || ddl_pro=='2' || ddl_pro=='3' || ddl_pro=='4')
        {
            $("#icop").show();
        }
        else
        {
            $("#icop").hide();
        }

        if(ddl_pro=='4' || ddl_pro=='5')
        {
            $("#ministry_section").show();
        }
        else
        {
            $("#ministry_section").hide();
            var $el = $('#ministry_name');
            $el.wrap('<form>').closest('form').get(0).reset();
            $el.unwrap();
        }


        if(ddl_pro=='6' || ddl_pro=='3' || ddl_pro=='4' || ddl_pro=='5')
        {
            $("#nine,#fixed").show();
            $("#preEvent").show();
        }
        else
        {
            $("#engagement,#five").hide();
        }

        if(ddl_pro=='6' || ddl_pro=='5')
        {
            $("#engagement").hide();
        }
        
    });

    $("#ddl_categ_icop").change(function(){
        var ddl_categ=$("#ddl_categ_icop").val();
        
        if(ddl_categ=="MI")
        {
            $("#engagement").show();
            $("#preEvent").show();
        }
        else{
            $("#engagement").hide();
        }

        if(ddl_categ=="SM")
        {  
            $("#five1").show();
            $("#preEvent").show();
        }
        else
        {
            $("#five1").hide();
        }

        if(ddl_categ=="ME" || ddl_categ=="BI" || ddl_categ=="OT")
        {  
            $("#nine").show();
            $("#preEvent").show();
        }
        else
        {
            $("#nine").hide();
        }

        if(ddl_categ=="MI" || ddl_categ=="SM" || ddl_categ=="ME" || ddl_categ=="BI" || ddl_categ=="OT")
        {
            $("#fixed").show();
        }

        

    });


    $(function () {

        //for nine
        $("#GridView1_ctl02_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl02_txt_prev9").show();
            } else {
                $("#GridView1_ctl02_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl03_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl03_txt_prev9").show();
            } else {
                $("#GridView1_ctl03_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl04_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl04_txt_prev9").show();
            } else {
                $("#GridView1_ctl04_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl05_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl05_txt_prev9").show();
            } else {
                $("#GridView1_ctl05_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl06_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl06_txt_prev9").show();
            } else {
                $("#GridView1_ctl06_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl07_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl07_txt_prev9").show();
            } else {
                $("#GridView1_ctl07_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl08_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl08_txt_prev9").show();
            } else {
                $("#GridView1_ctl08_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl09_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl09_txt_prev9").show();
            } else {
                $("#GridView1_ctl09_txt_prev9").hide();
            }
        });
        $("#GridView1_ctl10_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl10_txt_prev9").show();
            } else {
                $("#GridView1_ctl10_txt_prev9").hide();
            }
        });


        //for five
        $("#GridView1_ctl02_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl02_txt_prev1").show();
            } else {
                $("#GridView1_ctl02_txt_prev1").hide();
            }
        });
        $("#GridView1_ctl03_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl03_txt_prev1").show();
            } else {
                $("#GridView1_ctl03_txt_prev1").hide();
            }
        });
        $("#GridView1_ctl04_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl04_txt_prev1").show();
            } else {
                $("#GridView1_ctl04_txt_prev1").hide();
            }
        });
        $("#GridView1_ctl05_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl05_txt_prev1").show();
            } else {
                $("#GridView1_ctl05_txt_prev1").hide();
            }
        });
        $("#GridView1_ctl06_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl06_txt_prev1").show();
            } else {
                $("#GridView1_ctl06_txt_prev1").hide();
                
            }
        });

        //add 26 Apr
        $("#GridView12_ctl06_ch_pre_event_activity1").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1r_ctl06_txt_prev1").show();
            } else {
                $("#GridView1r_ctl06_txt_prev1").hide();
                
            }
        });
        $("#GridView1_ctl104_ch_pre_event_activity9").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl105_txt_prev9").show();
            } else {
                $("#GridView1_ctl105_txt_prev9").hide();
                
            }
        });




        $("#GridView1_ctl02_ch_pre_event_activity_single").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView1_ctl02_txt_prev_single").show();
                
            } else {
                $("#GridView1_ctl02_txt_prev_single").hide();
                
            }
        });


        //for other
        $("#chkoth").click(function () {
            if ($(this).is(":checked")) {
                $("#other_field").show();
            } else {
                $("#other_field").hide();
            }
        });

        

       
        
        



        $("#GridView2_ctl02_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl02_txt_main_no_program,#GridView2_ctl02_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl02_txt_main_no_program,#GridView2_ctl02_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl03_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl03_txt_main_no_program,#GridView2_ctl03_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl03_txt_main_no_program,#GridView2_ctl03_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl04_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl04_txt_main_no_program,#GridView2_ctl04_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl04_txt_main_no_program,#GridView2_ctl04_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl05_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl05_txt_main_no_program,#GridView2_ctl05_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl05_txt_main_no_program,#GridView2_ctl05_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl06_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl06_txt_main_no_program,#GridView2_ctl06_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl06_txt_main_no_program,#GridView2_ctl06_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl07_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl07_txt_main_no_program,#GridView2_ctl07_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl07_txt_main_no_program,#GridView2_ctl07_txt_main_remarl").attr("disabled", "disabled");
            }
        });
                                                    
        $("#GridView2_ctl08_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl08_txt_main_no_program,#GridView2_ctl08_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl08_txt_main_no_program,#GridView2_ctl08_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl09_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl09_txt_main_no_program,#GridView2_ctl09_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl09_txt_main_no_program,#GridView2_ctl09_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl10_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl10_txt_main_no_program,#GridView2_ctl10_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl10_txt_main_no_program,#GridView2_ctl10_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl11_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl11_txt_main_no_program,#GridView2_ctl11_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl11_txt_main_no_program,#GridView2_ctl11_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl12_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl12_txt_main_no_program,#GridView2_ctl12_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl12_txt_main_no_program,#GridView2_ctl12_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl13_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl13_txt_main_no_program,#GridView2_ctl13_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl13_txt_main_no_program,#GridView2_ctl13_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl14_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl14_txt_main_no_program,#GridView2_ctl14_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl14_txt_main_no_program,#GridView2_ctl14_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl15_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl15_txt_main_no_program,#GridView2_ctl15_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl15_txt_main_no_program,#GridView2_ctl15_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl16_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl16_txt_main_no_program,#GridView2_ctl16_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl16_txt_main_no_program,#GridView2_ctl16_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl17_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl17_txt_main_no_program,#GridView2_ctl17_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl17_txt_main_no_program,#GridView2_ctl17_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl18_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl18_txt_main_no_program,#GridView2_ctl18_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl18_txt_main_no_program,#GridView2_ctl18_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl19_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl19_txt_main_no_program,#GridView2_ctl19_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl19_txt_main_no_program,#GridView2_ctl19_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl20_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl20_txt_main_no_program,#GridView2_ctl20_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl20_txt_main_no_program,#GridView2_ctl20_txt_main_remarl").attr("disabled", "disabled");
            }
        });


       $("#GridView2_ctl21_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl21_txt_main_no_program,#GridView2_ctl21_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl21_txt_main_no_program,#GridView2_ctl21_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl22_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl22_txt_main_no_program,#GridView2_ctl22_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl22_txt_main_no_program,#GridView2_ctl22_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl23_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl23_txt_main_no_program,#GridView2_ctl23_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl23_txt_main_no_program,#GridView2_ctl23_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl24_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl24_txt_main_no_program,#GridView2_ctl24_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl24_txt_main_no_program,#GridView2_ctl24_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl25_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl25_txt_main_no_program,#GridView2_ctl25_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl25_txt_main_no_program,#GridView2_ctl25_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl26_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl26_txt_main_no_program,#GridView2_ctl26_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl26_txt_main_no_program,#GridView2_ctl26_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl27_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl27_txt_main_no_program,#GridView2_ctl27_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl27_txt_main_no_program,#GridView2_ctl27_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#GridView2_ctl28_ch_main_event_activity").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl28_txt_main_no_program,#GridView2_ctl28_txt_main_remarl").removeAttr("disabled");
            } else {
                $("#GridView2_ctl28_txt_main_no_program,#GridView2_ctl28_txt_main_remarl").attr("disabled", "disabled");
            }
        });

        $("#mobilisation_other_check").click(function () {
            if ($(this).is(":checked")) {
                $("#mobilisation_other_program,#mobilisation_other_remark").removeAttr("disabled");
            } else {
                $("#mobilisation_other_program,#mobilisation_other_remark").attr("disabled", "disabled");
            }
        });

        $("#photo_check").click(function () {
            if ($(this).is(":checked")) {
                $("#photo_program,#photo_program_remark").removeAttr("disabled");
            } else {
                $("#photo_program,#photo_program_remark").attr("disabled", "disabled");
            }
        });

        $("#digital_check").click(function () {
            if ($(this).is(":checked")) {
                $("#digital_program,#digital_program_remark").removeAttr("disabled");
            } else {
                $("#digital_program,#digital_program_remark").attr("disabled", "disabled");
            }
        });

        $("#exhibition_other_check").click(function () {
            if ($(this).is(":checked")) {
                $("#exhibition_other_program,#exhibition_other_program_remark").removeAttr("disabled");
            } else {
                $("#exhibition_other_program,#exhibition_other_program_remark").attr("disabled", "disabled");
            }
        });

        $("#cultural_other_check").click(function () {
            if ($(this).is(":checked")) {
                $("#cultural_other_program,#cultural_other_remark").removeAttr("disabled");
            } else {
                $("#cultural_other_program,#cultural_other_remark").attr("disabled", "disabled");
            }
        });

        $("#stalls_other_check").click(function () {
            if ($(this).is(":checked")) {
                $("#stalls_other_program,#stalls_other_remark").removeAttr("disabled");
            } else {
                $("#stalls_other_program,#stalls_other_remark").attr("disabled", "disabled");
            }
        });

        $("#govt_other_check").click(function () {
            if ($(this).is(":checked")) {
                $("#govt_other_program,#govt_other_remark").removeAttr("disabled");
            } else {
                $("#govt_other_program,#govt_other_remark").attr("disabled", "disabled");
            }
        });






        //add 7-apt 2022
        $("#GridView2_ctl20_ch_main_event_activity_mobile").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl20_txt_main_no_program_mobile,#GridView2_ctl20_txt_main_remarl_mobile").removeAttr("disabled");
            } else {
                $("#GridView2_ctl20_txt_main_no_program_mobile,#GridView2_ctl20_txt_main_remarl_mobile").attr("disabled", "disabled");
            }
        });
        $("#GridView2_ctl21_ch_main_event_activity_mobile").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl21_txt_main_no_program_mobile,#GridView2_ctl21_txt_main_remarl_mobile").removeAttr("disabled");
            } else {
                $("#GridView2_ctl21_txt_main_no_program_mobile,#GridView2_ctl21_txt_main_remarl_mobile").attr("disabled", "disabled");
            }
        });
        $("#GridView2_ctl21_ch_main_event_activity_mobile_mini").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl21_txt_main_no_program_mobile_mini,#GridView2_ctl21_txt_main_remarl_mobile_mini").removeAttr("disabled");
            } else {
                $("#GridView2_ctl21_txt_main_no_program_mobile_mini,#GridView2_ctl21_txt_main_remarl_mobile_mini").attr("disabled", "disabled");
            }
        });
        $("#GridView2_ctl21_ch_main_event_activity_mobile_video").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl21_txt_main_no_program_mobile_video,#GridView2_ctl21_txt_main_remarl_mobile_video").removeAttr("disabled");
            } else {
                $("#GridView2_ctl21_txt_main_no_program_mobile_video,#GridView2_ctl21_txt_main_remarl_mobile_video").attr("disabled", "disabled");
            }
        });
        $("#GridView2_ctl21_ch_main_event_activity_mobile_other").click(function () {
            if ($(this).is(":checked")) {
                $("#GridView2_ctl21_txt_main_no_program_mobile_other,#GridView2_ctl21_txt_main_remarl_mobile_other").removeAttr("disabled");
            } else {
                $("#GridView2_ctl21_txt_main_no_program_mobile_other,#GridView2_ctl21_txt_main_remarl_mobile_other").attr("disabled", "disabled");
            }
        });





        $("#exhibition_other_check_standee").click(function () {
            if ($(this).is(":checked")) {
                $("#exhibition_other_program_standee,#exhibition_other_program_remark_standee").removeAttr("disabled");
            } else {
                $("#exhibition_other_program_standee,#exhibition_other_program_remark_standee").attr("disabled", "disabled");
            }
        });
        //end 7-apr 2022




        
        
    });



    

    
      

    var txt_sop_theme_err=true;
    var txt_no_covered_err=true;
    var txt_vilage_name_err=true;
    var txt_fund_sanc_err=true;
    var txt_officer_name=true;
    var txt_off_desig_err=true;
    var txt_off_loc_err=true;
    var txt_adv_amt_err=true;
    var txt_adv_pao_err=true;
    var txt_direct_pao_err=true;
    var txt_aud_size_err=true;
    var ddl_pro_activity_err=true;
    var ddl_off_type_err=true;
    var ddl_area_nature_err=true;
    var ddl_area_act_err=true;
    var email_err=true;
    //theme field validation start
    $("#txt_sop_theme").blur(function(){
		check_theme();
	});
    
    function check_theme()
    {
        var theme= $("#txt_sop_theme").val();
        if(theme.length=="")
        {
            $("#txt_sop_theme_err").show();
            $("#txt_sop_theme_err").html("Please Fill This Field");
            txt_sop_theme_err=false;
            return false;
        }
        else
        {
            $("#txt_sop_theme_err").hide();
        }

  //       if((theme.length < 3) || (theme.length >20))
		// {
		// 	$("#txt_sop_theme_err").show();
		// 	$("#txt_sop_theme_err").html("Theme Name Must Be Between 3 To 20 Character");
		// 	txt_sop_theme_err=false;
		// 	return false;
		// }
		// else
		// {
		// 	$("#txt_sop_theme_err").hide();
		// }
    } 
    //theme field validation end
    
    //covered validation start
    $("#txt_no_covered").blur(function(){
		check_txt_no_covered();
	});
    
    function check_txt_no_covered()
    {
        var txt_no_covered= $("#txt_no_covered").val();
        if(txt_no_covered.length=="")
        {
            $("#txt_no_covered_err").show();
            // $("#txt_no_covered_err").html("Please Fill This Field");
            txt_no_covered_err=false;
            return false;
        }
        else
        {
            $("#txt_no_covered_err").hide();
        }  
    } 
    //covered validation end


    //Name of Village validation start
    $("#txt_vilage_name").blur(function(){
		check_txt_vilage_name();
	});
    
    function check_txt_vilage_name()
    {
        var txt_vilage_name= $("#txt_vilage_name").val();
        if(txt_vilage_name.length=="")
        {
            $("#txt_vilage_name_err").show();
            $("#txt_vilage_name_err").html("Please Fill This Field");
            txt_vilage_name_err=false;
            return false;
        }
        else
        {
            $("#txt_vilage_name_err").hide();
        }
        if((txt_vilage_name.length < 3) || (txt_vilage_name.length >20))
        {
            $("#txt_vilage_name_err").show();
            $("#txt_vilage_name_err").html("Village Name Must Be 3 Character");
            txt_vilage_name_err=false;
            return false;
        }
        else
        {
            $("#txt_vilage_name_err").hide();
        }  
    } 
    //Name of Village validation end

    //Funds Allocated validation start
    $("#txt_fund_sanc").blur(function(){
		check_txt_fund_sanc();
	});
    
    function check_txt_fund_sanc()
    {
        var txt_fund_sanc= $("#txt_fund_sanc").val();
        if(txt_fund_sanc.length=="")
        {
            $("#txt_fund_sanc_err").show();
            $("#txt_fund_sanc_err").html("Please Fill This Field");
            txt_fund_sanc_err=false;
            return false;
        }
        else
        {
            $("#txt_fund_sanc_err").hide();
        }  
    }
    //Funds Allocated validation end

    //Name Of The Officer validation start
    $("#txt_officer_name").blur(function(){
		check_txt_officer_name();
	});
    
    function check_txt_officer_name()
    {
        var txt_officer_name= $("#txt_officer_name").val();
        if(txt_officer_name.length=="")
        {
            $("#txt_officer_name_err").show();
            $("#txt_officer_name_err").html("Please Fill This Field");
            txt_officer_name_err=false;
            return false;
        }
        else
        {
            $("#txt_officer_name_err").hide();
        }
        
        if((txt_officer_name.length < 3) || (txt_officer_name.length >20))
        {
            $("#txt_officer_name_err").show();
            $("#txt_officer_name_err").html("Officer Name Must Be 3 Character");
            txt_officer_name_err=false;
            return false;
        }
        else
        {
            $("#txt_officer_name_err").hide();
        }
    }
    //Name Of The Officer validation end

    //Designation Of The Officer validdation start
    $("#txt_off_desig").blur(function(){
		check_txt_off_desig();
	});
    
    function check_txt_off_desig()
    {
        var txt_off_desig= $("#txt_off_desig").val();
        if(txt_off_desig.length=="")
        {
            $("#txt_off_desig_err").show();
            $("#txt_off_desig_err").html("Please Fill This Field");
            txt_off_desig_err=false;
            return false;
        }
        else
        {
            $("#txt_off_desig_err").hide();
        }  
    }
    //Designation Of The Officer validdation end

    //location validation start
    $("#txt_off_loc").blur(function(){
		check_txt_off_loc();
	});
    
    function check_txt_off_loc()
    {
        var txt_off_loc= $("#txt_off_loc").val();
        if(txt_off_loc.length=="")
        {
            $("#txt_off_loc_err").show();
            $("#txt_off_loc_err").html("Please Fill This Field");
            txt_off_loc_err=false;
            return false;
        }
        else
        {
            $("#txt_off_loc_err").hide();
        }  
    }
    //location validation end

    //On-Account Advance validation start
    $("#txt_adv_amt").blur(function(){
		check_txt_adv_amt();
	});
    
    function check_txt_adv_amt()
    {
        var txt_adv_amt= $("#txt_adv_amt").val();
        if(txt_adv_amt.length=="")
        {
            $("#txt_adv_amt_err").show();
            $("#txt_adv_amt_err").html("Please Fill This Field");
            txt_adv_amt_err=false;
            return false;
        }
        else
        {
            $("#txt_adv_amt_err").hide();
        }  
    }
    //On-Account Advance validation end

    //Settlement of On-Account Advance validation start
    $("#txt_adv_pao").blur(function(){
		check_txt_adv_pao();
	});
    
    function check_txt_adv_pao()
    {
        var txt_adv_pao= $("#txt_adv_pao").val();
        if(txt_adv_pao.length=="")
        {
            $("#txt_adv_pao_err").show();
            $("#txt_adv_pao_err").html("Please Fill This Field");
            txt_adv_pao_err=false;
            return false;
        }
        else
        {
            $("#txt_adv_pao_err").hide();
        }  
    }
    //Settlement of On-Account Advance validation end

    //From1 validation start
    $("#txt_from").blur(function(){
		check_txt_from();
	});
    
    function check_txt_from()
    {
        var txt_from= $("#txt_from").val();
        if(txt_from.length=="")
        {
            $("#txt_from_err").show();
            $("#txt_from_err").html("Please Fill This Field");
            txt_from_err=false;
            return false;
        }
        else
        {
            $("#txt_from_err").hide();
        }  
    }
    //From1 validation end

    //To validation start
    $("#txt_to").focus(function(){
        var txt_from= $("#txt_from").val();

        if(txt_from.length=="")
        {
            $("#txt_to").attr("readonly", "readonly");
            $("#txt_to_err").show();
            $("#txt_to_err").html("Please First Select From Date");
            txt_to_err=false;
            return false;
        }
        else
        {
            $("#txt_to").removeAttr("readonly");
            $("#txt_to_err").hide();
        }


		$("#txt_to").attr('min',txt_from);
	});
    
    $("#txt_to").blur(function(){
		check_txt_to();
	});
    
    function check_txt_to()
    {
        var txt_to= $("#txt_to").val();
        if(txt_to.length=="")
        {
            $("#txt_to_err").show();
            $("#txt_to_err").html("Please Fill This Field");
            txt_to_err=false;
            return false;
        }
        else
        {
            $("#txt_to_err").hide();
        }  

        var txt_from= $("#txt_from").val();
        if(txt_to < txt_from)
        {
            $("#txt_to_err").show();
            $("#txt_to_err").html("Please Select Grater Then From Date");
            txt_to_err=false;
            return false;
        }
        else
        {
            $("#txt_to_err").hide();
        }
        
    }
    //To validation end


    //Approx Size Of Audience validation start
    $("#txt_aud_size").blur(function(){
		check_txt_aud_size();
	});
    
    function check_txt_aud_size()
    {
        var txt_aud_size= $("#txt_aud_size").val();
        if(txt_aud_size.length=="")
        {
            $("#txt_aud_size_err").show();
            $("#txt_aud_size_err").html("Please Fill This Field");
            txt_aud_size_err=false;
            return false;
        }
        else
        {
            $("#txt_aud_size_err").hide();
        }  
    }
    //Approx Size Of Audience validation end

    //Category Of Programme Activity validation start
    $("#ddl_pro_activity").on('blur change',function(){
		check_ddl_pro_activity();
	});
    function check_ddl_pro_activity()
    {
        var ddl_pro_activity=$("#ddl_pro_activity").val();
        if(ddl_pro_activity=="0")
        {
            $("#ddl_pro_activity_err").show();
            $("#ddl_pro_activity_err").html('Please Select Any One');
            ddl_pro_activity_err=false;
            return false;
        }
        else
        {
            $("#ddl_pro_activity_err").hide();
        }
        
    }
    //Category Of Programme Activity validation end

    //Office Type validation start
    $("#ddl_off_type").on('blur change', function(){
		check_ddl_off_type();
	});
    function check_ddl_off_type()
    {
        var ddl_off_type=$("#ddl_off_type").val();
        if(ddl_off_type=='0')
        {
            $("#ddl_off_type_err").show();
            $("#ddl_off_type_err").html('Please select Any One');
            ddl_off_type_err=false;
            return false;
        }
        else
        {
            $("#ddl_off_type_err").hide();
        }
        
    }
    //Office Type validation end

    //Demography validation start
    $("#ddl_area_nature").on('blur change',function(){
        check_ddl_area_nature();
    });
    function check_ddl_area_nature()
    {
        var ddl_area_nature=$("#ddl_area_nature").val();
        if(ddl_area_nature=='0')
        {
            $("#ddl_area_nature_err").show();
            $("#ddl_area_nature_err").html('Please Select Any One');
            ddl_area_nature_err=false;
            return false;
        }
        else
        {
            $("#ddl_area_nature_err").hide();
        }
    }
    //Demography validation end
    
    //Area of Activites validation start
    $("#ddl_area_act").on('blur change',function(){
        check_ddl_area_act();
    });
    function check_ddl_area_act()
    {
        var ddl_area_act=$("#ddl_area_act").val();
        if(ddl_area_act=='0')
        {
            $("#ddl_area_act_err").show();
            $("#ddl_area_act_err").html('Please Select Any One');
            ddl_area_act_err=false;
            return false;
        }
        else
        {
            $("#ddl_area_act_err").hide();
        }
    }
    //Area of Activites validation end
    //Email validation start
    $("#email").blur(function(){
        check_email();
    });
    
    function check_email()
    {
        var email= $("#email").val();
        if(email.length=="")
        {
            $("#email_err").show();
            $("#email_err").html("Please Fill This Field");
            email_err=false;
            return false;
        }
        else
        {
            $("#email_err").hide();
        }

        
    } 
    //Email validation end

    

    $("#Form1").on("submit",function(e){
        e.preventDefault();
        
            $.ajax({
                // url : "/rob-form-one",
                url : "/robone",
                type: 'POST',
                 // headers: {
                //   'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                // },
                 data : new FormData(this),
                 contentType: false,
                 cache : false,
                 processData:false,
                success:function(data)
                {
                    window.location ='formtwoo/'+data;
                }
            });
             
     
        
        
    });



   //new rob form start
    $("#tab_2,#tab_3,#previous_btn_2,#previous_btn_3").click(function(){
        $("#get_id").attr('value','1');
    });

    $("#tab_1,#tab_2,#tab_3").click(function(){
        txt_sop_theme_err=true; //theme of activity
        txt_no_covered_err=true; //coverage
        txt_vilage_name_err=true; //name of village
        txt_from_err=true; //from
        txt_to_err=true; //to
        ddl_pro_activity_err=true; //create program activity
        ddl_off_type_err=true; //office type
        ddl_area_nature_err=true; //demography
        ddl_area_act_err=true; //Area of activity
        email_err=true; //email
        check_theme();//theme of activity
        check_txt_no_covered(); //coverage
        check_txt_vilage_name(); //name of village
        check_txt_from(); //from
        check_txt_to();  //to
        check_ddl_pro_activity(); ////create program activity
        check_ddl_off_type(); //office type
        check_ddl_area_nature(); //demography
        check_ddl_area_act(); //Area of activity
        check_email();
        // if((txt_sop_theme_err==true) && (txt_no_covered_err==true) && (txt_vilage_name_err==true) &&  (txt_from_err==true) && (txt_to_err==true) && (ddl_pro_activity_err==true) && (ddl_off_type_err==true) && (ddl_area_nature_err==true) && (ddl_area_act_err==true) && (email_err==true))
        // {
        //     var data =new FormData($("#rob_request")[0]);
        //     $.ajax({
        //         url : "/pre_insert",
        //         type: 'POST',
        //          // headers: {
        //         //   'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        //         // },
        //          data : data,
        //          contentType: false,
        //          cache : false,
        //          processData:false,
        //         success:function(data)
        //         {
        //             console.log('Data Saved');
        //             swal("Success","Data has been saved successfully","success").then(function () {
        //                 // window.location = 'pre-active-form';
        //                 window.location = 'preroblist';
                        
        //               });
        //         }
        //     });
        // }

    });



    //when rob approve own fob pre form update
    $("#save").click(function(){
        txt_sop_theme_err=true; //theme of activity
        txt_no_covered_err=true; //coverage
        txt_vilage_name_err=true; //name of village
        txt_from_err=true; //from
        txt_to_err=true; //to
        ddl_pro_activity_err=true; //create program activity
        ddl_off_type_err=true; //office type
        ddl_area_nature_err=true; //demography
        ddl_area_act_err=true; //Area of activity
        email_err=true; //email
        check_theme();//theme of activity
        check_txt_no_covered(); //coverage
        check_txt_vilage_name(); //name of village
        check_txt_from(); //from
        check_txt_to();  //to
        check_ddl_pro_activity(); ////create program activity
        check_ddl_off_type(); //office type
        check_ddl_area_nature(); //demography
        check_ddl_area_act(); //Area of activity
        check_email();
        if((txt_sop_theme_err==true) &&  (txt_from_err==true) && (txt_to_err==true) && (ddl_pro_activity_err==true) && (ddl_off_type_err==true) && (ddl_area_nature_err==true) && (ddl_area_act_err==true) && (email_err==true))
        {
            var data =new FormData($("#rob_request")[0]);
            $.ajax({
                url : "/rob-fob-pre-update",
                type: 'POST',
                 // headers: {
                //   'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                // },
                 data : data,
                 contentType: false,
                 cache : false,
                 processData:false,
                success:function(data)
                {
                    console.log('Data Saved');
                    swal("Success","Data has been update successfully","success").then(function () {
                        window.location.href = '/rob-show-fob-pre-data';
                      });
                }
            });
            // alert('fdgdf');
        }

    });


    





    $("#submit").click(function(){
        var data =new FormData($("#rob_request")[0]);
        $.ajax({
            url : '/robSubmit',
            type:'POST',
            data:data,
            contentType: false,
            cache : false,
            processData:false,
            success:function(data)
            {
                // console.log(data);
                $("#msg").show();
                $("#msg").html('Your data have been saved successfully');
                setTimeout(function(){ 
                    window.location.href='/rob-form-one';
                }, 5000);
                // window.location.href='/rob-form-one';
            },
            error:function(data,exception)
            {
                var errors = $.parseJSON(data.responseText);
                 $.each(errors.errors, function (key, val) {
                        console.log(key+" "+val);
                        $("#" + key + "_err").text(val[0]).show();
                    });
                console.log(errors);
                // $("#document_type_err").html('Please fill required field!');
                // $("#event_date_err").html('Please fill required field!');
                // $("#venue_event_err").html('Please fill required field!');
                // $("#detail_report_err").html('Please fill required field!');  
            }
        });
    });
    
});





////////////// file upload size  2MB ////////////////
$(document).ready(function () {
  function isInArray(value, array) {
    return array.indexOf(value) > -1;
  }
  $(".custom-file-input").change(function () {
    var id = $(this).attr("id");
    var file = this.files[0].name;
    var file1 = $('#' + id + 2).text();

    //start custom image validation
    var ary=$("#pre_photo").val();
    var approve=["jpg","png","jpeg","gif"];
    var ext=ary.substring(ary.lastIndexOf('.')+1);
    if(!approve.includes(ext))
    {
        $("#" + id).val('');
        $("#" + id + 2).text("Choose file");
        $("#" + id + 3).html("Upload").addClass("input-group-text");
        $("#" + id + 1).text('Accept only jpg/png/gif format!');
        $("#" + id + 1).show();
        $("#" + id + "-error").addClass("hide-msg");
        return false;
    }
    //end custom image validation 
    
    

    var totalBytes = this.files[0].size;
    var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
    var ext = file.split('.').pop();
    var nolimit = '';
    if (id == 'specimen_copy_file_name' || id == 'rni_reg_file_name' || id == 'annual_return_file_name') {
      nolimit = id;
    }
    if (file != '' && (sizemb <= 2 || nolimit != '')) {
      $("#" + id + 2).empty();
      $("#" + id + 2).text(file);
      $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#" + id + 4).show();
      $("#" + id + 1).hide();
      if ($("#doc_data").val() == '') {
        $("#doc_data").val(file);
      } else {
        var names = $("#doc_data").val();
        var numbersArray = 'filename';

        if (isInArray(file, numbersArray) == false) {
          $("#doc_data").val(function () {
            return $("#doc_data").val() + ',' + file;
          });
          var namess = $("#doc_data").val();
          var numbersArray1 = 'filename';
          numbersArray1 = $.grep(numbersArray1, function (value) {
            return value != file1;
          });
          $("#doc_data").val(numbersArray1);
          $("#" + id + 1).hide();
        } else {
          var namess = $("#doc_data").val();
          var numbersArray1 = 'filename';
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
      $("#" + id + 1).text('File size should be 2MB!');
      $("#" + id + 1).show();
      $("#" + id + 3).html("Upload").addClass("input-group-text");
      $("#" + id + "-error").addClass("hide-msg");
      $("#" + id + 4).hide();
    }
  });
});








////////////// file upload size  25MB ////////////////
// $(document).ready(function () {
//   function isInArray(value, array) {
//     return array.indexOf(value) > -1;
//   }
//   $(".custom-video--file-input").change(function () {
//     var id = $(this).attr("id");
//     var file = this.files[0].name;
//     var file1 = $('#' + id + 2).text();

//     var totalBytes = this.files[0].size;
//     var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
//     var ext = file.split('.').pop();
//     var nolimit = '';
//     if (id == 'specimen_copy_file_name' || id == 'rni_reg_file_name' || id == 'annual_return_file_name') {
//       nolimit = id;
//     }
//     if (file != '' && (sizemb <= 25 || nolimit != '')) {
//       $("#" + id + 2).empty();
//       $("#" + id + 2).text(file);
//       $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
//       $("#" + id + 4).show();
//       $("#" + id + 1).hide();
//       if ($("#doc_data").val() == '') {
//         $("#doc_data").val(file);
//       } else {
//         var names = $("#doc_data").val();
//         var numbersArray = names.split(',');

//         if (isInArray(file, numbersArray) == false) {
//           $("#doc_data").val(function () {
//             return $("#doc_data").val() + ',' + file;
//           });
//           var namess = $("#doc_data").val();
//           var numbersArray1 = namess.split(',');
//           numbersArray1 = $.grep(numbersArray1, function (value) {
//             return value != file1;
//           });
//           $("#doc_data").val(numbersArray1);
//           $("#" + id + 1).hide();
//         } else {
//           var namess = $("#doc_data").val();
//           var numbersArray1 = namess.split(',');
//           numbersArray1 = $.grep(numbersArray1, function (value) {
//             return value != file1;
//           });
//           $("#doc_data").val(numbersArray1);
//           $("#" + id).val('');
//           $("#" + id + 2).text("Choose file");
//           $("#" + id + 3).html("Upload").addClass("input-group-text");
//           $("#" + id + 1).text('File already selected!');
//           $("#" + id + 1).show();
//           $("#" + id + "-error").addClass("hide-msg");
//         }
//       }
//     } else {
//       $("#" + id).val('');
//       $("#" + id + 2).text("Choose file");
//       $("#" + id + 1).text('File size should be 25MB and file should be pdf!');
//       $("#" + id + 1).show();
//       $("#" + id + 3).html("Upload").addClass("input-group-text");
//       $("#" + id + "-error").addClass("hide-msg");
//       $("#" + id + 4).hide();
//     }
//   });
// });



$(document).ready(function()
{
    $("#tab_2").click(function(){
        // var data =new FormData($("#rob_request")[0]);

          $.ajax({
                url : "/get_status",
                type: 'GET',
                success:function(data)
                {
                    console.log(data);
                    $("#get_status").attr("value",data);
                }
            });
    });


    if($("#GridView2_ctl02_ch_main_event_activity,#GridView2_ctl03_ch_main_event_activity,#GridView2_ctl04_ch_main_event_activity,#GridView2_ctl05_ch_main_event_activity,#GridView2_ctl06_ch_main_event_activity,#GridView2_ctl07_ch_main_event_activity,#GridView2_ctl08_ch_main_event_activity,#GridView2_ctl09_ch_main_event_activity,#GridView2_ctl10_ch_main_event_activity,#GridView2_ctl11_ch_main_event_activity,#GridView2_ctl12_ch_main_event_activity,#mobilisation_other_check").is(":checked"))
    {
        $("#mobilisation2,#mobilisation3,#mobilisation4,#mobilisation5,#mobilisation6,#mobilisation7,#mobilisation8,#mobilisation9,#mobilisation10,#mobilisation11,#mobilisation12").show();
        $("#mobilisation").text("Less");
    }
    else
    {
        $("#mobilisation2,#mobilisation3,#mobilisation4,#mobilisation5,#mobilisation6,#mobilisation7,#mobilisation8,#mobilisation9,#mobilisation10,#mobilisation11,#mobilisation12").hide();
    }
    


    
    if($("#GridView2_ctl13_ch_main_event_activity,#photo_check,#digital_check,#exhibition_other_check_standee").is(":checked"))
    {
        $("#exhibitions2,#exhibitions3,#exhibitions4,#exhibitions5").show();
        $("#exhibitions").text("Less");
    }
    else
    {
        $("#exhibitions2,#exhibitions3,#exhibitions4,#exhibitions5").hide();
    }
    



    if($("#GridView2_ctl14_ch_main_event_activity,#GridView2_ctl15_ch_main_event_activity,#GridView2_ctl16_ch_main_event_activity,#GridView2_ctl17_ch_main_event_activity,#GridView2_ctl18_ch_main_event_activity,#GridView2_ctl19_ch_main_event_activity,#cultural_other_check").is(":checked"))
    {
        $("#cultural2,#cultural3,#cultural4,#cultural5,#cultural6,#cultural7").show();
        $("#cultural").text("Less");
    }
    else
    {
        $("#cultural2,#cultural3,#cultural4,#cultural5,#cultural6,#cultural7").hide();
    }
    



    if($("#GridView2_ctl20_ch_main_event_activity,#GridView2_ctl21_ch_main_event_activity,#GridView2_ctl22_ch_main_event_activity").is(":checked"))
    {
        $("#av_medium2,#av_medium3").show();
        $("#av_medium").text("Less");
    }
    else
    {
        $("#av_medium2,#av_medium3").hide();
    }
    




    if($("#GridView2_ctl23_ch_main_event_activity,#stalls_other_check").is(":checked"))
    {
        $("#faciliation2").show();
        $("#faciliation").text("Less");
    }
    else
    {
        $("#faciliation2").hide();
    }
    


 
    if($("#GridView2_ctl24_ch_main_event_activity,#GridView2_ctl25_ch_main_event_activity,#GridView2_ctl26_ch_main_event_activity,#GridView2_ctl27_ch_main_event_activity,#GridView2_ctl28_ch_main_event_activity,#govt_other_check").is(":checked"))
    {
        $("#distrubution2,#distrubution3,#distrubution4,#distrubution5,#distrubution6").show();
        $("#distrubution").text("Less");  
    }
    else
    {
        $("#distrubution2,#distrubution3,#distrubution4,#distrubution5,#distrubution6").hide();
    }
    
    




    if($("#GridView2_ctl20_ch_main_event_activity_mobile,#GridView2_ctl21_ch_main_event_activity_mobile,#GridView2_ctl21_ch_main_event_activity_mobile_mini,#GridView2_ctl21_ch_main_event_activity_mobile_video,#GridView2_ctl21_ch_main_event_activity_mobile_other").is(":checked"))
    {
        $("#mobile_medium2,#mobile_medium3,#mobile_medium4,#mobile_medium5").show();
        $("#mobile_medium").text("Less");
    }
    else
    {
        $("#mobile_medium2,#mobile_medium3,#mobile_medium4,#mobile_medium5").hide();
    }




    $("#mobilisation").click(function(){
        $("#mobilisation2,#mobilisation3,#mobilisation4,#mobilisation5,#mobilisation6,#mobilisation7,#mobilisation8,#mobilisation9,#mobilisation10,#mobilisation11,#mobilisation12").toggle();
        var text=$("#mobilisation").text();
        if(text=='More..')
        {
            $("#mobilisation").text("Less");
        }
        else
        {
            $("#mobilisation").text("More..");
        }
    });

    $("#exhibitions").click(function(){
        $("#exhibitions2,#exhibitions3,#exhibitions4,#exhibitions5").toggle();
        var text=$("#exhibitions").text();
        if(text=='More..')
        {
            $("#exhibitions").text("Less");
        }
        else
        {
            $("#exhibitions").text("More..");
        }
    });

    $('#cultural').click(function(){
        $("#cultural2,#cultural3,#cultural4,#cultural5,#cultural6,#cultural7").toggle();
        var text=$("#cultural").text();
        if(text=='More..')
        {
            $("#cultural").text("Less");
        }
        else
        {
            $("#cultural").text("More..");
        }
    });

    $("#av_medium").click(function(){
        $("#av_medium2,#av_medium3").toggle();
        var text=$("#av_medium").text();
        if(text=='More..')
        {
            $("#av_medium").text("Less");
        }
        else
        {
            $("#av_medium").text("More..");
        }
    });

    $("#faciliation").click(function(){
        $("#faciliation2").toggle();
        var text=$("#faciliation").text();
        if(text=='More..')
        {
            $("#faciliation").text("Less");
        }
        else
        {
            $("#faciliation").text("More..");
        }
    });

    $("#distrubution").click(function(){
        $("#distrubution2,#distrubution3,#distrubution4,#distrubution5,#distrubution6").toggle();
        var text=$("#distrubution").text();
        if(text=='More..')
        {
            $("#distrubution").text("Less");
        }
        else
        {
            $("#distrubution").text("More..");
        }
    });



    $("#mobile_medium").click(function(){
        $("#mobile_medium2,#mobile_medium3,#mobile_medium4,#mobile_medium5").toggle();
        var text=$("#mobile_medium").text();
        if(text=='More..')
        {
            $("#mobile_medium").text("Less");
        }
        else
        {
            $("#mobile_medium").text("More..");
        }
    });



    $("#five_one").hide();
    $("#nine_one").hide();

    $("#show_nine").click(function(){
        $("#nine_one").toggle();
        var html=$(this).html();
        if(html=='Show')
        {
            $("#show_nine").html('Hide');
        }
        if(html=='Hide')
        {
            $("#show_nine").html('Show');
        }
    });
    $("#show_five").click(function(){
        $("#five_one").toggle();
        var html=$(this).html();
        if(html=='Show')
        {
            $("#show_five").html('Hide');
        }
        if(html=='Hide')
        {
            $("#show_five").html('Show');
        }
    });




});




//FOR LOCATION 
