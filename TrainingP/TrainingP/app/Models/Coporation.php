<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coporation extends Model
{
    public function collaborations()
    {
        return $this->hasMany(Collaboration::class, 'coporations_id');
    }
}