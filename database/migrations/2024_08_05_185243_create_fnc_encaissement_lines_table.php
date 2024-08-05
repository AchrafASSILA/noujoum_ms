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
        Schema::create('fnc_encaissement_lines', function (Blueprint $table) {
            $table->id();
            $table->string('Frequenc');
            $table->unsignedBigInteger('Inscription');
            $table->unsignedBigInteger('Affectation');
            $table->unsignedBigInteger('Encaissement');
            $table->unsignedBigInteger('Service');
            $table->unsignedBigInteger('Promotion');
            $table->unsignedBigInteger('User')->nullable();
            $table->decimal('Amount');
            $table->foreign('Inscription')->references('id')->on('inscriptions')->onDelete("cascade");
            $table->foreign('Promotion')->references('id')->on('promotions')->onDelete("cascade");
            $table->foreign('Service')->references('id')->on('services')->onDelete("cascade");
            $table->foreign('User')->references('id')->on('users')->onDelete("SET NULL");
            $table->foreign('Affectation')->references('id')->on('fnc_encaissement_inscriptions')->onDelete("cascade");
            $table->foreign('Encaissement')->references('id')->on('fnc_encaissements')->onDelete("cascade");
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
        Schema::dropIfExists('fnc_encaissement_lines');
    }
};
