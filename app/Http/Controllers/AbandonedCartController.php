<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use DB;

class AbandonedCartController extends Controller
{
    public function index()
    {
        $abandonedCart  = Cart::where('status', 'in_cart')->where('user_type', 'registered')->orderBy('id', 'DESC')->get();
        $abandonedUsers = User::all();
        $adminInfo      = DB::table('admins')->first();

        return view('admin.pages.abandoned.all', compact('abandonedCart', 'abandonedUsers', 'adminInfo'));
    }
    
    public function destroy($cart)
    {
        $deleteCart = DB::table('cart')->where('id', $cart)->delete();
        if($deleteCart):
            return back()->with('message','Cart Order Deleted Successfully!');
        else:
            return back()->with('message','Failed To Delete Cart Order!');
        endif;
    }
}
