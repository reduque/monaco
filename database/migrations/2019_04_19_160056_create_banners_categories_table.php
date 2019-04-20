<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_en',60);
            $table->string('link',200)->nullable();
            $table->string('img_en',20)->nullable();
            $table->boolean('active');
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
        Schema::dropIfExists('banners_categories');
    }
}
