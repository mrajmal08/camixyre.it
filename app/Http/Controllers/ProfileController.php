<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Admin;
use Auth;
use Hash;
use DB;

class ProfileController extends Controller
{
    public function index()
    {
        $adminInfo  = DB::table('admins')->first();

        return view('admin.pages.profile.edit', compact('adminInfo'));
    }

    public function update(Request $request, Admin $admin)
    {
        // Profile Validation
        $request->validate([
            'name'  => 'required',
            'email' => 'required',
        ]);

        $admin = Admin::find(1);
        $admin->name  = $request->input('name');
        $admin->email = $request->input('email');

        if(!empty($request->input('password'))):
            $admin->password = Hash::make($request->input('password'));
        endif;

        $admin->save();

        // Redirect
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('status', 'Password Updated Successfully! Please Login To Continue');
    }
}
