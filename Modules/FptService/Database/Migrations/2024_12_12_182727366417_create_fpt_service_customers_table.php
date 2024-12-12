<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFptServiceCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpt_service_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fpt_service_id')->unsigned()->default(0);
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('home_address')->nullable();
            $table->string('address')->nullable();
            $table->string('apartment_name')->nullable();
            $table->string('building_name')->nullable();
            $table->tinyInteger('floor_number')->nullable();
            $table->tinyInteger('room_number')->nullable();
            $table->text('note')->nullable();
            $table->boolean('property_type')->default(1);
            $table->unsignedInteger('province_id')->default(0);
            $table->unsignedInteger('district_id')->default(0);
            $table->unsignedInteger('ward_id')->default(0);
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
        Schema::dropIfExists('fpt_service_customers');
    }
}
