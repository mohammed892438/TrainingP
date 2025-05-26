<?php

namespace App\Models;

use App\Enums\SexEnum;
use App\Enums\TrainerStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'id',
        'last_name',
        'sex',
        'headline',
        'nationality_id',
        'work_sectors_id',
        'provided_services_id',
        'work_fields_id',
        'important_topics',
        'status',
        'hourly_wage',
    ];

    protected $casts = [
        'sex' => SexEnum::class,
        'status' => TrainerStatusEnum::class,
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
