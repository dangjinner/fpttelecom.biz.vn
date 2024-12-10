<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFptServiceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpt_service_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fpt_service_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->string('billing_cycle')->nullable();
            $table->string('promotion_details')->nullable();
            $table->unique(['fpt_service_id', 'locale']);
            $table->foreign('fpt_service_id')->references('id')->on('fpt_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fpt_service_translations');
    }
}
