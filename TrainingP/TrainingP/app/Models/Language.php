<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function educations()
    {
        return $this->hasMany(Education::class, 'languages_id');
    }

    public function tenders()
    {
        return $this->hasMany(Tender::class);
    }

    public function jobAds()
    {
        return $this->hasMany(JobAd::class);
    }
}
