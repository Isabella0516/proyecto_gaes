<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventarios';

    protected $fillable = ['producto_id', 'cantidad_disponible', 'stock_minimo', 'cantidad_reservada'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function estaBajoMinimo()
    {
        return $this->cantidad_disponible <= $this->stock_minimo;
    }
}
