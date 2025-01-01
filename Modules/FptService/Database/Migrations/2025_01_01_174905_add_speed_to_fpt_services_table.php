<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpeedToFptServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fpt_services', function (Blueprint $table) {
            if (!Schema::hasColumn('fpt_services', 'speed')) {
                $table->string('speed')->nullable()->after('price');
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
        Schema::table('fpt_services', function (Blueprint $table) {
            if (Schema::hasColumn('fpt_services', 'speed')) {
                $table->dropColumn('speed');
            }
        });
    }
}
