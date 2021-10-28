@extends('layouts.master')

{{-- CSS For Specific Page --}}
@push('plugin-styles')
	<link href="{{ asset('web-assets/plugins/owl-carousel/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="{{ asset('web-assets/plugins/Magnific-Popup/magnific-popup.css') }}" rel="stylesheet">
	<link href="{{ asset('web-assets/plugins/swiper/swiper.min.css') }}" rel="stylesheet">
@endpush

<!-- Main Content Start -->
@section('content')
<main>

    <!-- banner area -->
    <section class="banner-slider">
        <div class="slider-inner-wrap">
            <div class="owl-carousel banner-carousel1">
                <!-- single slider wrap -->
                <div class="single-slider-wrap" data-bg-img='/web-assets/img/banner/banner-1.png'>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- slider text -->
                                <div class="single-slider-text">
                                    <h1>Fly Safe</h1>
                                    <p>Fly Smart, Stay informed</p>
                                    <a href="/{{$lang}}/shop" class="btn">Browse All Products</a>
                                </div>
                                <!-- End of slider text -->
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider wrap -->

                 <!-- single slider wrap -->
                <div class="single-slider-wrap banner-2" data-bg-img='/web-assets/img/banner/banner-2.jpg'>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- slider text -->
                                <div class="single-slider-text">
                                    <h1 class="title">Shop Drones</h1>
                                    <p>Drone Accessories Online at Camixyre!</p>
                                    <a href="/{{$lang}}/shop" class="btn">Browse All Products</a>
                                </div>
                                <!-- End of slider text -->
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider wrap -->
            </div>
        </div>
    </section>
    <!-- End of banner area -->

	<!-- Start Collection Section -->
	<section class="pt-40 pb-70">
			<div class="collection-inner">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-6">
							<!-- single Collection -->
							<div class="single-colection-inner overlay2 type2">
								<div class="single-colection-img">
								<img src="/web-assets/img/add/f-1.jpg" alt=""> 
								</div>
								<div class="single-colection">
									<h3>Trendy Items</h3>
									<a href="/{{$lang}}/shop" class="btn">Shop Now</a>
								</div>
							</div>
							<!-- End of single Collection -->
						</div>
	
						<div class="col-lg-4 col-md-6">
							<!-- single Collection -->
							<div class="single-colection-inner overlay3 type2">
								<div class="single-colection-img">
								<img src="/web-assets/img/add/f-2.jpg" alt=""> 
								</div>
								<div class="single-colection">
									<h3>Top Sellers</h3>
									<a href="/{{$lang}}/shop" class="btn">Shop Now</a>
								</div>
							</div>
							<!-- End of single Collection -->
						</div>
	
						<div class="col-lg-4 col-md-6">
							<!-- single Collection -->
							<div class="single-colection-inner overlay4 type2">
								<div class="single-colection-img">
								<img src="/web-assets/img/add/f-3.jpg" alt=""> 
								</div>
								<div class="single-colection">
									<h3>Hot Deals</h3>
									<a href="/{{$lang}}/shop" class="btn">Shop Now</a>
								</div>
							</div>
							<!-- End of single Collection -->
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End Of Collection Section -->

	<!-- New Arrival -->
	<section>
			<div class="container">
				<div class="row">
					<div class="col">
					<!-- section title -->
						<div class="section-title-wrap">
							<div class="section-title">
								<h2>New Arrival<span>This Season</span></h2>
								
							</div>
						</div>
					<!-- End of section title -->
					</div>
				</div>
				<div class="row">
					@foreach ($bestSelling as $product)
					@switch($lang)
						@case("en")
							@php
								$productTitle = $product->title_en;
								$productUrl   = $product->url_en;
							@endphp
							@break
						@case("it")
							@php
								$productTitle = (empty($product->title_it)) ? $product->title_en : $product->title_it;
								$productUrl   = (empty($product->url_it)) ? $product->url_en : $product->url_it;
							@endphp
							@break
						@case("fr")
							@php
								$productTitle = (empty($product->title_fr)) ? $product->title_en : $product->title_fr;
								$productUrl   = (empty($product->url_fr)) ? $product->url_en : $product->url_fr;
							@endphp
							@break
						@case("es")
							@php
								$productTitle = (empty($product->title_es)) ? $product->title_en : $product->title_es;
								$productUrl   = (empty($product->url_es)) ? $product->url_en : $product->url_es;
							@endphp
							@break
						@case("de")
							@php
								$productTitle = (empty($product->title_de)) ? $product->title_en : $product->title_de;
								$productUrl   = (empty($product->url_de)) ? $product->url_en : $product->url_de;
							@endphp
							@break
						@default
							@php
								$productTitle = $product->title_en;
								$productUrl   = $product->url_en;
							@endphp
					@endswitch
					<div class="col-sm-6 col-12 col-lg-4">
						<!-- single product -->
						<div class="single-product type2">
							<div class="product-item">
								<div class="product-thumb">
									<!-- Product Image -->
									<div class="product-image">
										<a href="/{{$lang}}/product/{{$productUrl}}">
											<img class='normal-state' data-rjs="2" src="{{ asset('media/'.$product->featured_image) }}" alt="">
											<img class='hover-state' data-rjs="2" src="{{ asset('media/'.$product->featured_image) }}" alt="">
										</a>
									</div>
									<!-- End of Product Image -->

									<!-- product button -->
									<div class="product-buttons">
										<div class="quick-btn">
											<div class="quick-icon-btn">
												<a href="/{{$lang}}/product/{{$productUrl}}" class="quick_view">
													<span class="product-icon"><i class="fa fa-eye" aria-hidden="true"></i></span>
													<span class="icon-title">View Product</span>
												</a>
											</div>
										</div>
										<div class="wishlist-btn">
											<div class="wishlist-icon-btn">
												<a href="{{ route('wishlist.add', [$lang, $product->id]) }}">
												<span class="product-icon"><img src="/web-assets/img/icons/wishlist.svg" alt="" class="svg"></span>
													<span class="icon-title">See Wish List</span>
												</a>
											</div>
										</div>
									</div>
									<!-- End of product button -->
								</div>

								<!-- product info -->
								<div class="product-info">

									<!-- product title -->
									<div class="product-title">
										<h4><a href="/{{$lang}}/product/{{$productUrl}}">{{ substr($productTitle, 0 , 70) }}</a></h4>
									</div>
									<!-- end of product title -->

									@if ($product->on_sale == TRUE && $product->discount_price < $product->price && $product->discount_price > 0)
									<div class="product-price" style="display: flex; margin-top: 5px;">
										<strike style="margin-right: 5px;" class="product-price">
											<h5>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat	($product->price)}}</h5>
										</strike>
										<h5>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($product->discount_price)}}</h5>
									</div>
									@else
									<div class="product-price" style="margin-top: 5px;">
										<h5>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($product->price)}}.</h5>
									</div>
									@endif
								</div>
								 <!-- End of product info -->
							</div>
						</div>
						<!-- End of single product -->
					</div>
					@endforeach
				</div>
			</div>
	</section>
	<!-- End of New Arrival -->
	
	<!-- offer -->
	<section>
			<div class="offer parallax-window" data-parallax="scroll" data-image-src="/web-assets/img/featuerd/offer.jpg">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<!-- offer inner area -->
							<div class="offer-inner-area">
								<h4 class="get-upto">Get Up To</h4>
								<h2><span class="spacial great-vibes">75%</span>OFF</h2>
								<h4>For this <span>#summer</span> only</h4>
								<p>It is a long established fact that a reader will be distracted by the readable content of page at its layout.</p>
								<a href="/{{$lang}}/shop" class="btn">Shop Now</a>
							</div>
							<!-- End of offer inner area -->
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End of offer -->

	<!-- our blog -->
	<section class="pt-100 pb-70">
		<div class="container">
			<div class="row">
				<div class="col">
				<!-- section title -->
					<div class="section-title-wrap">
						<div class="section-title">
							<h2>Journal<span>Magazine</span></h2>
						</div>
					</div>
				<!-- End of section title -->
				</div>
			</div>
			<div class="row">
				@foreach ($blogPosts as $post)
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
				<div class="col-md-6">
					<!-- single blog post -->
					<div class="single-blog-wrap">
						<div class="row align-items-center">
							<div class="col-lg-6">
								<!-- single blog image -->
								<div class="single-blog-image">
									<a href="/{{$lang}}/post/{{ $postUrl }}"><img src="{{ asset('media/'.$post->featured_image) }}" alt=""></a>
								</div>
								<!-- End of single blog image -->
							</div>
							<div class="col-lg-6">
								<!-- single blog post details -->
								<div class="single-post-details post-content">
									<h3><a href="/{{$lang}}/post/{{ $postUrl }}">{{ $postTitle }}</a></h3>
									<div class="post-info">
										<ul class="list-unstyled mb-0">
											<li>
												<a href="">{{ substr($post->created_at, 0, -9) }}</a>
											</li>
											<li>
												by <a href="">Admin</a>
											</li>
										</ul>   
									</div>
									<div class="post-body">
										@if (!empty($postDesc))
											<p>{!! substr($postDesc, 0, 250) !!}...</p>
										@endif
										<a href="/{{$lang}}/post/{{ $postUrl }}" class="btn btn-line">Continue Reading...</a>
									</div>
								</div>
								<!-- End of single blog post details -->
							</div>
						</div>
					</div>
					<!-- End of single blog post -->
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- End of our blog -->

	<!-- Subscribe area -->
	<section class="pt-100 pb-100">
			<div class="container">
				<div class="row">
					<div class="col">
						<!-- section title -->
						<div class="section-title-wrap">
							<div class="section-title">
								<h2>Subscribe Now <span>Get Update</span></h2>
								
							</div>
						</div>
					<!-- End of section title -->
					</div>
				</div>
				<div class="row align-items-center">
					<div class="col-md-6">
						<!-- subscribe text -->
						<div class="subscribe-text">
							<h5>Subscribe our Newsletter</h5>
							<p>Get updates by subscribe our weekly newsletter</p>
						</div>
						<!-- End of subscribe text -->
					</div>
					<div class="col-md-6">
						<!-- subscribe form -->
						<div class="primary-form parsley-validate subscribe-form">
							<form class="form-group des-font flex" method="post" action="{{ route('newsletter.add', $lang) }}">
								@csrf
								<input type="email" name="email" class="theme-input-style" placeholder="{{ __('common.enter_your_email') }}">
								<button type="submit" class="subscribe-btn">{{ __('common.subscribe') }}</button>
							</form>
						</div>
						<!-- End of subscribe form -->
					</div>
				</div>
			</div>
	</section>
	<!-- End of Subscribe area -->

</main>
@endsection

@push('plugin-scripts')
	<script src="{{ asset('web-assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
@endpush

@push('custom-scripts')

@endpush