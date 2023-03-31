<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Horario;
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

        $doctor = User::create([
            'name' => 'House',
            'username' => 'Doctor',
            'email' => 'doctor@doctor.com',
            'password' => '123123',
            'image' => 'https://picsum.photos/200/300'
        ]);
        //Asignar roles a los usuarios
        $doctor->assignRole(Role::findByName('Doctor'));

        Doctor::create([
            'surnames' => 'Doctor',
            'ci' => 12345678,
            'specialty_id' => 2,
            'celular' => 12345678,
            'nacimiento' => "1990-03-12",
            'gender' => "MASCULINO",
            'address' => 'Calle 12 entre 11 y 12',
            'user_id' => $doctor->id
        ]);
        for($i = 0; $i< 7; $i++) {
            Horario::create([
                'dia' => $i,
                'morning_start' => '08:00',
                'morning_end' => '12:00',
                'afternoon_start' => '14:00',
                'afternoon_end' => '18:00',
                'doctor_id' => $doctor->doctor->id,
                'status' => 'SI'
            ]);
        }
    }
}
