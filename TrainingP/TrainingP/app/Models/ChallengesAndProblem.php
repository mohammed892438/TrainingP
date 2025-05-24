<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengesAndProblem extends Model
{
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organizations_id');
    }
}