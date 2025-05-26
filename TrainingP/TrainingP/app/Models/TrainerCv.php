<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TrainerCv extends Model
{
    use HasTranslations;

    public array $translatable = ['last_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}