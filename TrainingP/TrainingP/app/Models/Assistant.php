<?php

namespace App\Models;

use App\Enums\SexEnum;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
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
