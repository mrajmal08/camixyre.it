<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Post;
use App\Models\Page;
use App\Models\Cart;
use Carbon\Carbon;
use Session;
use Cookie;
use Auth;
use DB;

class PostController extends Controller
{
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
        $cartProducts = Product::all();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $posts        = Post::orderBy('id', 'DESC')->paginate(9);
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $footerPages  = Page::all();
        
        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        return view('blog', compact('posts', 'blogPosts', 'cartProducts', 'wishlist', 'footerPages', 'currencySymbol', 'currencyCode', 'cartList', 'lang'));
    }

    // Show Product
    public function show($lang, $slug)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;

        // Get Settings
        $settings = DB::table('settings')->first();

        // Multi URL
        if($lang == 'en'):
            $url = 'url_en';
        elseif($lang == 'it'):
            $url = 'url_it';
        elseif($lang == 'fr'):
            $url = 'url_fr';
        elseif($lang == 'es'):
            $url = 'url_es';
        elseif($lang == 'de'):
            $url = 'url_de';
        endif;

        // Get Data From Database
        $cartProducts = Product::all();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $post         = Post::where($url, '=', $slug)->first();
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $footerPages  = Page::all();
        
        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        // Page Title / Description
        if($lang == 'en'):
            $pageTitle = $post->meta_title_en;
            $pageDescription = $post->meta_description_en;
        elseif($lang == 'it'):
            $pageTitle = $post->meta_title_it;
            $pageDescription = $post->meta_description_it;
        elseif($lang == 'fr'):
            $pageTitle = $post->meta_title_fr;
            $pageDescription = $post->meta_description_fr;
        elseif($lang == 'es'):
            $pageTitle = $post->meta_title_es;
            $pageDescription = $post->meta_description_es;
        elseif($lang == 'de'):
            $pageTitle = $post->meta_title_de;
            $pageDescription = $post->meta_description_de;
        endif;

        return view('post-details', compact('post', 'wishlist', 'footerPages', 'slug', 'blogPosts', 'cartProducts', 'currencySymbol', 'currencyCode', 'cartList', 'pageTitle', 'pageDescription', 'lang'));
    }
}
