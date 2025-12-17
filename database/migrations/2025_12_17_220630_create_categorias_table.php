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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');           // Ej: "Laptops de Oficina"
            $table->string('slug')->unique();   // Ej: "laptops-oficina" (para URLs bonitas)
            $table->text('descripcion')->nullable();
            $table->string('icono')->nullable(); // Ej: "💻" o "🎮"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
