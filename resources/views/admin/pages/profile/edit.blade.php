@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/asaldi-style.css') }}" rel="stylesheet" />
@endpush

@section('content')
<form action="{{route('author.update', $adminInfo->id)}}" method="POST" class="row">
  @csrf
  {{ method_field('PUT') }}

  <div class="col-12 pl-4">
    <h4 id="vertical">Profile</h4>
    <p class="mb-3">Admin Profile.</p>
  </div>
  <div class="col-xl-6 main-content pl-xl-4 pr-xl-3">
    <div class="example">

      <div class="col-12 p-0">
        @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @if(session()->has('message'))
          <div class="alert alert-success">
            {{session('message')}}
          </div>
        @endif
      </div>

      <div class="form-group">
        <label>Admin Name</label>
        <input class="form-control" type="text" name="name" value="{{ $adminInfo->name }}" required>
      </div>

      <div class="form-group">
        <label>Admin Email</label>
        <input class="form-control" type="email" name="email" value="{{ $adminInfo->email }}" required>
      </div>

      <div class="form-group">
        <label>Change password</label>
        <input class="form-control" type="password" name="password">
      </div>

      <div class="col-12 p-0 mt-3">
        <button class="btn btn-primary btn-block">UPDATE PROFILE</button>
      </div>

    </div>
  </div>
</form>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
@endpush

@push('custom-scripts')

@endpush