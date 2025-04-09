<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    // 📌 Mostrar formulario de creación
    public function create()
    {
        $categorias = Categoria::all(); // Obtener todas las categorías disponibles
        return view('productos.create', compact('categorias'));
    }

    // 📌 Guardar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id' // Validación de la categoría
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id, // Guardar la categoría seleccionada
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente.');
    }
}

