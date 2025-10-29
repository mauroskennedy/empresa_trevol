<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TREBOL S.A.</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        :root {
            --trevol-verde: #4CAF50;
            --trevol-verde-claro: #81C784;
            --trevol-verde-oscuro: #388E3C;
            --trevol-blanco: #FFFFFF;
            --trevol-gris: #F7F9F8;
        }

        body {
            background: linear-gradient(135deg, var(--trevol-verde-claro), var(--trevol-verde));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Nunito', sans-serif;
        }

        .login-card {
            background-color: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 2rem;
            width: 380px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .login-card h2 {
            margin-bottom: 1.5rem;
            color: var(--trevol-verde-oscuro);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            margin-bottom: 1rem;
            border-radius: 10px;
            border: 1px solid var(--trevol-verde-claro);
        }

        .btn-trevol {
            width: 100%;
            padding: 0.8rem;
            border-radius: 10px;
            border: none;
            background-color: var(--trevol-verde);
            color: var(--trevol-blanco);
            font-weight: 600;
            cursor: pointer;
        }

        .btn-trevol:hover {
            background-color: var(--trevol-verde-oscuro);
        }
    </style>
</head>
<body>
    @guest
        <div class="login-card">
            <img src="{{ asset('images/logotipo.png') }}" alt="Logo Trévol" class="w-20 mx-auto mb-4">
            <h2>Bienvenido a Trévol</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                <button type="submit" class="btn-trevol mt-2">Iniciar sesión</button>
            </form>
        </div>
    @else
        {{-- Redirige a dashboard si ya está logueado --}}
        <script>window.location.href = "{{ route('dashboard') }}";</script>
    @endguest
</body>
</html>
