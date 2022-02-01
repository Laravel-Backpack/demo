<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotableRelationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentiments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text')->nullable();
            $table->string('sentimentable_type');
            $table->bigInteger('sentimentable_id');
            $table->bigInteger('user_id')->nullable();
            $table->timestamps();
        });

        Schema::create('recommendables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text')->nullable();
            $table->string('recommendable_type');
            $table->bigInteger('recommendable_id');
            $table->bigInteger('recommend_id');
            $table->timestamps();
        });

        Schema::create('billables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text')->nullable();
            $table->string('billable_type');
            $table->bigInteger('billable_id');
            $table->bigInteger('bill_id');
            $table->timestamps();
        });

        Schema::create('monster_productdummy', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('monster_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('notes');
            $table->nullableTimestamps();
        });

        Schema::create('recommends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('postalboxers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('postal_name')->nullable();
            $table->integer('monster_id')->nullable();
        });

        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('stars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('starable_type');
            $table->bigInteger('starable_id');
            $table->string('title')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recommendables');
        Schema::dropIfExists('sentiments');
        Schema::dropIfExists('recommends');
        Schema::dropIfExists('stars');
        Schema::dropIfExists('billables');
        Schema::dropIfExists('bills');
        Schema::dropIfExists('monster_productdummy');
        Schema::dropIfExists('postalboxers');
    }
}
