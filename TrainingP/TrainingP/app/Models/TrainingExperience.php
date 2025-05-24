<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingExperience extends Model
{
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}