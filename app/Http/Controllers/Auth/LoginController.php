<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Rules\Captcha;

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
            "{$this->username()}.exists" => 'The Account bla bla bla'
        ];
        $request->validate([
            $this->username() => "required|string|exists:users,{$field}",
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|string'
        ],$message);
    }
    protected function credentials(Request $request)
    {
        //echo "<pre>";
        //print_r($request->get('g-recaptcha-response'));
        //echo "</pre>";die();
        //return $request->only($this->username(), 'password');
        $field = $this->field($request);
        //dd($field);
        $value = [
            $field => $request->get($this->username()),
            'password' => $request->get('password'),
            

        ];
       //dd($value);
        return $value; 
    }
}
