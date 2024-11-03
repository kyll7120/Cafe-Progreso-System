<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('insumos', function (Blueprint $table) {
            $table->decimal('existencias', 8, 2)->change(); 
        });
    }

    public function down()
    {
        Schema::table('insumos', function (Blueprint $table) {
            $table->dropColumn('existencias'); // Eliminar la columna al hacer rollback
        });
    }
};
