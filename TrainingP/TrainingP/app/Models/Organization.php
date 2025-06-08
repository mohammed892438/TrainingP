<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{

    protected $fillable = [
        'id',
        'type_id',
        'website',
        'employee_numbers_id',
        'established_year',
        'annual_budgets_id',
        'organization_sectors',
        'work_type',
        'branches',
    ];

    protected $casts = [
        'organization_sectors' => 'array',
        'branches' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function type()
    {
        return $this->belongsTo(OrganizationType::class, 'type_id');
    }

    public function employeeNumber()
    {
        return $this->belongsTo(EmployeeNumber::class, 'employee_numbers_id');
    }

    public function annualBudget()
    {
        return $this->belongsTo(AnnualBudget::class, 'annual_budgets_id');
    }

    public function organizationSector()
    {
        return $this->belongsTo(OrganizationSector::class, 'organization_sectors_id');
    }

    public function collaborations()
    {
        return $this->hasMany(Collaboration::class, 'organizations_id');
    }

    public function goals()
    {
        return $this->hasMany(Goal::class, 'organizations_id');
    }

    public function challengesAndProblems()
    {
        return $this->hasMany(ChallengesAndProblem::class, 'organizations_id');
    }

    public function commitments()
    {
        return $this->hasMany(Commitment::class, 'organizations_id');
    }
    
}
