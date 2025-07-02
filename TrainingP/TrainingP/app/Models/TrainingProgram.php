<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    protected $fillable = [
        'title',
        'description',
        'program_type_id',
        'language_type_id',
        'training_classification_id',
        'training_level_id',
        'program_presentation_method_id',
        
    ];
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