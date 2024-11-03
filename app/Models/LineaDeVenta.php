<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaDeVenta extends Model
{
    use HasFactory;
    protected $table = 'linea_de_ventas';

    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'descuento',
        'subtotal',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
