<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permisos
        $viewDashboardPermission = Permission::create([
            'name' => 'dashboard_show',
            'display_name' => 'Ver dashboard'
        ]);
        
        $viewInvocePermission = Permission::create([
            'name' => 'invoce_show',
            'display_name' => 'Ver factura'
        ]);
        
        
        $viewUsersPermission = Permission::create([
            'name' => 'users_index',
            'display_name' => 'Listar usuarios'
        ]);
        $showUsersPermission = Permission::create([
            'name' => 'users_show',
            'display_name' => 'Ver usuario'
        ]);
        $createUsersPermission = Permission::create([
            'name' => 'users_create',
            'display_name' => 'Crear usuarios'
        ]);
        $updateUsersPermission = Permission::create([
            'name' => 'users_edit',
            'display_name' => 'Actualizar usuarios'
        ]);
        $deleteUsersPermission = Permission::create([
            'name' => 'users_destroy',
            'display_name' => 'Eliminar usuarios'
        ]);
        $editProfileUsersPermission = Permission::create([
            'name' => 'users_profile',
            'display_name' => 'Editar perfil'
        ]);

        $viewRolesPermission = Permission::create([
            'name' => 'roles_index',
            'display_name' => 'Listar roles'
        ]);
        $createRolesPermission = Permission::create([
            'name' => 'roles_create',
            'display_name' => 'Crear roles'
        ]);
        $showRolesPermission = Permission::create([
            'name' => 'roles_show',
            'display_name' => 'Ver rol'
        ]);
        $updateRolesPermission = Permission::create([
            'name' => 'roles_edit',
            'display_name' => 'Actualizar roles'
        ]);
        $deleteRolesPermission = Permission::create([
            'name' => 'roles_destroy',
            'display_name' => 'Eliminar roles'
        ]);
        $viewPermissionsPermission = Permission::create([
            'name' => 'permissions_index',
            'display_name' => 'Listar permisos'
        ]);
        $updatePermissionsPermission = Permission::create([
            'name' => 'permissions_edit',
            'display_name' => 'Actualizar permisos'
        ]);

        $viewDoctorsPermission = Permission::create([
            'name' => 'doctors_index',
            'display_name' => 'Listar doctores'
        ]);
        $showDoctorsPermission = Permission::create([
            'name' => 'doctors_show',
            'display_name' => 'Ver doctor'
        ]);
        $createDoctorsPermission = Permission::create([
            'name' => 'doctors_create',
            'display_name' => 'Crear doctores'
        ]);
        $updateDoctorsPermission = Permission::create([
            'name' => 'doctors_edit',
            'display_name' => 'Actualizar doctores'
        ]);
        $deleteDoctorsPermission = Permission::create([
            'name' => 'doctors_destroy',
            'display_name' => 'Eliminar doctores'
        ]);

        $viewServicesPermission = Permission::create([
            'name' => 'services_index',
            'display_name' => 'Listar servicios'
        ]);
        $createServicesPermission = Permission::create([
            'name' => 'services_create',
            'display_name' => 'Crear servicios'
        ]);
        $updateServicesPermission = Permission::create([
            'name' => 'services_edit',
            'display_name' => 'Actualizar servicios'
        ]);
        $deleteServicesPermission = Permission::create([
            'name' => 'services_destroy',
            'display_name' => 'Eliminar servicios'
        ]);

        $viewPatientsPermission = Permission::create([
            'name' => 'patients_index',
            'display_name' => 'Listar paciente'
        ]);
        $showPatientsPermission = Permission::create([
            'name' => 'patients_show',
            'display_name' => 'Ver paciente'
        ]);
        $createPatientsPermission = Permission::create([
            'name' => 'patients_create',
            'display_name' => 'Crear paciente'
        ]);
        $updatePatientsPermission = Permission::create([
            'name' => 'patients_edit',
            'display_name' => 'Actualizar paciente'
        ]);
        $deletePatientsPermission = Permission::create([
            'name' => 'patients_destroy',
            'display_name' => 'Eliminar paciente'
        ]);

        $viewAppointmentsPermission = Permission::create([
            'name' => 'appointments_index',
            'display_name' => 'Listar cita'
        ]);
        $showAppointmentsPermission = Permission::create([
            'name' => 'appointments_show',
            'display_name' => 'Ver cita'
        ]);
        $createAppointmentsPermission = Permission::create([
            'name' => 'appointments_create',
            'display_name' => 'Crear cita'
        ]);
        $updateAppointmentsPermission = Permission::create([
            'name' => 'appointments_edit',
            'display_name' => 'Actualizar cita'
        ]);
        $deleteAppointmentsPermission = Permission::create([
            'name' => 'appointments_destroy',
            'display_name' => 'Eliminar cita'
        ]);


        $viewSubServicesPermission = Permission::create([
            'name' => 'subservices_index',
            'display_name' => 'Listar sub servicio'
        ]);
        $showSubServicesPermission = Permission::create([
            'name' => 'subservices_show',
            'display_name' => 'Ver sub servicio'
        ]);
        $createSubServicesPermission = Permission::create([
            'name' => 'subservices_create',
            'display_name' => 'Crear sub servicio'
        ]);
        $updateSubServicesPermission = Permission::create([
            'name' => 'subservices_edit',
            'display_name' => 'Actualizar sub servicio'
        ]);
        $deleteSubServicesPermission = Permission::create([
            'name' => 'subservices_destroy',
            'display_name' => 'Eliminar sub servicio'
        ]);

        // Asignar todos los permisos al admin
        $role = Role::findByName('Admin');
        $role->syncPermissions(Permission::all());
    }
}
