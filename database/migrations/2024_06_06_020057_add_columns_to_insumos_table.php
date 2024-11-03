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
        Schema::table('insumos', function (Blueprint $table) {
            $table->string('nombre')->nullable(); // Permitir valores nulos temporalmente
            $table->string('categoria')->nullable(); // Permitir valores nulos temporalmente
            $table->integer('existencias')->nullable(); // Permitir valores nulos temporalmente
            $table->integer('utilidad')->nullable(); // Permitir valores nulos temporalmente
            $table->decimal('precio_unitario', 8, 2)->nullable(); // Permitir valores nulos temporalmente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insumos', function (Blueprint $table) {
            $table->dropColumn('nombre');
            $table->dropColumn('categoria');
            $table->dropColumn('existencias');
            $table->dropColumn('utilidad');
            $table->dropColumn('precio_unitario');
        });
    }
};
