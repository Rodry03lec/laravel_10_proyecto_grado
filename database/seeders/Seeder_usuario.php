<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Seeder_usuario extends Seeder
{
    public function run(): void
    {
        $rol = new Role;
        $rol->name = 'admin';
        $rol->save();

        $usuario1               = new User;
        $usuario1->usuario      = "admin";
        $usuario1->password     = Hash::make('rodry');
        $usuario1->ci           = "10028685";
        $usuario1->nombres      = "Rodrigo";
        $usuario1->apellido_paterno = "Lecoña";
        $usuario1->apellido_materno = "Quispe";
        $usuario1->celular          = "63259224";
        $usuario1->estado           = "activo";
        $usuario1->email            = "rodrigolecona03@gmail.com";
        $usuario1->save();

        $usuario1->syncRoles('admin');

        $usuario2               = new User;
        $usuario2->usuario      = "noemi";
        $usuario2->password     = Hash::make('liz');
        $usuario2->ci           = "8431010";
        $usuario2->nombres      = "Noemi Liz";
        $usuario2->apellido_paterno = "Solarez";
        $usuario2->apellido_materno = "Chico";
        $usuario2->celular          = "75824684";
        $usuario2->estado           = "activo";
        $usuario2->email            = "nliz99@gmail.com";
        $usuario2->save();

        $usuario2->syncRoles('admin');
    }
}
