<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExplorationQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['answer','consultation_id','physical_exploration_id'];
}
