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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('pid')->unique()->nullable();
            $table->json('title');
            $table->string('surname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('staffno')->unique();
            $table->string('nationality');
            $table->string('designation');
            $table->foreignId('lga_id');
            $table->string('address');
            $table->date('date_of_birth');
            $table->string('hometown');
            $table->string('sex');
            $table->string('phone');
            $table->string('email');
            $table->string('marital_status');
            $table->foreignId('department_id');
            $table->string('appointment_type');
            $table->foreignId('establishment_id');
            $table->string('passport')->nullable();
            $table->string('signature')->nullable();
            $table->date('date_of_first_appointment');
            $table->date('date_of_confirmation');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('personnels');
    }
};
