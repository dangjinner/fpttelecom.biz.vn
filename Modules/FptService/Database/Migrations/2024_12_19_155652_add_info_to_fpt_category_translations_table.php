<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoToFptCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fpt_category_translations', function (Blueprint $table) {
            if (!Schema::hasColumn('fpt_category_translations', 'info')) {
                $table->text('info')->nullable();
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
        Schema::table('fpt_category_translations', function (Blueprint $table) {
            $table->dropColumn('info');
        });
    }
}
