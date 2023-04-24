<?php

use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ExploracionController;
use App\Http\Controllers\Api\HistoryQuestionController;
use App\Http\Controllers\Api\HistoryTypeController;
use App\Http\Controllers\Api\LaboratoryController;
use App\Http\Controllers\Api\MedicineController;
use App\Http\Controllers\Api\VitalSignsController;
use App\Http\Controllers\Api\ConsultationDiagnosisController;
use App\Http\Controllers\Api\LaboratoryStudiesController;
use App\Http\Controllers\Api\MedicalInstructionController;
use App\Http\Controllers\Api\MedicamentosController;
use App\Http\Controllers\Api\PhysicalExplorationController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\StudioCarriedOutController;
use App\Http\Controllers\Api\StudioInstructionController;
use App\Http\Controllers\Api\ArchiveController;
use App\Http\Controllers\Api\HistoryPatientController;
use App\Http\Controllers\Api\DateHistorialController;
use App\Http\Controllers\Api\DiaryController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\HorarioController;
use App\Http\Controllers\Api\ServiceConsultationController;
use App\Http\Controllers\Api\SpecialtyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('explorations', [ExploracionController::class, 'index']);
Route::post('explorations/store', [ExploracionController::class, 'store']);
Route::put('explorations/{physicalExploration}', [ExploracionController::class, 'update']);

Route::get('historyTypes', [HistoryTypeController::class, 'index']);
Route::post('historyTypes/store', [HistoryTypeController::class, 'store']);
Route::put('historyTypes/{historyType}', [HistoryTypeController::class, 'update']);

Route::get('historyQuestions', [HistoryQuestionController::class, 'index']);
Route::post('historyQuestions/store', [HistoryQuestionController::class, 'store']);
Route::put('historyQuestions/{historyQuestion}', [HistoryQuestionController::class, 'update']);

Route::get('laboratories', [LaboratoryController::class, 'index']);
Route::post('laboratories/store', [LaboratoryController::class, 'store']);
Route::put('laboratories/{laboratory}', [LaboratoryController::class, 'update']);

Route::get('medicines', [MedicineController::class, 'index']);
Route::post('medicines/store', [MedicineController::class, 'store']);
Route::put('medicines/{medicine}', [MedicineController::class, 'update']);

Route::get('services', [ServiceController::class, 'index']);
Route::post('services/store', [ServiceController::class, 'store']);
Route::put('services/{service}', [ServiceController::class, 'update']);

Route::get('specialties', [SpecialtyController::class, 'index']);
Route::post('specialties/store', [SpecialtyController::class, 'store']);
Route::put('specialties/{specialty}', [SpecialtyController::class, 'update']);

Route::get('consultations', [ConsultationController::class, 'index']);
Route::post('consultations/store', [ConsultationController::class, 'store']);
Route::put('consultations/{consultation}', [ConsultationController::class, 'update']);

Route::get('vitalSigns/{patient}', [VitalSignsController::class, 'index']);
Route::put('vitalSigns/{vitalSigns}', [VitalSignsController::class, 'update']);

Route::get('consultationDiagnosis/{consultation}', [ConsultationDiagnosisController::class, 'index']);
Route::post('consultationDiagnosis', [ConsultationDiagnosisController::class,'store']);
Route::delete('consultationDiagnosis/{consultationDiagnosis}', [ConsultationDiagnosisController::class, 'destroy']);

Route::get('physicalExploration/{consultation}', [PhysicalExplorationController::class,'index']);
Route::post('physicalExploration', [PhysicalExplorationController::class,'store']);
Route::put('physicalExploration/{physicalExplorationQuestion}', [PhysicalExplorationController::class, 'update']);
Route::delete('physicalExploration/{physicalExplorationQuestion}', [PhysicalExplorationController::class, 'destroy']);

Route::get('medicamentos',[MedicamentosController::class,'index']);
Route::get('laboratoryStudies',[LaboratoryStudiesController::class,'index']);

Route::get('prescriptions/{consultation}', [PrescriptionController::class, 'index']);
Route::post('prescriptions', [PrescriptionController::class,'store']);
Route::delete('prescriptions/{prescription}', [PrescriptionController::class, 'destroy']);

Route::get('medicalInstruction/{consultation}', [MedicalInstructionController::class, 'index']);
Route::post('medicalInstruction', [MedicalInstructionController::class,'store']);
Route::put('medicalInstruction/{medicalInstruction}', [MedicalInstructionController::class, 'update']);

Route::get('studioCarriedOut/{consultation}', [StudioCarriedOutController::class, 'index']);
Route::post('studioCarriedOut', [StudioCarriedOutController::class,'store']);
Route::delete('studioCarriedOut/{studioCarriedOut}', [StudioCarriedOutController::class, 'destroy']);

Route::get('studioInstruction/{consultation}', [StudioInstructionController::class, 'index']);
Route::post('studioInstruction', [StudioInstructionController::class,'store']);
Route::put('studioInstruction/{studioInstruction}', [StudioInstructionController::class, 'update']);

Route::get('archives/{patient}', [ArchiveController::class, 'index']);
Route::post('archives', [ArchiveController::class,'store']);
Route::delete('archives/{archive}', [ArchiveController::class, 'destroy']);

Route::get('historyPatients/{historyQuestion}', [HistoryPatientController::class, 'index']);
Route::post('historyPatients', [HistoryPatientController::class,'store']);
Route::put('historyPatients/{historyPatient}', [HistoryPatientController::class, 'update']);

Route::get('dateHistorial/{patient}', [DateHistorialController::class, 'index']);
Route::put('dateHistorial/{dateHistorial}', [DateHistorialController::class, 'update']);

Route::post('diaries', [DiaryController::class, 'store']);
Route::put('diaries/{diary}', [DiaryController::class, 'update']);

Route::get('notifications/{user}', [NotificationController::class, 'index']);
Route::put('notifications/{notification}', [NotificationController::class, 'update']);

Route::get('horas', [HorarioController::class, 'horas']);

Route::get('historyTypes/{patient}', [HistoryPatientController::class, 'index']);

Route::get('getServices', [ServiceConsultationController::class, 'getServices']);
Route::get('services/{consultation}', [ServiceConsultationController::class, 'index']);
Route::post('serviceConsultation/{consultation}', [ServiceConsultationController::class, 'store']);
Route::delete('services/{consultation}/{id}', [ServiceConsultationController::class, 'destroy']);