@extends('admin.layouts.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pr-md-0">
            <div class="auth-left-wrapper" style="background-image: url({{ asset('/assets/images/login-side.jpg') }}); background-size: cover; background-position: center;">

            </div>
          </div>
          <div class="col-md-8 pl-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              @if(session()->has('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
              @endif
              <img src="/assets/images/asaldi-cms-logo.png" alt="cms.asaldi.com" class="mb-3" style="height: 35px;">
              <h5 class="text-muted font-weight-normal mb-4">Powered By Eworde.</h5>
              <form method="POST" action="{{ route('admin.auth') }}" class="forms-sample">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">{{ __('E-Mail Address') }}</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">{{ __('Password') }}</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" name="password" autocomplete="current-password" placeholder="Password">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    {{ __('Remember Me') }}
                  </label>
                </div>
                <div class="mt-3">
                  <button class="btn btn-primary mr-2 mb-2 mb-md-0">
                    {{ __('Login') }}
                  </button>
                  {{-- @if (Route::has('password.request'))
                      <a class="btn btn-link" href="{{ route('password.request') }}">
                          {{ __('Forgot Your Password?') }}
                      </a>
                  @endif --}}
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection