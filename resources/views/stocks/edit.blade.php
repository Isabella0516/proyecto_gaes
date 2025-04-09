@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Editar Stock</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stocks.update', $stock->id) }}" method="POST" class="stock-form">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tipo_producto" class="form-label">Tipo de Producto</label>
            <input type="text" class="form-control" id="tipo_producto" name="tipo_producto" value="{{ old('tipo_producto', $stock->tipo_producto) }}" required>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad', $stock->cantidad) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@section('styles')
    <style>
        /* Estilos personalizados para la página de edición */
        .section-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .stock-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
@endsection

@endsection
