<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFptCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpt_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fpt_category_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->text('description')->nullable();

            $table->unique(['fpt_category_id', 'locale']);
            $table->foreign('fpt_category_id')->references('id')->on('fpt_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fpt_category_translations');
    }
}
