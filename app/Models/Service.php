<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name' ,'status'];

    public function consultations()
    {
        return $this->belongsToMany(Consultation::class, 'consultation_service');
    }

}
