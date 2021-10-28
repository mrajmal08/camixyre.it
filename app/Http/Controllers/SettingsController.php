<?php

namespace App\Http\Controllers;

use App\Helpers\PaymentGatewayBladeCreationHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Currency;
use File;
use DB;

class SettingsController extends Controller
{
    public function index()
    {
        $meta_title = "Payment Settings";
        $settings   = Settings::first();
        $currencies = Currency::orderBy('name', 'ASC')->get();
        $adminInfo  = DB::table('admins')->first();

        return view('admin.settings', compact('meta_title', 'settings', 'currencies', 'adminInfo'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'currency'                    => ['required', 'string', 'exists:currencies,name'],
            'use_integer_prices'          => ['required', 'boolean'],
            'use_currency_symbol'         => ['required', 'boolean'],
            'comma_is_decimal_separator'  => ['required', 'boolean'],
            'enable_braintree'            => ['required', 'boolean'],
            'enable_paypal_in_bt'         => ['required', 'boolean'],
            'enable_stripe'               => ['required', 'boolean'],
            'enable_paypal_smart'         => ['required', 'boolean'],
            'enable_pp_smart_card'        => ['required', 'boolean'],
            'enable_pp_smart_credit'      => ['required', 'boolean'],
            'enable_pp_smart_bancontact'  => ['required', 'boolean'],
            'enable_pp_smart_blik'        => ['required', 'boolean'],
            'enable_pp_smart_eps'         => ['required', 'boolean'],
            'enable_pp_smart_giropay'     => ['required', 'boolean'],
            'enable_pp_smart_ideal'       => ['required', 'boolean'],
            'enable_pp_smart_mercadopago' => ['required', 'boolean'],
            'enable_pp_smart_mybank'      => ['required', 'boolean'],
            'enable_pp_smart_p24'         => ['required', 'boolean'],
            'enable_pp_smart_sepa'        => ['required', 'boolean'],
            'enable_pp_smart_sofort'      => ['required', 'boolean'],
            'enable_pp_smart_venmo'       => ['required', 'boolean'],
            'enable_bank_transfer'        => ['required', 'boolean'],
            'enable_cod'                  => ['required', 'boolean'],
        ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        if(($request->enable_braintree) && ($request->enable_paypal_in_bt) && ($request->enable_paypal_smart)):
            return redirect()->back()->withInput()->with('error-message', 'The PayPal Smart Buttons cannot be enabled if PayPal is also enabled within Braintree!');
        endif;

        if((!$request->enable_braintree) && (!$request->enable_stripe) && (!$request->enable_paypal_smart)):
            return redirect()->back()->withInput()->with('error-message', 'At least one payment gateway must be enabled!');
        endif;

        $settings = Settings::first();

        if(is_null($settings)):
            abort(403, 'Settings not found!');
        endif;

        $settings->fill($request->all());
        $settings->save();

        if($request->enable_braintree):
            PaymentGatewayBladeCreationHelper::createBraintreeBladeFile($request->enable_paypal_in_bt);
        endif;

        if($request->enable_paypal_smart):
            PaymentGatewayBladeCreationHelper::createPaypalSmartBladeFile();
        endif;

        return redirect()->back()->with('message', 'The Payment Management Settings have been successfully updated!');
    }
}
