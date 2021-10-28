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
                    <div class="page-title-heading"><h1 class="h2">CheckOut<span>Payment</span></h1></div>
                    <ul class="list-unstyled mb-0">
                        <li><a href="/{{$lang}}/home">home</a></li>
                        <li class="active"><a href="#">Check Out</a></li>
                    </ul>
                </div>
                <!-- End of page title inner -->
            </div>
        </div>
    </div>
</section>
<!-- End of page title -->

<!-- check out wrap -->
<section class="pb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- billing details wrap -->
                <div class="billing-details-wrap">
                    <div class="row justify-content-center">
                        <div class="alert alert-danger mt-1" id="validationErrorAlert" role="alert" style="display: none;">
                            <strong id="validationErrorText"></strong>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-danger mt-1" id="validationErrorAlert" role="alert">
                                {!! implode('', $errors->all('<strong id="validationErrorText">:message</strong><br>')) !!}
                            </div>
                        @endif
                        <div class="col-lg-6">
                            <!-- billing details form-->
                            <div class="billing-details">
                                <div class="billing-heading">
                                    <h3>Billing Details</h3>
                                </div>
                                <input type="hidden" id="payment_method" name="payment_method" aria-describedby="payment_method" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- first name -->
                                        <span class="woocommerce-input-wrapper">
                                            <input type="text" class="theme-input-style" placeholder="First Name" id="first_name" name="first_name" required>
                                        </span>
                                        <!--End of first name -->
                                    </div>
                                    <div class="col-md-6">
                                        <!-- last name -->
                                        <span class="woocommerce-input-wrapper">
                                            <input type="text" class="theme-input-style" placeholder="Last Name" id="last_name" name="last_name" required>
                                        </span>
                                        <!--End of last name -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Email Address -->
                                        <span class="woocommerce-input-wrapper">
                                            <input type="email" class="theme-input-style" name="email_address" id="email_address" placeholder="Email Address" required>
                                        </span>
                                        <!-- End of Email Address -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Phone No -->
                                        <span class="woocommerce-input-wrapper">
                                            <input type="number" class="theme-input-style" name="phone" id="phone" placeholder="Phone No" required>
                                        </span>
                                        <!-- End of Phone No -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Street Address -->
                                        <span class="woocommerce-input-wrapper">
                                            <input type="text" class="theme-input-style" name="street" id="street" placeholder="Street Address">
                                        </span>
                                        <!-- End of Street Address -->
                                    </div>
                                    <div class="col-md-6">
                                        <!-- District -->
                                        <span class="woocommerce-input-wrapper">
                                            <input type="text" class="theme-input-style" name="apartment" id="apartment" placeholder="Apartment">
                                        </span>
                                        <!-- End of District -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Town / City -->
                                        <span class="woocommerce-input-wrapper">
                                            <input type="text" class="theme-input-style" name="city" id="city" placeholder="Town / City">
                                        </span>
                                        <!-- End of Town / City -->
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Postcode / ZIP -->
                                        <span class="woocommerce-input-wrapper">
                                            <input type="text" class="theme-input-style"  name="zip" id="zip"  placeholder="Postcode / ZIP">
                                        </span>
                                        <!-- End of Postcode / ZIP -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Country -->
                                        <span class="woocommerce-input-wrapper">
                                            <select id="country" class="country-select form-control" name="country">
                                                <option value="" selected disabled>Select your Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->code }}" autocomplete="off" {{ ( old('country') == $country->code ? "selected":"" ) }} > {{ stripslashes($country->name) }} </option>
                                                @endforeach
                                            </select>
                                        </span>
                                        <!-- End of Country -->
                                    </div>
                                    <div class="col-md-6">
                                        <!-- District -->
                                        <span class="woocommerce-input-wrapper">
                                            <select id="state" class="country-select form-control" name="state" autocomplete="off">
                                                <option value="" selected disabled>Select Your State</option>
                                            </select>
                                        </span>
                                        <!-- End of District -->
                                    </div>
                                </div>
                            </div>
                            <!-- End of billing details form-->
                        </div>
                        <div class="col-lg-6">
                            <!-- your order -->
                            <div class="checkout-review-order-wrap">
                                <!-- checkout-review-order -->
                                <div class="woocommerce-checkout-review-order">
                                    <div class="review-order-header">
                                        <h3>Your order</h3>
                                    </div>
                                    <table class="review-order-table">
                                        <tbody>
                                            <tr>
                                                <th>{{ __('common.product') }}</th>
                                                <th>{{ __('common.quantity') }}</th>
                                                <th>{{ __('common.subtotal') }}</th>
                                            </tr>
                                            @php
                                                $shippingTotal = 0;
                                                $grandTotal = 0;
                                            @endphp
                                            @foreach ($cartList as $cart)
                                                @php $num = 0; @endphp
                                                @foreach ($cartProducts as $product)
                                                    @if ($product->id == $cart->product_id)
                                                    <tr>
                                                        @if($authUser = Auth::user())
                                                            @php $userID = $authUser->id; @endphp
                                                        @else
                                                            @php $userID = Cookie::get('guestUser'); @endphp
                                                        @endif
                                                            @switch($lang)
                                                                @case("en")
                                                                    @php
                                                                        $productTitle = $product->title_en;
                                                                        $productUrl   = $product->url_en;
                                                                    @endphp
                                                                    @break
                                                                @case("it")
                                                                    @php
                                                                        $productTitle = (empty($product->title_it)) ? $product->title_en : $product->title_it;
                                                                        $productUrl   = (empty($product->url_it)) ? $product->url_en : $product->url_it;
                                                                    @endphp
                                                                    @break
                                                                @case("fr")
                                                                    @php
                                                                        $productTitle = (empty($product->title_fr)) ? $product->title_en : $product->title_fr;
                                                                        $productUrl   = (empty($product->url_fr)) ? $product->url_en : $product->url_fr;
                                                                    @endphp
                                                                    @break
                                                                @case("es")
                                                                    @php
                                                                        $productTitle = (empty($product->title_es)) ? $product->title_en : $product->title_es;
                                                                        $productUrl   = (empty($product->url_es)) ? $product->url_en : $product->url_es;
                                                                    @endphp
                                                                    @break
                                                                @case("de")
                                                                    @php
                                                                        $productTitle = (empty($product->title_de)) ? $product->title_en : $product->title_de;
                                                                        $productUrl   = (empty($product->url_de)) ? $product->url_en : $product->url_de;
                                                                    @endphp
                                                                    @break
                                                                @default
                                                                    @php
                                                                        $productTitle = $product->title_en;
                                                                        $productUrl   = $product->url_en;
                                                                    @endphp
                                                            @endswitch
                                                            <td>
                                                                <a href="/{{$lang}}/product/{{$productUrl}}"> {{ $productTitle }}</a><br>
                                                                <span><b>SKU:</b> @php echo((empty($cart->product_sku)) ? "N/A" : $cart->product_sku); @endphp</span>
                                                            </td>

                                                            @php $incPrice = 0.00; @endphp
                                                            @if ($cart->product_attributes != "default")
                                                                @foreach ($cartAttributes as $attribute)
                                                                    @php $arrtIds = explode('|', $cart->product_attributes); @endphp
                                                                    @foreach ($arrtIds as $attrId)
                                                                        @if($attribute->id == $attrId)
                                                                            @php $incPrice += $attribute->price; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            @endif
                                                            <td>x {{ $cart->quantity }}</td>

                                                            @php $totalPrice = $cart->product_price * $cart->quantity; @endphp
                                                            @php
                                                            $shippingTotal += $product->shipping_price;
                                                            $discountPrice = $product->discount_price;
                                                            $normalPrice   = $product->price;
                                                            @endphp
                                                                @if ($product->on_sale == TRUE && $discountPrice < $normalPrice && $discountPrice > 0)
                                                                    <td>
                                                                        @php $grandTotal += ($discountPrice + $incPrice) * $cart->quantity; @endphp
                                                                        {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat(($discountPrice + $incPrice) * $cart->quantity)}}
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        @php $grandTotal += ($normalPrice + $incPrice) * $cart->quantity; @endphp
                                                                        {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat(($normalPrice + $incPrice) * $cart->quantity)}}
                                                                    </td>
                                                                @endif
                                                        </tr>
                                                        @endif
                                                    @php $num++; @endphp
                                                @endforeach
                                            @endforeach
                                            <hr>
                                            <tr>
                                                <td>{{ __('common.shipping') }}</td>
                                                <td></td>
                                                <td>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormatNormal($shippingTotal)}}</td>
                                            </tr>
                                            <tr>
                                                <td>{!! __('common.total_vat_tax') !!}</td>
                                                <td></td>
                                                <td>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getVatRate($grandTotal)}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{!! __('common.total_amount_tax') !!}</b></td>
                                                <td></td>
                                                <td>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($grandTotal)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- checkout-review-order -->
                                <!-- payment system -->
                                <div class="payment-system-wrap">
                                    <div class="payment-system-heading">
                                        <h5>{{ __('common.select_payment_method') }}</h5>
                                    </div>

                                    <div id="accordion">

                                        @if($braintreeEnabled)
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                      <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            {{$brainTreeLabel}}
                                                        </button>
                                                      </h5>
                                                    </div>
                                                
                                                     <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="wrapper">
                                                                <div class="checkout container">
                                                                    <section> 
                                                                        <div class="bt-drop-in-wrapper">
                                                                            <div id="bt-dropin"></div>
                                                                        </div>
                                                                    </section>
                                                                    <form action="{{route('braintree.payment', $lang)}}" id="payment-form-bt" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" id="nonce_bt" name="nonce">
                                                                        <input type="hidden" id="first_name_bt" name="first_name">
                                                                        <input type="hidden" id="last_name_bt" name="last_name">
                                                                        <input type="hidden" id="phone_bt" name="phone">
                                                                        <input type="hidden" id="street_bt" name="street">
                                                                        <input type="hidden" id="apartment_bt" name="apartment">
                                                                        <input type="hidden" id="city_bt" name="city">
                                                                        <input type="hidden" id="country_bt" name="country">
                                                                        <input type="hidden" id="state_bt" name="state">
                                                                        <input type="hidden" id="zip_bt" name="zip">
                                                                        <input type="hidden" id="total_bt" name="total">
                                                                        <button class="billing-submit-button btn btn-fill-type" id="btPayStartBtn" form="payment-form-bt" type="submit">
                                                                            <span>{{ __('common.click_to_complete') }}</span>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif
                                        
                                        @if($stripeEnabled)
                                                <div class="card">
                                                  <div class="card-header" id="headingTwo">
                                                    <h5 class="mb-0">
                                                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        {{ __('common.credit_card_by') }}
                                                      </button>
                                                    </h5>
                                                  </div>
                                                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="wrapper">
                                                            <div class="checkout container">
                                                                <section>
                                                                    <div class="tm-stripe-wrapper">
                                                                        <label for="stripe-card-element"></label>
                                                                        <div id="stripe-card-element">
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                <form action="{{route('checkout.fulfill.order', $lang)}}" id="payment-form-stripe" name="stripePayForm" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" id="first_name_stripe" name="first_name">
                                                                    <input type="hidden" id="last_name_stripe" name="last_name">
                                                                    <input type="hidden" id="phone_stripe" name="phone">
                                                                    <input type="hidden" id="street_stripe" name="street">
                                                                    <input type="hidden" id="apartment_stripe" name="apartment">
                                                                    <input type="hidden" id="city_stripe" name="city">
                                                                    <input type="hidden" id="country_stripe" name="country">
                                                                    <input type="hidden" id="state_stripe" name="state">
                                                                    <input type="hidden" id="zip_stripe" name="zip">
                                                                    <input type="hidden" id="transaction_stripe" name="transaction_id">
                                                                    <input type="hidden" id="total_stripe" name="total">
                                                                    <button class="button btn btn-payment btn-block" id="payStartBtnStripe" form="payment-form-stripe" type="submit" ><span>{{ __('common.click_to_complete') }}</span> </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                        @endif
                                        
                                        @if($codEnabled)
                                                <div class="card">
                                                  <div class="card-header" id="headingThree">
                                                    <h5 class="mb-0">
                                                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        {{ __('common.cash_on_delivery') }}
                                                      </button>
                                                    </h5>
                                                  </div>
                                                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="wrapper">
                                                            <div class="checkout">
                                                                <section>
                                                                    <div class="tm-cod-wrapper">
                                                                        <p>{{ __('common.pay_with_cash_on_delivery') }}</p>
                                                                        <div id="tm-cod-placement" class="place-order">
                                                                            <button id="place-cod" onclick="placeOrder('COD')" class="billing-submit-button btn btn-fill-type">{{ __('common.place_order') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                <form action="{{route('checkout.paylater.order', $lang)}}" id="payment-form-cod" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" class="first_name_paylater" name="first_name">
                                                                    <input type="hidden" class="last_name_paylater" name="last_name">
                                                                    <input type="hidden" class="email_address_paylater" name="email_address">
                                                                    <input type="hidden" class="phone_paylater" name="phone">
                                                                    <input type="hidden" class="street_paylater" name="street">
                                                                    <input type="hidden" class="apartment_paylater" name="apartment">
                                                                    <input type="hidden" class="city_paylater" name="city">
                                                                    <input type="hidden" class="country_paylater" name="country">
                                                                    <input type="hidden" class="state_paylater" name="state">
                                                                    <input type="hidden" class="zip_paylater" name="zip">
                                                                    <input type="hidden" class="payment_method" name="payment_method" value="COD">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                        @endif
                                        
                                        @if($bankTransferEnabled)
                                                <div class="card">
                                                  <div class="card-header" id="headingFour">
                                                    <h5 class="mb-0">
                                                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        {{ __('common.direct_bank_transfer') }}
                                                      </button>
                                                    </h5>
                                                  </div>
                                                  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="wrapper">
                                                            <div class="checkout">
                                                                <section>
                                                                    <div class="tm-bank-transfer-wrapper">
                                                                        <p>{{ __('common.for_bank_transfer_please_send_the_bank_slip_to') }} {{ $bankDetails->message }}</p>
                                                                        <div id="tm-bank-transfer-placement" class="place-order">
                                                                            <div id="bank-details">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <label><b>{{ __('common.bank_name') }} </b></label><span> {{ $bankDetails->bank_name }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <label><b>{{ __('common.account_name') }} </b></label><span> {{ $bankDetails->account_name }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <label><b>{{ __('common.account_number') }} </b></label><span> {{ $bankDetails->account_number }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                @if (!empty($bankDetails->sort_code))
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <label><b>{{ __('common.sort_code') }} </b></label><span> {{ $bankDetails->sort_code }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <label><b>IBAN: </b></label><span> {{ $bankDetails->iban }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <label><b>BIC / Swift: </b></label><span> {{ $bankDetails->bic_swift }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <button id="place-bank-transfer" onclick="placeOrder('Bank Transfer')" class="billing-submit-button btn btn-fill-type">{{ __('common.place_order') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                <form action="{{route('checkout.paylater.order', $lang)}}" id="payment-form-bank-transfer" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" class="first_name_paylater" name="first_name">
                                                                    <input type="hidden" class="last_name_paylater" name="last_name">
                                                                    <input type="hidden" class="email_address_paylater" name="email_address">
                                                                    <input type="hidden" class="phone_paylater" name="phone">
                                                                    <input type="hidden" class="street_paylater" name="street">
                                                                    <input type="hidden" class="apartment_paylater" name="apartment">
                                                                    <input type="hidden" class="city_paylater" name="city">
                                                                    <input type="hidden" class="country_paylater" name="country">
                                                                    <input type="hidden" class="state_paylater" name="state">
                                                                    <input type="hidden" class="zip_paylater" name="zip">
                                                                    <input type="hidden" class="payment_method" name="payment_method" value="Bank Transfer">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                        @endif

                                        @if($payPalSmartEnabled)
                                                <div class="card">
                                                    <div class="card-header" id="headingFive">
                                                      <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                            Pay via Paypal
                                                        </button>
                                                      </h5>
                                                    </div>
                                                
                                                     <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="wrapper">
                                                                <p>{{ __('common.pay_via_paypal_you_can_pay') }}</p>
                                                                <div class="checkout">
                                                                    <section>
                                                                        <div class="tm-paypal-smart-wrapper">
                                                                            <div id="tm-paypal-smart-placement">
                                                                            </div>
                                                                        </div>
                                                                    </section>
                                                                    <form action="{{route('checkout.fulfill.order', $lang)}}" id="payment-form-paypal-smart" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" id="first_name_paypal" name="first_name">
                                                                        <input type="hidden" id="last_name_paypal" name="last_name">
                                                                        <input type="hidden" id="email_address_paypal" name="email_address">
                                                                        <input type="hidden" id="phone_paypal" name="phone">
                                                                        <input type="hidden" id="street_paypal" name="street">
                                                                        <input type="hidden" id="apartment_paypal" name="apartment">
                                                                        <input type="hidden" id="city_paypal" name="city">
                                                                        <input type="hidden" id="country_paypal" name="country">
                                                                        <input type="hidden" id="state_paypal" name="state">
                                                                        <input type="hidden" id="zip_paypal" name="zip">
                                                                        <input type="hidden" id="transaction_paypal" name="transaction_id">
                                                                        <input type="hidden" id="total_paypal" name="total">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif

                                    </div>
                                <!--End of payment system -->
                                </div>
                            </div>
                            <!--End of your order -->
                        </div>
                        <div class="col-md-7">
                            <!-- woocommerce-terms-and-conditions-wrapper -->
                            <div class="terms-and-conditions-wrapper text-center">
                                <p>{{ __('common.your_personal_data_will_be') }}</a>.</p>
                                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox" for="terms_checkbox">
                                    <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="terms_checkbox">
                                    <span>I agree to the <a href="/{{ $lang }}/page/terms-and-conditions">terms and conditions</a></span>
                                </label>
                            </div>
                            <!-- End of woocommerce-terms-and-conditions-wrapper -->
                        </div>
                    </div>
                </div>
                <!-- End of billing details wrap -->
            </div>
        </div>
    </div>        
</section>
<!--End of check out wrap -->

<section id="main-checkout">

    <!-- Processing Modal begins -->
    <div class="modal fade" id="processingModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>{{ __('common.your_request') }}</p>
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Processing Modal ends -->

</section>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('web-assets/js/slick.min.js') }}"></script> 
    <script src="{{ asset('web-assets/js/function-input-number.js') }}"></script>
@endpush

@push('custom-scripts')
    @include('js-for-views.checkout-js')
    @if($braintreeEnabled)
        @include('js-for-views.payment-gateway-js.braintree-js')
    @endif
    @if($stripeEnabled)
        @include('js-for-views.payment-gateway-js.stripe-js')
    @endif
    @if($payPalSmartEnabled)
        @include('js-for-views.payment-gateway-js.paypal-smart-js')
    @endif
@endpush