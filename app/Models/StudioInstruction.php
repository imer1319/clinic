<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioInstruction extends Model
{
    use HasFactory;

    protected $fillable = ['instructions','consultation_id'];

}
