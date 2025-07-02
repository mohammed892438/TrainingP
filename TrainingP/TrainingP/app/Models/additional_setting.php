<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class additional_setting extends Model
{
    protected $fillable = [
        'training_program_id',
        'cost',
        'currency',
        'payment_method',
        'country_id',
        'city',
        'residential_address',
        'application_deadline',
        'max_trainees',
        'application_submission_method',
        'registration_link',
        'profile_image',
        'training_files',
    ];
    protected $casts = [
        'training_files' => 'array',
        'application_deadline' => 'date',
        'cost' => 'decimal:15',
    ];

    public function program()
    {
        return $this->belongsTo(TrainingProgram::class, 'training_program_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
