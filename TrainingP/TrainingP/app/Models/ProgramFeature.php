<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramFeature extends Model
{
    public function trainingProgram()
    {
        return $this->belongsTo(TrainingProgram::class);
    }
}