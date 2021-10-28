<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use DB;

class PostController extends Controller
{
    public function index()
    {
        $posts     = Post::orderBy('id', 'DESC')->get();
        $adminInfo = DB::table('admins')->first();

        return view('admin.pages.posts.all', compact('posts', 'adminInfo'));
    }
    
    public function create()
    {
        $adminInfo = DB::table('admins')->first();

        return view('admin.pages.posts.add-new', compact('adminInfo'));
    }
    
    public function store(Request $request)
    {
        // Post Validation
        $request->validate([
            'title-en'    => 'required',
            'url-en'      => 'required|unique:posts,url_en',
            'url-it'      => 'required|unique:posts,url_it',
            'url-fr'      => 'required|unique:posts,url_fr',
            'url-es'      => 'required|unique:posts,url_es',
            'url-de'      => 'required|unique:posts,url_de'
        ]);

        // Slug Generate
        $slug_en = Str::slug($request->input('url-en'), '-');
        $slug_it = Str::slug($request->input('url-it'), '-');
        $slug_fr = Str::slug($request->input('url-fr'), '-');
        $slug_es = Str::slug($request->input('url-es'), '-');
        $slug_de = Str::slug($request->input('url-de'), '-');
        
        // Create New Post
        $post = Post::create([
            'url_en'               => $slug_en,
            'url_it'               => $slug_it,
            'url_fr'               => $slug_fr,
            'url_es'               => $slug_es,
            'url_de'               => $slug_de,
            'title_en'             => $request->input('title-en'),
            'title_it'             => $request->input('title-it'),
            'title_fr'             => $request->input('title-fr'),
            'title_es'             => $request->input('title-es'),
            'title_de'             => $request->input('title-de'),
            'meta_title_en'        => $request->input('meta-title-en'),
            'meta_title_it'        => $request->input('meta-title-it'),
            'meta_title_fr'        => $request->input('meta-title-fr'),
            'meta_title_es'        => $request->input('meta-title-es'),
            'meta_title_de'        => $request->input('meta-title-de'),
            'description_en'       => $request->input('description-en'),
            'description_it'       => $request->input('description-it'),
            'description_fr'       => $request->input('description-fr'),
            'description_es'       => $request->input('description-es'),
            'description_de'       => $request->input('description-de'),
            'meta_keyword_en'      => $request->input('meta-keyword-en'),
            'meta_keyword_it'      => $request->input('meta-keyword-it'),
            'meta_keyword_fr'      => $request->input('meta-keyword-fr'),
            'meta_keyword_es'      => $request->input('meta-keyword-es'),
            'meta_keyword_de'      => $request->input('meta-keyword-de'),
            'meta_description_en'  => $request->input('meta-description-en'),
            'meta_description_it'  => $request->input('meta-description-it'),
            'meta_description_fr'  => $request->input('meta-description-fr'),
            'meta_description_es'  => $request->input('meta-description-es'),
            'meta_description_de'  => $request->input('meta-description-de'),
            'featured_image'       => $request->input('single-image')
        ]);

        // Redirect
        return back()->with('message', 'Post Added Successfully');
    }
    
    public function show(Post $post)
    {
        //
    }
    
    public function edit(Post $post)
    {
        $adminInfo = DB::table('admins')->first();

        return view('admin.pages.posts.edit', compact('post', 'adminInfo'));
    }
    
    public function update(Request $request, Post $post)
    {
        // Slug Generate
        $slug_en = Str::slug($request->input('url-en'), '-');
        $slug_it = Str::slug($request->input('url-it'), '-');
        $slug_fr = Str::slug($request->input('url-fr'), '-');
        $slug_es = Str::slug($request->input('url-es'), '-');
        $slug_de = Str::slug($request->input('url-de'), '-');
        
        // Update Post
        $post->url_en               = $slug_en;
        $post->url_it               = $slug_it;
        $post->url_fr               = $slug_fr;
        $post->url_es               = $slug_es;
        $post->url_de               = $slug_de;
        $post->title_en             = $request->input('title-en');
        $post->title_it             = $request->input('title-it');
        $post->title_fr             = $request->input('title-fr');
        $post->title_es             = $request->input('title-es');
        $post->title_de             = $request->input('title-de');
        $post->meta_title_en        = $request->input('meta-title-en');
        $post->meta_title_it        = $request->input('meta-title-it');
        $post->meta_title_fr        = $request->input('meta-title-fr');
        $post->meta_title_es        = $request->input('meta-title-es');
        $post->meta_title_de        = $request->input('meta-title-de');
        $post->description_en       = $request->input('description-en');
        $post->description_it       = $request->input('description-it');
        $post->description_fr       = $request->input('description-fr');
        $post->description_es       = $request->input('description-es');
        $post->description_de       = $request->input('description-de');
        $post->meta_keyword_en      = $request->input('meta-keyword-en');
        $post->meta_keyword_it      = $request->input('meta-keyword-it');
        $post->meta_keyword_fr      = $request->input('meta-keyword-fr');
        $post->meta_keyword_es      = $request->input('meta-keyword-es');
        $post->meta_keyword_de      = $request->input('meta-keyword-de');
        $post->meta_description_en  = $request->input('meta-description-en');
        $post->meta_description_it  = $request->input('meta-description-it');
        $post->meta_description_fr  = $request->input('meta-description-fr');
        $post->meta_description_es  = $request->input('meta-description-es');
        $post->meta_description_de  = $request->input('meta-description-de');
        $post->featured_image       = $request->input('single-image');
        $post->save();
        
        // Redirect
        return back()->with('message', 'Post Updated Successfully');
    }
    
    public function destroy(Post $post)
    {
        if($post->forceDelete()):
            return back()->with('message','Post Deleted Successfully!');
        else:
            return back()->with('message','Failed To Delete Post!');
        endif;
    }
}
