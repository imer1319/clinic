<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\HistoryQuestion;
use App\Models\HistoryType;
use App\Models\Laboratory;
use App\Models\Patient;
use App\Models\PhysicalExploration;
use App\Models\Specialty;
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
        DB::statement('SET session_replication_role = replica;');
        DB::statement('TRUNCATE TABLE users, roles, permissions, services, specialties, physical_explorations, history_types, history_questions, laboratories RESTART IDENTITY CASCADE;');
        DB::statement('SET session_replication_role = DEFAULT;');

        Storage::disk('public')->deleteDirectory('images');



        Specialty::factory(6)->create();

        $this->call([
            RolesSeeder::class,
            PermissionsSeeder::class,
            UsersSeeder::class,
            ExplorationSeeder::class,
            HistoryTypeSeeder::class,
            HistoryQuestionSeeder::class,
            LaboratorySeeder::class,
            ServiceSeeder::class,
        ]);
    }
}
