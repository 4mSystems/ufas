<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('name')->unique();
            $table->string('mobile')->unique();
            $table->string('address')->nullable();
            $table->string('salary');
            
            $table->bigInteger('job_id')->unsigned(); 
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade'); 

            
            $table->bigInteger('dept_id')->unsigned(); 
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');


            
            $table->bigInteger('bonuses_id')->unsigned(); 
            $table->foreign('bonuses_id')->references('id')->on('bonuses')->onDelete('cascade');

            $table->string('email')->unique();
            $table->bigInteger('work_hour');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
