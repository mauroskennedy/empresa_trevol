@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-green-700 mb-4">Editar Empleado</h1>
    <p class="text-gray-600 mb-6">Actualice los datos del empleado</p>

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
        <form action="{{ route('empleados.update', $empleado) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Datos del Usuario -->
                <div>
                    <label class="block font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $empleado->user->nombre) }}" class="form-control w-full rounded border-gray-300" required>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700">Apellido Paterno</label>
                    <input type="text" name="apellido_pat" value="{{ old('apellido_pat', $empleado->user->apellido_pat) }}" class="form-control w-full rounded border-gray-300" required>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700">Apellido Materno</label>
                    <input type="text" name="apellido_mat" value="{{ old('apellido_mat', $empleado->user->apellido_mat) }}" class="form-control w-full rounded border-gray-300" required>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700">CI</label>
                    <input type="text" name="ci" value="{{ old('ci', $empleado->user->ci) }}" class="form-control w-full rounded border-gray-300" required>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700">Celular</label>
                    <input type="text" name="cel" value="{{ old('cel', $empleado->user->cel) }}" class="form-control w-full rounded border-gray-300">
                </div>
                <div>
                    <label class="block font-semibold text-gray-700">Email</label>
                    <input type="text" name="email" value="{{ old('email', $empleado->user->email) }}" class="form-control w-full rounded border-gray-300">
                </div>

                <!-- Cargo -->
                <div>
                    <label class="block font-semibold text-gray-700">Cargo</label>
                    <select name="cargo_id" class="form-control w-full rounded border-gray-300" required>
                        <option value="">-- Seleccione --</option>
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo->id }}" {{ old('cargo_id', $empleado->cargo_id) == $cargo->id ? 'selected' : '' }}>{{ $cargo->nombre_cargo }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Foto -->
                <div>
                    <label class="block font-semibold text-gray-700">Foto del Empleado</label>
                    <input type="file" name="foto" class="form-control w-full rounded border-gray-300">
                    <p class="text-sm text-gray-500 mt-1">Opcional. Si no se sube, se conservará la foto actual.</p>
                    <img src="{{ $empleado->user->foto ? asset('storage/'.$empleado->user->foto) : asset('images/avatar.png') }}" alt="Foto empleado" class="w-24 h-24 rounded-full mt-2 border border-gray-200 shadow-sm object-cover">
                </div>

                <!-- Documentos -->
                @foreach(['cedula_identidad'=>'Cédula de Identidad','cv'=>'CV','memorandum'=>'Memorandum','certificado_medico'=>'Certificado Médico','boleta_pago'=>'Boleta de Pago'] as $field => $label)
                <div>
                    <label class="block font-semibold text-gray-700">{{ $label }}</label>
                    <input type="file" name="{{ $field }}" accept="application/pdf" class="form-control w-full rounded border-gray-300">
                    <p class="text-sm text-gray-500 mt-1">Solo PDF. Opcional.</p>
                    @if($empleado->$field)
                        <a href="{{ asset('storage/'.$empleado->$field) }}" target="_blank" class="btn btn-sm btn-info mt-1">
                            <i class="fas fa-download"></i> Descargar
                        </a>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="flex gap-4 mt-6">
                <button type="submit" class="btn btn-success shadow hover:shadow-lg flex items-center gap-2">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route('empleados.index') }}" class="btn btn-danger shadow hover:shadow-lg flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
