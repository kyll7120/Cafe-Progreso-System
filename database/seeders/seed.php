<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Descuento;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Hash;

class seed extends Seeder
{
    public function run()
    {
        $AdministradorRole = Role::firstOrCreate(['name' => 'Administrador']);
        $PropietarioRole = Role::firstOrCreate(['name' => 'Propietario']);

        $Administrador = User::create([
            'name' => 'Admin',
            'apellido' => 'admin',
            'edad' => 20,
            'sexo' => 'Hombre',
            'dui' => '00000000-0',
            'direccion' => 'San Salvador, San Salvador',
            'telefono' => '2273-6000',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $Administrador->roles()->attach($AdministradorRole);

        $Propietario = User::create([
            'name' => 'Daniel',
            'apellido' => 'Avelar',
            //'edad' => 30,
            'sexo' => 'Hombre',
            'dui' => '00000069-0',
            'direccion' => 'San Salvador, San Salvador',
            'telefono' => '2273-6000',
            'email' => 'daniel@avelar.com',
            'password' => bcrypt('password'),
        ]);
        $Propietario->roles()->attach($PropietarioRole);

        $empleado = User::create([
            'name' => 'empleado',
            'apellido' => 'empleado',
            //'edad' => 20,
            'sexo' => 'Hombre',
            'dui' => '00000000-1',
            'direccion' => 'San Salvador, San Salvador',
            'telefono' => '1122-3344',
            'email' => 'empleado@empleado.com',
            'password' => bcrypt('password'),
        ]);

        Categoria::create(['nombreCategoria' => 'Bebidas Frías']); //id 1
        Categoria::create(['nombreCategoria' => 'Bebidas Calientes']); //id 2
        Categoria::create(['nombreCategoria' => 'Postres']); //id 3
        Categoria::create(['nombreCategoria' => 'Bocadillos']); //id 4
       
    }
}