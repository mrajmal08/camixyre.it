@extends('layouts.master')

{{-- CSS For Specific Page --}}
@push('plugin-styles')

@endpush

<!-- Main Content Start -->
@section('content')

<section>
  <div class="error-inner-area height-100vh" data-bg-img='/web-assets/img/error1.jpg'>
       <div class="container">
          <div class="row">
              <div class="col-12">
                  <!-- error inner text -->
                  <div class="error-inner-text">
                      <span>It looks like you are lost</span>
                      <h1>Page Not Found</h1>
                      <a href="/" class="btn">Back To Home Page</a>
                  </div>
                  <!-- error inner text -->
              </div>
          </div>
      </div>
  </div>
</section>
<!-- End of 404 inner -->

@push('plugin-scripts')

@endpush

@push('custom-scripts')

@endpush