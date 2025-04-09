@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Lista de Stock</h2>
    <a href="{{ route('stocks.create') }}" class="btn btn-success mb-3">Agregar Nuevo Stock</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de Producto</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td>{{ $stock->tipo_producto }}</td>
                    <td>{{ $stock->cantidad }}</td>
                    <td>
                        <a href="{{ route('stocks.edit', $stock) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('stocks.destroy', $stock) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este stock?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@section('styles')
    <style>
        /* Estilos específicos para esta vista */
        .section-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .table {
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-bottom: 20px;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
@endsection

@endsection
