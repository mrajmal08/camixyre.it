@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/asaldi-style.css') }}" rel="stylesheet" />
@endpush

@section('content')
<form action="{{route('category.store')}}" method="POST" class="row">
  @csrf

  <div class="col-12 pl-4">
    <h4 id="vertical">Add New Category</h4>
    <p class="mb-3">in multiple languages.</p>
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

      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="english-tab" data-toggle="tab" href="#english-product" role="tab" aria-controls="line-english" aria-selected="true">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="italian-tab" data-toggle="tab" href="#italian-product" role="tab" aria-controls="line-italian" aria-selected="false">Italian</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="french-tab" data-toggle="tab" href="#french-product" role="tab" aria-controls="line-french" aria-selected="false">French</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="spanish-tab" data-toggle="tab" href="#spanish-product" role="tab" aria-controls="line-spanish" aria-selected="false">Spanish</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="german-tab" data-toggle="tab" href="#german-product" role="tab" aria-controls="line-german" aria-selected="false">German</a>
        </li>
      </ul>

      <div class="tab-content mt-3" id="lineTabContent">

        <div class="tab-pane fade show active" id="english-product" role="tabpanel" aria-labelledby="english-tab">
          <fieldset class="row">
            <div class="form-group col-md-12">
              <label for="product title">Category Name*</label>
              <input class="form-control" name="title-en" type="text" required>
            </div>
            <div class="form-group col-md-12">
              <label for="product title">Meta Title</label>
              <input class="form-control" name="meta-title-en" type="text">
            </div>
            <div class="form-group col-md-12">
              <label for="product title">Meta Description</label>
              <input class="form-control" name="meta-description-en" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Description</label>
              <textarea class="form-control" name="description-en" rows="10"></textarea>
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="italian-product" role="tabpanel" aria-labelledby="italian-tab">
          <fieldset class="row">
            <div class="form-group col-md-12">
              <label for="product title">Category Name</label>
              <input class="form-control" name="title-it" type="text">
            </div>
            <div class="form-group col-md-12">
              <label for="product title">Meta Title</label>
              <input class="form-control" name="meta-title-it" type="text">
            </div>
            <div class="form-group col-md-12">
              <label for="product title">Meta Description</label>
              <input class="form-control" name="meta-description-it" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Description</label>
              <textarea class="form-control" name="description-it" rows="10"></textarea>
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="french-product" role="tabpanel" aria-labelledby="french-tab">
          <fieldset class="row">
            <div class="form-group col-md-12">
              <label for="product title">Category Name</label>
              <input class="form-control" name="title-fr" type="text">
            </div>
            <div class="form-group col-md-12">
              <label for="product title">Meta Title</label>
              <input class="form-control" name="meta-title-fr" type="text">
            </div>
            <div class="form-group col-md-12">
              <label for="product title">Meta Description</label>
              <input class="form-control" name="meta-description-fr" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Description</label>
              <textarea class="form-control" name="description-fr" rows="10"></textarea>
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="spanish-product" role="tabpanel" aria-labelledby="spanish-tab">
          <fieldset class="row">
            <div class="form-group col-md-12">
              <label for="product title">Category Name</label>
              <input class="form-control" name="title-es" type="text">
            </div>
            <div class="form-group col-md-12">
              <label for="product title">Meta Title</label>
              <input class="form-control" name="meta-title-es" type="text">
            </div>
            <div class="form-group col-md-12">
              <label for="product title">Meta Description</label>
              <input class="form-control" name="meta-description-es" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Description</label>
              <textarea class="form-control" name="description-es" rows="10"></textarea>
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="german-product" role="tabpanel" aria-labelledby="german-tab">
          <fieldset class="row">
            <div class="form-group col-md-12">
              <label for="product title">Category Name</label>
              <input class="form-control" name="title-de" type="text">
            </div>
            <div class="form-group col-md-12">
              <label for="product title">Meta Title</label>
              <input class="form-control" name="meta-title-de" type="text">
            </div>
            <div class="form-group col-md-12">
              <label for="product title">Meta Description</label>
              <input class="form-control" name="meta-description-de" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Description</label>
              <textarea class="form-control" name="description-de" rows="10"></textarea>
            </div>
          </fieldset>
        </div>

        <div class="form-group col-12 p-0 mt-3">
          <label class="mb-2">Category Slug (URLs)</label>
          <p class="form-help-text mt-0 mb-0"><span class="text-warning">Note:</span> All Category URLs must be unique</p>
          <fieldset class="row mt-4">
            <div class="form-group col-12">
              <label for="slug">Category Url (English)</label>
              <input class="form-control" id="url_en" name="url-en" type="text" autocomplete="off" required>
            </div>
            <div class="form-group col-12">
              <label for="slug">Category Url (Italian)</label>
              <input class="form-control" id="url_it" name="url-it" type="text" autocomplete="off" required>
            </div>
            <div class="form-group col-12">
              <label for="slug">Category Url (French)</label>
              <input class="form-control" id="url_fr" name="url-fr" type="text" autocomplete="off" required>
            </div>
            <div class="form-group col-12">
              <label for="slug">Category Url (Spanish)</label>
              <input class="form-control" id="url_es" name="url-es" type="text" autocomplete="off" required>
            </div>
            <div class="form-group col-12">
              <label for="slug">Category Url (German)</label>
              <input class="form-control" id="url_de" name="url-de" type="text" autocomplete="off" required>
            </div>
            <div id="urLMsg" class="col-lg-12 col-12 mb-30">
                <!-- Here Goes The Urls Error -->
            </div>
          </fieldset>
        </div>

        <div class="form-group col-12 p-0 mt-3">
          <label for="category parent">Category Parent</label>
          <select class="select-multiple w-100" name="parent-ids[]" multiple="multiple">
            @if($categories)
              @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title_en}}</option>
              @endforeach
            @endif
          </select>
        </div>
        
      </div>

      <div class="col-12 p-0 mt-3">
        <button class="btn btn-primary btn-block">ADD NEW CATEGORY</button>
      </div>

    </div>
  </div>
</form>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/seo-url-validation.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush