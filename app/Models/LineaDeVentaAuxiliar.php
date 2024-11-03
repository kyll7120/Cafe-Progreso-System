<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaDeVentaAuxiliar extends Model
{
    use HasFactory;
    protected $table = 'linea_de_ventas_auxiliar';

    protected $fillable = [
        'producto_id',
        'cantidad',
        'descuento',
        'subtotal',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
