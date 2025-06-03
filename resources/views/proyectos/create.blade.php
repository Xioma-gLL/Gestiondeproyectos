@extends('layouts.app')

@section('title', 'Crear Proyecto')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Crear Nuevo Proyecto</h1>
        <a href="{{ route('proyectos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Volver
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('proyectos.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre del Proyecto *
                </label>
                <input type="text" 
                       id="nombre" 
                       name="nombre" 
                       value="{{ old('nombre') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nombre') border-red-500 @enderror"
                       required>
                @error('nombre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cliente_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Cliente *
                </label>
                <select id="cliente_id" 
                        name="cliente_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('cliente_id') border-red-500 @enderror"
                        required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('cliente_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                    Descripción
                </label>
                <textarea id="descripcion" 
                          name="descripcion" 
                          rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Inicio *
                    </label>
                    <input type="date" 
                           id="fecha_inicio" 
                           name="fecha_inicio" 
                           value="{{ old('fecha_inicio') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('fecha_inicio') border-red-500 @enderror"
                           required>
                    @error('fecha_inicio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Fin
                    </label>
                    <input type="date" 
                           id="fecha_fin" 
                           name="fecha_fin" 
                           value="{{ old('fecha_fin') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('fecha_fin') border-red-500 @enderror">
                    @error('fecha_fin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                        Estado *
                    </label>
                    <select id="estado" 
                            name="estado" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('estado') border-red-500 @enderror"
                            required>
                        @foreach(\App\Models\Proyecto::getEstados() as $key => $label)
                            <option value="{{ $key }}" {{ old('estado', 'pendiente') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="presupuesto" class="block text-sm font-medium text-gray-700 mb-2">
                        Presupuesto
                    </label>
                    <input type="number" 
                           id="presupuesto" 
                           name="presupuesto" 
                           step="0.01" 
                           min="0"
                           value="{{ old('presupuesto') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('presupuesto') border-red-500 @enderror"
                           placeholder="0.00">
                    @error('presupuesto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('proyectos.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Crear Proyecto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection