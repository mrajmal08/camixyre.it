@extends('layouts.master')

{{-- CSS For Specific Page --}}
@push('plugin-styles')

@endpush

<!-- Main Content Start -->
@section('content')

<main>

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
						<li class="active">{{ __('common.blog') }}</li>
					</ul>
				</div>
				<!-- End of page title inner -->
			</div>
		</div>
	</div>
</section>
<!-- End of page title -->

<!-- blog post inner -->
<section class="pt-100 pb-100">
    <div class="container">
        <div class="row">
			@foreach ($posts as $post)
					@switch($lang)
						@case("en")
							@php
								$postTitle = $post->title_en;
								$postDesc  = $post->description_en;
								$postUrl   = $post->url_en;
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
            	<div class="col-md-6 col-lg-6">
            	    <!-- single blog wraper -->
            	    <div class="single-blog-wrap type2 text-center">
            	        <!-- post image -->
            	        <div class="single-blog-image  hover-effect">
            	            <a href="/{{$lang}}/post/{{ $postUrl }}"><img src="{{ asset('media/'.$post->featured_image) }}" data-rjs="2" alt=""></a>
            	        </div>
            	        <!--End of  post image -->
            	        <!-- single blog details -->
            	        <div class="single-blog-details post-content">
            	            <div class="post-info">
            	                <span>by.</span><a href="#">Admin</a>
            	            </div>
            	            <div class="post-body">
            	                <h4><a href="/{{$lang}}/post/{{ $postUrl }}">{{ $postTitle }}</a></h4>
								@if (!empty($postDesc))
            	                	<p>{!! substr($postDesc, 0, 250) !!}...</p>
								@endif
            	            </div>
							<a href="/{{$lang}}/post/{{ $postUrl }}" class="btn btn-line">Continue Reading...</a>
            	        </div>
            	        <!--End of single blog details -->
            	    </div>
            	    <!-- End of single blog wraper -->
            	</div>
			@endforeach
        </div>
        <div class="row"> 
            <div class="col-12">
                <!-- blog pagination -->
                <!-- <div class="blog-pagination-wrap"> 
                    <ul class="pagination blog-pagination list-unstyled"> 
                        <li class="disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li><a href="#">01</a> </li>
                        <li class="active"><a href="#">02</a></li>
                        <li><a href="#">03</a></li>
                        <li><a href="#">04</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul> 
                </div> -->
                <!-- End of blog pagination -->
            </div>
        </div>
    </div>
</section>
<!-- Ennd of blog post inner -->

</main>

@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')

@endpush