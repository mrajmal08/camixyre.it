<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use DB;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        $adminInfo = DB::table('admins')->first();

        return view('admin.pages.reviews.all', compact('reviews', 'adminInfo'));
    }
}
