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
                        <div class="page-title-heading"><h1 class="h2">Cart List<span>Shopping</span></h1></div>
                        <ul class="list-unstyled mb-0">
                            <li><a href="/{{$lang}}/home">{{ __('common.home') }}</a></li>
                            <li><a href="/{{$lang}}/shop">{{ __('common.shop') }}</a></li>
                            <li class="active"><a href="">{{ __('common.cart') }}</a></li>
                        </ul>
                    </div>
                    <!-- End of page title inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- End of page title -->

    @if (!empty($cartList[0]))
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <!-- woocommerce -->
                    <div class="woocommerce">
                        <form action="{{route('cart.update', $lang)}}" method="POST" class="woocommerce-cart-form">
                            @csrf
                            <!-- cart product wrap -->
                            <div class="cart-product-wrap">
                                <!-- cart table -->
                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                    <tbody>
                                        <!-- first table row -->
                                        <tr>
                                            <td class="product-name">
                                                {{ __('common.product') }}
                                            </td>
                                            <td class="">
                                                Variations
                                            </td>
                                            <td class="product-quantity">
                                                Price/Unit
                                            </td>
                                            <td class="product-quantity">
                                                Quantity
                                            </td>
                                            <td class="product-subtotal">
                                                Total Price
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <!-- End of first table row -->
                                        <!-- tr -->
                                        @php $grandTotal = 0; @endphp
                                        @foreach ($cartList as $cart)
                                            @php $num = 0; @endphp
                                                @foreach ($cartProducts as $product)
                                                    @if ($product->id == $cart->product_id)
                                                    <tr class="woocommerce-cart-form__cart-item cart_item">
                                                        @if($authUser = Auth::user())
                                                            @php $userID = $authUser->id; @endphp
                                                        @else
                                                            @php $userID = Cookie::get('guestUser'); @endphp
                                                        @endif

                                                        <input type="hidden" name="user-id[]" value="{{ $userID }}" autocomplete="off">
                                                        <input type="hidden" name="cart-product-id[]" value="{{$cart->id}}"  autocomplete="off">
                                                        <!-- product thumbnail -->
                                                        <td class="product-thumbnail">
                                                            <div class="product-details">
                                                                <a href="/{{$lang}}/product/{{$cartProducts}}" class="porduct-image-wrap">
                                                                    <img src="{{ asset('media/'.$product->featured_image) }}" class="img-responsive" alt="{{ __('common.product_image') }}" style="width: 100%;">
                                                                </a>
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
                                                                <a href="/{{$lang}}/product/{{$cartProducts}}">{{$productTitle}}</a>
                                                            </div>
                                                        </td>
                                                        <!-- End of product thumbnail -->
                                                        <td>
                                                            @php $incPrice = 0.00; @endphp
                                                            @if ($cart->product_attributes != "default")
                                                                @foreach ($cartAttributes as $attribute)
                                                                    @php $arrtIds = explode('|', $cart->product_attributes); @endphp
                                                                    @foreach ($arrtIds as $attrId)
                                                                        @if($attribute->id == $attrId)
                                                                            @switch($lang)
                                                                                @case("en")
                                                                                    @php $attrName = $attribute->name_en; @endphp
                                                                                    @break
                                                                                @case("it")
                                                                                    @php $attrName = (empty($attribute->name_it)) ? $attribute->name_it : $attribute->name_it; @endphp
                                                                                    @break
                                                                                @case("fr")
                                                                                    @php $attrName = (empty($attribute->name_fr)) ? $attribute->name_it : $attribute->name_fr; @endphp
                                                                                    @break
                                                                                @case("es")
                                                                                    @php $attrName = (empty($attribute->name_es)) ? $attribute->name_it : $attribute->name_es; @endphp
                                                                                    @break
                                                                                @case("de")
                                                                                    @php $attrName = (empty($attribute->name_de)) ? $attribute->name_it : $attribute->name_de; @endphp
                                                                                    @break
                                                                                @default
                                                                                    @php $attrName = $attribute->name_en;  @endphp
                                                                            @endswitch
                                                                            {{ $attrName }}<br>
                                                                            @php $incPrice += $attribute->price; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php 
                                                                $discountPrice = $product->discount_price;
                                                                $normalPrice   = $product->price;
                                                            @endphp
                                                            @if ($product->on_sale == TRUE && $discountPrice < $normalPrice && $discountPrice > 0)
                                                                <span class="price discount">
                                                                    {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($discountPrice + $incPrice)}}
                                                                </span>
                                                            @else
                                                                <span class="price">
                                                                    {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($normalPrice + $incPrice)}}
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="product-quantity">
                                                                <span class="minus"><img src="/web-assets/img/icons/minus.svg" class="svg" alt=""></span>
                                                                <input type="text" class="product-quantity-list"  name="product-quantity[]" min="0" max="1000" value="{{$cart->quantity}}">
                                                                <span class="plus"><img src="/web-assets/img/icons/plus.svg" class="svg" alt=""></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="totalprice">
                                                                @php $totalPrice = $cart->product_price * $cart->quantity; @endphp
                                                                    @php 
                                                                        $discountPrice = $product->discount_price;
                                                                        $normalPrice   = $product->price;
                                                                    @endphp
                                                                    @if ($product->on_sale == TRUE && $discountPrice < $normalPrice && $discountPrice > 0)
                                                                        <span class="price discount">
                                                                            @php $grandTotal += ($discountPrice + $incPrice) * $cart->quantity; @endphp
                                                                            {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat(($discountPrice + $incPrice) * $cart->quantity)}}
                                                                        </span>
                                                                    @else
                                                                        <span class="price">
                                                                            @php $grandTotal += ($normalPrice + $incPrice) * $cart->quantity; @endphp
                                                                            {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat(($normalPrice + $incPrice) * $cart->quantity)}}
                                                                        </span>
                                                                    @endif
                                                            </span>
                                                        </td>
                                                        <!-- product remove -->
                                                        <td class="product-remove">
                                                            <div class="remover-field">
                                                                <a href="{{route('cart.destroy', [$lang, $cart->id])}}">
                                                                    <img src="/web-assets/img/icons/remove.svg" class='svg' alt="">
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <!--End of  product remove -->
                                                    </tr>
                                                    <!--End of tr -->
                                                    @endif
                                                @php $num++; @endphp
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--End of cart table -->
                                <div class="cart-bottom-wrap">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-5">
                                            <div class="btn-cupon-wrap">
                                                <!-- cart shoping button  -->
                                                <div class="cart-shoping-button">
                                                    <button class="update-cart-btn btn btn-fill-type" type="submit" name="update"><img src="/web-assets/img/icons/update.svg" class="svg" alt=""> {{ __('common.update_cart') }}</button>
                                                    <a href="/{{$lang}}/shop" class="update-cart-btn btn btn-fill-type">Continue Shopping</a>
                                                </div>
                                                <!-- End of cart shoping button  -->
                                            </div>
                                        </div>
                                        <div class="offset-lg-2 col-lg-4 col-md-12">
                                            <!-- shop total wrap -->
                                            <div class="shop-total-wrap">
                                                <table class="shop_table shop_table_responsive">
                                                    <tbody>
                                                        <tr class="cart-subtotal">
                                                            <th>
                                                                Total Items: 
                                                            </th>
                                                            <td style="text-align: center;">
                                                                {{count($cartList)}}
                                                            </td>
                                                        </tr>
                                                        <tr class="cart-subtotal">
                                                            <th>
                                                                Total VAT:
                                                            </th>
                                                            <td>
                                                                {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getVatRate($grandTotal)}}
                                                            </td>
                                                        </tr>
                                                        <tr class="order-total">
                                                            <th>
                                                                Grand Total:
                                                            </th>
                                                            <td>
                                                                <span class="woocommerce-Price-amount amount">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($grandTotal)}}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="wc-proceed-to-checkout">
                                                    @if (Auth::user())
                                                        <a href="/{{$lang}}/checkout" class="update-cart-btn btn btn-fill-type" >{{ __('common.checkout') }}</a>
                                                    @else
                                                        <a href="/{{$lang}}/checkout" class="update-cart-btn btn btn-fill-type" >{{ __('common.checkout_as_guest') }}</a>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <!-- End of shop total wrap -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- cart product wrap -->
                        </form>
                    </div>
                    <!-- woocommerce -->
                </div>
            </div>
        </div>        
    </section>
    @else
        <h2 class="margin_bottom_150 text-center des-font">{{ __('common.cart_is_empty') }}</h2>
    @endif
        
</main>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('web-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('web-assets/js/starrr.js') }}"></script>
    <script src="{{ asset('web-assets/js/image-picker.min.js') }}"></script>
    <script src="{{ asset('web-assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('web-assets/js/function-select-custom.js') }}"></script>
	<script src="{{ asset('web-assets/js/function-input-number.js') }}"></script>
@endpush

@push('custom-scripts')

@endpush