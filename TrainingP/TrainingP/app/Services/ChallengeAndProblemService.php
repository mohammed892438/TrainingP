<?php

namespace App\Services;

use App\Models\ChallengesAndProblem;
use Illuminate\Support\Facades\Auth;

class ChallengeAndProblemService
{
    public function showchallengeAndProblem(){
        try{
            $userId = Auth::id();
            $challengeAndProblem = ChallengesAndProblem::where('organizations_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $challengeAndProblem
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function storechallengeAndProblem($data){
        try{
            $userId = Auth::id();
            $data['organizations_id'] = $userId;
            $challengeAndProblem = ChallengesAndProblem::create($data);
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data' => $challengeAndProblem
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function updatechallengeAndProblem($data , $id){
        try{
            $challengeAndProblem = ChallengesAndProblem::findOrFail($id);
            $challengeAndProblem->update($data);
            return [
                'msg' => 'تم تعديل البيانات.',
                'success' => true,
                'data' => $challengeAndProblem
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function deletechallengeAndProblem($id){
        try{
            $challengeAndProblem = ChallengesAndProblem::findOrFail($id);
            $challengeAndProblem->delete();
            return [
                'msg' => 'تم مسح البيانات.',
                'success' => true,
                'data' => $challengeAndProblem
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }
}
