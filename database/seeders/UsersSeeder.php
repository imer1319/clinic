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
            'password' => '123123',
            'image' => 'https://picsum.photos/200/300'
        ]);
        //Asignar roles a los usuarios
        $admin->assignRole(Role::findByName('Admin'));
    }
}
