<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('proyectos')->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:clientes',
            'telefono' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['nombre', 'correo', 'telefono']);
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Cliente::create($data);
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('proyectos');
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:clientes,correo,' . $cliente->id,
            'telefono' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['nombre', 'correo', 'telefono']);
        
        if ($request->hasFile('foto')) {
            if ($cliente->foto) {
                Storage::disk('public')->delete($cliente->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $cliente->update($data);
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->foto) {
            Storage::disk('public')->delete($cliente->foto);
        }
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente');
    }
    
}