<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAskPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('permission_date');
            $table->time('from');
            $table->time('to');
            $table->string('reason');
            $table->string('description');
            $table->date('request_date');
            $table->enum('status',['accepted','declined','notyet'])->default('notyet');
            $table->bigInteger('user_id');
            $table->bigInteger('manager_id');
            $table->bigInteger('job_id');

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
        Schema::dropIfExists('ask_permissions');
    }
}
