<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->unsigned()->nullable();
            // $table->foreign('employee_id')->references('id')->on('employees');
            // $table->string('vehicle_type', 100);
            $table->string('vin', 100)->unique();
            $table->string('registration_no', 100)->unique();
            $table->string('type', 100);
            $table->string('fuel', 100);
            $table->string('brand', 100);
            $table->string('model', 100);
            $table->string('year', 100);
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
        Schema::dropIfExists('vehicles');
    }
}
