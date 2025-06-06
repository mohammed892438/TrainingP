<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $fillable = [
        'title',
        'photo',
        'file',
        'user_id',
    ];


    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }
}
