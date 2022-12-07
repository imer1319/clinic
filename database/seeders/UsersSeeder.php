<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // User
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'Administrador',
            'email' => 'admin@admin.com', 
            'password' => '123123'
        ]);
        $user = User::create([
            'name' => 'User', 
            'username' => 'Usuario',
            'email' => 'user@user.com',
            'password' => '123123'
        ]);
        //Asignar roles a los usuarios
        $admin->assignRole(Role::findByName('Admin'));
        $user->assignRole(Role::findByName('User'));
    }
}
