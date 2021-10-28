<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use App\Models\Attributes;
use App\Models\Category;
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

class CartController extends Controller
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
        $blogPosts      = Post::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        $cartList       = Cart::where('user_id', '=', $userID)->where('status', '=', 'in_cart')->orderBy('id', 'DESC')->get();
        $wishlist       = Wishlist::where('user_id', '=', $userID)->get();
        $cartProducts   = Product::all();
        $cartAttributes = Attributes::all();
        $footerPages    = Page::all();
        
        // Currency Settings
        $currencyCode   = $settings->currency;
        $currencySymbol = CurrencyHelper::getCurrencyString();

        return view('cart', compact('cartProducts', 'cartAttributes', 'blogPosts', 'wishlist', 'footerPages', 'currencySymbol', 'currencyCode', 'cartList', 'lang'));        
    }
    
    public function store(Request $request, $lang)
    {
        // Get User Info For Data
        if($authUser = Auth::user()):
            $userType = "registered";
        else:
            $userType = "guest";
        endif;

        // Get Cart Product Variation Attributes
        if(!empty($request->input('variation-selection-ids'))):
            $productAttributes = implode("|", $request->input('variation-selection-ids'));
        else:
            $productAttributes = "default";
        endif;

        // Check Product In Cart
        $checkCart = Cart::where('user_id', '=', $request->input('user-id'))->where('product_id', '=', $request->input('product-id'))->where('product_attributes', '=', $productAttributes)->where('status', '!=', 'order_submitted')->first();

        if($checkCart == NULL):
            // Add To Cart
            $cart = Cart::create([
                'user_id'            => $request->input('user-id'),
                'user_type'          => $userType,
                'product_url'        => $request->input('product-url'),
                'product_id'         => $request->input('product-id'),
                'product_name'       => $request->input('product-name'),
                'product_code'       => $request->input('product-code'),
                'product_sku'        => $request->input('product-sku'),
                'product_attributes' => $productAttributes,
                'quantity'           => $request->input('product-quantity'),
            ]);
        else:
            // Update Quantity
            $cart = Cart::where('product_id', '=', $request->input('product-id'))->where('product_attributes', '=', $request->input('product-attributes'))->where('status', '!=', 'order_submitted')->update([
                'quantity' => Cart::raw('quantity + 1'),
            ]);
        endif;

        return back()->with('cart-success', 'Product Successfully Added To Cart');
    }
    
    public function update(Request $request, $lang)
    {
        $userUpdateId   = $request->input('user-id');
        $updateQuantity = $request->input('product-quantity');
        $updateCartIds  = $request->input('cart-product-id');
        for($i = 0; $i < count($userUpdateId); $i++):
            Cart::where('user_id', '=', $userUpdateId[$i])->where('id', '=', $updateCartIds[$i])->update(['quantity' => $updateQuantity[$i]]);
        endfor;
        
        return back()->with('message','Cart Updated!');
    }

    public function destroy($lang, $cart)
    {
        if(Cart::where('id', '=', $cart)->delete()):
            return back()->with('message','Product Removed Successfully!');
        else:
            return back()->with('message','Failed To Remove Product!');
        endif;
    }

}
