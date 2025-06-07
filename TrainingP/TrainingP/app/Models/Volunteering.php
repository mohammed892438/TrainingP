<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteering extends Model
{
    protected $fillable = [
        'type',
        'mounthly_hours',
        'training_titles',
        'users_id',
    ];

    protected $casts = [
        'training_titles' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
