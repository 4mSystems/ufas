<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempMonthliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_monthlies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('check_date');
            $table->string('shift');
            $table->string('day');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->time('attendance_delay')->nullable();
            $table->time('leave_early')->nullable();
            $table->time('attendance_early')->nullable();
            $table->time('leave_delay')->nullable();
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->enum('no_attendance',['yes','no'])->default('no');
            $table->enum('no_leave',['yes','no'])->default('no');
            $table->enum('absences',['yes','no'])->default('no');

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
        Schema::dropIfExists('temp_monthlies');
    }
}
