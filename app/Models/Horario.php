<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'dia',
        'morning_start',
        'morning_end',
        'afternoon_start',
        'afternoon_end',
        'status',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
