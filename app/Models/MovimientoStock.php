<?php


namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Producto;
use App\Models\MovimientoStock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('producto')->get();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('stocks.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Registrar el movimiento de entrada
        MovimientoStock::create([
            'producto_id' => $producto->id,
            'cantidad' => $request->cantidad,
            'tipo' => 'entrada',
            'motivo' => 'Nuevo stock agregado'
        ]);

        // Aumentar el stock del producto
        $producto->increment('stock', $request->cantidad);

        return redirect()->route('stocks.index')->with('success', 'Stock agregado correctamente.');
    }

    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $stock->update($request->only('cantidad'));

        return redirect()->route('stocks.index')->with('success', 'Stock actualizado.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock eliminado.');
    }

    // Método para manejar entradas y salidas de stock
    public function registrarMovimiento(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'tipo' => 'required|in:entrada,salida',
            'motivo' => 'nullable|string'
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Validar que no haya stock negativo en salidas
        if ($request->tipo === 'salida' && $producto->stock < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'No hay suficiente stock para esta salida.']);
        }

        // Registrar el movimiento
        MovimientoStock::create([
            'producto_id' => $producto->id,
            'cantidad' => $request->cantidad,
            'tipo' => $request->tipo,
            'motivo' => $request->motivo ?? 'Sin especificar'
        ]);

        // Actualizar el stock
        if ($request->tipo === 'entrada') {
            $producto->increment('stock', $request->cantidad);
        } else {
            $producto->decrement('stock', $request->cantidad);
        }

        return redirect()->route('stocks.index')->with('success', 'Movimiento registrado correctamente.');
    }
}
