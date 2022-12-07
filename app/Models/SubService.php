<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    use HasFactory;

    protected $fillable = ['name','price','status','service_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    public function appointments()
    {
        return $this->belongsToMany(Appointment::class);
    }
}
