@extends('layouts.master')

{{-- CSS For Specific Page --}}
@push('plugin-styles')

@endpush

<!-- Main Content Start -->
@section('content')

<main>

@switch($lang)
	@case("en")
		@php
			$postTitle = $post->title_en;
			$postDesc  = $post->description_en;
			$postUrl   = $post->url_en;
			$image 	   = $post->featured_image;
		@endphp
		@break
	@case("it")
		@php
			$postTitle = (empty($post->title_it)) ? $post->title_en : $post->title_it;
			$postDesc  = (empty($post->description_it)) ? $post->description_en : $post->description_it;
			$postUrl   = (empty($post->url_it)) ? $post->url_en : $post->url_it;
		@endphp
		@break
	@case("fr")
		@php
			$postTitle = (empty($post->title_fr)) ? $post->title_en : $post->title_fr;
			$postDesc  = (empty($post->description_fr)) ? $post->description_en : $post->description_fr;
			$postUrl   = (empty($post->url_fr)) ? $post->url_en : $post->url_fr;
		@endphp
		@break
	@case("es")
		@php
			$postTitle = (empty($post->title_es)) ? $post->title_en : $post->title_es;
			$postDesc  = (empty($post->description_es)) ? $post->description_en : $post->description_es;
			$postUrl   = (empty($post->url_es)) ? $post->url_en : $post->url_es;
		@endphp
		@break
	@case("de")
		@php
			$postTitle = (empty($post->title_de)) ? $post->title_en : $post->title_de;
			$postDesc  = (empty($post->description_de)) ? $post->description_en : $post->description_de;
			$postUrl   = (empty($post->url_de)) ? $post->url_en : $post->url_de;
		@endphp
		@break
	@default
		@php
			$postTitle = $post->title_en;
			$postDesc  = $post->description_en;
			$postUrl   = $post->url_en;
		@endphp
@endswitch

<!-- page title -->
<section class="page-title-inner" data-bg-img='/web-assets/img/page-titlebg.png'>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- page title inner -->
                <div class="page-title-wrap">
                    <div class="page-title-heading"><h1 class="h2">Journal<span>Magazine</span></h1></div>
                    <ul class="list-unstyled mb-0">
                        <li><a href="/{{$lang}}/home">home</a></li>
                        <li class="active"><a href="#">Blog Details</a></li>
                    </ul>
                </div>
                <!-- End of page title inner -->
            </div>
        </div>
    </div>
</section>
<!-- End of page title -->

<!-- blog details inner -->
<section class="pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <!-- post main content -->
                        <div class="post-main-content text-center">
                            <!-- post mata -->
                            <div class="post-mata">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        On.<a href="#">{{ substr($post->created_at, 0, -9) }}</a>
                                    </li>
                                    <li>
                                        By.<a href="#">Admin</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End of post mata -->

                            <!-- post main heading-->
                            <div class="post-heading">
                                <h2>{{ $postTitle }}</h2>
                            </div>
                            <!-- post main heading-->

                            <!-- post image -->
                            <div class="post-main-image">
                                <img src="/media/{{ $image }}" data-rjs="2" alt="">
                            </div>
                            <!--End of  post image -->
                        </div>
                        <!-- End of post main content -->
                    </div>
                    <div class="col-lg-12">
                        <!--single post content body -->
                        <div class="post-details-body">
                            <div class="single-post-content">
                                {!! $postDesc !!}
                            </div>
                        </div>
                        <!-- End of single post content body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Ennd of blog details inner -->


</main>


@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')

@endpush