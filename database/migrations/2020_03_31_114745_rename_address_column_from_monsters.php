<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAddressColumnFromMonsters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monsters', function (Blueprint $table) {
            if (!Schema::hasColumn('monsters', 'address_field')) {
                $table->string('address_field')->nullable();
            }
        });
    }
}
