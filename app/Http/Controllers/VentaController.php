<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Inventario;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente', 'usuario')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $usuarios = Usuario::all();
        $inventarios = Inventario::with('producto')->where('cantidad_disponible', '>', 0)->get();

        return view('ventas.create', compact('clientes', 'usuarios', 'inventarios'));
    }

    public function store(Request $request)
    {
        // ✅ Validar inputs básicos (1 solo producto)
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'producto_id' => 'required|exists:inventarios,id',
            'cantidad' => 'required|integer|min:1',
            'total' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        // ✅ Crear la venta
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'usuario_id' => $request->usuario_id,
            'total' => $request->total,
            'fecha' => $request->fecha,
        ]);

        // ✅ Obtener el inventario del producto
        $inventario = Inventario::findOrFail($request->producto_id);
        $cantidadVendida = $request->cantidad;

        // ✅ Verificar stock
        if ($inventario->cantidad_disponible < $cantidadVendida) {
            return back()->withErrors(['error' => 'Stock insuficiente para el producto: ' . $inventario->producto->nombre]);
        }

        // ✅ Actualizar inventario
        $inventario->cantidad_disponible -= $cantidadVendida;
        $inventario->save();

        // ✅ Registrar detalle de venta
        $venta->detalles()->create([
            'producto_id' => $inventario->producto_id,
            'cantidad' => $cantidadVendida,
            'precio' => $inventario->producto->precio, // Asumiendo que `precio` está en Producto
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente y stock actualizado.');
    }

    public function show($id)
    {
        $venta = Venta::with('cliente', 'usuario')->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = Cliente::all();
        $usuarios = Usuario::all();
        return view('ventas.edit', compact('venta', 'clientes', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'total' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update($request->all());
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente');
    }

    public function exportCSV()
    {
        $ventas = Venta::with('cliente', 'usuario')->get();
        $fileName = 'ventas.csv';

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () use ($ventas) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Cliente', 'Usuario', 'Total', 'Fecha']);

            foreach ($ventas as $venta) {
                fputcsv($file, [
                    $venta->id,
                    $venta->cliente->nombre,
                    $venta->usuario->nombre,
                    $venta->total,
                    $venta->fecha,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
