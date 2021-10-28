@extends('layouts.master')

{{-- CSS For Specific Page --}}
@push('plugin-styles')
    <link href="{{ asset('web-assets/css/starrr.css') }}" rel="stylesheet" />
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
                        <li class="active"><a href="#">My Account</a></li>
                    </ul>
                </div>
                <!-- End of page title inner -->
            </div>
        </div>
    </div>
</section>
<!-- End of page title -->

<!-- logout register wrap -->
<section class="pt-30 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <!-- dash board nav-->
                <div class="dashboard-inner">
                    <nav>
                        <ul class="nav-list nav">
                            <li>
                                <a class="dashboard-nav-item active" id='nav-adetails' href="/{{ $lang }}/dashboard/profile"><span><img src="/web-assets/img/icons/account3.svg" class="svg" alt=""></span>Account Details</a>
                            </li>
                            <li>
                                <a class="dashboard-nav-item" id="nav-order" href="/{{ $lang }}/dashboard/orders"><span><img src="/web-assets/img/icons/order.svg" class="svg" alt=""></span>Orders</a>
                            </li>
                            <li>
                                <a class="dashboard-nav-item" href="{{ route('logout.user', $lang) }}"><span><img src="/web-assets/img/icons/logout.svg" class="svg" alt=""></span>Log Out</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- End of dash board nav-->
            </div>
            <div class="col-lg-9">
                <!-- dashboard content -->
                <div class="deshboard-content-wrap">
                    <div class="tab-content dashboad-tab-content">
                        <div class="tab-pane fade show active" id="adetails" role="tabpanel" aria-labelledby='nav-adetails'>
                            <!-- Account details-->
                            <div class="account-details billing-details">
                                <form method="POST" action="{{ route('profile.update', $lang) }}">
                                    @csrf
                                    <div>
                                        <span class="woocommerce-input-wrapper">
                                            <input class="theme-input-style" type="text" name="name" placeholder="Name" value="{{ $profile->name }}">
                                        </span>
                                        <span class="woocommerce-input-wrapper">
                                            <input type="text" class="theme-input-style" name="email" value="{{ $profile->email }}" placeholder="{{ __('common.email') }}" disabled>
                                        </span>
                                        <div>
                                            <button type="submit" class="billing-submit-button btn btn-fill-type mb-40">{{ __('common.update_profile') }}</button>
                                        </div>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('change.password', $lang) }}">
                                    @csrf
                                    <div>
                                        <span class="woocommerce-input-wrapper">
                                            <input id="password" type="password" class="theme-input-style" name="current_password" autocomplete="current-password" placeholder="{{ __('common.current_password') }}">
                                        </span>
                                        <span class="woocommerce-input-wrapper">
                                            <input class="theme-input-style" id="new_password" type="password" placeholder="{{ __('common.new_password') }}" name="new_password" autocomplete="current-password">
                                        </span>
                                        <span class="woocommerce-input-wrapper">
                                            <input class="theme-input-style" id="new_confirm_password" type="password" placeholder="{{ __('common.new_confirm_password') }}"  name="new_confirm_password" autocomplete="current-password">
                                        </span>
                                        <div>
                                            <button type="submit" class="billing-submit-button btn btn-fill-type mb-40">{{ __('common.update_password') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End of Account details -->
                        </div>
                    </div>
                </div>
                <!-- End of dashboard content -->
            </div>
        </div>
    </div>
</section>
<!-- End of logout register wrap -->

@endsection

@push('plugin-scripts')
    <script src="{{ asset('web-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('web-assets/js/starrr.js') }}"></script>
@endpush

@push('custom-scripts')

@endpush
