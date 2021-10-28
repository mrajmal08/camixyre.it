@extends('admin.layouts.master')

@push('plugin-styles')

@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Special pages</a></li>
    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="container-fluid d-flex justify-content-between">
          <div class="col-lg-3 pl-0">
            <a href="#" class="noble-ui-logo logo-light d-block mt-3">Camixyre</a>
            <p>CA&RE s.r.l,<br> P.IVA: 02825780907  - ITALIA,<br>test@camixyre.it.</p>
            <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
            <p>{{$order->customer_apartment}},<br> {{$order->customer_street}},<br> {{$order->customer_country}}, {{$order->customer_zip}}.</p>
          </div>
          <div class="col-lg-3 pr-0">
            <h4 class="font-weight-medium text-uppercase text-right mt-4 mb-2">invoice</h4>
            <h6 class="text-right mb-5 pb-4"># {{ $order->order_number }}</h6>
            <h6 class="mb-0 mt-3 text-right font-weight-normal mb-2"><span class="text-muted">Invoice Date :</span> {{ substr($order->created_at, 0, -9) }}</h6>
          </div>
        </div>
        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
          <div class="table-responsive w-100">
              <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>Product</th>
                      <th>Variations</th>
                      <th>Product SKU</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>VAT <small>(Tax)</small></th>
                      <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                      $cartIds = explode('|', $order->cart_ids);
                      $grandTotal = 0;
                  @endphp
                  @foreach ($cartIdsList as $cart)
                      @foreach ($cartProducts as $product)
                              @if ($product->id == $cart->product_id)
                                <tr>
                                    <th>{{ $product->title_en }}</th>
                                    @if ($order->site_region == "en")
                                        @php $taxRegion = "UK" @endphp
                                    @elseif ($order->site_region == "it")
                                        @php $taxRegion = "IT" @endphp
                                    @elseif ($order->site_region == "fr")
                                        @php $taxRegion = "FR" @endphp
                                    @elseif ($order->site_region == "es")
                                        @php $taxRegion = "ES" @endphp
                                    @elseif ($order->site_region == "de")
                                        @php $taxRegion = "DE" @endphp
                                    @endif
                                    <th>
                                        @php $incPrice = 0.00; @endphp
                                        @if ($cart->product_attributes != "default")
                                            @foreach ($cartAttributes as $attribute)
                                                @php $arrtIds = explode('|', $cart->product_attributes); @endphp
                                                @foreach ($arrtIds as $attrId)
                                                    @if($attribute->id == $attrId)
                                                        {{ $attribute->name_en }}<br>
                                                        @php $incPrice += $attribute->price; @endphp
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </th>
                                    <th>{{$product->product_sku}}</th>
                                    <th>
                                        @php 
                                            $discountPrice = $product->discount_price;
                                            $normalPrice   = $product->price;
                                        @endphp
                                        @if ($product->on_sale == TRUE && $discountPrice < $normalPrice && $discountPrice > 0)
                                            {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormatNormal(($discountPrice + $incPrice) * $cart->quantity)}}
                                        @else
                                            {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormatNormal(($normalPrice + $incPrice) * $cart->quantity)}}
                                        @endif
                                    </th>
                                    <th>{{ $cart->quantity }}</th>
                                    @php
                                        $totalPrice    = $cart->product_price * $cart->quantity;
                                        $discountPrice = $product->discount_price;
                                        $normalPrice   = $product->price;
                                    @endphp
                                    @if ($product->on_sale == TRUE && $discountPrice < $normalPrice && $discountPrice > 0)
                                        @php $grandTotal += ($discountPrice + $incPrice) * $cart->quantity; @endphp
                                        @php $singleTotal = ($discountPrice + $incPrice) * $cart->quantity; @endphp
                                    @else
                                        @php $grandTotal += ($normalPrice + $incPrice) * $cart->quantity; @endphp
                                        @php $singleTotal = ($normalPrice + $incPrice) * $cart->quantity; @endphp
                                    @endif
                                    <th>
                                        {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getVatRate($grandTotal)}}
                                    </th>
                                    <th>
                                        {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormatAdmin($singleTotal, $taxRegion)}}
                                    </th>
                                </tr>
                              @endif
                      @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
        <div class="container-fluid mt-5 w-100">
          <div class="row">
            <div class="col-md-6 ml-auto">
                <div class="table-responsive">
                  <table class="table">
                      <tbody>
                        <tr>
                          <td>Total Items</td>
                          <td class="text-right">{{ count($cartIdsList) }}</td>
                        </tr>
                        <tr>
                          <td>TAX <small>(Vat)</small></td>
                          <td class="text-right">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getVatRate($grandTotal)}}</td>
                        </tr>
                        <tr>
                          <td class="text-bold-800">Total Amount <small>(Include Vat)</small></td>
                          <td class="text-bold-800 text-right">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($grandTotal)}}</td>
                        </tr>
                        <tr>
                          <td>Payment Made</td>
                          <td class="text-danger text-right">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($grandTotal)}}</td>
                        </tr>
                      </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
        <div class="container-fluid w-100">
          <a href="{{ route('generate.pdf', $order->order_number) }}" class="btn btn-outline-primary float-right mt-4"><i data-feather="printer" class="mr-2 icon-md"></i>Download PDF</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection