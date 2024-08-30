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
        Schema::table('fnc_encaissement_inscriptions', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('Module')->nullable()->after('Service');
            $table->foreign('Module')->references('id')->on('modules')->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fnc_encaissement_inscriptions', function (Blueprint $table) {
            //

        });
    }
};
