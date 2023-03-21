<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'title',
        'start',
        'time_start',
        'time_end',
        'color',
        'observations',
        'total',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function subServices()
    {
        return $this->belongsToMany(SubService::class);
    }

    public function debts()
    {
        return $this->hasMany(Debt::class);
    }
    
    public function appointmentType()
    {
        return $this->belongsTo(AppointmentType::class);
    }
}
