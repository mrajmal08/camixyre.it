<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'url_en'               => "slug-en",
            'url_it'               => "slug-it",
            'url_fr'               => "slug-fr",
            'url_es'               => "slug-es",
            'url_de'               => "slug-de",
            'title_en'             => "Title English",
            'title_it'             => "Title Italian",
            'title_fr'             => "Title French",
            'title_es'             => "Title Spanish",
            'title_de'             => "Title German",
            'meta_title_en'        => "Meta Title English",
            'meta_title_it'        => "Meta Title Italian",
            'meta_title_fr'        => "Meta Title French",
            'meta_title_es'        => "Meta Title Spanish",
            'meta_title_de'        => "Meta Title German",
            'description_en'       => "Product Description English",
            'description_it'       => "Product Description Italian",
            'description_fr'       => "Product Description French",
            'description_es'       => "Product Description Spanish",
            'description_de'       => "Product Description German",
            'meta_keyword_en'      => "Meta Keyword English",
            'meta_keyword_it'      => "Meta Keyword Italian",
            'meta_keyword_fr'      => "Meta Keyword French",
            'meta_keyword_es'      => "Meta Keyword Spanish",
            'meta_keyword_de'      => "Meta Keyword German",
            'meta_description_en'  => "Meta Description English",
            'meta_description_it'  => "Meta Description Italian",
            'meta_description_fr'  => "Meta Description French",
            'meta_description_es'  => "Meta Description Spanish",
            'meta_description_de'  => "Meta Description German",
            'short_description_en' => "Product Short Description English",
            'short_description_it' => "Product Short Description Italian",
            'short_description_fr' => "Product Short Description French",
            'short_description_es' => "Product Short Description Spanish",
            'short_description_de' => "Product Short Description German",
            'shipping_delivery_en' => "Shipping and Delivery English",
            'shipping_delivery_it' => "Shipping and Delivery Italian",
            'shipping_delivery_fr' => "Shipping and Delivery French",
            'shipping_delivery_es' => "Shipping and Delivery Spanish",
            'shipping_delivery_de' => "Shipping and Delivery German",
            'tags_en'              => "Product Tags English",
            'tags_it'              => "Product Tags Italian",
            'tags_fr'              => "Product Tags French",
            'tags_es'              => "Product Tags Spanish",
            'tags_de'              => "Product Tags German",
            'product_code'         => 0202,
            'product_sku'          => 0101,
            'on_sale'              => TRUE,
            'price'                => "50",
            'discount_price'       => "40",
            'categories'           => NULL,
            'variations_key'       => 112233,
            'featured_image'       => "1617346542.png",
            'images_gallery'       => "",
            'label'                => "top-seller",
            'status'               => "publish",
        ]);
    }
}
