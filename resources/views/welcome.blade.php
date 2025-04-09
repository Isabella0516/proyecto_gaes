<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a tu Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Fondo oscuro con efecto degradado */
        body {
            background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
            color: #EAEAEA;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.8);
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .btn-custom {
            background: #00FFFF;
            color: #000;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: 8px;
            text-transform: uppercase;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
            border: none;
        }

        .btn-custom:hover {
            background: #0077B6;
            color: #fff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.9);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bienvenido a tu Sistema de Gestión</h1>
        <p class="lead">Gestiona tu inventario, productos y ventas fácilmente.</p>

        <a href="{{ route('login') }}" class="btn btn-custom mt-3">Ir al inicio</a>
    </div>

</body>
</html>
