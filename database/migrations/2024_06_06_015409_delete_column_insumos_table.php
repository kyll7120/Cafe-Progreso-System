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
            $table->dropColumn('nombreInsumo');
            $table->dropForeign(['id_categoria']);
            $table->dropColumn('id_categoria');
            $table->dropColumn('existenciaInsumo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insumos', function (Blueprint $table) {
            $table->string('nombreInsumo');
            $table->foreignId('id_categoria')->constrained('categorias')->cascadeOnUpdate();
            $table->integer('existenciaInsumo');
        });
    }
};
