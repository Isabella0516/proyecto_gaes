<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestor de Inventarios')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* ============================= */
        /* ESTILOS GENERALES */
        /* ============================= */

        body {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            font-family: 'Poppins', sans-serif;
            color: #EAEAEA;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ============================= */
/* BARRA DE NAVEGACIÓN */
/* ============================= */

.navbar {
    background-color: #1e3a5f; /* Azul sólido */
    padding: 12px 18px;
    box-shadow: 0 4px 10px rgba(0, 255, 255, 0.2);
}

.navbar-collapse {
    width: 100%; /* Asegura que se expanda bien */
}

.navbar-brand, .nav-link {
    color: #EAEAEA !important;
    font-weight: 600;
    transition: color 0.3s ease-in-out;
}

.nav-link:hover {
    color: #00FFFF !important;
    text-shadow: 0 0 10px #00FFFF;
}


        /* ============================= */
        /* CONTENEDOR PRINCIPAL */
        /* ============================= */

        .container {
            padding: 30px;
            background: rgba(30, 30, 30, 0.9);
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.15);
            margin-top: 30px;
        }

        /* ============================= */
        /* TÍTULOS Y TEXTOS */
        /* ============================= */

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #00FFFF;
            text-transform: uppercase;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
            margin-bottom: 20px;
        }

        /* ============================= */
/* TABLAS */
/* ============================= */

.table {
    background-color: #000; /* Ahora es completamente negro */
    color: #EAEAEA;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.2); /* Efecto de neón sutil */
}

.table thead {
    background-color: #111; /* Un negro un poco más claro para diferenciar */
    color: #00FFFF;
    font-weight: bold;
    text-shadow: 0 0 8px rgba(0, 255, 255, 0.5);
}

.table tbody tr:hover {
    background-color: rgba(0, 255, 255, 0.1); /* Efecto hover futurista */
}


        /* ============================= */
        /* BOTONES */
        /* ============================= */

        .btn-custom {
            background: linear-gradient(90deg, #00FFFF, #0077FF);
            color: #0f172a;
            border: none;
            font-weight: 700;
            transition: all 0.3s ease-in-out;
            padding: 12px 18px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
        }

        .btn-custom:hover {
            background: linear-gradient(90deg, #0077FF, #00FFFF);
            color: #1E1E1E;
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.8);
        }

        .btn-danger {
            background: linear-gradient(90deg, #ff4c4c, #ff0000);
            color: #EAEAEA;
            border: none;
            transition: all 0.3s ease-in-out;
            padding: 12px 18px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.5);
        }

        .btn-danger:hover {
            background: linear-gradient(90deg, #ff0000, #ff4c4c);
            color: #1E1E1E;
            box-shadow: 0 0 25px rgba(255, 0, 0, 0.8);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Gestor de Inventarios</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('inventarios.index') }}">Inventario</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a></li>
                @if(Auth::check() && Auth::user()->rol_id == 1)
                <li class="nav-item"><a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                @endif
                <li class="nav-item"><a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>    
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
