<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name_en',100);
            $table->string('slug_en',100);
            $table->mediumtext('description_en')->nullable();
            $table->string('country',60)->nullable();
            $table->string('size',60)->nullable();
            $table->string('pack',60)->nullable();
            $table->string('ti_hi',60)->nullable();
            $table->string('bar_code',60)->nullable();
            $table->string('shelf_life_en',60)->nullable();
            $table->string('ingredients_en',200)->nullable();

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->unsignedInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('id')
                ->on('subcategories')
                ->onDelete('cascade');

            $table->unsignedInteger('line_id');
            $table->foreign('line_id')->references('id')
                ->on('lines')
                ->onDelete('cascade');

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
