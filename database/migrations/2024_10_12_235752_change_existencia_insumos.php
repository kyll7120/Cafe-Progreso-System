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
            $table->integer('existencias')->change(); // Cambiar de nuevo a integer en caso de rollback
        });
    }
};
