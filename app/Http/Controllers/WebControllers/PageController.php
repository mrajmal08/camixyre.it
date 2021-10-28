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
use App\Models\Post;
use App\Models\Cart;
use App\Models\Page;
use Carbon\Carbon;
use Session;
use Cookie;
use Auth;
use DB;

class PageController extends Controller
{
    public function index($lang, $slug)
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
        $bestSelling  = Product::where('label', 'top-seller')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $cartProducts = Product::all();
        $footerPages  = Page::all();

        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

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

        // Get Page Data
        $page = Page::where($url, '=', $slug)->first()->meta_value ?? 0;;

        // Page Title / Description
        if($lang == 'en'):
            $pageTitle = $page->meta_title_en;
            $pageDescription = $page->meta_description_en;
        elseif($lang == 'it'):
            $pageTitle = $page->meta_title_it;
            $pageDescription = $page->meta_description_it;
        elseif($lang == 'fr'):
            $pageTitle = $page->meta_title_fr;
            $pageDescription = $page->meta_description_fr;
        elseif($lang == 'es'):
            $pageTitle = $page->meta_title_es;
            $pageDescription = $page->meta_description_es;
        elseif($lang == 'de'):
            $pageTitle = $page->meta_title_de;
            $pageDescription = $page->meta_description_de;
        endif;
        
        return view('templates.page-template', compact('page', 'blogPosts', 'cartProducts', 'footerPages', 'wishlist', 'currencySymbol', 'currencyCode', 'cartList', 'pageTitle', 'pageDescription', 'lang'));
    }
}
