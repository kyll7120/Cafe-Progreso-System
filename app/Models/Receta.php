<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    protected $table = 'recetas';
    protected $fillable = ['producto_id', 'insumo_id', 'cantidad_requerida'];

    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Relación con Insumo
    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}
