<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'medicamento',
        'concentracion',
        'tomar',
        'frecuencia',
        'durante',
    ];
}
