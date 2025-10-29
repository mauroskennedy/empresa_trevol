@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
       
        <a href="{{ route('empleados.create') }}" class="btn btn-success flex items-center gap-2">
            <i class="fas fa-plus"></i> Nuevo Empleado
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-green-700 text-black font-semibold rounded-t-lg px-6 py-3 shadow">
            <h1 class="text-3xl font-bold text-green-700">Empleados</h1>
            <p class="text-gray-600 mt-1">Listado de empleados registrados en el sistema</p>
        
    </div>
    <div class="bg-white shadow-lg rounded-xl overflow-x-auto">
        <table class="table table-striped table-hover w-full">
            <thead class="bg-green-200 text-gray-800">
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombre Completo</th>
                    <th>CI</th>
                    <th>Celular</th>
                    <th>Cargo</th>
                    <th>Documentos</th>
                    <th>Acciones</th> {{-- Columna separada para botones --}}
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id }}</td>
                    <td>
                        @php
                            $foto = $empleado->user && $empleado->user->foto ? asset('storage/' . $empleado->user->foto) : asset('images/avatar.png');
                        @endphp
                        <img src="{{ $foto }}" class="rounded-full w-10 h-10">
                    </td>
                    <td>{{ $empleado->user->nombre ?? '' }} {{ $empleado->user->apellido_pat ?? '' }} {{ $empleado->user->apellido_mat ?? '' }}</td>
                    <td>{{ $empleado->user->ci ?? '' }}</td>
                    <td>{{ $empleado->user->cel ?? '' }}</td>
                    <td>{{ $empleado->cargo->nombre_cargo ?? '' }}</td>
                    <td class="flex flex-wrap gap-2">
                        @foreach(['cedula_identidad'=>'CI','cv'=>'CV','memorandum'=>'Memorandum','certificado_medico'=>'Cert. Médico','boleta_pago'=>'Boleta'] as $campo => $nombre)
                            @if($empleado->$campo)
                                <a href="{{ asset('storage/' . $empleado->$campo) }}" target="_blank" class="btn btn-success btn-sm" title="{{ $nombre }}">
                                    <i class="fas fa-file-pdf"></i> {{ $nombre }}
                                </a>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>{{ $nombre }}</button>
                            @endif
                        @endforeach
                    </td>
                    {{-- Nueva columna solo para botones --}}
                    <td class="flex gap-2">
                        <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-sm btn-primary flex items-center gap-1">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este empleado?');">
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