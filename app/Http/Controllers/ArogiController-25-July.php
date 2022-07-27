<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;
use Validator;
use Mail;
use PDF;
use YEAR;
class ArogiController extends Controller
{

    // rob_government_benefits
    // rob_whats_new
    // rob_fob_details
    // rob_documents
    // rob_details
    // rob_demography
    // rob_contactus
    // rob_banner
    // rob_area_activity
    // rob_adg_master
    // rob_forms
    // fob_details
    //activity_save

    public function roblist()  //ROB POST ACTIVITY LIST ON ROB DASHBOARD  temp hide
    {
        $current_url = last(request()->segments());
        if($current_url == "roblist")
        {
            if(Session::get('UserID')){
                $user_id=Session('UserID');
                $fetch=DB::table('rob_forms')
                        ->where('user_id',$user_id)
                        ->where('document_type','<>','')
                        ->orderBy('Pk_id','desc')
                        ->get();
                return view('rob.roblist',["data"=>$fetch]);
           }
           return redirect('/rob-login');
        }
    }

    public function headquat()
    {
        $usertype=Session::get('UserType');
        if($usertype=='2')
        {
            $userName=Session::get('UserName');
            $hqs=DB::table('rob_fob_details')->where('user_name',$userName)->first();
            echo "<option value='".$hqs->rob_hq."'>".$hqs->rob_hq."</option>";
        }
        else //add 1 apr
        {
            $userName=Session::get('UserName');
            $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
            $robid=$findFobData->RobId;
            $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
            $robname=$robdetail->RobName;

            $hqs=DB::table('rob_fob_details')->where('user_name',$robname)->first();
            echo "<option value='".$hqs->rob_hq."'>".$hqs->rob_hq."</option>";
        }

    }

    public function foregion()
    {
        $userName=Session::get('UserName');
        $usertype=Session::get('UserType');
        if($usertype=='2')
        {
            $fos=DB::table('rob_fob_details')->where('user_name',$userName)->get();
            foreach($fos as $fo)
            {
                echo "<option value='".$fo->rob_fo."'>".$fo->rob_fo."</option>";
            }
        }
        else //add 1 apr
        {
            $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
            $robid=$findFobData->RobId;
            $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
            $robname=$robdetail->RobName;

            $fos=DB::table('rob_fob_details')->where('user_name',$robname)->get();
            foreach($fos as $fo)
            {
                echo "<option value='".$fo->rob_fo."'>".$fo->rob_fo."</option>";
            }
        }

    }

//test

    //for adg
    public function adgheadquat(Request $request)
    {
        $office_type=$request->office_type;
        $userName=Session::get('UserName');
        if($office_type=='HQ')
        {
            $data=DB::table('rob_adg_master')->select('rob_name')->where('adg_name',$userName)->first();
            $rob_name=$data->rob_name;
            $hqs=DB::table('rob_fob_details')->where('user_name',$rob_name)->first();
            echo "<option value='".$hqs->rob_hq."'>".$hqs->rob_hq."</option>";
        }
        else
        {
            $data=DB::table('rob_adg_master')->select('rob_name')->where('adg_name',$userName)->first();
            $rob_name=$data->rob_name;
            $fos=DB::table('rob_fob_details')->where('user_name',$rob_name)->get();
            foreach($fos as $fo)
            {
                echo "<option value='".$fo->rob_fo."'>".$fo->rob_fo."</option>";
            }

        }
    }

    public function rob_form_type()  //temp hide
    {
        return view('rob.rob-form-type');
    }

    public function post_form_showpdf($id='')  //temp hide
    {


        if(Session::get('UserID'))
        {
            if(!empty($id))
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                elseif($usertype=='3')
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }
                elseif($usertype=='5')
                {
                    $robdetail=DB::table('rob_adg_master')->select('*')->where('adg_name',$userName)->orderBy('adg_name','desc')->first();
                    $robname=$robdetail->rob_name;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }

                //for demography (Target Area description)  9-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();

                //31 march end

                // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); 31 march
                // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

                $data=DB::table('rob_forms')->where('Pk_id',$id)->first();

                $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
                $list=[];
                foreach($sdata as $ssdata)
                {
                    $list[]=$ssdata->special_area;
                }

                @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
                @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
                @$video=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>2])->get();
                @$govts=DB::table('rob_government_benefits')->where('form_id',$id)->get();

                // return $list;
                // return view('rob.dataform',["data"=>$data,"special_data"=>$list]);
                // return view('rob.pre-activity-form',compact('data','offTyp','offRegion','ministry_data','demographys','area_data'));
                $pdf =PDF::loadView('rob.post_form_pdf',compact('data','offTyp','offRegion','ministry_data','demographys','area_data','list','rob_documents','press','video','govts'));
                return $pdf->download('Post.pdf');

            }

        }
    }
    //when you choose form type and click submit then redirect this function and open form which you choose.
    public function rob_form_type_submit(Request $request)  //temp hide
    {
        $type=$request->davp_code;
        Session::put('formType',$type);
        if($type==1)
        {

            $user_id=Session::get('UserID');
            $userName=Session::get('UserName');
            $usertype=Session::get('UserType');
            if($usertype=='2')
            {
                $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

            }
            else
            {
                $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                $robid=$findFobData->RobId;
                $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                $robname=$robdetail->RobName;
                $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                Session::put('rob_name',$robname);
            }

            @$data=DB::table('rob_forms')->where('user_id',$user_id)->orderBy('Pk_id','desc')->first();
            $id=@$data->Pk_id; //get id for check condition in special area
            $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
            $list=[];
            foreach($sdata as $ssdata)
            {
                $list[]=$ssdata->special_area;
            }
            //for rob_documents
            @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
            @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
            @$video=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>2])->get();
            // return $rob_documents->document_type;
            $count=count($rob_documents);
            //for ministry name
            $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
            // if($count > 0)
            if(@$data->status=='1')
            {
                $rob_documents[]='';
                $press[]='';
                $video[]='';
                return view('rob.rob-firstForm',compact('offTyp','offRegion','rob_documents','press','ministry_data','video'));
            }
            else
            {
                // return $data;
                return view('rob.rob-firstForm',compact('data','list','rob_documents','offTyp','offRegion','press','ministry_data','video'));
            }
        }
        else
        {
            // dd('pre form');
            $user_id=Session::get('UserID');
            $userName=Session::get('UserName');
            $usertype=Session::get('UserType');
            if($usertype=='2')
            {
                $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

            }
            else
            {
                $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                $robid=$findFobData->RobId;
                $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                $robname=$robdetail->RobName;
                $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                Session::put('rob_name',$robname);
            }

            @$data=DB::table('rob_forms')->where(['user_id'=>$user_id,'form_type'=>0])->orderBy('Pk_id','desc')->first();
            $id=@$data->Pk_id; //get id for check condition in special area
            $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
            $list=[];
            foreach($sdata as $ssdata)
            {
                $list[]=$ssdata->special_area;
            }
            //for rob_documents
            @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
            @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
            @$video=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>2])->get();
            // return $rob_documents->document_type;

            //for demography (Target Area description)  9-june 2022
            $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
            //area activity master table
            $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();


            $count=count($rob_documents);
            //for ministry name
            $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
            // if($count > 0)
            if(@$data->status=='1')
            {
                $rob_documents[]='';
                $press[]='';
                $video[]='';
                return view('rob.pre-activity-form',compact('offTyp','offRegion','rob_documents','press','ministry_data','demographys','area_data','video'));
            }
            else
            {
                // return $data;
                return view('rob.pre-activity-form',compact('data','list','rob_documents','offTyp','offRegion','press','ministry_data','demographys','area_data','video'));
            }
        }
    }



    public function index($id='')
    {
        // dd($id);
        // UserName
        if(Session::get('UserID')){
            if(!empty($id))
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }

                //31 march end

                // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); 31 march
                // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();


                //for demography (Target Area description)  13-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();



                $data=DB::table('rob_forms')->where('Pk_id',$id)->first();
                $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
                $list=[];
                foreach($sdata as $ssdata)
                {
                    $list[]=$ssdata->special_area;
                }
                // return $list;
                // return view('rob.dataform',["data"=>$data,"special_data"=>$list]);
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
                @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
                @$video=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>2])->get();
                return view('rob.rob-firstForm',compact('data','list','rob_documents','offTyp','offRegion','press','ministry_data','demographys','area_data','video'));
            }
            else{
                $user_id=Session::get('UserID');
                $userName=Session::get('UserName');
                //31 march
                $usertype=Session::get('UserType');
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }

                //31 march end
                // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); // comment 31 march
                // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

                //for demography (Target Area description)  13-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();

                @$data=DB::table('rob_forms')->where('user_id',$user_id)->orderBy('Pk_id','desc')->first();
                $id=@$data->Pk_id; //get id for check condition in special area
                $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
                $list=[];
                foreach($sdata as $ssdata)
                {
                    $list[]=$ssdata->special_area;
                }
                //for rob_documents
                @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
                @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
                @$video=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>2])->get();
                // return $rob_documents->document_type;
                $count=count($rob_documents);

                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();

                // if($count > 0)
                if(@$data->status=='1')
                {
                    // return $count;
                    $rob_documents[]='';
                    $press[]='';
                    $video[]='';
                    return view('rob.rob-firstForm',compact('offTyp','offRegion','rob_documents','press','ministry_data','demographys','area_data','video'));
                }
                else
                {
                    // return $data;
                    return view('rob.rob-firstForm',compact('data','list','rob_documents','offTyp','offRegion','press','ministry_data','demographys','area_data','video'));
                }

            }

        }
        return redirect('/rob-login');
        // return view('rob.rob-firstForm');
    }






    public function rob_insert_backup(Request $request)
    {
        // return "hello";
        // $activity_checkbox1=$request->activity_checkbox1 ?? '0';
        $activity_checkbox1= implode(",", $request->activity_checkbox1);
        $direct_settlement_bill_pao=$request->direct_settlement_bill_pao ?? ' ';

        //single start
        $engagement_pre_event_activity=$request->engagement_pre_event_activity ?? '0';
        $engagement_txt_pre_event=$request->engagement_txt_pre_event ?? '';
        //single end

        //5start
        $nukkad_natak_pre_event_activity=$request->nukkad_natak_pre_event_activity ?? '0';
        $nukkad_natak_txt_pre_event=$request->nukkad_natak_txt_pre_event ?? '';
        $public_meeting_pre_event_activity=$request->public_meeting_pre_event_activity ?? '0';
        $public_meeting_txt_pre_event=$request->public_meeting_txt_pre_event ?? '';
        $public_announcement_pre_event_activity=$request->public_announcement_pre_event_activity ?? '0';
        $public_announcement_txt_pre_event=$request->public_announcement_txt_pre_event ?? '';
        $distribution_pamphlets_pre_event_activity=$request->distribution_pamphlets_pre_event_activity ?? '0';
        $distribution_pamphlets_txt_pre_event=$request->distribution_pamphlets_txt_pre_event ?? '';
        $social_media_pre_event_activity=$request->social_media_pre_event_activity ?? '0';
        $social_media_txt_pre_event=$request->social_media_txt_pre_event ?? '';
        //5end

        //9start
        $nukkad_natak1_pre_event_activity=$request->nukkad_natak1_pre_event_activity ?? '0';
        $nukkad_natak1_txt_pre_event=$request->nukkad_natak1_txt_pre_event ?? '';
        $public_meeting1_pre_event_activity=$request->public_meeting1_pre_event_activity ?? '0';
        $public_meeting1_txt_pre_event=$request->public_meeting1_txt_pre_event ?? '';
        $public_announcement1_pre_event_activity=$request->public_announcement1_pre_event_activity ?? '0';
        $public_announcement1_txt_pre_event=$request->public_announcement1_txt_pre_event ?? '';
        $distribution_pamphlets1_pre_event_activity=$request->distribution_pamphlets1_pre_event_activity ?? '0';
        $distribution_pamphlets1_txt_pre_event=$request->distribution_pamphlets1_txt_pre_event ?? '';
        $social_media_campaign1_pre_event=$request->social_media_campaign1_pre_event ?? '0';
        $social_media_campaign1_txt_pre_event=$request->social_media_campaign1_txt_pre_event ?? '';
        $public_rally_pre_event_activity=$request->public_rally_pre_event_activity ?? '0';
        $public_rally_txt_pre_event=$request->public_rally_txt_pre_event ?? '';
        $media_briefing_pre_event_activity=$request->media_briefing_pre_event_activity ?? '0';
        $media_briefing_txt_pre_event=$request->media_briefing_txt_pre_event ?? '';
        $dd_air_curtain_pre_activity=$request->dd_air_curtain_pre_activity ?? '0';
        $dd_air_curtain_txt_pre_activity=$request->dd_air_curtain_txt_pre_activity ?? '';
        $social_media_campaign_pre_event=$request->social_media_campaign_pre_event ?? '0';
        $social_media_campaign_txt_pre_event=$request->social_media_campaign_txt_pre_event ?? '';
        //9 end

        //Main Programmes start
        $mobile_station_main_event_activity=$request->mobile_station_main_event_activity ?? '0';
        $mobile_station_main_no_program=$request->mobile_station_main_no_program ?? '';
        $mobile_station_main_remark=$request->mobile_station_main_remark ?? '';
        $painting_poetry_rangoli_main_activity=$request->painting_poetry_rangoli_main_activity ?? '0';
        $painting_poetry_rangoli_main_no_program=$request->painting_poetry_rangoli_main_no_program ?? '';
        $painting_poetry_rangoli_main_remark=$request->painting_poetry_rangoli_main_remark ?? '';
        $debate_seminar_symposium_main_event=$request->debate_seminar_symposium_main_event ?? '0';
        $debate_seminar_symposium_main_no_program=$request->debate_seminar_symposium_main_no_program ?? '';
        $debate_seminar_symposium_main_remark=$request->debate_seminar_symposium_main_remark ?? '';
        $testimonials_main_event=$request->testimonials_main_event ?? '0';
        $testimonials_main_no_program=$request->testimonials_main_no_program ?? '';
        $testimonials_main_remark=$request->testimonials_main_remark ?? '';
        $felicitiation_main_event=$request->felicitiation_main_event ?? '0';
        $felicitiation_main_no_program=$request->felicitiation_main_no_program ?? '';
        $felicitiation_main_remark=$request->felicitiation_main_remark ?? '';
        $identifying_opinion_main_event=$request->identifying_opinion_main_event ?? '0';
        $identifying_opinion_main_no_program=$request->identifying_opinion_main_no_program ?? '';
        $identifying_opinion_main_remark=$request->identifying_opinion_main_remark ?? '';
        $expert_lectures_main_event=$request->expert_lectures_main_event ?? '0';
        $expert_lectures_main_no_program=$request->expert_lectures_main_no_program ?? '';
        $expert_lectures_main_remark=$request->expert_lectures_main_remark ?? '';
        $workshop_main_event=$request->workshop_main_event ?? '0';
        $workshop_main_no_program=$request->workshop_main_no_program ?? '';
        $workshop_main_remark=$request->workshop_main_remark ?? '';
        $media_station_workshop_main_event=$request->media_station_workshop_main_event ?? '0';
        $media_station_workshop_main_no_programm=$request->media_station_workshop_main_no_programm ?? '';
        $media_station_workshop_main_remark=$request->media_station_workshop_main_remark ?? '';
        $quiz_competitions_main_event=$request->quiz_competitions_main_event ?? '0';
        $quiz_competitions_main_no_program=$request->quiz_competitions_main_no_program ?? '';
        $quiz_competitions_main_remark=$request->quiz_competitions_main_remark ?? '';
        $public_meeting_main_event =$request->public_meeting_main_event ?? '0';
        $public_meeting_main_no_program=$request->public_meeting_main_no_program ?? '';
        $public_meeting_main_remark=$request->public_meeting_main_remark ?? '';
        $multimedia_component_main_event=$request->multimedia_component_main_event ?? '0';
        $multimedia_component_main_no_program=$request->multimedia_component_main_no_program ?? '';
        $multimedia_component_main_remark=$request->multimedia_component_main_remark ?? '';
        $nukkad_natak_main_event=$request->nukkad_natak_main_event ?? '0';
        $nukkad_natak_main_no_program=$request->nukkad_natak_main_no_program ?? '';
        $nukkad_natak_main_remark=$request->nukkad_natak_main_remark ?? '';
        $property_show_main_event=$request->property_show_main_event ?? '0';
        $property_show_main_no_program=$request->property_show_main_no_program ?? '';
        $property_show_main_remark=$request->property_show_main_remark ?? '';
        $megic_show_main_event=$request->megic_show_main_event ?? '0';
        $megic_show_main_no_program=$request->megic_show_main_no_program ?? '';
        $megic_show_main_remark=$request->megic_show_main_remark ?? '';
        $folk_song_main_event=$request->folk_song_main_event ?? '0';
        $folk_song_main_no_program=$request->folk_song_main_no_program ?? '';
        $folk_song_main_remark=$request->folk_song_main_remark ?? '';
        $folk_dance_main_event=$request->folk_dance_main_event ?? '0';
        $folk_dance_main_no_program=$request->folk_dance_main_no_program ?? '';
        $folk_dance_main_remark=$request->folk_dance_main_remark ?? '';
        $folk_drama_main_event=$request->folk_drama_main_event ?? '0';
        $folk_drama_main_no_program=$request->folk_drama_main_no_program ?? '';
        $folk_drama_main_remark=$request->folk_drama_main_remark ?? '';
        $av_medium_main_event=$request->av_medium_main_event ?? '0';
        $av_medium_main_no_program=$request->av_medium_main_no_program ?? '';
        $av_medium_main_remark=$request->av_medium_main_remark ?? '';
        $snippet_air_dd_main_event=$request->snippet_air_dd_main_event ?? '0';
        $snippet_air_dd_main_no_program=$request->snippet_air_dd_main_no_program ?? '';
        $snippet_air_dd_main_remark=$request->snippet_air_dd_main_remark ?? '';
        $other_av_meterial_main_event=$request->other_av_meterial_main_event ?? '0';
        $other_av_meterial_main_no_program=$request->other_av_meterial_main_no_program ?? '';
        $other_av_meterial_main_remark=$request->other_av_meterial_main_remark ?? '';


        $ten_twelve_stalls_main_event=$request->ten_twelve_stalls_main_event ?? '0';
        $ten_twelve_stalls_main_no_program=$request->ten_twelve_stalls_main_no_program ?? '';
        $ten_twelve_stalls_main_remark=$request->ten_twelve_stalls_main_remark ?? '';
        $ujwala_gas_main_event=$request->ujwala_gas_main_event ?? '0';
        $ujwala_gas_main_no_program=$request->ujwala_gas_main_no_program ?? '';
        $ujwala_gas_main_remark=$request->ujwala_gas_main_remark ?? '';
        $mudra_loans_main_event=$request->mudra_loans_main_event ?? '0';
        $mudra_loans_main_no_program=$request->mudra_loans_main_no_program ?? '';
        $mudra_loans_main_remark=$request->mudra_loans_main_remark ?? '';
        $kisian_credits_card_main_event=$request->kisian_credits_card_main_event ?? '0';
        $kisian_credits_card_main_no_program=$request->kisian_credits_card_main_no_program ?? '';
        $kisian_credits_card_main_remark=$request->kisian_credits_card_main_remark ?? '';
        $opening_account_main_event=$request->opening_account_main_event ?? '0';
        $opening_account_main_no_program=$request->opening_account_main_no_program ?? '';
        $opening_account_main_remark=$request->opening_account_main_remark ?? '';
        $other_govt_scheme_main_event=$request->other_govt_scheme_main_event ?? '0';
        $other_govt_scheme_main_no_program=$request->other_govt_scheme_main_no_program ?? '';
        $other_govt_scheme_main_remark=$request->other_govt_scheme_main_remark ?? '';
        //Main Programmes end

        //Post Event start
        $success_stories=$request->success_stories ?? '0';
        $local_input_about_program=$request->local_input_about_program ?? '0';
        $fb_twitter_instagram=$request->fb_twitter_instagram ?? '0';
        $web_streaming=$request->web_streaming ?? '0';
        $live_chat_session=$request->live_chat_session ?? '0';
        $talkathons=$request->talkathons ?? '0';
        $selfie_points=$request->selfie_points ?? '0';
        $social_media_wall=$request->social_media_wall ?? '0';
        $other=$request->other ?? '0';
        $media_coverage_txt=$request->media_coverage_txt ?? '';
        //Post Event end


        $community_network_created=$request->community_network_created ?? ' ';
        $community_network_details=$request->community_network_details ?? ' ';
        $virtual_network_created=$request->virtual_network_created ?? ' ';
        $virtual_network_details=$request->virtual_network_details ?? ' ';
        $radio_station_mobilized=$request->radio_station_mobilized ?? ' ';
        $remarks=$request->remarks ?? ' ';

        //required field
        $programme_activity=$request->programme_activity;
        $category_icop=$request->category_icop;
        $sop_theme=$request->sop_theme;
        $office_type=$request->office_type;
        $region_id=$request->region_id;
        $demography=implode(",", $request->demography);
        $activity_area=implode(",", $request->activity_area);
        $coverage=$request->coverage;
        $village_name=$request->village_name;

        $allocated_funds=$request->allocated_funds ?? ' ';
        $officer_name=$request->officer_name ?? ' ';
        $officer_designation=$request->officer_designation ?? ' ';
        $office_location=$request->office_location ?? ' ';
        $advance_account=$request->advance_account ?? ' ';
        $sattlement_account_advance=$request->sattlement_account_advance ?? ' ';

        $duration_activity_from_date=$request->duration_activity_from_date;
        $duration_activity_to_date=$request->duration_activity_to_date;
        $no_of_days=$request->no_of_days;
        $approx_size_of_audience=$request->approx_size_of_audience;

        $blank_arr=array();
        $special_area1=$request->special_area ?? $blank_arr;
        $special_area=implode(",", $special_area1);

        //end required
        // add new field
        $mobilisation_other_check=$request->mobilisation_other_check ?? ' ';
        $mobilisation_other_program=$request->mobilisation_other_program ?? ' ';
        $mobilisation_other_remark=$request->mobilisation_other_remark ?? ' ';
        $photo_check=$request->photo_check ?? ' ';
        $photo_program=$request->photo_program ?? ' ';
        $photo_program_remark=$request->photo_program_remark ?? ' ';
        $digital_check=$request->digital_check ?? ' ';
        $digital_program=$request->digital_program ?? ' ';
        $digital_program_remark=$request->digital_program_remark ?? ' ';
        $exhibition_other_check=$request->exhibition_other_check ?? ' ';
        $exhibition_other_program=$request->exhibition_other_program ?? ' ';
        $exhibition_other_program_remark=$request->exhibition_other_program_remark ?? ' ';
        $cultural_other_check=$request->cultural_other_check ?? ' ';
        $cultural_other_program=$request->cultural_other_program ?? ' ';
        $cultural_other_remark=$request->cultural_other_remark ?? ' ';
        $stalls_other_check=$request->stalls_other_check ?? ' ';
        $stalls_other_program=$request->stalls_other_program ?? ' ';
        $stalls_other_remark=$request->stalls_other_remark ?? ' ';
        $govt_other_check=$request->govt_other_check ?? ' ';
        $govt_other_program=$request->govt_other_program ?? ' ';
        $govt_other_remark=$request->govt_other_remark ?? ' ';

        //add second form field in first table
        $document_type=$request->document_type ?? ' ';
        $event_date=$request->event_date ?? ' ';
        $venue_event=$request->venue_event ?? ' ';
        $office_name=Session::get('UserName');
        $table1='[rob_forms]';
        $get_id=$request->get_id;

        if(Session::get('UserType')==2)
        {
            $approve=1;
        }
        else
        {
            $approve=0;
        }
        if($get_id==0)
        {
            $Pk_id = DB::select('select TOP 1 [Pk_id] from dbo.[rob_forms] order by [Pk_id] desc');
            if (empty($Pk_id)) {
                $Pk_id = 1;
            } else {
                $Pk_id = $Pk_id[0]->{"Pk_id"};
                $Pk_id++;
            }
            $user_id=Session('UserID');
            $rob_ary=array(
                "Pk_id"=> $Pk_id,
                "programme_activity"=> $programme_activity,
                "category_icop"=> $category_icop,
                "activity_checkbox1"=> $activity_checkbox1,
                "sop_theme"=> $sop_theme,
                "office_type"=> $office_type,
                "region_id"=> $region_id,
                "demography"=> $demography,
                "activity_area"=> $activity_area,
                "coverage"=> $coverage,
                "village_name"=> $village_name,
                "allocated_funds"=> $allocated_funds,
                "officer_name"=> $officer_name,
                "officer_designation"=> $officer_designation,
                "office_location"=> $office_location,
                "advance_account"=> $advance_account,
                "sattlement_account_advance"=> $sattlement_account_advance,
                "direct_settlement_bill_pao"=> $direct_settlement_bill_pao,
                "duration_activity_from_date"=> $duration_activity_from_date,
                "duration_activity_to_date"=> $duration_activity_to_date,
                "no_of_days"=> $no_of_days,
                "engagement_pre_event_activity"=> $engagement_pre_event_activity,
                "engagement_txt_pre_event"=> $engagement_txt_pre_event,
                "nukkad_natak_pre_event_activity"=> $nukkad_natak_pre_event_activity,
                "nukkad_natak_txt_pre_event"=> $nukkad_natak_txt_pre_event,
                "nukkad_natak1_pre_event_activity"=> $nukkad_natak1_pre_event_activity,
                "nukkad_natak1_txt_pre_event"=> $nukkad_natak1_txt_pre_event,
                "public_meeting_pre_event_activity"=> $public_meeting_pre_event_activity,
                "public_meeting_txt_pre_event"=> $public_meeting_txt_pre_event,
                "public_meeting1_pre_event_activity"=> $public_meeting1_pre_event_activity,
                "public_meeting1_txt_pre_event"=> $public_meeting1_txt_pre_event,
                "public_announcement_pre_event_activity"=> $public_announcement_pre_event_activity,
                "public_announcement_txt_pre_event"=> $public_announcement_txt_pre_event,
                "public_announcement1_pre_event_activity"=> $public_announcement1_pre_event_activity,
                "public_announcement1_txt_pre_event"=> $public_announcement1_txt_pre_event,
                "distribution_pamphlets_pre_event_activity"=> $distribution_pamphlets_pre_event_activity,
                "distribution_pamphlets_txt_pre_event"=> $distribution_pamphlets_txt_pre_event,
                "distribution_pamphlets1_pre_event_activity"=> $distribution_pamphlets1_pre_event_activity,
                "distribution_pamphlets1_txt_pre_event"=> $distribution_pamphlets1_txt_pre_event,
                "social_media_pre_event_activity"=> $social_media_pre_event_activity,
                "social_media_txt_pre_event"=> $social_media_txt_pre_event,
                "public_rally_pre_event_activity"=> $public_rally_pre_event_activity,
                "public_rally_txt_pre_event"=> $public_rally_txt_pre_event,
                "media_briefing_pre_event_activity"=> $media_briefing_pre_event_activity,
                "media_briefing_txt_pre_event"=> $media_briefing_txt_pre_event,
                "dd_air_curtain_pre_activity"=> $dd_air_curtain_pre_activity,
                "dd_air_curtain_txt_pre_activity"=> $dd_air_curtain_txt_pre_activity,
                "social_media_campaign_pre_event"=> $social_media_campaign_pre_event,
                "social_media_campaign_txt_pre_event"=> $social_media_campaign_txt_pre_event,
                "mobile_station_main_event_activity"=> $mobile_station_main_event_activity,
                "mobile_station_main_no_program"=> $mobile_station_main_no_program,
                "mobile_station_main_remark"=> $mobile_station_main_remark,
                "painting_poetry_rangoli_main_activity"=> $painting_poetry_rangoli_main_activity,
                "painting_poetry_rangoli_main_no_program"=> $painting_poetry_rangoli_main_no_program,
                "painting_poetry_rangoli_main_remark"=> $painting_poetry_rangoli_main_remark,
                "debate_seminar_symposium_main_event"=> $debate_seminar_symposium_main_event,
                "debate_seminar_symposium_main_no_program"=> $debate_seminar_symposium_main_no_program,
                "debate_seminar_symposium_main_remark"=> $debate_seminar_symposium_main_remark,
                "testimonials_main_event"=> $testimonials_main_event,
                "testimonials_main_no_program"=> $testimonials_main_no_program,
                "testimonials_main_remark"=> $testimonials_main_remark,
                "felicitiation_main_event"=> $felicitiation_main_event,
                "felicitiation_main_no_program"=> $felicitiation_main_no_program,
                "felicitiation_main_remark"=> $felicitiation_main_remark,
                "identifying_opinion_main_event"=> $identifying_opinion_main_event,
                "identifying_opinion_main_no_program"=> $identifying_opinion_main_no_program,
                "identifying_opinion_main_remark"=> $identifying_opinion_main_remark,
                "expert_lectures_main_event"=> $expert_lectures_main_event,
                "expert_lectures_main_no_program"=> $expert_lectures_main_no_program,
                "expert_lectures_main_remark"=> $expert_lectures_main_remark,
                "workshop_main_event"=> $workshop_main_event,
                "workshop_main_no_program"=> $workshop_main_no_program,
                "workshop_main_remark"=> $workshop_main_remark,
                "media_station_workshop_main_event"=> $media_station_workshop_main_event,
                "media_station_workshop_main_no_programm"=> $media_station_workshop_main_no_programm,
                "media_station_workshop_main_remark"=> $media_station_workshop_main_remark,
                "quiz_competitions_main_event"=> $quiz_competitions_main_event,
                "quiz_competitions_main_no_program"=> $quiz_competitions_main_no_program,
                "quiz_competitions_main_remark"=> $quiz_competitions_main_remark,
                "public_meeting_main_event"=> $public_meeting_main_event,
                "public_meeting_main_no_program"=> $public_meeting_main_no_program,
                "public_meeting_main_remark"=> $public_meeting_main_remark,
                "multimedia_component_main_event"=> $multimedia_component_main_event,
                "multimedia_component_main_no_program"=> $multimedia_component_main_no_program,
                "multimedia_component_main_remark"=> $multimedia_component_main_remark,
                "nukkad_natak_main_event"=> $nukkad_natak_main_event,
                "nukkad_natak_main_no_program"=> $nukkad_natak_main_no_program,
                "nukkad_natak_main_remark"=> $nukkad_natak_main_remark,
                "property_show_main_event"=> $property_show_main_event,
                "property_show_main_no_program"=> $property_show_main_no_program,
                "property_show_main_remark"=> $property_show_main_remark,
                "megic_show_main_event"=> $megic_show_main_event,
                "megic_show_main_no_program"=> $megic_show_main_no_program,
                "megic_show_main_remark"=> $megic_show_main_remark,
                "folk_song_main_event"=> $folk_song_main_event,
                "folk_song_main_no_program"=> $folk_song_main_no_program,
                "folk_song_main_remark"=> $folk_song_main_remark,
                "folk_dance_main_event"=> $folk_dance_main_event,
                "folk_dance_main_no_program"=> $folk_dance_main_no_program,
                "folk_dance_main_remark"=> $folk_dance_main_remark,
                "folk_drama_main_event"=> $folk_drama_main_event,
                "folk_drama_main_no_program"=> $folk_drama_main_no_program,
                "folk_drama_main_remark"=> $folk_drama_main_remark,
                "av_medium_main_event"=> $av_medium_main_event,
                "av_medium_main_no_program"=> $av_medium_main_no_program,
                "av_medium_main_remark"=> $av_medium_main_remark,
                "snippet_air_dd_main_event"=> $snippet_air_dd_main_event,
                "snippet_air_dd_main_no_program"=> $snippet_air_dd_main_no_program,
                "snippet_air_dd_main_remark"=> $snippet_air_dd_main_remark,
                "other_av_meterial_main_event"=> $other_av_meterial_main_event,
                "other_av_meterial_main_no_program"=> $other_av_meterial_main_no_program,
                "other_av_meterial_main_remark"=> $other_av_meterial_main_remark,
                "ten_twelve_stalls_main_event"=> $ten_twelve_stalls_main_event,
                "ten_twelve_stalls_main_no_program"=> $ten_twelve_stalls_main_no_program,
                "ten_twelve_stalls_main_remark"=> $ten_twelve_stalls_main_remark,
                "ujwala_gas_main_event"=> $ujwala_gas_main_event,
                "ujwala_gas_main_no_program"=> $ujwala_gas_main_no_program,
                "ujwala_gas_main_remark"=> $ujwala_gas_main_remark,
                "mudra_loans_main_event"=> $mudra_loans_main_event,
                "mudra_loans_main_no_program"=> $mudra_loans_main_no_program,
                "mudra_loans_main_remark"=> $mudra_loans_main_remark,
                "kisian_credits_card_main_event"=> $kisian_credits_card_main_event,
                "kisian_credits_card_main_no_program"=> $kisian_credits_card_main_no_program,
                "kisian_credits_card_main_remark"=> $kisian_credits_card_main_remark,
                "opening_account_main_event"=> $opening_account_main_event,
                "opening_account_main_no_program"=> $opening_account_main_no_program,
                "opening_account_main_remark"=> $opening_account_main_remark,
                "other_govt_scheme_main_event"=> $other_govt_scheme_main_event,
                "other_govt_scheme_main_no_program"=> $other_govt_scheme_main_no_program,
                "other_govt_scheme_main_remark"=> $other_govt_scheme_main_remark,
                "success_stories"=> $success_stories,
                "local_input_about_program"=> $local_input_about_program,
                "fb_twitter_instagram"=> $fb_twitter_instagram,
                "web_streaming"=> $web_streaming,
                "live_chat_session"=> $live_chat_session,
                "talkathons"=> $talkathons,
                "selfie_points"=> $selfie_points,
                "social_media_wall"=> $social_media_wall,
                "other"=> $other,
                "media_coverage_txt"=> $media_coverage_txt,
                "approx_size_of_audience"=> $approx_size_of_audience,
                "community_network_created"=> $community_network_created,
                "community_network_details"=> $community_network_details,
                "virtual_network_created"=> $virtual_network_created,
                "virtual_network_details"=> $virtual_network_details,
                "radio_station_mobilized"=> $radio_station_mobilized,
                "remarks"=> $remarks,
                "social_media_campaign1_pre_event"=> $social_media_campaign1_pre_event,
                "social_media_campaign1_txt_pre_event"=> $social_media_campaign1_txt_pre_event,
                "user_id"=> $user_id,
                "status"=> '0',
                "Special_Areas"=> $special_area,
                "mobilisation_other_check"=> $mobilisation_other_check,
                "mobilisation_other_program"=> $mobilisation_other_program,
                "mobilisation_other_remark"=> $mobilisation_other_remark,
                "photo_check"=> $photo_check,
                "photo_program"=> $photo_program,
                "photo_program_remark"=> $photo_program_remark,
                "digital_check"=> $digital_check,
                "digital_program"=> $digital_program,
                "digital_program_remark"=> $digital_program_remark,
                "exhibition_other_check"=> $exhibition_other_check,
                "exhibition_other_program"=> $exhibition_other_program,
                "exhibition_other_program_remark"=> $exhibition_other_program_remark,
                "cultural_other_check"=> $cultural_other_check,
                "cultural_other_program"=> $cultural_other_program,
                "cultural_other_remark"=> $cultural_other_remark,
                "stalls_other_check"=> $stalls_other_check,
                "stalls_other_program"=> $stalls_other_program,
                "stalls_other_remark"=> $stalls_other_remark,
                "govt_other_check"=> $govt_other_check,
                "govt_other_program"=> $govt_other_program,
                "govt_other_remark"=> $govt_other_remark,
                "document_type"=> $document_type,
                "event_date"=> $event_date,
                "venue_event"=> $venue_event,
                "office"=> $office_name,
                "vip_name"=>$request->vip_name ?? '',
                "vip_designation"=>$request->vip_designation ?? '',

                "user_type"=>Session::get('UserType'),
                "rob_name"=>$request->rob_name,
                "led_main_event"=>$request->led_main_event ?? 0,
                "led_main_no_program"=>$request->led_main_no_program ?? '',
                "led_main_remark"=>$request->led_main_remark ?? '',
                "auto_main_event"=>$request->auto_main_event ?? 0,
                "auto_dd_main_no_program"=>$request->auto_dd_main_no_program ?? '',
                "auto_dd_main_remark"=>$request->auto_dd_main_remark ?? '',
                "mini_auto_main_event"=>$request->mini_auto_main_event ?? 0,
                "mini_auto_dd_main_no_program"=>$request->mini_auto_dd_main_no_program ?? '',
                "mini_auto_dd_main_remark"=>$request->mini_auto_dd_main_remark ?? '',
                "video_auto_main_event"=>$request->video_auto_main_event ?? 0,
                "video_auto_dd_main_no_program"=>$request->video_auto_dd_main_no_program ?? '',
                "video_auto_dd_main_remark"=>$request->video_auto_dd_main_remark ?? '',
                "other_auto_main_event"=>$request->other_auto_main_event ?? 0,
                "other_auto_dd_main_no_program"=>$request->other_auto_dd_main_no_program ?? '',
                "other_auto_dd_main_remark"=>$request->other_auto_dd_main_remark ?? '',
                "exhibition_other_check_standee"=>$request->exhibition_other_check_standee ?? 0,
                "exhibition_other_program_standee"=>$request->exhibition_other_program_standee ?? '',
                "exhibition_other_program_remark_standee"=>$request->exhibition_other_program_remark_standee ?? '',
                "form_type"=>1,
                "pre_photo"=>'',
                "pre_show_website"=>0,
                'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                "ministry_name"=>$request->ministry_name ?? '',
                // "venue_event" =>$request->venue_event ?? '',
                "event_description" => $request->event_description ?? '',
                "officer_name_person"=>$request->officer_name_person ?? '',
                "contact_no"=>$request->contact_no ?? '',
                "person_designation" =>$request->person_designation ?? '',
                "email" =>$request->email ?? '',
                "approve" => $approve,
                "block" => $request->block ?? '',
                "district" =>$request->district ?? '',
                "distance_covered" => $request->distance_covered ?? 0,
                "last_visit_date" =>$request->last_visit_date

            );
            $sql=DB::table('rob_forms')->insert($rob_ary);




        }
        else
        {
            if(empty($request->url_id))
            {
                // dd('first else');
                $user_id=Session('UserID');
                $get_insert_id=DB::table('rob_forms')->select('*')->where('user_id',$user_id)->orderBy('Pk_id','desc')->first();
                $last_ID=$get_insert_id->Pk_id;
                $blank_arr=array();
                $special_area1=$request->special_area ?? $blank_arr;
                $special_area=implode(",", $special_area1);
                $update=DB::table('rob_forms')->where('Pk_id',$last_ID)->update([
                    "programme_activity"=>$request->programme_activity,
                    "category_icop"=>$request->category_icop ?? '',
                    "activity_checkbox1"=>implode(",", $request->activity_checkbox1),
                    "sop_theme"=>$request->sop_theme ?? '',
                    "office_type"=>$request->office_type ?? '',
                    "region_id"=>$request->region_id ?? '',
                    "demography"=>implode(",", $request->demography),
                    "activity_area"=>implode(",", $request->activity_area),
                    "coverage"=>$request->coverage ?? '',
                    "village_name"=>$request->village_name ?? '',
                    "vip_name"=>$request->vip_name ?? '',
                    "vip_designation"=>$request->vip_designation ?? '',
                    "allocated_funds"=>$request->allocated_funds ?? '',
                    "officer_name"=>$request->officer_name ?? '',
                    "officer_designation"=>$request->officer_designation ?? '',
                    "office_location"=>$request->office_location ?? '',
                    "advance_account"=>$request->advance_account ?? '',
                    "sattlement_account_advance"=>$request->sattlement_account_advance ?? '',
                    "direct_settlement_bill_pao"=>$request->direct_settlement_bill_pao ?? '',
                    "duration_activity_from_date"=>$request->duration_activity_from_date ?? '',
                    "duration_activity_to_date"=>$request->duration_activity_to_date ?? '',
                    "no_of_days"=>$request->no_of_days ?? '',
                    "engagement_pre_event_activity"=>$request->engagement_pre_event_activity ?? '',
                    "engagement_txt_pre_event"=>$request->engagement_txt_pre_event ?? '',
                    "nukkad_natak_pre_event_activity"=>$request->nukkad_natak_pre_event_activity ?? '',
                    "nukkad_natak_txt_pre_event"=>$request->nukkad_natak_txt_pre_event ?? '',
                    "nukkad_natak1_pre_event_activity"=>$request->nukkad_natak1_pre_event_activity ?? '',
                    "nukkad_natak1_txt_pre_event"=>$request->nukkad_natak1_txt_pre_event ?? '',
                    "public_meeting_pre_event_activity"=>$request->public_meeting_pre_event_activity ?? '',
                    "public_meeting_txt_pre_event"=>$request->public_meeting_txt_pre_event ?? '',
                    "public_meeting1_pre_event_activity"=>$request->public_meeting1_pre_event_activity ?? '',
                    "public_meeting1_txt_pre_event"=>$request->public_meeting1_txt_pre_event ?? '',
                    "public_announcement_pre_event_activity"=>$request->public_announcement_pre_event_activity ?? '',
                    "public_announcement_txt_pre_event"=>$request->public_announcement_txt_pre_event ?? '',
                    "public_announcement1_pre_event_activity"=>$request->public_announcement1_pre_event_activity ?? '',
                    "public_announcement1_txt_pre_event"=>$request->public_announcement1_txt_pre_event ?? '',
                    "distribution_pamphlets_pre_event_activity"=>$request->distribution_pamphlets_pre_event_activity ?? '',
                    "distribution_pamphlets_txt_pre_event"=>$request->distribution_pamphlets_txt_pre_event ?? '',
                    "distribution_pamphlets1_pre_event_activity"=>$request->distribution_pamphlets1_pre_event_activity ?? '',
                    "distribution_pamphlets1_txt_pre_event"=>$request->distribution_pamphlets1_txt_pre_event ?? '',
                    "social_media_pre_event_activity"=>$request->social_media_pre_event_activity ?? '',
                    "social_media_txt_pre_event"=>$request->social_media_txt_pre_event ?? '',
                    "public_rally_pre_event_activity"=>$request->public_rally_pre_event_activity ?? '',
                    "public_rally_txt_pre_event"=>$request->public_rally_txt_pre_event ?? '',
                    "media_briefing_pre_event_activity"=>$request->media_briefing_pre_event_activity ?? '',
                    "media_briefing_txt_pre_event"=>$request->media_briefing_txt_pre_event ?? '',
                    "dd_air_curtain_pre_activity"=>$request->dd_air_curtain_pre_activity ?? '',
                    "dd_air_curtain_txt_pre_activity"=>$request->dd_air_curtain_txt_pre_activity ?? '',
                    "social_media_campaign_pre_event"=>$request->social_media_campaign_pre_event ?? '',
                    "social_media_campaign_txt_pre_event"=>$request->social_media_campaign_txt_pre_event ?? '',
                    "mobile_station_main_event_activity"=>$request->mobile_station_main_event_activity ?? '',
                    "mobile_station_main_no_program"=>$request->mobile_station_main_no_program ?? '',
                    "mobile_station_main_remark"=>$request->mobile_station_main_remark ?? '',
                    "painting_poetry_rangoli_main_activity"=>$request->painting_poetry_rangoli_main_activity ?? '',
                    "painting_poetry_rangoli_main_no_program"=>$request->painting_poetry_rangoli_main_no_program ?? '',
                    "painting_poetry_rangoli_main_remark"=>$request->painting_poetry_rangoli_main_remark ?? '',
                    "debate_seminar_symposium_main_event"=>$request->debate_seminar_symposium_main_event ?? '',
                    "debate_seminar_symposium_main_no_program"=>$request->debate_seminar_symposium_main_no_program ?? '',
                    "debate_seminar_symposium_main_remark"=>$request->debate_seminar_symposium_main_remark ?? '',
                    "testimonials_main_event"=>$request->testimonials_main_event ?? '',
                    "testimonials_main_no_program"=>$request->testimonials_main_no_program ?? '',
                    "testimonials_main_remark"=>$request->testimonials_main_remark ?? '',
                    "felicitiation_main_event"=>$request->felicitiation_main_event ?? '',
                    "felicitiation_main_no_program"=>$request->felicitiation_main_no_program ?? '',
                    "felicitiation_main_remark"=>$request->felicitiation_main_remark ?? '',
                    "identifying_opinion_main_event"=>$request->identifying_opinion_main_event ?? '',
                    "identifying_opinion_main_no_program"=>$request->identifying_opinion_main_no_program ?? '',
                    "identifying_opinion_main_remark"=>$request->identifying_opinion_main_remark ?? '',
                    "expert_lectures_main_event"=>$request->expert_lectures_main_event ?? '',
                    "expert_lectures_main_no_program"=>$request->expert_lectures_main_no_program ?? '',
                    "expert_lectures_main_remark"=>$request->expert_lectures_main_remark ?? '',
                    "workshop_main_event"=>$request->workshop_main_event ?? '',
                    "workshop_main_no_program"=>$request->workshop_main_no_program ?? '',
                    "workshop_main_remark"=>$request->workshop_main_remark ?? '',
                    "media_station_workshop_main_event"=>$request->media_station_workshop_main_event ?? '',
                    "media_station_workshop_main_no_programm"=>$request->media_station_workshop_main_no_programm ?? '',
                    "media_station_workshop_main_remark"=>$request->media_station_workshop_main_remark ?? '',
                    "quiz_competitions_main_event"=>$request->quiz_competitions_main_event ?? '',
                    "quiz_competitions_main_no_program"=>$request->quiz_competitions_main_no_program ?? '',
                    "quiz_competitions_main_remark"=>$request->quiz_competitions_main_remark ?? '',
                    "public_meeting_main_event"=>$request->public_meeting_main_event ?? '',
                    "public_meeting_main_no_program"=>$request->public_meeting_main_no_program ?? '',
                    "public_meeting_main_remark"=>$request->public_meeting_main_remark ?? '',
                    "multimedia_component_main_event"=>$request->multimedia_component_main_event ?? '',
                    "multimedia_component_main_no_program"=>$request->multimedia_component_main_no_program ?? '',
                    "multimedia_component_main_remark"=>$request->multimedia_component_main_remark ?? '',
                    "nukkad_natak_main_event"=>$request->nukkad_natak_main_event ?? '',
                    "nukkad_natak_main_no_program"=>$request->nukkad_natak_main_no_program ?? '',
                    "nukkad_natak_main_remark"=>$request->nukkad_natak_main_remark ?? '',
                    "property_show_main_event"=>$request->property_show_main_event ?? '',
                    "property_show_main_no_program"=>$request->property_show_main_no_program ?? '',
                    "property_show_main_remark"=>$request->property_show_main_remark ?? '',
                    "megic_show_main_event"=>$request->megic_show_main_event ?? '',
                    "megic_show_main_no_program"=>$request->megic_show_main_no_program ?? '',
                    "megic_show_main_remark"=>$request->megic_show_main_remark ?? '',
                    "folk_song_main_event"=>$request->folk_song_main_event ?? '',
                    "folk_song_main_no_program"=>$request->folk_song_main_no_program ?? '',
                    "folk_song_main_remark"=>$request->folk_song_main_remark ?? '',
                    "folk_dance_main_event"=>$request->folk_dance_main_event ?? '',
                    "folk_dance_main_no_program"=>$request->folk_dance_main_no_program ?? '',
                    "folk_dance_main_remark"=>$request->folk_dance_main_remark ?? '',
                    "folk_drama_main_event"=>$request->folk_drama_main_event ?? '',
                    "folk_drama_main_no_program"=>$request->folk_drama_main_no_program ?? '',
                    "folk_drama_main_remark"=>$request->folk_drama_main_remark ?? '',
                    "av_medium_main_event"=>$request->av_medium_main_event ?? '',
                    "av_medium_main_no_program"=>$request->av_medium_main_no_program ?? '',
                    "av_medium_main_remark"=>$request->av_medium_main_remark ?? '',
                    "snippet_air_dd_main_event"=>$request->snippet_air_dd_main_event ?? '',
                    "snippet_air_dd_main_no_program"=>$request->snippet_air_dd_main_no_program ?? '',
                    "snippet_air_dd_main_remark"=>$request->snippet_air_dd_main_remark ?? '',
                    "other_av_meterial_main_event"=>$request->other_av_meterial_main_event ?? '',
                    "other_av_meterial_main_no_program"=>$request->other_av_meterial_main_no_program ?? '',
                    "other_av_meterial_main_remark"=>$request->other_av_meterial_main_remark ?? '',
                    "ten_twelve_stalls_main_event"=>$request->ten_twelve_stalls_main_event ?? '',
                    "ten_twelve_stalls_main_no_program"=>$request->ten_twelve_stalls_main_no_program ?? '',
                    "ten_twelve_stalls_main_remark"=>$request->ten_twelve_stalls_main_remark ?? '',
                    "ujwala_gas_main_event"=>$request->ujwala_gas_main_event ?? '',
                    "ujwala_gas_main_no_program"=>$request->ujwala_gas_main_no_program ?? '',
                    "ujwala_gas_main_remark"=>$request->ujwala_gas_main_remark ?? '',
                    "mudra_loans_main_event"=>$request->mudra_loans_main_event ?? '',
                    "mudra_loans_main_no_program"=>$request->mudra_loans_main_no_program ?? '',
                    "mudra_loans_main_remark"=>$request->mudra_loans_main_remark ?? '',
                    "kisian_credits_card_main_event"=>$request->kisian_credits_card_main_event ?? '',
                    "kisian_credits_card_main_no_program"=>$request->kisian_credits_card_main_no_program ?? '',
                    "kisian_credits_card_main_remark"=>$request->kisian_credits_card_main_remark ?? '',
                    "opening_account_main_event"=>$request->opening_account_main_event ?? '',
                    "opening_account_main_no_program"=>$request->opening_account_main_no_program ?? '',
                    "opening_account_main_remark"=>$request->opening_account_main_remark ?? '',
                    "other_govt_scheme_main_event"=>$request->other_govt_scheme_main_event ?? '',
                    "other_govt_scheme_main_no_program"=>$request->other_govt_scheme_main_no_program ?? '',
                    "other_govt_scheme_main_remark"=>$request->other_govt_scheme_main_remark ?? '',
                    "success_stories"=>$request->success_stories ?? '',
                    "local_input_about_program"=>$request->local_input_about_program ?? '',
                    "fb_twitter_instagram"=>$request->fb_twitter_instagram ?? '',
                    "web_streaming"=>$request->web_streaming ?? '',
                    "live_chat_session"=>$request->live_chat_session ?? '',
                    "talkathons"=>$request->talkathons ?? '',
                    "selfie_points"=>$request->selfie_points ?? '',
                    "social_media_wall"=>$request->social_media_wall ?? '',
                    "other"=>$request->other ?? '',
                    "media_coverage_txt"=>$request->media_coverage_txt ?? '',
                    "approx_size_of_audience"=>$request->approx_size_of_audience ?? '',
                    "community_network_created"=>$request->community_network_created ?? '',
                    "community_network_details"=>$request->community_network_details ?? '',
                    "virtual_network_created"=>$request->virtual_network_created ?? '',
                    "virtual_network_details"=>$request->virtual_network_details ?? '',
                    "radio_station_mobilized"=>$request->radio_station_mobilized ?? '',
                    "remarks"=>$request->remarks ?? '',
                    "social_media_campaign1_pre_event"=>$request->social_media_campaign1_pre_event ?? '',
                    "social_media_campaign1_txt_pre_event"=>$request->social_media_campaign1_txt_pre_event ?? '',
                    "Special_Areas"=>$special_area,
                    "mobilisation_other_check"=>$request->mobilisation_other_check ?? '',
                    "mobilisation_other_program"=>$request->mobilisation_other_program ?? '',
                    "mobilisation_other_remark"=>$request->mobilisation_other_remark ?? '',
                    "photo_check"=>$request->photo_check ?? '',
                    "photo_program"=>$request->photo_program ?? '',
                    "photo_program_remark"=>$request->photo_program_remark ?? '',
                    "digital_check"=>$request->digital_check ?? '',
                    "digital_program"=>$request->digital_program ?? '',
                    "digital_program_remark"=>$request->digital_program_remark ?? '',
                    "exhibition_other_check"=>$request->exhibition_other_check ?? '',
                    "exhibition_other_program"=>$request->exhibition_other_program ?? '',
                    "exhibition_other_program_remark"=>$request->exhibition_other_program_remark ?? '',
                    "cultural_other_check"=>$request->cultural_other_check ?? '',
                    "cultural_other_program"=>$request->cultural_other_program ?? '',
                    "cultural_other_remark"=>$request->cultural_other_remark ?? '',
                    "stalls_other_check"=>$request->stalls_other_check ?? '',
                    "stalls_other_program"=>$request->stalls_other_program ?? '',
                    "stalls_other_remark"=>$request->stalls_other_remark ?? '',
                    "govt_other_check"=>$request->govt_other_check ?? '',
                    "govt_other_program"=>$request->govt_other_program ?? '',
                    "govt_other_remark"=>$request->govt_other_remark ?? '',
                    "document_type"=>$request->document_type ?? '',
                    "event_date"=>$request->event_date ?? '',
                    "venue_event"=>$request->venue_event ?? '',
                    "rob_name"=>$request->rob_name,
                    "led_main_event"=>$request->led_main_event ?? 0,
                    "led_main_no_program"=>$request->led_main_no_program ?? '',
                    "led_main_remark"=>$request->led_main_remark ?? '',
                    "auto_main_event"=>$request->auto_main_event ?? 0,
                    "auto_dd_main_no_program"=>$request->auto_dd_main_no_program ?? '',
                    "auto_dd_main_remark"=>$request->auto_dd_main_remark ?? '',
                    "mini_auto_main_event"=>$request->mini_auto_main_event ?? 0,
                    "mini_auto_dd_main_no_program"=>$request->mini_auto_dd_main_no_program ?? '',
                    "mini_auto_dd_main_remark"=>$request->mini_auto_dd_main_remark ?? '',
                    "video_auto_main_event"=>$request->video_auto_main_event ?? 0,
                    "video_auto_dd_main_no_program"=>$request->video_auto_dd_main_no_program ?? '',
                    "video_auto_dd_main_remark"=>$request->video_auto_dd_main_remark ?? '',
                    "other_auto_main_event"=>$request->other_auto_main_event ?? 0,
                    "other_auto_dd_main_no_program"=>$request->other_auto_dd_main_no_program ?? '',
                    "other_auto_dd_main_remark"=>$request->other_auto_dd_main_remark ?? '',
                    "exhibition_other_check_standee"=>$request->exhibition_other_check_standee ?? 0,
                    "exhibition_other_program_standee"=>$request->exhibition_other_program_standee ?? '',
                    "exhibition_other_program_remark_standee"=>$request->exhibition_other_program_remark_standee ?? '',

                    'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                    'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                    "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                    "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                    "ministry_name"=>$request->ministry_name ?? '',
                    // "venue_event" =>$request->venue_event ?? '',
                    "event_description" => $request->event_description ?? '',
                    "event_description" => $request->event_description ?? '',
                    "officer_name_person"=>$request->officer_name_person ?? '',
                    "contact_no"=>$request->contact_no ?? '',
                    "person_designation" =>$request->person_designation ?? '',
                    "email" =>$request->email ?? '',
                    "approve" => $approve,
                    "block" => $request->block ?? '',
                    "district" =>$request->district ?? '',
                    "distance_covered" => $request->distance_covered ?? 0,
                    "last_visit_date" =>$request->last_visit_date
                ]);


            }
            else
            {

                $blank_arr=array();
                $special_area1=$request->special_area ?? $blank_arr;
                $special_area=implode(",", $special_area1);

                $update=DB::table('rob_forms')->where('Pk_id',$request->url_id)->update([
                    "programme_activity"=>$request->programme_activity,
                    "category_icop"=>$request->category_icop ?? '',
                    "activity_checkbox1"=>implode(",", $request->activity_checkbox1),
                    "sop_theme"=>$request->sop_theme ?? '',
                    "office_type"=>$request->office_type ?? '',
                    "region_id"=>$request->region_id ?? '',
                    "demography"=>implode(",", $request->demography),
                    "activity_area"=>implode(",", $request->activity_area),
                    "coverage"=>$request->coverage ?? '',
                    "village_name"=>$request->village_name ?? '',
                    "vip_name"=>$request->vip_name ?? '',
                    "vip_designation"=>$request->vip_designation ?? '',
                    "allocated_funds"=>$request->allocated_funds ?? '',
                    "officer_name"=>$request->officer_name ?? '',
                    "officer_designation"=>$request->officer_designation ?? '',
                    "office_location"=>$request->office_location ?? '',
                    "advance_account"=>$request->advance_account ?? '',
                    "sattlement_account_advance"=>$request->sattlement_account_advance ?? '',
                    "direct_settlement_bill_pao"=>$request->direct_settlement_bill_pao ?? '',
                    "duration_activity_from_date"=>$request->duration_activity_from_date ?? '',
                    "duration_activity_to_date"=>$request->duration_activity_to_date ?? '',
                    "no_of_days"=>$request->no_of_days ?? '',
                    "engagement_pre_event_activity"=>$request->engagement_pre_event_activity ?? '',
                    "engagement_txt_pre_event"=>$request->engagement_txt_pre_event ?? '',
                    "nukkad_natak_pre_event_activity"=>$request->nukkad_natak_pre_event_activity ?? '',
                    "nukkad_natak_txt_pre_event"=>$request->nukkad_natak_txt_pre_event ?? '',
                    "nukkad_natak1_pre_event_activity"=>$request->nukkad_natak1_pre_event_activity ?? '',
                    "nukkad_natak1_txt_pre_event"=>$request->nukkad_natak1_txt_pre_event ?? '',
                    "public_meeting_pre_event_activity"=>$request->public_meeting_pre_event_activity ?? '',
                    "public_meeting_txt_pre_event"=>$request->public_meeting_txt_pre_event ?? '',
                    "public_meeting1_pre_event_activity"=>$request->public_meeting1_pre_event_activity ?? '',
                    "public_meeting1_txt_pre_event"=>$request->public_meeting1_txt_pre_event ?? '',
                    "public_announcement_pre_event_activity"=>$request->public_announcement_pre_event_activity ?? '',
                    "public_announcement_txt_pre_event"=>$request->public_announcement_txt_pre_event ?? '',
                    "public_announcement1_pre_event_activity"=>$request->public_announcement1_pre_event_activity ?? '',
                    "public_announcement1_txt_pre_event"=>$request->public_announcement1_txt_pre_event ?? '',
                    "distribution_pamphlets_pre_event_activity"=>$request->distribution_pamphlets_pre_event_activity ?? '',
                    "distribution_pamphlets_txt_pre_event"=>$request->distribution_pamphlets_txt_pre_event ?? '',
                    "distribution_pamphlets1_pre_event_activity"=>$request->distribution_pamphlets1_pre_event_activity ?? '',
                    "distribution_pamphlets1_txt_pre_event"=>$request->distribution_pamphlets1_txt_pre_event ?? '',
                    "social_media_pre_event_activity"=>$request->social_media_pre_event_activity ?? '',
                    "social_media_txt_pre_event"=>$request->social_media_txt_pre_event ?? '',
                    "public_rally_pre_event_activity"=>$request->public_rally_pre_event_activity ?? '',
                    "public_rally_txt_pre_event"=>$request->public_rally_txt_pre_event ?? '',
                    "media_briefing_pre_event_activity"=>$request->media_briefing_pre_event_activity ?? '',
                    "media_briefing_txt_pre_event"=>$request->media_briefing_txt_pre_event ?? '',
                    "dd_air_curtain_pre_activity"=>$request->dd_air_curtain_pre_activity ?? '',
                    "dd_air_curtain_txt_pre_activity"=>$request->dd_air_curtain_txt_pre_activity ?? '',
                    "social_media_campaign_pre_event"=>$request->social_media_campaign_pre_event ?? '',
                    "social_media_campaign_txt_pre_event"=>$request->social_media_campaign_txt_pre_event ?? '',
                    "mobile_station_main_event_activity"=>$request->mobile_station_main_event_activity ?? '',
                    "mobile_station_main_no_program"=>$request->mobile_station_main_no_program ?? '',
                    "mobile_station_main_remark"=>$request->mobile_station_main_remark ?? '',
                    "painting_poetry_rangoli_main_activity"=>$request->painting_poetry_rangoli_main_activity ?? '',
                    "painting_poetry_rangoli_main_no_program"=>$request->painting_poetry_rangoli_main_no_program ?? '',
                    "painting_poetry_rangoli_main_remark"=>$request->painting_poetry_rangoli_main_remark ?? '',
                    "debate_seminar_symposium_main_event"=>$request->debate_seminar_symposium_main_event ?? '',
                    "debate_seminar_symposium_main_no_program"=>$request->debate_seminar_symposium_main_no_program ?? '',
                    "debate_seminar_symposium_main_remark"=>$request->debate_seminar_symposium_main_remark ?? '',
                    "testimonials_main_event"=>$request->testimonials_main_event ?? '',
                    "testimonials_main_no_program"=>$request->testimonials_main_no_program ?? '',
                    "testimonials_main_remark"=>$request->testimonials_main_remark ?? '',
                    "felicitiation_main_event"=>$request->felicitiation_main_event ?? '',
                    "felicitiation_main_no_program"=>$request->felicitiation_main_no_program ?? '',
                    "felicitiation_main_remark"=>$request->felicitiation_main_remark ?? '',
                    "identifying_opinion_main_event"=>$request->identifying_opinion_main_event ?? '',
                    "identifying_opinion_main_no_program"=>$request->identifying_opinion_main_no_program ?? '',
                    "identifying_opinion_main_remark"=>$request->identifying_opinion_main_remark ?? '',
                    "expert_lectures_main_event"=>$request->expert_lectures_main_event ?? '',
                    "expert_lectures_main_no_program"=>$request->expert_lectures_main_no_program ?? '',
                    "expert_lectures_main_remark"=>$request->expert_lectures_main_remark ?? '',
                    "workshop_main_event"=>$request->workshop_main_event ?? '',
                    "workshop_main_no_program"=>$request->workshop_main_no_program ?? '',
                    "workshop_main_remark"=>$request->workshop_main_remark ?? '',
                    "media_station_workshop_main_event"=>$request->media_station_workshop_main_event ?? '',
                    "media_station_workshop_main_no_programm"=>$request->media_station_workshop_main_no_programm ?? '',
                    "media_station_workshop_main_remark"=>$request->media_station_workshop_main_remark ?? '',
                    "quiz_competitions_main_event"=>$request->quiz_competitions_main_event ?? '',
                    "quiz_competitions_main_no_program"=>$request->quiz_competitions_main_no_program ?? '',
                    "quiz_competitions_main_remark"=>$request->quiz_competitions_main_remark ?? '',
                    "public_meeting_main_event"=>$request->public_meeting_main_event ?? '',
                    "public_meeting_main_no_program"=>$request->public_meeting_main_no_program ?? '',
                    "public_meeting_main_remark"=>$request->public_meeting_main_remark ?? '',
                    "multimedia_component_main_event"=>$request->multimedia_component_main_event ?? '',
                    "multimedia_component_main_no_program"=>$request->multimedia_component_main_no_program ?? '',
                    "multimedia_component_main_remark"=>$request->multimedia_component_main_remark ?? '',
                    "nukkad_natak_main_event"=>$request->nukkad_natak_main_event ?? '',
                    "nukkad_natak_main_no_program"=>$request->nukkad_natak_main_no_program ?? '',
                    "nukkad_natak_main_remark"=>$request->nukkad_natak_main_remark ?? '',
                    "property_show_main_event"=>$request->property_show_main_event ?? '',
                    "property_show_main_no_program"=>$request->property_show_main_no_program ?? '',
                    "property_show_main_remark"=>$request->property_show_main_remark ?? '',
                    "megic_show_main_event"=>$request->megic_show_main_event ?? '',
                    "megic_show_main_no_program"=>$request->megic_show_main_no_program ?? '',
                    "megic_show_main_remark"=>$request->megic_show_main_remark ?? '',
                    "folk_song_main_event"=>$request->folk_song_main_event ?? '',
                    "folk_song_main_no_program"=>$request->folk_song_main_no_program ?? '',
                    "folk_song_main_remark"=>$request->folk_song_main_remark ?? '',
                    "folk_dance_main_event"=>$request->folk_dance_main_event ?? '',
                    "folk_dance_main_no_program"=>$request->folk_dance_main_no_program ?? '',
                    "folk_dance_main_remark"=>$request->folk_dance_main_remark ?? '',
                    "folk_drama_main_event"=>$request->folk_drama_main_event ?? '',
                    "folk_drama_main_no_program"=>$request->folk_drama_main_no_program ?? '',
                    "folk_drama_main_remark"=>$request->folk_drama_main_remark ?? '',
                    "av_medium_main_event"=>$request->av_medium_main_event ?? '',
                    "av_medium_main_no_program"=>$request->av_medium_main_no_program ?? '',
                    "av_medium_main_remark"=>$request->av_medium_main_remark ?? '',
                    "snippet_air_dd_main_event"=>$request->snippet_air_dd_main_event ?? '',
                    "snippet_air_dd_main_no_program"=>$request->snippet_air_dd_main_no_program ?? '',
                    "snippet_air_dd_main_remark"=>$request->snippet_air_dd_main_remark ?? '',
                    "other_av_meterial_main_event"=>$request->other_av_meterial_main_event ?? '',
                    "other_av_meterial_main_no_program"=>$request->other_av_meterial_main_no_program ?? '',
                    "other_av_meterial_main_remark"=>$request->other_av_meterial_main_remark ?? '',
                    "ten_twelve_stalls_main_event"=>$request->ten_twelve_stalls_main_event ?? '',
                    "ten_twelve_stalls_main_no_program"=>$request->ten_twelve_stalls_main_no_program ?? '',
                    "ten_twelve_stalls_main_remark"=>$request->ten_twelve_stalls_main_remark ?? '',
                    "ujwala_gas_main_event"=>$request->ujwala_gas_main_event ?? '',
                    "ujwala_gas_main_no_program"=>$request->ujwala_gas_main_no_program ?? '',
                    "ujwala_gas_main_remark"=>$request->ujwala_gas_main_remark ?? '',
                    "mudra_loans_main_event"=>$request->mudra_loans_main_event ?? '',
                    "mudra_loans_main_no_program"=>$request->mudra_loans_main_no_program ?? '',
                    "mudra_loans_main_remark"=>$request->mudra_loans_main_remark ?? '',
                    "kisian_credits_card_main_event"=>$request->kisian_credits_card_main_event ?? '',
                    "kisian_credits_card_main_no_program"=>$request->kisian_credits_card_main_no_program ?? '',
                    "kisian_credits_card_main_remark"=>$request->kisian_credits_card_main_remark ?? '',
                    "opening_account_main_event"=>$request->opening_account_main_event ?? '',
                    "opening_account_main_no_program"=>$request->opening_account_main_no_program ?? '',
                    "opening_account_main_remark"=>$request->opening_account_main_remark ?? '',
                    "other_govt_scheme_main_event"=>$request->other_govt_scheme_main_event ?? '',
                    "other_govt_scheme_main_no_program"=>$request->other_govt_scheme_main_no_program ?? '',
                    "other_govt_scheme_main_remark"=>$request->other_govt_scheme_main_remark ?? '',
                    "success_stories"=>$request->success_stories ?? '',
                    "local_input_about_program"=>$request->local_input_about_program ?? '',
                    "fb_twitter_instagram"=>$request->fb_twitter_instagram ?? '',
                    "web_streaming"=>$request->web_streaming ?? '',
                    "live_chat_session"=>$request->live_chat_session ?? '',
                    "talkathons"=>$request->talkathons ?? '',
                    "selfie_points"=>$request->selfie_points ?? '',
                    "social_media_wall"=>$request->social_media_wall ?? '',
                    "other"=>$request->other ?? '',
                    "media_coverage_txt"=>$request->media_coverage_txt ?? '',
                    "approx_size_of_audience"=>$request->approx_size_of_audience ?? '',
                    "community_network_created"=>$request->community_network_created ?? '',
                    "community_network_details"=>$request->community_network_details ?? '',
                    "virtual_network_created"=>$request->virtual_network_created ?? '',
                    "virtual_network_details"=>$request->virtual_network_details ?? '',
                    "radio_station_mobilized"=>$request->radio_station_mobilized ?? '',
                    "remarks"=>$request->remarks ?? '',
                    "social_media_campaign1_pre_event"=>$request->social_media_campaign1_pre_event ?? '',
                    "social_media_campaign1_txt_pre_event"=>$request->social_media_campaign1_txt_pre_event ?? '',
                    "Special_Areas"=>$special_area,
                    "mobilisation_other_check"=>$request->mobilisation_other_check ?? '',
                    "mobilisation_other_program"=>$request->mobilisation_other_program ?? '',
                    "mobilisation_other_remark"=>$request->mobilisation_other_remark ?? '',
                    "photo_check"=>$request->photo_check ?? '',
                    "photo_program"=>$request->photo_program ?? '',
                    "photo_program_remark"=>$request->photo_program_remark ?? '',
                    "digital_check"=>$request->digital_check ?? '',
                    "digital_program"=>$request->digital_program ?? '',
                    "digital_program_remark"=>$request->digital_program_remark ?? '',
                    "exhibition_other_check"=>$request->exhibition_other_check ?? '',
                    "exhibition_other_program"=>$request->exhibition_other_program ?? '',
                    "exhibition_other_program_remark"=>$request->exhibition_other_program_remark ?? '',
                    "cultural_other_check"=>$request->cultural_other_check ?? '',
                    "cultural_other_program"=>$request->cultural_other_program ?? '',
                    "cultural_other_remark"=>$request->cultural_other_remark ?? '',
                    "stalls_other_check"=>$request->stalls_other_check ?? '',
                    "stalls_other_program"=>$request->stalls_other_program ?? '',
                    "stalls_other_remark"=>$request->stalls_other_remark ?? '',
                    "govt_other_check"=>$request->govt_other_check ?? '',
                    "govt_other_program"=>$request->govt_other_program ?? '',
                    "govt_other_remark"=>$request->govt_other_remark ?? '',
                    "document_type"=>$request->document_type ?? '',
                    "event_date"=>$request->event_date ?? '',
                    "venue_event"=>$request->venue_event ?? '',
                    "rob_name"=>$request->rob_name,
                    "led_main_event"=>$request->led_main_event ?? 0,
                    "led_main_no_program"=>$request->led_main_no_program ?? '',
                    "led_main_remark"=>$request->led_main_remark ?? '',
                    "auto_main_event"=>$request->auto_main_event ?? 0,
                    "auto_dd_main_no_program"=>$request->auto_dd_main_no_program ?? '',
                    "auto_dd_main_remark"=>$request->auto_dd_main_remark ?? '',
                    "mini_auto_main_event"=>$request->mini_auto_main_event ?? 0,
                    "mini_auto_dd_main_no_program"=>$request->mini_auto_dd_main_no_program ?? '',
                    "mini_auto_dd_main_remark"=>$request->mini_auto_dd_main_remark ?? '',
                    "video_auto_main_event"=>$request->video_auto_main_event ?? 0,
                    "video_auto_dd_main_no_program"=>$request->video_auto_dd_main_no_program ?? '',
                    "video_auto_dd_main_remark"=>$request->video_auto_dd_main_remark ?? '',
                    "other_auto_main_event"=>$request->other_auto_main_event ?? 0,
                    "other_auto_dd_main_no_program"=>$request->other_auto_dd_main_no_program ?? '',
                    "other_auto_dd_main_remark"=>$request->other_auto_dd_main_remark ?? '',
                    "exhibition_other_check_standee"=>$request->exhibition_other_check_standee ?? 0,
                    "exhibition_other_program_standee"=>$request->exhibition_other_program_standee ?? '',
                    "exhibition_other_program_remark_standee"=>$request->exhibition_other_program_remark_standee ?? '',

                    'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                    'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                    "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                    "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                    "ministry_name"=>$request->ministry_name ?? '',
                    // "venue_event" =>$request->venue_event ?? '',
                    "event_description" => $request->event_description ?? '',
                    "event_description" => $request->event_description ?? '',
                    "officer_name_person"=>$request->officer_name_person ?? '',
                    "contact_no"=>$request->contact_no ?? '',
                    "person_designation" =>$request->person_designation ?? '',
                    "email" =>$request->email ?? '',
                    "approve" => $approve,
                    "block" => $request->block ?? '',
                    "district" =>$request->district ?? '',
                    "distance_covered" => $request->distance_covered ?? 0,
                    "last_visit_date" =>$request->last_visit_date
            ]);
            }


        } //main else close

    }
    // post-form update
    public function rob_insert(Request $request)
    {

        $office_name=Session::get('UserName');
        $table1='[rob_forms]';
        $get_id=$request->get_id;
        // dd($request->govt_event);
        if(!empty($request->govt_event[0]) || $request->govt_event[0]!=null)
        {
            DB::table('rob_government_benefits')->where('form_id',$request->getid)->delete();
            foreach($request->govt_event as $key => $govt_event)
            {
                // $Pk_id = DB::select('select TOP 1 [Pk_id] from dbo.[rob_forms] order by [Pk_id] desc');
                $id=DB::table('rob_government_benefits')->select('id')->orderBy("id",'desc')->first();
                if (empty($id)) {
                    $id = 1;
                } else {
                    $id = $id->id;
                    $id++;
                }


                $govt_event=$request->govt_event[$key] ?? '';
                $ujwala_gas_main_no_program_=$request->ujwala_gas_main_no_program_[$key] ?? '';
                $ujwala_gas_main_remark_=$request->ujwala_gas_main_remark_[$key] ?? '';
                $data=array(
                    "id"                         =>$id,
                    "login_user"                 => Session::get('UserName'),
                    "form_id"                    => $request->getid,
                    "govt_event"                 => $govt_event,
                    "ujwala_gas_main_no_program" => $ujwala_gas_main_no_program_,
                    "ujwala_gas_main_remark"     => $ujwala_gas_main_remark_,
                    "create_at"                  => date('Y-m-d')
                );
                DB::table('rob_government_benefits')->insert($data);
            }

        }


        $blank_arr=array();
        $special_area1=$request->special_area ?? $blank_arr;
        $special_area=implode(",", $special_area1);

        $id=$request->getid;
        $rob_ary=array(
                "programme_activity"=> $request->programme_activity,
                "category_icop"=> $request->category_icop,
                "activity_checkbox1"=> implode(",", $request->activity_checkbox1),
                "sop_theme"=> $request->sop_theme,
                "office_type"=> $request->office_type,
                "region_id"=> $request->region_id,
                "demography"=> implode(",", $request->demography),
                "activity_area"=> implode(",", $request->activity_area),
                "coverage"=> $request->coverage,
                "village_name"=> $request->village_name,
                "duration_activity_from_date"=> $request->duration_activity_from_date,
                "duration_activity_to_date"=> $request->duration_activity_to_date,
                "no_of_days"=> $request->no_of_days,
                "engagement_pre_event_activity"=> $request->engagement_pre_event_activity,
                "engagement_txt_pre_event"=> $request->engagement_txt_pre_event,
                "nukkad_natak_pre_event_activity"=> $request->nukkad_natak_pre_event_activity,
                "nukkad_natak_txt_pre_event"=> $request->nukkad_natak_txt_pre_event,
                "nukkad_natak1_pre_event_activity"=> $request->nukkad_natak1_pre_event_activity,
                "nukkad_natak1_txt_pre_event"=> $request->nukkad_natak1_txt_pre_event,
                "public_meeting_pre_event_activity"=> $request->public_meeting_pre_event_activity,
                "public_meeting_txt_pre_event"=> $request->public_meeting_txt_pre_event,
                "public_meeting1_pre_event_activity"=> $request->public_meeting1_pre_event_activity,
                "public_meeting1_txt_pre_event"=> $request->public_meeting1_txt_pre_event,
                "public_announcement_pre_event_activity"=> $request->public_announcement_pre_event_activity,
                "public_announcement_txt_pre_event"=> $request->public_announcement_txt_pre_event,
                "public_announcement1_pre_event_activity"=> $request->public_announcement1_pre_event_activity,
                "public_announcement1_txt_pre_event"=> $request->public_announcement1_txt_pre_event,
                "distribution_pamphlets_pre_event_activity"=> $request->distribution_pamphlets_pre_event_activity,
                "distribution_pamphlets_txt_pre_event"=> $request->distribution_pamphlets_txt_pre_event,
                "distribution_pamphlets1_pre_event_activity"=> $request->distribution_pamphlets1_pre_event_activity,
                "distribution_pamphlets1_txt_pre_event"=> $request->distribution_pamphlets1_txt_pre_event,
                "social_media_pre_event_activity"=> $request->social_media_pre_event_activity,
                "social_media_txt_pre_event"=> $request->social_media_txt_pre_event,
                "public_rally_pre_event_activity"=> $request->public_rally_pre_event_activity,
                "public_rally_txt_pre_event"=> $request->public_rally_txt_pre_event,
                "media_briefing_pre_event_activity"=> $request->media_briefing_pre_event_activity,
                "media_briefing_txt_pre_event"=> $request->media_briefing_txt_pre_event,
                "dd_air_curtain_pre_activity"=> $request->dd_air_curtain_pre_activity,
                "dd_air_curtain_txt_pre_activity"=> $request->dd_air_curtain_txt_pre_activity,
                "social_media_campaign_pre_event"=> $request->social_media_campaign_pre_event,
                "social_media_campaign_txt_pre_event"=> $request->social_media_campaign_txt_pre_event,
                "mobile_station_main_event_activity"=> $request->mobile_station_main_event_activity,
                "mobile_station_main_no_program"=> $request->mobile_station_main_no_program,
                "mobile_station_main_remark"=> $request->mobile_station_main_remark,
                "painting_poetry_rangoli_main_activity"=> $request->painting_poetry_rangoli_main_activity,
                "painting_poetry_rangoli_main_no_program"=> $request->painting_poetry_rangoli_main_no_program,
                "painting_poetry_rangoli_main_remark"=> $request->painting_poetry_rangoli_main_remark,
                "debate_seminar_symposium_main_event"=> $request->debate_seminar_symposium_main_event,
                "debate_seminar_symposium_main_no_program"=> $request->debate_seminar_symposium_main_no_program,
                "debate_seminar_symposium_main_remark"=> $request->debate_seminar_symposium_main_remark,
                "testimonials_main_event"=> $request->testimonials_main_event,
                "testimonials_main_no_program"=> $request->testimonials_main_no_program,
                "testimonials_main_remark"=> $request->testimonials_main_remark,
                "felicitiation_main_event"=> $request->felicitiation_main_event,
                "felicitiation_main_no_program"=> $request->felicitiation_main_no_program,
                "felicitiation_main_remark"=> $request->felicitiation_main_remark,
                "identifying_opinion_main_event"=> $request->identifying_opinion_main_event,
                "identifying_opinion_main_no_program"=> $request->identifying_opinion_main_no_program,
                "identifying_opinion_main_remark"=> $request->identifying_opinion_main_remark,
                "expert_lectures_main_event"=> $request->expert_lectures_main_event,
                "expert_lectures_main_no_program"=> $request->expert_lectures_main_no_program,
                "expert_lectures_main_remark"=> $request->expert_lectures_main_remark,
                "workshop_main_event"=> $request->workshop_main_event,
                "workshop_main_no_program"=> $request->workshop_main_no_program,
                "workshop_main_remark"=> $request->workshop_main_remark,
                "media_station_workshop_main_event"=> $request->media_station_workshop_main_event,
                "media_station_workshop_main_no_programm"=> $request->media_station_workshop_main_no_programm,
                "media_station_workshop_main_remark"=> $request->media_station_workshop_main_remark,
                "quiz_competitions_main_event"=> $request->quiz_competitions_main_event,
                "quiz_competitions_main_no_program"=> $request->quiz_competitions_main_no_program,
                "quiz_competitions_main_remark"=> $request->quiz_competitions_main_remark,
                "public_meeting_main_event"=> $request->public_meeting_main_event,
                "public_meeting_main_no_program"=> $request->public_meeting_main_no_program,
                "public_meeting_main_remark"=> $request->public_meeting_main_remark,
                "multimedia_component_main_event"=> $request->multimedia_component_main_event,
                "multimedia_component_main_no_program"=> $request->multimedia_component_main_no_program,
                "multimedia_component_main_remark"=> $request->multimedia_component_main_remark,
                "nukkad_natak_main_event"=> $request->nukkad_natak_main_event,
                "nukkad_natak_main_no_program"=> $request->nukkad_natak_main_no_program,
                "nukkad_natak_main_remark"=> $request->nukkad_natak_main_remark,
                "property_show_main_event"=> $request->property_show_main_event,
                "property_show_main_no_program"=> $request->property_show_main_no_program,
                "property_show_main_remark"=> $request->property_show_main_remark,
                "megic_show_main_event"=> $request->megic_show_main_event,
                "megic_show_main_no_program"=> $request->megic_show_main_no_program,
                "megic_show_main_remark"=> $request->megic_show_main_remark,
                "folk_song_main_event"=> $request->folk_song_main_event,
                "folk_song_main_no_program"=> $request->folk_song_main_no_program,
                "folk_song_main_remark"=> $request->folk_song_main_remark,
                "folk_dance_main_event"=> $request->folk_dance_main_event,
                "folk_dance_main_no_program"=> $request->folk_dance_main_no_program,
                "folk_dance_main_remark"=> $request->folk_dance_main_remark,
                "folk_drama_main_event"=> $request->folk_drama_main_event,
                "folk_drama_main_no_program"=> $request->folk_drama_main_no_program,
                "folk_drama_main_remark"=> $request->folk_drama_main_remark,
                "av_medium_main_event"=> $request->av_medium_main_event,
                "av_medium_main_no_program"=> $request->av_medium_main_no_program,
                "av_medium_main_remark"=> $request->av_medium_main_remark,
                "snippet_air_dd_main_event"=> $request->snippet_air_dd_main_event,
                "snippet_air_dd_main_no_program"=> $request->snippet_air_dd_main_no_program,
                "snippet_air_dd_main_remark"=> $request->snippet_air_dd_main_remark,
                "other_av_meterial_main_event"=> $request->other_av_meterial_main_event,
                "other_av_meterial_main_no_program"=> $request->other_av_meterial_main_no_program,
                "other_av_meterial_main_remark"=> $request->other_av_meterial_main_remark,
                "ten_twelve_stalls_main_event"=> $request->ten_twelve_stalls_main_event,
                "ten_twelve_stalls_main_no_program"=> $request->ten_twelve_stalls_main_no_program,
                "ten_twelve_stalls_main_remark"=> $request->ten_twelve_stalls_main_remark,
                "ujwala_gas_main_event"=> $request->ujwala_gas_main_event,
                "ujwala_gas_main_no_program"=> $request->ujwala_gas_main_no_program,
                "ujwala_gas_main_remark"=> $request->ujwala_gas_main_remark,
                "mudra_loans_main_event"=> $request->mudra_loans_main_event,
                "mudra_loans_main_no_program"=> $request->mudra_loans_main_no_program,
                "mudra_loans_main_remark"=> $request->mudra_loans_main_remark,
                "kisian_credits_card_main_event"=> $request->kisian_credits_card_main_event,
                "kisian_credits_card_main_no_program"=> $request->kisian_credits_card_main_no_program,
                "kisian_credits_card_main_remark"=> $request->kisian_credits_card_main_remark,
                "opening_account_main_event"=> $request->opening_account_main_event,
                "opening_account_main_no_program"=> $request->opening_account_main_no_program,
                "opening_account_main_remark"=> $request->opening_account_main_remark,
                "other_govt_scheme_main_event"=> $request->other_govt_scheme_main_event,
                "other_govt_scheme_main_no_program"=> $request->other_govt_scheme_main_no_program,
                "other_govt_scheme_main_remark"=> $request->other_govt_scheme_main_remark,
                "success_stories"=> $request->success_stories,
                "local_input_about_program"=> $request->local_input_about_program,
                "fb_twitter_instagram"=> $request->fb_twitter_instagram,
                "web_streaming"=> $request->web_streaming,
                "live_chat_session"=> $request->live_chat_session,
                "talkathons"=> $request->talkathons,
                "selfie_points"=> $request->selfie_points,
                "social_media_wall"=> $request->social_media_wall,
                "other"=> $request->other,
                "media_coverage_txt"=> $request->media_coverage_txt,
                "approx_size_of_audience"=> $request->approx_size_of_audience,
                "community_network_created"=> $request->community_network_created,
                "community_network_details"=> $request->community_network_details,
                "virtual_network_created"=> $request->virtual_network_created,
                "virtual_network_details"=> $request->virtual_network_details,
                "radio_station_mobilized"=> $request->radio_station_mobilized,
                "remarks"=> $request->remarks,
                "social_media_campaign1_pre_event"=> $request->social_media_campaign1_pre_event,
                "social_media_campaign1_txt_pre_event"=> $request->social_media_campaign1_txt_pre_event,
                "Special_Areas"=> $special_area,
                "mobilisation_other_check"=> $request->mobilisation_other_check,
                "mobilisation_other_program"=> $request->mobilisation_other_program,
                "mobilisation_other_remark"=> $request->mobilisation_other_remark,
                "photo_check"=> $request->photo_check,
                "photo_program"=> $request->photo_program,
                "photo_program_remark"=> $request->photo_program_remark,
                "digital_check"=> $request->digital_check,
                "digital_program"=> $request->digital_program,
                "digital_program_remark"=> $request->digital_program_remark,
                "exhibition_other_check"=> $request->exhibition_other_check,
                "exhibition_other_program"=> $request->exhibition_other_program,
                "exhibition_other_program_remark"=> $request->exhibition_other_program_remark,
                "cultural_other_check"=> $request->cultural_other_check,
                "cultural_other_program"=> $request->cultural_other_program,
                "cultural_other_remark"=> $request->cultural_other_remark,
                "stalls_other_check"=> $request->stalls_other_check,
                "stalls_other_program"=> $request->stalls_other_program,
                "stalls_other_remark"=> $request->stalls_other_remark,
                "govt_other_check"=> $request->govt_other_check,
                "govt_other_program"=> $request->govt_other_program,
                "govt_other_remark"=> $request->govt_other_remark,
                "document_type"=> $request->document_type,
                "event_date"=> $request->event_date,
                "venue_event"=> $request->venue_event,
                "vip_name"=>$request->vip_name ?? '',
                "vip_designation"=>$request->vip_designation ?? '',

                // "user_type"=>Session::get('UserType'),
                "rob_name"=>$request->rob_name,
                "led_main_event"=>$request->led_main_event ?? 0,
                "led_main_no_program"=>$request->led_main_no_program ?? '',
                "led_main_remark"=>$request->led_main_remark ?? '',
                "auto_main_event"=>$request->auto_main_event ?? 0,
                "auto_dd_main_no_program"=>$request->auto_dd_main_no_program ?? '',
                "auto_dd_main_remark"=>$request->auto_dd_main_remark ?? '',
                "mini_auto_main_event"=>$request->mini_auto_main_event ?? 0,
                "mini_auto_dd_main_no_program"=>$request->mini_auto_dd_main_no_program ?? '',
                "mini_auto_dd_main_remark"=>$request->mini_auto_dd_main_remark ?? '',
                "video_auto_main_event"=>$request->video_auto_main_event ?? 0,
                "video_auto_dd_main_no_program"=>$request->video_auto_dd_main_no_program ?? '',
                "video_auto_dd_main_remark"=>$request->video_auto_dd_main_remark ?? '',
                "other_auto_main_event"=>$request->other_auto_main_event ?? 0,
                "other_auto_dd_main_no_program"=>$request->other_auto_dd_main_no_program ?? '',
                "other_auto_dd_main_remark"=>$request->other_auto_dd_main_remark ?? '',
                "exhibition_other_check_standee"=>$request->exhibition_other_check_standee ?? 0,
                "exhibition_other_program_standee"=>$request->exhibition_other_program_standee ?? '',
                "exhibition_other_program_remark_standee"=>$request->exhibition_other_program_remark_standee ?? '',
                "pre_show_website"=>$request->pre_show_website ?? 0,
                'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                "ministry_name"=>$request->ministry_name ?? '',
                // "venue_event" =>$request->venue_event ?? '',
                "event_description" => $request->event_description ?? '',
                "officer_name_person"=>$request->officer_name_person ?? '',
                "contact_no"=>$request->contact_no ?? '',
                "person_designation" =>$request->person_designation ?? '',
                "email" =>$request->email ?? '',
                "block" => $request->block ?? '',
                "district" =>$request->district ?? '',
                "distance_covered" => $request->distance_covered ?? 0,
                "last_visit_date" =>$request->last_visit_date,
                "pre_remark" => $request->pre_remark ?? ''

            );




            $data=DB::table('rob_forms')->where('Pk_id',$id)->update($rob_ary);
            $getdata=DB::table('rob_government_benefits')->where('form_id',$id)->get()->toArray();
            $totalID=[];
            foreach($getdata as $value)
            {
                $totalID[]=$value->id;
            }
            // dd($totalID);
            // $id=implode(",", $totalID);
            return response()->json($totalID);



    }

    public function robSubmit_backup(Request $request)
    {
        return DB::transaction(function () use ($request) {
        // $request->validate([
        //     "document_type" => 'required',
        //     "event_date" => 'required',
        //     "venue_event" => 'required',
        //     "detail_report"=>'required',
        //     "document_name"=>'required',
        //     "caption_name"=>'required',

        //     "video"=>'required',
        //     "video2"=>'required',
        //     "video3"=>'required',
        //     "video_caption"=>'required',
        //     "video2_caption"=>'required',
        //     "video3_caption"=>'required',

        //     "press_document_name"=>'required',
        //     "press_caption_name"=>'required'
        // ]);

        // $validator = Validator::make($request->all(), [
        //     'document_type'    => 'required',
        //     'event_date'       => 'required',
        //     'venue_event'      => 'required',
        //     'detail_report'    => 'required',
        //     'video'            => 'required',
        //     'video_caption'    => 'required',
        //     'video2'           => 'required',
        //     'video2_caption'   => 'required',
        //     'video3'           => 'required',
        //     'video3_caption'   => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error'=>$validator->errors()->all()]);
        // }




        if(Session::get('UserType')==2)
        {
            $approve=1;
        }
        else
        {
            $approve=0;
        }

        $document_type=$request->document_type ?? '';
        // $caption_name=$request->caption_name ?? '';
        // $show_website=$request->show_website ?? '';
        $event_date=$request->event_date ?? '';
        $venue_event=$request->venue_event ?? '';
        $user_id=Session('UserID');
        // $get_insert_id=DB::table('rob_forms')->select('*')->where('user_id',$user_id)->orderBy('Pk_id','desc')->first();
        // $last_ID=$get_insert_id->Pk_id;

        if($request->rob_form_id!='')
        {
            $rob_form_id=$request->rob_form_id;
            $created_date = date('m/d/Y');
            $table='[rob_documents]';

            $existData=DB::table('rob_forms')->select('*')->where('Pk_id',$rob_form_id)->first();
            //update last tab in rob_form table

            if ($request->hasFile('detail_report'))
            {
                $file = $request->file('detail_report');
                $filename2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $filename2);
            }
            else
            {
                $filename2='';
            }

            if ($request->hasFile('video'))
            {
                $file = $request->file('video');
                $video = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video);
            }
            else
            {
                $video=$existData->video;
            }

            if ($request->hasFile('video2'))
            {
                $file = $request->file('video2');
                $video2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video2);
            }
            else
            {
                // $video2='';
                $video2=$existData->video2;
            }

            if ($request->hasFile('video3'))
            {
                $file = $request->file('video3');
                $video3 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video3);
            }
            else
            {
                $video3=$existData->video3;
            }

            DB::table('rob_forms')
                ->where('Pk_id',$request->getid)
                ->update([
                    "document_type"=>$request->document_type ?? '',
                    "event_date"=>$request->event_date ?? '',
                    "venue_event"=>$request->venue_event ?? '',
                    "detail_report"=>$filename2,
                    "video"=>$video,
                    "video_caption"=>$request->video_caption ?? $existData->video_caption,
                    "video2"=>$video2,
                    "video2_caption"=>$request->video2_caption ?? $existData->video2_caption,
                    "video3"=>$video3,
                    "video3_caption"=>$request->video3_caption ?? $existData->video3_caption,
                    "status"=>2,
                    "approve" => $approve
                ]);



             DB::table("rob_documents")->where(['rob_form_id'=>$rob_form_id,"image_type"=>0])->delete(); //add 1 apr
            if(!empty($request->caption_name[0]) || $request->document_name!=null)
            {
                foreach($request->document_name as $key => $document_name )
                {
                    $caption_name=$request->caption_name[$key];
                    $show_website=$request->show_website[$key] ?? '0';

                    // $document_modify=$request->document_name_modify[$key] ?? ''; //when you not choose file
                    // $caption_modify=$request->caption_name_modify[$key] ?? ''; //when you not choose file

                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id))
                    {
                        $pk_document_id=1;
                    } else
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    if ($request->hasFile('document_name'))
                    {
                        $file = $request->file('document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }
                    else
                    {
                        $filename=$document_modify;
                    }


                        $doc_array=array(
                            "pk_document_id" => $pk_document_id,
                            "rob_form_id" => $request->getid,
                            "event_date" => $event_date,
                            "document_name" => $filename,
                            "caption_name" => $caption_name,
                            "show_website" => $show_website,
                            "created_date" => $created_date,
                            "image_type" => 0
                        );
                        $sql=DB::table('rob_documents')->insert($doc_array);
                } //end foreach
            }
            else
            {     //comment 30 May
                // if(!empty($request->document_name_modify))
                if($request->document_name_modify!=null)
                {

                    foreach($request->document_name_modify as $key => $document_name )
                    {
                        $document_modify=$request->document_name_modify[$key] ?? '';
                        $caption_name=$request->caption_name_modify[$key] ?? '';
                        $show_website=$request->show_website_modify[$key] ?? '0';

                        // $document_modify=$request->document_name_modify[$key] ?? ''; //when you not choose file
                        // $caption_modify=$request->caption_name_modify[$key] ?? ''; //when you not choose file

                        $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                        if (empty($pk_document_id))
                        {
                            // $pk_document_id = 'PKOW1';
                            $pk_document_id=1;
                        } else
                        {
                            $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                            $pk_document_id++;
                        }

                        //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                        // if ($request->hasFile('document_name'))
                        // {
                        //     $file = $request->file('document_name')[$key];
                        //     $filename = time() . '-' . $file->getClientOriginalName();
                        //     $file->move('rob/', $filename);
                        // }
                        // else
                        // {
                        //     $filename=$document_name;
                        // }


                            $doc_array=array(
                                "pk_document_id" => $pk_document_id,
                                "rob_form_id" => $request->getid,
                                "event_date" => $event_date,
                                "document_name" => $document_modify,
                                "caption_name" => $caption_name,
                                "show_website" => $show_website,
                                "created_date" => $created_date,
                                "image_type" => 0
                            );
                            $sql=DB::table('rob_documents')->insert($doc_array);
                    } //end foreach
                }
            }







            //for press
            DB::table("rob_documents")->where(['rob_form_id'=>$rob_form_id,"image_type"=>1])->delete(); //add 1 apr
            if(!empty($request->press_caption_name[0]) || $request->press_document_name!=null)
            {
                foreach($request->press_document_name as $key => $press_document_name)
                {
                    $press_caption_name=$request->press_caption_name[$key] ?? '';
                    $press_show_website=$request->press_show_website[$key] ?? '0';

                    $press_document_name_modify=$request->press_document_name_modify[$key] ?? ''; //when you not choose file
                    $press_caption_name_modify=$request->press_caption_name_modify[$key] ?? '';

                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id))
                    {
                        // $pk_document_id = 'PKOW1';
                        $pk_document_id=1;
                    } else
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    if ($request->hasFile('press_document_name'))
                    {
                        $file = $request->file('press_document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }
                    else
                    {
                        $filename=$press_document_name_modify;
                    }

                        $press_array=array(
                            "pk_document_id"=> $pk_document_id,
                            "rob_form_id"=> $request->getid,
                            "event_date"=> $event_date,
                            "document_name"=> $filename,
                            "caption_name"=> $press_caption_name,
                            "show_website"=> $press_show_website,
                            "created_date"=> $created_date,
                            "image_type"=> '1'
                        );
                    $sql=DB::table('rob_documents')->insert($press_array);
                } //end foreach
            }
            else
            {
                //comment 30 May
                if($request->press_document_name_modify!=null)
                {
                    foreach($request->press_document_name_modify as $key => $press_document_name)
                    {
                        $document_modify=$request->press_document_name_modify[$key] ?? '';
                        $caption_name=$request->press_caption_name_modify[$key] ?? '';
                        $show_website=$request->press_show_website_modify[$key] ?? '0';

                       $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                        if (empty($pk_document_id))
                        {
                            // $pk_document_id = 'PKOW1';
                            $pk_document_id=1;
                        } else
                        {
                            $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                            $pk_document_id++;
                        }

                            $press_array=array(
                                "pk_document_id"=> $pk_document_id,
                                "rob_form_id"=> $request->getid,
                                "event_date"=> $event_date,
                                "document_name"=> $document_modify,
                                "caption_name"=> $caption_name,
                                "show_website"=> $show_website,
                                "created_date"=> $created_date,
                                "image_type"=> '1'
                            );
                        $sql=DB::table('rob_documents')->insert($press_array);
                    } //end foreach
                }
            }
            //press close


        }
        else
        {   //now not come in this part
            // dd('sec');
            // $rob_form_id=$request->rob_form_id;
            $created_date = date('m/d/Y');
            $table='[rob_documents]';

            //update last tab in rob_form table
            if ($request->hasFile('detail_report'))
            {
                $file = $request->file('detail_report');
                $filename2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $filename2);
            }
            else
            {
                $filename2='';
            }

            if ($request->hasFile('video'))
            {
                $file = $request->file('video');
                $video = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video);
            }
            else
            {
                $video='';
            }

            if ($request->hasFile('video2'))
            {
                $file = $request->file('video2');
                $video2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video2);
            }
            else
            {
                $video2='';
            }

            if ($request->hasFile('video3'))
            {
                $file = $request->file('video3');
                $video3 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video3);
            }
            else
            {
                $video3='';
            }

            DB::table('rob_forms')
                ->where('Pk_id',$last_ID)
                ->update([
                    "document_type"=>$request->document_type ?? '',
                    "event_date"=>$request->event_date ?? '',
                    "venue_event"=>$request->venue_event ?? '',
                    "detail_report"=>$filename2,
                    "video"=>$video,
                    "video_caption"=>$request->video_caption ?? '',
                    "video2"=>$video2,
                    "video2_caption"=>$request->video2_caption ?? '',
                    "video3"=>$video3,
                    "video3_caption"=>$request->video3_caption ?? '',
                    "status"=>1
                ]);
            DB::table("rob_documents")->where(['rob_form_id'=>$last_ID,"image_type"=>0])->delete(); //add 1 apr
            // if(count($request->document_name) > 0)
            if($request->document_name!=null)
            {
                foreach($request->document_name as $key => $document_name)
                {
                    $show_website=$request->show_website[$key] ?? '0'; //add
                    $caption_name=$request->caption_name[$key] ?? ''; //add 30 march
                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id))
                    {
                        // $pk_document_id = 'PKOW1';
                        $pk_document_id=1;
                    } else
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    if ($request->hasFile('document_name'))
                    {
                        $file = $request->file('document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }


                            $doc_array2=array(
                                "pk_document_id" => $pk_document_id,
                                "rob_form_id" => $request->getid,
                                "event_date" => $event_date,
                                "document_name" => $filename,
                                "caption_name" => $caption_name,
                                "show_website" => $show_website,
                                "created_date" => $created_date,
                                "image_type" => 0
                            );

                            $sql=DB::table('rob_documents')->insert($doc_array2);

                } //end foreach
            }//close if count



            //press

            DB::table("rob_documents")->where(['rob_form_id'=>$last_ID,"image_type"=>1])->delete(); //add 1 apr
            // if((count($request->press_document_name) > 0))
            if($request->press_document_name!=null)
            {
                foreach($request->press_document_name as $key => $press_document_name)
                {
                    $press_show_website=$request->press_show_website[$key] ?? '0';
                    $press_caption_name=$request->press_caption_name[$key] ?? '';
                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id))
                    {
                        $pk_document_id=1;
                    }
                    else
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    if ($request->hasFile('press_document_name'))
                    {
                        $file = $request->file('press_document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }

                        $pres_ary=array(
                            "pk_document_id"=>$pk_document_id,
                            "rob_form_id"=>$request->getid,
                            "event_date"=>$event_date,
                            "document_name"=>$filename,
                            "caption_name"=>$press_caption_name,
                            "show_website"=>$press_show_website,
                            "created_date"=>$created_date,
                            "image_type"=>'1'
                        );
                        $sql=DB::table('rob_documents')->insert($pres_ary);

                } //end foreach
            }//close if count
        } //end else
        }); //tansaction close
    } //robSubmit function close

    public function robSubmit(Request $request)
    {
        return DB::transaction(function () use ($request) {
        if(Session::get('UserType')==2)
        {
            $approve=1;
        }
        else
        {
            $approve=0;
        }

        $document_type=$request->document_type ?? '';
        $event_date=$request->event_date ?? '';
        $venue_event=$request->venue_event ?? '';
        $user_id=Session('UserID');



            $rob_form_id=$request->rob_form_id ?? $request->getid;
            $created_date = date('m/d/Y');
            $table='[rob_documents]';

            $existData=DB::table('rob_forms')->select('*')->where('Pk_id',$rob_form_id)->first();
            //update last tab in rob_form table

            if ($request->hasFile('detail_report'))
            {
                $file = $request->file('detail_report');
                $filename2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $filename2);
            }
            else
            {
                $filename2='';
            }

            // if ($request->hasFile('video'))
            // {
            //     $file = $request->file('video');
            //     $video = time() . '-' . $file->getClientOriginalName();
            //     $file->move('rob/', $video);
            // }
            // else
            // {
            //     $video=$existData->video;
            // }

            // if ($request->hasFile('video2'))
            // {
            //     $file = $request->file('video2');
            //     $video2 = time() . '-' . $file->getClientOriginalName();
            //     $file->move('rob/', $video2);
            // }
            // else
            // {
            //     // $video2='';
            //     $video2=$existData->video2;
            // }

            // if ($request->hasFile('video3'))
            // {
            //     $file = $request->file('video3');
            //     $video3 = time() . '-' . $file->getClientOriginalName();
            //     $file->move('rob/', $video3);
            // }
            // else
            // {
            //     $video3=$existData->video3;
            // }


            if(!empty($request->video_caption[0]) || $request->video!=null)
            {
                foreach($request->video as $key => $video )
                {
                    $caption_name=$request->video_caption[$key];
                    $show_website=$request->video_show_website[$key] ?? '0';

                    $venue_date=$request->video_date[$key] ?? '';
                    $venue_address=$request->venue_address[$key] ?? '';
                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id))
                    {
                        $pk_document_id=1;
                    } else
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }


                    if ($request->hasFile('video'))
                    {
                        $file = $request->file('video')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }
                    else
                    {
                        $filename='';
                    }
                    $video_array=array(
                            "pk_document_id" => $pk_document_id,
                            "rob_form_id" => $request->getid,
                            "event_date" => $event_date,
                            "document_name" => $filename,
                            "caption_name" => $caption_name,
                            "show_website" => $show_website,
                            "created_date" => $created_date,
                            "image_type" => 2,
                            "venue_date" => $venue_date,
                            "venue_address" => $venue_address
                        );
                    $videosql=DB::table('rob_documents')->insert($video_array);

                }
            }


            DB::table('rob_forms')
                ->where('Pk_id',$request->getid)
                ->update([
                    "document_type"=>$request->document_type ?? '',
                    "event_date"=>$request->event_date ?? '',
                    "venue_event"=>$request->venue_event ?? '',
                    "detail_report"=>$filename2,
                    // "video"=>$video,
                    // "video_caption"=>$request->video_caption ?? $existData->video_caption,
                    // "video2"=>$video2,
                    // "video2_caption"=>$request->video2_caption ?? $existData->video2_caption,
                    // "video3"=>$video3,
                    // "video3_caption"=>$request->video3_caption ?? $existData->video3_caption,
                    "status"=>2,
                    "approve" => $approve,
                    "post_venue" =>$request->post_venue
                ]);



             DB::table("rob_documents")->where(['rob_form_id'=>$rob_form_id,"image_type"=>0])->delete(); //add 1 apr
            if(!empty($request->caption_name[0]) || $request->document_name!=null)
            {
                foreach($request->document_name as $key => $document_name )
                {
                    $caption_name=$request->caption_name[$key];
                    $show_website=$request->show_website[$key] ?? '0';

                    $venue_date=$request->venue_date[$key] ?? '';
                    $venue_address=$request->venue_address[$key] ?? '';
                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id))
                    {
                        $pk_document_id=1;
                    } else
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    if ($request->hasFile('document_name'))
                    {
                        $file = $request->file('document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }
                    else
                    {
                        $filename=$document_modify;
                    }


                        $doc_array=array(
                            "pk_document_id" => $pk_document_id,
                            "rob_form_id" => $request->getid,
                            "event_date" => $event_date,
                            "document_name" => $filename,
                            "caption_name" => $caption_name,
                            "show_website" => $show_website,
                            "created_date" => $created_date,
                            "image_type" => 0,
                            "venue_date" => $venue_date,
                            "venue_address" => $venue_address
                        );
                        $sql=DB::table('rob_documents')->insert($doc_array);
                } //end foreach
            }



            //for press
            DB::table("rob_documents")->where(['rob_form_id'=>$rob_form_id,"image_type"=>1])->delete(); //add 1 apr
            if(!empty($request->press_caption_name[0]) || $request->press_document_name!=null)
            {
                // dd($request->venue_date);
                foreach($request->press_document_name as $key => $press_document_name)
                {
                    $press_caption_name=$request->press_caption_name[$key] ?? '';
                    $press_show_website=$request->press_show_website[$key] ?? '0';

                    $press_document_name_modify=$request->press_document_name_modify[$key] ?? ''; //when you not choose file
                    $press_caption_name_modify=$request->press_caption_name_modify[$key] ?? '';

                    $venue_date=$request->venue_date_pr[$key] ?? '';
                    $venue_address_pr=$request->venue_address_pr[$key] ?? '';


                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id))
                    {
                        // $pk_document_id = 'PKOW1';
                        $pk_document_id=1;
                    } else
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    if ($request->hasFile('press_document_name'))
                    {
                        $file = $request->file('press_document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }
                    else
                    {
                        $filename=$press_document_name_modify;
                    }

                        $press_array=array(
                            "pk_document_id"=> $pk_document_id,
                            "rob_form_id"=> $request->getid,
                            "event_date"=> $event_date,
                            "document_name"=> $filename,
                            "caption_name"=> $press_caption_name,
                            "show_website"=> $press_show_website,
                            "created_date"=> $created_date,
                            "image_type"=> '1',
                            "venue_date" =>$venue_date,
                            "venue_address" =>$venue_address_pr
                        );
                    $sql=DB::table('rob_documents')->insert($press_array);
                } //end foreach
            }

            //press close




        }); //tansaction close
    } //robSubmit function close



    //rob show fob post activity list
    public function rob_fob_list()  //FOB POST ACTIVITY LIST ON ROB DASHBOARD  Temp hide
    {
        $current_url = last(request()->segments());
        if($current_url == "rob-fob-list")
        {
            if(Session::get('UserID'))
            {
                $user_id=Session('UserID');
                $userName=Session('UserName');

                // $robdetail=DB::table('rob_details')->select("*")->where("RobName",$userName)->first();
                // $findFobData=DB::table('fob_details')->select('*')->where('RobId',$robdetail->RobId)->get();
                // $findFobData=DB::table('fob_details')->where('RobId',$robdetail->RobId)->pluck('FobName')->toArray();
                // $dataImport=implode(",",$findFobData);

                $fetch=DB::table('rob_forms')
                        // ->whereIn("office",[$findFobData])
                        ->where('rob_name',$userName)
                        ->where('user_type','3')
                        ->where('document_type','<>','')
                        ->orderBy('Pk_id','desc')
                        ->get();
                return view('rob.foblist',["data"=>$fetch]);
           }
           // return redirect('/rob-login');
        }
    }


    public function get_status()
    {
        $data=DB::table('rob_forms')->where('user_id',Session::get('UserID'))->orderBy('Pk_id','desc')->first();
        return $data->status;
    }


    public function fob_list()  //FOB POST FORM LIST
    {
        $current_url = last(request()->segments());
        if($current_url == "fob-list")
        {
            if(Session::get('UserID'))
            {
                $user_id=Session('UserID');
                $userName=Session('UserName');

                // $robdetail=DB::table('rob_details')->select("*")->where("RobName",$userName)->first();
                // $findFobData=DB::table('fob_details')->select('*')->where('RobId',$robdetail->RobId)->get();
                // $findFobData=DB::table('fob_details')->where('RobId',$robdetail->RobId)->pluck('FobName')->toArray();
                // $dataImport=implode(",",$findFobData);

                $fetch=DB::table('rob_forms')
                        // ->whereIn("office",[$findFobData])
                        ->where('office',$userName)
                        ->where('user_type','3')
                        ->where('document_type','<>','')
                        ->orderBy('Pk_id','desc')
                        ->get();
                return view('rob.foblist',["data"=>$fetch]);
           }
           // return redirect('/rob-login');
        }
    }




    public function pre_insert(Request $request)
    {
            $Pk_id = DB::select('select TOP 1 [Pk_id] from dbo.[rob_forms] order by [Pk_id] desc');
            if (empty($Pk_id)) {
                $Pk_id = 1;
            } else {
                $Pk_id = $Pk_id[0]->{"Pk_id"};
                $Pk_id++;
            }
            // $get_unique=DB::table('rob_forms')->select('unique_id')->orderBy('unique_id','desc')->first();
            $year=date('Y');



            //unique code start

            if(Session::get('UserType')==2)
            {
                $rob=substr(Session::get('UserName'),4,3);
                $y=substr($year,2,2);
                $month=date('m');
                $get_unique=DB::table('rob_forms')->select('unique_id')->where('unique_id','LIKE',$rob.'%')->where('office',Session::get('UserName'))->orderBy('unique_id','desc')->first();
                if(empty($get_unique))
                {
                    // $unique_id=$year.'/'.$month."/".'0001';
                    $unique_id=$rob.'/'.$month.'/'.$y.'/'.'001';
                }
                else
                {
                    // $control_no = 'TC1234/2022/0009';
                                      // 2022/06/0002
                    $unique_id = @$get_unique->unique_id;

                    $first_code=substr($unique_id,0,10);
                    // dd($unique_id);
                    $second_code=substr($unique_id,11,3) + 1;
                    $input = 1;
                    $num = str_pad($second_code, 3, "0", STR_PAD_LEFT);
                    $unique_id=$first_code.$num;
                }
                // dd($first_code);
                // dd($unique_id);

            }
            elseif(Session::get('UserType')==3)
            {


                $y=substr($year,2,2);
                $month=date('m');
                $fob=substr(Session::get('UserName'), 4,100);
                $fo=substr(Session::get('UserName'), 4,3);
                $findRobName=DB::table('rob_fob_details')->where('rob_fo',$fob)->orderBy('rob_fo','DESC')->first();
                $rob=substr($findRobName->user_name, 4,3);
                $get_unique=DB::table('rob_forms')->select('unique_id')->where('unique_id','LIKE',$rob.'%')->where('office',Session::get('UserName'))->orderBy('unique_id','desc')->first();
                if(empty($get_unique))
                {
                    // $unique_id=$year.'/'.$month."/".'0001';
                    $unique_id=$rob.'/'.$fo.'/'.$month.'/'.$y.'/'.'001';
                    // dd("if ".$unique_id);
                }
                else
                {
                    // $control_no = 'TC1234/2022/0009';
                                      // 2022/06/0002
                    $unique_id = @$get_unique->unique_id;
                    $first_code=substr($unique_id,0,14);
                    $second_code=substr($unique_id,14,3) + 1;
                    $input = 1;
                    $num = str_pad($second_code, 3, "0", STR_PAD_LEFT);
                    $unique_id=$first_code.$num;
                    // dd($unique_id);
                }

            }
            // die();
            //unique code end




            // if(empty($get_unique))
            // {
            //     $unique_id=$year.'/'.$month."/".'0001';
            // }
            // else
            // {
            //     // $control_no = 'TC1234/2022/0009';
            //                       // 2022/06/0002
            //     $unique_id = @$get_unique->unique_id;

            //     $first_code=substr($unique_id,0,8);

            //     $second_code=substr($unique_id,8,4) + 1;

            //     $input = 1;
            //     $num = str_pad($second_code, 4, "0", STR_PAD_LEFT);

            //     $unique_id=$first_code.$num;
            // }
            // dd($unique_id);
            $user_id=Session('UserID');

            $getusertype=DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->select('User Type as user_type','User Name as user_name')->where('User ID',$user_id)->first();
            $user_type=$getusertype->user_type;
            $user_name=$getusertype->user_name;


            if($user_type==2)
            {
                $getadg=DB::table('rob_adg_master')->select('*')->where('rob_name',$user_name)->first();
                $adg_name=$getadg->adg_name;
                $approve=1;
            }
            else
            {
                // $adg_name='';
                //add 23-june 2022
                // dd($request->rob_name);
                $getadg=DB::table('rob_adg_master')->select('*')->where('rob_name',$request->rob_name)->first();
                $adg_name=$getadg->adg_name;

                $approve=0;
            }
            $office_name=Session::get('UserName');

            if ($request->hasFile('pre_photo'))
            {
                $file = $request->file('pre_photo');
                $pre_photo = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $pre_photo);
            }
            else
            {
                $pre_photo='';
            }

            $rob_ary=array(
                "Pk_id"=> $Pk_id,
                "unique_id"=>$unique_id,
                "programme_activity"=> $request->programme_activity ?? '',
                "category_icop"=> $request->category_icop ?? '',
                "activity_checkbox1"=> implode(",", $request->activity_checkbox1),
                "sop_theme"=> $request->sop_theme ?? '',
                "office_type"=> $request->office_type ?? '',
                "region_id"=> $request->region_id ?? '',
                "demography"=> implode(",", $request->demography) ?? '',
                "activity_area"=> implode(",", $request->activity_area) ?? '',
                "coverage"=> $request->coverage ?? '',
                "village_name"=> $request->village_name ?? '',
                "duration_activity_from_date"=> $request->duration_activity_from_date,
                "duration_activity_to_date"=> $request->duration_activity_to_date,
                "no_of_days"=> $request->no_of_days ?? 0,
                "engagement_pre_event_activity"=> $request->engagement_pre_event_activity ?? 0,
                "engagement_txt_pre_event"=> $request->engagement_txt_pre_event ?? '',
                "nukkad_natak_pre_event_activity"=> $request->nukkad_natak_pre_event_activity ?? '0',
                "nukkad_natak_txt_pre_event"=> $request->nukkad_natak_txt_pre_event ?? '',
                "nukkad_natak1_pre_event_activity"=> $request->nukkad_natak1_pre_event_activity ?? '0',
                "nukkad_natak1_txt_pre_event"=> $request->nukkad_natak1_txt_pre_event ?? '',
                "public_meeting_pre_event_activity"=> $request->public_meeting_pre_event_activity ?? '0',
                "public_meeting_txt_pre_event"=> $request->public_meeting_txt_pre_event ?? '',
                "public_meeting1_pre_event_activity"=> $request->public_meeting1_pre_event_activity ?? '0',
                "public_meeting1_txt_pre_event"=> $request->public_meeting1_txt_pre_event ?? '',
                "public_announcement_pre_event_activity"=> $request->public_announcement_pre_event_activity ?? '0',
                "public_announcement_txt_pre_event"=> $request->public_announcement_txt_pre_event ?? '',
                "public_announcement1_pre_event_activity"=> $request->public_announcement1_pre_event_activity ?? '0',
                "public_announcement1_txt_pre_event"=> $request->public_announcement1_txt_pre_event ?? '',
                "distribution_pamphlets_pre_event_activity"=> $request->distribution_pamphlets_pre_event_activity ?? '0',
                "distribution_pamphlets_txt_pre_event"=> $request->distribution_pamphlets_txt_pre_event ?? '',
                "distribution_pamphlets1_pre_event_activity"=> $request->distribution_pamphlets1_pre_event_activity ?? '0',
                "distribution_pamphlets1_txt_pre_event"=> $request->distribution_pamphlets1_txt_pre_event ?? '',
                "social_media_pre_event_activity"=> $request->social_media_pre_event_activity ?? '0',
                "social_media_txt_pre_event"=> $request->social_media_txt_pre_event ?? '',
                "public_rally_pre_event_activity"=> $request->public_rally_pre_event_activity ?? '0',
                "public_rally_txt_pre_event"=> $request->public_rally_txt_pre_event ?? '',
                "media_briefing_pre_event_activity"=> $request->media_briefing_pre_event_activity ?? '0',
                "media_briefing_txt_pre_event"=> $request->media_briefing_txt_pre_event ?? '',
                "dd_air_curtain_pre_activity"=> $request->dd_air_curtain_pre_activity ?? '0',
                "dd_air_curtain_txt_pre_activity"=> $request->dd_air_curtain_txt_pre_activity ?? '0',
                "social_media_campaign_pre_event"=> $request->social_media_campaign_pre_event ?? '',
                "social_media_campaign_txt_pre_event"=> $request->social_media_campaign_txt_pre_event ?? '',
                "debate_seminar_symposium_main_remark"=> $request->debate_seminar_symposium_main_remark ?? '',
                "testimonials_main_no_program"=> $request->testimonials_main_no_program ?? '',
                "testimonials_main_remark"=> $request->testimonials_main_remark ?? '',
                "felicitiation_main_event"=> $request->felicitiation_main_event ?? '0',
                "felicitiation_main_no_program"=> $request->felicitiation_main_no_program ?? '',
                "felicitiation_main_remark"=> $request->felicitiation_main_remark ?? '',
                "social_media_campaign1_pre_event"=> $request->social_media_campaign1_pre_event ?? '0',
                "social_media_campaign1_txt_pre_event"=> $request->social_media_campaign1_txt_pre_event ?? '',
                "user_id"=> $user_id,
                "status"=> '1',
                "office"=>$office_name,
                "vip_name"=>$request->vip_name ?? '',
                "vip_designation"=>$request->vip_designation ?? '',
                "officer_name_person"=>$request->officer_name_person ?? '',
                "contact_no"=>$request->contact_no ?? '',
                "user_type"=>Session::get('UserType'),
                "rob_name"=>$request->rob_name,
                "form_type"=>0,
                "pre_photo"=>$pre_photo,
                "pre_show_website"=>$request->pre_show_website ?? '0',

                'venue_event'=>$request->venue_event ?? '',
                "media_coverage_txt"=>$request->media_coverage_txt ?? '',
                "email"=>$request->email ?? '',
                'event_description' => $request->event_description ?? '',
                'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                "ministry_name"=>$request->ministry_name ?? '',
                "adg_name"=>$adg_name,
                "person_designation"=>$request->person_designation ?? '',
                "system_date"=>date('Y-m-d'),
                "approve" => $approve,
                "block" => $request->block ?? '',
                "district" =>$request->district ?? '',
                "distance_covered" => $request->distance_covered ?? 0,
                "last_visit_date" =>$request->last_visit_date
            );
            // dd($rob_ary);
            $rob_update=array(
                "programme_activity"=> $request->programme_activity ?? '',
                "category_icop"=> $request->category_icop ?? '',
                "activity_checkbox1"=> implode(",", $request->activity_checkbox1),
                "sop_theme"=> $request->sop_theme ?? '',
                "office_type"=> $request->office_type ?? '',
                "region_id"=> $request->region_id ?? '',
                "demography"=> implode(",", $request->demography) ?? '',
                "activity_area"=> implode(",", $request->activity_area) ?? '',
                "coverage"=> $request->coverage ?? '',
                "village_name"=> $request->village_name ?? '',
                "duration_activity_from_date"=> $request->duration_activity_from_date,
                "duration_activity_to_date"=> $request->duration_activity_to_date,
                "no_of_days"=> $request->no_of_days ?? 0,
                "engagement_pre_event_activity"=> $request->engagement_pre_event_activity ?? 0,
                "engagement_txt_pre_event"=> $request->engagement_txt_pre_event ?? '',
                "nukkad_natak_pre_event_activity"=> $request->nukkad_natak_pre_event_activity ?? '0',
                "nukkad_natak_txt_pre_event"=> $request->nukkad_natak_txt_pre_event ?? '',
                "nukkad_natak1_pre_event_activity"=> $request->nukkad_natak1_pre_event_activity ?? '0',
                "nukkad_natak1_txt_pre_event"=> $request->nukkad_natak1_txt_pre_event ?? '',
                "public_meeting_pre_event_activity"=> $request->public_meeting_pre_event_activity ?? '0',
                "public_meeting_txt_pre_event"=> $request->public_meeting_txt_pre_event ?? '',
                "public_meeting1_pre_event_activity"=> $request->public_meeting1_pre_event_activity ?? '0',
                "public_meeting1_txt_pre_event"=> $request->public_meeting1_txt_pre_event ?? '',
                "public_announcement_pre_event_activity"=> $request->public_announcement_pre_event_activity ?? '0',
                "public_announcement_txt_pre_event"=> $request->public_announcement_txt_pre_event ?? '',
                "public_announcement1_pre_event_activity"=> $request->public_announcement1_pre_event_activity ?? '0',
                "public_announcement1_txt_pre_event"=> $request->public_announcement1_txt_pre_event ?? '',
                "distribution_pamphlets_pre_event_activity"=> $request->distribution_pamphlets_pre_event_activity ?? '0',
                "distribution_pamphlets_txt_pre_event"=> $request->distribution_pamphlets_txt_pre_event ?? '',
                "distribution_pamphlets1_pre_event_activity"=> $request->distribution_pamphlets1_pre_event_activity ?? '0',
                "distribution_pamphlets1_txt_pre_event"=> $request->distribution_pamphlets1_txt_pre_event ?? '',
                "social_media_pre_event_activity"=> $request->social_media_pre_event_activity ?? '0',
                "social_media_txt_pre_event"=> $request->social_media_txt_pre_event ?? '',
                "public_rally_pre_event_activity"=> $request->public_rally_pre_event_activity ?? '0',
                "public_rally_txt_pre_event"=> $request->public_rally_txt_pre_event ?? '',
                "media_briefing_pre_event_activity"=> $request->media_briefing_pre_event_activity ?? '0',
                "media_briefing_txt_pre_event"=> $request->media_briefing_txt_pre_event ?? '',
                "dd_air_curtain_pre_activity"=> $request->dd_air_curtain_pre_activity ?? '0',
                "dd_air_curtain_txt_pre_activity"=> $request->dd_air_curtain_txt_pre_activity ?? '0',
                "social_media_campaign_pre_event"=> $request->social_media_campaign_pre_event ?? '',
                "social_media_campaign_txt_pre_event"=> $request->social_media_campaign_txt_pre_event ?? '',
                "debate_seminar_symposium_main_remark"=> $request->debate_seminar_symposium_main_remark ?? '',
                "testimonials_main_no_program"=> $request->testimonials_main_no_program ?? '',
                "testimonials_main_remark"=> $request->testimonials_main_remark ?? '',
                "felicitiation_main_event"=> $request->felicitiation_main_event ?? '0',
                "felicitiation_main_no_program"=> $request->felicitiation_main_no_program ?? '',
                "felicitiation_main_remark"=> $request->felicitiation_main_remark ?? '',
                "social_media_campaign1_pre_event"=> $request->social_media_campaign1_pre_event ?? '0',
                "social_media_campaign1_txt_pre_event"=> $request->social_media_campaign1_txt_pre_event ?? '',
                "vip_name"=>$request->vip_name ?? '',
                "vip_designation"=>$request->vip_designation ?? '',
                "officer_name_person"=>$request->officer_name_person ?? '',
                "contact_no"=>$request->contact_no ?? '',
                "pre_photo"=>$pre_photo,
                "pre_show_website"=>$request->pre_show_website ?? '0',
                'venue_event'=>$request->venue_event ?? '',
                "media_coverage_txt"=>$request->media_coverage_txt ?? '',
                "email"=>$request->email ?? '',
                'event_description' => $request->event_description ?? '',
                'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                "ministry_name"=>$request->ministry_name ?? '',
                "person_designation"=>$request->person_designation ?? '',
                "system_date"=>date('Y-m-d'),
                "block" => $request->block ?? '',
                "district" =>$request->district ?? '',
                "distance_covered" => $request->distance_covered ?? 0,
                "last_visit_date" =>$request->last_visit_date

            );

            if(empty($request->getid))
            {
                // dd('insert');
               $sql=DB::table('rob_forms')->insert($rob_ary);
            }
            else
            {
                // dd('Update');
                $sql=DB::table('rob_forms')->where('Pk_id',$request->getid)->update($rob_update);
            }

    }


    //for pre rob list
    //URL : preroblist
    //ROB PRE LIST
    public function preroblist()
    {

        $current_url = last(request()->segments());
        if($current_url == "preroblist")
        {
            if(Session::get('UserID')){
                $user_id=Session('UserID');
                $office_name=Session::get('UserName');
                if(Session::get('UserType')==2)
                {
                    $allfob=DB::table('rob_fob_details')->where('user_name',$office_name)->get();
                }
                else
                {
                    $allfob='';
                }


                $fetch=DB::table('rob_forms')
                        // ->leftJoin('rob_documents','rob_forms.Pk_id','=','rob_documents.rob_form_id')
                        ->where('user_id',$user_id)
                        // ->where('status',1)
                        ->whereNotNull('sop_theme')
                        // ->where('form_type',0)
                        ->where('office',$office_name)
                        ->orderBy('Pk_id','desc')
                        ->get();
                return view('rob.preroblist',["data"=>$fetch,"allfob"=>$allfob]);
           }
           return redirect('/rob-login');
        }
    }

    public function robSearch(Request $request)
    {
        $year=$request->year;
        $month=$request->month;
        $fob=$request->fob;
        $office_name=Session::get('UserName');
        if($year!=null && $month!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('office',$office_name)
                          ->WhereYear('duration_activity_from_date','=',$year)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          // ->where('office','=',$fob)
                          ->get();
        }
        elseif($year!=null && $month==null)
        {
            // dd('month null');
            $data = DB::table('rob_forms')->select('*')
                          ->where('office',$office_name)
                          ->WhereYear('duration_activity_from_date','=',$year)
                          ->get();
        }
        elseif($year==null && $month!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('office',$office_name)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->get();
        }
        else
        {
            $data = [];
        }

        $html='';
        if(count($data) > 0){
            foreach ($data as $key => $item)
            {
                if($item->approve == 1)
                {
                    $status='Approve';
                }
                elseif($item->approve == 0)
                {
                    $status='Pending';
                }
                elseif($item->approve == 2)
                {
                    $status='Reject';
                }

                if($item->status==1)
                {
                    $atp='<a href="post-form/'.$item->Pk_id.'" style="text-decoration: none;color: blue;" id="view">View</a>';
                }
                elseif($item->status==2)
                {
                    $atp='<a href="post-form/'.$item->Pk_id.'" style="text-decoration: none;color: green;" id="view">Submit</a>';
                }
                else
                {
                    $atp='NA';
                }


                $sr=$key+1;
                $html.="<tr>";
                $html.="<td>".$sr."</td>";
                $html.="<td>".date("d-m-Y", strtotime($item->duration_activity_from_date))."</td>";
                $html.="<td>".'<a href="#" vill-id="'.$item->Pk_id.'" class="text-info village" id="" data-toggle="modal" data-target="#myModal2">View</a>'."</td>";
                $html.="<td>".$item->block."</td>";
                $html.="<td>".$item->district."</td>";
                $html.="<td>".$item->distance_covered."</td>";
                $html.="<td>".date('d-m-Y',strtotime($item->duration_activity_from_date))."</td>";
                $html.="<td>".$item->contact_no."</td>";
                $html.="<td>".$item->sop_theme."</td>";
                $html.="<td>".$status."</td>";
                $html.="<td>".'<a href="pre-active-form/'.$item->Pk_id.'" style="text-decoration: none;color: blue;" id="view">View</a>'."</td>";
                $html.="<td>".$atp."</td>";
                $html.="</tr>";
            }
        }
        else
        {
            $html.='<td colspan="15" style="background-color:#fafafa;">No Data Available</td>';
        }
        echo $html;
    }

    public function robFobSearch(Request $request)
    {
        $year=$request->year;
        $month=$request->month;
        $fob=$request->fob;
        $approve=$request->approve;
        $user_name=Session::get('UserName');

        if($year!=null && $month!=null && $fob!=null && $approve!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->whereYear('duration_activity_from_date','=',$year)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('office','=',$fob)
                          ->where('user_type','=','3')
                          ->where('approve',$approve)
                          ->get();
        }
        elseif($year!=null && $month==null && $fob==null && $approve==null)
        {

            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->whereYear('duration_activity_from_date','=',$year)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year!=null && $month!=null && $fob==null && $approve==null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->whereYear('duration_activity_from_date','=',$year)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year==null && $month==null && $fob!=null && $approve==null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->where('office','=',$fob)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year!=null && $month==null && $fob!=null && $approve==null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->whereYear('duration_activity_from_date','=',$year)
                          ->where('office','=',$fob)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year==null && $month!=null && $fob!=null && $approve==null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('office','=',$fob)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year==null && $month!=null && $fob==null && $approve==null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('user_type','=','3')
                          ->get();
        }
        //start approve
        elseif($year==null && $month==null && $fob==null && $approve!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->where('approve',$approve)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year!=null && $month==null && $fob==null && $approve!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->whereYear('duration_activity_from_date','=',$year)
                          ->where('approve',$approve)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year!=null && $month!=null && $fob==null && $approve!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->whereYear('duration_activity_from_date','=',$year)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('approve',$approve)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year==null && $month!=null && $fob==null && $approve!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('approve',$approve)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year==null && $month==null && $fob!=null && $approve!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->where('office','=',$fob)
                          ->where('approve',$approve)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year==null && $month!=null && $fob!=null && $approve!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('office','=',$fob)
                          ->where('approve',$approve)
                          ->where('user_type','=','3')
                          ->get();
        }
        else
        {
            $data = [];
        }
        $html='';
        if(count($data) > 0){
            foreach ($data as $key => $item)
            {
                $sr=$key+1;
                if($item->approve == 1)
                {
                    $status='Approved' ;
                }
                elseif($item->approve == 0)
                {
                    $status='Pending';
                }
                elseif ($item->approve == 2)
                {
                    $status='<span style="color: red;cursor: pointer" class="rejectdata" reject-id="'.$item->Pk_id.'" data-toggle="modal" data-target="#rejectmodel">Rejected</span>';
                }


                if($item->approve == 1)
                {
                    $icon='<a href="#" data-toggle="modal" data-id="'.$item->Pk_id.'"  id="reject" data-target="#reject_modal" title="Reject" style="color:red"><i class="fa fa-times" aria-hidden="true"></i></a>';
                }
                elseif($item->approve == 0)
                {
                    $icon='<a href="approve-rejected/1/'.$item->Pk_id.'"  title="Approve" style="color:green"><i class="fa fa-check" aria-hidden="true"></i></a>
                    &nbsp;
                    <a href="#" data-toggle="modal" data-id="'.$item->Pk_id.'" id="reject" data-target="#reject_modal" title="Reject" style="color:red"><i class="fa fa-times" aria-hidden="true"></i></a>';
                }
                else
                {
                    $icon='<a href="approve-rejected/1/'.$item->Pk_id.'"  title="Approve" style="color:green"><i class="fa fa-check" aria-hidden="true"></i></a>';
                }

                $html.="<tr>";
                $html.="<td>".$sr."</td>";
                $html.="<td>".$item->unique_id."</td>";
                $html.="<td>".date("d-m-Y", strtotime($item->duration_activity_from_date))."</td>";
                $html.="<td>".$item->office."</td>";
                $html.="<td>".'<a href="#" vill-id="'.$item->Pk_id.'" class="text-info village" id="" data-toggle="modal" data-target="#myModal2">View</a>'."</td>";
                $html.="<td>".$item->block."</td>";
                $html.="<td>".$item->district."</td>";
                $html.="<td>".$item->distance_covered."</td>";
                $html.="<td>".date('d-m-Y',strtotime($item->duration_activity_from_date))."</td>";
                $html.="<td>".$item->contact_no."</td>";
                $html.="<td>".$item->sop_theme."</td>";
                $html.="<td>".$status."</td>";
                $html.="<td>".$icon."</td>";

                $html.="<td>".'<a href="rob-approve-pre-active/'.$item->Pk_id.'" style="text-decoration: none;color: blue;" id="view"><i class="fa fa-eye" style="font-size:20px;color:blue"></i></a>'."</td>";
                $html.="<td>".'<a href="post-form/'.$item->Pk_id.'" style="text-decoration: none;color: blue;" id="view">View</a>'."</td>";
                $html.="</tr>";
            }
        }
        else
        {
            $html.='<td colspan="15" style="background-color:#fafafa;">No Data Available</td>';
        }
        echo $html;
    }

    //firler of approve list
    public function robFobSearchApprove(Request $request)
    {
        $year=$request->year;
        $month=$request->month;
        $fob=$request->fob;
        $approve=$request->approve;
        $user_name=Session::get('UserName');
        
        if($year!=null && $month!=null && $fob!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->whereYear('duration_activity_from_date','=',$year)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('office','=',$fob)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year!=null && $month==null && $fob==null)
        {

            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->whereYear('duration_activity_from_date','=',$year)
                          ->where('user_type','=','3')                     
                          ->get();
        }
        elseif($year!=null && $month!=null && $fob==null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->whereYear('duration_activity_from_date','=',$year)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year==null && $month==null && $fob!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->where('office','=',$fob)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year!=null && $month==null && $fob!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->whereYear('duration_activity_from_date','=',$year)
                          ->where('office','=',$fob)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year==null && $month!=null && $fob!=null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('office','=',$fob)
                          ->where('user_type','=','3')
                          ->get();
        }
        elseif($year==null && $month!=null && $fob==null)
        {
            $data = DB::table('rob_forms')->select('*')
                          ->where('rob_name',$user_name)
                          ->WhereMonth('duration_activity_from_date','=',$month)
                          ->where('user_type','=','3')
                          ->get();
        }
        else
        {
            $data = [];
        }
        $html='';
        if(count($data) > 0){
            foreach ($data as $key => $item) 
            {
                $sr=$key+1;
                if($item->approve == 1)
                {
                    $status='Approved' ;   
                }
                elseif($item->approve == 0)
                {
                    $status='Pending';
                }
                elseif ($item->approve == 2) 
                {
                    $status='<span style="color: red;cursor: pointer" class="rejectdata" reject-id="'.$item->Pk_id.'" data-toggle="modal" data-target="#rejectmodel">Rejected</span>';
                }


                if($item->approve == 1)
                {
                    $icon='<a href="#" data-toggle="modal" data-id="'.$item->Pk_id.'"  id="reject" data-target="#reject_modal" title="Reject" style="color:red"><i class="fa fa-times" aria-hidden="true"></i></a>';
                }
                elseif($item->approve == 0)
                {   
                    $icon='<a href="approve-rejected/1/'.$item->Pk_id.'"  title="Approve" style="color:green"><i class="fa fa-check" aria-hidden="true"></i></a>
                    &nbsp;
                    <a href="#" data-toggle="modal" data-id="'.$item->Pk_id.'" id="reject" data-target="#reject_modal" title="Reject" style="color:red"><i class="fa fa-times" aria-hidden="true"></i></a>';
                }
                else
                {   
                    $icon='<a href="approve-rejected/1/'.$item->Pk_id.'"  title="Approve" style="color:green"><i class="fa fa-check" aria-hidden="true"></i></a>';
                }

                $html.="<tr>";
                $html.="<td>".$sr."</td>";
                $html.="<td>".$item->unique_id."</td>";
                $html.="<td>".date("d-m-Y", strtotime($item->duration_activity_from_date))."</td>";
                $html.="<td>".$item->office."</td>";
                $html.="<td>".'<a href="#" vill-id="'.$item->Pk_id.'" class="text-info village" id="" data-toggle="modal" data-target="#myModal2">View</a>'."</td>";
                $html.="<td>".$item->block."</td>";
                $html.="<td>".$item->district."</td>";
                $html.="<td>".$item->distance_covered."</td>";
                $html.="<td>".date('d-m-Y',strtotime($item->duration_activity_from_date))."</td>";
                $html.="<td>".$item->contact_no."</td>";
                $html.="<td>".$item->sop_theme."</td>";
                $html.="<td>".$status."</td>";
                $html.="<td>".$icon."</td>";

                $html.="<td>".'<a href="rob-approve-pre-active/'.$item->Pk_id.'" style="text-decoration: none;color: blue;" id="view"><i class="fa fa-eye" style="font-size:20px;color:blue"></i></a>'."</td>";
                $html.="<td>".'<a href="post-form/'.$item->Pk_id.'" style="text-decoration: none;color: blue;" id="view">View</a>'."</td>";
                $html.="</tr>";
            }
        }
        else
        {
            $html.='<td colspan="15" style="background-color:#fafafa;">No Data Available</td>';
        }
        echo $html;
    }

    //multi approve
    public function multiApprove(Request $request)
    {
        $id=$request->id;
        $str=implode(",", $id);
        $ary=explode(",", $str);

        // ->whereIn("office",[$findFobData])
        $getemail=DB::table('rob_forms')->select('email')->whereIn("Pk_id",$ary)->get();

        $data=DB::table('rob_forms')->whereIn("Pk_id",$ary)->update([
            "approve" => 1
        ]);
        $mailarray=[];
        foreach($getemail as $value)
        {
            $mailarray[]=$value->email;
        }

        foreach($mailarray as $key => $list)
        {
            $dat=["message"=>"testing","text"=>"approved","reject_reason"=>request()->reject_reason ?? ''];
            $user['to']=$list;
            Mail::send('rob.mail',$dat,function($msg) use($user){
                $msg->to($user['to']);
                $msg->subject('Approved Request');
            });
        }
        Session::put('mail','Selected request(s) have been approved');

        return response()->json(["Approved success"]);
    }




    //when you click view button of pre form
    //pre-active-form
    public function pre_active_form($id='')
    {
        if(Session::get('UserID'))
        {
            if(!empty($id))
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }

                //for demography (Target Area description)  9-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();

                //31 march end

                // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); 31 march
                // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

                $data=DB::table('rob_forms')->where('Pk_id',$id)->first();
                $download_dispaly='';
                // return $list;
                // return view('rob.dataform',["data"=>$data,"special_data"=>$list]);
                return view('rob.pre-activity-form',compact('data','offTyp','offRegion','ministry_data','demographys','area_data','download_dispaly'));
            }
            else
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                //for demography (Target Area description)  9-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                // dd($demographys);
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }
                $download_dispaly='none';
                return view('rob.pre-activity-form',compact('offTyp','offRegion','ministry_data','demographys','area_data','download_dispaly'));
            }
        }
    }

    //pre-post both form show
    //post-form
    public function post_form_show($id='')
    {
        if(Session::get('UserID'))
        {
            if(!empty($id))
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                elseif($usertype=='3')
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }
                elseif($usertype=='5')
                {
                    $robdetail=DB::table('rob_adg_master')->select('*')->where('adg_name',$userName)->orderBy('adg_name','desc')->first();
                    $robname=$robdetail->rob_name;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }

                //for demography (Target Area description)  9-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();

                //31 march end

                // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); 31 march
                // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

                $data=DB::table('rob_forms')->where('Pk_id',$id)->first();

                $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
                $list=[];
                foreach($sdata as $ssdata)
                {
                    $list[]=$ssdata->special_area;
                }

                @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
                @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
                @$video=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>2])->get();
                @$govts=DB::table('rob_government_benefits')->where('form_id',$id)->get();

                // return $list;
                // return view('rob.dataform',["data"=>$data,"special_data"=>$list]);
                // return view('rob.pre-activity-form',compact('data','offTyp','offRegion','ministry_data','demographys','area_data'));
                return view('rob.rob-firstForm',compact('data','offTyp','offRegion','ministry_data','demographys','area_data','list','rob_documents','press','video','govts'));
            }
            else
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                //for demography (Target Area description)  9-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }
                return view('rob.pre-activity-form',compact('offTyp','offRegion','ministry_data','demographys','area_data'));
            }
        }
    }




    public function pre_form_showpdf($id='')
    {

        if(Session::get('UserID'))
        {
            if(!empty($id))
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                elseif($usertype=='3')
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }
                elseif($usertype=='5')
                {
                    $robdetail=DB::table('rob_adg_master')->select('*')->where('adg_name',$userName)->orderBy('adg_name','desc')->first();
                    $robname=$robdetail->rob_name;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }

                //for demography (Target Area description)  9-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();

                //31 march end

                // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); 31 march
                // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                //dd($area_data);
                $data=DB::table('rob_forms')->where('Pk_id',$id)->first();

                $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
                $list=[];
                foreach($sdata as $ssdata)
                {
                    $list[]=$ssdata->special_area;
                }

                @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
                @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
                @$video=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>2])->get();
                @$govts=DB::table('rob_government_benefits')->where('form_id',$id)->get();

                $pdf = PDF::loadView('rob.pre_activity_form_pdf',compact('data','offTyp','offRegion','ministry_data','demographys','area_data','list','rob_documents','press','video','govts'));
                return $pdf->download($id . '.pdf');
            }
            else
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                //for demography (Target Area description)  9-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }
                $pdf = PDF::loadView('rob.pre_activity_form_pdf',compact('offTyp','offRegion','ministry_data','demographys','area_data'));
                return $pdf->download($id . '.pdf');

            }
        }
    }

/* Download Fob TTP PDF for Rob Approve Pre Active User Type 4 */

public function fob_TTP_form_showpdf($id='')
    {
        if(Session::get('UserID'))
        {
            if(!empty($id))
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');
                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                elseif($usertype=='3')
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }
                elseif($usertype=='5')
                {
                    $robdetail=DB::table('rob_adg_master')->select('*')->where('adg_name',$userName)->orderBy('adg_name','desc')->first();
                    $robname=$robdetail->rob_name;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }

                //for demography (Target Area description)  9-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();

                //31 march end

                // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); 31 march
                // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                //dd($area_data);
                $data=DB::table('rob_forms')->where('Pk_id',$id)->first();

                $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
                $list=[];
                foreach($sdata as $ssdata)
                {
                    $list[]=$ssdata->special_area;
                }

                @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
                @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
                @$video=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>2])->get();
                @$govts=DB::table('rob_government_benefits')->where('form_id',$id)->get();
                // dd($data);
                $pdf = PDF::loadView('rob.fob_activity_form_pdf',compact('data','offTyp','offRegion','ministry_data','demographys','area_data','list','rob_documents','press','video','govts'));
                return $pdf->download($id . '.pdf');
            }
            else
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                //for demography (Target Area description)  9-june 2022
                $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
                //area activity master table
                $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();
                if($usertype=='2')
                {
                    // dd($user_type);
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;

                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }
                $pdf = PDF::loadView('rob.fob_activity_form_pdf',compact('offTyp','offRegion','ministry_data','demographys','area_data'));
                return $pdf->download($id . '.pdf');
            }
        }
    }


    //fetch village
    public function findvillage(Request $request)
    {
        $id=$request->id;
        $data=DB::table('rob_forms')->select('village_name')->where('Pk_id',$id)->first();
        return $data->village_name;
    }


    //get Ministries Name
    public function getministries()
    {
        $data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
        $html="<option>Select Ministry Name</option>";
        foreach($data as $ministries)
        {
            $html.= "<option>".$ministries->ministry_name."</option>";
        }
        echo $html;
    }



    //for ADG List  rob-adg-list
    public function rob_adg_list()
    {
        $user_id=Session('UserID');
        $getusertype=DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->select('User Type as user_type','User Name as user_name')->where('User ID',$user_id)->first();
        $user_type=$getusertype->user_type;
        $user_name=$getusertype->user_name;
        $data=DB::table('rob_forms')->select('*')->where(['adg_name'=>$user_name])->orderBy('Pk_id','desc')->get();
        return view('rob.rob_adg_list',compact('data'));
    }


    public function approve_rejected($status,$id)
    {
        $email = DB::table('rob_forms')->select('email')->where('Pk_id',$id)->first();
        // dd($email);

        $update_status =DB::table('rob_forms')
                        ->where('Pk_id',$id)
                        ->update([
                            "approve"=>$status,
                            "reject_reason" => request()->reject_reason ?? '',
                        ]);

        if($update_status)
        {
            if($status == 1)
            {
                // $mailarray=["abhatia@expediens.com","achourassia@expediens.com","ckyadav@expediens.com"];
                // foreach($mailarray as $key => $list)
                // {
                //     $dat=["message"=>"testing"];
                //     $user['to']=$list;
                //     Mail::send('rob.mail',$dat,function($msg) use($user){
                //         $msg->to($user['to']);
                //         $msg->subject('Approve');
                //     });
                // }
                $dat=["message"=>"testing","text"=>"approved","reject_reason"=>request()->reject_reason ?? ''];
                $user['to']=$email->email;
                Mail::send('rob.mail',$dat,function($msg) use($user){
                    $msg->to($user['to']);
                    $msg->subject('Approved Request');
                });

                return redirect()->back()->with("success","Status have been approved.");
            }
            else
            {
                $dat=["message"=>"testing","text"=>"reject","reject_reason"=>request()->reject_reason ?? ''];
                $user['to']=$email->email;
                Mail::send('rob.mail',$dat,function($msg) use($user){
                    $msg->to($user['to']);
                    $msg->subject('Rejected Request');
                });
                 return redirect()->back()->with("success","Status have been rejected.");
            }
        }
        else
        {
             return redirect()->back()->with("error","Please try again!");
        }

    }




    //for rob fob contact up
    public function contact_us()
    {
        $user_id=Session('UserID');
        $user_name=Session::get('UserName');
        $states=DB::table('BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c')->select('Description')->get();
        $data=DB::table('rob_contactus')->where(["user_id" => $user_id])->first(); //data show on form
        $fobs=DB::table('rob_fob_details')->where('user_name',$user_name)->get();
        $lists=DB::table('rob_contactus')->where(['rob_name'=>$user_name,"active" =>1])->orderBy('designation','ASC')->get();  //for show all list
        return view('rob.contact',compact('states','data','fobs','lists'));
    }

    public function contactsave(Request $request)
    {
        $user_id=Session('UserID');
        $usertype=Session::get('UserType');
        $user_name=Session::get('UserName');
        $today = date('Y-m-d');
        $robname=$user_name;
        if($usertype==3)
        {
            // $name=substr($user_name,4,50);
            // $find_rob_name=DB::table('rob_fob_details')->where('rob_fo',$name)->first();
            // $robname=$find_rob_name->user_name;
        }
        else
        {

            // $name=substr($user_name,4,50);
            // $data=DB::table('rob_fob_details')->select('user_name')->where('rob_fo',$name)->first();
            // $robname=$data->user_name;
            //$robname=Session::get('UserName');
        }

        if($request->usertype==2)
        {
            $owner_name=Session::get('UserName');
        }
        else
        {
            $owner_name=$request->owner_name;
        }



        // $find=DB::table('rob_contactus')->where(["user_id"=>$user_id])->first();
        // if(empty($find))
        // {
        //     $data_ary=array(
        //         "fullname"           => $request->fullname,
        //         "Headquarters"       => $request->Headquarters,
        //         "designation"        => $request->designation,
        //         "contact_no"         => $request->contact_no,
        //         "email"              => $request->email,
        //         "state_name"         => $request->state_name,
        //         "rob_fob_address"    => $request->rob_fob_address,
        //         "rob_name"           => $robname,
        //         "user_type"          => $request->usertype,//$usertype,
        //         "user_id"            => $user_id,
        //         "owner_name"         => $owner_name,//$user_name,
        //         "create_date"        =>$today,
        //     );
        //     $data=DB::table('rob_contactus')->insert($data_ary);
        //     $msg="Data has been insert success";
        // }
        // else
        // {
        //     $data_ary=array(
        //         "fullname"           => $request->fullname,
        //         "Headquarters"       => $request->Headquarters,
        //         "designation"        => $request->designation,
        //         "contact_no"         => $request->contact_no,
        //         "email"              => $request->email,
        //         "state_name"         => $request->state_name,
        //         "rob_fob_address"    => $request->rob_fob_address,
        //         "rob_name"           => $robname,
        //         "user_type"          => $request->usertype,//$usertype,
        //         "user_id"            => $user_id,
        //         "owner_name"         => $owner_name,//$user_name,
        //         "update_date"        =>$today,
        //     );
        //     $data=DB::table('rob_contactus')->where(["user_id"=>$user_id])->update($data_ary);
        //     $msg="Data has been update success";
        // }
        $data_ary=array(
                "fullname"           => $request->fullname,
                "Headquarters"       => $request->Headquarters,
                "designation"        => $request->designation,
                "contact_no"         => $request->contact_no,
                "email"              => $request->email,
                "state_name"         => $request->state_name,
                "rob_fob_address"    => $request->rob_fob_address,
                "rob_name"           => $robname,
                "user_type"          => $request->usertype,//$usertype,
                "user_id"            => $user_id,
                "owner_name"         => $owner_name,//$user_name,
                "create_date"        =>$today,
            );
            $data=DB::table('rob_contactus')->insert($data_ary);
            $msg="Data has been insert success";
            return ["name"=>$user_name,"message"=>$msg];
    }

    //contact edit
    public function contactedit($id)
    {
        $user_id=Session('UserID');
        $user_name=Session::get('UserName');
        $states=DB::table('BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c')->select('Description')->get();
        $fobs=DB::table('rob_fob_details')->where('user_name',$user_name)->get();
        $data=DB::table('rob_contactus')->where('id',$id)->first();
        return view('rob.contact-edit',compact('data','fobs','states'));
    }
    //contact update
    public function contactupdate(Request $request)
    {
        $id=$request->getid;
        $today = date('Y-m-d');
        DB::table('rob_contactus')->where('id',$id)->update([
            "fullname"           => $request->fullname,
            "Headquarters"       => $request->Headquarters,
            "designation"        => $request->designation,
            "contact_no"         => $request->contact_no,
            "email"              => $request->email,
            "state_name"         => $request->state_name,
            "rob_fob_address"    => $request->rob_fob_address,
            "update_date"        =>$today
        ]);
        return redirect()->route('contactus');
    }
    //contact delete
    public function contactdelete(Request $request)
    {
        $id=$request->id;
        // dd($id);
        $today = date('Y-m-d');
        $data=DB::table('rob_contactus')->where('id',$id)->update([
            "active" => 0,
            "delete_date"=>$today
        ]);
        return redirect()->route('contactus');
    }



    //for banner
    public function banner()
    {
        $data=DB::table('rob_banner')->where(["user_id"=>Session('UserID'),"active"=>1])->orderBy('id','desc')->get();
        return view('rob.banner-image',compact('data'));
    }

    public function bannersave(Request $request)
    {
        $user_id=Session('UserID');
        $usertype=Session::get('UserType');
        $user_name=Session::get('UserName');
        $today = date('Y-m-d');
        if($request->banner_name[0]!=null || $request->banner_name[0]!='null')
        {
            foreach($request->banner_name as $key => $value)
            {
                if ($request->hasFile('banner_name'))
                {
                    $file = $request->file('banner_name')[$key];
                    $banner_name = time() . '-' . $file->getClientOriginalName();
                    $file->move('rob/', $banner_name);
                }
                // else
                // {
                //     $banner_name='';
                // }
                $data=array(
                    "banner_name"   =>$banner_name,
                    "user_id"       =>$user_id,
                    "user_type"     =>$usertype,
                    "owner_name"    =>$user_name,
                    "create_date"   =>$today,
                    "update_date"   =>'',
                );
                DB::table('rob_banner')->insert($data);
            }
        }

        return back();

    }


    public function bannerdelete(Request $request)
    {
        $id=$request->id;
        // dd($id);
        $today = date('Y-m-d');
        $data=DB::table('rob_banner')->where('id',$id)->update([
            "active" => 0,
            "delete_date"=>$today
        ]);
        return redirect()->route('banner');
    }

    public function banneredit($id)
    {
        $data=DB::table('rob_banner')->where('id',$id)->first();
        return view('rob.banneredit',compact('data'));
    }


    public function bannerupdate(Request $request)
    {
        $id=$request->getid;
        if ($request->hasFile('banner_name'))
        {
            $file = $request->file('banner_name');
            $banner_name = time() . '-' . $file->getClientOriginalName();
            $file->move('rob/', $banner_name);
        }

        $data=DB::table('rob_banner')->where("id",$id)->update([
            "banner_name" =>$banner_name,
            "update_date"=>date('Y-m-d')
        ]);
        Session::flash('update','Banner update success');
        return redirect()->route('banner');
    }






    //adg list view record
    public function adg_pre_active_form_show($id='')
    {
        if(Session::get('UserID'))
        {
            if(!empty($id))
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();

                $findrob=DB::table('rob_adg_master')->where('adg_name',$userName)->first();
                $rob_name=@$findrob->rob_name;

                $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                $offRegion=DB::table('rob_fob_details')->where('user_name',$rob_name)->get();

                $data=DB::table('rob_forms')->where('Pk_id',$id)->first();
                return view('rob.adgpreactivityshow',compact('data','offTyp','offRegion','ministry_data'));
            }
            else
            {
                // return "/adglistview";
            }

        }
    }


    //adg pre form update
    public function pre_update(Request $request)
    {
            // $Pk_id = DB::select('select TOP 1 [Pk_id] from dbo.[rob_forms] order by [Pk_id] desc');
            // if (empty($Pk_id)) {
            //     $Pk_id = 1;
            // } else {
            //     $Pk_id = $Pk_id[0]->{"Pk_id"};
            //     $Pk_id++;
            // }
            $id=$request->getid;
            $user_id=Session('UserID');

            $getusertype=DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->select('User Type as user_type','User Name as user_name')->where('User ID',$user_id)->first();
            $user_type=$getusertype->user_type;
            $user_name=$getusertype->user_name;



            $office_name=Session::get('UserName');

            if ($request->hasFile('pre_photo'))
            {
                $file = $request->file('pre_photo');
                $pre_photo = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $pre_photo);
            }
            else
            {
                $data=DB::table('rob_forms')->select('pre_photo')->where('Pk_id',$id)->first();
                $pre_photo=$data->pre_photo;
            }


            $rob_ary=array(
                "programme_activity"=> $request->programme_activity ?? '',
                "category_icop"=> $request->category_icop ?? '',
                "activity_checkbox1"=> implode(",", $request->activity_checkbox1),
                "sop_theme"=> $request->sop_theme ?? '',
                "office_type"=> $request->office_type ?? '',
                "region_id"=> $request->region_id ?? '',
                "demography"=> $request->demography ?? '',
                "activity_area"=> $request->activity_area ?? '',
                "coverage"=> $request->coverage ?? '',
                "village_name"=> $request->village_name ?? '',
                "duration_activity_from_date"=> $request->duration_activity_from_date,
                "duration_activity_to_date"=> $request->duration_activity_to_date,
                "no_of_days"=> $request->no_of_days ?? 0,
                "engagement_pre_event_activity"=> $request->engagement_pre_event_activity ?? 0,
                "engagement_txt_pre_event"=> $request->engagement_txt_pre_event ?? '',
                "nukkad_natak_pre_event_activity"=> $request->nukkad_natak_pre_event_activity ?? '0',
                "nukkad_natak_txt_pre_event"=> $request->nukkad_natak_txt_pre_event ?? '',
                "nukkad_natak1_pre_event_activity"=> $request->nukkad_natak1_pre_event_activity ?? '0',
                "nukkad_natak1_txt_pre_event"=> $request->nukkad_natak1_txt_pre_event ?? '',
                "public_meeting_pre_event_activity"=> $request->public_meeting_pre_event_activity ?? '0',
                "public_meeting_txt_pre_event"=> $request->public_meeting_txt_pre_event ?? '',
                "public_meeting1_pre_event_activity"=> $request->public_meeting1_pre_event_activity ?? '0',
                "public_meeting1_txt_pre_event"=> $request->public_meeting1_txt_pre_event ?? '',
                "public_announcement_pre_event_activity"=> $request->public_announcement_pre_event_activity ?? '0',
                "public_announcement_txt_pre_event"=> $request->public_announcement_txt_pre_event ?? '',
                "public_announcement1_pre_event_activity"=> $request->public_announcement1_pre_event_activity ?? '0',
                "public_announcement1_txt_pre_event"=> $request->public_announcement1_txt_pre_event ?? '',
                "distribution_pamphlets_pre_event_activity"=> $request->distribution_pamphlets_pre_event_activity ?? '0',
                "distribution_pamphlets_txt_pre_event"=> $request->distribution_pamphlets_txt_pre_event ?? '',
                "distribution_pamphlets1_pre_event_activity"=> $request->distribution_pamphlets1_pre_event_activity ?? '0',
                "distribution_pamphlets1_txt_pre_event"=> $request->distribution_pamphlets1_txt_pre_event ?? '',
                "social_media_pre_event_activity"=> $request->social_media_pre_event_activity ?? '0',
                "social_media_txt_pre_event"=> $request->social_media_txt_pre_event ?? '',
                "public_rally_pre_event_activity"=> $request->public_rally_pre_event_activity ?? '0',
                "public_rally_txt_pre_event"=> $request->public_rally_txt_pre_event ?? '',
                "media_briefing_pre_event_activity"=> $request->media_briefing_pre_event_activity ?? '0',
                "media_briefing_txt_pre_event"=> $request->media_briefing_txt_pre_event ?? '',
                "dd_air_curtain_pre_activity"=> $request->dd_air_curtain_pre_activity ?? '0',
                "dd_air_curtain_txt_pre_activity"=> $request->dd_air_curtain_txt_pre_activity ?? '0',
                "social_media_campaign_pre_event"=> $request->social_media_campaign_pre_event ?? '',
                "social_media_campaign_txt_pre_event"=> $request->social_media_campaign_txt_pre_event ?? '',
                "debate_seminar_symposium_main_remark"=> $request->debate_seminar_symposium_main_remark ?? '',
                "testimonials_main_no_program"=> $request->testimonials_main_no_program ?? '',
                "testimonials_main_remark"=> $request->testimonials_main_remark ?? '',
                "felicitiation_main_event"=> $request->felicitiation_main_event ?? '0',
                "felicitiation_main_no_program"=> $request->felicitiation_main_no_program ?? '',
                "felicitiation_main_remark"=> $request->felicitiation_main_remark ?? '',
                "social_media_campaign1_pre_event"=> $request->social_media_campaign1_pre_event ?? '0',
                "social_media_campaign1_txt_pre_event"=> $request->social_media_campaign1_txt_pre_event ?? '',
                "status"=> '1',
                "vip_name"=>$request->vip_name ?? '',
                "vip_designation"=>$request->vip_designation ?? '',
                "officer_name_person"=>$request->officer_name_person ?? '',
                "contact_no"=>$request->contact_no ?? '',
                "pre_photo"=>$pre_photo,
                "pre_show_website"=>$request->pre_show_website ?? '0',

                'venue_event'=>$request->venue_event ?? '',
                "media_coverage_txt"=>$request->media_coverage_txt ?? '',
                "email"=>$request->email ?? '',
                'event_description' => $request->event_description ?? '',
                'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                "ministry_name"=>$request->ministry_name ?? '',
                "person_designation"=>$request->person_designation ?? '',
                "system_date"=>date('Y-m-d')

            );
            $sql=DB::table('rob_forms')->where("Pk_id",$id)->update($rob_ary);
    }



    //fob pre form data show on rob dashboard not working
    // url : rob-show-fob-pre-data
    //FOB Pre data data list
    public function fob_pre_show_rob()
    {
        if(Session::get('UserID'))
        {
            $office_name=Session::get('UserName');
            if(Session::get('UserType')==2)
            {
                $allfob=DB::table('rob_fob_details')->where('user_name',$office_name)->get();
            }
            else
            {
                $allfob='';
            }

            $user_id=Session('UserID');
            $userName=Session('UserName');
            $data=DB::table('rob_forms')
                    ->where('rob_name',$userName)
                    ->where('user_type','3')
                    ->where('approve','!=',1)
                    ->orderBy('Pk_id','desc')
                    ->get();
            return view('rob.pre_rob_fob_list',compact('data','allfob'));
       }

    }


    //show reject region
    public function findRejectRegion(Request $request)
    {
        $id=$request->id;
        $data=DB::table('rob_forms')->where('Pk_id',$id)->first();
        return $data->reject_reason;
    }


    //approve list
    //approvelist
    public function approvelist()
    {
        if(Session::get('UserID'))
        {
            $office_name=Session::get('UserName');
            if(Session::get('UserType')==2)
            {
                $allfob=DB::table('rob_fob_details')->where('user_name',$office_name)->get();
            }
            else
            {
                $allfob='';
            }

            $user_id=Session('UserID');
            $userName=Session('UserName');
            $data=DB::table('rob_forms')
                    ->where('rob_name',$userName)
                    // ->where('user_type','3')
                    ->where('approve',1)
                    ->orderBy('Pk_id','desc')
                    ->get();
            return view('rob.approve',compact('data','allfob'));
       }

    }

    //rob whats new
    public function whats_new()
    {
        $user_id=Session('UserID');
        $usertype=Session::get('UserType');
        $user_name=Session::get('UserName');
        $data=DB::table('rob_whats_new')->where(['user_id'=>$user_id,'active' => 1])->orderBy('id','desc')->get();
        return view('rob.rob_whats_new',compact('data'));
    }

    function whats_new_save(Request $request)
    {
        $user_id=Session('UserID');
        $usertype=Session::get('UserType');
        $user_name=Session::get('UserName');
        $today = date('Y-m-d');

        if($usertype==2)
        {
            $rob_name=Session::get('UserName');
        }
        else
        {
            $fob=substr($user_name,4,50);
            $find_rob=DB::table('rob_fob_details')->select('user_name')->where('rob_fo',$fob)->first();
            $rob_name=$find_rob->user_name;
        }

        if ($request->hasFile('filename'))
        {
            $file = $request->file('filename');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move('rob/', $filename);
        }
        else
        {
            $filename='';
        }

        $data=array(
            "Active"          =>1,
            "description"     =>$request->description,
            "post_date"       =>$request->post_date,
            "conatct_person"  =>$request->conatct_person,
            "conatct_number"  =>$request->conatct_number,
            "created_date"    =>$today,
            "filename"        =>$filename,
            "rob_name"        =>$rob_name,
            "owner_name"      =>$user_name,
            "user_id"         =>$user_id,
            "user_type"       =>$usertype,
            "document_type"   =>$request->document_type
        );
        $save=DB::table('rob_whats_new')->insert($data);
        return back();

    }

    //whats new delete
    public function whats_new_delete(Request $request)
    {
        $id=$request->id;
        $today = date('Y-m-d');
        $data=DB::table('rob_whats_new')->where('id',$id)->update([
            "active" => 0,
            "delete_date"=>$today
        ]);
        return redirect()->route('rob_whats_new');
    }






    //rob view fob pre form before approve
    //rob-approve-pre-active
    public function rob_pre_fob_active_form_show($id)
    {
        $userName=Session::get('UserName');
        $usertype=Session::get('UserType');

        //31 march
        $usertype=Session::get('UserType');
        $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();

        $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
        $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

        //for demography (Target Area description)  9-june 2022
        $demographys=DB::table('rob_demography')->select('demography')->where('active',1)->get();
        //area activity master table
        $area_data=DB::table('rob_area_activity')->select('activity_name')->where('active',1)->get();

        //31 march end

        // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); 31 march
        // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

        $data=DB::table('rob_forms')->where('Pk_id',$id)->first();



        return view('rob.rob-approve-pre-activity',compact('data','offTyp','offRegion','ministry_data','demographys','area_data'));
    }

    //rob update fob pre form before approve
    public function rob_pre_fob_active_form_update(Request $request)
    {
        // dd('sdfd');
        $id=$request->getid;
        $user_id=Session('UserID');
        $getusertype=DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->select('User Type as user_type','User Name as user_name')->where('User ID',$user_id)->first();
        $user_type=$getusertype->user_type;
        $user_name=$getusertype->user_name;



        $office_name=Session::get('UserName');

        if ($request->hasFile('pre_photo'))
        {
            $file = $request->file('pre_photo');
            $pre_photo = time() . '-' . $file->getClientOriginalName();
            $file->move('rob/', $pre_photo);
        }
        else
        {
            $data=DB::table('rob_forms')->select('pre_photo')->where('Pk_id',$id)->first();
            $pre_photo=$data->pre_photo;
        }


        $rob_ary=array(
            "programme_activity"=> $request->programme_activity ?? '',
            "category_icop"=> $request->category_icop ?? '',
            "activity_checkbox1"=> implode(",", $request->activity_checkbox1),
            "sop_theme"=> $request->sop_theme ?? '',
            "office_type"=> $request->office_type ?? '',
            "region_id"=> $request->region_id ?? '',
            "demography"=> implode(",", $request->demography) ?? '',
            "activity_area"=> implode(",", $request->activity_area) ?? '',
            "coverage"=> $request->coverage ?? '',
            "village_name"=> $request->village_name ?? '',
            "duration_activity_from_date"=> $request->duration_activity_from_date,
            "duration_activity_to_date"=> $request->duration_activity_to_date,
            "no_of_days"=> $request->no_of_days ?? 0,
            "engagement_pre_event_activity"=> $request->engagement_pre_event_activity ?? 0,
            "engagement_txt_pre_event"=> $request->engagement_txt_pre_event ?? '',
            "nukkad_natak_pre_event_activity"=> $request->nukkad_natak_pre_event_activity ?? '0',
            "nukkad_natak_txt_pre_event"=> $request->nukkad_natak_txt_pre_event ?? '',
            "nukkad_natak1_pre_event_activity"=> $request->nukkad_natak1_pre_event_activity ?? '0',
            "nukkad_natak1_txt_pre_event"=> $request->nukkad_natak1_txt_pre_event ?? '',
            "public_meeting_pre_event_activity"=> $request->public_meeting_pre_event_activity ?? '0',
            "public_meeting_txt_pre_event"=> $request->public_meeting_txt_pre_event ?? '',
            "public_meeting1_pre_event_activity"=> $request->public_meeting1_pre_event_activity ?? '0',
            "public_meeting1_txt_pre_event"=> $request->public_meeting1_txt_pre_event ?? '',
            "public_announcement_pre_event_activity"=> $request->public_announcement_pre_event_activity ?? '0',
            "public_announcement_txt_pre_event"=> $request->public_announcement_txt_pre_event ?? '',
            "public_announcement1_pre_event_activity"=> $request->public_announcement1_pre_event_activity ?? '0',
            "public_announcement1_txt_pre_event"=> $request->public_announcement1_txt_pre_event ?? '',
            "distribution_pamphlets_pre_event_activity"=> $request->distribution_pamphlets_pre_event_activity ?? '0',
            "distribution_pamphlets_txt_pre_event"=> $request->distribution_pamphlets_txt_pre_event ?? '',
            "distribution_pamphlets1_pre_event_activity"=> $request->distribution_pamphlets1_pre_event_activity ?? '0',
            "distribution_pamphlets1_txt_pre_event"=> $request->distribution_pamphlets1_txt_pre_event ?? '',
            "social_media_pre_event_activity"=> $request->social_media_pre_event_activity ?? '0',
            "social_media_txt_pre_event"=> $request->social_media_txt_pre_event ?? '',
            "public_rally_pre_event_activity"=> $request->public_rally_pre_event_activity ?? '0',
            "public_rally_txt_pre_event"=> $request->public_rally_txt_pre_event ?? '',
            "media_briefing_pre_event_activity"=> $request->media_briefing_pre_event_activity ?? '0',
            "media_briefing_txt_pre_event"=> $request->media_briefing_txt_pre_event ?? '',
            "dd_air_curtain_pre_activity"=> $request->dd_air_curtain_pre_activity ?? '0',
            "dd_air_curtain_txt_pre_activity"=> $request->dd_air_curtain_txt_pre_activity ?? '0',
            "social_media_campaign_pre_event"=> $request->social_media_campaign_pre_event ?? '',
            "social_media_campaign_txt_pre_event"=> $request->social_media_campaign_txt_pre_event ?? '',
            "debate_seminar_symposium_main_remark"=> $request->debate_seminar_symposium_main_remark ?? '',
            "testimonials_main_no_program"=> $request->testimonials_main_no_program ?? '',
            "testimonials_main_remark"=> $request->testimonials_main_remark ?? '',
            "felicitiation_main_event"=> $request->felicitiation_main_event ?? '0',
            "felicitiation_main_no_program"=> $request->felicitiation_main_no_program ?? '',
            "felicitiation_main_remark"=> $request->felicitiation_main_remark ?? '',
            "social_media_campaign1_pre_event"=> $request->social_media_campaign1_pre_event ?? '0',
            "social_media_campaign1_txt_pre_event"=> $request->social_media_campaign1_txt_pre_event ?? '',
            "status"=> '1',
            "vip_name"=>$request->vip_name ?? '',
            "vip_designation"=>$request->vip_designation ?? '',
            "officer_name_person"=>$request->officer_name_person ?? '',
            "contact_no"=>$request->contact_no ?? '',
            "pre_photo"=>$pre_photo,
            "pre_show_website"=>$request->pre_show_website ?? '0',

            'venue_event'=>$request->venue_event ?? '',
            "media_coverage_txt"=>$request->media_coverage_txt ?? '',
            "email"=>$request->email ?? '',
            'event_description' => $request->event_description ?? '',
            'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
            'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
            "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
            "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
            "ministry_name"=>$request->ministry_name ?? '',
            "person_designation"=>$request->person_designation ?? '',
            "system_date"=>date('Y-m-d')
        );
        $sql=DB::table('rob_forms')->where("Pk_id",$id)->update($rob_ary);

    }


    //fetch officer person detail
    // public function fetchOfficerDetail(Request $request)
    // {
    //     $officer_name_person=$request->name;
    //     $data=DB::table('rob_forms')->where('officer_name_person',$officer_name_person)->select('officer_name_person','person_designation','contact_no','email')->orderBy('Pk_id','desc')->first();
    //     return $data;
    // }

    public function fetchOfficerDetail(Request $request)
    {
        $officer_name_person=$request->name;
        // dd($officer_name_person);
        $data=DB::table('rob_forms')->select('officer_name_person','person_designation','contact_no','email')->where('officer_name_person',$officer_name_person)->orWhere('officer_name_person','LIKE','%'.$officer_name_person.'%')->get();
        // dd($data);
        return json_encode($data);

    }

    public function showOfficerDetail(Request $request)
    {
        $email=$request->email;
        // dd($officer_name_person);
        $data=DB::table('rob_forms')->select('officer_name_person','person_designation','contact_no','email')->where('email',$email)->first();
        // dd($data);
        return $data;

    }



    //pre list pdf download
     public function preroblistPDF($user_id)
     {
         if(Session::get('UserID')) {
             $user_id=Session('UserID');
             $office_name=Session::get('UserName');
             $fetch=DB::table('rob_forms')
                     ->where('user_id',$user_id)
                     ->where('status',1)
                     ->where('form_type',0)
                     ->where('office',$office_name)
                     ->orderBy('Pk_id','desc')
                     ->get();
        }
         $pdf = PDF::loadView('rob.preroblistpdf', compact('fetch'));
         return $pdf->download($user_id . '.pdf');
     }


    //chekbox update rob and adg
     public function showWebsite(Request $request)
     {
        $show_website=$request->id;
        $pk_document_id=$request->pk_id;
        $rob_form_id=$request->rob_id;
        $data=DB::table('rob_documents')
                ->where(["pk_document_id"=>$pk_document_id,"rob_form_id"=>$rob_form_id])
                ->update([
                   "show_website"=>$show_website
                ]);
        return "Update success";
     }



     public function demoApi()
     {
         return view('demo');
     }


     //https://www.idfy.com/cheque-ocr/
     //https://idfy.retool.com/embedded/public/4304f11a-f289-4682-afb1-94803ea7fcb2
     public function demosave(Request $request)
     {
        if ($request->hasFile('pic'))
        {
            $file = $request->file('pic');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path=$file->move('rob/', $filename);
            $logo = file_get_contents($path);
            $base64 = base64_encode($logo);
        }
       
        // <img src="data:image/png;base64,iVBORw0KGgoAAA
        // ANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4
        // //8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU
        // 5ErkJggg==" alt="Red dot" />
        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://cheque-india-ocr.p.rapidapi.com/v3/tasks/sync/extract/ind_cheque",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>'{
                "task_id": "74f4c926-250c-43ca-9c53-453e87ceacd1",
                "group_id": "8e16424a-58fc-4ba4-ab20-5bc8e7c3c41e",
                "data": {
                    "document1": "'.$base64.'"
                }
            }',

            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: cheque-india-ocr.p.rapidapi.com",
                "X-RapidAPI-Key: 327b2017b1msh189f15f0a899d1ep1e98c2jsn93f481fa093b",
                "content-type: application/json"
            ],

            
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
     }














    public function robcreate($user)
    {
        $table2 = '[BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2]';
        $user_id = DB::select("select TOP 1 [User ID] from $table2 order by [User ID] desc");
        $user_id=DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')
                ->select('User ID')
                ->where('User ID', 'LIKE', 'EMP'.'%')
                ->orderBy('User ID','desc')
                ->first();
        if (empty($user_id)) {
            $user_id = 'EMPOW1';
        } else {
            $user_id = $user_id->{"User ID"};
            $user_id++;
        }
        // $user_id=$user;

        $data=DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->select('User ID')->where('User ID',$user)->first();
        if($data==null || $data=='null')
        {
           DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                "User Type" => 3,
                "User ID" => $user_id,
                "User Name" => $user,
                "Gender" => 0,
                "password" => Hash::make('Cbc@123$'),
                "email" => '',
                "Mobile No_" => '',
                "Employee Code" => '',
                "Active" => 1,
                "Last Updated By" => '',
                "Last Update Date Time" => '2021-09-22 00:00:00.000',
                "OTP" => '',
                "Email Verification" => 1,
                "GST" => '',
                "Global Dimension 1 Code" => '',
                "Email OTP" => '',
                "wing type" => 0
            ]);
            return "create success";
        }
        else
        {
            return "Exist";
        }

    }
}
