@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('css/asaldi-style.css') }}" rel="stylesheet" />
@endpush

@section('content')
  
  <div class="col-12 pl-0">
    <h4 id="vertical">Order Details</h4>
  </div>

  <div class="col-12 p-0 mt-3">
    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if(session()->has('message'))
      <div class="alert alert-success">
        {{session('message')}}
      </div>
    @endif
  </div>

  <div class="row">
    <div class="col-lg-12 col-xl-12 stretch-card mt-3 p-0">
      <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <h4 class="col-12 mb-3">Shipping Details</h4>
                        <div class="col-4 mt-3">
                            <p><b>Order Number:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">#{{$order->order_number}}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>Client Name:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">{{$order->customer_name}}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>Client Email:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">{{$order->user_email}}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>Client Number:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">{{$order->customer_phone}}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>Country:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">{{$order->customer_country}}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>City:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">{{$order->customer_city}}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>State:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">{{$order->customer_state}}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>Zip / Postal:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">{{$order->customer_zip}}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>House No / Street:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">{{$order->customer_street}}</p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>Apartment / Address:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">{{$order->customer_apartment}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pl-5 pr-5">
                    <div class="row">
                        <h4 class="col-12 mb-3">Order Info</h4>
                        <div class="col-4 mt-3">
                            <p><b>Payment Method:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">
                                @if ($order->payment_type == "PayPal")
                                    {!! '<span class="badge badge-primary">PayPal</span>' !!}
                                @elseif ($order->payment_type == "Bank Transfer")
                                    {!! '<span class="badge badge-info">Bank Transfer</span>' !!}
                                @elseif ($order->payment_type == "COD")
                                    {!! '<span class="badge badge-warning">Cash On Delivery</span>' !!}
                                @endif
                            </p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>Order Tax Region:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">
                                @if ($order->site_region == "en")
                                    {!! '<span class="badge badge-light">Global</span>' !!}
                                @elseif ($order->site_region == "it")
                                    {!! '<span class="badge badge-light">Italy</span>' !!}
                                @elseif ($order->site_region == "fr")
                                    {!! '<span class="badge badge-light">France</span>' !!}
                                @elseif ($order->site_region == "es")
                                    {!! '<span class="badge badge-light">Spanish</span>' !!}
                                @elseif ($order->site_region == "de")
                                    {!! '<span class="badge badge-light">German</span>' !!}
                                @endif
                            </p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>Status:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">
                                @if($order->order_status == "pending")
                                <span class='badge badge-info'>Pending</span>
                                @elseif($order->order_status == "shipped")
                                <span class='badge badge-primary'>Shipped</span>
                                @elseif($order->order_status == "completed")
                                <span class='badge badge-success'>Completed</span>
                                @elseif($order->order_status == "canceled")
                                <span class='badge badge-warning'>Canceled</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-4 mt-3">
                            <p><b>Order Date:</b></p>
                        </div>
                        <div class="col-8 mt-3">
                            <p class="ml-4">{{$order->created_at}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="status-update">
                        <label>Update Order Status</label>
                        <form action="{{route('order.update', $order->id, $order->site_region)}}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
                            <select id="orderStatus" name="status">
                                <option value="pending" @if($order->order_status == "pending") {{'selected'}} @endif>Pending</option>
                                <option value="shipped" @if($order->order_status == "shipped") {{'selected'}} @endif>Shipped</option>
                                <option value="completed" @if($order->order_status == "completed") {{'selected'}} @endif>Completed</option>
                                <option value="canceled" @if($order->order_status == "canceled") {{'selected'}} @endif>Canceled</option>
                            </select>
                            <div id="addTracking"></div>
                            <button class="btn btn-primary mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-9 col-xl-9 stretch-card pl-0 mt-3">
      <div class="card">
        <div class="card-body">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Link</th>
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
                                            @if ($order->site_region == "en")
                                                @php $taxRegion = "UK" @endphp
                                                <th><a href="/en/product/{{ $product->url_en }}" target="_blank">View Product</a></th>
                                            @elseif ($order->site_region == "it")
                                                @php $taxRegion = "IT" @endphp
                                                <th><a href="/it/product/{{ $product->url_it }}" target="_blank">View Product</a></th>
                                            @elseif ($order->site_region == "fr")
                                                @php $taxRegion = "FR" @endphp
                                                <th><a href="/fr/product/{{ $product->url_fr }}" target="_blank">View Product</a></th>
                                            @elseif ($order->site_region == "es")
                                                @php $taxRegion = "ES" @endphp
                                                <th><a href="/es/product/{{ $product->url_es }}" target="_blank">View Product</a></th>
                                            @elseif ($order->site_region == "de")
                                                @php $taxRegion = "DE" @endphp
                                                <th><a href="/de/product/{{ $product->url_de }}" target="_blank">View Product</a></th>
                                            @endif
                                            <th>{{ $product->title_en }}</th>
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
      </div>
    </div>
                
    <div class="col-lg-3 col-xl-3 col-md-3 total-order-box mt-3 p-4">
        <div class="row">
            <p class="col-8"><strong>Total Items</strong></p>
            <p class="col-4 text-right">{{ count($cartIdsList) }}</p>
        </div>
        <hr>
        <div class="row">
            <p class="col-8"><strong>Total Vat <br> <small>(Charged According To Country)</small></strong></p>
            <p class="col-4 text-right">{{$currencySymbol}}{{App\Helpers\CurrencyHelper::getVatRate($grandTotal)}}</p>
        </div>
        <hr>
        <div class="row">
            <p class="col-8"><strong>Total Amount <br> <small>(Include Vat)</small></strong></p>
            <p class="col-4 text-right">
                {{$currencySymbol}}{{App\Helpers\CurrencyHelper::getSetPriceFormat($grandTotal)}}
            </p>
        </div>
    </div>

  </div>
  
@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')
    <script>
        let changeStatus = document.getElementById('orderStatus');
        var trackingDiv  = document.getElementById('addTracking');
        changeStatus.addEventListener("change", function(){
            if(changeStatus.value == "shipped")
            {
                trackingDiv.innerHTML = `
                    <input class="form-control mt-2" type="text" name="courier-name" placeholder="Add Courier Name" required>
                    <input class="form-control mt-2" type="text" name="tracking-number" placeholder="Add Tracking Number" required>
                `;
            }
            else
            {
                trackingDiv.innerHTML = "";
            }
        });
    </script>
@endpush