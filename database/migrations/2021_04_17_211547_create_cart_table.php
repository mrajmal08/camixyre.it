<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('user_type');
            $table->string('product_url');
            $table->unsignedInteger('product_id');
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('product_sku')->nullable();
            $table->string('product_attributes')->default('default');
            $table->unsignedInteger('quantity');
            $table->string('status')->default('in_cart');
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
        Schema::dropIfExists('cart');
    }
}
