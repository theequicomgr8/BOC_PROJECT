<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Models\Ummuser;
use Hash;
use Carbon\Carbon;
use DB;
use Redirect;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use URL;

class BocUserController extends Controller
{
    use CommonTrait;
    use AuthenticatesUsers;



    public function showSigninForm()
    {

        $current_url = last(request()->segments());
        // dd(Session::get('UserID'));
        if ($current_url == "rob-login") {
            if (Session::get('UserID')) {
                return redirect('/dashboard');
            }
        }
        // if($current_url == "roblist")
        // {
        //     if(Session::get('UserID')){
        //         return redirect('/roblist');
        //    }
        //    return redirect('/rob-login');
        // }
        // if($current_url == "rob-data")
        // {
        //     if(Session::get('UserID')){
        //         return redirect('/rob-data');
        //    }
        //    return redirect('/rob-login');
        // }



        if ($current_url == "vendor-login") {
            // print_r($current_url);die;
            $curr_url = url()->current();
            $data = ['Activity_id' => '16', 'module_id' => '1', 'current_url' => $curr_url];
            //$logData=$this->saveLogs($data);
            // print_r(Session::get('UserID'));die;
            if (Session::get('UserID')) {
                return redirect('fresh-empanelment');
            }
        }
        if ($current_url == "client-login") {
            $curr_url = url()->current();
            $data = ['Activity_id' => '16', 'module_id' => '2', 'current_url' => $curr_url];
            //$logData=$this->saveLogs($data);
            if (Session::get('UserID')) {
                // return redirect('client-submission-list');
                return redirect()->intended('client-details');
            }
        }
        return view('auth.login');
    }


    public function signOut()
    {
        $userType = Session::get('UserType');
        Session::flush();
        if ($userType == 1) {
            $curr_url = url()->current();
            $data = ['Activity_id' => '14', 'module_id' => '1', 'current_url' => $curr_url];
            //$logData=$this->saveLogs($data);
            return Redirect('vendor-login');
        }
        if ($userType == 0) {
            $curr_url = url()->current();
            $data = ['Activity_id' => '14', 'module_id' => '2', 'current_url' => $curr_url];
            //$logData=$this->saveLogs($data);
            return Redirect('client-login');
        }

        if ($userType == 2) {
            $curr_url = url()->current();
            $data = ['Activity_id' => '14', 'module_id' => '2', 'current_url' => $curr_url];
            //$logData=$this->saveLogs($data);
             return Redirect('rob-login');
           // return Redirect('http://52.172.8.254:8080/wpboc/outreachactivities/custom-event-api-code/');
        }
        if ($userType == 3) {
            $curr_url = url()->current();
            $data = ['Activity_id' => '14', 'module_id' => '3', 'current_url' => $curr_url];
            //$logData=$this->saveLogs($data);
            return Redirect('rob-login');
        }

        if ($userType == 4) {
            $curr_url = url()->current();
            //$logData=$this->saveLogs($data);
            return Redirect('tam-login');
        }
        if ($userType == 5) {
            $curr_url = url()->current();
            $data = ['Activity_id' => '14', 'module_id' => '3', 'current_url' => $curr_url];
            //$logData=$this->saveLogs($data);
            return Redirect('rob-login');
        }
        if ($userType == 7) {
            $curr_url = url()->current();
            $data = ['Activity_id' => '14', 'module_id' => '3', 'current_url' => $curr_url];
            //$logData=$this->saveLogs($data);
            return Redirect('rob-login');
        }
    }


    public function createSignup(Request $request)
    {
        //Vendor login
        $userTable = 'BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2';
        if ($request->isMethod('post')) {
            $current_url = last(request()->segments());
            $user_type = 1;
            $request->validate([
                'email' => 'required|email',
            ]);

            $userType = $user_type;
            $Ummusergst = '';
            if ($request->wing_type == 0 || $request->wing_type == 1 || $request->wing_type == 2) {
                $Ummusergst = DB::table($userTable)->where('GST', $request->gst)->first();
            }
            $Ummuser = DB::table($userTable)->where('email', $request->email)->first();
            if (empty($Ummuser) && empty($Ummusergst)) {

                if ($request->wing_type == 0) {
                    $user_id = DB::table($userTable)
                    ->select('User ID')
                    ->where('User ID', 'LIKE', 'OP'.'%')
                    ->orderBy('User ID', 'desc')
                    ->first();

                    if (empty($user_id)) {
                        $user_id = 'OP0001';
                    } else {
                        $user_id = $user_id->{"User ID"};
                        $user_id++;
                    }
                } else if ($request->wing_type == 1) {

                    $user_id = DB::table($userTable)
                    ->select('User ID')
                    ->where('User ID', 'LIKE', 'PMC'.'%')
                    ->orderBy('User ID', 'desc')
                    ->first();

                    if (empty($user_id)) {
                        $user_id = 'PMC0001';
                    } else {
                        $user_id = $user_id->{"User ID"};
                        $user_id++;
                    }

                } else {

                    $user_id = DB::table($userTable)->select('User ID')
                    ->where('User ID', 'NOT LIKE', 'OP'.'%')
                    ->where('User ID', 'NOT LIKE', 'PMC'.'%')
                    ->orderBy('User ID', 'desc')
                    ->first();
                    if (empty($user_id)) {
                        $user_id = 'EMPOW1';
                    } else {
                        $user_id = $user_id->{"User ID"};
                        $user_id++;
                    }
                }
                $password = Hash::make($request['password']);
                if (is_numeric($request->email)) {
                    $email = '';
                    $usrNewsCode = $request['email'];
                } else {
                    $email = $request['email'];
                    $usrNewsCode = '';
                }

                $mytime = Carbon::now();
                $application_date = $mytime->format('Y-m-d');
                $mobileotp = $this->generateOTP();
                $emailotp = $this->generateOTP();
                $message = 'you otp is ' . $mobileotp;

                $insert_data = array(
                    "User Type" => $userType,
                    "User ID" => $user_id,
                    "User Name" => $usrNewsCode,
                    "Gender" => 0,
                    "password" => $password ?? '',
                    "email" => $email,
                    "Mobile No_" => $request->mobile ?? '',
                    "Employee Code" => '',
                    "Active" => 0,
                    "Last Updated By" => '',
                    "Last Update Date Time" => $application_date,
                    "OTP" => $mobileotp,
                    "Email Verification" => 0,
                    "GST" => $request->gst ?? '',
                    "Global Dimension 1 Code" => '',
                    "Email OTP" => $emailotp,
                    'wing type ' => $request->wing_type ?? '',
                    'Designation' =>$Designation ?? '',
                    'Address'     =>$Address ?? '',
                );
                $sql = DB::table($userTable)->insert($insert_data);
                if ($sql) {
                    $res = $this->smsSend($request->mobile, $message);
                    if ($res) {
                        Session::put('email_for_otp', $email);
                        // Send mail
                        $details['body'] = 'Your OTP is ' . $emailotp;
                        $details['subject'] = 'Send OTP';
                        $details['template'] = 'emails.vendorSendOTPMail';
                        $this->sendMailVendorSignup($details, $email);
                        Session::flash('otp_message', 'Please check email & SMS for OTP');
                        return view('auth.passwords.signup_confirm');
                    }
                } else {
                    return Redirect::back()->withErrors(['msg' => 'Some error occurred.']);
                }
            } else {
                return Redirect::back()->withErrors(['msg' => 'One of these credentials already exists']);
            }
        } else {
            return view('auth.register');
        }
    }
    public function createSignin(Request $request)
    {
        $current_url = last(request()->segments());

        if ($current_url == "vendor-login") {
            $user_type = 1;
        }
        if ($current_url == "client-login") {
            $user_type = 0;
        }
        if ($current_url == "rob-login") {
            $user_type = 2;
            // return $user_type;
            // return view()
        }
        $request->validate([
            'password' => 'required',
        ]);

        if ($current_url == "client-login") {
            $credentials = Ummuser::select(
                'User Name AS UserName',
                'password',
                'User Type As UserType',
                'User ID AS UserID',
                'Gender',
                'email',
                'Mobile No_  AS Mobile',
                'Employee Code AS EmployeeCode',
                'Active',
                'Last Updated By AS LastUpdatedBy',
                'Last Update Date Time AS LastUpdateDateTime',
                'name',
                'Address',
                'Designation'
            )
                ->where('User Name', $request->email)
                ->first();
            if ($credentials) {
                $passwordMatch = Hash::check($request->password, $credentials->password);
                if ($credentials->UserName == $request->email && $passwordMatch) {
                    $mHeadName = DB::table('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2 as MH')
                        ->select('MH.Ministries Head', 'MH.Head Name', 'MH.New Ministry Code AS ministrycode')
                        ->where('MH.Ministries Head', $credentials->UserName)->first();
                    Session::put('HeadName', $mHeadName->{'Head Name'});
                    Session::put('ministrycode', $mHeadName->ministrycode);
                    Session::put('UserID', $credentials->UserID);
                    Session::put('UserType', $credentials->UserType);
                    Session::put('UserName', $credentials->UserName);
                    Session::put('Gender', $credentials->Gender);
                    Session::put('password', $credentials->password);
                    Session::put('email', $credentials->email);
                    Session::put('Mobile', $credentials->Mobile);
                    Session::put('EmployeeCode', $credentials->EmployeeCode);
                    Session::put('Active', $credentials->Active);
                    Session::put('LastUpdatedBy', $credentials->LastUpdatedBy);
                    Session::put('LastUpdateDateTime', $credentials->LastUpdateDateTime);
                    Session::put('profile_name',$credentials->name);
                    Session::put('profile_designation',$credentials->Designation);
                    Session::put('profile_address',$credentials->Address);
                    if ($credentials->UserType == 0) {
                        $curr_url = url()->current();
                        $data = ['Activity_id' => '15', 'module_id' => '2', 'current_url' => $curr_url];
                        //$logData=$this->saveLogs($data);
                        //return redirect()->intended('client-submission-list');
                        // return redirect()->intended('client-submission-list');
                        return redirect()->intended('client-details');
                    }
                    if ($credentials->UserType == 1) {
                        $curr_url = url()->current();
                        $data = ['Activity_id' => '15', 'module_id' => '1', 'current_url' => $curr_url];
                        //$logData=$this->saveLogs($data);
                        // return redirect()->intended('client-submission-list');
                        return redirect()->intended('client-submission-list');

                    }
                } else {
                    return Redirect::back()->withErrors(['msg' => 'Please check your login credentials.']);
                }
            } else {
                $userType = $user_type;
                $ministry_code = DB::table('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2')
                    ->select('Ministries Head', 'Head Name')
                    ->where('Ministries Head', $request->email)->first();

                if ($ministry_code != '' || $ministry_code != null) {

                    $Ummuser = Ummuser::select('password')
                        ->where('User Name', $request->email)
                        ->where('Active', 1)
                        ->first();

                    if ($Ummuser == null || $Ummuser == '' || $Ummuser == NULL) {
                        $save = $this->UmmUserSave($request, $userType);
                        if ($save) {
                            return $this->createSignin($request);
                        } else {
                            return Redirect::back()->withErrors(['msg' => 'Some error occurred.']);
                        }
                    } else {

                        $credential = Hash::check($request->password, $Ummuser->password);
                        if (!$credential) {


                            return Redirect::back()->withErrors(['msg' => 'Password mismatched.']);
                        }
                    }
                } else {
                    return Redirect::back()->withErrors(['msg' => 'User name not found.']);
                }
            }
        } //Vendor login
        if ($current_url == "vendor-login") {
            //Vendor login by type
            if ($request->login_type == 2) {
                $where = array('GST' => $request->email);
            } else if ($request->login_type == 3) {
                $where = array('User ID' => $request->email);
            } else if ($request->login_type == 4) {
                $where = array('User Name' => $request->email);
            }else if ($request->login_type == 5) {
                $where = array('User Name' => $request->email);
                $request->wing_type = '6';
            }else {
                $where = array('email' => $request->email);
            }
            
            //For outdoor only
            if($request->wing == 1 && $request->login_type == 4)
            {
                $where = array('User ID' => $request->email);
            }
            
            $where['wing type '] = $request->wing_type;
            // dd($request->wing_type);
            $credentials = Ummuser::select(
                'User Name  AS UserName',
                'password',
                'email',
                'User Type As UserType',
                'User ID AS UserID',
                'Gender',
                'Mobile No_  AS Mobile',
                'Employee Code AS EmployeeCode',
                'Active',
                'Last Updated By AS LastUpdatedBy',
                'Last Update Date Time AS LastUpdateDateTime',
                'Email Verification as email_verification',
                'GST',
                'Global Dimension 1 Code',
                'wing type  as WingType'
            )->where($where)->first();
            if ($credentials) {
                $passwordMatch = Hash::check($request->password, $credentials->password);

                if (($credentials->email == $request->email && $passwordMatch) || ($credentials->UserName == $request->email && $passwordMatch) || ($credentials->GST == $request->email && $passwordMatch) || ($credentials->UserID == $request->email && $passwordMatch)) {
                    if ($credentials->email_verification == 1 && $credentials->Active == 1) {
                        $tableMainNewspaper = 'BOC$Main Newspaper Master$3f88596c-e20d-438c-a694-309eb14559b2';
                        $mainNewspaper = DB::table($tableMainNewspaper)->where('Newspaper Code',$credentials->UserName)->first();
                        $owner = DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$credentials->UserID)->first();
                        // dd($owner);
                        Session::put('id', $credentials->UserID);
                        Session::put('UserID', $credentials->UserID);
                        Session::put('UserType', $credentials->UserType);
                        Session::put('UserName', $credentials->UserName);
                        Session::put('Gender', $credentials->Gender);
                        Session::put('password', $credentials->password);
                        Session::put('email', $credentials->email);
                        Session::put('Mobile', $credentials->Mobile);
                        Session::put('EmployeeCode', $credentials->EmployeeCode);
                        Session::put('Active', $credentials->Active);
                        Session::put('LastUpdatedBy', $credentials->LastUpdatedBy);
                        Session::put('LastUpdateDateTime', $credentials->LastUpdateDateTime);
                        Session::put('Gst', $credentials->GST);
                        Session::put('WingType', $credentials->WingType);

                        if($owner)
                        {
                            if($credentials->WingType == 0)
                            {
                                $owner = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$credentials->UserID)->first();
                                Session::put('CompanyName', $owner->{'PM Agency Name'});
                            }
                        }
                        if($mainNewspaper)
                        {
                            if($credentials->WingType == 3)
                            {
                                Session::put('NewspaperName', $mainNewspaper->{'Newspaper Name'});
                                Session::put('PlacePublication', $mainNewspaper->{'Place of Publication'});
                            }
                        }
                        
                        
                        $curr_url = url()->current();
                        $data = ['Activity_id' => '15', 'module_id' => '1', 'current_url' => $curr_url];
                        $ODagencyData=[];
                        if(Session::get('WingType')==0 || Session::get('WingType')==1 || Session::get('WingType')==2)
                        {
                            //get agency code
                           $ODagencyData = DB::table('BOC$OD Agency$3f88596c-e20d-438c-a694-309eb14559b2')->select('Agency Code as AgencyCode')->where('User ID',$credentials->UserID)->where('OD Category',0)->first();
                           if(!empty($ODagencyData)){
                             Session::put('AgencyCode', $ODagencyData->AgencyCode);
                           }
                           $ODagencyName = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('PM Agency Name as AgencyName')->where('User ID',$credentials->UserID)->where('OD Category',0)->get();
                           
                           if(!empty($ODagencyName) && count($ODagencyName) > 0){
                            return redirect()->intended('outdoor-media-list');
                           }else{
                            // return redirect()->intended('company-details');
                            return redirect()->intended('outdoor-instruction');
                           }
                        }
                        else if(Session::get('WingType')==6){
                            Session::put('GroupCode', $credentials->UserName);
                            return redirect()->intended('group-account');
                        }
                        else
                        {
                            return redirect()->intended('dashboard');
                        }

                    } else {
                        Session::put('email_verified', $credentials->email_verification);
                        return Redirect::back()->withErrors(['msg' => 'Your email address not verified.']);
                    }
                } else {
                    return Redirect::back()->withErrors(['msg' => 'Please check your login credentials.']);
                }
            } else {
                $userType = $user_type;
                $Ummuser = Ummuser::select('password')->where('email', $request->email)->orWhere('User Name', $request->email)->first();
                if ($Ummuser == null || $Ummuser == '' || $Ummuser == NULL) {
                    // $save=$this->UmmUserSave($request,$userType);
                    $table2 = '[BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2]';
                    $user_id = DB::select("select TOP 1 [User ID] from $table2 order by [User ID] desc");
                    if (empty($user_id)) {
                        $user_id = 'EMPOW1';
                    } else {
                        $user_id = $user_id[0]->{"User ID"};
                        $user_id++;
                    }
                    $password = Hash::make($request['password']);
                    if (is_numeric($request->email)) {
                        $email = '';
                        $usrNewsCode = $request['email'];
                    } else {
                        $email = $request['email'];
                        $usrNewsCode = '';
                    }

                    $mytime = Carbon::now();
                    $application_date = $mytime->format('Y-m-d');
                    /// rimmi code for newspaper
                    if ($usrNewsCode != '') {
                        $userId = DB::table('BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2')->select('User ID as UserID')->where(['Newspaper Code' => $usrNewsCode])->whereIn('Status', [5, 6])->first();
                        if ($userId) {
                            $save = DB::update("update $table2 set [User Name] = '" . $usrNewsCode . "' where [User ID] = '" . $userId->UserID . "' ");
                        } else {
                            return Redirect::back()->withErrors(['msg' => 'Please check your login credentials.']);
                        }
                    } else {
                        //     $save = DB::insert("insert into $table2
                        // ([timestamp],[User Type], [User ID], [User Name], [Gender], [password], [email], [Mobile No_], [Employee Code], [Active], [Last Updated By], [Last Update Date Time],[OTP],[Email Verification]
                        // )values
                        // (DEFAULT, $userType, '" . $user_id . "', '" . $usrNewsCode . "', 0, '" . $password . "', '" . $email . "', '', '',  0, '', '" . $application_date . "','',0)");
                        return Redirect::back()->withErrors(['msg' => 'Please check your login credentials.']); //3-Feb
                    }
                    /// end rimmi code for newspaper

                    // if ($save) {
                    //     return $this->createSignin($request);
                    // } else {
                    //     return Redirect::back()->withErrors(['msg' => 'Some Error Occurred!']);
                    // }
                } else {
                    $credential = Hash::check($request->password, $Ummuser->password);
                    if (!$credential) {
                        return $this->sendFailedLoginResponse($request);
                    }
                }
            }
        }
        //vendor login end

        //rob login start
        if ($current_url == "rob-login") {
            //rob login by email
            $credentials = Ummuser::select(
                'User Name  AS UserName',
                'password',
                'email',
                'User Type As UserType',
                'User ID AS UserID',
                'Gender',
                'Mobile No_  AS Mobile',
                'Employee Code AS EmployeeCode',
                'Active',
                'Last Updated By AS LastUpdatedBy',
                'Last Update Date Time AS LastUpdateDateTime'
            )->where('email', $request->email)->orWhere('User Name', $request->email)->first();
            if ($credentials) {
                // if($credentials->email==$request->email){
                //         $res=DB::table('BOC$Vendor Emp - Print')->select('Status','User ID As usrid')->where('User ID',$credentials->UserID)->first();
                //         if($res){
                //             if($res->Status=="2"){
                //              return Redirect::back()->withErrors(['msg' => 'You can not login with email. Please enter NewsPaper code with password for login.']);
                //             }

                //         }
                //     }

                $passwordMatch = Hash::check($request->password, $credentials->password);
                if (($credentials->email == $request->email && $passwordMatch) || ($credentials->UserName == $request->email && $passwordMatch)) {
                    Session::put('id', $credentials->UserID);
                    Session::put('UserID', $credentials->UserID);
                    Session::put('UserType', $credentials->UserType);
                    Session::put('UserName', $credentials->UserName);
                    Session::put('Gender', $credentials->Gender);
                    Session::put('password', $credentials->password);
                    Session::put('email', $credentials->email);
                    Session::put('Mobile', $credentials->Mobile);
                    Session::put('EmployeeCode', $credentials->EmployeeCode);
                    Session::put('Active', $credentials->Active);
                    Session::put('LastUpdatedBy', $credentials->LastUpdatedBy);
                    Session::put('LastUpdateDateTime', $credentials->LastUpdateDateTime);
                    $curr_url = url()->current();
                    $data = ['Activity_id' => '15', 'module_id' => '1', 'current_url' => $curr_url];
                    //$logData=$this->saveLogs($data);
                    // return redirect()->intended('rob-form-one');
                    return redirect()->intended('dashboard');
                } else {
                    return Redirect::back()->withErrors(['msg' => 'Please check your login credentials.']);
                }
            } else {
                $userType = $user_type;
                $Ummuser = Ummuser::select('password')->where('email', $request->email)->orWhere('User Name', $request->email)->first();
                if ($Ummuser == null || $Ummuser == '' || $Ummuser == NULL) {
                    // $save=$this->UmmUserSave($request,$userType);
                    $table2 = '[BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2]';
                    $user_id = DB::select("select TOP 1 [User ID] from $table2 order by [User ID] desc");
                    if (empty($user_id)) {
                        $user_id = 'EMPOW1';
                    } else {
                        $user_id = $user_id[0]->{"User ID"};
                        $user_id++;
                    }
                    $password = Hash::make($request['password']);
                    // if(is_numeric($request->email)){
                    //     $email='';
                    //     $usrNewsCode=$request['email'];
                    // }else{
                    //     $email=$request['email'];
                    //     $usrNewsCode= '';
                    // }
                    $email = "";
                    $request->validate(
                        [
                            "email" => array('required', 'regex:/-/', 'alpha_dash')
                        ],
                        [
                            'email.regex' => 'Invalid User ID'
                        ]
                    );
                    $usrNewsCode = $request->email;
                    $mytime = Carbon::now();
                    $application_date = $mytime->format('Y-m-d');
                    
                    $save = DB::insert("insert into $table2
            ([timestamp],[User Type], [User ID], [User Name], [Gender], [password], [email], [Mobile No_], [Employee Code], [Active], [Last Updated By], [Last Update Date Time],[OTP],[Email Verification]
            ,[Designation],
            [Address],[name] ) values
            (DEFAULT, $userType, '" . $user_id . "', '" . $usrNewsCode . "', 0, '" . $password . "', '" . $email . "', '', '',  0, '', '" . $application_date . "','',0,'','','')");
                    if ($save) {
                        return $this->createSignin($request);
                    } else {
                        return Redirect::back()->withErrors(['msg' => 'Some error occurred.']);
                    }
                } else {
                    $credential = Hash::check($request->password, $Ummuser->password);
                    if (!$credential) {
                        return $this->sendFailedLoginResponse($request);
                    }
                }
            }
        }
        //rob login end

        /*Start Tam Login*/
        if ($current_url == "tam-login")
        {
            $credentials = Ummuser::select(
                'User Name  AS UserName',
                'password',
                'email',
                'User Type As UserType',
                'User ID AS UserID',
                'Gender',
                'Mobile No_  AS Mobile',
                'Employee Code AS EmployeeCode',
                'Active',
                'Last Updated By AS LastUpdatedBy',
                'Last Update Date Time AS LastUpdateDateTime'
            )->where('User Name', $request->email)->first();
            if($credentials)
            {
                $passwordMatch = Hash::check($request->password, $credentials->password);

                if ($credentials->UserName == $request->email && $passwordMatch)
                {
                    Session::put('id', $credentials->UserID);
                    Session::put('UserID', $credentials->UserID);
                    Session::put('UserType', $credentials->UserType);
                    Session::put('UserName', $credentials->UserName);
                    Session::put('password', $credentials->password);
                    Session::put('email', $credentials->email);
                    Session::put('Mobile', $credentials->Mobile);
                    Session::put('Active', $credentials->Active);
                    Session::put('LastUpdatedBy', $credentials->LastUpdatedBy);
                    Session::put('LastUpdateDateTime', $credentials->LastUpdateDateTime);

                    $curr_url = url()->current();
                    return redirect()->intended('dashboard');
                }
                else
                {
                    return Redirect::back()->withErrors(['msg' => 'Please check your login credentials.']);
                }
            }
        }
        /*End Tam Login*/
    }

    protected function UmmUserSave(Request $request, $userType)
    {
        $table2 = '[BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2]';
        $user_id = DB::select("select TOP 1 [User ID] from $table2 order by [User ID] desc");
        if (empty($user_id)) {
            $user_id = 'EMPOW1';
        } else {
            $user_id = $user_id[0]->{"User ID"};
            $user_id++;
        }
        $password = Hash::make($request['password']);
        $UserName = $request['email'];
        $mytime = Carbon::now();
        $application_date = $mytime->format('Y-m-d');
        $sql2 = DB::insert("insert into $table2
    (
    [timestamp],
    [User Type],
    [User ID],
    [User Name],
    [Gender],
    [password],
    [email],
    [Mobile No_],
    [Employee Code],
    [Active],
    [Last Updated By],
    [Last Update Date Time],
    [OTP],
    [Email Verification],
    [Email OTP],
    [GST],
    [Global Dimension 1 Code],
    [Designation],
    [Address],
    [name]
    )

    values
    (
    DEFAULT ,
    '" . $userType . "' ,
    '" . $user_id . "' ,
    '" . $UserName . "' ,
    0,
    '" . $password . "' ,
    '',
    '',
    '',
    1,
    '',
    '" . $application_date . "',
    '',
    0,
    '',
    '',
    '',
    '',
    '',
    ''
)");
        if ($sql2) {

            return 1;
        }
    }

    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }
    public function forgotPassword(Request $request)
    {
        if ($request->mobile == '') {
            return json_encode(array('statusCode' => 400, 'msg' => "Mobile number not valid" . $request->mobile));
        } else {
            //put in session
            $credentials = Ummuser::select(
                'User Name  AS UserName',
                'password',
                'email',
                'User Type As UserType',
                'User ID AS UserID',
                'Gender',
                'Mobile No_  AS Mobile',
                'Employee Code AS EmployeeCode',
                'Active',
                'Last Updated By AS LastUpdatedBy',
                'Last Update Date Time AS LastUpdateDateTime'
            )
                ->where('Active', 1)
                ->where('Mobile No_', $request->mobile)
                ->where('email', $request->email)->orWhere('User Name', $request->email)->first();
            $otp = '';
            if ($credentials && !empty($credentials)) {
                session(['mobile' => $request->mobile]);
                session(['username' => $request->email]);
                $mobileotp = $this->generateOTP();
                $mailotp = $this->generateOTP();
                $message = 'Your otp is ' . $mobileotp;

                $number = $request->mobile;
                $affected = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')
                    ->where('Mobile No_', $number)
                    ->where('email', $request->email)->orWhere('User Name', $request->email)
                    ->update(['OTP' => $mobileotp,'Email OTP' => $mailotp]);
                if ($affected) {
                    $res = $this->smsSend($number, $message);
                    // Send mail
                    $details['body'] = 'Your OTP is ' . $mailotp;
                    $details['subject'] = 'Send OTP';
                    $details['template'] = 'emails.vendorSendOTPMail';
                    $this->sendMailVendorSignup($details, $request->email);
                    if ($res) {
                        return json_encode(array('statusCode' => 200, 'msg' => 'OTP sent successfully '));
                    }
                }
            } else {
                return json_encode(array('statusCode' => 400, 'msg' => 'Credentials are not matched '));
            }
        }
    }
   public function submitotp()
    {
        $email_otp = trim(request('email_otp'));
        // $mobile_otp = trim(request('mobile_otp'));
        if ($email_otp == '' && $mobile_otp == '') {
            return json_encode(array('statusCode' => 400, 'msg' => "OTP not valid"));
        } else {
            $getotp = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')
                // ->where(['OTP'=> $mobile_otp,'Email OTP'=> $email_otp])->first();
                ->where(['Email OTP'=> $email_otp])->first();

            // if (!empty($getotp) && ($mobile_otp == $getotp->OTP && $email_otp == $getotp->{'Email OTP'})) {
            if (!empty($getotp) && ($email_otp == $getotp->{'Email OTP'})) {
                return json_encode(array('statusCode' => 200, 'msg' => 'Success'));
            } else {
                return json_encode(array('statusCode' => 400, 'msg' => "OTP not valid"));
            }
        }
    }
    public function resetPassword()
    {
        $npassword = trim(request('npassword'));
        $newpassword = Hash::make($npassword);
        if ($npassword == '') {
            return json_encode(array('statusCode' => 400, 'msg' => "Password not valid!"));
        } else {
            $updatepass = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')
                ->where('Mobile No_', session('mobile'))
                ->where('email', session('username'))->orWhere('User Name', session('username'))
                ->update(['password' => $newpassword, 'OTP' => '']);

            if ($updatepass) {
                Session::flush();
                return json_encode(array('statusCode' => 200, 'msg' => 'Password successfully changed.'));
            } else {
                return json_encode(array('statusCode' => 400, 'msg' => "Password not valid."));
            }
        }
    }

    public function generateOTP()
    {
        $otp = mt_rand(1000, 9999);
        return $otp;
    }

    // function emailVerify()
    // {
    //     // $email=$_REQUEST["code"];
    //     $email = hex2bin($_REQUEST["code"]);
    //     $data = DB::table('BOC$UMM User')->where('email', $email)->update([
    //         "Email Verification" => 1,
    //         "Active" => 1
    //     ]);
    //     // return redirect()->route('user.index')->with('regMsg','Please Login');
    //     return redirect('vendor-login')->with('success_message', 'Congratulation! You have successfully Email Verification Done. Please login.');
    // }

    public function signup_confirm()
    {
        return view('auth.passwords.signup_confirm');
    }

    public function signupConfirm(Request $request)
    {
        $email = $request->email;
        $email_otp = $request->email_otp;
        // $mobile_otp = $request->mobile_otp;
        // $where = array("email" => $email, "OTP" => $mobile_otp, "Email OTP" => $email_otp);
        $where = array("email" => $email,  "Email OTP" => $email_otp);
        $check = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->first();
        if ($check) {
            $data = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->where('email', $email)->update([
                "Email Verification" => 1,
                "Active" => 1
            ]);
            Session::put('temp_session', $email); //its use in set password form
            // Session::flash('otp_success','Your Account Has Been Successfully Verify');
            // return redirect('vendor-login');
            // Session::flash('set_password', 'Your account has been successfully verified.Please create your password!');
            Session::flash('email_verified', 1);
            return view('auth.passwords.set_password')->with(['status' => 1, 'set_password' => 'Your account has been successfully verified. Please create your password.']);
        } else {
            Session::flash('otp_message', 'Enter Correct OTP ');
            return view('auth.passwords.signup_confirm');
        }
    }

    public function resendotp_form()
    {
        return view('auth.passwords.resendotp_form');
    }

    public function resendotp_post(Request $request)
    {
        $email = $request->email;
        $mobile = $request->mobile;
        $where = array("email" => $email, "Mobile No_" => $mobile);
        $check = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->first();
        if (!empty($check)) {
            $mobileotp = $this->generateOTP();
            $mailotp = $this->generateOTP();
            $data = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->update([
                "OTP" => $mobileotp,
                "Email OTP" => $mailotp
            ]);
            // Send SMS
            $message = 'Your otp is ' . $mobileotp;
            $res = $this->smsSend($request->mobile, $message);

            // Send mail
            $details['body'] = 'Your OTP is ' . $mailotp;
            $details['subject'] = 'Send OTP';
            $details['template'] = 'emails.vendorSendOTPMail';
            $this->sendMailVendorSignup($details, $email);

            if ($res) {
                // Session::flash('otp_message', 'Please check sms for OTP ' . $mobileotp);
                Session::flash('otp_message', 'Please check sms for OTP ');
                return redirect()->route('signup_confirm');
                // return view('auth.passwords.signup_confirm');
            }
        } else {
            Session::flash('error_msg', 'Please check your credentials.');
            return view('auth.passwords.resendotp_form');
            // return "Not Found";
        }
    }

    public function setpassword(Request $request)
    {
        if ($request->password == $request->cnf_password) {
            $password = Hash::make($request->password);
            $email = Session::get('temp_session');
            $data = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->where('email', $email)->update([
                "password" => $password
            ]);
            if ($data) {
                $where = array("email" => $email);
                $user_data = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->first();
                // SEND sms to mobile
                $message = 'Your User ID is ' . $user_data->{'User ID'};
                $this->smsSend($user_data->{'Mobile No_'}, $message);
                // SEND mail
                $details['body'] = 'Your User ID is ';
                $details['user_id'] = $user_data->{'User ID'};
                $details['url'] = URL::to("vendor-login");
                $details['content'] = 'please login here';
                $details['subject'] = 'Signup Confirmation';
                $details['template'] = 'emails.vendorSignupMail';
                $this->sendMailVendorSignup($details, $email);
                Session::flash('otp_success', 'Your password successfully generated.');
                return redirect('vendor-login');
            }
        } else {
            //Session::flash('set_password2', 'Password Not Match!');
            return view('auth.passwords.set_password')->with(['status' => 1, 'set_password2' => 'Password mismatched.']);
        }
    }

    public function showChangePasswordGet(){
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
       $userid = Session::get('UserID');
       $get_pass = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->select('password')->where('User ID',$userid)->first();
        if (!(Hash::check($request->get('current_password'), $get_pass->{'password'}))) {
            return back()->with(['status_old_pass' => false, 'message' => 'Old Password Dose Not Matched!']);
        }
        $password = Hash::make($request->get('new_password'));
        $sql = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$userid)->update([
            "password" => $password
        ]);
        if ($sql) {
            return back()->with(['success' => true, 'message' =>  'Password successfully Changes !']);
        } else {
             return back()->with(['fail' => false, 'message' => 'Something went wrong']);
        }

    }


    // public function getROBbanner($location=''){
    //     $robdata ='';
    //     if($location !=''){
    //         $addlocation ="ROB-".$location;
    //         $robdata = DB::table('rob_banner')->select('banner_name','owner_name')->where(['active'=>1,'owner_name'=>$addlocation])->get(); 
    //     }else{
    //         $robdata = DB::table('rob_banner')->select('banner_name','owner_name')->where(['active'=>1])->get();
    //     }
    //     if(count($robdata) > 0){
    //         return response()->json(['status'=>true,'message'=>'Data retrived successfully!','robdata'=>$robdata],200);
    //     }else{
    //         return response()->json(['status'=>false,'robdata'=>'','message'=>'Data not found!'],404);
    //     }
    // }
    // public function datainsert()
    // {
    //     $table2 = '[BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2]';
    //     $user_id = DB::select("select TOP 1 [User ID] from $table2 order by [User ID] desc");

    //     if (empty($user_id)) {
    //         $user_id = 'EMPOW1';
    //     } else {
    //         $user_id = $user_id[0]->{"User ID"};
    //         $user_id++;
    //     }

    //     $res=DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
    //         "User Type"=>3,
    //         "User ID"=>$user_id,
    //         "User Name"=>'FOB-TAMENGLONG',
    //         "Gender"=>0,
    //         "password"=>Hash::make('Dav@123$'),
    //         "email"=>'',
    //         "Mobile No_"=>'',
    //         "Employee Code"=>'',
    //         "Active"=>1,
    //         "Last Updated By"=>'',
    //         "Last Update Date Time"=>'2021-09-22 00:00:00.000',
    //         "OTP"=>'',
    //         "Email Verification"=>1,
    //         "GST"=>'',
    //         "Global Dimension 1 Code"=>'',
    //         "Email OTP"=>'',
    //         "wing type"=>0
    //     ]);

    //     if($res)
    //     {
    //         echo "Insert success";
    //     }
    //     else{
    //         echo "error";
    //     }
    // }
}
