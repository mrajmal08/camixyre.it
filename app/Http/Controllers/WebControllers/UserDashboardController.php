<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use App\Models\Attributes;
use App\Models\UserOrders;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Post;
use App\Models\Page;
use App\Models\Cart;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Cookie;
use Auth;
use DB;

class UserDashboardController extends Controller
{
    public function profile($lang)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            return redirect()->route('login.page', $lang);
        endif;
        
        // Get Settings
        $settings = DB::table('settings')->first();

        // Get Data From Database
        $cartProducts = Product::all();
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $profile      = DB::table('users')->where('id', '=', $userID)->first();
        $footerPages  = Page::all();
        
        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        return view('dashboard.profile', compact('profile', 'blogPosts', 'wishlist', 'footerPages', 'cartProducts', 'currencySymbol', 'currencyCode', 'cartList', 'lang')); 
    }

    public function update(Request $request)
    {
        User::find(auth()->user()->id)->update(['name'=> $request->name]);
        
        // Redirect
        return back()->with('message','Profile Updated Successfully!');
    }

    public function change(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
    
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        
        // Redirect
        return back()->with('message','Password Updated Successfully!');
    }

    public function orders($lang)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            return redirect()->route('login.page', $lang);
        endif;
        
        // Get Settings
        $settings = DB::table('settings')->first();

        // Get Data From Database
        $cartProducts = Product::all();
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $orders       = UserOrders::where('user_id', '=', $userID)->paginate(10);
        $footerPages  = Page::all();
        
        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        return view('dashboard.orders', compact('orders', 'blogPosts', 'wishlist', 'footerPages', 'currencySymbol', 'cartProducts', 'currencyCode', 'cartList', 'lang')); 
    }

    public function viewOrder($lang, $orderNumber)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            return redirect()->route('login.page', $lang);
        endif;
        
        // Get Settings
        $settings = DB::table('settings')->first();

        // Get Data From Database
        $cartProducts = Product::all();
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $orderDetails = UserOrders::where('user_id', '=', $userID)->where('order_number', '=', $orderNumber)->first();
        $footerPages  = Page::all();

        if(empty($orderDetails)):
            return redirect()->route('orders', $lang);
        endif;

        // Get Cart IDs
        $getCartIDS  = $orderDetails->cart_ids;
        $cartIDS     = explode('|', $getCartIDS);
        $cartIdsList = array();

        foreach($cartIDS as $id):
            $cartIdsList[] = Cart::where('id', $id)->first();
        endforeach;

        $productsList   = Product::all();
        $attributesList = Attributes::all();
        
        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        return view('dashboard.view-order', compact('orderDetails', 'cartIdsList', 'productsList', 'attributesList',  'blogPosts', 'wishlist', 'footerPages', 'cartProducts', 'currencySymbol', 'currencyCode', 'cartList', 'lang')); 
    }
}
