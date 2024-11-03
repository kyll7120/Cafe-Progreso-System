<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = ['texto', 'evaluacion_id'];

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
}
