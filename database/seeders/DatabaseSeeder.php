<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\SubService;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Role::truncate();
        Permission::truncate();
        Service::truncate();
        SubService::truncate();
        Doctor::truncate();
        Patient::truncate();
        \App\Models\Service::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Storage::disk('public')->deleteDirectory('images');

        $this->call([
            RolesSeeder::class,
            PermissionsSeeder::class,
            UsersSeeder::class,
        ]);

        Service::factory(4)->create();
        SubService::factory(20)->create();
        Doctor::factory(10)->create();
        Patient::factory(20)->create();
    }
}
