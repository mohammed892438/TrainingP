<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainingPrograms()
    {
        return $this->hasMany(TrainingProgram::class, 'ads_id');
    }

    public function tenders()
    {
        return $this->hasMany(Tender::class, 'ads_id');
    }

    public function jobAds()
    {
        return $this->hasMany(JobAd::class, 'ads_id');
    }
}