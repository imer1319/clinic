<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surnames', 'ci', 'celular', 'address', 'gender', 'nacimiento', 'notas', 'image', 'city'];
    protected $dates = ['nacimiento'];
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function vitalSigns()
    {
        return $this->hasMany(VitalSign::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    public function dateHistorial()
    {
        return $this->hasOne(DateHistorial::class);
    }

    public function diaries()
    {
        return $this->hasMany(Diary::class);
    }
}
