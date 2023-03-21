<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExploration extends Model
{
    protected $fillable = ['question','status'];

    use HasFactory;

    public function physicalExplorationQuestions()
    {
        return $this->hasOne(PhysicalExplorationQuestion::class);
    }
}
