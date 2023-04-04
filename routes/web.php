<?php

use App\Http\Controllers\Admin\AgendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\SubServiceController;
use App\Http\Controllers\Admin\UsersRolesController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\UsersPermissionsController;
use App\Http\Controllers\Admin\DebtController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DiaryController;
use Illuminate\Support\Facades\Auth;
Route::view('/','welcome');
Route::view('/about','about');

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('services', ServiceController::class)
    ->except(['show']);
    Route::resource('patients', PatientController::class);
    Route::resource('subservices', SubServiceController::class)
    ->except(['create']);

    Route::get('subservices/{service}/create', [SubServiceController::class,'create'])->name('subservices.create');

    Route::Resource('appointments', AppointmentController::class)->except(['edit']);
    Route::post('debts/{appointment}', [DebtController::class,'store'])->name('debts.store');
    Route::delete('debts/{debt}', [DebtController::class,'destroy'])->name('debts.destroy');

    Route::middleware('role:Admin')
    ->put('users/{user}/roles', [UsersRolesController::class, 'update'])
    ->name('users.roles.update');

    Route::put('users/{user}/permissions', [UsersPermissionsController::class, 'update'])
    ->name('users.permissions.update');
    

    Route::put('profiles/{user}', [ProfileController::class, 'update'])->name('profiles.update');
    // Datatables
    Route::get('api/citas', [AppointmentController::class, 'appointments']);

    Route::get('api/appointments', [AppointmentController::class, 'datatables']);
    Route::get('api/patients', [PatientController::class, 'datatables']);
    Route::get('api/services', [ServiceController::class, 'datatables']);
    Route::get('api/subservices', [SubServiceController::class, 'datatables']);
    Route::get('api/doctors', [DoctorController::class, 'datatables']);
    Route::get('api/users', [UserController::class, 'datatables']);
    Route::get('api/roles', [RoleController::class, 'datatables']);

    Route::view('settings', 'admin.settings')->name('settings');

    Route::get('consultations/{consultation}/edit', [ConsultationController::class, 'edit'])->name('consultations.edit');

    Route::get('notifications', [NotificationController::class,'index']);
    Route::post('notifications/{diary}', [NotificationController::class,'store'])->name('notifications.store');

    Route::get('horarios/{doctor}', [HorarioController::class, 'edit'])->name('horarios.edit');
    Route::put('horarios/{doctor}', [HorarioController::class, 'update'])->name('horarios.update');

    Route::put('diaries{diary}', [DiaryController::class,'update'])->name('diaries.update');
//PDF
    Route::get('pdf/{appointment}', [AppointmentController::class, 'pdf'])->name('cita.pdf');
    Route::get('pdf/historial/{patient}', [ReportesController::class, 'historialPatient'])->name('historialPatient.pdf');

});