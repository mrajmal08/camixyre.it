<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use DB;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }
    
    // Media View
    public function media()
    {
        $adminInfo = DB::table('admins')->first();
        $filesInFolder = \File::files('media');  
        foreach($filesInFolder as $key => $path){
            $files = pathinfo($path);
            $allMedia[] = $files['basename'];
        }
        return view('admin.media', compact('allMedia', 'adminInfo'));
    }

    // Upload Media
    public function uploadMedia(Request $request)
    {
        $data = $request->file('file');
        $dataName = time() . '.' . $data->extension();
        $data->move(public_path('media'), $dataName);
        return response()->json(['success' => $dataName]);
    }

    // Get Media Files
    public function getMedia()
    {
        $filesInFolder = \File::files('media');     
        foreach($filesInFolder as $key => $path) { 
            $files = pathinfo($path);
            $allMedia[] = $files['basename'];
        }
        return($allMedia);
    }

    public function destroy($image)
    {
        File::delete(public_path("media/$image"));
        return back()->with('message', 'Post Added Successfully');
    }
}
