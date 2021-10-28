<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('url_en');
            $table->string('url_it');
            $table->string('url_fr');
            $table->string('url_es');
            $table->string('url_de');
            $table->string('title_en');
            $table->string('title_it')->nullable();
            $table->string('title_fr')->nullable();
            $table->string('title_es')->nullable();
            $table->string('title_de')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_it')->nullable();
            $table->string('meta_title_fr')->nullable();
            $table->string('meta_title_es')->nullable();
            $table->string('meta_title_de')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_it')->nullable();
            $table->text('description_fr')->nullable();
            $table->text('description_es')->nullable();
            $table->text('description_de')->nullable();
            $table->string('meta_keyword_en')->nullable();
            $table->string('meta_keyword_it')->nullable();
            $table->string('meta_keyword_fr')->nullable();
            $table->string('meta_keyword_es')->nullable();
            $table->string('meta_keyword_de')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_description_it')->nullable();
            $table->string('meta_description_fr')->nullable();
            $table->string('meta_description_es')->nullable();
            $table->string('meta_description_de')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_it')->nullable();
            $table->text('short_description_fr')->nullable();
            $table->text('short_description_es')->nullable();
            $table->text('short_description_de')->nullable();
            $table->text('shipping_delivery_en')->nullable();
            $table->text('shipping_delivery_it')->nullable();
            $table->text('shipping_delivery_fr')->nullable();
            $table->text('shipping_delivery_es')->nullable();
            $table->text('shipping_delivery_de')->nullable();
            $table->string('tags_en')->nullable();
            $table->string('tags_it')->nullable();
            $table->string('tags_fr')->nullable();
            $table->string('tags_es')->nullable();
            $table->string('tags_de')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_sku')->nullable();
            $table->boolean('on_sale');
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->decimal('discount_price', $precision = 8, $scale = 2)->nullable();
            $table->decimal('shipping_price', $precision = 8, $scale = 2)->default(0);
            $table->string('categories')->nullable();
            $table->string('variations_key')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('images_gallery')->nullable();
            $table->string('label')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
