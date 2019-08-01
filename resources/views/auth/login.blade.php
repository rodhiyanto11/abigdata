<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>BigData</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Big Data</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-draw/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-draw/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-draw/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-draw/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('login-draw/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-draw/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-draw/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('login-draw/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login-draw/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-draw/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
                <form method="POST" class="ogin100-form " action="{{ route('login') }}">    
					<span class="login100-form-title p-b-70">
                        Big Data <i style="font-size:15px;color:red;">Admedika</i>
                            
					</span>
					<span class="login100-form-avatar">
						<img src="{{asset('login-draw/images/avatar-01.jpg')}}" alt="AVATAR">
					</span>
                        @csrf
                        @if ($errors->has('email'))
                            <i style="font-size:15px;color:red;">{{ $errors->first('email') }}</i>
                        @endif
                        @if ($errors->has('password'))
                            <br/>
                            <i style="font-size:15px;color:red;">{{ $errors->first('password') }}</i>
                        @endif
                        @if ($errors->has('g-recapctha-response'))
                            <br/>
                            <i style="font-size:15px;color:red;">{{ $errors->first('g-recapctha-response') }}</i>
                        @endif
                        <div class="form-group row">
                             <div class="wrap-input100 m-t-85 m-b-35" >
                                <input class="input100 @error('email') is-invalid @enderror" id="email" type="text" name ="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <span class="focus-input100" data-placeholder="Username"></span>
                              
                            </div>
                            <div class="wrap-input100  m-t-30 m-b-35" >
                                <input class="input100 @error('password') is-invalid @enderror" id="password" type="password" name ="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                                <span class="focus-input100" data-placeholder="Password"></span>
                               
                            </div>
                        </div>
                      
                        <div class="row  m-t-10 m-b-35" >
                        <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}">
                         
                        </div>
                        </div>
                        <div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
                        

					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{asset('login-draw/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-draw/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-draw/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('login-draw/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-draw/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-draw/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('login-draw/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-draw/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login-draw/js/main.js')}}"></script>
    
    <script>
    $(function(){
        $('#login100-form-btn').focus();
       
    })
    </script>
</body>
</html>