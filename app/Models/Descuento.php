<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;
    protected $table = 'descuentos';

    protected $fillable = ['nombre', 'porcentaje'];

    //Función para relacionar los productos
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'descuento_producto');
    }
}
