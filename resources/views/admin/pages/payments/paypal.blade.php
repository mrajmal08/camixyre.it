@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('css/asaldi-style.css') }}" rel="stylesheet" />
@endpush

@section('content')
<form action="{{route('paypal.update')}}" method="POST" class="row">
  @csrf
  @method('PUT')

  <div class="col-12 pl-4">
    <h4 class="mb-3" id="vertical">PayPal Settings</h4>
  </div>
  
  <div class="col-xl-6 main-content pl-xl-4 pr-xl-3">
    <div class="example">

        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>{{ session('message') }}</strong>
            </div>
        @endif

        <div class="form-group row option-item">
            <div class="col-12">
                <h6>SELECT PayPal Smart ENVIRONMENT</h6>
                <p class="mt-2"><span class="text-warning">Note:</span> Select if you want to use the payment method in sandbox or production mode. For testing select "sandbox", for live sales select "production".</p>
            </div>
            <div class="col-12 mt-3">
                <select name="paypal_smart_environment" class="form-control" autocomplete="off">
                    <option value="sandbox" {{ (old("paypal_smart_environment", $paypalSettings->paypal_smart_environment) == "sandbox" ? "selected":"")}}>Sandbox</option>
                    <option value="production" {{ (old("paypal_smart_environment", $paypalSettings->paypal_smart_environment) == "production" ? "selected":"")}}>Production</option>
                </select>
                <p class="text-danger">{{ $errors->first('paypal_smart_environment') }}</p>
            </div>
        </div>

        <div class="form-group row option-item">
            <div class="col-12">
                <p class="option-main-title">PayPal SANDBOX CLIENT ID</p>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="paypal_smart_sandbox_client" id="title-text-input" value="{{old('paypal_smart_sandbox_client', $paypalSettings->paypal_smart_sandbox_client)}}">
                <p class="text-danger">{{ $errors->first('paypal_smart_sandbox_client') }}</p>
            </div>
        </div>

        <div class="form-group row option-item">
            <div class="col-12">
                <p class="option-main-title">PayPal PRODUCTION CLIENT ID</p>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="paypal_smart_production_client" id="title-text-input" value="{{old('paypal_smart_production_client', $paypalSettings->paypal_smart_production_client)}}">
                <p class="text-danger">{{ $errors->first('paypal_smart_production_client') }}</p>
            </div>
        </div>

        <div class="form-group row option-item">
            <div class="col-12">
                <p class="option-main-title">PayPal SANDBOX Secret</p>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="paypal_smart_sandbox_secret" id="title-text-input" value="{{old('paypal_smart_sandbox_secret', $paypalSettings->paypal_smart_sandbox_secret)}}">
                <p class="text-danger">{{ $errors->first('paypal_smart_sandbox_secret') }}</p>
            </div>
        </div>

        <div class="form-group row option-item">
            <div class="col-12">
                <p class="option-main-title">PayPal PRODUCTION Secret</p>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="paypal_smart_production_secret" id="title-text-input" value="{{old('paypal_smart_production_secret', $paypalSettings->paypal_smart_production_secret)}}">
                <p class="text-danger">{{ $errors->first('paypal_smart_production_secret') }}</p>
            </div>
        </div>

        <div class="form-group row mb-0 mt-3">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Save Credentials</button>
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