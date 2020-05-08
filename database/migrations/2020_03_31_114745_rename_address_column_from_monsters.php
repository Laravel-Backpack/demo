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
            if (!Schema::hasColumn('monsters', 'address_algolia')) {
                $table->text('address_algolia')->nullable()->after('week');
            }
        });
    }
}
