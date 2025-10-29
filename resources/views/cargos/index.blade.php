@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
      
        <a href="{{ route('cargos.create') }}" class="btn btn-success flex items-center gap-2">
            <i class="fas fa-plus"></i> Nuevo Cargo
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-green-700 text-black font-semibold rounded-t-lg px-6 py-3 shadow">
            <h1 class="text-3xl font-bold text-green-700">Cargos</h1>
            <p class="text-gray-600 mt-1">Listado de cargos registrados</p>
        
    </div>
    <div class="bg-white shadow-lg rounded-xl overflow-x-auto">
        <table class="table table-striped table-hover w-full">
            <thead class="bg-green-200 text-gray-800">
                <tr>
                    <th>ID</th>
                    <th>Nombre del Cargo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cargos as $cargo)
                <tr>
                    <td>{{ $cargo->id }}</td>
                    <td>{{ $cargo->nombre_cargo }}</td>
                    <td class="flex gap-2">
                        <a href="{{ route('cargos.edit', $cargo) }}" class="btn btn-sm btn-primary flex items-center gap-1">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('cargos.destroy', $cargo) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este cargo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger flex items-center gap-1">
                                <i class="fas fa-trash-alt"></i> Borrar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
