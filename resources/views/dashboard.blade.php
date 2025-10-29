@extends('layouts.app')

@section('content')
<div id="module-content" class="flex justify-center items-center h-full min-h-[70vh]">

    {{-- Banner de bienvenida --}}
    <div class="bg-gradient-to-r from-green-700 to-green-500 rounded-2xl p-16 shadow-2xl flex flex-col items-center text-center">
        <h1 class="text-2xl md:text-3xl font-semibold text-green-100 tracking-wide drop-shadow-md">
            Bienvenido al Sistema Corporativo
        </h1>
        <h2 class="text-2xl md:text-3xl font-semibold text-green-100 tracking-wide drop-shadow-md">
            Trébol S.A.
        </h2>
        <p class="text-lg md:text-xl text-green-200 mt-4 max-w-xl">
            Gestiona usuarios, empleados y estadísticas de manera eficiente y profesional.
        </p>

        {{-- Icono decorativo --}}
        <i class="fas fa-leaf text-green-200 text-7xl mt-8 animate-bounce drop-shadow-lg"></i>
    </div>

</div>
@endsection