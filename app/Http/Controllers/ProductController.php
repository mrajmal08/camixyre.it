<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Variations;
use App\Models\Attributes;
use App\Models\Category;
use App\Models\Product;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products   = Product::all();
        $adminInfo  = DB::table('admins')->first();

        return view('admin.pages.products.all', compact('products', 'categories', 'adminInfo'));
    }

    public function create()
    {
        $categories = Category::all();
        $adminInfo  = DB::table('admins')->first();

        return view('admin.pages.products.add-new', compact('categories', 'adminInfo'));
    }

    public function store(Request $request)
    {
        // Define Status
        if($request->has('publish')):
            $status = "publish";
        else:
            $status = "draft";
        endif;

        // Discount Value
        if(empty($request->input('discount-price'))):
            $discount = FALSE;
        else:
            $discount = TRUE;
        endif;

        // Define Key Digits
        $digits = 4;
        
        // Variations Key
        $variations_key = rand(pow(10, $digits-1), pow(10, $digits)-1);

        // Attributes Key
        $attributes_key = rand(pow(10, $digits-1), pow(10, $digits)-1);

        // Product Validation
        $request->validate([
            'title-en'    => 'required',
            'price'       => 'required',
            'price'       => 'required',
            'url-en'      => 'required|unique:products,url_en',
            'url-it'      => 'required|unique:products,url_it',
            'url-fr'      => 'required|unique:products,url_fr',
            'url-es'      => 'required|unique:products,url_es',
            'url-de'      => 'required|unique:products,url_de'
        ]);

        // Slug Generate
        $slug_en = Str::slug($request->input('url-en'), '-');
        $slug_it = Str::slug($request->input('url-it'), '-');
        $slug_fr = Str::slug($request->input('url-fr'), '-');
        $slug_es = Str::slug($request->input('url-es'), '-');
        $slug_de = Str::slug($request->input('url-de'), '-');

        // Product Categories
        if(!empty($request->input('product-categories'))):
            $productCategories = implode("|", $request->input('product-categories'));
        else:
            $productCategories = NULL;
        endif;

        // Shipping Cost
        if(empty($request->input('shipping-price'))):
            $shippingCost = 0.00;
        else:
            $shippingCost = $request->input('shipping-price');
        endif;

        // Insert Product
        Product::create([
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
            'short_description_en' => $request->input('short-description-en'),
            'short_description_it' => $request->input('short-description-it'),
            'short_description_fr' => $request->input('short-description-fr'),
            'short_description_es' => $request->input('short-description-es'),
            'short_description_de' => $request->input('short-description-de'),
            'shipping_delivery_en' => $request->input('shipping-delivery-en'),
            'shipping_delivery_it' => $request->input('shipping-delivery-it'),
            'shipping_delivery_fr' => $request->input('shipping-delivery-fr'),
            'shipping_delivery_es' => $request->input('shipping-delivery-es'),
            'shipping_delivery_de' => $request->input('shipping-delivery-de'),
            'tags_en'              => $request->input('tags-en'),
            'tags_it'              => $request->input('tags-it'),
            'tags_fr'              => $request->input('tags-fr'),
            'tags_es'              => $request->input('tags-es'),
            'tags_de'              => $request->input('tags-de'),
            'product_code'         => $request->input('product-code'),
            'product_sku'          => $request->input('product-sku'),
            'on_sale'              => $discount,
            'price'                => $request->input('price'),
            'discount_price'       => $request->input('discount-price'),
            'shipping_price'       => $shippingCost,
            'categories'           => $productCategories,
            'variations_key'       => $variations_key,
            'featured_image'       => $request->input('featured-image'),
            'images_gallery'       => $request->input('images-gallery'),
            'label'                => $request->input('label'),
            'status'               => $status,
        ]);

        // Insert Variations
        if(!empty($request->input('variation-name'))):
            $countVariations = count($request->input('variation-name'));
            for($item = 0; $item < $countVariations; $item++):
                Variations::create([
                    'key'            => $variations_key,
                    'name'           => $request->input("variation-name.$item"),
                    'type'           => $request->input("variation-type.$item"),
                    'variation_id'   => $request->input("variation-id.$item"),
                    'attributes_key' => $attributes_key
                ]);
            endfor;
        endif;

        // Insert Attributes
        if(!empty($request->input('attribute-name-en'))):
            $countAttributes = count($request->input('attribute-name-en'));
            for($item = 0; $item < $countAttributes; $item++):
                Attributes::create([
                    'key'              => $attributes_key,
                    'name_en'          => $request->input("attribute-name-en.$item"),
                    'name_it'          => $request->input("attribute-name-it.$item"),
                    'name_fr'          => $request->input("attribute-name-fr.$item"),
                    'name_es'          => $request->input("attribute-name-es.$item"),
                    'name_de'          => $request->input("attribute-name-de.$item"),
                    'price'            => $request->input("attribute-price.$item"),
                    'images'           => $request->input("attribute-images.$item"),
                    'variation_box_id' => $request->input("variation-box-id.0")
                ]);
            endfor;
        endif;

        // Redirect
        return back()->with('message', 'Product Added Successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $variations = Variations::where('key', $product->variations_key)->get();
        $attributes = Attributes::all();
        $adminInfo  = DB::table('admins')->first();

        return view('admin.pages.products.edit', compact('product', 'categories', 'variations', 'attributes', 'adminInfo'));
    }

    public function update(Request $request, Product $product)
    {
        // Define Status
        if($request->has('update')):
            $status = "publish";
        else:
            $status = "draft";
        endif;

        // Discount Value
        if(empty($request->input('discount-price'))):
            $discount = FALSE;
        else:
            $discount = TRUE;
        endif;

        // Define Key Digits
        $digits = 4;
        
        // Variations Key
        $variations_key = rand(pow(10, $digits-1), pow(10, $digits)-1);

        // Attributes Key
        $attributes_key = rand(pow(10, $digits-1), pow(10, $digits)-1);

        // Product Validation
        // $request->validate([
        //     'title-en'    => 'required',
        //     'price'       => 'required',
        //     'url-en'      => 'required|unique:products,url_en',
        //     'url-it'      => 'required|unique:products,url_it',
        //     'url-fr'      => 'required|unique:products,url_fr',
        //     'url-es'      => 'required|unique:products,url_es',
        //     'url-de'      => 'required|unique:products,url_de'
        // ]);
        
        // Slug Generate
        $slug_en = Str::slug($request->input('url-en'), '-');
        $slug_it = Str::slug($request->input('url-it'), '-');
        $slug_fr = Str::slug($request->input('url-fr'), '-');
        $slug_es = Str::slug($request->input('url-es'), '-');
        $slug_de = Str::slug($request->input('url-de'), '-');

        // Product Categories
        if(!empty($request->input('product-categories'))):
            $productCategories = implode("|", $request->input('product-categories'));
        else:
            $productCategories = NULL;
        endif;

        // Shipping Cost
        if(empty($request->input('shipping-price'))):
            $shippingCost = 0.00;
        else:
            $shippingCost = $request->input('shipping-price');
        endif;

        // Update Product
        $product->url_en               = $slug_en;
        $product->url_it               = $slug_it;
        $product->url_fr               = $slug_fr;
        $product->url_es               = $slug_es;
        $product->url_de               = $slug_de;
        $product->title_en             = $request->input('title-en');
        $product->title_it             = $request->input('title-it');
        $product->title_fr             = $request->input('title-fr');
        $product->title_es             = $request->input('title-es');
        $product->title_de             = $request->input('title-de');
        $product->meta_title_en        = $request->input('meta-title-en');
        $product->meta_title_it        = $request->input('meta-title-it');
        $product->meta_title_fr        = $request->input('meta-title-fr');
        $product->meta_title_es        = $request->input('meta-title-es');
        $product->meta_title_de        = $request->input('meta-title-de');
        $product->description_en       = $request->input('description-en');
        $product->description_it       = $request->input('description-it');
        $product->description_fr       = $request->input('description-fr');
        $product->description_es       = $request->input('description-es');
        $product->description_de       = $request->input('description-de');
        $product->meta_keyword_en      = $request->input('meta-keyword-en');
        $product->meta_keyword_it      = $request->input('meta-keyword-it');
        $product->meta_keyword_fr      = $request->input('meta-keyword-fr');
        $product->meta_keyword_es      = $request->input('meta-keyword-es');
        $product->meta_keyword_de      = $request->input('meta-keyword-de');
        $product->meta_description_en  = $request->input('meta-description-en');
        $product->meta_description_it  = $request->input('meta-description-it');
        $product->meta_description_fr  = $request->input('meta-description-fr');
        $product->meta_description_es  = $request->input('meta-description-es');
        $product->meta_description_de  = $request->input('meta-description-de');
        $product->short_description_en = $request->input('short-description-en');
        $product->short_description_it = $request->input('short-description-it');
        $product->short_description_fr = $request->input('short-description-fr');
        $product->short_description_es = $request->input('short-description-es');
        $product->short_description_de = $request->input('short-description-de');
        $product->shipping_delivery_en = $request->input('shipping-delivery-en');
        $product->shipping_delivery_it = $request->input('shipping-delivery-it');
        $product->shipping_delivery_fr = $request->input('shipping-delivery-fr');
        $product->shipping_delivery_es = $request->input('shipping-delivery-es');
        $product->shipping_delivery_de = $request->input('shipping-delivery-de');
        $product->tags_en              = $request->input('tags-en');
        $product->tags_it              = $request->input('tags-it');
        $product->tags_fr              = $request->input('tags-fr');
        $product->tags_es              = $request->input('tags-es');
        $product->tags_de              = $request->input('tags-de');
        $product->product_code         = $request->input('product-code');
        $product->product_sku          = $request->input('product-sku');
        $product->on_sale              = $discount;
        $product->price                = $request->input('price');
        $product->discount_price       = $request->input('discount-price');
        $product->shipping_price       = $shippingCost;
        $product->categories           = $productCategories;
        $product->variations_key       = $variations_key;
        $product->featured_image       = $request->input('featured-image');
        $product->images_gallery       = $request->input('images-gallery');
        $product->label                = $request->input('label');
        $product->status               = $status;
        $product->save();

        // Destroy Variations
        if(!empty($request->input('variation-id'))):
            $deleteVariation = $request->input('variation-id');
            for($item = 0; $item < count($deleteVariation); $item++):
                Variations::where('variation_id', $deleteVariation[$item])->forceDelete();
            endfor;
        endif;

        // Insert Variations
        if(!empty($request->input('variation-name'))):
            $countVariations = count($request->input('variation-name'));
            for($item = 0; $item < $countVariations; $item++):
                Variations::create([
                    'key'            => $variations_key,
                    'name'           => $request->input("variation-name.$item"),
                    'type'           => $request->input("variation-type.$item"),
                    'variation_id'   => $request->input("variation-id.$item"),
                    'attributes_key' => $attributes_key
                ]);
            endfor;
        endif;
        
        // Destroy Attributes
        if(!empty($request->input('variation-box-id'))):
            $deleteVariation = $request->input('variation-box-id');
            for($item = 0; $item < count($deleteVariation); $item++):
                Attributes::where('variation_box_id', $deleteVariation[$item])->forceDelete();
            endfor;
        endif;

        // echo count($request->input('attribute-name-en'));
        print_r($request->input("variation-box-id"));

        // Insert Attributes
        if(!empty($request->input('attribute-name-en'))):
            $countAttributes = count($request->input('attribute-name-en'));
            for($item = 0; $item < $countAttributes; $item++):
                Attributes::create([
                    'key'              => $attributes_key,
                    'name_en'          => $request->input("attribute-name-en.$item"),
                    'name_it'          => $request->input("attribute-name-it.$item"),
                    'name_fr'          => $request->input("attribute-name-fr.$item"),
                    'name_es'          => $request->input("attribute-name-es.$item"),
                    'name_de'          => $request->input("attribute-name-de.$item"),
                    'price'            => $request->input("attribute-price.$item"),
                    'images'           => $request->input("attribute-images.$item"),
                    'variation_box_id' => $request->input("variation-box-id.0")
                ]);
            endfor;
        endif;

        // Redirect
        return back()->with('message', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        if($product->forceDelete()):
            return back()->with('message','Product Deleted Successfully!');
        else:
            return back()->with('message','Failed To Delete Product!');
        endif;
    }
}
