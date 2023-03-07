<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->json('name');
            $table->json('description')->nullable();
            $table->json('details')->nullable();
            $table->json('features')->nullable();
            $table->integer('price');
            $table->integer('category_id');
            $table->json('gallery')->nullable();
            $table->json('extras')->nullable();
            $table->string('main_image')->nullable();
            $table->string('privacy_policy')->nullable();
            $table->text('specifications')->nullable();
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
        Schema::drop('products');
    }
}
