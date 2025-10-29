@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-green-700 mb-4">Editar Usuario</h1>
    <p class="text-gray-600 mb-6">Actualice los datos del usuario</p>

    @if ($errors->any())
        <div class="alert alert-danger mb-6 shadow-lg rounded-lg px-4 py-3">
            <ul class="list-disc list-inside text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg p-6">
        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nombre" class="block font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $user->nombre) }}" class="form-control w-full rounded border-gray-300" required>
                </div>
                <div>
                    <label for="apellido_pat" class="block font-semibold text-gray-700">Apellido Paterno</label>
                    <input type="text" name="apellido_pat" id="apellido_pat" value="{{ old('apellido_pat', $user->apellido_pat) }}" class="form-control w-full rounded border-gray-300" required>
                </div>
                <div>
                    <label for="apellido_mat" class="block font-semibold text-gray-700">Apellido Materno</label>
                    <input type="text" name="apellido_mat" id="apellido_mat" value="{{ old('apellido_mat', $user->apellido_mat) }}" class="form-control w-full rounded border-gray-300" required>
                </div>
                <div>
                    <label for="ci" class="block font-semibold text-gray-700">CI</label>
                    <input type="text" name="ci" id="ci" value="{{ old('ci', $user->ci) }}" class="form-control w-full rounded border-gray-300" required>
                </div>
                <div>
                    <label for="cel" class="block font-semibold text-gray-700">Celular</label>
                    <input type="text" name="cel" id="cel" value="{{ old('cel', $user->cel) }}" class="form-control w-full rounded border-gray-300">
                </div>
                <div>
                    <label for="email" class="block font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control w-full rounded border-gray-300" required>
                </div>
                <div>
                    <label for="password" class="block font-semibold text-gray-700">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control w-full rounded border-gray-300">
                    <p class="text-sm text-gray-500 mt-1">Opcional. Solo complete si desea cambiar la contraseña.</p>
                </div>
                <div>
                    <label for="password_confirmation" class="block font-semibold text-gray-700">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control w-full rounded border-gray-300">
                </div>
                <div>
                    <label for="rol" class="block font-semibold text-gray-700">Rol</label>
                    <select name="rol" id="rol" class="form-control w-full rounded border-gray-300" required>
                        <option value="">-- Seleccione --</option>
                        <option value="administrador" {{ old('rol', $user->rol)=='administrador' ? 'selected' : '' }}>Administrador</option>
                        <option value="secretaria" {{ old('rol', $user->rol)=='secretaria' ? 'selected' : '' }}>Secretaria</option>
                    </select>
                </div>
                <div>
                    <label for="foto" class="block font-semibold text-gray-700">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control w-full rounded border-gray-300">
                    <p class="text-sm text-gray-500 mt-1">Opcional. Si no se sube, se conservará la foto actual.</p>
                    @if($user->foto)
                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto usuario" class="w-24 h-24 rounded-full mt-2 border border-gray-200 shadow-sm object-cover">
                    @else
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar por defecto" class="w-24 h-24 rounded-full mt-2 border border-gray-200 shadow-sm object-cover">
                    @endif
                </div>
            </div>

            <div class="flex gap-4 mt-6">
                <button type="submit" class="btn btn-success shadow hover:shadow-lg flex items-center gap-2">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-danger shadow hover:shadow-lg flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
