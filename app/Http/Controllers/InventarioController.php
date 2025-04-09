<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Categoria; // Importar el modelo de categorías

class InventarioController extends Controller
{
    // 📌 Mostrar lista del inventario
    public function index()
    {
        $inventarios = Inventario::with('producto')->get();
        return view('inventario.index', compact('inventarios'));
    }

    // 📌 Mostrar formulario para agregar un producto al inventario
    public function create()
    {
        $productos = Producto::all();
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('inventario.create', compact('productos', 'categorias'));
    }
    

    // 📌 Guardar un nuevo producto en el inventario
    public function store(Request $request)
    {
        $request->validate([
            'producto_nombre' => 'required|string|max:255',
            'cantidad_disponible' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id', // Validar categoría existente
        ]);

        // 🔹 Verificar si el producto ya existe o crearlo
        $producto = Producto::firstOrCreate(
            ['nombre' => $request->producto_nombre],
            [
                'descripcion' => $request->descripcion ?? 'Sin descripción',
                'precio' => $request->precio ?? 0.00, // Precio predeterminado si no se envía
                'categoria_id' => $request->categoria_id, // Categoría asignada correctamente
            ]
        );

        // 🔹 Crear el inventario del producto
        Inventario::create([
            'producto_id' => $producto->id,
            'cantidad_disponible' => $request->cantidad_disponible,
            'stock_minimo' => $request->stock_minimo,
        ]);

        return redirect()->route('inventarios.index')->with('success', 'Producto agregado al inventario correctamente.');
    }

    // 📌 Editar un producto del inventario
    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);
        $productos = Producto::all();
        $categorias = Categoria::all();
        return view('inventario.edit', compact('inventario', 'productos', 'categorias'));
    }

    // 📌 Actualizar los datos de un producto en el inventario
    public function update(Request $request, $id)
    {
        $inventario = Inventario::findOrFail($id);

        $request->validate([
            'cantidad_disponible' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
        ]);

        // 🔹 Solo actualizar los datos requeridos
        $inventario->update([
            'cantidad_disponible' => $request->cantidad_disponible,
            'stock_minimo' => $request->stock_minimo,
        ]);

        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado correctamente.');
    }

    // 📌 Eliminar un producto del inventario
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);

        try {
            $inventario->delete();
            return redirect()->route('inventarios.index')->with('success', 'Producto eliminado del inventario.');
        } catch (\Exception $e) {
            return redirect()->route('inventarios.index')->with('error', 'Error al eliminar el producto.');
        }
    }
}