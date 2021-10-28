<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thanks</title>
    <link href="{{ asset('web-assets/css/app.css') }}" rel="stylesheet">
</head>
<body>

@php $totalAmount = 0; @endphp

<div class="row" style="width:800px; margin: auto;">
    <div class="thank-you-box" style="text-align: center;">
        <h2 class="title" style="border: 1px dashed #ba122b;text-transform: uppercase;padding: 20px 30px;font-size: 22px;color: #ba122b; width: 100%;">{{ __('common.thank_you') }}</h2>
        <div class="row margin_top_20 order-details" style="margin-top: 20px; display: flex;">
            <div class="col-md-3" style="width:25%; border-right: 1px solid rgba(119,119,119,0.2);">
                <p>{{ __('common.order_no') }}:</p>
                <p><b>{{ $order_details->order_number }}</b></p>
            </div>
            <div class="col-md-3" style="width:25%; border-right: 1px solid rgba(119,119,119,0.2);">
                <p>{{ __('common.date') }}:</p>
                <p><b>{{ substr($order_details->created_at, 0, -9) }}</b></p>
            </div>
            <div class="col-md-3" style="width:25%; border-right: 1px solid rgba(119,119,119,0.2);">
                <p>{{ __('common.order_status') }}:</p>
                <p><b>{{ __('common.submitted') }}</b></p>
            </div>
            <div class="col-md-3" style="width:25%; border-right: none;">
                <p>{{ __('common.payment_method') }}:</p>
                <p><b>{{ $order_details->payment_type }} @if ($order_details->payment_type == "COD") {!!  __('common.cod') !!} @endif</b></p>
            </div>
        </div>
        <hr style="border-top: 1px solid #eee; margin-top: 20px;margin-bottom: 20px;"><h4 class="uppercase" style="color: #ba122b;width: 100%;text-align: center;">{{ __('common.order_details') }}</h4><hr style="border-top: 1px solid #eee; margin-top: 20px;margin-bottom: 20px;">
        <table class="table" style="width: 100%;text-align: left;margin-bottom: 20px;">
            <thead>
                <tr>
                    <th>{{ __('common.product') }}</th>
                    <th>{{ __('common.variations') }}</th>
                    <th class="checkout-quantity">{{ __('common.quantity') }}</th>
                    <th class="checkout-price">{{ __('common.subtotal') }}</th>
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
                                        @foreach ($attributesList as $attribute)
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
        <hr style="border-top: 1px solid #eee; margin-top: 20px;margin-bottom: 20px;">
        <div class="tank-you-total" style="width: 100%;text-align: left;">
            <div class="row" style="display: flex;">
                <div class="col-md-6" style="width: 50%;">
                    <label>{{ __('common.quantity') }}</label>
                </div>
                <div class="col-md-6" style="width: 50%; text-align: right;">
                    <label class="right">
                        {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormatNormal($shippingTotal)}}
                    </label>
                </div>
            </div>
            <div class="row" style="display: flex;">
                <div class="col-md-6" style="width: 50%;">
                    <label>{!! __('common.total_vat_tax') !!}</label>
                </div>
                <div class="col-md-6" style="width: 50%; text-align: right;">
                    <label class="right">
                        {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getVatRate($grandTotal)}}
                    </label>
                </div>
            </div>
            <hr style="border-top: 1px solid #eee; margin-top: 20px;margin-bottom: 20px;">
            <div class="row total-amount" style="display: flex;">
                <div class="col-md-6" style="width: 50%;">
                    <label>{!! __('common.total_amount_tax') !!}</label>
                </div>
                <div class="col-md-6" style="width: 50%; text-align: right;">
                    <label class="right">
                        {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($grandTotal)}}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>