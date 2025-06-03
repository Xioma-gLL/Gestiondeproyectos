@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Detalles del Cliente</h1>
        <div>
            <a href="{{ route('clientes.edit', $cliente) }}" class="text-blue-600 hover:text-blue-800 mr-3">Editar</a>
            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
            </form>
        </div>
    </div>

    <div class="flex items-start space-x-6">
        @if($cliente->foto)
            <img src="{{ asset('storage/' . $cliente->foto) }}" alt="Foto" class="h-32 w-32 rounded-full object-cover">
        @endif
        
        <div class="space-y-4 flex-1">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Nombre:</h2>
                <p class="text-gray-900">{{ $cliente->nombre }}</p>
            </div>
            
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Correo:</h2>
                <p class="text-gray-900">{{ $cliente->correo }}</p>
            </div>
            
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Teléfono:</h2>
                <p class="text-gray-900">{{ $cliente->telefono ?? 'N/A' }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Proyectos:</h2>
                <p class="text-gray-900">{{ $cliente->proyectos->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="mt-6">
        <a href="{{ route('clientes.index') }}" class="text-blue-600 hover:text-blue-800">← Volver a la lista</a>
    </div>
</div>
@endsection