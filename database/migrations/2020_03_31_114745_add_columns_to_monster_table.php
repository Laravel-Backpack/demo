<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMonsterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monsters', function (Blueprint $table) {
            if (!Schema::hasColumn('belongs_to_nullable', 'belongs_to_non_nullable')) {
                $table->integer('belongs_to_nullable')->nullable();
                $table->integer('belongs_to_non_nullable');
            }
        });
    }

    public function down()
    {
        Schema::table('monsters', function (Blueprint $table) {
            $table->dropColumn('belongs_to_nullable');
            $table->dropColumn('belongs_to_non_nullable');
        });
    }
}
