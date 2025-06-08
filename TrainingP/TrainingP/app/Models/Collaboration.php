<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{

    protected $fillable = [
        'organizations_id',
        'coporations_id',
    ];


    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organizations_id');
    }

    public function coporation()
    {
        return $this->belongsTo(Coporation::class, 'coporations_id');
    }
}