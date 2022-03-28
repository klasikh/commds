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
        Schema::create('mat_transferts', function (Blueprint $table) {
            $table->id();
            $table->string('title');       // For MySQL 8.0 use string('name', 125);
            $table->bigInteger('user_sender_id')->unsigned();
            $table->bigInteger('user_receiver_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_sender_id')->references('id')->on('users');
            $table->foreign('user_receiver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mat_transferts');
    }
};
