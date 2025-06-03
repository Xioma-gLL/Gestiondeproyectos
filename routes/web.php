<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return redirect()->route('clientes.index');
});

// Rutas para Clientes
Route::resource('clientes', ClienteController::class);

// Rutas para Proyectos
Route::resource('proyectos', ProyectoController::class);