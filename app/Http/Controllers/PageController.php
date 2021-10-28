<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Page;
use DB;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('id', 'DESC')->get();
        $adminInfo = DB::table('admins')->first();

        return view('admin.pages.pages.all', compact('pages', 'adminInfo'));
    }
    
    public function create()
    {
        $adminInfo = DB::table('admins')->first();

        return view('admin.pages.pages.add-new', compact('adminInfo'));
    }
    
    public function store(Request $request)
    {
        // Page Validation
        $request->validate([
            'title-en'    => 'required',
            'url-en'      => 'required|unique:pages,url_en',
            'url-it'      => 'required|unique:pages,url_it',
            'url-fr'      => 'required|unique:pages,url_fr',
            'url-es'      => 'required|unique:pages,url_es',
            'url-de'      => 'required|unique:pages,url_de'
        ]);

        // Slug Generate
        $slug_en = Str::slug($request->input('url-en'), '-');
        $slug_it = Str::slug($request->input('url-it'), '-');
        $slug_fr = Str::slug($request->input('url-fr'), '-');
        $slug_es = Str::slug($request->input('url-es'), '-');
        $slug_de = Str::slug($request->input('url-de'), '-');
        
        // Create New Page
        $post = Page::create([
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
            'meta_description_de'  => $request->input('meta-description-de')
        ]);

        // Redirect
        return back()->with('message', 'Page Added Successfully');
    }
    
    public function edit(Page $page)
    {
        $adminInfo = DB::table('admins')->first();

        return view('admin.pages.pages.edit', compact('page', 'adminInfo'));
    }
    
    public function update(Request $request, Page $page)
    {
        // Slug Generate
        $slug_en = Str::slug($request->input('url-en'), '-');
        $slug_it = Str::slug($request->input('url-it'), '-');
        $slug_fr = Str::slug($request->input('url-fr'), '-');
        $slug_es = Str::slug($request->input('url-es'), '-');
        $slug_de = Str::slug($request->input('url-de'), '-');
        
        // Update Post
        $page->url_en               = $slug_en;
        $page->url_it               = $slug_it;
        $page->url_fr               = $slug_fr;
        $page->url_es               = $slug_es;
        $page->url_de               = $slug_de;
        $page->title_en             = $request->input('title-en');
        $page->title_it             = $request->input('title-it');
        $page->title_fr             = $request->input('title-fr');
        $page->title_es             = $request->input('title-es');
        $page->title_de             = $request->input('title-de');
        $page->meta_title_en        = $request->input('meta-title-en');
        $page->meta_title_it        = $request->input('meta-title-it');
        $page->meta_title_fr        = $request->input('meta-title-fr');
        $page->meta_title_es        = $request->input('meta-title-es');
        $page->meta_title_de        = $request->input('meta-title-de');
        $page->description_en       = $request->input('description-en');
        $page->description_it       = $request->input('description-it');
        $page->description_fr       = $request->input('description-fr');
        $page->description_es       = $request->input('description-es');
        $page->description_de       = $request->input('description-de');
        $page->meta_keyword_en      = $request->input('meta-keyword-en');
        $page->meta_keyword_it      = $request->input('meta-keyword-it');
        $page->meta_keyword_fr      = $request->input('meta-keyword-fr');
        $page->meta_keyword_es      = $request->input('meta-keyword-es');
        $page->meta_keyword_de      = $request->input('meta-keyword-de');
        $page->meta_description_en  = $request->input('meta-description-en');
        $page->meta_description_it  = $request->input('meta-description-it');
        $page->meta_description_fr  = $request->input('meta-description-fr');
        $page->meta_description_es  = $request->input('meta-description-es');
        $page->meta_description_de  = $request->input('meta-description-de');
        $page->save();
        
        // Redirect
        return back()->with('message', 'Page Updated Successfully');
    }
    
    public function destroy(Page $page)
    {
        if($page->forceDelete()):
            return back()->with('message','Page Deleted Successfully!');
        else:
            return back()->with('message','Failed To Delete Page!');
        endif;
    }
}
