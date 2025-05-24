<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequiredDocument extends Model
{
    public function jobAd()
    {
        return $this->belongsTo(JobAd::class, 'job_ads_id');
    }

    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }
}