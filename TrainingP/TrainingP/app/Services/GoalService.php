<?php

namespace App\Services;

use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

class GoalService
{

    public function showGoal(){
        try{
            $userId = Auth::id();
            $goals = Goal::where('organizations_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $goals
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function storeGoal($data){
        try{
            $userId = Auth::id();
            $data['organizations_id'] = $userId;
            $goal = Goal::create($data);
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data' => $goal
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function updateGoal($data , $id){
        try{
            $goal = Goal::findOrFail($id);
            $goal->update($data);
            return [
                'msg' => 'تم تعديل البيانات.',
                'success' => true,
                'data' => $goal
            ];

        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success'=> false,
                'data' => []
            ];
        }
    }

    public function deleteGoal($id){
        try{
            $goal = Goal::findOrFail($id);
            $goal->delete();
            return [
                'msg' => 'تم مسح البيانات.',
                'success' => true,
                'data' => $goal
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