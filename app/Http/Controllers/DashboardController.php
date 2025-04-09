<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count(); // Contar productos
        $totalClientes = Cliente::count();   // Contar clientes

        return view('dashboard', compact('totalProductos', 'totalClientes'));
    }
}
