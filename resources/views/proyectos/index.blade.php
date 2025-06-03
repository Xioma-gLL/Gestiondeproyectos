@extends('layouts.app')

@section('title', 'Proyectos')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Proyectos</h1>
    <a href="{{ route('proyectos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Nuevo Proyecto
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Inicio</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Fin</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Presupuesto</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($proyectos as $proyecto)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $proyecto->nombre }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $proyecto->cliente->nombre }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($proyecto->estado == 'completado') bg-green-100 text-green-800
                        @elseif($proyecto->estado == 'en_progreso') bg-blue-100 text-blue-800
                        @elseif($proyecto->estado == 'pendiente') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst(str_replace('_', ' ', $proyecto->estado)) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $proyecto->fecha_inicio->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $proyecto->fecha_fin ? $proyecto->fecha_fin->format('d/m/Y') : 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $proyecto->presupuesto ? '$' . number_format($proyecto->presupuesto, 2) : 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('proyectos.show', $proyecto) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver</a>
                    <a href="{{ route('proyectos.edit', $proyecto) }}" class="text-green-600 hover:text-green-900 mr-3">Editar</a>
                    <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro de eliminar este proyecto?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                    No hay proyectos registrados. 
                    <a href="{{ route('proyectos.create') }}" class="text-blue-600 hover:text-blue-800">Crear el primero</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($proyectos->hasPages())
<div class="mt-4">
    {{ $proyectos->links() }}
</div>
@endif
@endsection