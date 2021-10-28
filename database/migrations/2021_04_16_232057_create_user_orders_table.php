<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('customer_name');
            $table->string('user_email');
            $table->string('transaction_id')->nullable();
            $table->string('customer_street')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_zip')->nullable();
            $table->string('customer_country')->nullable();
            $table->string('customer_apartment')->nullable();
            $table->string('customer_state')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('cart_ids');
            $table->string('payment_type');
            $table->string('order_status');
            $table->string('courier_name')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('order_number');
            $table->string('site_region');
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
        Schema::dropIfExists('user_orders');
    }
}
