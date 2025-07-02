<?php

namespace App\Services;

use App\Models\TrainingProgram;

class TrainingAnnouncementService
{
    public function store($data)
    {
        $program = TrainingProgram::create($data);

        return [
            'msg' => 'تم تخزين البيانات بنجاح.',
            'success' => true,
            'data' => $program
        ];
    }
}
