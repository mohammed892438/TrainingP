<?php

namespace App\Services;

use App\Models\Trainee;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TraineeService
{
   public function completeRegister($data , $id){
        try{
            DB::beginTransaction();
            $user = User::find($id);
            $user->update([
                'phone_number' => $data['phone_number'],
                'city' => $data['city'],
                'country_id' => $data['country_id'],
            ]);

            $user->setTranslations('name', [
                'en' => $data['name_en'],
                'ar' => $data['name_ar'],
            ]);

            $user->save();

            $trainee = new Trainee();
            $trainee->fill([
                'id' => $user->id,
                'education_levels_id'  => $data['education_levels_id'],
                'work_fields'          => $data['work_fields'],
                'nationality'          => $data['nationality'],
                'sex'                  => $data['sex'],
            ]);

            $trainee->setTranslations('last_name', [
                'en' => $data['last_name_en'],
                'ar' => $data['last_name_ar'],
            ]);

            $trainee->save();

            DB::commit();
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data'=> [
                    'user' => $user,
                    'trainee' => $trainee
                ]
            ];
        }catch(\Exception $e){
            DB::rollBack();
            return [
                'msg' => $e->getMessage(),
                'success' => false,
                'data' => []
            ];
        }
   }
}
