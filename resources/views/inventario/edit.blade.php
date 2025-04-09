@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 bg-dark text-light rounded">
        <h2 class="text-center text-warning mb-4">Editar Producto</h2>

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

        <form action="{{ route('inventarios.update', $inventario->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nombre del producto --}}
            <div class="mb-3">
                <label for="nombre" class="form-label text-warning fw-bold">Nombre:</label>
                <input type="text" name="nombre" class="form-control bg-secondary text-white" value="{{ $inventario->nombre }}" required>
            </div>

            {{-- Cantidad --}}
            <div class="mb-3">
                <label for="cantidad" class="form-label text-warning fw-bold">Cantidad:</label>
                <input type="number" name="cantidad" class="form-control bg-secondary text-white" value="{{ $inventario->cantidad }}" required>
            </div>

            {{-- Precio --}}
            <div class="mb-3">
                <label for="precio" class="form-label text-warning fw-bold">Precio:</label>
                <input type="number" step="0.01" name="precio" class="form-control bg-secondary text-white" value="{{ $inventario->precio }}" required>
            </div>

            {{-- Descripción --}}
            <div class="mb-3">
                <label for="descripcion" class="form-label text-warning fw-bold">Descripción:</label>
                <textarea name="descripcion" class="form-control bg-secondary text-white">{{ $inventario->descripcion }}</textarea>
            </div>

            {{-- Botón de actualizar --}}
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-warning fw-bold px-4">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
