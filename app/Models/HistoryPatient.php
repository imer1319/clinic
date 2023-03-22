<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'history_question_id',
        'answer'
    ];
}
