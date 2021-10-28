@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/simplemde/simplemde.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/image-picker/image-picker.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/asaldi-style.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
@endpush

@section('content')
<form action="{{route('product.store')}}" method="POST" class="row">
  @csrf
  
  <div class="col-12 pl-4">
    <h4 id="vertical">Add New Product</h4>
    <p class="mb-3">in multiple languages.</p>
  </div>

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

  {{-- PAGE CONTENT START --}}
  <div class="col-xl-9 main-content pl-xl-4 pr-xl-3">
    <div class="row">

      {{-- PRODUCT INFORMATION --}}
      <div class="example col-12">
  
        {{-- TABS NAV --}}
        <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="english-tab" data-toggle="tab" href="#english-product" role="tab" aria-controls="line-english" aria-selected="true">English</a>
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
  
        {{-- TABS CONTENT --}}
        <div class="tab-content mt-3" id="lineTabContent">
  
          {{-- ENGLISH --}}
          <div class="tab-pane fade show active" id="english-product" role="tabpanel" aria-labelledby="english-tab">
            <fieldset class="row">
              <div class="form-group col-md-6">
                <label for="product title">Product Title*</label>
                <input class="form-control" name="title-en" value="{{ old('title-en') }}" type="text" required>
              </div>
              <div class="form-group col-md-6">
                <label for="meta title">Meta Title</label>
                <input class="form-control" name="meta-title-en" type="text">
              </div>
              <div class="form-group col-12">
                <label for="description">Product Description</label>
                <textarea class="form-control" name="description-en" id="tinymceEn" rows="10"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label for="meta keyword">Meta Keyword</label>
                <input class="form-control" name="meta-keyword-en" type="text">
              </div>
              <div class="form-group col-md-6">
                <label for="meta description">Meta Description</label>
                <input class="form-control" name="meta-description-en" type="text">
              </div>
              <div class="form-group col-6">
                <label for="description">Short Description</label>
                <textarea class="form-control" name="short-description-en" rows="10"></textarea>
              </div>
              <div class="form-group col-6">
                <label for="description">Shipping & Delivery</label>
                <textarea class="form-control" name="shipping-delivery-en" rows="10"></textarea>
              </div>
              <div class="form-group col-12">
                <label for="tags">Tags</label>
                <input name="tags" id="tags-en" value="">
              </div>
            </fieldset>
          </div>
  
          {{-- ITALIAN --}}
          <div class="tab-pane fade" id="italian-product" role="tabpanel" aria-labelledby="italian-tab">
            <fieldset class="row">
              <div class="form-group col-md-6">
                <label for="product title">Product Title</label>
                <input class="form-control" name="title-it" type="text">
              </div>
              <div class="form-group col-md-6">
                <label for="meta title">Meta Title</label>
                <input class="form-control" name="meta-title-it" type="text">
              </div>
              <div class="form-group col-12">
                <label for="description">Product Description</label>
                <textarea class="form-control" name="description-it" id="tinymceIt" rows="10"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label for="meta keyword">Meta Keyword</label>
                <input class="form-control" name="meta-keyword-it" type="text">
              </div>
              <div class="form-group col-md-6">
                <label for="meta description">Meta Description</label>
                <input class="form-control" name="meta-description-it" type="text">
              </div>
              <div class="form-group col-6">
                <label for="description">Short Description</label>
                <textarea class="form-control" name="short-description-it" rows="10"></textarea>
              </div>
              <div class="form-group col-6">
                <label for="description">Shipping & Delivery</label>
                <textarea class="form-control" name="shipping-delivery-it" rows="10"></textarea>
              </div>
              <div class="form-group col-12">
                <label for="tags">Tags</label>
                <input name="tags" id="tags-it" value="">
              </div>
            </fieldset>
          </div>
  
          {{-- FRENCH --}}
          <div class="tab-pane fade" id="french-product" role="tabpanel" aria-labelledby="french-tab">
            <fieldset class="row">
              <div class="form-group col-md-6">
                <label for="product title">Product Title</label>
                <input class="form-control" name="title-fr" type="text">
              </div>
              <div class="form-group col-md-6">
                <label for="meta title">Meta Title</label>
                <input class="form-control" name="meta-title-fr" type="text">
              </div>
              <div class="form-group col-12">
                <label for="description">Product Description</label>
                <textarea class="form-control" name="description-fr" id="tinymceFr" rows="10"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label for="meta keyword">Meta Keyword</label>
                <input class="form-control" name="meta-keyword-fr" type="text">
              </div>
              <div class="form-group col-md-6">
                <label for="meta description">Meta Description</label>
                <input class="form-control" name="meta-description-fr" type="text">
              </div>
              <div class="form-group col-6">
                <label for="description">Short Description</label>
                <textarea class="form-control" name="short-description-fr" rows="10"></textarea>
              </div>
              <div class="form-group col-6">
                <label for="description">Shipping & Delivery</label>
                <textarea class="form-control" name="shipping-delivery-fr" rows="10"></textarea>
              </div>
              <div class="form-group col-12">
                <label for="tags">Tags</label>
                <input name="tags" id="tags-fr" value="">
              </div>
            </fieldset>
          </div>
  
          {{-- SPANISH --}}
          <div class="tab-pane fade" id="spanish-product" role="tabpanel" aria-labelledby="spanish-tab">
            <fieldset class="row">
              <div class="form-group col-md-6">
                <label for="product title">Product Title</label>
                <input class="form-control" name="title-es" type="text">
              </div>
              <div class="form-group col-md-6">
                <label for="meta title">Meta Title</label>
                <input class="form-control" name="meta-title-es" type="text">
              </div>
              <div class="form-group col-12">
                <label for="description">Product Description</label>
                <textarea class="form-control" name="description-es" id="tinymceEs" rows="10"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label for="meta keyword">Meta Keyword</label>
                <input class="form-control" name="meta-keyword-es" type="text">
              </div>
              <div class="form-group col-md-6">
                <label for="meta description">Meta Description</label>
                <input class="form-control" name="meta-description-es" type="text">
              </div>
              <div class="form-group col-6">
                <label for="description">Short Description</label>
                <textarea class="form-control" name="short-description-es" rows="10"></textarea>
              </div>
              <div class="form-group col-6">
                <label for="description">Shipping & Delivery</label>
                <textarea class="form-control" name="shipping-delivery-es" rows="10"></textarea>
              </div>
              <div class="form-group col-12">
                <label for="tags">Tags</label>
                <input name="tags" id="tags-es" value="">
              </div>
            </fieldset>
          </div>
  
          {{-- GERMAN --}}
          <div class="tab-pane fade" id="german-product" role="tabpanel" aria-labelledby="german-tab">
            <fieldset class="row">
              <div class="form-group col-md-6">
                <label for="product title">Product Title</label>
                <input class="form-control" name="title-de" type="text">
              </div>
              <div class="form-group col-md-6">
                <label for="meta title">Meta Title</label>
                <input class="form-control" name="meta-title-de" type="text">
              </div>
              <div class="form-group col-12">
                <label for="description">Product Description</label>
                <textarea class="form-control" name="description-de" id="tinymceDe" rows="10"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label for="meta keyword">Meta Keyword</label>
                <input class="form-control" name="meta-keyword-de" type="text">
              </div>
              <div class="form-group col-md-6">
                <label for="meta description">Meta Description</label>
                <input class="form-control" name="meta-description-de" type="text">
              </div>
              <div class="form-group col-6">
                <label for="description">Short Description</label>
                <textarea class="form-control" name="short-description-de" rows="10"></textarea>
              </div>
              <div class="form-group col-6">
                <label for="description">Shipping & Delivery</label>
                <textarea class="form-control" name="shipping-delivery-de" rows="10"></textarea>
              </div>
              <div class="form-group col-12">
                <label for="tags">Tags</label>
                <input name="tags" id="tags-de" value="">
              </div>
            </fieldset>
          </div>
  
        </div>
      </div>

      {{-- Slugs --}}
      <div class="example col-12 mt-3">
        <h4 class="mb-2">Product Slug (URLs)</h4>
        <p class="form-help-text mt-0 mb-0"><span class="text-warning">Note:</span> All Product URLs must be unique</p>
        <div class="col-12 mt-4">
            <fieldset class="row">
              <div class="form-group col-md-6">
                <label for="slug">Product Url (English)</label>
                <input class="form-control" id="url_en" name="url-en" type="text" autocomplete="off" required>
              </div>
              <div class="form-group col-md-6">
                <label for="slug">Product Url (Italian)</label>
                <input class="form-control" id="url_it" name="url-it" type="text" autocomplete="off" required>
              </div>
              <div class="form-group col-md-6">
                <label for="slug">Product Url (French)</label>
                <input class="form-control" id="url_fr" name="url-fr" type="text" autocomplete="off" required>
              </div>
              <div class="form-group col-md-6">
                <label for="slug">Product Url (Spanish)</label>
                <input class="form-control" id="url_es" name="url-es" type="text" autocomplete="off" required>
              </div>
              <div class="form-group col-md-6">
                <label for="slug">Product Url (German)</label>
                <input class="form-control" id="url_de" name="url-de" type="text" autocomplete="off" required>
              </div>
              <div id="urLMsg" class="col-lg-12 col-12 mb-30">
                  <!-- Here Goes The Urls Error -->
              </div>
            </fieldset>
        </div>
      </div>

      {{-- PRODUCT VARIATION --}}
      <div class="example col-12 mt-3">
        <h4 class="mb-2">Variations</h4>
        <p class="form-help-text mt-0 mb-1"><span class="text-warning">Note:</span> For color attributes please add color code in attributes name.</p>
        <div id="append-variation" class="row">
          {{-- Variation Body Start --}}
          {{-- Variation Body End --}}
        </div>
        <div class="col-12 mt-4">
          <div class="row">
            <div class="col-md-3">
              <label for="Variation Name">Variation Name</label>
              <input type="text" id="variation-name" class="form-control" placeholder="Variation Name">
            </div>
            <div class="col-md-3">
              <label for="Variation Type">Variation Type</label>
              <select name="" id="variation-type">
                <option value="color">Colors</option>
                <option value="Sizes">Sizes</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="col-md-3">
              <label for="Variation Button" style="visibility: hidden;">Action</label>
              <button type="button" id="add-variation" class="btn btn-primary btn-block">Add New Variation</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  
  {{-- Other Options --}}
  <div class="col-xl-3 main-content pr-xl-4">
    <div class="example">
      <div class="form-group col-md-12">
        <label for="product code">Product Code</label>
        <input class="form-control" name="product-code" type="text">
      </div>
      <div class="form-group col-md-12">
        <label for="product sku">Product SKU</label>
        <input class="form-control" name="product-sku" type="text" required>
      </div>
      <div class="form-group col-md-12">
        <label for="pirce">Product Price</label>
        <input class="form-control text-left" data-inputmask="'alias': 'currency'" name="price" required>
      </div>
      <div class="form-group col-md-12">
        <label for="discount pirce">Discount Price</label>
        <input class="form-control text-left" data-inputmask="'alias': 'currency'" name="discount-price">
      </div>
      <div class="form-group col-md-12">
        <label for="discount pirce">Shipping Price</label>
        <input class="form-control text-left" data-inputmask="'alias': 'currency'" name="shipping-price">
      </div>
      <div class="form-group col-md-12">
        <label for="product categories">Product Categories</label>
        <select class="select-multiple w-100" name="product-categories[]" multiple="multiple">
          @if($categories->count() > 0)
            @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->title_en}}</option>
            @endforeach
          @endif
        </select>
      </div>
      <div class="form-group col-md-12">
        <label for="featured image">Featured Image</label>
        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target=".bd-image-modal-xl">SELECT IMAGE</button>
        <img src="/assets/images/image-not-selected.jpg" id="featured-view" class="img-responsive mt-2" alt="Image Not Selected" style="width: 100%;">
        <input type="hidden" name="featured-image" value="" id="selected-featured">
      </div>
      <div class="form-group col-md-12">
        <label for="featured image">Image Gallery</label>
        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target=".bd-image-modal-x2">SELECT IMAGES</button>
        <input type="hidden" name="images-gallery" value="" id="selected-multiple">
        <p id="count-multiple" class="mt-2 text-secondary">0 Images Selected</p>
      </div>
      <div class="form-group col-md-12">
        <label for="featured image">Product Label</label>
        <div class="form-group">
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="label" id="optionsRadios1" value="new">
              New
            <i class="input-frame"></i></label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="label" id="optionsRadios2" value="sale">
              Sale
            <i class="input-frame"></i></label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="label" id="optionsRadios3" value="featured">
              Featured
            <i class="input-frame"></i></label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="label" id="optionsRadios4" value="top-seller">
              Top Seller
            <i class="input-frame"></i></label>
          </div>
        </div>
      </div>
      <hr>
      <div class="form-group col-md-12">
        <button class="btn btn-primary btn-block" name="publish">PUBLISH PRODUCT</button>
        <button class="btn btn-light btn-block" name="draft">SAVE TO DRAFT</button>
      </div>
    </div>
  </div>
</form>

{{-- SELECT FEATURED IMAGE --}}
<div class="modal fade bd-image-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="myExtraLargeModalLabel">Select Featured Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white;">×</span>
        </button>
      </div>
      <div class="modal-body images-selection-body">
        <div class="example">
          <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active reload-images" id="featured-image-tab" data-toggle="tab" href="#featured-image" role="tab" aria-controls="line-featured-image" aria-selected="true">All Images</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="upload-single-tab" data-toggle="tab" href="#upload-single" role="tab" aria-controls="upload-single" aria-selected="false">Upload New</a>
            </li>
          </ul>
          <div class="tab-content mt-3">
            <div class="tab-pane fade show active reload-data-single" id="featured-image" role="tabpanel" aria-labelledby="featured-image-tab">
              <select id="singleSelector" class="image-picker media-modal viewAjax">
                <option value="" selected></option>
                @foreach(File::glob(public_path('media').'/*') as $key => $path)
                  <option data-img-src='{{ str_replace(public_path(), '', $path) }}' value='{{$path}}'>
                @endforeach
              </select>
            </div>
            <div class="tab-pane fade" id="upload-single" role="tabpanel" aria-labelledby="upload-single-tab">
              <form action="{{route('media.upload')}}" method="POST" name="file" files="true" class="dropzone" id="mediaDropzoneSingle" enctype="multipart/form-data">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="select-single" class="btn btn-primary" data-dismiss="modal">Select</button>
      </div>
    </div>
  </div>
</div>

{{-- SELECT MULTIPLE IMAGES --}}
<div class="modal fade bd-image-modal-x2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="myExtraLargeModalLabel">Select Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white;">×</span>
        </button>
      </div>
      <div class="modal-body images-selection-body">
        <div class="example">
          <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active reload-images" id="all-images-tab" data-toggle="tab" href="#all-images" role="tab" aria-controls="line-all-images" aria-selected="true">All Images</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="upload-multiple-tab" data-toggle="tab" href="#upload-multiple" role="tab" aria-controls="upload-multiple" aria-selected="false">Upload New</a>
            </li>
          </ul>
          <div class="tab-content mt-3">
            <div class="tab-pane fade show active reload-data-multiple" id="all-images" role="tabpanel" aria-labelledby="all-images-tab">
              <select id="multipleSelector" class="image-picker media-modal reload-images" multiple="multiple">
                <option value=""></option>
                @foreach(File::glob(public_path('media').'/*') as $key => $path)
                  <option data-img-src='{{ str_replace(public_path(), '', $path) }}' value='{{$path}}'>
                @endforeach
              </select>
            </div>
            <div class="tab-pane fade" id="upload-multiple" role="tabpanel" aria-labelledby="upload-multiple-tab">
              <form action="{{route('media.upload')}}" method="POST" name="file" files="true" class="dropzone" id="mediaDropzoneMultiple" enctype="multipart/form-data">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="select-multiple" class="btn btn-primary" data-dismiss="modal">Select</button>
      </div>
    </div>
  </div>
</div>

{{-- SELECT VARIATIONS ATTRIBUTE IMAGES --}}
<div class="modal fade bd-image-modal-x3" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="myExtraLargeModalLabel">Select Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white;">×</span>
        </button>
      </div>
      <div class="modal-body images-selection-body">
        <div class="example">
          <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active reload-images" id="variation-en-images-tab" data-toggle="tab" href="#variation-en-images" role="tab" aria-controls="line-variation-en-images" aria-selected="true">All Images</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="upload-variation-en-tab" data-toggle="tab" href="#upload-variation-en" role="tab" aria-controls="upload-variation-en" aria-selected="false">Upload New</a>
            </li>
          </ul>
          <div class="tab-content mt-3">
            <div class="tab-pane fade show active reload-data-variation" id="variation-en-images" role="tabpanel" aria-labelledby="variation-en-images-tab">
              <select id="attributeSelector" class="image-picker media-modal reload-images selectorReloaded" multiple="multiple">
                <option value=""></option>
                @foreach(File::glob(public_path('media').'/*') as $key => $path)
                  <option data-img-src='{{ str_replace(public_path(), '', $path) }}' value='{{$path}}'>
                @endforeach
              </select>
            </div>
            <div class="tab-pane fade" id="upload-variation-en" role="tabpanel" aria-labelledby="upload-variation-en-tab">
              <form action="{{route('media.upload')}}" method="POST" name="file" files="true" class="dropzone" id="mediaDropzoneVariationEn" enctype="multipart/form-data">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="changeAttributeImage" onclick="selectAttributemages(this.id)" class="btn btn-primary" data-dismiss="modal" data-variation-en-id="102936">Select</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/image-picker/image-picker.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/seo-url-validation.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/tinymce.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/mediaModal.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script>

    // Reload Images Modal
    $(".reload-images").click(function(){
      $.ajax({
        type:'POST',
        url:'{{route('media.get')}}',
        data:{
          "_token": "{{ csrf_token() }}",
        },
        success: function(result){
          $('.reload-data-single').html(`<select id="singleSelector" class="image-picker media-modal selectorReloaded"></div>`);
          $('.reload-data-multiple').html(`<select id="multipleSelector" class="image-picker media-modal selectorReloaded" multiple="multiple"></div>`);
          $('.reload-data-variation').html(`<select id="attributeSelector" class="image-picker media-modal selectorReloaded" multiple="multiple"></div>`);
          result.forEach(function(value, index){
            $('.selectorReloaded').append(`<option data-img-src='\\media/${value}' value='${value}'></option>`);
          });
          $(".selectorReloaded").imagepicker();
        }
      });
    });

    // Remove Variation
    function removeVariation(removeID){
      $('[data-variation-id="'+removeID+'"]').remove();
    }

    // Remove Attribute
    function removeAttr(removeID){
      $('[data-attributes-id="'+removeID+'"]').remove();
    }

    // Add New Variation
    $('#add-variation').click(function(){
      const variationName = $('#variation-name').val();
      // If Variation Name Is Empty
      if(variationName == ""){
          $('#variation-name').addClass('has-error');
          die();
      }
      const variationType = $('#variation-type').val();
      let maxField = 10;
      const appendNewVariation = document.getElementById('append-variation');
      const genarateRandomNumber =  Math.floor(100000 + Math.random() * 900000);
      const appendVariationData = `
          <div class="col-12 mt-4 p-4" data-variation-id="${genarateRandomNumber}" style="background-color: #070d19;">
            <input type="hidden" value="${variationName}" name="variation-name[]">
            <input type="hidden" value="${variationType}" name="variation-type[]">
            <input type="hidden" value="${genarateRandomNumber}" name="variation-id[]">
            
            <div class="row pb-4" style="border-bottom: 1px solid #262f43">
              <div class="col-6 d-flex align-items-center">
                <h5>${variationName} - ${variationType}</h5>
              </div>
              <div class="col-6 text-right">
                <button type="button" id="${genarateRandomNumber}" class="btn" onclick="removeVariation(this.id)">
                  <i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            
            <div id="append-attribute-${genarateRandomNumber}" class="mt-4 mb-4">
              <fieldset class="row" data-attributes-id="${genarateRandomNumber}">
                <input type="hidden" value="${genarateRandomNumber}" name="variation-box-id[]">
                <div class="col-md-3 mb-3">
                  <label for="Attribute Name">Attribute Name English</label>
                  <input type="text" class="form-control" name="attribute-name-en[]" placeholder="Attribute Name" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="Attribute Name">Attribute Name Italian</label>
                  <input type="text" class="form-control" name="attribute-name-it[]" placeholder="Attribute Name">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="Attribute Name">Attribute Name French</label>
                  <input type="text" class="form-control" name="attribute-name-fr[]" placeholder="Attribute Name">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="Attribute Name">Attribute Name Spanish</label>
                  <input type="text" class="form-control" name="attribute-name-es[]" placeholder="Attribute Name">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="Attribute Name">Attribute Name German</label>
                  <input type="text" class="form-control" name="attribute-name-de[]" placeholder="Attribute Name">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="Price">Price</label>
                  <input type="number" step=".01" data-inputmask="'alias': 'currency'" name="attribute-price[]" class="form-control text-left" placeholder="Price">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="Price Pound">Attribute Images</label>
                  <input type="hidden" value="" data-attribute-src="${genarateRandomNumber}" name="attribute-images[]">
                  <button type="button" id="${genarateRandomNumber}" class="btn btn-info btn-block" data-toggle="modal" data-target=".bd-image-modal-x3" onclick="selectAttrImg(this.id)">Select Images</button>
                  <p data-attribute-counts="${genarateRandomNumber}" class="mt-2 text-secondary">0 Images Selected</p>
                </div>
              </fieldset>
            </div>
            
            <div class="row pt-4" style="border-top: 1px solid #262f43">
              <div class="col-6">
                <button type="button" id="attribute-${genarateRandomNumber}" class="btn btn-primary" onclick="addNewAttribute(this.id)">Add New Attribute</button>
              </div>
            </div>

          </div>
      `;
      let inc = 1;
      if(inc < maxField){ 
        inc++;
        $(appendNewVariation).append(appendVariationData);
      }
    });

    // Add New Attribute
    function addNewAttribute(appendID){
      let variationBoxID = appendID.slice(10);
      let maxField = 10;
      const appendNewAttribute = $('#append-' + appendID);
      const genarateRandomNumber =  Math.floor(100000 + Math.random() * 900000);
      const appendAttributeData = `
        <fieldset class="row mt-3" data-attributes-id="${genarateRandomNumber}">
          <input type="hidden" value="${variationBoxID}" name="variation-box-id[]">
          <div class="col-md-3 mb-3">
            <label for="Attribute Name">Attribute Name English</label>
            <input type="text" class="form-control" name="attribute-name-en[]" placeholder="Attribute Name" required>
          </div>
          <div class="col-md-3 mb-3">
            <label for="Attribute Name">Attribute Name Italian</label>
            <input type="text" class="form-control" name="attribute-name-it[]" placeholder="Attribute Name">
          </div>
          <div class="col-md-3 mb-3">
            <label for="Attribute Name">Attribute Name French</label>
            <input type="text" class="form-control" name="attribute-name-fr[]" placeholder="Attribute Name">
          </div>
          <div class="col-md-3 mb-3">
            <label for="Attribute Name">Attribute Name Spanish</label>
            <input type="text" class="form-control" name="attribute-name-es[]" placeholder="Attribute Name">
          </div>
          <div class="col-md-3 mb-3">
            <label for="Attribute Name">Attribute Name German</label>
            <input type="text" class="form-control" name="attribute-name-de[]" placeholder="Attribute Name">
          </div>
          <div class="col-md-3 mb-3">
            <label for="Price">Price</label>
            <input type="number" step=".01" data-inputmask="'alias': 'currency'" name="attribute-price[]" class="form-control text-left" placeholder="Price">
          </div>
          <div class="col-md-3 mb-3">
            <label for="Price Pound">Attribute Images</label>
            <input type="hidden" value="" data-attribute-src="${genarateRandomNumber}" name="attribute-images[]">
            <button type="button" id="${genarateRandomNumber}" class="btn btn-info btn-block" data-toggle="modal" data-target=".bd-image-modal-x3" onclick="selectAttrImg(this.id)">Select Images</button>
            <p data-attribute-counts="${genarateRandomNumber}" class="mt-2 text-secondary">0 Images Selected</p>
          </div>
          <div class="col-md-2">
            <label for="remove" style="visibility: hidden">.</label>
            <button type="button" id="${genarateRandomNumber}" class="btn btn-danger btn-block" onclick="removeAttr(this.id)">Remove</button>
          </div>
        </fieldset>
      `;
      let inc = 1;
      if(inc < maxField){ 
        inc++;
        $(appendNewAttribute).append(appendAttributeData);
      }
    }
    
    // Select Attribute Images
    function selectAttrImg(srcID){
      document.getElementById('changeAttributeImage').setAttribute("data-attr-img-id", srcID);
      $('.selected').each(function(){ this.click() });
    }

    // Add Attribute Images
    function selectAttributemages(srcID){
      const newSrcID = document.getElementById('changeAttributeImage').getAttribute("data-attr-img-id");
      const variationImage = $('#attributeSelector').val();
      const countImages = variationImage.length;
      var imagesList = "";
      variationImage.forEach(function(value, index){
        const cleanImages  = value.split("media/").pop();
        imagesList += cleanImages + "|";
      });
      $('[data-attribute-src="'+newSrcID+'"]').val(imagesList);
      $('[data-attribute-counts="'+newSrcID+'"]').text(countImages + " Images Selected");
    }

  </script>
@endpush