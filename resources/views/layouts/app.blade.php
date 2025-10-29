<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TREBOL S.A.</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS compilado -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-papertodo..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- FontAwesome -->
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --trevol-verde: #2e7d32;
            --trevol-verde-claro: #4caf50;
            --trevol-verde-oscuro: #1b5e20;
            --trevol-blanco: #ffffff;
            --trevol-gris: #f3f4f6;
        }
        body { background-color: var(--trevol-gris); }
        .sidebar a:hover { background-color: var(--trevol-verde-claro); color: var(--trevol-blanco); }
    </style>
</head>
<body class="font-sans antialiased">

    @auth
        <div class="flex min-h-screen">
            {{-- Sidebar --}}
            @include('layouts.sidebar')

            {{-- Columna derecha (navbar + contenido) --}}
            <div class="flex-1 flex flex-col">
                @include('layouts.navbar')

                <main class="flex-1 p-5 overflow-y-auto">
                    @yield('content')
                </main>
            </div>
        </div>
    @else
        {{-- Para login u otras vistas --}}
        @yield('content')
    @endauth

</body>
</html>