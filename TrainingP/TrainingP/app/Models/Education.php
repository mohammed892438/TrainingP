<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{

    protected $table = 'educations';

    protected $fillable = [
        'specialization',
        'university',
        'graduation_year',
        'education_levels_id',
        'languages',
        'user_id',
    ];

    protected $casts = [
        'languages' => 'array',
    ];


    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class, 'education_levels_id');
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
