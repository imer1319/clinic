<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subservicio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','status','servicio_id','precio'];

    public function consultations()
    {
        return $this->belongsToMany(Consultation::class, 'consultation_subservice');
    }

    public function servicio()
    {
        return $this->belongsTo(Service::class);
    }

    public function imagen()
    {
        return $this->hasOne(ImagenSubservicio::class,'consultation_subservice_id');
    }
}
