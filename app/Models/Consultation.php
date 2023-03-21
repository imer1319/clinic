<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'motivo',
        'motivo_consulta',
        'sintoma',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    

    public function vitalSigns()
    {
        return $this->hasOne(VitalSigns::class);
    }

    public function physicalExploration()
    {
        return $this->belongsToMany(PhysicalExploration::class, 'physical_exploration_questions')->withPivot('answer');
    }

    public function physicalExplorationQuestion()
    {
        return $this->hasMany(PhysicalExplorationQuestion::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function diagnoses()
    {
        return $this->belongsToMany(Diagnosis::class, 'consultation_diagnoses');
    }

    public function medicalInstruction()
    {
        return $this->hasOne(MedicalInstruction::class);
    }

    public function studiosInstruction()
    {
        return $this->hasOne(StudioInstruction::class);
    }

    public function laboratories()
    {
        return $this->belongsToMany(Laboratory::class, 'studio_carried_outs')->withPivot('id');
    }
}
