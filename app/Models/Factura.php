<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'facturas';
    protected $fillable = ['usuario_id', 'total'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'factura_productos')->withPivot('cantidad');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
