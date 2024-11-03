<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_cliente', 'telefono_cliente', 'fecha_hora_venta', 'descuento_total_venta', 'total_venta'];

    public function lineas()
    {   //le agrege el parametro venta_id 10-10-24 (braian)
        return $this->hasMany(LineaDeVenta::class, 'venta_id');
    }
}
