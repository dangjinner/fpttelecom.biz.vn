<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFptServiceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpt_service_products', function (Blueprint $table) {
            $table->primary(['fpt_service_id', 'product_id']);
            $table->unsignedInteger('fpt_service_id');
            $table->unsignedInteger('product_id');
            $table->foreign('fpt_service_id')->references('id')->on('fpt_services')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fpt_service_products');
    }
}
