<!DOCTYPE html>
<html>
<head>
    <title>Confirm Email</title>
    @include('layouts.head')
</head>
<body class="ms-body ms-primary-theme ms-logged-out">
    <main class="body-content">
        <div class="row">      
          <div class="modal-dialog modal-dialog-centered modal-min" role="document">
            <div class="modal-content">
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="modal-body text-center">
                <a type="button" class="close" href="/"><span aria-hidden="true">&times;</span></a>
                <i class="flaticon-secure-shield d-block"></i>
                <h1>{{ __('Reset Password') }}</h1>
                <p> Enter your email to recover your password </p>
                <form method="POST" action="{{ route('password.email') }}">
                  @csrf
                  <div class="ms-form-group has-icon">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <i class="material-icons">email</i>
                    @error('email')
                    <div class="feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary shadow-none">{{ __('Send Password Reset Link') }}</button>
            </form>
        </div>

    </div>
</div>
</div>
</main>
</body>
</html>