<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Insumo
 *
 * @property $id
 * @property $id_categoria
 * @property $nombre
 * @property $es_preparado
 * @property $precio_unitario
 * @property $existencias
 * @property $created_at
 * @property $updated_at
 *
 */

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = ['id_categoria', 'nombre', 'es_preparado', 'precio_unitario', 'existencias'];

    protected $attributes = [
        'existencias' => 0,
    ];

    //Función para relacionar los descuentos
    public function descuentos()
    {
        return $this->belongsToMany(Descuento::class, 'descuento_producto');
    }

    //NO SE USA EN ESTE SPRINT
    //Función de marlon para el registro de ventas
    public function lineasDeVenta()
    {
        return $this->hasMany(LineaDeVenta::class);
    }


    //Función para traer la tabla categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }


    //Función para calcular la cantidad requerida de insumos
    public function insumos()
    {
        return $this->belongsToMany(Insumo::class, 'recetas')->withPivot('cantidad_requerida');
    }


    public function calcularExistencias()
    {
        if (!$this->es_preparado) {
            return $this->existencias;
        }

        $existenciasCalculadas = PHP_INT_MAX;

        foreach ($this->insumos as $insumo) {
            // Evitar división por cero
            if ($insumo->pivot->cantidad_requerida == 0) {
                continue;
            }

            $existenciasInsumo = (int) ($insumo->existencias / $insumo->pivot->cantidad_requerida);

            if ($existenciasInsumo < $existenciasCalculadas) {
                $existenciasCalculadas = $existenciasInsumo;
            }
        }

        // Si no hay insumos suficientes, establecer existencias en 0
        if ($existenciasCalculadas === PHP_INT_MAX) {
            $existenciasCalculadas = 0;
        }

        return $existenciasCalculadas;
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }
}
