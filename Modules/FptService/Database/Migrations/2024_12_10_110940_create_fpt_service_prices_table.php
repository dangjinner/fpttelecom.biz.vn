<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFptServicePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpt_service_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fpt_service_id')->index();
            $table->string('type', 20)->index();
            $table->double('price');
            $table->unsignedInteger('province_id')->index();
            $table->unsignedInteger('district_id')->index()->default(0);
            $table->unsignedInteger('ward_id')->index()->default(0);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fpt_service_prices');
    }
}
