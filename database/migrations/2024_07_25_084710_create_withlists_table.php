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
        Schema::create('withlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kbeasiswa');
            $table->timestamps();

            $table->foreign('id_kbeasiswa')->references('id')->on('kalender_beasiswas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withlists');
    }
};
