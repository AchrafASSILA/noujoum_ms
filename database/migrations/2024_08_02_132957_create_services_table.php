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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('Label');
            $table->string('Alias');
            $table->decimal('Price');
            $table->string('Icon')->nullable();
            $table->string('Frequenc');
            $table->boolean('Obligation');
            $table->unsignedBigInteger('Section');
            $table->boolean('Enabled')->default(1);
            $table->foreign('Section')->references('id')->on('sections')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
