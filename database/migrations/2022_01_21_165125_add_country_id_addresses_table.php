<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryIdAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('icon_id');
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->bigInteger('country_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('country')->nullable();
            $table->bigInteger('icon_id')->nullable();
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('country_id');
        });
    }
}
