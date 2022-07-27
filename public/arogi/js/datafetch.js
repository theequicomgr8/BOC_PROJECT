$(document).ready(function(){
    // $("#view").click(function(){
        function show()
        {
            $.ajax({
                url : '/rob-data',
                type: 'GET',
                success:function(data)
                {
                    // console.log(data[0].Pk_id);
                    // console.log(data);
                    // Category Of Programme Activity start
                    var v=$("#ddl_pro_activity").val();
                    var a=data[0].programme_activity;
                    if(a.length!="")
                    {
                        if(a==1)
                        {
                            $("#one").attr('selected',true);
                        }
                        if(a==2)
                        {
                            $("#two").attr('selected',true);
                        }
                        if(a==3)
                        {
                            $("#three").attr('selected',true);
                        }
                        if(a==4)
                        {
                            $("#four").attr('selected',true);
                        }
                        if(a==5)
                        {
                            $("#five").attr('selected',true);
                        }
                        if(a==6)
                        {
                            $("#six").attr('selected',true);
                        }
                    }
                    // Category Of Programme Activity end

                    //Type Of Activity start
                    var tof1_data=data[0].activity_checkbox1;
                    var tof_first=$("#CheckBoxList1_0").val();
                    if(tof_first==tof1_data)
                    {
                        $("#CheckBoxList1_0").attr('checked',true);
                    }

                    var tof2_data=data[0].activity_checkbox2;
                    var tof_second=$("#CheckBoxList1_1").val();
                    if(tof_second==tof2_data)
                    {
                        $("#CheckBoxList1_1").attr('checked',true);
                    }

                    var tof3_data=data[0].activity_checkbox3;
                    var tof_three=$("#CheckBoxList1_2").val();
                    if(tof_three==tof3_data)
                    {
                        $("#CheckBoxList1_2").attr('checked',true);
                    }                
                    //Type Of Activity end

                    // Theme of Activity/Programme start
                    var theme_data=data[0].sop_theme;
                    if(theme_data.length!="")
                    {
                        $("#txt_sop_theme").attr("value",theme_data);
                    }
                    // Theme of Activity/Programme end

                    //Office Type start
                    var office_type_data=data[0].office_type;
                    if(office_type_data=='HQ')
                    {
                        $("#ot1").attr('selected','true');
                    }
                    if(office_type_data=='FO')
                    {
                        $("#ot2").attr('selected','true');
                    }
                    //Office Type end

                    //Region start
                    var region_id_data=data[0].region_id;
                    if(region_id_data=="1")
                    {
                        $("#ddl_rob_region").append('<option>----Select---</option><option selected="selected" value="1">PATNA</option>');
                    }
                    if(region_id_data=="2")
                    {
                        $("#ddl_rob_region").empty();
                        $("#ddl_rob_region").append('<option>----Select---</option><option selected="selected"  value="2">SITAMARHI</option><option  value="3">BHAGALPUR</option><option  value="4">DARBHANGA</option><option value="5">CHAPRA</option><option value="6">MUNGER</option>');
                    }
                    if(region_id_data=="3")
                    {
                        $("#ddl_rob_region").empty();
                        $("#ddl_rob_region").append('<option>----Select---</option><option selected="selected"  value="2">SITAMARHI</option><option selected="selected" value="3">BHAGALPUR</option><option value="4">DARBHANGA</option><option value="5">CHAPRA</option><option value="6">MUNGER</option>');
                    }
                    if(region_id_data=="4")
                    {
                        $("#ddl_rob_region").empty();
                        $("#ddl_rob_region").append('<option>----Select---</option><option   value="2">SITAMARHI</option><option  value="3">BHAGALPUR</option><option selected="selected" value="4">DARBHANGA</option><option value="5">CHAPRA</option><option value="6">MUNGER</option>');
                    }
                    if(region_id_data=="5")
                    {
                        $("#ddl_rob_region").empty();
                        $("#ddl_rob_region").append('<option>----Select---</option><option   value="2">SITAMARHI</option><option  value="3">BHAGALPUR</option><option  value="4">DARBHANGA</option><option value="5" selected="selected">CHAPRA</option><option value="6">MUNGER</option>');
                    }
                    if(region_id_data=="6")
                    {
                        $("#ddl_rob_region").empty();
                        $("#ddl_rob_region").append('<option>----Select---</option><option   value="2">SITAMARHI</option><option  value="3">BHAGALPUR</option><option  value="4">DARBHANGA</option><option value="5" >CHAPRA</option><option selected="selected" value="6">MUNGER</option>');
                    }
                    //Region end

                    //Demography start
                    var demography_data=data[0].demography;
                    if(demography_data=="U")
                    {
                        $("#demography1").attr('selected','true');
                    }
                    if(demography_data=="R")
                    {
                        $("#demography2").attr('selected','true');
                    }
                    //Demography end

                    //Area of Activites start
                    var activity_area_data=data[0].activity_area;
                    if(activity_area_data=='V')
                    {
                        $("#area1").attr('selected','true');
                    }
                    if(activity_area_data=='B')
                    {
                        $("#area2").attr('selected','true');
                    }
                    if(activity_area_data=='D')
                    {
                        $("#area3").attr('selected','true');
                    }
                    if(activity_area_data=='C')
                    {
                        $("#area4").attr('selected','true');
                    }
                    //Area of Activites end

                    //coverage start
                    var coverage_data=data[0].coverage;
                    if(coverage_data.length!="")
                    {
                        $("#txt_no_covered").attr("value",coverage_data);
                    }
                    //coverage end

                    // Name of Village start
                    var village_name_data=data[0].village_name;
                    if(village_name_data.length!="")
                    {
                        $("#txt_vilage_name").attr("value",village_name_data);
                    }
                    // Name of Village end

                    //Funds Allocated start
                    var allocated_funds_data=data[0].allocated_funds;
                    if(allocated_funds_data.length!="")
                    {
                        $("#txt_fund_sanc").attr("value",allocated_funds_data);
                    }
                    //Funds Allocated end

                    //Name Of The Officer start
                    var officer_name_data=data[0].officer_name;
                    if(officer_name_data.length!="")
                    {
                        $("#txt_officer_name").attr("value",officer_name_data);
                    }
                    //Name Of The Officer end

                    //Designation Of The Officer start
                    var officer_designation_data=data[0].officer_designation;
                    if(officer_designation_data.length!="")
                    {
                        $("#txt_off_desig").attr("value",officer_designation_data);
                    }
                    //Designation Of The Officer end

                    //location start
                    var office_location_data=data[0].office_location;
                    if(office_location_data.length!="")
                    {
                        $("#txt_off_loc").attr("value",office_location_data);
                    }
                    //location end

                    //On-Account Advance start
                    var advance_account_data=data[0].advance_account;
                    if(advance_account_data.length!="")
                    {
                        $("#txt_adv_amt").attr("value",advance_account_data);
                    }
                    //On-Account Advance end

                    //Settlement of On-Account Advance start
                    var sattlement_account_advance_data=data[0].sattlement_account_advance;
                    if(sattlement_account_advance_data.length!="")
                    {
                        $("#txt_adv_pao").attr("value",sattlement_account_advance_data);
                    }
                    //Settlement of On-Account Advance end

                    //Direct Settlement Of Bill Through PAO start
                    var direct_settlement_bill_pao_data=data[0].direct_settlement_bill_pao;
                    if(direct_settlement_bill_pao_data.length!="")
                    {
                        $("#txt_direct_pao").attr("value",direct_settlement_bill_pao_data);
                    }
                    //Direct Settlement Of Bill Through PAO end

                    //From1  start
                    var duration_activity_from_date_data=data[0].duration_activity_from_date;
                    if(duration_activity_from_date_data.length!="")
                    {
                        $("#txt_from").attr("value",duration_activity_from_date_data);
                    }
                    //From1  end

                    //To  start
                    var duration_activity_to_date_data=data[0].duration_activity_to_date;
                    if(duration_activity_to_date_data.length!="")
                    {
                        $("#txt_to").attr("value",duration_activity_to_date_data);
                    }
                    //To  end

                    //No.Of Days  start
                    var no_of_days_data=data[0].no_of_days;
                    if(no_of_days_data.length!="")
                    {
                        $("#txt_tot_prog_day").attr("value",no_of_days_data);
                    }
                    //No.Of Days  end

                    //Approx Size Of Audience  start
                    var approx_size_of_audience_data=data[0].approx_size_of_audience;
                    if(approx_size_of_audience_data.length!="")
                    {
                        $("#txt_aud_size").attr("value",approx_size_of_audience_data);
                    }
                    //Approx Size Of Audience  end

                    // Community Network Created start
                    var community_network_created_data=data[0].community_network_created;
                    if(community_network_created_data.length!="")
                    {
                        $("#txt_comm_netwrk").attr("value",community_network_created_data);
                    }
                    // Community Network Created end

                    // Community Network Details start
                    var community_network_details_data=data[0].community_network_details;
                    if(community_network_details_data.length!="")
                    {
                        $("#txt_comm_netwrk_details").attr("value",community_network_details_data);
                    }
                    // Community Network Details end

                    // Virtual Network Created start
                    var virtual_network_created_data=data[0].virtual_network_created;
                    if(virtual_network_created_data.length!="")
                    {
                        $("#txt_virtual_netwrk").attr("value",virtual_network_created_data);
                    }
                    // Virtual Network Created end

                    // Virtual Network  Details start
                    var virtual_network_details_data=data[0].virtual_network_details;
                    if(virtual_network_details_data.length!="")
                    {
                        $("#txt_virtual_netwrk_dtl").attr("value",virtual_network_details_data);
                    }
                    // Virtual Network  Details end

                    // Radio Station Mobilized start
                    var radio_station_mobilized_data=data[0].radio_station_mobilized;
                    if(radio_station_mobilized_data.length!="")
                    {
                        $("#txt_rd_station").attr("value",radio_station_mobilized_data);
                    }
                    // Radio Station Mobilized end

                    // Remarks start
                    var remarks_data=data[0].remarks;
                    if(remarks_data.length!="")
                    {
                        $("#txt_remarks").attr("value",remarks_data);
                    }
                    // Remarks end




                    //Category under ICOP  start
                    var category_icop_data=data[0].category_icop;
                    if(category_icop_data.length!="")
                    {
                        $("#icop").show();
                        if(category_icop_data=='MI')
                        {
                            $("#mi").attr('selected',true);
                        }
                        if(category_icop_data=='SM')
                        {
                            $("#sm").attr('selected',true);
                        }
                        if(category_icop_data=='ME')
                        {
                            $("#me").attr('selected',true);
                        }
                        if(category_icop_data=='BI')
                        {
                            $("#bi").attr('selected',true);
                        }
                        if(category_icop_data=='OT')
                        {
                            $("#ot").attr('selected',true);
                        }
                    }

                    //Category under ICOP  end

                    //for 9 start
                    var nukkad_natak1_pre_event_activity_data=data[0].nukkad_natak1_pre_event_activity;
                    var public_meeting1_pre_event_activity_data=data[0].public_meeting1_pre_event_activity;
                    var public_announcement1_pre_event_activity_data=data[0].public_announcement1_pre_event_activity;
                    var distribution_pamphlets1_pre_event_activity_data=data[0].distribution_pamphlets1_pre_event_activity;
                    var social_media_campaign1_pre_event_data=data[0].social_media_campaign1_pre_event;
                    var public_rally_pre_event_activity_data=data[0].public_rally_pre_event_activity;
                    var media_briefing_pre_event_activity_data=data[0].media_briefing_pre_event_activity;
                    var dd_air_curtain_pre_activity_data=data[0].dd_air_curtain_pre_activity;
                    var social_media_campaign_pre_event_data=data[0].social_media_campaign_pre_event;
                    if(nukkad_natak1_pre_event_activity_data!='0' || public_meeting1_pre_event_activity_data!='0' || public_announcement1_pre_event_activity_data!='0' || distribution_pamphlets1_pre_event_activity_data!='0' || social_media_campaign1_pre_event_data!='0' || public_rally_pre_event_activity_data!='0' || media_briefing_pre_event_activity_data!='0' || dd_air_curtain_pre_activity_data!='0' || social_media_campaign_pre_event_data!='0')
                    {
                        $("#nine,#fixed").show();

                        if(nukkad_natak1_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl02_ch_pre_event_activity9").attr('checked',true);
                            $("#GridView1_ctl02_txt_prev9").show();
                            $("#GridView1_ctl02_txt_prev9").attr('value',data[0].nukkad_natak1_txt_pre_event);
                        }
                        if(public_meeting1_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl03_ch_pre_event_activity9").attr('checked',true);
                            $("#GridView1_ctl03_txt_prev9").show();
                            $("#GridView1_ctl03_txt_prev9").attr('value',data[0].public_meeting1_txt_pre_event);
                        }
                        if(public_announcement1_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl04_ch_pre_event_activity9").attr('checked',true);
                            $("#GridView1_ctl04_txt_prev9").show();
                            $("#GridView1_ctl04_txt_prev9").attr('value',data[0].public_announcement1_txt_pre_event);
                        }
                        if(distribution_pamphlets1_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl05_ch_pre_event_activity9").attr('checked',true);
                            $("#GridView1_ctl05_txt_prev9").show();
                            $("#GridView1_ctl05_txt_prev9").attr('value',data[0].distribution_pamphlets1_txt_pre_event);
                        }
                        if(social_media_campaign1_pre_event_data=='1')
                        {
                            $("#GridView1_ctl06_ch_pre_event_activity9").attr('checked',true);
                            $("#GridView1_ctl06_txt_prev9").show();
                            $("#GridView1_ctl06_txt_prev9").attr('value',data[0].social_media_campaign1_txt_pre_event);
                        }
                        if(public_rally_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl07_ch_pre_event_activity9").attr('checked',true);
                            $("#GridView1_ctl07_txt_prev9").show();
                            $("#GridView1_ctl07_txt_prev9").attr('value',data[0].public_rally_txt_pre_event);
                        }
                        if(media_briefing_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl08_ch_pre_event_activity9").attr('checked',true);
                            $("#GridView1_ctl08_txt_prev9").show();
                            $("#GridView1_ctl08_txt_prev9").attr('value',data[0].media_briefing_txt_pre_event);
                        }
                        if(dd_air_curtain_pre_activity_data=='1')
                        {
                            $("#GridView1_ctl09_ch_pre_event_activity9").attr('checked',true);
                            $("#GridView1_ctl09_txt_prev9").show();
                            $("#GridView1_ctl09_txt_prev9").attr('value',data[0].dd_air_curtain_txt_pre_activity);
                        }
                        if(social_media_campaign_pre_event_data=='1')
                        {
                            $("#GridView1_ctl10_ch_pre_event_activity9").attr('checked',true);
                            $("#GridView1_ctl10_txt_prev9").show();
                            $("#GridView1_ctl10_txt_prev9").attr('value',data[0].social_media_campaign_txt_pre_event);
                        }
                        
                    }
                    //for 9 end

                    //for 5 start
                    var nukkad_natak_pre_event_activity_data=data[0].nukkad_natak_pre_event_activity;
                    var public_meeting_pre_event_activity_data=data[0].public_meeting_pre_event_activity;
                    var public_announcement_pre_event_activity_data=data[0].public_announcement_pre_event_activity;
                    var distribution_pamphlets_pre_event_activity_data=data[0].distribution_pamphlets_pre_event_activity;
                    var social_media_pre_event_activity_data=data[0].social_media_pre_event_activity;
                    if(nukkad_natak_pre_event_activity_data!='0' || public_meeting_pre_event_activity_data!='0' || public_announcement_pre_event_activity_data!='0' || distribution_pamphlets_pre_event_activity_data!='0' || social_media_pre_event_activity_data!='0')
                    {
                        $("#five,#fixed").show();
                        if(nukkad_natak_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl02_ch_pre_event_activity1").attr('checked',true);
                            $("#GridView1_ctl02_txt_prev1").show();
                            $("#GridView1_ctl02_txt_prev1").attr('value',data[0].nukkad_natak_txt_pre_event);
                        }
                        if(public_meeting_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl03_ch_pre_event_activity1").attr('checked',true);
                            $("#GridView1_ctl03_txt_prev1").show();
                            $("#GridView1_ctl03_txt_prev1").attr('value',data[0].public_meeting_txt_pre_event);
                        }
                        if(public_announcement_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl04_ch_pre_event_activity1").attr('checked',true);
                            $("#GridView1_ctl04_txt_prev1").show();
                            $("#GridView1_ctl04_txt_prev1").attr('value',data[0].public_announcement_txt_pre_event);
                        }
                        if(distribution_pamphlets_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl05_ch_pre_event_activity1").attr('checked',true);
                            $("#GridView1_ctl05_txt_prev1").show();
                            $("#GridView1_ctl05_txt_prev1").attr('value',data[0].distribution_pamphlets_txt_pre_event);
                        }
                        if(social_media_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl06_ch_pre_event_activity1").attr('checked',true);
                            $("#GridView1_ctl06_txt_prev1").show();
                            $("#GridView1_ctl06_txt_prev1").attr('value',data[0].social_media_txt_pre_event);
                        }
                    }
                    //for 5 end

                    //for single start
                    var engagement_pre_event_activity_data=data[0].engagement_pre_event_activity;
                    if(engagement_pre_event_activity_data!='0')
                    {
                        // alert('work');
                        $("#engagement,#fixed").show();
                        if(engagement_pre_event_activity_data=='1')
                        {
                            $("#GridView1_ctl02_ch_pre_event_activity_single").attr('checked',true);
                            $("#GridView1_ctl02_txt_prev_single").show();
                            $("#GridView1_ctl02_txt_prev_single").attr('value',data[0].engagement_txt_pre_event);
                        }
                    }
                    //for single end


                    //Main Programmes start
                    if(data[0].mobile_station_main_event_activity=='1')
                    {
                        $("#GridView2_ctl02_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl02_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl02_txt_main_no_program").attr('value',data[0].mobile_station_main_no_program);

                        $("#GridView2_ctl02_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl02_txt_main_remarl").attr('value',data[0].mobile_station_main_remark);
                    }
                    if(data[0].painting_poetry_rangoli_main_activity=='1')
                    {
                        $("#GridView2_ctl03_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl03_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl03_txt_main_no_program").attr('value',data[0].painting_poetry_rangoli_main_no_program);

                        $("#GridView2_ctl03_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl03_txt_main_remarl").attr('value',data[0].painting_poetry_rangoli_main_remark);
                    }
                    if(data[0].debate_seminar_symposium_main_event=='1')
                    {
                        $("#GridView2_ctl04_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl04_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl04_txt_main_no_program").attr('value',data[0].debate_seminar_symposium_main_no_program);

                        $("#GridView2_ctl04_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl04_txt_main_remarl").attr('value',data[0].debate_seminar_symposium_main_remark);
                    }
                    if(data[0].testimonials_main_event=='1')
                    {
                        $("#GridView2_ctl05_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl05_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl05_txt_main_no_program").attr('value',data[0].testimonials_main_no_program);

                        $("#GridView2_ctl05_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl05_txt_main_remarl").attr('value',data[0].testimonials_main_remark);
                    }

                    if(data[0].felicitiation_main_event=='1')
                    {
                        $("#GridView2_ctl06_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl06_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl06_txt_main_no_program").attr('value',data[0].felicitiation_main_no_program);

                        $("#GridView2_ctl06_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl06_txt_main_remarl").attr('value',data[0].felicitiation_main_remark);
                    }
                    if(data[0].identifying_opinion_main_event=='1')
                    {
                        $("#GridView2_ctl07_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl07_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl07_txt_main_no_program").attr('value',data[0].identifying_opinion_main_no_program);

                        $("#GridView2_ctl07_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl07_txt_main_remarl").attr('value',data[0].identifying_opinion_main_remark);
                    }
                    if(data[0].expert_lectures_main_event=='1')
                    {
                        $("#GridView2_ctl08_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl08_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl08_txt_main_no_program").attr('value',data[0].expert_lectures_main_no_program);

                        $("#GridView2_ctl08_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl08_txt_main_remarl").attr('value',data[0].expert_lectures_main_remark);
                    }
                    if(data[0].workshop_main_event=='1')
                    {
                        $("#GridView2_ctl09_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl09_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl09_txt_main_no_program").attr('value',data[0].workshop_main_no_program);

                        $("#GridView2_ctl09_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl09_txt_main_remarl").attr('value',data[0].workshop_main_remark);
                    }
                    if(data[0].media_station_workshop_main_event=='1')
                    {
                        $("#GridView2_ctl10_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl10_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl10_txt_main_no_program").attr('value',data[0].media_station_workshop_main_no_programm);

                        $("#GridView2_ctl10_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl10_txt_main_remarl").attr('value',data[0].media_station_workshop_main_remark);
                    }
                    if(data[0].quiz_competitions_main_event=='1')
                    {
                        $("#GridView2_ctl11_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl11_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl11_txt_main_no_program").attr('value',data[0].quiz_competitions_main_no_program);

                        $("#GridView2_ctl11_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl11_txt_main_remarl").attr('value',data[0].quiz_competitions_main_remark);
                    }
                    if(data[0].public_meeting_main_event=='1')
                    {
                        $("#GridView2_ctl12_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl12_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl12_txt_main_no_program").attr('value',data[0].public_meeting_main_no_program);

                        $("#GridView2_ctl12_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl12_txt_main_remarl").attr('value',data[0].public_meeting_main_remark);
                    }
                    if(data[0].multimedia_component_main_event=='1')
                    {
                        $("#GridView2_ctl13_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl13_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl13_txt_main_no_program").attr('value',data[0].multimedia_component_main_no_program);

                        $("#GridView2_ctl13_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl13_txt_main_remarl").attr('value',data[0].multimedia_component_main_remark);
                    }
                    if(data[0].nukkad_natak_main_event=='1')
                    {
                        $("#GridView2_ctl14_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl14_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl14_txt_main_no_program").attr('value',data[0].nukkad_natak_main_no_program);

                        $("#GridView2_ctl14_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl14_txt_main_remarl").attr('value',data[0].nukkad_natak_main_remark);
                    }
                    if(data[0].property_show_main_event=='1')
                    {
                        $("#GridView2_ctl15_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl15_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl15_txt_main_no_program").attr('value',data[0].property_show_main_no_program);

                        $("#GridView2_ctl15_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl15_txt_main_remarl").attr('value',data[0].property_show_main_remark);
                    }
                    if(data[0].megic_show_main_event=='1')
                    {
                        $("#GridView2_ctl16_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl16_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl16_txt_main_no_program").attr('value',data[0].megic_show_main_no_program);

                        $("#GridView2_ctl16_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl16_txt_main_remarl").attr('value',data[0].megic_show_main_remark);
                    }
                    if(data[0].folk_song_main_event=='1')
                    {
                        $("#GridView2_ctl17_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl17_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl17_txt_main_no_program").attr('value',data[0].folk_song_main_no_program);

                        $("#GridView2_ctl17_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl17_txt_main_remarl").attr('value',data[0].folk_song_main_remark);
                    }
                    if(data[0].folk_dance_main_event=='1')
                    {
                        $("#GridView2_ctl18_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl18_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl18_txt_main_no_program").attr('value',data[0].folk_dance_main_no_program);

                        $("#GridView2_ctl18_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl18_txt_main_remarl").attr('value',data[0].folk_dance_main_remark);
                    }
                    if(data[0].folk_drama_main_event=='1')
                    {
                        $("#GridView2_ctl19_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl19_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl19_txt_main_no_program").attr('value',data[0].folk_drama_main_no_program);

                        $("#GridView2_ctl19_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl19_txt_main_remarl").attr('value',data[0].folk_drama_main_remark);
                    }
                    if(data[0].av_medium_main_event=='1')
                    {
                        $("#GridView2_ctl20_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl20_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl20_txt_main_no_program").attr('value',data[0].av_medium_main_no_program);

                        $("#GridView2_ctl20_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl20_txt_main_remarl").attr('value',data[0].av_medium_main_remark);
                    }
                    if(data[0].snippet_air_dd_main_event=='1')
                    {
                        $("#GridView2_ctl21_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl21_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl21_txt_main_no_program").attr('value',data[0].snippet_air_dd_main_no_program);

                        $("#GridView2_ctl21_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl21_txt_main_remarl").attr('value',data[0].snippet_air_dd_main_remark);
                    }
                    if(data[0].other_av_meterial_main_event=='1')
                    {
                        $("#GridView2_ctl22_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl22_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl22_txt_main_no_program").attr('value',data[0].other_av_meterial_main_no_program);

                        $("#GridView2_ctl22_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl22_txt_main_remarl").attr('value',data[0].other_av_meterial_main_remark);
                    }
                    if(data[0].ten_twelve_stalls_main_event=='1')
                    {
                        $("#GridView2_ctl23_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl23_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl23_txt_main_no_program").attr('value',data[0].ten_twelve_stalls_main_no_program);

                        $("#GridView2_ctl23_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl23_txt_main_remarl").attr('value',data[0].ten_twelve_stalls_main_remark);
                    }
                    if(data[0].ujwala_gas_main_event=='1')
                    {
                        $("#GridView2_ctl24_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl24_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl24_txt_main_no_program").attr('value',data[0].ujwala_gas_main_no_program);

                        $("#GridView2_ctl24_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl24_txt_main_remarl").attr('value',data[0].ujwala_gas_main_remark);
                    }
                    if(data[0].mudra_loans_main_event=='1')
                    {
                        $("#GridView2_ctl25_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl25_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl25_txt_main_no_program").attr('value',data[0].mudra_loans_main_no_program);

                        $("#GridView2_ctl25_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl25_txt_main_remarl").attr('value',data[0].mudra_loans_main_remark);
                    }
                    if(data[0].kisian_credits_card_main_event=='1')
                    {
                        $("#GridView2_ctl26_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl26_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl26_txt_main_no_program").attr('value',data[0].kisian_credits_card_main_no_program);

                        $("#GridView2_ctl26_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl26_txt_main_remarl").attr('value',data[0].kisian_credits_card_main_remark);
                    }
                    if(data[0].opening_account_main_event=='1')
                    {
                        $("#GridView2_ctl27_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl27_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl27_txt_main_no_program").attr('value',data[0].opening_account_main_no_program);

                        $("#GridView2_ctl27_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl27_txt_main_remarl").attr('value',data[0].opening_account_main_remark);
                    }
                    if(data[0].other_govt_scheme_main_event=='1')
                    {
                        $("#GridView2_ctl28_ch_main_event_activity").attr('checked',true);
                        $("#GridView2_ctl28_txt_main_no_program").removeAttr("disabled");
                        $("#GridView2_ctl28_txt_main_no_program").attr('value',data[0].other_govt_scheme_main_no_program);

                        $("#GridView2_ctl28_txt_main_remarl").removeAttr("disabled");
                        $("#GridView2_ctl28_txt_main_remarl").attr('value',data[0].other_govt_scheme_main_remark);
                    }

                    //Main Programmes end
                    //post event start
                    if(data[0].success_stories=='1')
                    {
                        $("#chk_success").attr('checked',true);
                    }
                    if(data[0].local_input_about_program=='1')
                    {
                        $("#chk_local").attr('checked',true);
                    }
                    if(data[0].fb_twitter_instagram=='1')
                    {
                        $("#chk_fb").attr('checked',true);
                    }
                    if(data[0].web_streaming=='1')
                    {
                        $("#chk_web").attr('checked',true);
                    }
                    if(data[0].live_chat_session=='1')
                    {
                        $("#chk_live").attr('checked',true);
                    }
                    if(data[0].talkathons=='1')
                    {
                        $("#chk_talk").attr('checked',true);
                    }
                    if(data[0].selfie_points=='1')
                    {
                        $("#chk_self").attr('checked',true);
                    }
                    if(data[0].social_media_wall=='1')
                    {
                        $("#chk_social").attr('checked',true);
                    }
                    if(data[0].other=='1')
                    {
                        $("#chkoth").attr('checked',true);
                    }

                    if(data[0].media_coverage_txt.length!="")
                    {
                        $("#TextBox1").attr('value',data[0].media_coverage_txt);
                    }
                    //post event end

                    
                }
            })
        }
        show();


        function multi()
        {
            $.ajax({
                url : '/rob-specialdata',
                type: 'GET',
                success:function(sdata)
                {
                    // var special_area_sdata=sdata[0].special_area;
                    console.log(sdata);
                    var i=0;
                    for(i=0;i<sdata.length;i++)
                    {
                        // console.log(sdata[i].special_area);
                        if(sdata[i].special_area=='1')
                        {
                            $("#special1").attr('selected',true);
                        }
                        if(sdata[i].special_area=='2')
                        {
                            $("#special2").attr('selected',true);
                        }
                        if(sdata[i].special_area=='3')
                        {
                            $("#special3").attr('selected',true);
                        }
                        if(sdata[i].special_area=='4')
                        {
                            $("#special4").attr('selected',true);
                        }
                        if(sdata[i].special_area=='5')
                        {
                            $("#special5").attr('selected',true);
                        }
                        if(sdata[i].special_area=='6')
                        {
                            $("#special6").attr('selected',true);
                        }
                    }
                    
                }
            })
        }
        multi();
    // });
});