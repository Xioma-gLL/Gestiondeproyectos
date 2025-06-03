@extends('layouts.app')

@section('title', 'Detalles del Proyecto')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Detalles del Proyecto</h1>
        <div class="flex space-x-2">
            <a href="{{ route('proyectos.edit', $proyecto) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Editar
            </a>
            <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('¿Estás seguro de eliminar este proyecto?')">
                    Eliminar
                </button>
            </form>
            <a href="{{ route('proyectos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Volver
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-4">Información Básica</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Nombre del Proyecto</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $proyecto->nombre }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Cliente</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $proyecto->cliente->nombre }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Estado</h3>
                        <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($proyecto->estado == 'completado') bg-green-100 text-green-800
                            @elseif($proyecto->estado == 'en_progreso') bg-blue-100 text-blue-800
                            @elseif($proyecto->estado == 'pendiente') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $proyecto->estado)) }}
                        </span>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-4">Detalles del Proyecto</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Fecha de Inicio</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $proyecto->fecha_inicio->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Fecha de Fin</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $proyecto->fecha_fin ? $proyecto->fecha_fin->format('d/m/Y') : 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Presupuesto</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $proyecto->presupuesto ? '$' . number_format($proyecto->presupuesto, 2) : 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Descripción</h2>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-700">{{ $proyecto->descripcion ?? 'No hay descripción disponible' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection