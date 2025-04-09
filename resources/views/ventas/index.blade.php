@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Listado de Ventas</h2>
    <a href="{{ route('ventas.create') }}" class="btn btn-primary">Nueva Venta</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->cliente->nombre }}</td>
                <td>{{ $venta->usuario->nombre }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
                <td>{{ $venta->fecha }}</td>
                <td>
                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                        
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('ventas.export.csv') }}" class="btn btn-success">Exportar a CSV</a>
</div>
@endsection