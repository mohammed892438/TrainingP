<?php

namespace App\Models;

use App\Enums\CommittedToEnum;
use Illuminate\Database\Eloquent\Model;

class Commitment extends Model
{
    protected $fillable = ['name', 'committed_to', 'organizations_id'];
    protected $casts = [
        'committed_to' => CommittedToEnum::class,
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organizations_id');
    }
}
