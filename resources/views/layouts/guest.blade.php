<x-app-layout>
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <!-- Logo -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo-trevol.png') }}" alt="Logo Empresa Trévol" class="w-24 h-24 mb-3">
            <h2 class="text-2xl font-bold text-emerald-700">EMPRESA TRÉVOL</h2>
            <p class="text-gray-500 text-sm">Sistema de Gestión Académica</p>
        </div>

        <!-- Estado de sesión -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Errores de validación -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Formulario de login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-label for="email" :value="__('Correo Electrónico')" class="text-gray-700 font-semibold" />
                <x-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-emerald-400 focus:border-emerald-400"
                    type="email" name="email" :value="old('email')" required autofocus placeholder="ejemplo@trevol.com" />
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <x-label for="password" :value="__('Contraseña')" class="text-gray-700 font-semibold" />
                <x-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-emerald-400 focus:border-emerald-400"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>

            <!-- Recordarme y olvidaste contraseña -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-emerald-600 hover:text-emerald-800 font-medium" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>

            <!-- Botón -->
            <div>
                <button type="submit"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-lg transition duration-200 shadow-md">
                    Iniciar Sesión
                </button>
            </div>
        </form>

        <!-- Pie de página -->
        <p class="mt-6 text-gray-700 text-sm text-center">
            &copy; {{ date('Y') }} <span class="font-semibold text-emerald-700">Empresa Trévol</span>. Todos los derechos reservados.
        </p>
    </div>
</x-app-layout>
