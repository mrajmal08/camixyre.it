@extends('admin.layouts.master')

@push('plugin-styles')
    <link href="{{ asset('css/asaldi-style.css') }}" rel="stylesheet" />
@endpush

@section('content')
<form action="{{ route('settings.update') }}" method="POST" class="row">
    @csrf
    @method('PUT')

    <div class="col-6 pl-4">
        <h4 id="vertical">Website Settings</h4>
        <p class="mb-3">setup your site according to your needs</p>
    </div>
    <div class="col-6 pl-4">
        <div class="col-sm-12 text-right">
            <button type="submit" class="btn btn-primary mt-2">Save All Settings</button>
        </div>
    </div>

    <div class="col-xl-12 main-content pl-xl-4 pr-xl-3">

        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <strong>{{ session('message') }}</strong>
            </div>
        @endif
        @if(session('error-message'))
            <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <strong>{{ session('error-message') }}</strong>
            </div>
        @endif

        <div class="row">

            {{-- Block Left --}}
            <div class="p-1 col-6">

                {{-- Braintree Settings --}}
                <div class="example">
                    <div class="row">
                        <div class="col-md-12 pr-5">
                            <div class="row p-0 mb-4">
                                <div class="col-sm-12">
                                    <h5 class="m-0 text-light text-uppercase">BRAINTREE <small>(Payment Gateway)</small></h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>ENABLE BRAINTREE</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_braintree" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_braintree", $settings->enable_braintree) == "1" ? "selected":"") }}
                                            disabled>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_braintree", $settings->enable_braintree) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_braintree') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYPAL WITHIN BRAINTREE</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_paypal_in_bt" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_paypal_in_bt", $settings->enable_paypal_in_bt) == "1" ? "selected":"") }}
                                            disabled>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_paypal_in_bt", $settings->enable_paypal_in_bt) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_paypal_in_bt') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PayPal Settings --}}
                <div class="example mt-2">
                    <div class="row">
                        <div class="col-md-12 pr-5">
                            <div class="row p-0 mb-4">
                                <div class="col-sm-12">
                                    <h5 class="m-0 text-light text-uppercase">PAYPAL <small>(Payment Gateway)</small></h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>ENABLE PAYPAL SMART BUTTONS</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_paypal_smart" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_paypal_smart", $settings->enable_paypal_smart) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_paypal_smart", $settings->enable_paypal_smart) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_paypal_smart') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH CARD SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_card" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_card", $settings->enable_pp_smart_card) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_card", $settings->enable_pp_smart_card) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_card') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH CREDIT SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_credit" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_credit", $settings->enable_pp_smart_credit) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_credit", $settings->enable_pp_smart_credit) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_credit') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH BANCONTACT SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_bancontact" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_bancontact", $settings->enable_pp_smart_bancontact) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_bancontact", $settings->enable_pp_smart_bancontact) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_bancontact') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH BLIK SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_blik" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_blik", $settings->enable_pp_smart_blik) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_blik", $settings->enable_pp_smart_blik) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_blik') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH EPS SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_eps" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_eps", $settings->enable_pp_smart_eps) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_eps", $settings->enable_pp_smart_eps) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_eps') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH GIROPAY SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_giropay" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_giropay", $settings->enable_pp_smart_giropay) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_giropay", $settings->enable_pp_smart_giropay) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_giropay') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH IDEAL SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_ideal" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_ideal", $settings->enable_pp_smart_ideal) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_ideal", $settings->enable_pp_smart_ideal) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_ideal') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH MERCADOPAGO SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_mercadopago" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_mercadopago", $settings->enable_pp_smart_mercadopago) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_mercadopago", $settings->enable_pp_smart_mercadopago) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_mercadopago') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH MYBANK SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_mybank" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_mybank", $settings->enable_pp_smart_mybank) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_mybank", $settings->enable_pp_smart_mybank) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_mybank') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH P24 SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_p24" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_p24", $settings->enable_pp_smart_p24) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_p24", $settings->enable_pp_smart_p24) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_p24') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH SEPA SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_sepa" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_sepa", $settings->enable_pp_smart_sepa) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_sepa", $settings->enable_pp_smart_sepa) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_sepa') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH SOFORT SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_sofort" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_sofort", $settings->enable_pp_smart_sofort) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_sofort", $settings->enable_pp_smart_sofort) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_sofort') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE PAYING WITH VENMO SMART BUTTON</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_pp_smart_venmo" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_pp_smart_venmo", $settings->enable_pp_smart_venmo) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_pp_smart_venmo", $settings->enable_pp_smart_venmo) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_pp_smart_venmo') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Block Right --}}
            <div class="p-1 col-6">

                {{-- Stripe Settings --}}
                <div class="example">
                    <div class="row">
                        <div class="col-md-12 pr-5">
                            <div class="row p-0 mb-4">
                                <div class="col-sm-12">
                                    <h5 class="m-0 text-light text-uppercase">STRIPE <small>(Payment Gateway)</small></h5>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE STRIPE</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_stripe" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_stripe", $settings->enable_stripe) == "1" ? "selected":"") }}
                                            disabled>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_stripe", $settings->enable_stripe) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_stripe') }}</p>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>

                {{-- Bank Transfer Settings --}}
                <div class="example mt-2">
                    <div class="row">
                        <div class="col-md-12 pr-5">
                            <div class="row p-0 mb-4">
                                <div class="col-sm-12">
                                    <h5 class="m-0 text-light text-uppercase">Bank Transfer <small>(Payment Gateway)</small></h5>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE BANK TRANSFER</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_bank_transfer" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_bank_transfer", $settings->enable_bank_transfer) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_bank_transfer", $settings->enable_bank_transfer) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_bank_transfer') }}</p>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>

                {{-- Cash On Delivery Settings --}}
                <div class="example mt-2">
                    <div class="row">
                        <div class="col-md-12 pr-5">
                            <div class="row p-0 mb-4">
                                <div class="col-sm-12">
                                    <h5 class="m-0 text-light text-uppercase">Cash On Delivery <small>(Payment Gateway)</small></h5>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>ENABLE CASH ON DELIVERY</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="enable_cod" autocomplete="off">
                                        <option value="1"
                                            {{ (old("enable_cod", $settings->enable_cod) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("enable_cod", $settings->enable_cod) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('enable_cod') }}</p>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>

                {{-- Price Settings --}}
                <div class="example mt-2">
                    <div class="row">
                        <div class="col-md-12 pr-5">
                            <div class="row p-0 mb-4">
                                <div class="col-sm-12">
                                    <h5 class="m-0 text-light text-uppercase">Price Settings</h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>CURRENCY</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="currency" autocomplete="off">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->name }}"
                                                {{ (old("currency", $settings->currency) == $currency->name ? "selected":"") }}>
                                                {{ __($currency->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('currency') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-12">
                                    <label>USE INTEGER PRICES</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="use_integer_prices" autocomplete="off">
                                        <option value="1"
                                            {{ (old("use_integer_prices", $settings->use_integer_prices) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("use_integer_prices", $settings->use_integer_prices) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('use_integer_prices') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-12">
                                    <label>USE CURRENCY SYMBOL</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="use_currency_symbol" autocomplete="off">
                                        <option value="1"
                                            {{ (old("use_currency_symbol", $settings->use_currency_symbol) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("use_currency_symbol", $settings->use_currency_symbol) == "0" ? "selected":"") }}>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('use_currency_symbol') }}</p>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-12">
                                    <label>USE COMMA FOR SEPARATING DECIMALS</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="comma_is_decimal_separator" autocomplete="off">
                                        <option value="1"
                                            {{ (old("comma_is_decimal_separator", $settings->comma_is_decimal_separator) == "1" ? "selected":"") }}>
                                            Yes
                                        </option>
                                        <option value="0"
                                            {{ (old("comma_is_decimal_separator", $settings->comma_is_decimal_separator) == "0" ? "selected":"") }}
                                            disabled>
                                            No
                                        </option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('comma_is_decimal_separator') }}</p>
                                </div>
                            </div>            
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</form>
@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')

@endpush
