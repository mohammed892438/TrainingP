<?php

namespace App\Models;

use App\Enums\SexEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Trainee extends Model
{
    use HasTranslations;

    protected $casts = [
        'sex' => SexEnum::class,
        'work_fields' => 'array',
        'nationality' => 'array'
    ];

    public array $translatable = ['last_name'];

    protected $fillable = [
        'id',
        'last_name',
        'sex',
        'nationality',
        'work_fields',
        'education_levels_id',
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

