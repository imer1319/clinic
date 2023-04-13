<?php

use App\Http\Controllers\Admin\AgendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\SubServiceController;
use App\Http\Controllers\Admin\UsersRolesController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\UsersPermissionsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DiaryController;
use App\Http\Controllers\Admin\UsersProfileController;
use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Auth;
Route::view('/','welcome');
Route::view('/about','about');

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('doctors', DoctorController::class);
    // Route::resource('services', ServiceController::class)
    // ->except(['show']);
    Route::resource('patients', PatientController::class);


    Route::middleware('role:Admin')
    ->put('users/{user}/roles', [UsersRolesController::class, 'update'])
    ->name('users.roles.update');

    Route::put('users/{user}/permissions', [UsersPermissionsController::class, 'update'])
    ->name('users.permissions.update');
    

    // Datatables

    Route::get('api/patients', [PatientController::class, 'datatables']);
    // Route::get('api/services', [ServiceController::class, 'datatables']);
    Route::get('api/doctors', [DoctorController::class, 'datatables']);
    Route::get('api/users', [UserController::class, 'datatables']);
    Route::get('api/roles', [RoleController::class, 'datatables']);

    Route::view('settings', 'admin.settings')->name('settings')->middleware('permission:settings_index');

    Route::get('consultations/{consultation}/edit', [ConsultationController::class, 'edit'])->name('consultations.edit');

    Route::get('notifications', [NotificationController::class,'index']);
    Route::post('notifications/{diary}', [NotificationController::class,'store'])->name('notifications.store');


    Route::put('diaries{diary}', [DiaryController::class,'update'])->name('diaries.update');
//PDF

    Route::get('pdf/historial/{patient}', [ReportesController::class, 'historialPatient'])->name('historialPatient.pdf');  
    Route::get('pdf/receta/{consultation}', [ReportesController::class, 'recetaPatient'])->name('recetaPatient.pdf');
    Route::get('pdf/pruebas/{consultation}', [ReportesController::class, 'pruebasPatient'])->name('pruebasPatient.pdf');
    Route::get('pdf/consulta/{consultation}', [ReportesController::class, 'consultaPatient'])->name('consultaPatient.pdf');

    Route::get('mis-citas', [CitaController::class, 'index'])->name('mis-citas')->middleware('role:Doctor');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::put('profile/{user}', [UsersProfileController::class, 'update'])->name('user.profiles.update');
});