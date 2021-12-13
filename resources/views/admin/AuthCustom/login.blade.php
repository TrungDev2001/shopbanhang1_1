
<!DOCTYPE html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{ asset('web/css/style.css') }}" rel='stylesheet' type='text/css' />
<link href="{{ asset('web/css/style-responsive.css') }}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{ asset('web/css/font.css') }}" type="text/css"/>
<link href="{{ asset('web/css/font-awesome.css') }}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{ asset('web/js/jquery2.0.3.min.js') }}"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Sign In Now</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <br>
            <div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
			<span><input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>Remember Me</span>

            @if (Route::has('password.request'))
			<h6><a href="{{ route('password.request') }}">Forgot Password?</a></h6>
            @endif
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="login">
            
		</form>
		<p>Don't Have an Account ?<a href="{{ route('register') }}">Create an account</a></p>
</div>
</div>
<script src="{{ asset('web/js/bootstrap.js') }}"></script>
<script src="{{ asset('web/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ asset('web/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('web/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('web/js/jquery.scrollTo.js') }}"></script>
</body>
</html>
