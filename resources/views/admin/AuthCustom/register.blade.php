
<!DOCTYPE html>
<head>
<title>Register</title>
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
<div class="reg-w3">
<div class="w3layouts-main">
	<h2>Register Now</h2>
		<form method="POST" action="{{ route('register') }}">
			@csrf
			<input type="text" class="ggg @error('name') is-invalid @enderror" name="name"  placeholder="NAME" value="{{ old('name') }}" required autocomplete="name" autofocus>
			@error('name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror

			<input type="email" class="ggg @error('email') is-invalid @enderror" name="email" placeholder="E-MAIL" value="{{ old('email') }}" required autocomplete="email">
			@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror

			<div class="form-check ">
				<input class="form-check-input" name="gender" value="0" type="radio" id="flexRadioDefault1">
				<label class="form-check-label" for="flexRadioDefault1">Nam</label>
				</div>
				<div class="form-check">
				<input class="form-check-input" name="gender" value="1" type="radio" id="flexRadioDefault2" checked>
				<label class="form-check-label" for="flexRadioDefault2">Nữ</label>
			</div>

			<input type="password" class="ggg @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
			@error('password')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror

			<input id="password-confirm" type="password" class="ggg" name="password_confirmation" placeholder="Confirmation Password" required autocomplete="new-password">
			
			
			<div class="clearfix"></div>
			<input type="submit" value="submit" name="register">
		</form>
		<p>Already Registered.<a href="login.html">Login</a></p>
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
