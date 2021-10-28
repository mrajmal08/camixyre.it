<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use App\Models\Variations;
use App\Models\Attributes;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Review;
use App\Models\Post;
use App\Models\Page;
use App\Models\Cart;
use Carbon\Carbon;
use Session;
use Cookie;
use Auth;
use DB;

class ProductController extends Controller
{
    public function index($lang)
    {

        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;

        dd($userID);

        // Get Settings
        $settings = DB::table('settings')->first();

        // Get Data From Database
        $categories   = Category::all();
        $variations   = Variations::all();
        $attributes   = Attributes::all();
        $cartProducts = Product::all();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $products     = Product::orderBy('id', 'DESC')->paginate(9);
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $footerPages  = Page::all();

        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        return view('shop', compact('products', 'variations', 'attributes', 'categories', 'blogPosts', 'cartProducts', 'wishlist', 'footerPages', 'currencySymbol', 'currencyCode', 'cartList', 'lang'));
    }

    // Show Product
    public function show($lang, $slug, $slug2 ='')
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
        $product      = Product::where($url, '=', $slug)->first();
        $categories   = Category::all();
        $variations   = Variations::where('key', $product->variations_key)->get();
        $attributes   = Attributes::all();
        $cartProducts = Product::all();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $reviews      = Review::where('product_id', $product->id)->get();
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $footerPages  = Page::all();

        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        // Page Title / Description
        if($lang == 'en'):
            $pageTitle = $product->meta_title_en;
            $pageDescription = $product->meta_description_en;
        elseif($lang == 'it'):
            $pageTitle = $product->meta_title_it;
            $pageDescription = $product->meta_description_it;
        elseif($lang == 'fr'):
            $pageTitle = $product->meta_title_fr;
            $pageDescription = $product->meta_description_fr;
        elseif($lang == 'es'):
            $pageTitle = $product->meta_title_es;
            $pageDescription = $product->meta_description_es;
        elseif($lang == 'de'):
            $pageTitle = $product->meta_title_de;
            $pageDescription = $product->meta_description_de;
        endif;

        return view('product-details', compact('product', 'variations', 'attributes', 'reviews', 'categories', 'wishlist', 'footerPages', 'slug', 'slug2', 'blogPosts', 'cartProducts', 'currencySymbol', 'currencyCode', 'cartList', 'pageTitle', 'pageDescription', 'lang'));
    }

    public function submitReview(Request $request)
    {
        Review::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'message'    => $request->message,
            'rating'     => $request->rating,
            'product_id' => $request->product_id,
            'status'     => "publish",
        ]);

        // Redirect
        return back()->with('message','Review Submitted Successfully!');
    }
}
