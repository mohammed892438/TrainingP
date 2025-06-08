<?php

namespace App\Services;

use App\Models\Commitment;

class CommitmentService
{
    public function createCommitment($data)
    {
        try {
            $Commitment = Commitment::create($data);
            return [
                'msg' => 'تم تخزين الالتزام بنجاح',
                'success' => true,
                'data' => $Commitment
            ];
        } catch (\Exception $e) {
            return [
                'msg' => 'فشل إنشاء الالتزام: ' . $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function updateCommitment($commitment, $data)
    {
        try {
            $commitment = $commitment->update($data);
            return [
                'msg' => 'تم تعديل على الألتزام',
                'success' => true,
                'data' => $commitment
            ];
        } catch (\Exception $e) {
            return [
                'msg' => 'فشل تحديث الالتزام: ' . $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function getAllCommitments($organizationId)
    {
        try {
            $commitment =  Commitment::where('organization_id', $organizationId)->get();
            return [
                'msg' => 'تم جلب جيمع الألتزام',
                'success' => true,
                'data' => $commitment
            ];
        } catch (\Exception $e) {
            return [
                'msg' => 'فشل جلب الالتزامات: ' . $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }
}
