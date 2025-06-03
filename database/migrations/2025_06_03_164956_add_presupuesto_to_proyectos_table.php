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
        Schema::table('proyectos', function (Blueprint $table) {
            $table->decimal('presupuesto', 10, 2)
                ->nullable()
                ->after('estado'); // Esto coloca el campo después de 'estado'
        });
    }

    public function down()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('presupuesto');
        });
    }
};
