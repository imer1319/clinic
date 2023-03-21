<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surnames', 'ci', 'celular', 'address', 'gender', 'nacimiento', 'notas', 'image', 'city'];

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
}
