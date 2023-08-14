<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAddressToGoogleColumnFromMonsters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monsters', function (Blueprint $table) {
            if (Schema::hasColumn('monsters', 'address_algolia') && !Schema::hasColumn('monsters', 'address_google')) {
                $table->renameColumn('address_algolia', 'address_google');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monsters', function (Blueprint $table) {
            if (Schema::hasColumn('monsters', 'address_google') && !Schema::hasColumn('monsters', 'address_algolia')) {
                $table->renameColumn('address_google', 'address_algolia');
            }
        });
    }
}
