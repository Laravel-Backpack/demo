<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('monster_id');
            $table->bigInteger('country_id')->nullable();
            $table->text('body');
            $table->timestamps();
        });

        Schema::create('universes_wishes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('universe_id');
            $table->bigInteger('wish_id');
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishes');
        Schema::dropIfExists('universes_wishes');
    }
}
