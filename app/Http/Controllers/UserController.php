<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        $adminInfo  = DB::table('admins')->first();

        return view('admin.users', compact('users', 'adminInfo'));
    }

    public function destroy(User $user)
    {
        if($user->forceDelete()):
            return back()->with('message','User Deleted Successfully!');
        else:
            return back()->with('message','Failed To Delete User!');
        endif;
    }
}
