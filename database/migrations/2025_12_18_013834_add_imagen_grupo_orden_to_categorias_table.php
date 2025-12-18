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
        Schema::table('categorias', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('descripcion');
            $table->string('grupo')->default('otros')->after('imagen');
            $table->integer('orden')->default(0)->after('grupo');
        });
    }
    
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropColumn(['imagen', 'grupo', 'orden']);
        });
    }
};
