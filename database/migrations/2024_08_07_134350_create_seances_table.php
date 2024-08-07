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
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->string('Label');
            $table->date('Date')->nullable();
            $table->integer('Day');
            $table->time('Start');
            $table->time('End');
            $table->unsignedBigInteger('Sale')->nullable();
            $table->unsignedBigInteger('Section')->nullable();
            $table->unsignedBigInteger('UserBy');
            $table->unsignedBigInteger('Module')->nullable();
            // $table->unsignedBigInteger('Collaborateur')->nullable();
            $table->foreign('Sale')->references('id')->on('sales')->onDelete("SET NULL");
            $table->foreign('Section')->references('id')->on('sections')->onDelete("SET NULL");
            $table->foreign('UserBy')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('Module')->references('id')->on('modules')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};
