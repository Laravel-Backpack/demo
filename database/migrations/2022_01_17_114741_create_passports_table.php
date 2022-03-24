<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('passports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained();
            $table->string('number');
            $table->date('issuance_date');
            $table->date('expiry_date')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('species');
            $table->string('breed')->nullable();
            $table->string('colour')->nullable();
            $table->text('notes')->nullable();
            $table->string('country');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passports');
    }
}
