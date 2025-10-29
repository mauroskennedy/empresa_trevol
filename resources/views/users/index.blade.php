@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Encabezado principal -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('users.create') }}" class="btn btn-success flex items-center gap-2 shadow hover:shadow-lg transition">
            <i class="fas fa-plus"></i> Nuevo Usuario
        </a>
    </div>

    <!-- Alertas -->
    @if(session('success'))
        <div class="alert alert-success mb-6 shadow-lg rounded-lg px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Encabezado de sección tabla -->
    <div class="bg-green-700 text-black font-semibold rounded-t-lg px-6 py-3 shadow">
            <h1 class="text-3xl font-bold text-green-700">Usuarios</h1>
            <p class="text-gray-600 mt-1">Listado de usuarios registrados en el sistema</p>
        
    </div>

    <!-- Tabla responsive -->
    <div class="overflow-x-auto shadow-lg rounded-b-lg bg-white border border-t-0">
        <table class="table table-striped table-hover w-full min-w-[700px]">
            <thead class="bg-green-100 text-green-900 uppercase text-sm">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Foto</th>
                    <th class="px-4 py-2 text-left">Rol</th>
                    <th class="px-4 py-2 text-left">Nombre Completo</th>
                    <th class="px-4 py-2 text-left">CI</th>
                    <th class="px-4 py-2 text-left">Celular</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-b hover:bg-green-50 transition">
                    <td class="px-4 py-2">{{ $user->id }}</td>
                    <td class="px-4 py-2">
                        <img class="rounded-full w-12 h-12 object-cover border border-gray-200 shadow-sm"
                             src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/avatar.png') }}"
                             alt="{{ $user->nombre }}">
                    </td>
                    <td class="px-4 py-2 capitalize font-medium text-gray-700">{{ $user->rol }}</td>
                    <td class="px-4 py-2 font-medium">{{ $user->nombre }} {{ $user->apellido_pat }} {{ $user->apellido_mat }}</td>
                    <td class="px-4 py-2">{{ $user->ci }}</td>
                    <td class="px-4 py-2">{{ $user->cel }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary flex items-center gap-1 shadow hover:shadow-md">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger flex items-center gap-1 shadow hover:shadow-md">
                                <i class="fas fa-trash-alt"></i> Borrar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-6 text-center text-gray-500">No hay usuarios registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
