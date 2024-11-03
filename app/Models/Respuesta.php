<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = ['evaluacion_id', 'pregunta_id', 'respuesta', 'user_id'];

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
