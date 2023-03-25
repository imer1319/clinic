<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $rolAdmin = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $rolDoctor = Role::create(['name' => 'Doctor', 'display_name' => 'Doctor']);
    }
}
