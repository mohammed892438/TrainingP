<?php

namespace App\Services;

use App\Models\Commitment;
use Illuminate\Support\Facades\Auth;

class CommitmentService
{
    public function createCommitment($data)
    {
        try{
            $userId = Auth::id();
            $data['organizations_id'] = $userId;
            $commitment = Commitment::create($data);
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data' => $commitment
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function updateCommitment($data, $id)
    {
        try{
            $commitment = Commitment::findOrFail($id);
            $commitment->update($data);
            return [
                'msg' => 'تم تعديل البيانات.',
                'success' => true,
                'data' => $commitment
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function getAllCommitments()
    {
        try {
            $organizationId = Auth::id();
            $commitment =  Commitment::where('organizations_id', $organizationId)->get();
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
