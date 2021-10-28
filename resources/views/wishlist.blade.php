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
                        <div class="page-title-heading"><h1 class="h2">Wish List<span>Shopping</span></h1></div>
                        <ul class="list-unstyled mb-0">
                            <li><a href="/{{$lang}}/home">home</a></li>
                            <li class="active">Wish List</li>
                        </ul>
                    </div>
                    <!-- End of page title inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- End of page title -->

    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <!-- woocommerce -->
                    <div class="woocommerce">
                        @if (!empty($wishlist[0]))
                        <form action="{{route('cart.update', $lang)}}" method="POST" class="woocommerce-cart-form">
                            @csrf
                            <!-- cart product wrap -->
                            <div class="cart-product-wrap wish-table-content">
                                <!-- shope table -->
                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                    <tbody>
                                        <!-- first table row -->
                                        <tr>
                                            <td class="product-name">
                                                Product name
                                            </td>
                                            <td class="stock-status">
                                                SKU
                                            </td>

                                            <td class="product-quantity">
                                                View
                                            </td>

                                            <td class="product-subtotal">
                                                Delete
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <!-- End of first table row -->
                                        @foreach ($wishlist as $list)
                                            @foreach ($products as $product)
                                                @if ($product->id == $list->product_id)
                                                <!-- tr -->
                                                <tr class="woocommerce-cart-form__cart-item cart_item">
                                                    <!-- product thumbnail -->
                                                    <td class="product-thumbnail">
                                                        <div class="product-details">
                                                            <a href="#" class="porduct-image-wrap">
                                                                <img src="{{ asset('media/'.$product->featured_image) }}" alt="">
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
                                                            <a href="/{{$lang}}/product/{{$productUrl}}">{{$productTitle}}</a>
                                                        </div>
                                                    </td>
                                                    <!-- End of product thumbnail -->
                                                    <td class="instock">SKU: @php echo((empty($cart->product_sku)) ? "N/A" : $cart->product_sku); @endphp</td>
                                                    <td>
                                                        <a href="/{{$lang}}/product/{{$productUrl}}" class="btn btn-fill-type">
                                                            View Product
                                                        </a>
                                                    </td>

                                                    <!-- product remove -->
                                                    <td class="product-remove">
                                                        <div class="remover-field">
                                                            <a href="{{route('wishlist.destroy', [$lang, $list->id])}}">
                                                                <img src="/web-assets/img/icons/remove.svg" class='svg' alt="">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <!--End of  product remove -->
                                                </tr>
                                                <!--End of tr -->
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--End of cart table -->
                            </div>
                            <!-- cart product wrap -->
                        </form>
                        @else
                            <h2 class="margin_bottom_150 text-center des-font">{{ __('common.your_wishlist_is_empty') }}</h2>
                        @endif
                    </div>
                    <!-- woocommerce -->
                </div>
            </div>
        </div>        
    </section>
        
</main>
@endsection

@push('plugin-scripts')
	<script src="{{ asset('web-assets/js/slick.min.js') }}"></script>
	<script src="{{ asset('web-assets/js/function-select-custom.js') }}"></script>
	<script src="{{ asset('web-assets/js/function-input-number.js') }}"></script>
@endpush

@push('custom-scripts')

@endpush