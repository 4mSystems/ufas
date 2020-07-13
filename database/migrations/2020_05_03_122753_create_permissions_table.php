<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->enum('overtimePage',['yes','no'])->default('no');
            $table->enum('jobsPage',['yes','no'])->default('no');
            $table->enum('employeePage',['yes','no'])->default('no');
            $table->enum('departmentPage',['yes','no'])->default('no');
            $table->enum('permissionPage',['yes','no'])->default('no');

            $table->enum('vacations',['yes','no'])->default('no');
            $table->enum('workplaces',['yes','no'])->default('no');
            $table->enum('officialvacations',['yes','no'])->default('no');
            $table->enum('shifts',['yes','no'])->default('no');
            $table->enum('settings',['yes','no'])->default('no');
            $table->enum('Archievs',['yes','no'])->default('no');
            $table->enum('dailyreport',['yes','no'])->default('no');
            $table->enum('mothlyreport',['yes','no'])->default('no');

            $table->enum('archievesEdit',['yes','no'])->default('no');

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
        Schema::dropIfExists('permissions');
    }
}
