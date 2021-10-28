@extends('layouts.master')

{{-- CSS For Specific Page --}}
@push('plugin-styles')
	<link href="{{ asset('web-assets/plugins/owl-carousel/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="{{ asset('web-assets/plugins/Magnific-Popup/magnific-popup.css') }}" rel="stylesheet">
	<link href="{{ asset('web-assets/plugins/swiper/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web-assets/css/starrr.css') }}" rel="stylesheet" />
    <link href="{{ asset('web-assets/css/image-picker.css') }}" rel="stylesheet" />
@endpush

<!-- Main Content Start -->
@section('content')

<main>

	@switch($lang)
		@case("en")
			@php $productTitle = $product->title_en; @endphp
			@break
		@case("it")
			@php $productTitle = (empty($product->title_it)) ? $product->title_en : $product->title_it; @endphp
			@break
		@case("fr")
			@php $productTitle = (empty($product->title_fr)) ? $product->title_en : $product->title_fr; @endphp
			@break
		@case("es")
			@php $productTitle = (empty($product->title_es)) ? $product->title_en : $product->title_es; @endphp
			@break
		@case("de")
			@php $productTitle = (empty($product->title_de)) ? $product->title_en : $product->title_de; @endphp
			@break
		@default
			@php $productTitle = $product->title_en; @endphp
	@endswitch

	<!-- page title -->
    <section class="page-title-inner" data-bg-img='/web-assets/img/page-titlebg.png'>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- page title inner -->
                    <div class="page-title-wrap">
                        <div class="page-title-heading"><h1 class="h2">Single Product<span>Shopping</span></h1></div>
                        <ul class="list-unstyled mb-0">
                            <li><a href="/{{$lang}}/home">home</a></li>
                            <li><a href="/{{$lang}}/shop">{{ __('common.shop') }}</a></li>
                            <li class="active"><a href="">Single Product</a></li>
                        </ul>
                    </div>
                    <!-- End of page title inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- End of page title -->

	@php
		$imagesArray = explode("|", $product->images_gallery);
		unset($imagesArray[count($imagesArray)-1]);
	@endphp
	<!-- product details wrapper -->
    <section class="pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					@foreach($variations as $key => $variation)
						@if($variation->key == $product->variations_key)
							@php $gallery = 0; @endphp
							@foreach($attributes as $key => $attribute)
								@if($attribute->variation_box_id == $variation->variation_id)
            		        		<!-- Start shop product slider -->
            		        		<div class="shop-product-slider-wrap" @if($gallery == 0) style="" @else style="display: none;" @endif>
            		        		    <!-- Start shop slider top side -->
            		        		     <div class="swiper-container product-gallery">
            		        		        <div class="swiper-wrapper">
												@php
													$imageList = explode("|", $attribute->images);
													$imageList = array_filter($imageList);
												@endphp
												@php $num = 0; @endphp
												@foreach ($imageList as $image)
													@if($num == 0)
            		        		            		<div class="swiper-slide">
            		        		            		    <img id="zoom_01" class='' src="{{ asset("media/".$image) }}" data-zoom-image="{{ asset("media/".$image) }}" alt=""/>
            		        		            		</div>
													@else
														<div class="swiper-slide">
															<img id="zoom_02" class='' src="{{ asset("media/".$image) }}" data-zoom-image="{{ asset("media/".$image) }}" alt=""/>
														</div>
													@endif
													@php $num++; @endphp
												@endforeach
            		        		        </div>
            		        		    </div>
            		        		     <!-- End of shop slider top side -->

										<div class="swiper-container product-thumbs">
											<div class="swiper-wrapper">
												@php
													$imageList = explode("|", $attribute->images);
													$imageList = array_filter($imageList);
												@endphp
												@php $num = 0; @endphp
												@foreach ($imageList as $image)
													@if($num == 0)
													<div class="swiper-slide">
														<img src="{{ asset("media/".$product->featured_image) }}" class="" alt="">
													</div>
													@endif
													@php $num++; @endphp
												@endforeach
											</div>
										</div>
									</div>
								@endif
							@php $gallery++; @endphp
							@endforeach
						@endif
					@endforeach
					<div class="shop-product-slider-wrap">
						<!-- Start shop slider bottom side -->
						@if (empty($variations[0]))
							<div class="swiper-container product-gallery">
            		    	    <div class="swiper-wrapper">
            		    	        <div class="swiper-slide">
            		    	            <img id="zoom_01" class='' src="{{ asset("media/".$product->featured_image) }}" data-zoom-image="{{ asset("media/".$product->featured_image) }}" alt=""/>
            		    	        </div>
									@foreach($imagesArray as $key => $image)
            		    	        <div class="swiper-slide">
            		    	            <img id="zoom_02" class='' src="{{ asset("media/".$image) }}" data-zoom-image="{{ asset("media/".$image) }}" alt=""/>
            		    	        </div>
									@endforeach
            		    	    </div>
            		    	</div>

							<div class="swiper-container product-thumbs">
            		    	    <div class="swiper-wrapper">
            		    	        <div class="swiper-slide">
										<img src="{{ asset("media/".$product->featured_image) }}" class="" alt="">
            		    	        </div>
									@foreach($imagesArray as $key => $image)
            		    	        <div class="swiper-slide">
            		    	            <img src="{{ asset("media/".$image) }}" data-rjs="2" alt="">
            		    	        </div>
									@endforeach
            		    	    </div>
            		    	</div>
						@endif
            		    <!-- End of shop slider bottom side -->

            		</div>
                    <!-- End of shop product slider -->
                </div>

                <div class="col-md-6">
                    <!-- product details inner -->
                    <div class="product-details-inner">
                        <!-- product info -->
                        <div class="product-info">
							@if (count($reviews) > 0)
                            <div class="product-rating">
                                <div class="star-rating">
									@foreach ($reviews as $review)
										@php $blank = ""; @endphp
										@for ($num = 1; $num <= 5; $num++)
											@if ($review->rating >= $num)
												<i class="fa fa-star"></i>
											@else
												<i class="fa fa-star-o"></i>
											@endif
										@endfor
									@endforeach
                                </div>
                            </div>
							@endif

                            <!-- product title -->
                            <div class="product-title">
                                <h2>{{ $productTitle }}</h2>
                            </div>
							<p class="margin_bottom_10 margin_top_20"><strong>{{ __('common.all_prices_include_vat') }}</strong></p>
                            <!-- end of product title -->
							@php
								$discountPrice = $product->discount_price;
								$normalPrice   = $product->price;
							@endphp
							@if ($product->on_sale == TRUE && $discountPrice < $normalPrice && $discountPrice > 0)
								<div class="product-price">
									<h3 class="new-price">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($discountPrice)}}</h3>
									<h5 class="old-price">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($normalPrice)}}</h5>
								</div>
							@else
								<div class="product-price">
									<h3 class="new-price">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($normalPrice)}}</h3>
								</div>
							@endif

                             <div class="product-description">
								@switch($lang)
									@case("en")
										@php $productShortDesc = $product->short_description_en; @endphp
										@break
									@case("it")
										@php $productShortDesc = (empty($product->short_description_it)) ? $product->short_description_en : $product->short_description_it; @endphp
										@break
									@case("fr")
										@php $productShortDesc = (empty($product->short_description_fr)) ? $product->short_description_en : $product->short_description_fr; @endphp
										@break
									@case("es")
										@php $productShortDesc = (empty($product->short_description_es)) ? $product->short_description_en : $product->short_description_es; @endphp
										@break
									@case("de")
										@php $productShortDesc = (empty($product->short_description_de)) ? $product->short_description_en : $product->short_description_de; @endphp
										@break
									@default
										@php $productShortDesc = $product->title_en; @endphp
								@endswitch
                                <p>{{ $productShortDesc }}</p>
                             </div>


							{{-- Add To Cart Form --}}
							<form method="POST" action="{{route('cart.store', $lang)}}" class="inline-block icon-addcart">
							@csrf

								{{-- Variations --}}
								@php $num = 0; @endphp
								@foreach($variations as $key => $variation)
								@if($variation->key == $product->variations_key)
								<div class="margin_bottom_30">
									<div class="margin_bottom_10">
										@foreach($attributes as $key => $attribute)
											@if($attribute->variation_box_id == $variation->variation_id)
												<strong>{{ $attribute->name_en }}</strong>,
											@endif
										@endforeach
									</div>
									<select id="variation{{ $num }}" class="menu-font product-options change-variations" name="variation-selection-ids[]" autocomplete="off" required>
										{{-- <option class="uppercase" value="" selected>{{ __('common.please_select_a') }} {{ $variation->type }}</option> --}}
										@php $num = 0; @endphp
										@foreach($attributes as $key => $attribute)
										@if($attribute->variation_box_id == $variation->variation_id)
											@switch($lang)
												@case("en")
													@php $attributeName = $attribute->name_en; @endphp
													@break
												@case("it")
													@php $attributeName = (empty($attribute->name_it)) ? $attribute->name_en : $attribute->name_it; @endphp
													@break
												@case("fr")
													@php $attributeName = (empty($attribute->name_fr)) ? $attribute->name_en : $attribute->name_fr; @endphp
													@break
												@case("es")
													@php $attributeName = (empty($attribute->name_es)) ? $attribute->name_en : $attribute->name_es; @endphp
													@break
												@case("de")
													@php $attributeName = (empty($attribute->name_de)) ? $attribute->name_en : $attribute->name_de; @endphp
													@break
												@default
													@php $attributeName = $attribute->name_en; @endphp
											@endswitch
											@php
												$featuredImage = explode('|', $attribute->images);
											@endphp
											<option class="capital"
													value="{{ $attribute->id }}"
													data-attr-name="{{ $attribute->name_en }}"
													data-attr-images="{{ $attribute->images }}"
													data-attr-price="{{ $attribute->price }}"
													data-img-src='/media/{{ $featuredImage[0] }}'
													@if($num == 0)
														{{ 'selected' }}
													@endif
													>
													{{ $attributeName }} + {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($attribute->price)}}
											</option>
											@php $num++; @endphp
										@endif
										@endforeach
									</select>
								</div>
								@php $num++; @endphp
								@endif
								@endforeach


								@if($authUser = Auth::user())
									@php $userID = $authUser->id; @endphp
								@else
									@php $userID = Cookie::get('guestUser'); @endphp
								@endif

								<input type="hidden" name="user-id" value="{{ $userID }}" autocomplete="off">
								<input type="hidden" name="product-url" value="{{ URL::current() }}" autocomplete="off">
								<input type="hidden" name="product-id" value="{{ $product->id }}" autocomplete="off">
								<input type="hidden" name="product-name" value="{{ $product->title_en }}" autocomplete="off">
								<input type="hidden" name="product-code" value="{{ $product->product_code }}" autocomplete="off">
								<input type="hidden" name="product-sku" value="{{ $product->product_sku }}" autocomplete="off">
								<input id="cart-variation" type="hidden" name="product-attributes" value="default" autocomplete="off">
								<input type="hidden" name="product-quantity" value="1">
                            	<!-- product details btns -->
                            	<div class="product-details-btns">
                                	<div class="addto-bag-btn">
                                	    <button class="btn btn-fill-type" type="submit" name="add">
                                	        <span class="float-left"><img src="/web-assets/img/icons/add-bag.svg" alt="" class="svg"></span>
											<span class="d-none float-right d-lg-block mr-0">Add To Cart</span>
                                	    </button>
                                	</div>
                                	<div class="wish-btn">
                                	    <a href="{{ route('wishlist.add', [$lang, $product->id]) }}" class="btn btn-fill-type">
                                	        <span class="" style="margin-right: 0px;"><img src="/web-assets/img/icons/wishlist.svg" alt="" class="svg"></span>
                                	    </a>
                                	</div>
                            	</div>
                            	<!-- product details btns -->
							</form>
							{{-- End Add to Cart Form --}}

                            <!-- product mata -->
                            <div class="product_meta item-product-meta-info">
                                <span class="sku_wrapper">
                                    <label>
                                        <b>SKU:</b>
                                    	<span>@if (empty($product->product_sku))
												N/A
											@else
												{{ $product->product_sku }}
											@endif
										</span>
                                    </label>
                                </span>
                            </div>
                            <!-- End of product mata -->

                        </div>
                         <!-- End of product info -->
                    </div>
                    <!-- End of product details inner -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- product details tab -->
                    <div class="product-details-tab-inner">
                        <div class="product-details-nav">
                            <nav class="nav text-center">
                                <a id="nav-dis-tab" data-toggle="tab" href="#dis" class="active">Description</a>
                                <a id="nav-faq-tab" data-toggle="tab" href="#Shipping">Shipping and Returns</a>
                                <a id="nav-revc-tab" data-toggle="tab" href="#revc">Reviews</a>
                            </nav>
                        </div>
                    </div>
                    <!-- End of product details tab -->
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- product details tab Contaent-->
                            <div class="tab-content single-product-tab">
								@switch($lang)
									@case("en")
										@php
											$productDesc = $product->description_en;
											$productShip = $product->shipping_delivery_en;
										@endphp
										@break
									@case("it")
										@php
											$productDesc = (empty($product->description_it)) ? $product->description_en : $product->description_it;
											$productShip = (empty($product->shipping_delivery_it)) ? $product->shipping_delivery_en : $product->shipping_delivery_it;
										@endphp
										@break
									@case("fr")
										@php
											$productDesc = (empty($product->description_fr)) ? $product->description_en : $product->description_fr;
											$productShip = (empty($product->shipping_delivery_fr)) ? $product->shipping_delivery_en : $product->shipping_delivery_fr;
										@endphp
										@break
									@case("es")
										@php
											$productDesc = (empty($product->description_es)) ? $product->description_en : $product->description_es;
											$productShip = (empty($product->shipping_delivery_es)) ? $product->shipping_delivery_en : $product->shipping_delivery_es;
										@endphp
										@break
									@case("de")
										@php
											$productDesc = (empty($product->description_de)) ? $product->description_en : $product->description_de;
											$productShip = (empty($product->shipping_delivery_de)) ? $product->shipping_delivery_en : $product->shipping_delivery_de;
										@endphp
										@break
									@default
										@php
											$productDesc = $product->description_en;
											$productShip = $product->shipping_delivery_en;
										@endphp
								@endswitch
                                <div class="tab-pane fade show active" id="dis" role="tabpanel" aria-labelledby="nav-dis-tab">
                                    <!-- description inner -->
                                    <div class="description-inner">
                                        {!! $productDesc !!}
                                    </div>
                                    <!-- End of description inner -->
                                </div>
                                <div class="tab-pane fade" id="Shipping" role="tabpanel" aria-labelledby="nav-faq-tab">
                                    <!-- faq inner area -->
                                    <div class="faq-content-wrap">
                                        {!! $productShip !!}
                                    </div>
                                    <!-- End of faq inner area -->
                                </div>
                                <div class="tab-pane fade" id="revc" role="tabpanel" aria-labelledby="nav-revc-tab">
                                    <div class="review-author-wrap">
                                        <!-- review author -->
                                    <div class="review-author-inner">
                                        <ul class="author-list mb-0 list-unstyled">
											@if (count($reviews) < 1)
												<p class="des-font content-review">{{ __('common.there_are_no') }}</p>
											@else
												@foreach ($reviews as $review)
												<li class="media align-items-center">
													<div class="review-author-details flex-1 media-body">
														<h6>{{ $review->name }}</h6>
														<!-- star reating -->
														<div class="product-rating">
															<div class="star-rating">
																@php $blank = ""; @endphp
																@for ($num = 1; $num <= 5; $num++)
																	@if ($review->rating >= $num)
																		<i class="fa fa-star"></i>
																	@else
																		<i class="fa fa-star-o"></i>
																	@endif
																@endfor
															</div>
														</div>
														<!--End of star reating -->
														<p>{{ $review->message }}</p>
													</div>
												</li>
												@endforeach
											@endif
                                        </ul>
                                    </div>
                                    <!-- End of review author -->

                                    <!-- review author comment -->
                                    <div class="review-author-comment">
                                        <div class="review-comment-heading">
                                            <h4>Add a Review</h4>
                                        </div>
                                        <h6 class="lato">Rate It:</h6>
										<form method="POST" action="{{ route('submit-review', $lang) }}">
										@csrf
                                        <!-- star reating -->
                                        <div class="product-rating">
                                            <div class="star-rating">
                                                <span></span>
                                            </div>
                                        </div>
                                        <!--End of star reating -->

                                        <!-- comment input field -->
                                        <div class="comment-respond form-relative">
											<input id='star-input' type='hidden' name='rating' value='0'>
                                            <input type="text" name="message" placeholder="Your Comment" required class="theme-input-style">
                                            <button type="submit" class="btn btn-fill-type">Submit</button>
                                        </div>
                                        <!--End of comment input field -->
                                       	</form>

                                    </div>
                                    <!-- End of review author comment -->
                                    </div>
                                </div>
                            </div>
                            <!--End of product details tab Contaent-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of product details wrapper -->

</main>
@endsection

@push('plugin-scripts')
	<script src="{{ asset('web-assets/js/slick.min.js') }}"></script>
	<script src="{{ asset('web-assets/js/starrr.js') }}"></script>
	<script src="{{ asset('web-assets/js/image-picker.min.js') }}"></script>
	<script src="{{ asset('web-assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
@endpush

@push('custom-scripts')
	<script>

		// Product Gallery
		setTimeout(function(){
			$(".product-gallery").hide();
			$(".product-gallery").first().show();
		}, 300);

		// Image Picker
		$("select").imagepicker()

		// Hide Variation Price
		$('#variation-price').hide();

		// Variations Data Change
		$('.change-variations').change(function(){
			const attrPriceAll    = $('.change-variations');
            const attributeImages = $(this).children(":selected").attr('data-attr-images');
            const attributePrice  = $(this).children(":selected").attr('data-attr-price');
            const attributeId     = this.value;

			if(typeof attributeImages == "undefined"){
              location.reload();
            }

			// Default Prices
			const normalPrice   = "{{App\Helpers\CurrencyHelper::getSetPriceFormat($normalPrice)}}";
			const discountPrice = "{{App\Helpers\CurrencyHelper::getSetPriceFormat($discountPrice)}}";

			// Get Arrtibute Prices
			let attrPrice = 0;
			$.each(attrPriceAll, function(variation, elem) {
				let getAttrPrice = $('#variation'+variation).children(":selected").attr('data-attr-price');
				// console.log(getAttrPrice);
				if(typeof getAttrPrice === "undefined"){
					getAttrPrice = 0;
					attrPrice += parseFloat(getAttrPrice);
				} else {
					attrPrice += parseFloat(getAttrPrice);
				}
			});

			// Change Normal Price
			let changeNormalPrice = parseFloat(normalPrice) + attrPrice;
			changeNormalPrice = changeNormalPrice.toFixed(2);
			changeNormalPrice = changeNormalPrice.toString();
			changeNormalPrice = changeNormalPrice.replace(".", ",");
			$('#normal-price').text(changeNormalPrice);

			// Change Discount Price
			let changeDiscountPrice = parseFloat(discountPrice) + attrPrice;
			changeDiscountPrice = changeDiscountPrice.toFixed(2);
			changeDiscountPrice = changeDiscountPrice.toString();
			changeDiscountPrice = changeDiscountPrice.replace(".", ",");
			$('#discount-price').text(changeDiscountPrice);

			// Change Images
			$(".product-gallery").hide();
			$("#gallery-"+attributeId).show();
			$('.slick-prev').click();
			$('.featured-image').click();
			$('.images-gallery').click();

            // let newImages = attributeImages.split('|');
            // newImages     = newImages.filter(item => item);

            // const imageStructureSide = (src) => `<div class="images-gallery"><img src="/media/${src}" class="img-responsive" alt="Product image"></div>`;
            // const imageStructureFull = (src) => `<div class="images-gallery"><img src="/media/${src}" class="img-responsive full-width" alt="Product image"></div>`;
			//
            // const imagesAdd = (item, index) => {
			// 	if(index == 0)
			// 	{
			// 		document.getElementById('side-images').innerHTML = imageStructureSide(item);
            // 		document.getElementById('full-images').innerHTML = imageStructureFull(item);
			// 	}
			// 	else
			// 	{
			// 		$('#side-images').slick('slickAdd', imageStructureSide(item));
			// 		$('#full-images').slick('slickAdd', imageStructureFull(item));
			// 		$('#side-images').slick('refresh');
			// 		$('#full-images').slick('refresh');
			// 	}
            // }

            // newImages.forEach(imagesAdd);
        });

		// Review Stars
		let ratingNum = $('#star-input');
		$('#rating-stars').starrr({
			max: 5,
			rating: ratingNum.val(),
			change: function(e, value){
				ratingNum.val(value).trigger('input');
			}
		});

		// Anchor Back To Top Disable
		if (location.hash){
		setTimeout(function(){
				window.scrollTo(0, 0);
			}, 1);
		}

	</script>
@endpush
