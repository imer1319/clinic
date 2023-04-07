<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioCarriedOut extends Model
{
    use HasFactory;

    protected $fillable = ['consultation_id', 'laboratory_id'];

}