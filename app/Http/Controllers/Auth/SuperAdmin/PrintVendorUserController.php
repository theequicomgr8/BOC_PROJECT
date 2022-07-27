<?php

namespace App\Http\Controllers\Auth\superAdmin;

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


class PrintVendorUserController extends Controller
{
    use CommonTrait;
    use AuthenticatesUsers;

    public function LoginScreen(Request $request)
    { 
        return view('super-admin.auth.login');
    }

    public function signIn(Request $request)
    { 
        $current_url = last(request()->segments());
        
        if ($current_url == "login") {
            $user_type = 6;
        }
         /*Start Group Login*/
         if ($current_url == "login") {

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
            )->where('User ID', $request->group_id)->first();

            
            if ($credentials) {
                $passwordMatch = Hash::check($request->password, $credentials->password);
                if (($credentials->UserID == $request->group_id && $passwordMatch) ) {
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
                    return redirect()->intended('admin/dashboard');
                } else {
                    return Redirect::back()->withErrors(['msg' => 'Please check your login credentials.']);
                }
            }
        }
        /*End Group Login*/
    }

    public function dashboard ()
    {
        # code...
        if(Session::has('UserID')){
            return view('super-admin.pages.dashboard');
        }
        else{
            return view('super-admin.auth.login');
        }
       
    }

    public function logOut()
    {
          Session::flush();
            $curr_url = url()->current();
            return Redirect('admin/login');
    }
    
    public function ResetPasswordForm()
    {
        return view('super-admin.auth.set_password');
    }
    
    public function ResetPassword(Request $request){
        // dd($request);
    }


    // public function datainsert()
    // {
    //     $table2 = 'BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2';
    //     $user_id=DB::table($table2)->select('User ID')
    //                  ->where('User ID','LIKE','%'.'PMV'.'%')
    //                  ->orderBy('User ID','desc')->first();
    //     if (empty($user_id)) {
    //         $user_id = 'PMV0001';
    //     } else {
    //         $user_id = $user_id[0]->{"User ID"};
    //         $user_id++;
    //     }
        
    //     DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
    //         "User Type"=>6,
    //         "User ID"=>$user_id,
    //         "User Name"=>'PMVOA1',
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
    //         "wing type"=>3
    //     ]);
    // }

}