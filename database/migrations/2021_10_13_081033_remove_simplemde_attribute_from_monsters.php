<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSimplemdeAttributeFromMonsters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monsters', function (Blueprint $table) {
            $table->dropColumn('simplemde');
            $table->text('easymde')->nullable();
        });
    }
}
