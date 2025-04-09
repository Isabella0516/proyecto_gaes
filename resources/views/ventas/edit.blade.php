@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 bg-dark text-light rounded">
        <h2 class="text-center text-warning mb-4">Editar Venta #{{ $venta->id }}</h2>

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

        <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Selección del cliente --}}
            <div class="mb-3">
                <label for="cliente_id" class="form-label text-warning">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control bg-dark text-light border-warning" required>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $venta->cliente_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Selección del vendedor --}}
            <div class="mb-3">
                <label for="usuario_id" class="form-label text-warning">Vendedor</label>
                <select name="usuario_id" id="usuario_id" class="form-control bg-dark text-light border-warning" required>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ $venta->usuario_id == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Total de la venta --}}
            <div class="mb-3">
                <label for="total" class="form-label text-warning">Total Venta</label>
                <input type="number" name="total" id="total" class="form-control bg-dark text-light border-warning"
                       step="0.01" value="{{ $venta->total }}" required>
            </div>

            {{-- Fecha de la venta --}}
            <div class="mb-3">
                <label for="fecha" class="form-label text-warning">Fecha de Venta</label>
                <input type="datetime-local" name="fecha" id="fecha"
                       class="form-control bg-dark text-light border-warning"
                       value="{{ date('Y-m-d\TH:i', strtotime($venta->fecha)) }}" required>
            </div>

            {{-- Botones --}}
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-warning text-dark fw-bold w-50 me-2">Guardar Cambios</button>
                <a href="{{ route('ventas.index') }}" class="btn btn-secondary w-50 ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
