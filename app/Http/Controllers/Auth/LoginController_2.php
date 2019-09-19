<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Rules\Captcha;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('guest')->except('logout');
    }
    public function field(Request $request){
       // dd($request);
        $email = $this->username();
        return filter_var($request->get($email),FILTER_VALIDATE_EMAIL) ? $email : 'username';
    }
    protected function validateLogin(Request $request)
    {
       // dd($request->get('g-recaptcha-response'));
        $field = $this->field($request);
        //dd($field);
        $message = [
            "{$this->username()}.exists" => 'Failed Login',
            "password.required" => "Password required",
            "g-recaptcha-response.required" => "Token is empty"
        ];
        $request->validate([
            $this->username() => "required|string|exists:users,{$field}",
            'password' => 'required|string',
           'g-recaptcha-response' => 'required|string'
        ],$message);
       //dd($message);
    }
    protected function credentials(Request $request)
    {
       
       $field = $this->field($request);
       $user = User::where($field,$request->get($this->username()))->get();
       $is_expired   = $user[0]->is_expired;
       $expired_date = $user[0]->expired_date;
       $result = false;
       if($is_expired == 1){
           
        if($expired_date > date('Y-m-d H:i:s')){
           // dd(2);
            $result  = true;
        }else{
            //dd(1);
            $result = false;
        }
       }else{
           $result = true;
       }
       if($result == true){
        $value = [
            $field => $request->get($this->username()),
            'password' => $request->get('password'),
            'status' => 1
            ];
       }else{
        $value = [
            $field => '',
            'password' => '',
            'status' => 1
            ];
       }
       
     dd($value);
        return $value; 
    }
    
}
