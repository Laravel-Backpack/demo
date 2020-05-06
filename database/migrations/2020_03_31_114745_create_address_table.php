<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street')->nullable();
            $table->string('country');
            $table->integer('icon_id')->nullable();
            $table->integer('monster_id')->unique();
        });

        Schema::create('postalboxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('postal_name')->nullable();
            $table->integer('monster_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('postalboxes');
    }
}
