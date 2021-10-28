<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\OrderSubmitted;
use Illuminate\Support\Facades\Validator;
use App\Rules\OnlyAsciiCharacters;
use App\Helpers\OrderDataHelper;
use App\Helpers\CurrencyHelper;
use App\Models\Attributes;
use App\Models\UserOrders;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Country;
use App\Models\Cart;
use App\Models\Post;
use App\Models\Page;
// use Braintree;
use Session;
use Cookie;
use Auth;
use DB;

class CheckoutController extends Controller
{
    public function index($lang)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
            $email  = $authUser->email;
        else:
            $userID = Cookie::get('guestUser');
            $email = "";
        endif;

        $cartList       = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $countries      = Country::with('statesInOrder')->orderBy('name', 'ASC')->get();
        $blogPosts      = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $wishlist       = Wishlist::where('user_id', '=', $userID)->get();
        $cartProducts   = Product::all();
        $cartAttributes = Attributes::all();
        $footerPages    = Page::all();

        if(count($cartList) < 1):
            return redirect()->route('homepage', $lang);
        endif;

        $settings = DB::table('settings')->first();
        if(is_null($settings))
        {
            abort(403, 'Settings not found!');
        }

        $currencyCode        = $settings->currency;
        $currencySymbol      = CurrencyHelper::getCurrencyString();
        $braintreeEnabled    = $settings->enable_braintree;
        $stripeEnabled       = $settings->enable_stripe;
        $payPalSmartEnabled  = $settings->enable_paypal_smart;
        $bankTransferEnabled = $settings->enable_bank_transfer;
        $codEnabled          = $settings->enable_cod;

        $bankDetails = "";
        if($bankTransferEnabled)
        {
            $bankDetails = DB::table('bank_transfer_settings')->first();
            if(is_null($bankDetails))
            {
                abort(403, 'Bank Transfer settings not found!');
            }
        }

        $btToken = "";
        $brainTreeLabel = "Credit card by Braintree";
        if($braintreeEnabled)
        {
            $payPalWithinBraintreeEnabled = $settings->enable_paypal_in_bt;
            if($payPalWithinBraintreeEnabled)
            {
                $brainTreeLabel = "Credit Card and PayPal by Braintree";
            }

            $btSettings = DB::table('braintree_settings')->first();
            if(is_null($btSettings))
            {
                abort(403, 'Braintree settings not found!');
            }
            if( $btSettings->braintree_environment == 'sandbox' )
            {
                $gateway = new Braintree\Gateway([
                    'environment' => $btSettings->braintree_environment,
                    'merchantId'  => $btSettings->braintree_sandbox_merchant_id,
                    'publicKey'   => $btSettings->braintree_sandbox_public_key,
                    'privateKey'  => $btSettings->braintree_sandbox_private_key
                ]);
            }
            else
            {
                $gateway = new Braintree\Gateway([
                    'environment' => $btSettings->braintree_environment,
                    'merchantId'  => $btSettings->braintree_production_merchant_id,
                    'publicKey'   => $btSettings->braintree_production_public_key,
                    'privateKey'  => $btSettings->braintree_production_private_key
                ]);
            }

            $btToken = $gateway->ClientToken()->generate();
        }

        $stripePubKey = "";
        if($stripeEnabled)
        {
            $stripeSettings = DB::table('stripe_settings')->first();
            if(is_null($stripeSettings))
            {
                abort(403, 'Stripe settings not found!');
            }
            if($stripeSettings->stripe_environment == "test")
            {
                $stripePubKey = $stripeSettings->stripe_test_publishable_key;
            }
            else
            {
                $stripePubKey = $stripeSettings->stripe_live_publishable_key;
            }
        }

        return view('checkout', compact('countries', 'email', 'braintreeEnabled', 'stripeEnabled', 'payPalSmartEnabled', 'bankTransferEnabled', 'bankDetails', 'codEnabled', 'brainTreeLabel', 'btToken', 'stripePubKey', 'blogPosts', 'cartList', 'cartProducts', 'cartAttributes', 'wishlist', 'footerPages', 'currencySymbol', 'currencyCode', 'lang'));
    }

    public function prePaymentValidation(Request $request, $lang)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => ['required', 'string', 'max:191'],
            'last_name'     => ['required', 'string', 'max:191'],
            'email_address' => ['required', 'string', 'max:191'],
            'street'        => ['required', 'string', 'max:191'],
            'apartment'     => ['nullable', 'string', 'max:191'],
            'phone'         => ['nullable', 'string', 'max:191'],
            'city'          => ['required', 'string', 'max:191'],
            'state'         => ['required', 'string', 'exists:states,state_code'],
            'country'       => ['required', 'string', 'exists:countries,code'],
            'zip'           => ['required', 'string', 'max:150'],
        ]);

        if($validator->fails()):
            return response()->json($validator->errors());
        endif;

        return response()->json(['successful_validation' => 'success']);
    }

    public function fulfillOrder(Request $request, $lang)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;

        $cartList  = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();

        $cartIdsArray = array();

        foreach($cartList as $cart):

            // Create Cart Items ID List
            $cartIdsArray[] = $cart->id;

            // Update Cart Items Status
            Cart::where('id', '=', $cart->id)->update(['status' => 'order_submitted']);

        endforeach;

        $cartIds = implode("|", $cartIdsArray);

        $firstName     = $request->first_name;
        $lastName      = $request->last_name;
        $customerName  = $firstName . " " . $lastName;
        $email         = $request->email_address;
        $phone         = $request->phone;
        $street        = $request->street;
        $apartment     = $request->apartment;
        $city          = $request->city;
        $country       = $request->country;
        $state         = $request->state;
        $zip           = $request->zip;
        $city          = $request->city;
        $transactionId = $request->transaction_id;
        $paymentMethod = $request->payment_method;

        // Define Digits
        $digits = 4;
        
        // Generate Order Number
        $order_number = rand(pow(10, $digits-1), pow(10, $digits)-1);
        
        // Insert Order
        $cart = UserOrders::create([
            'user_id'            => $userID,
            'customer_name'      => $customerName,
            'user_email'         => $email,
            'transaction_id'     => $transactionId,
            'customer_street'    => $street,
            'customer_city'      => $city,
            'customer_zip'       => $zip,
            'customer_country'   => $country,
            'customer_apartment' => $apartment,
            'customer_state'     => $state,
            'customer_phone'     => $phone,
            'cart_ids'           => $cartIds,
            'payment_type'       => "PayPal",
            'order_status'       => "pending",
            'order_number'       => $order_number,
            'site_region'        => $lang,
        ]);

        return redirect()->route('thanks', [$lang, $order_number]);
    }

    public function paylaterOrder(Request $request, $lang)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'first_name'    => ['required', 'string', 'max:191'],
            'last_name'     => ['required', 'string', 'max:191'],
            'email_address' => ['required', 'string', 'max:191'],
            'street'        => ['required', 'string', 'max:191'],
            'apartment'     => ['nullable', 'string', 'max:191'],
            'phone'         => ['nullable', 'string', 'max:191'],
            'city'          => ['required', 'string', 'max:191'],
            'state'         => ['required', 'string', 'exists:states,state_code'],
            'country'       => ['required', 'string', 'exists:countries,code'],
            'zip'           => ['required', 'string', 'max:150'],
        ]);

        if($validator->fails()):
            return back()->withErrors($validator);
        endif;
        
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;

        $cartList  = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();

        $cartIdsArray = array();

        foreach($cartList as $cart):

            // Create Cart Items ID List
            $cartIdsArray[] = $cart->id;

            // Update Cart Items Status
            Cart::where('id', '=', $cart->id)->update(['status' => 'order_submitted']);

        endforeach;

        $cartIds = implode("|", $cartIdsArray);

        $firstName     = $request->first_name;
        $lastName      = $request->last_name;
        $customerName  = $firstName . " " . $lastName;
        $email         = $request->email_address;
        $phone         = $request->phone;
        $street        = $request->street;
        $apartment     = $request->apartment;
        $city          = $request->city;
        $country       = $request->country;
        $state         = $request->state;
        $zip           = $request->zip;
        $city          = $request->city;
        $paymentMethod = $request->payment_method;

        // Define Digits
        $digits = 4;
        
        // Generate Order Number
        $order_number = rand(pow(10, $digits-1), pow(10, $digits)-1);
        
        // Insert Order
        $cart = UserOrders::create([
            'user_id'            => $userID,
            'customer_name'      => $customerName,
            'user_email'         => $email,
            'transaction_id'     => $order_number,
            'customer_street'    => $street,
            'customer_city'      => $city,
            'customer_zip'       => $zip,
            'customer_country'   => $country,
            'customer_apartment' => $apartment,
            'customer_state'     => $state,
            'customer_phone'     => $phone,
            'cart_ids'           => $cartIds,
            'payment_type'       => $paymentMethod,
            'order_status'       => "pending",
            'order_number'       => $order_number,
            'site_region'        => $lang,
        ]);

        return redirect()->route('thanks', [$lang, $order_number]);
    }

    public function showThanks($lang, $order_number)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;

        // Get Settings
        $settings = DB::table('settings')->first();

        // Get Data From Database
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $cartProducts = Product::all();
        $footerPages  = Page::all();

        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        // Get Order Details
        $order_details = UserOrders::where('order_number', $order_number)->first();

        // Get Products Information
        $getCartIDS  = $order_details->cart_ids;
        $cartIDS     = explode('|', $getCartIDS);
        $cartIdsList = array();

        foreach($cartIDS as $id):
            $cartIdsList[] = Cart::where('id', $id)->first();
        endforeach;

        $productsList   = Product::all();
        $attributesList = Attributes::all();

        // Get Email Data

        // Send Order Submittion Email
        \Mail::to($order_details->user_email)->send(new OrderSubmitted($order_details, $cartIdsList, $productsList, $attributesList, $currencySymbol, $currencyCode, $lang));

        // View Thank You Page
        return view('thank-you', compact('order_details', 'cartIdsList', 'productsList', 'attributesList', 'blogPosts', 'cartProducts', 'wishlist', 'footerPages', 'currencySymbol', 'currencyCode', 'cartList', 'lang'));
    }

    public function sendEmail()
    {
        $details = [
            'title' => 'Title: Mail from Camixyre',
            'body' => 'Body: This is for testing email using smtp'
        ];

        Mail::to('saifullahbutt85@gmail.com')->send(new OrderSubmitted($details));
        return view('emails.thanks');
    }
}
