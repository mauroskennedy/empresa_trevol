<aside class="sidebar w-64 min-h-screen flex flex-col shadow-xl"
       style="background: linear-gradient(to bottom, #2e7d32, #1b5e20); color: #ffffff;">

    {{-- Panel superior --}}
    <div class="p-6 flex flex-col items-center border-b border-green-900">
        <img src="{{ asset('images/logotipo.png') }}" alt="Logo Trévol" 
             class="w-20 h-20 mb-3 rounded-full border-2 border-white shadow-md">
        <h3 class="text-white text-xl font-bold tracking-wider">Panel Administrativo</h3>
        <p class="text-green-200 text-sm mt-1">Sistema Corporativo</p>
    </div>

    {{-- Menú --}}
    <nav class="mt-8 flex-1 flex flex-col items-stretch px-2 space-y-2 text-base">

        <a href="dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-600 transition text-white">
            <i class="fas fa-dashboard fa-lg w-6 text-center"></i> <span>Inicio</span>
        </a>

        <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-600 transition text-white">
            <i class="fas fa-user fa-lg w-6 text-center"></i> <span>Usuarios</span>
        </a>

        <a href="{{ route('empleados.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-600 transition text-white">
            <i class="fas fa-users fa-lg w-6 text-center"></i> <span>Empleados</span>
        </a>

        <a href="{{ route('cargos.index') }}"class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-600 transition text-white">
            <i class="fas fa-chart-bar fa-lg w-6 text-center"></i> <span>Cargos</span>
        </a>

    </nav>

    {{-- Footer --}}
    <div class="p-6 border-t border-green-900 text-center text-green-200 text-sm">
        &copy; {{ date('Y') }} Trébol Corp
    </div>
</aside>