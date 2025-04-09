@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Fondo oscuro con degradado moderno */
    body {
        background: linear-gradient(135deg, #141E30, #243B55);
        color: #EAEAEA;
        font-family: 'Poppins', sans-serif;
        text-align: center;
    }

    /* Estilos para el contenedor */
    .container {
        padding: 50px 15px;
    }

    /* Título principal con efecto */
    .section-title {
        font-size: 2.8rem;
        font-weight: bold;
        text-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
        margin-bottom: 30px;
    }

    /* Estilos para las tarjetas */
    .card {
        background: rgba(0, 0, 0, 0.85);
        border: 1px solid rgba(0, 255, 255, 0.3);
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        transition: all 0.3s ease-in-out;
        padding: 30px;
    }

    /* Efecto de brillo al pasar el mouse */
    .card:hover {
        box-shadow: 0 0 30px rgba(0, 255, 255, 0.8);
        transform: translateY(-5px);
    }

    /* Tamaño del número en cada tarjeta */
    .card p {
        font-size: 2.5rem;
        font-weight: bold;
    }

    /* Mensaje del día con efecto de neón */
    .quote {
        font-size: 1.5rem;
        font-weight: bold;
        text-shadow: 0 0 10px rgba(0, 191, 255, 0.7);
    }
</style>

<div class="container">
    <h1 class="section-title">Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white mb-4">
                <h3>Total de Productos</h3>
                <p class="text-warning">{{ $totalProductos ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white mb-4">
                <h3>Total de Clientes</h3>
                <p class="text-warning">{{ $totalClientes ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white mb-4">
                <h3>Total de Usuarios</h3>
                <p class="text-warning">{{ $totalUsuarios ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-white mb-4">
                <h3>Última Actualización</h3>
                <p class="text-info">{{ $ultimaActualizacion ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card text-white mb-4">
                <h3>Estado del Sistema</h3>
                <p class="text-success">Operativo</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card text-white mb-4">
                <h3>Mensaje del Día</h3>
                <p class="quote">"El éxito es la suma de pequeños esfuerzos repetidos cada día."</p>
            </div>
        </div>
    </div>
</div>
@endsection
