<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_en',60)->nullable();
            $table->string('title_es',60)->nullable();
            $table->mediumText('ingredients_en')->nullable();
            $table->mediumText('ingredients_es')->nullable();
            $table->mediumText('directions_en')->nullable();
            $table->mediumText('directions_es')->nullable();
            $table->string('serves_en',10)->nullable();
            $table->string('serves_es',10)->nullable();
            $table->string('time_en',10)->nullable();
            $table->string('time_es',10)->nullable();
            $table->string('picture',20)->nullable();

            $table->integer('recipes_categories_id')->unsigned();
            $table->foreign('recipes_categories_id')->references('id')->on('recipes_categories')->onDelete('cascade');
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
        Schema::dropIfExists('recipes');
    }
}
