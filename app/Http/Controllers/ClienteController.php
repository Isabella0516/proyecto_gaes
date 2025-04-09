<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Asegurar que solo usuarios autenticados accedan
    }

    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        // Cualquier usuario autenticado puede acceder a la vista de creación
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255'
        ]);

        // Crear el cliente
        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado con éxito.');
    }

    public function show(Cliente $cliente)
    {
        // Mostrar los detalles de un cliente
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        // Cualquier usuario autenticado puede acceder a la vista de edición
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255'
        ]);

        // Actualizar el cliente
        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
    }

    public function destroy(Cliente $cliente)
    {
        // Eliminar el cliente
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado.');
    }
}