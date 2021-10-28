<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use App\Models\Admin;
use Analytics;
use Auth;
use DB;

class AdminController extends Controller
{
    protected $guard = 'admin';

    // Login Method
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::guard('admin')->attempt($credentials, $request->remember)):
            $user = Admin::where('email', $request->email)->first();
            Auth::guard('admin')->login($user);
            return redirect()->route('admin.home');
        else:
            return redirect()->route('admin.login')->with('status', 'Failed to login! Please check your email or password.');
        endif;
    }

    // Logout Method
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('status', 'Logout Successfully!');
    }

    // Admin Dashboard
    public function dashboard()
    {
        $users      = DB::table('users')->get();
        $orders     = DB::table('user_orders')->get();
        $newsletter = DB::table('newsletter')->get();
        $adminInfo  = DB::table('admins')->first();

        // Monthly Sales
        $year = date("Y");

        $january   = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 1)->get();
        $february  = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 2)->get();
        $march     = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 3)->get();
        $april     = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 4)->get();
        $may       = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 5)->get();
        $june      = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 6)->get();
        $july      = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 7)->get();
        $august    = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 8)->get();
        $september = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 9)->get();
        $octobor   = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 10)->get();
        $november  = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 11)->get();
        $december  = DB::table('user_orders')->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', 12)->get();

        foreach($orders as $key => $order):
            $orderDate = $order->created_at;
            $checkDate = substr($orderDate, 0, -12);
        endforeach;

        $last7DaysAnalytics = []; // Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));

        $countryVisits = []; //Analytics::performQuery(
        //     Period::days(7),
        //     'ga:sessions',
        //     [
        //         'dimensions' => 'ga:country',
        //         'sort' => '-ga:sessions',
        //         'max-results' => 5,
        //     ],
        // );
    
        return view('admin.dashboard', compact('users', 'orders', 'newsletter', 
                                                'january', 'february', 'march', 'april', 
                                                'may', 'june', 'july', 'august', 
                                                'september', 'octobor', 'november', 'december', 'adminInfo', 'last7DaysAnalytics', 'countryVisits'));
    }
}
