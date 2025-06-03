<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'presupuesto',
        'cliente_id'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'presupuesto' => 'decimal:2'
    ];

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Estados posibles del proyecto
    public static function getEstados()
    {
        return [
            'pendiente' => 'Pendiente',
            'en_progreso' => 'En Progreso',
            'completado' => 'Completado',
            'cancelado' => 'Cancelado'
        ];
    }
}