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
                                <a class="dashboard-nav-item" id='nav-adetails' href="/{{ $lang }}/dashboard/profile"><span><img src="/web-assets/img/icons/account3.svg" class="svg" alt=""></span>Account Details</a>
                            </li>
                            <li>
                                <a class="dashboard-nav-item active" id="nav-order" href="/{{ $lang }}/dashboard/orders"><span><img src="/web-assets/img/icons/order.svg" class="svg" alt=""></span>Orders</a>
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
                        <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby='nav-order'>
                            <!-- dashboard order -->
                            <div class="dashboard-tab-order">
                                <!-- dashboard order table -->
                                @if (!empty($orders[0]))
                                <table class="dashboard-order-table table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.order_no') }}</th>
                                            <th>{{ __('common.order_date') }}</th>
                                            <th>{{ __('common.order_status') }}</th>
                                            <th>{{ __('common.payment_method') }}</th>
                                            <th>{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>#{{ $order->order_number }}</td>
                                            <td>{{ substr($order->created_at, 0, -9) }}</td>
                                            <td>{{ $order->order_status }}</td>
                                            <td>{{ $order->payment_type }} @if ($order->payment_type == "COD") {!! __('common.cash_on_delivery_two') !!} @endif</td>
                                            <td>
                                                <a href="/{{ $lang }}/dashboard/order/{{ $order->order_number }}">
                                                    <i class="icon-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <center><h2>{{ __('common.no_order') }}</h2></center>
                                @endif
                                <!--End of dashboard order table -->
                            </div>
                            <!-- End of dashboard order -->
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
