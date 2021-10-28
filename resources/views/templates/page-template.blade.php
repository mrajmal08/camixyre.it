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
                $pageTitle = $page->title_en;
                $pageDesc  = $page->description_en;
            @endphp
            @break
        @case("it")
            @php
                $pageTitle = (empty($page->title_it)) ? $page->title_en : $page->title_it;
                $pageDesc  = (empty($page->description_it)) ? $page->description_en : $page->description_it;
            @endphp
            @break
        @case("fr")
            @php
                $pageTitle = (empty($page->title_fr)) ? $page->title_en : $page->title_fr;
                $pageDesc  = (empty($page->description_fr)) ? $page->description_en : $page->description_fr;
            @endphp
            @break
        @case("es")
            @php
                $pageTitle = (empty($page->title_es)) ? $page->title_en : $page->title_es;
                $pageDesc  = (empty($page->description_es)) ? $page->description_en : $page->description_es;
            @endphp
            @break
        @case("de")
            @php
                $pageTitle = (empty($page->title_de)) ? $page->title_en : $page->title_de;
                $pageDesc  = (empty($page->description_de)) ? $page->description_en : $page->description_de;
            @endphp
            @break
        @default
            @php
                $pageTitle = $page->title_en;
                $pageDesc  = $page->description_en;
            @endphp
    @endswitch

	<div class="banner margin_bottom_80">
		<div class="container">
			<h1 class="title-font title-banner banner-product-detail">{{ $pageTitle }}</h1>
			<ul class="breadcrumb des-font">
				<li><a href="/{{$lang}}/home">Home</a></li>
				<li>Page</li>
				<li class="active">{{ $pageTitle }}</li>
			</ul>
		</div>
	</div>
    
	<div class="container margin_bottom_80">
        
        {!! $pageDesc !!}

	</div>    

    @include('templates.newsletter')
	
</main>
@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')

@endpush