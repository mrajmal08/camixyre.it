@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/simplemde/simplemde.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/asaldi-style.css') }}" rel="stylesheet" />
@endpush

@section('content')
<form action="{{route('page.update', $page->id)}}" method="POST" class="row">
  @csrf
  {{ method_field('PUT') }}
  
  <div class="col-12 pl-4">
    <h4 id="vertical">Edit Page</h4>
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
          <a class="nav-link active" id="english-tab" data-toggle="tab" href="#english-page" role="tab" aria-controls="line-english" aria-selected="true">English</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="italian-tab" data-toggle="tab" href="#italian-page" role="tab" aria-controls="line-italian" aria-selected="false">Italian</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="french-tab" data-toggle="tab" href="#french-page" role="tab" aria-controls="line-french" aria-selected="false">French</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="spanish-tab" data-toggle="tab" href="#spanish-page" role="tab" aria-controls="line-spanish" aria-selected="false">Spanish</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="german-tab" data-toggle="tab" href="#german-page" role="tab" aria-controls="line-german" aria-selected="false">German</a>
        </li>
      </ul>

      <div class="tab-content mt-3" id="lineTabContent">

        <div class="tab-pane fade show active" id="english-page" role="tabpanel" aria-labelledby="english-tab">
          <fieldset class="row">
            <div class="form-group col-md-6">
              <label for="page title">Page Title*</label>
              <input class="form-control" name="title-en" value="{{$page->title_en}}" type="text" required>
            </div>
            <div class="form-group col-md-6">
              <label for="meta title">Meta Title</label>
              <input class="form-control" name="meta-title-en" value="{{$page->meta_title_en}}" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Page Description</label>
              <textarea class="form-control" name="description-en" id="tinymceEn" rows="10">{!! $page->description_en !!}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="meta keyword">Meta Keyword</label>
              <input class="form-control" name="meta-keyword-en" value="{{$page->meta_keyword_en}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta description">Meta Description</label>
              <input class="form-control" name="meta-description-en" value="{{$page->meta_description_en}}" type="text">
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="italian-page" role="tabpanel" aria-labelledby="italian-tab">
          <fieldset class="row">
            <div class="form-group col-md-6">
              <label for="page title">Page Title</label>
              <input class="form-control" name="title-it" value="{{$page->title_it}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta title">Meta Title</label>
              <input class="form-control" name="meta-title-it" value="{{$page->meta_title_it}}" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Page Description</label>
              <textarea class="form-control" name="description-it" id="tinymceIt" rows="10">{!! $page->description_it !!}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="meta keyword">Meta Keyword</label>
              <input class="form-control" name="meta-keyword-it" value="{{$page->meta_keyword_it}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta description">Meta Description</label>
              <input class="form-control" name="meta-description-it" value="{{$page->meta_description_it}}" type="text">
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="french-page" role="tabpanel" aria-labelledby="french-tab">
          <fieldset class="row">
            <div class="form-group col-md-6">
              <label for="page title">Page Title*</label>
              <input class="form-control" name="title-fr" value="{{$page->title_fr}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta title">Meta Title</label>
              <input class="form-control" name="meta-title-fr" value="{{$page->meta_title_fr}}" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Page Description</label>
              <textarea class="form-control" name="description-fr" id="tinymceFr" rows="10">{!! $page->description_fr !!}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="meta keyword">Meta Keyword</label>
              <input class="form-control" name="meta-keyword-fr" value="{{$page->meta_keyword_fr}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta description">Meta Description</label>
              <input class="form-control" name="meta-description-fr" value="{{$page->meta_description_fr}}" type="text">
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="spanish-page" role="tabpanel" aria-labelledby="spanish-tab">
          <fieldset class="row">
            <div class="form-group col-md-6">
              <label for="page title">Page Title*</label>
              <input class="form-control" name="title-es" value="{{$page->title_es}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta title">Meta Title</label>
              <input class="form-control" name="meta-title-es" value="{{$page->meta_title_es}}" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Page Description</label>
              <textarea class="form-control" name="description-es" id="tinymceEs" rows="10">{!! $page->description_es !!}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="meta keyword">Meta Keyword</label>
              <input class="form-control" name="meta-keyword-es" value="{{$page->meta_keyword_es}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta description">Meta Description</label>
              <input class="form-control" name="meta-description-es" value="{{$page->meta_description_en}}" type="text">
            </div>
          </fieldset>
        </div>

        <div class="tab-pane fade" id="german-page" role="tabpanel" aria-labelledby="german-tab">
          <fieldset class="row">
            <div class="form-group col-md-6">
              <label for="page title">Page Title*</label>
              <input class="form-control" name="title-de" value="{{$page->title_de}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta title">Meta Title</label>
              <input class="form-control" name="meta-title-de" value="{{$page->meta_title_de}}" type="text">
            </div>
            <div class="form-group col-12">
              <label for="description">Page Description</label>
              <textarea class="form-control" name="description-de" id="tinymceDe" rows="10">{!! $page->description_de !!}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="meta keyword">Meta Keyword</label>
              <input class="form-control" name="meta-keyword-de" value="{{$page->meta_keyword_de}}" type="text">
            </div>
            <div class="form-group col-md-6">
              <label for="meta description">Meta Description</label>
              <input class="form-control" name="meta-description-de" value="{{$page->meta_description_de}}" type="text">
            </div>
          </fieldset>
        </div>
        
      </div>

    </div>
  </div>
  <div class="col-xl-3 main-content pr-xl-4">
    <div class="example">
      <div class="form-group col-md-12">
        <h4 class="mb-2">Page Slug (URLs)</h4>
        <p class="form-help-text mt-0 mb-0"><span class="text-warning">Note:</span> All Pages URLs must be unique</p>
        <fieldset class="row mt-4">
          <div class="form-group col-12">
            <label for="slug">Page Url (English)</label>
            <input class="form-control" id="url_en" name="url-en" value="{{$page->url_en}}" type="text" autocomplete="off" required>
          </div>
          <div class="form-group col-12">
            <label for="slug">Page Url (Italian)</label>
            <input class="form-control" id="url_it" name="url-it" value="{{$page->url_it}}" type="text" autocomplete="off" required>
          </div>
          <div class="form-group col-12">
            <label for="slug">Page Url (French)</label>
            <input class="form-control" id="url_fr" name="url-fr" value="{{$page->url_fr}}" type="text" autocomplete="off" required>
          </div>
          <div class="form-group col-12">
            <label for="slug">Page Url (Spanish)</label>
            <input class="form-control" id="url_es" name="url-es" value="{{$page->url_es}}" type="text" autocomplete="off" required>
          </div>
          <div class="form-group col-12">
            <label for="slug">Page Url (German)</label>
            <input class="form-control" id="url_de" name="url-de" value="{{$page->url_de}}" type="text" autocomplete="off" required>
          </div>
          <div id="urLMsg" class="col-lg-12 col-12 mb-30">
              <!-- Here Goes The Urls Error -->
          </div>
        </fieldset>
      </div>
      <hr>
      <div class="form-group col-md-12">
        <button class="btn btn-primary btn-block">UPDATE PAGE</button>
      </div>
    </div>
  </div>
</form>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/seo-url-validation.js') }}"></script>
  <script src="{{ asset('assets/js/tinymce.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush