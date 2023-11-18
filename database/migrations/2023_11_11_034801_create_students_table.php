<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('email');
            $table->string('password');
            $table->string('gender');
            $table->string('address');
            $table->boolean('status')->default(0);
            $table->integer('phone_parent');
            $table->date('join_date');
            $table->foreignId('chargeFor_id')->constrained('charge_fors');
            $table->foreignId('classRoom_id')->constrained('class_rooms');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
