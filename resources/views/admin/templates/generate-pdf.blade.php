<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');

.container{
  font-family: 'Open Sans', sans-serif;
  border: 1px solid #f2f2f2;
  width: 800px;
  padding: 60px;
}
.section-1{
  display: flex;
  align-items: stretch;
}
.block-1, .block-2{
  flex-grow: 5;
}
.block-1 img{
  margin-top: 20px
}
.section-1 .block-2{
  text-align: right;
}
.section-1 .block-2 h4{
  text-transform: uppercase;
  font-weight: 700;
  color: #ba122b;
  font-size: 25px;
  padding: 0;
  margin: 0;
}
.section-1 .block-2 h6{
  margin: 10px 0px;
  font-size: 16px;
}
.section-2{
  display: flex;
  align-items: stretch;
  margin: 35px 0px;
  padding: 20px 0px;
  border-top: 1px solid #f2f2f2;
  border-bottom: 1px solid #f2f2f2;
}
.section-2 .block-1 p, .section-2 .block-2 p{
  font-weight: 400;
  line-height: 28px;
  margin-top: 30px;
  margin: 0;
}
.section-2 .block-1 h5, .section-2 .block-2 h5{
  text-transform: uppercase;
  font-size: 16px;
  margin: 0;
  margin-bottom: 15px;
}
.section-2 .block-2{
  text-align: right;
}
table{
  width: 100%;
}
.row-table{
  width: 100%;
}
.row-table .col{
  font-weight: 600;
  text-align: left;
  font-weight: 600;
  border-bottom: 1px solid #f2f2f2;
  padding: 10px;
  font-size: 14px;
}
.section-3{
  margin-top: 50px;
}
.section-3 .table{
  width: 40%;
  text-align: left;
  margin-left: auto;
  background-color: f2f2f2;
  padding: 20px;
}
.total-box .total-block{
  padding: 8px 0px;
}
</style>

<div class="container row">

<div class="section-1">
  <div class="block-1">
    <a href="https://oneclod.com"><img src="{{ asset('/web-assets/img/logo.png') }}" alt="OneClod"></a>
  </div>
  <div class="block-2">
    <h4>INVOICE</h4>
    <h6># {{ $order->order_number }}</h6>
    <h6><span>Invoice Date :</span> {{ substr($order->created_at, 0, -9) }}</h6>
  </div>
</div>

<div class="section-2">
  <div class="block-1">
    <h5>Invoice from :</h5>
    <p>CA&RE s.r.l,<br> P.IVA: 02825780907 - ITALIA,<br>test@camixyre.it.</p>
  </div>
  <div class="block-2">
    <h5>Invoice to :</h5>
    <p>{{$order->customer_apartment}},<br> {{$order->customer_street}},<br> {{$order->customer_country}}, {{$order->customer_zip}}.</p>
  </div>
</div>

<div class="block-full">
    <table class="table-bordered">
      <thead>
        <tr class="row-table">
            <th class="col">Product</th>
            <th class="col">Variations</th>
            <th class="col">Product SKU</th>
            <th class="col">Price</th>
            <th class="col">Quantity</th>
            <th class="col">VAT <small>(Tax)</small></th>
            <th class="col">Total</th>
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
                      <tr class="row-table">
                          <th class="col">{{ $product->title_en }}</th>
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
                          <th class="col">
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
                          <th class="col">{{$product->product_sku}}</th>
                          <th class="col">
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
                          <th class="col">{{ $cart->quantity }}</th>
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
                          <th class="col">
                              {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getVatRate($grandTotal)}}
                          </th>
                          <th class="col">
                              {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormatAdmin($singleTotal, $taxRegion)}}
                          </th>
                      </tr>
                    @endif
            @endforeach
        @endforeach
      </tbody>
    </table>
</div>

<div class="section-3">
  <div class="table">
    <table>
        <tbody>
          <tr class="total-box">
            <td class="total-block">Total Items</td>
            <td class="total-block">{{ count($cartIdsList) }}</td>
          </tr>
          <tr class="total-box">
            <td class="total-block">TAX <small>(Vat)</small></td>
            <td class="total-block">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getVatRate($grandTotal)}}</td>
          </tr>
          <tr class="total-box">
            <td class="total-block">Total Amount <small>(Include Vat)</small></td>
            <td class="total-block">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($grandTotal)}}</td>
          </tr>
          <tr class="total-box" style="color: #ba122b;font-weight: bold;">
            <td class="total-block">Payment Made</td>
            <td class="total-block">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($grandTotal)}}</td>
          </tr>
        </tbody>
    </table>
  </div>
</div>

</div>