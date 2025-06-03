<?php

namespace App\Models;

use App\Enums\SexEnum;
use App\Enums\TrainerStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Log;

class Trainer extends Model
{
    use HasTranslations;

    public array $translatable = ['last_name'];

    protected $fillable = [
        'id',
        'sex',
        'headline',
        'work_sectors',
        'provided_services',
        'work_fields',
        'important_topics',
        'nationality',
        'status',
        'hourly_wage',
    ];


    protected $casts = [
        'sex' => SexEnum::class,
        'status' => TrainerStatusEnum::class,

        'work_sectors' => 'array',
        'provided_services' => 'array',
        'work_fields' => 'array',
        'nationality' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function workSector()
    {
        return $this->belongsTo(WorkSector::class, 'work_sectors_id');
    }

    public function providedService()
    {
        return $this->belongsTo(ProvidedService::class, 'provided_services_id');
    }

    public function workField()
    {
        return $this->belongsTo(WorkField::class, 'work_fields_id');
    }

    public function trainingExperiences()
    {
        return $this->hasMany(TrainingExperience::class);
    }
}
