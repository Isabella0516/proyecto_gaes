@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 bg-dark text-light rounded">
        <h2 class="text-center text-warning mb-4">Inventario</h2>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Botón para agregar producto --}}
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('inventarios.create') }}" class="btn btn-warning fw-bold">+ Agregar Producto</a>
        </div>

        {{-- Tabla de inventario --}}
        <div class="table-responsive">
            <table class="table table-dark table-striped border-warning">
                <thead class="text-warning">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad Disponible</th>
                        <th>Stock Mínimo</th>
                        @if(Auth::check() && Auth::user()->rol_id == 1)
                        <th class="text-center">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventarios as $inventario)
                    <tr @if($inventario->cantidad_disponible <= $inventario->stock_minimo) class="table-danger" @endif>
                        <td>{{ $inventario->producto->nombre }}</td>
                        <td>{{ $inventario->cantidad_disponible }}</td>
                        <td>{{ $inventario->stock_minimo }}</td>
                        <td class="text-center">
                        @if(Auth::check() && Auth::user()->rol_id == 1)    
                        <a href="{{ route('inventarios.edit', $inventario->id) }}" class="btn btn-warning btn-sm fw-bold">Editar</a>
                            <form action="{{ route('inventarios.destroy', $inventario->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm fw-bold" onclick="return confirm('¿Seguro que deseas eliminar este producto del inventario?');">Eliminar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection