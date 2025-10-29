@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Título --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-green-700">Editar Cargo</h1>
        <p class="text-gray-600">Modifica la información del cargo seleccionado.</p>
    </div>

    {{-- Formulario --}}
    <form action="{{ route('cargos.update', $cargo) }}" method="POST" class="bg-white shadow-lg rounded-xl p-6 max-w-lg mx-auto">
        @csrf
        @method('PUT')

        {{-- Campo Nombre del Cargo --}}
        <div class="mb-5">
            <label for="nombre_cargo" class="block text-gray-700 font-semibold mb-2">Nombre del Cargo <span class="text-red-500">*</span></label>
            <input type="text" name="nombre_cargo" id="nombre_cargo"
                value="{{ old('nombre_cargo', $cargo->nombre_cargo) }}"
                placeholder="Ingrese el nombre del cargo"
                class="form-input w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-green-400 @error('nombre_cargo') border-red-500 @enderror">
            @error('nombre_cargo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="flex justify-between items-center mt-6">
            <button type="submit" class="btn btn-primary flex items-center gap-2">
                <i class="fas fa-edit"></i> Actualizar Cargo
            </button>
            <a href="{{ route('cargos.index') }}" class="btn btn-danger flex items-center gap-2">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
