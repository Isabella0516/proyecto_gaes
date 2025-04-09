<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Auth;

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Redirección a Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard solo para usuarios autenticados
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Rutas de Usuarios
    Route::resource('usuarios', UsuarioController::class);

    // Rutas de Roles
    Route::resource('roles', RolController::class);

    // Rutas de Facturas
    Route::resource('facturas', FacturaController::class);

    // Rutas de Pagos
    Route::resource('pagos', PagoController::class);

    // Rutas de Productos
    Route::resource('productos', ProductoController::class);

    // Rutas de Stock
    Route::resource('stocks', StockController::class);
    Route::post('stocks/movimiento', [StockController::class, 'registrarMovimiento'])->name('stocks.movimiento');

    // Rutas de Clientes
    Route::resource('clientes', ClienteController::class);

    // Rutas de Ventas
    Route::resource('ventas', VentaController::class);
    Route::get('/ventas/export/csv', [VentaController::class, 'exportCSV'])->name('ventas.export.csv');

    // Rutas de Inventario
    Route::resource('inventarios', InventarioController::class);
});