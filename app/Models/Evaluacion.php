<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Evaluacion extends Model
{
    protected $table = 'evaluaciones'; // Especifica el nombre correcto de la tabla

    protected $fillable = ['titulo', 'descripcion', 'fecha_inicio', 'fecha_fin'];

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'respuestas'); // Asegúrate de usar el nombre correcto de la tabla intermedia
    }

    // Método para verificar si la evaluación está disponible para ser respondida
    public function estaDisponible()
    {
        $hoy = Carbon::now();
        return $hoy->between($this->fecha_inicio, $this->fecha_fin);
    }
}
