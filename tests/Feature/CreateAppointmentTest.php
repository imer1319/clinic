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

class CreateAppointmentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_appointment_requires_a_title()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'appointments_create','display_name' => 'Guardar cita']);
        $user->givePermissionTo('appointments_create');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();
        $appointment = Appointment::factory()->make(['title' => '']);
        $response = $this->actingAs($user)
        ->post(route('admin.appointments.store'), $appointment->toArray());
        $response->assertStatus(302)
        ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_appointment_requires_a_start_date()
    {
        $user = User::factory()->create();
        Permission::create(['name' => 'appointments_create','display_name' => 'Guardar cita']);
        $user->givePermissionTo('appointments_create');

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();
        $appointment = Appointment::factory()->make(['title' => '']);
        $response = $this->actingAs($user)
        ->post(route('admin.appointments.store'), $appointment->toArray());
        $response->assertStatus(302)
        ->assertSessionHasErrors('title');
    }
}
