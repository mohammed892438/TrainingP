<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeNumber extends Model
{
    public function organizations()
    {
        return $this->hasMany(Organization::class, 'employee_numbers_id');
    }
}
