<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = ['nombre', 'descripcion', 'precio'];

    public function inventario()
    {
        return $this->hasOne(Inventario::class);
    }
}
