@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Nuevo Cliente
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proyectos</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($clientes as $cliente)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($cliente->foto)
                        <img src="{{ asset('storage/' . $cliente->foto) }}" alt="Foto" class="h-10 w-10 rounded-full object-cover">
                    @else
                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-600 text-sm">N/A</span>
                        </div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $cliente->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cliente->correo }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cliente->telefono ?? 'N/A' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cliente->proyectos->count() }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('clientes.show', $cliente) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver</a>
                    <a href="{{ route('clientes.edit', $cliente) }}" class="text-green-600 hover:text-green-900 mr-3">Editar</a>
                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                    No hay clientes registrados. 
                    <a href="{{ route('clientes.create') }}" class="text-blue-600 hover:text-blue-800">Crear el primero</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($clientes->hasPages())
<div class="mt-4">
    {{ $clientes->links() }}
</div>
@endif
@endsection