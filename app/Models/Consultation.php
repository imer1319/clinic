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
        'diagnosis'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
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

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'prescriptions')->withPivot('tomar', 'frecuencia', 'durante');
    }

    public function laboratories()
    {
        return $this->belongsToMany(Laboratory::class, 'studio_carried_outs')->withPivot('id', 'created_at');
    }

    public function getHoraAttribute()
    {
        return $this->created_at->format('H:i A');
    }

    public function subservices()
    {
        return $this->belongsToMany(Subservicio::class,'consultation_subservice', 'consultation_id','subservice_id')->withPivot('id', 'created_at');
    }

    public function consultaSubservicio()
    {
        return $this->hasMany(ConsultaSubservicio::class,'consultation_id');
    }

    public function archives()
    {
        return $this->hasMany(Archive::class, 'consultation_id');
    }
}
