<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class, 'education_levels_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'languages_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assistants()
    {
        return $this->hasMany(Assistant::class, 'educations_id');
    }
}
