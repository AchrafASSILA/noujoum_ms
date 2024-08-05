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
        Schema::create('fnc_encaissements', function (Blueprint $table) {
            $table->id();
            $table->decimal('Total');
            $table->text('RecuNumber');
            $table->text('Mode');
            $table->text('OperationNumber');
            $table->unsignedBigInteger('Inscription');
            $table->unsignedBigInteger('Promotion');
            $table->unsignedBigInteger('User')->nullable();
            $table->foreign('Inscription')->references('id')->on('inscriptions')->onDelete("cascade");
            $table->foreign('Promotion')->references('id')->on('promotions')->onDelete("cascade");
            $table->foreign('User')->references('id')->on('users')->onDelete("SET NULL");
            $table->text('Canceled')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fnc_encaissements');
    }
};
