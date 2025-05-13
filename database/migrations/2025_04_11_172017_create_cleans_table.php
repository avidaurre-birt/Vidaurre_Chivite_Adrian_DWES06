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
        Schema::create('cleans', function (Blueprint $table) {
            $table->id();
            $table->string('ubicacion')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('cantidadRecogida_Kg')->nullable();
            $table->integer('participantes')->nullable();
            $table->string('descripcion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleans');
    }
};
