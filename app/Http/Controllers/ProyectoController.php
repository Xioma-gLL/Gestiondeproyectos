<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with('cliente')->paginate(10);
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('proyectos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:pendiente,en_progreso,completado,cancelado',
            'presupuesto' => 'nullable|numeric|min:0',
            'cliente_id' => 'required|exists:clientes,id'
        ]);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto creado exitosamente.');
    }

    public function show(Proyecto $proyecto)
    {
        $proyecto->load('cliente');
        return view('proyectos.show', compact('proyecto'));
    }

    public function edit(Proyecto $proyecto)
    {
        $clientes = Cliente::all();
        return view('proyectos.edit', compact('proyecto', 'clientes'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:pendiente,en_progreso,completado,cancelado',
            'presupuesto' => 'nullable|numeric|min:0',
            'cliente_id' => 'required|exists:clientes,id'
        ]);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto eliminado exitosamente.');
    }
}
