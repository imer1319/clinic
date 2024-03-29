<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'patient_id', 'status', 'date_cita', 'hora_cita', 'fecha_llegada', 'hora_llegada', 'motivo'];

    protected $dates = ['date_cita','hora_cita'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
