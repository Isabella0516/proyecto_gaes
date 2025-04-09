@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4">Registrar Cliente</h2>
        
        <div class="card shadow-lg p-4">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-bold">Correo Electrónico:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label fw-bold">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="direccion" class="form-label fw-bold">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}">
                    </div>
                </div>  

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success px-4">Registrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
