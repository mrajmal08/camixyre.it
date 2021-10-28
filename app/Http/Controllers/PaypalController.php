<?php

namespace App\Http\Controllers;

use App\Helpers\PaymentGatewayBladeCreationHelper;
use Illuminate\Support\Facades\Validator;
use App\Helpers\PayPalSdkHelper;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\PayPal;
use DB;

class PaypalController extends Controller
{
    public function index()
    {
        $meta_title     = "PayPal Settings";
        $paypalSettings = DB::table('paypal_settings')->first();
        $adminInfo      = DB::table('admins')->first();

        if(is_null($paypalSettings)):
            abort(403, 'PayPal settings not found!');
        endif;

        return view('admin.pages.payments.paypal', compact('meta_title', 'paypalSettings', 'adminInfo'));
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paypal_smart_environment'       => ['required', Rule::in(['sandbox', 'production'])],
            'paypal_smart_sandbox_client'    => ['nullable', 'string'],
            'paypal_smart_production_client' => ['nullable', 'string'],
            'paypal_smart_sandbox_secret'    => ['nullable', 'string'],
            'paypal_smart_production_secret' => ['nullable', 'string'],
        ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        $paypalSettings = PayPal::first();

        if(is_null($paypalSettings)):
            abort(403, 'PayPal Settings not found!');
        endif;

        $paypalSettings->fill($request->all());
        $paypalSettings->save();

        PaymentGatewayBladeCreationHelper::createPaypalSmartBladeFile();

        return redirect()->back()->with('message', 'The PayPal Settings has been updated successfully!');
    }

    public static function createOrderPayPal(Request $request) // Insert Order into Checkout and Get Order Number to submit the request...
    {
        $settings = DB::table('settings')->first();
        if(is_null($settings)):
            return null;
        endif;

        if($settings->currency != $request->currency):
            return null;
        endif;

        $clientDetails = [
            "first_name" => $request->first_name,
            "last_name"  => $request->last_name,
            "phone"      => $request->phone,
            "street"     => $request->street,
            "apartment"  => $request->apartment,
            "city"       => $request->city,
            "country"    => $request->country,
            "state"      => $request->state,
            "zip"        => $request->zip,
        ];

        return PayPalSdkHelper::createOrder($request->currency, $clientDetails);
    }

    public function captureOrderPayPal(Request $request, $lang, $orderId)
    {
        return PayPalSdkHelper::captureOrder($orderId);
    }
}
