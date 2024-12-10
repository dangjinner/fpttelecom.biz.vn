<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFptServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpt_service_categories', function (Blueprint $table) {
            $table->integer('fpt_service_id')->unsigned();
            $table->integer('fpt_category_id')->unsigned();

            $table->primary(['fpt_service_id', 'fpt_category_id']);
            $table->foreign('fpt_service_id')->references('id')->on('fpt_services')->onDelete('cascade');
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
        Schema::dropIfExists('fpt_service_categories');
    }
}
