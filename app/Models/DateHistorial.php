<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateHistorial extends Model
{
    use HasFactory;

    protected $fillable = ['date_historial','patient_id'];
}
