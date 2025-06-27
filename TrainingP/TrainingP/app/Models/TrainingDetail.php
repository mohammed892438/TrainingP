<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingDetail extends Model
{
    protected $fillable = [
        'benefits',
        'target_audience',
        'requirements',
        'learning_outcomes',
        'training_program_id'
    ];
}
