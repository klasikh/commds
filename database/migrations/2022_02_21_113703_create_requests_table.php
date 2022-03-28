<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->bigInteger('request_type_id')->unsigned();
            $table->string('designation')->unique()->nullable();
            $table->string('reference')->unique()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->enum('rA_approval', [0, 1])->default(0)->nullable();
            $table->bigInteger('rA_id')->unsigned()->nullable();
            $table->enum('dPal_approval', [0, 1])->default(0)->nullable();
            $table->bigInteger('dPal_director_id')->unsigned()->nullable();
            $table->string('chief_sign')->unique()->nullable();
            $table->string('department_sign')->unique()->nullable();
            $table->enum('status', [0, 1, 2, 3, 4, 5, 6, 7, 8])->default(0)->nullable();
            $table->dateTime('pw_date')->nullable();
            $table->timestamps();

            $table->foreign('request_type_id')->references('id')->on('request_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rA_id')->references('id')->on('users');
            $table->foreign('dPal_director_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
