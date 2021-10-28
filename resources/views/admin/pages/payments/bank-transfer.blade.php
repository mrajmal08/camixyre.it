@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('css/asaldi-style.css') }}" rel="stylesheet" />
@endpush

@section('content')
<form action="{{route('bank-transfer.update')}}" method="POST" class="row">
  @csrf
  @method('PUT')

  <div class="col-12 pl-4">
    <h4 class="mb-3" id="vertical">Bank Transfer Settings</h4>
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
                <h6>Account Name</h6>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="account_name" id="title-text-input" value="{{old('account_name', $bankTransfer->account_name)}}">
                <p class="text-danger">{{ $errors->first('account_name') }}</p>
            </div>
        </div>

        <div class="form-group row option-item">
            <div class="col-12">
                <p class="option-main-title">Account Number</p>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="account_number" id="title-text-input" value="{{old('account_number', $bankTransfer->account_number)}}">
                <p class="text-danger">{{ $errors->first('account_number') }}</p>
            </div>
        </div>

        <div class="form-group row option-item">
            <div class="col-12">
                <p class="option-main-title">Bank Name</p>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="bank_name" id="title-text-input" value="{{old('bank_name', $bankTransfer->bank_name)}}">
                <p class="text-danger">{{ $errors->first('bank_name') }}</p>
            </div>
        </div>

        <div class="form-group row option-item">
            <div class="col-12">
                <p class="option-main-title">Sort Code</p>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="sort_code" id="title-text-input" value="{{old('sort_code', $bankTransfer->sort_code)}}">
                <p class="text-danger">{{ $errors->first('sort_code') }}</p>
            </div>
        </div>

        <div class="form-group row option-item">
            <div class="col-12">
                <p class="option-main-title">Iban</p>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="iban" id="title-text-input" value="{{old('iban', $bankTransfer->iban)}}">
                <p class="text-danger">{{ $errors->first('iban') }}</p>
            </div>
        </div>

        <div class="form-group row option-item">
            <div class="col-12">
                <p class="option-main-title">Bic / Swift</p>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="bic_swift" id="title-text-input" value="{{old('bic_swift', $bankTransfer->bic_swift)}}">
                <p class="text-danger">{{ $errors->first('bic_swift') }}</p>
            </div>
        </div>

        <div class="form-group row option-item">
            <div class="col-12">
                <p class="option-main-title">Email</p>
            </div>
            <div class="col-12 mt-3">
                <input class="form-control" type="text" name="message" id="title-text-input" value="{{old('message', $bankTransfer->message)}}">
                <p class="text-danger">{{ $errors->first('message') }}</p>
            </div>
        </div>

        <div class="form-group row mb-0 mt-3">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Save Details</button>
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