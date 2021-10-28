<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
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
        Schema::dropIfExists('pages');
    }
}
