<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'ads_id');
    }

    public function programAxes()
    {
        return $this->hasMany(ProgramAxe::class);
    }

    public function programFeatures()
    {
        return $this->hasMany(ProgramFeature::class);
    }

    public function appRequirements()
    {
        return $this->hasMany(AppRequirement::class);
    }
}