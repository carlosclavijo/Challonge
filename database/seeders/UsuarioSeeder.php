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
        $this->newUser('carlosclavijo', 'carlo96cf@gmail.com', 'admin123', 'Administrador');
        $this->newUser('carlos', 'carlos@gmail.com', 'h87iQX5sJWxFTb8q', 'Usuario');
        $this->newUser('cristian', 'cristian@gmail.com', '1IS5OTqhzh6qb9xw', 'Usuario');
        $this->newUser('sergio', 'sergio@gmail.com', '1IS5OTqhzh6qb9xw', 'Usuario');
        $this->newUser('alberto', 'alberto@gmail.com', 'RH75wYgxtP1S1vch', 'Usuario');
        $this->newUser('kenny', 'kenny@gmail.com', '2z3IYhJV5hnG2jbT', 'Usuario');
        $this->newUser('mauricio', 'mauricio@gmail.com', 'oGmRKBx8aUJQ9kCa', 'Usuario');
        $this->newUser('samuel', 'samuel@gmail.com', 'JoTkRkeWZ54Oo6SX', 'Usuario');
        $this->newUser('eduardo', 'eduardo@gmail.com', 'ncWUBf2lskz05Gc6', 'Usuario');
        $this->newUser('fernando', 'fernando@gmail.com', 'ncWUBf2lskz05Gc6', 'Usuario');
        $this->newUser('ricrado', 'ricrado@gmail.com', 'ztjssp8NTQQ6jyKy', 'Usuario');
        $this->newUser('luis', 'luis@gmail.com', 'M4vDwBDeGZPm8fuC', 'Usuario');
        $this->newUser('andres', 'andres@gmail.com', 'UopF1xEZuNVwZ620', 'Usuario');
        $this->newUser('julio', 'julio@gmail.com', 'PdpkQ981xP6YOnCJ', 'Usuario');
        $this->newUser('marcelo', 'marcelo@gmail.com', 'XpfPvday6Hoxz3OY', 'Usuario');
        $this->newUser('kevin', 'kevin@gmail.com', 'D6js8HMaKy6koEKI', 'Usuario');
        $this->newUser('jose', 'jose@gmail.com', 'ts6GpNrvlA43IS2D', 'Usuario');
    }

    public function newUser($name, $email, $password, $role)
    {
        $usuario = new User();
        $usuario->name = $name;
        $usuario->email = $email;
        $usuario->password = Hash::make($password);
        $usuario->save();
        $usuario->assignRole($role);
    }
}
