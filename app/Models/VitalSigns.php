<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSigns extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id', 'patient_id', 'altura', 'peso', 'temp', 'fr', 'pa', 'fc'
    ];
}
