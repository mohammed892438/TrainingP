<?php

namespace App\Models;

use App\Enums\SexEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Assistant extends Model
{
    use HasTranslations;

    public array $translatable = ['last_name'];
    
    protected $fillable = [
        'id',
        'last_name',
        'sex',
        'headline',
        'nationality_id',
        'years_of_experience',
        'experience_areas_id',
        'educations_id',
        'provided_services_id',
        'hourly_wage',
    ];

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

    public function experienceArea()
    {
        return $this->belongsTo(ExperienceArea::class, 'experience_areas_id');
    }

    public function education()
    {
        return $this->belongsTo(Education::class, 'educations_id');
    }

    public function providedService()
    {
        return $this->belongsTo(ProvidedService::class, 'provided_services_id');
    }
}
