<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationDiagnosis extends Model
{
    use HasFactory;

    protected $fillable = ['consultation_id','diagnosis_id'];

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }
}
