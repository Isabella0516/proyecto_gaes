@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 bg-dark text-light rounded">
        <h2 class="text-center text-warning mb-4">Registrar Nueva Venta</h2>

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf

            {{-- Selección del cliente --}}
            <div class="mb-3">
                <label for="cliente_id" class="form-label text-warning">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control bg-dark text-light border-warning" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Selección del vendedor --}}
            <div class="mb-3">
                <label for="usuario_id" class="form-label text-warning">Vendedor</label>
                <select name="usuario_id" id="usuario_id" class="form-control bg-dark text-light border-warning" required>
                    <option value="">Seleccione un vendedor</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Selección de un producto --}}
<div class="mb-3">
    <label for="producto_id" class="form-label text-warning">Producto</label>
    <select name="producto_id" id="producto_id" class="form-control bg-dark text-light border-warning" required>
        <option value="">Seleccione un producto</option>
        @foreach ($inventarios as $inventario)
            <option value="{{ $inventario->id }}">
                {{ $inventario->producto->nombre }} (Disponible: {{ $inventario->cantidad_disponible }})
            </option>
        @endforeach
    </select>
</div>

{{-- Cantidad del producto --}}
<div class="mb-3">
    <label for="cantidad" class="form-label text-warning">Cantidad</label>
    <input type="number" name="cantidad" id="cantidad" class="form-control bg-dark text-light border-warning" placeholder="Cantidad" min="1" required>
</div>

            {{-- Total de la venta --}}
            <div class="mb-3">
                <label for="total" class="form-label text-warning">Total Venta</label>
                <input type="number" name="total" id="total" class="form-control bg-dark text-light border-warning" step="0.01" required>
            </div>

            {{-- Fecha de la venta --}}
            <div class="mb-3">
                <label for="fecha" class="form-label text-warning">Fecha de Venta</label>
                <input type="datetime-local" name="fecha" id="fecha" class="form-control bg-dark text-light border-warning" required>
            </div>

            {{-- Botón de enviar --}}
            <button type="submit" class="btn btn-warning text-dark fw-bold w-100">Registrar Venta</button>
        </form>
    </div>
</div>
@endsection