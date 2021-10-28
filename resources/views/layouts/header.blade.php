{{-- HEADER --}}
<header class="header">
	<div class="main-header-wraper main-header">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-6 col-sm-6 col-md-3 col-lg-2 col-xl-3">
					<div class="logo-container">
						<!-- Logo -->
						<div class="logo">
							<a href="/{{$lang}}/home">
								<img class='default-logo' src="/web-assets/img/logo.png" alt="Camixyre">
								<img class='sticky-logo' src="/web-assets/img/logo.png" alt="Camixyre">
							</a>
						</div>
						<!-- End of Logo -->
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-6 col-lg-7 col-xl-6">
					<!-- menu container -->
					<div class="menu-container">
						<div class="menu-wraper">
							<nav>
								<!-- Header-menu -->
								<div class="header-menu dosis">
									<div id="menu-button">
									</div>
									<ul id="header-ul">
										<li class="header-li active"><a href="/{{$lang}}/home">Home</a></li>
										<li class="header-li"><a href="/{{$lang}}/shop">Shop</a></li>
										<li class="header-li"><a href="/{{$lang}}/blog">Blog</a></li>
									</ul>
								</div>

								<!-- End of Header-menu -->
							</nav>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-3 top-order">
					<!-- modal menu -->
					<div class="modal-menu-container">
						<div class="dropdown" style="display: inline;right: 20px;">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<a href="#">
								<img src="{{ asset('web-assets/img/flags/'.__('common.lang_code').'.png') }}" class="margin_right_05" alt=""> {{__('common.lang')}}
							</a>
						  </button>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
							@if (isset($slug))
								@php $urlSlug = $slug; @endphp
							@else
								@php $urlSlug = ""; @endphp
							@endif
							<ul class="clear-space capital lv1 lang">
								@php
								$language   = __('common.lang');
								$hideEnLang = 'style="display: block;"';
								$hideItLang = 'style="display: block;"';
								$hideFrLang = 'style="display: block;"';
								$hideEsLang = 'style="display: block;"';
								$hideDeLang = 'style="display: block;"';
								switch($language):
									case 'English':
										$hideEnLang = 'style="display: none"';
										break;
									case 'Italian':
										$hideItLang = 'style="display: none"';
										break;
									case 'French':
										$hideFrLang = 'style="display: none"';
										break;
									case 'Spanish':
										$hideEsLang = 'style="display: none"';
										break;
									case 'German':
										$hideDeLang = 'style="display: none"';
										break;
									default:
								endswitch;
								@endphp
								<li {!! $hideEnLang !!}>
									<a href="{{ route('homepage', 'en') }}">
										<img src="{{ asset('/web-assets/img/flags/en.png') }}" alt="EN"> {{ __('common.en') }}
									</a>
								</li>
								<li {!! $hideItLang !!}>
									<a href="{{ route('homepage', 'it') }}">
										<img src="{{ asset('/web-assets/img/flags/it.png') }}" alt="IT"> {{ __('common.it') }}
									</a>
								</li>
								<li {!! $hideFrLang !!}>
									<a href="{{ route('homepage', 'fr') }}">
										<img src="{{ asset('/web-assets/img/flags/fr.png') }}" alt="FR"> {{ __('common.fr') }}
									</a>
								</li>
								<li {!! $hideEsLang !!}>
									<a href="{{ route('homepage', 'es') }}">
										<img src="{{ asset('/web-assets/img/flags/es.png') }}" alt="ES"> {{ __('common.es') }}
									</a>
								</li>
								<li {!! $hideDeLang !!}>
									<a href="{{ route('homepage', 'de') }}">
										<img src="{{ asset('/web-assets/img/flags/de.png') }}" alt="DE"> {{ __('common.de') }}
									</a>
								</li>
							</ul>
						  </div>
						</div>
						<ul class="list-unstyled mb-0">
							<li>
								<div class="search-btn" title="search">
									<a href="#">
										<img src="/web-assets/img/icons/search-button.svg" alt="" class="svg">
									</a>
								</div>
							</li>
							<li>
								<div class="cart-btn" title="Cart list">
									<div class="cart-no">{{ count($cartList) }}</div>
									<a href="#">
										<img src="/web-assets/img/icons/add-bag.svg" alt="" class="svg">
									</a>
								</div>
							</li>
							<li>
								<div class="" title="Wish list">
									<div class="wishlist-no">{{ count($wishlist) }}</div>
									<a href="/{{$lang}}/wishlist">
										<img src="/web-assets/img/icons/wishlist.svg" alt="" class="svg">
									</a>
								</div>
							</li>
							<li>
								@if(Auth::user())
								<div class="" title="account list">
									<a href="/{{ $lang }}/dashboard/profile">
										<img src="/web-assets/img/icons/account.svg" alt="" class="svg">
									</a>
								</div>
								@else
								<div class="account-btn" title="account list">
									<a href="/{{ $lang }}/dashboard/profile">
										<img src="/web-assets/img/icons/account.svg" alt="" class="svg">
									</a>
								</div>
								@endif
							</li>
						</ul>
					</div>
					<!-- End of modal menu -->
				</div>
			</div>
		</div>
	</div>
</header>

    <!-- offcanvas overlay -->
    <div class="offcanvas-overlay"></div>
    <!-- offcanvas overlay -->

    <!-- offcanvas mainmenu -->
        <div class="offcanvas offcanvas-mainmenu">
            <div class="offcanvas-cancel">
                <img src="/web-assets/img/icons/close-button.svg" class="svg" alt="">
            </div>
            <ul>
                <li class="active"><a href="/{{$lang}}/home">Home</a></li>
                <li><a href="/{{$lang}}/shop">Shop</a></li>
                <li><a href="/{{$lang}}/blog">Blog</a></li>
            </ul>
        </div>
    <!-- offcanvas mainmenu -->

	<!-- Catagory menu -->
	<div class="slidenav catagory-menu">
		<div class="menu-navigation">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<div class="catagory-menu-header d-flex  align-items-center">
							<div class="logo">

							</div>
							<div class="menu-cancel">
								<img src="/web-assets/img/icons/close-button.svg" class="svg" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<h2 class="mb-60">What are you Searching for?</h2>
						<div class="search-bar primary-form parsley-validate">
							<form method="POST" action="{{ route('search.products', $lang) }}" role="search">
								@csrf
								<input type="text" class="theme-input-style" value="" autocomplete="off" placeholder="Type Your Search Here" aria-label="SEARCH" name="search">
								<input type="submit" class="search-icon" value="&#xF002;">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Catagory menu -->
    
    <!-- cart list -->
    <div class="offcanvas offcanvas-cart-list">
        <div class="offcanvas-head">
            <div class="head-text">
                <img src="/web-assets/img/icons/add-bag2.svg" class="svg" alt="">
                <h3>Cart List</h3>
            </div>
            <div class="offcanvas-cancel">
                <img src="/web-assets/img/icons/close-button.svg" class="svg" alt="">
            </div>
        </div>
        
        <div class="offcanvas-inner">
            <div class="added-cart-list">
				@if(count($cartList) < 1)
					<div class="empty-cart" style="text-align: center;">
						<h3>{{ __('common.no_products_in_the_cart') }}</h3>
					</div>
				@else
               		<!-- single cart list --> 
               		<div class="single-added-list">
						@foreach ($cartList as $cart)
            			    @foreach ($cartProducts as $product)
            			        @if ($product->id == $cart->product_id)
								<div class="single-item-left media align-items-center">
										<div>
											<img src="{{ asset('media/'.$product->featured_image) }}" alt="product image">
										</div>
										<div>
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
											<div class="single-item-details midea-body">
												<h5><a href="/{{$lang}}/product/{{$productUrl}}">{{$productTitle}}</a></h5>
											</div>
											<p>SKU: 
												<span>
													@php echo((empty($cart->product_sku)) ? "N/A" : $cart->product_sku); @endphp
												</span>
											</p>
										</div>
									</div>
								@endif
							@endforeach
						@endforeach
                	</div>
                	<!-- End of single cart list -->
				@endif
            </div>
            
            <!-- add to button an support -->
            <div class="view-cart-check-btn text-center">
                <a href="/{{$lang}}/cart" class='btn btn-fill-type'>View Cart List</a>
                <a href="/{{$lang}}/checkout" class='btn btn-fill-type'>Check Out</a>
            </div>
            <!-- add to button an support -->
        </div>
    </div>
    <!-- End of cart list -->

    <!-- log in and register -->
    <div class="offcanvas offcanvas-account">
            <div class="offcanvas-head">
                <div class="head-text">
                    <img src="/web-assets/img/icons/account2.svg" class="svg" alt="">
                    <h3>Account</h3>
                </div>
                <div class="offcanvas-cancel">
                    <img src="/web-assets/img/icons/close-button.svg" class="svg" alt="">
                </div>
            </div>
            
            <div class="offcanvas-inner">
                <!-- login register -->
                <div class="login-register-wrap">
                    <!-- login register nav -->
                    <div class="login-register-nav">
                        <nav class="nav lr-nav text-center">
                            <a id="nav-login-tab" data-toggle="tab" href="#login" class="active">Log In</a>
                            <a id="nav-register-tab" data-toggle="tab" href="#reg">Register</a>
                        </nav>
                    </div>
                    <!-- End of login register nav -->
    
                    <!-- login register content -->
                    <div class="login-register-content tab-content">
                        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="nav-login-tab">
                            <div class="primary-form parsley-validate">
                                <form method="POST" action="{{ route('login') }}">
									@csrf
                                    <!-- loging input -->
                                    <div class="name-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/account3.svg" class="svg" alt="">
                                        </label>
                                        <input id="email" type="text" name="email" placeholder='User name / Email Address' class="theme-input-style  @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
										@error('email')
                            			    <span class="invalid-feedback" role="alert">
                            			        <strong>{{ $message }}</strong>
                            			    </span>
                            			@enderror
                                    </div>
    
                                    <div class="password-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/regi-icon.svg" class="svg" alt="">
                                        </label>
                                        <input id="password" name="password" type="password" placeholder='password' class="theme-input-style @error('password') is-invalid @enderror" required autocomplete="current-password">
										@error('password')
                            			    <span class="invalid-feedback" role="alert">
                            			        <strong>{{ $message }}</strong>
                            			    </span>
                            			@enderror
                                    </div>
                                    <!-- loging input -->
                                    <button type="submit" class="btn btn-fill-type">log In</button>
                                </form>
                            </div>
                        </div>
    
                        <div class="tab-pane fade" id="reg" role="tabpanel" aria-labelledby="nav-login-tab">
                            <div class="primary-form parsley-validate">
                                <form method="POST" action="{{ route('register') }}">
									@csrf
                                    <!-- register input -->
                                    <div class="name-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/account-icon.svg" class="svg" alt="">
                                        </label>
                                        <input id="name" type="text" placeholder='Name' class="theme-input-style @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    </div>
									@error('name')
                            		    <span class="invalid-feedback" role="alert">
                            		        <strong>{{ $message }}</strong>
                            		    </span>
                            		@enderror
                                    
                                    <div class="email-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/email-icon.svg" class="svg" alt="">
                                        </label>
                                        <input id="email" type="email" placeholder='Email Address' class="theme-input-style @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    </div>
									@error('email')
                            		    <span class="invalid-feedback" role="alert">
                            		        <strong>{{ $message }}</strong>
                            		    </span>
                            		@enderror
    
                                    <div class="password-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/regi-icon.svg" class="svg" alt="">
                                        </label>
                                        <input id="password" type="password" placeholder='{{ __('common.password') }}' class="theme-input-style @error('password') is-invalid @enderror" name="password"  required autocomplete="new-password">
                                    </div>
									@error('password')
                            		    <span class="invalid-feedback" role="alert">
                            		        <strong>{{ $message }}</strong>
                            		    </span>
                            		@enderror
                                    
									<div class="password-input input-field">
                                        <label>
                                            <img src="/web-assets/img/icons/regi-icon.svg" class="svg" alt="">
                                        </label>
                                        <input id="password-confirm" type="password" name="password_confirmation" placeholder='{{ __('common.confirm_password') }}*' class="theme-input-style" required>
                                    </div>
                                    <!-- register input -->
                                    <button type="submit" class="btn btn-fill-type">{{ __('common.register') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of login register content -->
                </div>
                <!-- End of login register -->
            </div>
    </div>
    <!-- End of log in and ragister -->

    <!-- End of offcanvas menu-->

{{-- LOGIN, REGISTER, PROFILE LINKS CODE --}}
{{-- <ul>
	@if(Auth::user())
		<li>
			<a href="/{{$lang}}/dashboard/profile"><i class="fa fa-user-circle"></i> {{ __('common.profile') }}</a>
		</li>
		<li>
			<a href="/{{$lang}}/dashboard/orders"><i class="fa fa-shopping-bag"></i> {{ __('common.orders') }}</a>
		</li>
		<li>
			<a href="{{ route('logout.user', $lang) }}"><i class="fa fa-sign-out"></i> {{ __('common.logout') }}</a>
		</li>
	@else
		<li>
			<a href="/{{$lang}}/login"><i class="fa fa-sign-in"></i> {{ __('common.login_register') }}</a>
		</li>
	@endif
</ul> --}}

{{-- CART COUNT CODE --}}