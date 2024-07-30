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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('Cin')->nullable();
            $table->string('Region')->nullable();
            $table->string('Province')->nullable();
            $table->string('Facebook')->nullable();
            $table->string('Ville')->nullable();
            $table->string('Arrondissement')->nullable();
            $table->string('Instagram')->nullable();
            $table->string('Tiktok')->nullable();
            $table->boolean('Handicap')->default(0);
            $table->string('TypeHandicap')->nullable();
            $table->date('DateHandicap')->nullable();
            $table->text('CauseHandicap')->nullable();
            $table->string('Autonomie')->nullable();
            $table->unsignedBigInteger('User');
            $table->foreign('User')->references('id')->on('users')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
