<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpsShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emps_shifts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('shift_id')->unsigned();
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
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
        Schema::dropIfExists('emps_shifts');
    }
}
