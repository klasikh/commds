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
        // $tableNames = config('department.table_names');
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();       // For MySQL 8.0 use string('name', 125);
            $table->string('description')->nullable();
            $table->bigInteger('department_id')->unsigned();
            // $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
