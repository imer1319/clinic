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
        for ($i=0; $i < 7; $i++) {
            $doctor->horarios()->create([
                'dia_semana' => $i,
                'morning_start' => '06:00:00',
                'morning_end' => '12:00:00',
                'afternoon_start' => '14:00:00',
                'afternoon_end' => '18:00:00',
            ]);
        }
        $paciente = User::create([
            'name' => 'Paciente',
            'username' => 'Paciente',
            'email' => 'paciente@paciente.com',
            'password' => '123123',
        ]);
        //Asignar roles a los usuarios
        $paciente->assignRole(Role::findByName('Paciente'));
        $paciente->profile()->create();

        $secre = User::create([
            'name' => 'Secretaria',
            'username' => 'Secretaria',
            'email' => 'secretaria@secretaria.com',
            'password' => '123123',
        ]);
        //Asignar roles a los usuarios
        $secre->assignRole(Role::findByName('Secretaria'));
        $secre->profile()->create();
    }
}
