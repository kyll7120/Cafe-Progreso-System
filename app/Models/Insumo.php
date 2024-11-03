<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Insumo
 *
 * @property $id
 * @property $nombre
 * @property $existencias
 * @property $precio_unitario
 * @property $created_at
 * @property $updated_at
 *
 */
class Insumo extends Model
{

    protected $perPage = 20;

    /**
     * Atributos asignables para la tabla insumos
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'existencias', 'precio_unitario', 'unidad'];


    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'recetas')->withPivot('cantidad_requerida');
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }


}
