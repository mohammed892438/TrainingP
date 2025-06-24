<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class previousTraining extends Model
{

    protected $table = 'previous_training';


    protected $fillable = [
        'video_link',
        'taining_title',
        'description',
        'trainer_id',
    ];

}
