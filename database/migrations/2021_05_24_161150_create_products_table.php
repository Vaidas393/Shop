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
          $table->integer('category_id');
          $table->integer('section_id');
          $table->string('brand');
          $table->string('name');
          $table->string('code');
          $table->float('price');
          $table->float('discount')->nullable();
          $table->float('weight')->nullable();
          $table->string('video')->nullable();
          $table->string('image')->nullable();
          $table->string('description');
          $table->string('meta_title');
          $table->string('meta_description');
          $table->string('meta_keywords');
          $table->enum('is_featured', ['No','Yes']);
          $table->tinyInteger('status');
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
