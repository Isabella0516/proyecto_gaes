@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Agregar Stock</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tipo_producto" class="form-label">Tipo de Producto</label>
            <input type="text" name="tipo_producto" id="tipo_producto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Stock</button>
    </form>
</div>
@endsection
