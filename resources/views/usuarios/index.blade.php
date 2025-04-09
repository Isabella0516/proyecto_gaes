@extends('layouts.app')

@section('content')
<style>
    /* Fondo con degradado oscuro */
    body {
        background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
        color: #EAEAEA;
        font-family: 'Poppins', sans-serif;
    }

    /* Contenedor con efecto de tarjeta */
    .container {
        max-width: 1000px;
        margin-top: 40px;
        padding: 30px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
    }

    /* Estilo del título */
    .table-title {
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
        color: #FFD700;
    }

    /* Tabla estilizada */
    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    thead {
        background: #FFD700;
        color: #000;
        font-weight: bold;
        text-align: center;
    }

    tbody tr {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        text-align: center;
    }

    tbody tr:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Botón estilizado */
    .btn-custom {
        border: none;
        padding: 8px 15px;
        font-size: 14px;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-edit {
        background: #ffc107;
        color: #000;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-edit:hover {
        background: #e0a800;
    }

    .btn-delete:hover {
        background: #c82333;
    }

</style>

<div class="container">
    <h2 class="table-title">Usuarios Registrados</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    @if(Auth::check() && Auth::user()->rol_id == 1)
                        <th>Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->rol->nombre }}</td>
                        @if(Auth::check() && Auth::user()->rol_id == 1)
                            <td>
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-custom btn-edit">Editar</a>
                                
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-custom btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
