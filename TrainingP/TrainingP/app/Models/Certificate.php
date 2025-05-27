<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'issuer'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_certificates')
                    ->withPivot('issue_date', 'verification_link')
                    ->withTimestamps();
    }
}