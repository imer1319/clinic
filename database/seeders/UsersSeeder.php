<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
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
        ]);
        //Asignar roles a los usuarios
        $admin->assignRole(Role::findByName('Administrador'));
        $admin->profile()->create();

        $doctor = User::create([
            'name' => 'House',
            'username' => 'Doctor',
            'email' => 'doctor@doctor.com',
            'password' => '123123',
        ]);
        //Asignar roles a los usuarios
        $doctor->assignRole(Role::findByName('Doctor'));
        $doctor->profile()->create();

        $paciente = User::create([
            'name' => 'Paciente',
            'username' => 'Paciente',
            'email' => 'paciente@paciente.com',
            'password' => '123123',
        ]);
        //Asignar roles a los usuarios
        $paciente->assignRole(Role::findByName('Paciente'));
        $paciente->profile()->create();
    }
}
