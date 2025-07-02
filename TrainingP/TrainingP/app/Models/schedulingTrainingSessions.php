<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class schedulingTrainingSessions extends Model
{
    protected $fillable = [
        'training_program_id',
        'session_date',
        'duration_minutes'
    ];
}
