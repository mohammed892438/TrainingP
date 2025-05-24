<?php

namespace App\Models;

use App\Enums\SexEnum;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    protected $casts = [
        'sex' => SexEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function workField()
    {
        return $this->belongsTo(WorkField::class, 'work_fields_id');
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class, 'education_levels_id');
    }
}

