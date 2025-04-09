<?php
namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('stocks.create'); // Ya no necesita cargar productos
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1'
        ]);

        Stock::create([
            'tipo_producto' => $request->tipo_producto,
            'cantidad' => $request->cantidad
        ]);

        return redirect()->route('stocks.index')->with('success', 'Stock agregado con éxito.');
    }

    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock')); // Ya no necesita productos
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'tipo_producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1'
        ]);

        $stock->update([
            'tipo_producto' => $request->tipo_producto,
            'cantidad' => $request->cantidad
        ]);

        return redirect()->route('stocks.index')->with('success', 'Stock actualizado con éxito.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock eliminado.');
    }
}

