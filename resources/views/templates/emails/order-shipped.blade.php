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

<div class="row" style="width:800px; margin: auto;">
    <div class="thank-you-box" style="text-align: center;">
        <h2 class="title" style="border: 1px dashed #ba122b;text-transform: uppercase;padding: 20px 30px;font-size: 22px;color: #ba122b; width: 100%;">{{ __('common.order_shipped') }}</h2>
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
                <p><b>{{ __('common.shipped') }}</b></p>
            </div>
            <div class="col-md-3" style="width:25%; border-right: none;">
                <p>{{ __('common.payment_method') }}:</p>
                <p><b>{{ $order_details->payment_type }} @if ($order_details->payment_type == "COD") {!!  __('common.cod') !!} @endif</b></p>
            </div>
        </div>
        <hr style="border-top: 1px solid #eee; margin-top: 20px;margin-bottom: 20px;"><h4 class="uppercase" style="color: #ba122b;width: 100%;text-align: center;">{{ __('common.courier') }}</h4><hr style="border-top: 1px solid #eee; margin-top: 20px;margin-bottom: 20px;">
        <table class="table" style="width: 100%;text-align: left;margin-bottom: 20px;">
            <thead>
                <tr>
                    <th>{{ __('common.courier_na') }}</th>
                    <th>{{ __('common.tracking') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $courier_name }}</td>
                    <td>{{ $tracking_number }}r</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
    
</body>
</html>