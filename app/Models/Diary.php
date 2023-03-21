<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'patient_id', 'status', 'fecha_agenda', 'hora_agenda', 'fecha_llegada', 'hora_llegada', 'motivo'];
}
