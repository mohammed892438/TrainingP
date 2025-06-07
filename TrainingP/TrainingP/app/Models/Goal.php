<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{

    protected $fillable = [
        'name',
        'organizations_id',
    ];

    public function organization()
{
    return $this->belongsTo(Organization::class, 'organizations_id');
}
}