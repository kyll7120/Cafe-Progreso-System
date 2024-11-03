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
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['descuento_id']); // Elimina la clave foránea
            $table->dropColumn('categoria'); // Elimina la columna 'categoria'
            $table->dropColumn('descuento_id'); // Elimina la columna 'descuento_id'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->string('categoria'); // Reagrega la columna 'categoria'
            $table->unsignedBigInteger('descuento_id')->nullable(); // Reagrega la columna 'descuento_id'
            $table->foreign('descuento_id')->references('id')->on('descuentos')->onDelete('set null'); // Reagrega la clave foránea
        });
    }
};
