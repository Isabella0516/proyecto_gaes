@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles de la Venta #{{ $venta->id }}</h2>

    <table class="table">
        <tr>
            <th>Cliente:</th>
            <td>{{ $venta->cliente->nombre }}</td>
        </tr>
        <tr>
            <th>Vendedor:</th>
            <td>{{ $venta->usuario->nombre }}</td>
        </tr>
        <tr>
            <th>Total:</th>
            <td>${{ number_format($venta->total, 2) }}</td>
        </tr>
        <tr>
            <th>Fecha:</th>
            <td>{{ $venta->fecha }}</td>
        </tr>
    </table>

    <a href="{{ route('ventas.index') }}" class="btn btn-primary">Volver</a>
    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning">Editar</a>

    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
</div>
@endsection
