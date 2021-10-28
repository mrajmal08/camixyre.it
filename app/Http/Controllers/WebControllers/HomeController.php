<?php

namespace App\Http\Controllers\WebControllers;

use Stevebauman\Location\Facades\Location;
use Mpociot\VatCalculator\VatCalculator;
use App\Http\Controllers\Controller;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Page;
use App\Models\Post;
use App\Models\Cart;
use Carbon\Carbon;
use Session;
use Cookie;
use Auth;
use DB;

class HomeController extends Controller
{
    public function login($lang)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;

        // Get Data From Database
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $cartProducts = Product::all();
        $footerPages  = Page::all();

        return view('auth.login', compact('blogPosts', 'cartList', 'wishlist', 'cartProducts', 'footerPages', 'lang'));
    }

    public function register($lang)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;
        
        // Get Data From Database
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $cartProducts = Product::all();
        $footerPages  = Page::all();

        return view('auth.login', compact('blogPosts', 'cartList', 'wishlist', 'cartProducts', 'footerPages', 'lang'));
    }

    public function logout(Request $request, $lang)
    {
        Auth::logout();

        // Redirect
        return redirect($lang . '/home');
    }

    public function reset($lang)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;

        // Get Data From Database
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $cartProducts = Product::all();
        $footerPages  = Page::all();

        return view('auth.passwords.reset', compact('blogPosts', 'cartList', 'wishlist', 'cartProducts', 'footerPages', 'lang'));
    }

    public function index($lang)
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
        $bestSelling  = Product::where('label', 'top-seller')->limit(4)->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $cartProducts = Product::all();
        $footerPages  = Page::all();

        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();
        
        return view('home', compact('bestSelling', 'blogPosts', 'cartProducts', 'footerPages', 'wishlist', 'currencySymbol', 'currencyCode', 'cartList', 'lang'));
    }

    public function search(Request $request, $lang)
    {
        $keyword = $request->search;

        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;

        // Get Settings
        $settings = DB::table('settings')->first();

        // Get Data From Database
        $searchProducts = Product::where('title_en', 'like', '%' . $keyword . '%')
        ->orWhere('title_it', 'like', '%' . $keyword . '%')
        ->orWhere('title_fr', 'like', '%' . $keyword . '%')
        ->orWhere('title_es', 'like', '%' . $keyword . '%')
        ->orWhere('title_de', 'like', '%' . $keyword . '%')
        ->orWhere('tags_en', 'like', '%' . $keyword . '%')
        ->orWhere('tags_it', 'like', '%' . $keyword . '%')
        ->orWhere('tags_fr', 'like', '%' . $keyword . '%')
        ->orWhere('tags_es', 'like', '%' . $keyword . '%')
        ->orWhere('tags_de', 'like', '%' . $keyword . '%')
        ->paginate(9);

        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $cartProducts = Product::all();
        $footerPages  = Page::all();

        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();
        
        return view('search', compact('searchProducts', 'keyword', 'blogPosts', 'cartProducts', 'footerPages', 'wishlist', 'currencySymbol', 'currencyCode', 'cartList', 'lang'));
    }

    public function error($lang)
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
        
        return view('errors.404', compact('blogPosts', 'cartProducts', 'footerPages', 'wishlist', 'currencySymbol', 'currencyCode', 'cartList', 'lang'));
    }
}
