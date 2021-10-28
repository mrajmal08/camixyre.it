<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserOrders;
use App\Models\Product;
use App\Models\Cart;
use PDF;
use DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $orders    = UserOrders::orderBy('id', 'DESC')->get();
        $adminInfo = DB::table('admins')->first();

        return view('admin.pages.invoice.all', compact('orders', 'adminInfo'));
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

        return view('admin.pages.invoice.view', compact('order', 'cartIdsList', 'cartList', 'cartProducts', 'currencyCode', 'currencySymbol', 'adminInfo'));
    }

    public function generatePdf(Request $request, $orderNumber)
    {
        $order        = UserOrders::where('order_number', $orderNumber)->first();
        $cartList     = Cart::all();
        $cartProducts = Product::orderBy('id', 'DESC')->get();

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

        // Generate PDF
        // $customPaper = array(0,0,800.00,800.80);
        $pdf = PDF::loadView('admin.templates.generate-pdf', compact('order', 'cartIdsList', 'cartList', 'cartProducts', 'currencyCode', 'currencySymbol'));//->setPaper($customPaper, 'portrait');
        return $pdf->download('OneClod-Invoice.pdf', compact('order', 'cartIdsList', 'cartList', 'cartProducts', 'currencyCode', 'currencySymbol'));

        return view('admin.templates.generate-pdf');

        // return view('admin.templates.generate-pdf', compact('order', 'cartIdsList', 'cartList', 'cartProducts', 'currencyCode', 'currencySymbol'));
    }
}