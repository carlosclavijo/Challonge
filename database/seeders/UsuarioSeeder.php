<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new User();
        $usuario->name = 'carlosclavijo';
        $usuario->email = 'carlo96cf@gmail.com';
        $usuario->password = Hash::make('admin123');
        $usuario->save();
        $usuario->assignRole('Administrador');
    }
}
