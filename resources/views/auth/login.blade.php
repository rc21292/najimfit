<!DOCTYPE html>
<html>
<head>
	<title>Login | Dashboard</title>
	@include('layouts.head')
</head>
<body class="ms-body ms-primary-theme ms-logged-out">
	<main class="body-content">
		<!-- Body Content Wrapper -->
		<div class="ms-content-wrapper ms-auth">

			<div class="ms-auth-container">
				<div class="ms-auth-col">
					<div class="ms-auth-bg"></div>
				</div>
				<div class="ms-auth-col">
					<div class="ms-auth-form">
						<form method="POST" class="needs-validation" action="{{ route('login') }}">
							@csrf
							<h1>Login to Dashboard</h1>
							<p>Please enter your email and password to continue</p>
							<div class="mb-3">
								<label for="email">{{ __('E-Mail Address') }}</label>
								<div class="input-group">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
									@error('email')
									<div class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</div>
									@enderror
								</div>
							</div>
							<div class="mb-2">
								<label for="password">{{ __('Password') }}</label>
								<div class="input-group">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
									@error('password')
									<div class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</div>
									@enderror
									<div class="invalid-feedback">
										Please provide a password.
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="ms-checkbox-wrap">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									<i class="ms-checkbox-check"></i>
								</label>
								<span> {{ __('Remember Me') }} </span>
								<label class="d-block mt-3"><a href="{{ route('password.request') }}" class="btn-link">Forgot Password?</a></label>
							</div>
							<button class="btn btn-primary mt-4 d-block w-100" type="submit">Sign In</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>
</html>