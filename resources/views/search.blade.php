@extends('layouts.master')

{{-- CSS For Specific Page --}}
@push('plugin-styles')

@endpush

<!-- Main Content Start -->
@section('content')

<main id="search-page">

	<!-- page title -->
	<section class="page-title-inner" data-bg-img='/web-assets/img/page-titlebg.png'>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- page title inner -->
					<div class="page-title-wrap">
						<div class="page-title-heading"><h1 class="h2">Search Page<span>Shopping</span></h1></div>
						<ul class="list-unstyled mb-0">
							<li><a href="/{{$lang}}/home">home</a></li>
							<li class="active"><a href="#">{{ $keyword }}</a></li>
						</ul>
					</div>
					<!-- End of page title inner -->
				</div>
			</div>
		</div>
	</section>
	<!-- End of page title -->
    
	<!-- product shop wrapper -->
	<section class="pt-100 pb-40">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- shop toolbar wrap -->
					<div class="shop-toolbar-wrap type2">
						<div class="shop-toolbar-filter">
							<div class="row align-items-center">
								<div class="col-md-12 col-lg-12 col-xl-12 position-static">
									<!-- product filter inner -->
									<div class="product-filter-inner">
										<!-- product found -->
										<div class="product-found product-count">
											<span>Showing results for {{ $keyword }}</span>
										</div>
										<!-- End of product found -->
	
										<!-- product grid view -->
										<div class="product-grid-view">
											<ul class="nav">
												<li>
													<a class="active" id="nav-three-col" data-toggle="tab" href="#threecol"><img src="/web-assets/img/icons/3grid.svg" class="svg" alt=""></a>
												</li>
												<li>
													<a class="" id="nav-one-tab" data-toggle="tab" href="#onecol"><img src="/web-assets/img/icons/1grid.svg" class="svg" alt=""></a>
												</li>
											</ul>
										</div>
										<!-- End of product grid view -->
									</div>
									<!-- product filter inner -->
								</div>
							</div>
						</div>
					</div>
					<!-- End of shop toolbar wrap -->
					<div class="row">
						<div class="col-12">
							<div class="tab-content shop-tab-content">
								<div class="tab-pane fade show active" role="tabpanel" id="threecol" aria-labelledby="nav-three-col">
									<div class="row">
										@foreach ($searchProducts as $product)
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
											<div class="col-md-6 col-sm-12 col-xl-4">
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
																		<span class="product-icon"><img src="web-assets/img/icons/wishlist.svg" alt="" class="svg"></span>
																			<span class="icon-title">See Wish List</span>
																		</a>
																	</div>
																</div>
															</div>
															<!-- End of product button -->
														</div>
	
														<!-- product info -->
														<div class="product-info">
															<div class="product-rating">
																<div class="star-rating">
																	<span></span>
																</div>
															</div>
	
															<!-- product title -->
															<div class="product-title">
																<h4><a href="/{{$lang}}/product/{{$productUrl}}">{{ $productTitle }}</a></h4>
															</div>
															<!-- end of product title -->

															@if ($product->on_sale == TRUE && $product->discount_price < $product->price && $product->discount_price > 0)
																<div class="product-price" style="display: flex; margin-top: 5px;">
																	<strike style="margin-right: 5px;" class="product-price">
																		<h5>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat	($product->price)}}</h5>
																	</strike>
																	<h5>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($product->price)}}.</h5>
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
								<div class="tab-pane fade" role="tabpanel" id="onecol">
									<div class="row">
										@foreach ($searchProducts as $product)
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
											<!-- single product -->
											<div class="col-12">
												<div class="single-product type3">
													<div class="product-item">
														<div class="row align-items-center">
															<div class="col-md-5">
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
															<div class="col-md-7">
																<!-- product info -->
																<div class="product-info">
	
																	<!-- product title -->
																	<div class="product-title">
																		<h4><a href="/{{$lang}}/product/{{$productUrl}}">{{ $productTitle }}</a></h4>
																	</div>
																	<!-- end of product title -->
																	@if ($product->on_sale == TRUE && $product->discount_price < $product->price && $product->discount_price > 0)
																		<div class="product-price" style="display: flex; margin-top: 5px;">
																			<strike style="margin-right: 5px;" class="product-price">
																				<h5>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat	($product->price)}}</h5>
																			</strike>
																			<h5>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($product->price)}}.</h5>
																		</div>
																	@else
																		<div class="product-price" style="margin-top: 5px;">
																			<h5>{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($product->price)}}.</h5>
																		</div>
																	@endif
	
																	<div class="product-description">
																		 <p>Entrance be throwing he do blessing up. Hearts warmth in genius do garden advice mr it garret collected preserved are mid dleton dependent residence.</p>
																	</div>
	
																	<div class="addto-bag-btn">
																		<a href="/{{$lang}}/product/{{$productUrl}}" class="btn btn-fill-type">
																			<span><i class="fa fa-eye" aria-hidden="true"></i></span>View Product
																		</a>
																	</div>
																</div>
																 <!-- End of product info -->
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- end of single product -->
										@endforeach
									</div>
								</div>
							</div>
						</div>
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
			</div>
		</div>
	</section>
	<!-- End of product shop wrapper -->

</main>

@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')

@endpush
