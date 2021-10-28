<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Helpers\CurrencyHelper;
use App\Mail\OrderSuccessful;
use App\Mail\OrderSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserOrders;
use App\Models\Product;
use App\Models\Cart;
use DB;

class OrdersController extends Controller
{
    public function index()
    {
        $orders    = UserOrders::orderBy('id', 'DESC')->get();
        $adminInfo = DB::table('admins')->first();

        return view('admin.pages.orders.all', compact('orders', 'adminInfo'));
    }

    public function edit($orderID)
    {
        $order        = UserOrders::where('id', $orderID)->first();
        $cartList     = Cart::all();
        $cartProducts = Product::orderBy('id', 'DESC')->get();
        $adminInfo    = DB::table('admins')->first();

        // Get Products Information
        $getCartIDS  = $order->cart_ids;
        $cartIDS     = explode('|', $getCartIDS);
        $cartIdsList = array();

        foreach($cartIDS as $id):
            $cartIdsList[] = Cart::where('id', $id)->first();
        endforeach;

        // Get Settings
        $settings = DB::table('settings')->first();

        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        return view('admin.pages.orders.view', compact('order', 'cartIdsList', 'cartList', 'cartProducts', 'currencyCode', 'currencySymbol', 'adminInfo'));
    }
    
    public function update(Request $request, UserOrders $order, $lang = "")
    {
        if($request->input('status') == "completed"):

            $orderData    = UserOrders::where('id', $order->id)->first();
            $cartList     = Cart::all();
            $cartProducts = Product::orderBy('id', 'DESC')->get();

            $courierName    = NULL;
            $trackingNumber = NULL;
    
            // Get Products Information
            $getCartIDS  = $orderData->cart_ids;
            $cartIDS     = explode('|', $getCartIDS);
            $cartIdsList = array();

            foreach($cartIDS as $id):
                $cartIdsList[] = Cart::where('id', $id)->first();
            endforeach;

            // Get Settings
            $settings = DB::table('settings')->first();

            // Currency Settings
            $currencyCode   = $settings->currency;
            $currencySymbol = CurrencyHelper::getCurrencyString();

            \Mail::to($order->user_email)->send(new OrderSuccessful($order, $cartIdsList, $cartList, $cartProducts, $currencySymbol, $currencyCode, $lang));

        endif;

        if($request->input('status') == "shipped"):

            $courierName    = $request->input('courier-name');
            $trackingNumber = $request->input('tracking-number');

            \Mail::to($order->user_email)->send(new OrderShipped($order, $courierName, $trackingNumber, $lang));

        else:
            
            $courierName    = NULL;
            $trackingNumber = NULL;
            
        endif;
        
        // Update Order Status
        $order->order_status    = $request->input('status');
        $order->courier_name    = $courierName;
        $order->tracking_number = $trackingNumber;
        $order->save();
        
        return back()->with('message', 'Status Updated Successfully');
    }
    
    public function destroy(UserOrders $order)
    {
        if($order->forceDelete()):
            return back()->with('message','Order Deleted Successfully!');
        else:
            return back()->with('message','Failed To Delete Order!');
        endif;
    }
}
