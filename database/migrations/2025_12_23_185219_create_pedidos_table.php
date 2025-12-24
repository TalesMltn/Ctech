<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique(); // Ej: PED-2025-0001
            $table->enum('tipo', ['online', 'presencial']);
            $table->string('cliente_nombre');
            $table->string('cliente_correo')->nullable();
            $table->string('cliente_telefono')->nullable();
            $table->decimal('total', 10, 2);
            $table->enum('estado', ['pendiente', 'pagado', 'enviado', 'entregado', 'anulado'])->default('pendiente');
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};