
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['pendiente', 'en_progreso', 'completado', 'cancelado'])->default('pendiente');
            $table->decimal('presupuesto', 10, 2)->nullable()->after('estado');
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
    
};