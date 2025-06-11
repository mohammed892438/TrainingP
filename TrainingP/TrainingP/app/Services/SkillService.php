<?php

namespace App\Services;

use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class SkillService
{
    public function storeSkill($data)
    {
        try {
            $skill = Skill::create($data);
            return [
                'msg' => 'تم إنشاء المهارة بنجاح.',
                'success' => true,
                'data' => $skill
            ];
        } catch (\Exception $e) {
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function updateSkill(Skill $skill, $data)
    {
        try {
            $skill->update($data);
            return [
                'msg' => 'تم تحديث المهارة بنجاح.',
                'success' => true,
                'data' => $skill
            ];
        } catch (\Exception $e) {
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function deleteSkill(Skill $skill)
    {
        try {
            $skill->delete();
            return [
                'msg' => 'تم حذف المهارة بنجاح.',
                'success' => true,
                'data' => []
            ];
        } catch (\Exception $e) {
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }

    public function showSkill(){
        try{
            $userId = Auth::id();
            $skill = Skill::where('users_id',$userId)->get();
            return [
                'msg' => 'تم جلب البيانات.',
                'success' => true,
                'data' => $skill
            ];
        }catch(\Exception $e){
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
    }
}