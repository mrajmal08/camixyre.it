@extends('layouts.master')

{{-- CSS For Specific Page --}}
@push('plugin-styles')
    <link href="{{ asset('web-assets/css/starrr.css') }}" rel="stylesheet" />
@endpush

<!-- Main Content Start -->
@section('content')

<!-- page title -->
<section class="page-title-inner" data-bg-img='assets/img/page-titlebg.png'>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- page title inner -->
                <div class="page-title-wrap">
                    <div class="page-title-heading"><h1 class="h2">View Order<span>Shopping</span></h1></div>
                    <ul class="list-unstyled mb-0">
                        <li><a href="/{{$lang}}/home">home</a></li>
                        <li class="active"><a href="#">View Order</a></li>
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
                <div id="London" class="tabcontent">
                    <h2>Order Details</h2>
                    <hr>
                    <div class="row margin_top_20 order-details">
                        <div class="col-md-3">
                            <p>Order number:</p>
                            <p><b>{{ $orderDetails->order_number }}</b></p>
                        </div>
                        <div class="col-md-3">
                            <p>Date:</p>
                            <p><b>{{ substr($orderDetails->created_at, 0, -9) }}</b></p>
                        </div>
                        <div class="col-md-3">
                            <p>Order Status:</p>
                            <p><b>{{ $orderDetails->order_status }}</b></p>
                        </div>
                        <div class="col-md-3">
                            <p>Payment Method:</p>
                            <p><b>{{ $orderDetails->payment_type }} @if ($orderDetails->payment_type == "COD") {!! '<small>(Cash On Delivery)</small>' !!} @endif</b></p>
                        </div>
                    </div>
                    <hr><h4 class="uppercase">Order Details</h4><hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>PRODUCT</th>
                                <th>Variations</th>
                                <th class="checkout-quantity">QUANTITY</th>
                                <th class="checkout-price">SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $shippingTotal = 0;
                                $grandTotal    = 0;
                            @endphp
                            @foreach ($cartIdsList as $cart)
                                @php $num = 0; @endphp
                                @foreach ($productsList as $product)
                                    @if ($product->id == $cart->product_id)
                                    <tr class="item_cart">
                                        
                                        @if($authUser = Auth::user())
                                            @php $userID = $authUser->id; @endphp
                                        @else
                                            @php $userID = Cookie::get('guestUser'); @endphp
                                        @endif
                                        
                                        <td class="product-desc">
                                            <div class="product-info">
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
                                                <a href="/{{$lang}}/product/{{$productUrl}}" class="title-font link-default">{{$productTitle}}</a>
                                                <p class="number-font margin_top_10">SKU: 
                                                    <span class="menu-child-font">
                                                        @php echo((empty($cart->product_sku)) ? "N/A" : $cart->product_sku); @endphp
                                                    </span>
                                                </p>
                                            </div>
                                        </td>

                                        <td class="product-desc">
                                            <div class="product-info">
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
                                            </div>
                                        </td>
            
                                        <td class="checkout-quantity">
                                            x{{$cart->quantity}} 
                                        </td>
            
                                        <td class="checkout-price">
                                            @php $totalPrice = $cart->product_price * $cart->quantity; @endphp
                                            <p class="price number-font">
                                                @php
                                                    $shippingTotal += $product->shipping_price;
                                                    $discountPrice = $product->discount_price;
                                                    $normalPrice   = $product->price;
                                                @endphp
                                                @if ($product->on_sale == TRUE && $discountPrice < $normalPrice && $discountPrice > 0)
                                                    <p class="number-font price-product">
                                                        <span class="price discount">
                                                            @php $grandTotal += ($discountPrice + $incPrice) * $cart->quantity; @endphp
                                                            {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat(($discountPrice + $incPrice) * $cart->quantity)}}
                                                        </span>
                                                    </p>
                                                @else
                                                    <p class="number-font price-product">
                                                        <span class="price">
                                                            @php $grandTotal += ($normalPrice + $incPrice) * $cart->quantity; @endphp
                                                            {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat(($normalPrice + $incPrice) * $cart->quantity)}}
                                                        </span>
                                                    </p>
                                                @endif
                                            </p>
                                        </td>
                                        
                                    </tr>
                                    @endif
                                    @php $num++; @endphp
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="tank-you-total">
                        <div class="row">
                            <div class="col-md-6">
                                <label>SHIPPING</label>
                            </div>
                            <div class="col-md-6">
                                <label class="right">
                                    {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormatNormal($shippingTotal)}}
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>TOTAL VAT <small>(Tax)</small></label>
                            </div>
                            <div class="col-md-6">
                                <label class="right">
                                    {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getVatRate($grandTotal)}}
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="row total-amount">
                            <div class="col-md-6">
                                <label>TOTAL AMOUNT <small>(Include Tax)</small></label>
                            </div>
                            <div class="col-md-6">
                                <label class="right">
                                    {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($grandTotal)}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of product shop wrapper -->

@endsection

@push('plugin-scripts')
    <script src="{{ asset('web-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('web-assets/js/starrr.js') }}"></script>
@endpush

@push('custom-scripts')

@endpush
