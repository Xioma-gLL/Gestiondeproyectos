@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Nuevo Cliente</h1>
    
    <form action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
            @error('nombre')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Correo</label>
            <input type="email" name="correo" value="{{ old('correo') }}" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
            @error('correo')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono') }}" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            @error('telefono')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Foto</label>
            <input type="file" name="foto" accept="image/*" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            @error('foto')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Guardar
            </button>
            <a href="{{ route('clientes.index') }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
        </div>
    </form>
</div>
@endsection