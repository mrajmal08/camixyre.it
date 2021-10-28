<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Newsletter;
use DB;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::all();
        $adminInfo = DB::table('admins')->first();

        return view('admin.pages.newsletter.all', compact('newsletters', 'adminInfo'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:newsletter,email',
        ]);

        if($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        endif;

        Newsletter::create([
            'email' => $request->email,
        ]);

        return back()->with('subscribe_success', 'Newsletter Subscribed Successfully');
    }
}
