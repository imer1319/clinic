<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaSubservicio extends Model
{
    use HasFactory;

    protected $table = "consultation_subservice";

    protected $fillable = ['consultation_id','subservice_id'];

    public function consulta()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function imagen()
    {
        return $this->hasOne(ImagenSubservicio::class,'consultation_subservice_id');
    }
}
