<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        $adminInfo  = DB::table('admins')->first();

        return view('admin.pages.categories.all', compact('categories', 'adminInfo'));
    }
    
    public function create()
    {
        $categories = Category::where('parent_type', '=', NULL)->get();
        $adminInfo  = DB::table('admins')->first();
        
        return view('admin.pages.categories.add-new', compact('categories', 'adminInfo'));
    }
    
    public function store(Request $request)
    {
        // Category Validation
        $request->validate([
            'title-en' => 'required',
            'url-en'  => 'required|unique:categories,url_en',
            'url-it'  => 'required|unique:categories,url_it',
            'url-fr'  => 'required|unique:categories,url_fr',
            'url-es'  => 'required|unique:categories,url_es',
            'url-de'  => 'required|unique:categories,url_de'
        ]);

        // Generate Slug
        $slug = Str::slug($request->title_en, '-');

        // Parent ID
        if(!empty($request->input('parent-ids'))):
            $parentType = FALSE;
        else:
            $parentType = TRUE;
        endif;

        // Parent Categories
        if(!empty($request->input('parent-ids'))):
            $parentCategories = implode("|", $request->input('parent-ids'));
        else:
            $parentCategories = NULL;
        endif;

        // Insert Category
        $categories = Category::create([
            'url_en'              => $request->input('url-en'),
            'url_it'              => $request->input('url-it'),
            'url_fr'              => $request->input('url-fr'),
            'url_es'              => $request->input('url-es'),
            'url_de'              => $request->input('url-de'),
            'title_en'            => $request->input('title-en'),
            'title_it'            => $request->input('title-it'),
            'title_fr'            => $request->input('title-fr'),
            'title_es'            => $request->input('title-es'),
            'title_de'            => $request->input('title-de'),
            'meta_title_en'       => $request->input('meta-title-en'),
            'meta_title_it'       => $request->input('meta-title-it'),
            'meta_title_fr'       => $request->input('meta-title-fr'),
            'meta_title_es'       => $request->input('meta-title-es'),
            'meta_title_de'       => $request->input('meta-title-de'),
            'meta_description_en' => $request->input('meta-description-en'),
            'meta_description_it' => $request->input('meta-description-it'),
            'meta_description_fr' => $request->input('meta-description-fr'),
            'meta_description_es' => $request->input('meta-description-es'),
            'meta_description_de' => $request->input('meta-description-de'),
            'description_en'      => $request->input('description-en'),
            'description_it'      => $request->input('description-it'),
            'description_fr'      => $request->input('description-fr'),
            'description_es'      => $request->input('description-es'),
            'description_de'      => $request->input('description-de'),
            'parent_type'         => $parentType,
            'parent_ids'          => $parentCategories
        ]);
        
        // Redirect
        return back()->with('message','Category Added Successfully!');
    }
    
    public function show(Category $category)
    {
        //
    }
    
    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->where('parent_type', '=', TRUE)->get();
        $adminInfo  = DB::table('admins')->first();

        return view('admin.pages.categories.edit', compact('categories', 'category', 'adminInfo'));
    }
    
    public function update(Request $request, Category $category)
    {
        // Generate URL
        $slug = Str::slug($request->input('url-en'), '-');

        // Parent ID
        if(!empty($request->input('parent-ids'))):
            $parentType = FALSE;
        else:
            $parentType = TRUE;
        endif;

        // Parent Categories
        if(!empty($request->input('parent-ids'))):
            $parentCategories = implode("|", $request->input('parent-ids'));
        else:
            $parentCategories = NULL;
        endif;

        // Update Category
        $category->url_en              = $request->input('url-en');
        $category->url_it              = $request->input('url-it');
        $category->url_fr              = $request->input('url-fr');
        $category->url_es              = $request->input('url-es');
        $category->url_de              = $request->input('url-de');
        $category->title_en            = $request->input('title-en');
        $category->title_it            = $request->input('title-it');
        $category->title_fr            = $request->input('title-fr');
        $category->title_es            = $request->input('title-es');
        $category->title_de            = $request->input('title-de');
        $category->meta_title_en       = $request->input('meta-title-en');
        $category->meta_title_it       = $request->input('meta-title-it');
        $category->meta_title_fr       = $request->input('meta-title-fr');
        $category->meta_title_es       = $request->input('meta-title-es');
        $category->meta_title_de       = $request->input('meta-title-de');
        $category->meta_description_en = $request->input('meta-description-en');
        $category->meta_description_it = $request->input('meta-description-it');
        $category->meta_description_fr = $request->input('meta-description-fr');
        $category->meta_description_es = $request->input('meta-description-es');
        $category->meta_description_de = $request->input('meta-description-de');
        $category->description_en      = $request->input('description-en');
        $category->description_it      = $request->input('description-it');
        $category->description_fr      = $request->input('description-fr');
        $category->description_es      = $request->input('description-es');
        $category->description_de      = $request->input('description-de');
        $category->parent_type         = $parentType;
        $category->parent_ids          = $parentCategories;
        $category->save();
        
        // Redirect
        return back()->with('message','Category Updated Successfully!');
    }
    
    public function destroy(Category $category)
    {
        if($category->forceDelete()):
            return back()->with('message','Category Deleted Successfully!');
        else:
            return back()->with('message','Failed To Delete Category!');
        endif;
    }
}
