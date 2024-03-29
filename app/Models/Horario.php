<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    
    protected $fillable = ['active', 'morning_start','morning_end','afternoon_start','afternoon_end','dia_semana'];

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
}
