<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grupo_categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->string('icono')->nullable();
            $table->string('imagen')->nullable();
            $table->integer('orden')->default(0);
            $table->timestamps();
        });

        // Añadimos la relación en la tabla categorías existente
        Schema::table('categorias', function (Blueprint $table) {
            $table->foreignId('grupo_categoria_id')->nullable()->constrained('grupo_categorias')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropForeign(['grupo_categoria_id']);
            $table->dropColumn('grupo_categoria_id');
        });
        Schema::dropIfExists('grupo_categorias');
    }
};