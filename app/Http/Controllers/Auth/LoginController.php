<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a user login.
     *
     * @return void
     */

     public function login(Request $request)
     { 
             $validations = [
                 'email' => 'required',
                 'password' => 'required',
             ];
             $message = [
                 'email.required' => 'Email field is required',
                 'password.required' => 'Password field is required'
             ];
             $validator = Validator::make($request->all(),$validations,$message);
             if($validator->fails()){
                 $response['message'] = $validator->errors($validator)->first();
                 return response()->json($response,400);
             }  
             
        $tableName = 'dbo.[BOC$UMM UserI-1]';       
        $user = DB::select("select * from $tableName  where [Email ID] = '".$request->email."' and [Password] = '".$request->password."' ");
        if(empty($user)){
            return back()->with(['status'=>1,'message'=>'Email and password does not exist']);
        }else{  
            \Session::push('user', $user[0]);            
            return redirect()->route('client-request');
        }            
        } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    { 
        $this->middleware('guest')->except('logout');
       // $request->session()->invalidate();
       // $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
