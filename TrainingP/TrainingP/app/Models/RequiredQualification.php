<?php

namespace App\Models;

use App\Enums\RequiredToEnum;
use Illuminate\Database\Eloquent\Model;

class RequiredQualification extends Model
{
    protected $casts = [
        'type' => RequiredToEnum::class,
    ];

    public function jobAd()
    {
        return $this->belongsTo(JobAd::class, 'job_ads_id');
    }

    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }
}

