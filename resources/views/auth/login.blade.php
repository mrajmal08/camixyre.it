@extends('layouts.master')

{{-- CSS For Specific Page --}}
@push('plugin-styles')

@endpush

<!-- Main Content Start -->
@section('content')

<!-- page title -->
<section class="page-title-inner" data-bg-img='/web-assets/img/page-titlebg.png'>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- page title inner -->
                <div class="page-title-wrap">
                    <div class="page-title-heading"><h1 class="h2">My Account<span>Profile</span></h1></div>
                    <ul class="list-unstyled mb-0">
                        <li><a href="/{{$lang}}/home">home</a></li>
                        <li><a href="/{{$lang}}/shop">Shop</a></li>
                        <li class="active"><a href="#">Login / Register</a></li>
                    </ul>
                </div>
                <!-- End of page title inner -->
            </div>
        </div>
    </div>
</section>
<!-- End of page title -->

<!-- logout register wrap -->
<section class="pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- login register -->
                <div class="login-register-wrap text-center main-log-regi">
                    <!-- login register nav -->
                    <div class="login-register-nav">
                        <nav class="nav lr-nav text-center">
                            <a id="nav-login-tab2" data-toggle="tab" href="#login2" class="active">Log In</a>
                            <a id="nav-register-tab2" data-toggle="tab" href="#reg2">Register</a>
                        </nav>
                    </div>
                    <!-- End of login register nav -->

                    <!-- login register content -->
                    <div class="login-register-content tab-content">
                        <div class="tab-pane fade show active" id="login2" role="tabpanel" aria-labelledby="nav-login-tab2">
                            <div class="primary-form parsley-validate">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <!-- loging input -->
                                    <div class="name-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/account3.svg" class="svg" alt="">
                                        </label>
                                        <input id="email" type="email" class="theme-input-style @error('email') is-invalid @enderror" name="email" placeholder="{{ __('common.email') }}*" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="password-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/regi-icon.svg" class="svg" alt="">
                                        </label>
                                        <input id="password" type="password" class="theme-input-style @error('password') is-invalid @enderror" name="password" placeholder="{{ __('common.password') }}*" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- loging input -->
                                    <button type="submit" class="btn btn-fill-type">log In</button>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="reg2" role="tabpanel" aria-labelledby="nav-register-tab2">
                            <div class="primary-form parsley-validate">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <!-- register input -->
                                    <div class="name-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/account-icon.svg" class="svg" alt="">
                                        </label>
                                        <input id="name" type="text" class="theme-input-style  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('common.name') }}*" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="email-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/email-icon.svg" class="svg" alt="">
                                        </label>
                                        <input id="email" type="email" class="theme-input-style @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('common.email') }}*" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="password-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/regi-icon.svg" class="svg" alt="">
                                        </label>
                                        <input id="password" type="password" class="theme-input-style @error('password') is-invalid @enderror" name="password" placeholder="{{ __('common.password') }}*" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="password-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/regi-icon.svg" class="svg" alt="">
                                        </label>
                                        <input id="password-confirm" type="password" class="theme-input-style" name="password_confirmation" placeholder="{{ __('common.confirm_password') }}*" required autocomplete="new-password">
                                    </div>
                                    <!-- register input -->
                                    <button type="submit" class="btn btn-fill-type">{{ __('common.register') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of login register content -->
                </div>
                <!-- End of login register -->
            </div>
        </div>
    </div>
</section>
<!-- End of logout register wrap -->

@endsection
