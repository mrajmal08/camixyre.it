@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/simplemde/simplemde.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/image-picker/image-picker.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/asaldi-style.css') }}" rel="stylesheet" />
@endpush

@section('content')
<form action="{{route('post.update', $post->id)}}" method="POST" class="row">
  @csrf
  {{ method_field('PUT') }}
  
  <div class="col-12 pl-4">
    <h4 id="vertical">Edit Post</h4>
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

  <div class="col-xl-9 main-content pl-xl-4 pr-xl-3">
    <div class="example">

      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="english-tab" data-toggle="tab" href="#english-post" role="tab" aria-controls="line-english" aria-selected="true">English</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="italian-tab" data-toggle="tab" href="#italian-post" role="tab" aria-controls="line-italian" aria-selected="false">Italian</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="french-tab" data-toggle="tab" href="#french-post" role="tab" aria-controls="line-french" aria-selected="false">French</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="spanish-tab" data-toggle="tab" href="#spanish-post" role="tab" aria-controls="line-spanish" aria-selected="false">Spanish</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="german-tab" data-toggle="tab" href="#german-post" role="tab" aria-controls="line-german" aria-selected="false">German</a>
        </li>
      </ul>

      <div class="tab-content mt-3" id="lineTabContent">

        <div class="tab-pane fade show active" id="english-post" role="tabpanel" aria-labelledby="english-tab">
          <fieldset class="row">
            <div class="form-group col-md-6">
              <label for="post title">Post Title*</label>
              <input class="form-control" name="title-en" value="{{$post->title_en}}" type="text" required>
            </div>
            <div class="form-group col-md-6">
              <label for="meta title">Meta Title</label>
              <input class="form-control" name="meta-title-en" value="{{$post->meta_title_en}}" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Post Description</label>
              <textarea class="form-control" name="description-en" id="tinymceEn" rows="10">{!! $post->description_en !!}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="meta keyword">Meta Keyword</label>
              <input class="form-control" name="meta-keyword-en" value="{{$post->meta_keyword_en}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta description">Meta Description</label>
              <input class="form-control" name="meta-description-en" value="{{$post->meta_description_en}}" type="text">
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="italian-post" role="tabpanel" aria-labelledby="italian-tab">
          <fieldset class="row">
            <div class="form-group col-md-6">
              <label for="post title">Post Title</label>
              <input class="form-control" name="title-it" value="{{$post->title_it}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta title">Meta Title</label>
              <input class="form-control" name="meta-title-it" value="{{$post->meta_title_it}}" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Post Description</label>
              <textarea class="form-control" name="description-it" id="tinymceIt" rows="10">{!! $post->description_it !!}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="meta keyword">Meta Keyword</label>
              <input class="form-control" name="meta-keyword-it" value="{{$post->meta_keyword_it}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta description">Meta Description</label>
              <input class="form-control" name="meta-description-it" value="{{$post->meta_description_it}}" type="text">
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="french-post" role="tabpanel" aria-labelledby="french-tab">
          <fieldset class="row">
            <div class="form-group col-md-6">
              <label for="post title">Post Title*</label>
              <input class="form-control" name="title-fr" value="{{$post->title_fr}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta title">Meta Title</label>
              <input class="form-control" name="meta-title-fr" value="{{$post->meta_title_fr}}" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Post Description</label>
              <textarea class="form-control" name="description-fr" id="tinymceFr" rows="10">{!! $post->description_fr !!}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="meta keyword">Meta Keyword</label>
              <input class="form-control" name="meta-keyword-fr" value="{{$post->meta_keyword_fr}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta description">Meta Description</label>
              <input class="form-control" name="meta-description-fr" value="{{$post->meta_description_fr}}" type="text">
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="spanish-post" role="tabpanel" aria-labelledby="spanish-tab">
          <fieldset class="row">
            <div class="form-group col-md-6">
              <label for="post title">Post Title*</label>
              <input class="form-control" name="title-es" value="{{$post->title_es}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta title">Meta Title</label>
              <input class="form-control" name="meta-title-es" value="{{$post->meta_title_es}}" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Post Description</label>
              <textarea class="form-control" name="description-es" id="tinymceEs" rows="10">{!! $post->description_es !!}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="meta keyword">Meta Keyword</label>
              <input class="form-control" name="meta-keyword-es" value="{{$post->meta_keyword_es}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta description">Meta Description</label>
              <input class="form-control" name="meta-description-es" value="{{$post->meta_description_es}}" type="text">
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="german-post" role="tabpanel" aria-labelledby="german-tab">
          <fieldset class="row">
            <div class="form-group col-md-6">
              <label for="post title">Post Title*</label>
              <input class="form-control" name="title-de" value="{{$post->title_de}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta title">Meta Title</label>
              <input class="form-control" name="meta-title-de" value="{{$post->meta_title_de}}" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Post Description</label>
              <textarea class="form-control" name="description-de" id="tinymceDe" rows="10">{!! $post->description_de !!}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="meta keyword">Meta Keyword</label>
              <input class="form-control" name="meta-keyword-de" value="{{$post->meta_keyword_de}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta description">Meta Description</label>
              <input class="form-control" name="meta-description-de" value="{{$post->meta_description_de}}" type="text">
            </div>
          </fieldset>
        </div>
        
      </div>

    </div>
  </div>
  <div class="col-xl-3 main-content pr-xl-4">
    <div class="example">
      <div class="form-group col-md-12">
        <h4 class="mb-2">Post Slug (URLs)</h4>
        <p class="form-help-text mt-0 mb-0"><span class="text-warning">Note:</span> All Posts URLs must be unique</p>
        <fieldset class="row mt-4">
          <div class="form-group col-12">
            <label for="slug">Post Url (English)</label>
            <input class="form-control" id="url_en" name="url-en" value="{{$post->url_en}}" type="text" autocomplete="off" required>
          </div>
          <div class="form-group col-12">
            <label for="slug">Post Url (Italian)</label>
            <input class="form-control" id="url_it" name="url-it" value="{{$post->url_it}}" type="text" autocomplete="off" required>
          </div>
          <div class="form-group col-12">
            <label for="slug">Post Url (French)</label>
            <input class="form-control" id="url_fr" name="url-fr" value="{{$post->url_fr}}" type="text" autocomplete="off" required>
          </div>
          <div class="form-group col-12">
            <label for="slug">Post Url (Spanish)</label>
            <input class="form-control" id="url_es" name="url-es" value="{{$post->url_es}}" type="text" autocomplete="off" required>
          </div>
          <div class="form-group col-12">
            <label for="slug">Post Url (German)</label>
            <input class="form-control" id="url_de" name="url-de" value="{{$post->url_de}}" type="text" autocomplete="off" required>
          </div>
          <div id="urLMsg" class="col-lg-12 col-12 mb-30">
              <!-- Here Goes The Urls Error -->
          </div>
        </fieldset>
      </div>
      <div class="form-group col-md-12">
        <label for="featured image">Featured Image</label>
        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target=".bd-image-modal-xl">SELECT IMAGE</button>
        @if(!empty($post->featured_image))
            <img src="/media/{{$post->featured_image}}" id="featured-view" class="img-responsive mt-2" alt="Image Not Selected" style="width: 100%;">
        @else
            <img src="/assets/images/image-not-selected.jpg" id="featured-view" class="img-responsive mt-2" alt="Image Not Selected" style="width: 100%;">
        @endif
        <input type="hidden" name="single-image" value="{{$post->featured_image}}" id="selected-featured">
      </div>
      <hr>
      <div class="form-group col-md-12">
        <button class="btn btn-primary btn-block">UPDATE POST</button>
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
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/image-picker/image-picker.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/seo-url-validation.js') }}"></script>
  <script src="{{ asset('assets/js/tinymce.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/mediaModal.js') }}"></script>
  <script>
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
          $('.reload-data-handle').html(`<select id="handleSelector" class="image-picker media-modal selectorReloaded" multiple="multiple"></div>`);
          result.forEach(function(value, index){
            $('.selectorReloaded').append(`<option data-img-src='\\media/${value}' value='${value}'></option>`);
          });
          $(".selectorReloaded").imagepicker();
        }
      });
    });
  </script>
@endpush