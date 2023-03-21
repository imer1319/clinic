<?php

use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Api\DiagnosisController;
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

Route::get('diagnoses', [DiagnosisController::class, 'index']);
Route::post('diagnoses/store', [DiagnosisController::class, 'store']);
Route::put('diagnoses/{diagnosis}', [DiagnosisController::class, 'update']);

Route::get('consultations', [ConsultationController::class, 'index']);
Route::post('consultations/store', [ConsultationController::class, 'store']);
Route::put('consultations/{consultation}', [ConsultationController::class, 'update']);

Route::get('vitalSigns/{patient}', [VitalSignsController::class, 'index']);
Route::put('vitalSigns/{vitalSigns}', [VitalSignsController::class, 'update']);

Route::get('consultationDiagnosis/{consultation}', [ConsultationDiagnosisController::class, 'index']);
Route::post('consultationDiagnosis', [ConsultationDiagnosisController::class,'store']);
Route::delete('consultationDiagnosis/{consultationDiagnosis}', [ConsultationDiagnosisController::class, 'destroy']);

Route::get('physicalExploration/{physicalExploration}', [PhysicalExplorationController::class,'index']);
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
