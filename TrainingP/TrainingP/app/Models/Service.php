<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'title',
        'description',
        'training_areas',
        'client_type',
        'client_level',
        'application_method',
        'hourly_wage',
        'work_experience_id',
        'added_value',
        'notes',
        'users_id',
    ];
    
    protected $casts = [
        'training_areas' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function workExperience()
    {
    return $this->belongsTo(WorkExperience::class, 'work_experience_id');
    }

}