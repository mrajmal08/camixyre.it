<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Post;
use App\Models\Page;
use Carbon\Carbon;
use Session;
use Cookie;
use Auth;
use DB;

class WishlistController extends Controller
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
        $blogPosts    = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList     = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist     = Wishlist::where('user_id', '=', $userID)->get();
        $products     = Product::all();
        $cartProducts = Product::all();
        $footerPages  = Page::all();
        
        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        return view('wishlist', compact('products', 'cartProducts', 'blogPosts', 'wishlist', 'footerPages', 'currencySymbol', 'currencyCode', 'cartList', 'lang'));     
    }

    public function store($lang, $productID)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;

        // Check Product In Wishlist
        $checkWishlist = Wishlist::where('user_id', '=', $userID)->where('product_id', '=', $productID)->first();

        // Add To Wishlist
        if($checkWishlist == NULL):
            $cart = Wishlist::create([
                'user_id'    => $userID,
                'product_id' => $productID,
            ]);
        else:
            return back()->with('wishlist-success', 'Product Is Already In Wishlist');
        endif;

        return back()->with('wishlist-success', 'Product Successfully Added To Wishlist');
    }

    public function destroy($lang, $wishlist)
    {
        if(Wishlist::where('id', '=', $wishlist)->delete()):
            return back()->with('message','Product Removed Successfully!');
        else:
            return back()->with('message','Failed To Remove Product!');
        endif;
    }
}
