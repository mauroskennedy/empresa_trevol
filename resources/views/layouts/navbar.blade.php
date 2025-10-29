<nav class="navbar shadow d-flex justify-content-between align-items-center px-5 py-3" style="min-height: 80px; background-color: var(--trevol-verde-claro);">
    {{-- Espacio izquierdo: logo o título --}}
    <div class="d-flex align-items-center gap-3">

    </div>

    {{-- Usuario a la derecha --}}
    <div class="dropdown ms-auto">
        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            {{-- Nombre completo --}}
            <span class="fw-semibold fs-5 me-3">
                {{ Auth::user()->nombre }} {{ Auth::user()->apellido_pat }} {{ Auth::user()->apellido_mat }}
            </span>

            {{-- Foto usuario --}}
            <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/avatar.png') }}" 
                 alt="Avatar" class="rounded-circle border border-white shadow-sm" width="55" height="55">
        </a>

        {{-- Dropdown --}}
        <ul class="dropdown-menu dropdown-menu-end shadow-lg mt-2" aria-labelledby="userDropdown" style="min-width:200px;">
            <li class="px-3 py-2 text-muted">
                <strong>{{ Auth::user()->rol }}</strong>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger fw-semibold">
                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
