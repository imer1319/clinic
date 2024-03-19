<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenSubservicio extends Model
{
    use HasFactory;

    protected $fillable = ['imagen','consultation_subservice_id'];

    protected $table = 'imagen_subservicio';

    public function subservicio()
    {
        return $this->belongsTo(ConsultaSubservicio::class,'consultation_id');
    }
}
