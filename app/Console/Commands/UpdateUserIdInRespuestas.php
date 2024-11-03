<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Respuesta;
use App\Models\User;

class UpdateUserIdInRespuestas extends Command
{
    protected $signature = 'respuestas:update-user-id';
    protected $description = 'Actualizar el campo user_id en respuestas';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Aquí puedes definir cómo asignar los valores. Este es solo un ejemplo simple.
        $respuestas = Respuesta::all();
        foreach ($respuestas as $respuesta) {
            // Aquí deberías definir la lógica para determinar qué user_id asignar
            $respuesta->user_id = User::first()->id; // Solo un ejemplo, debes ajustar la lógica
            $respuesta->save();
        }

        $this->info('Campos user_id actualizados.');
    }
}
