<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AppointmentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthorized_users_cannot_read_all_the_appointments()
    {
        $user = User::factory()->create();

        Permission::create(['name' => 'appointments_show','display_name' => 'Listar cita']);
        $user->givePermissionTo('appointments_show');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();
        $appointments = Appointment::factory(4)->create();

        $response = $this->actingAs($user)->get('/api/appointments');
        $response->assertStatus(403);
    }

    /** @test */
    public function a_user_can_read_all_the_appointments()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'appointments_index','display_name' => 'Listar cita']);
        $user->givePermissionTo('appointments_index');

        $appointments = Appointment::factory()
        ->count(3)
        ->for(Patient::factory()->create())
        ->for(Doctor::factory()->create())
        ->create();

        $response = $this->actingAs($user)->get('/api/appointments');
        $this->assertEquals($response["data"][0]['start'], $appointments[0]->start);
    }

    /** @test */
    public function unauthorized_users_cannot_get_one_appointment()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'appointments_create','display_name' => 'Ver cita']);
        $user->givePermissionTo('appointments_create');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();
        $appointment = Appointment::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.appointments.show', $appointment->id));
        $response->assertStatus(403);
    }

    /** @test */
    public function can_get_one_appointment()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'appointments_show','display_name' => 'Ver cita']);
        $user->givePermissionTo('appointments_show');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();
        $appointment = Appointment::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.appointments.show', $appointment->id));

        $response->assertSee(['start' => $appointment->start]);
    }

    /** @test */
    public function unauthorized_users_cannot_create_appointment()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'appointments_store','display_name' => 'Guardar cita']);
        $user->givePermissionTo('appointments_store');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $appointment = Appointment::factory()->make();
        $response = $this->actingAs($user)
        ->post(route('admin.appointments.store'), $appointment->toArray());
        $response->assertStatus(403);
    }

    /** @test */
    public function can_create_appointment()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'appointments_create','display_name' => 'Guardar cita']);
        $user->givePermissionTo('appointments_create');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $appointment = Appointment::factory()->make();
        $this->actingAs($user)
        ->post(route('admin.appointments.store'), $appointment->toArray());
        $this->assertDatabaseCount('appointments', 1);
    }

    /** @test */
    public function unauthorized_user_cannot_update_the_appointment()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'create_appointment','display_name' => 'Actualizar cita']);
        $user->givePermissionTo('create_appointment');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $appointment = Appointment::factory()->create();
        $appointment->title = "Updated Title";
        $response = $this->actingAs($user)
        ->put(route('admin.appointments.update', $appointment->id), $appointment->toArray());
        $response->assertStatus(403);
        //status unauthorize
    }

    /** @test */
    public function users_authorize_can_update_the_appointment()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'appointments_edit','display_name' => 'Actualizar cita']);
        $user->givePermissionTo('appointments_edit');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $appointment = Appointment::factory()->create();
        $appointment->title = "Updated Title";
        $response = $this->actingAs($user)
        ->put(route('admin.appointments.update', $appointment->id), $appointment->toArray());
        $this->assertDatabaseHas('appointments',['id'=> $appointment->id , 'title' => 'Updated Title']);

    }

    /** @test */
    public function unauthorized_user_cannot_delete_the_appointment()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'appointments_edit','display_name' => 'Eliminar cita']);
        $user->givePermissionTo('appointments_edit');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();
        $appointment = Appointment::factory()->create();

        $response = $this->actingAs($user)
        ->delete(route('admin.appointments.destroy', $appointment->id), $appointment->toArray());
        $response->assertStatus(403);
    }

    /** @test */
    public function authorized_user_can_delete_the_appointment()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'appointments_destroy','display_name' => 'Eliminar cita']);
        $user->givePermissionTo('appointments_destroy');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();
        $appointment = Appointment::factory()->create();

        $this->actingAs($user)
        ->delete(route('admin.appointments.destroy', $appointment->id), $appointment->toArray());
        $this->assertDatabaseMissing('appointments',['id'=> $appointment->id]);
    }
}
