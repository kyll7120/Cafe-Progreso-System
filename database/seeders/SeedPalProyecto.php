<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Descuento;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Hash;

class SeedPalProyecto extends Seeder
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
            'sexo' => 'Mujer',
            'dui' => '0000000069',
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

        $descuento1 = Descuento::create([
            'nombre' => 'Descuento de Verano',
            'porcentaje' => 0.15,
        ]);

        $descuento2 = Descuento::create([
            'nombre' => 'Descuento de Invierno',
            'porcentaje' => 0.20,
        ]);

        Categoria::create(['nombreCategoria' => 'Bebidas Frías']); //id 1
        Categoria::create(['nombreCategoria' => 'Bebidas Calientes']); //id 2
        Categoria::create(['nombreCategoria' => 'Postres']); //id 3
        Categoria::create(['nombreCategoria' => 'Bocadillos']); //id 4

        Producto::create([
            'nombre' => 'Café Americano',
            'existencias' => 100,
            'precio_unitario' => 2.50,
            'id_categoria' => 2,
        ]);

        Producto::create([
            'nombre' => 'Cappuccino',
            'existencias' => 50,
            'precio_unitario' => 3.50,
            'id_categoria' => 2,
        ]);
        Producto::create([
            'nombre' => 'Sandwich de Pollo',
            'existencias' => 30,
            'precio_unitario' => 4.00,
            'id_categoria' => 4,
        ]);

        Producto::create([
            'nombre' => 'Torta de Chocolate',
            'existencias' => 20,
            'precio_unitario' => 2.00,
            'id_categoria' => 3,
        ]);

        Producto::create([
            'nombre' => 'Ensalada de Frutas',
            'existencias' => 25,
            'precio_unitario' => 3.00,
            'id_categoria' => 4,
        ]);
    }
}