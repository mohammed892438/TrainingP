<?php

namespace App\Services;

use App\Models\Trainer;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class TrainerService
{
    public function completeRegister($data , $id){
        try{
            DB::beginTransaction();
            $user = User::find($id);
            $user->update([
                'phone_number' => $data['phone_number'],
                'city' => $data['city'],
                'country_id' => $data['country_id'],
                'bio' => $data['bio'],
            ]);

            $user->setTranslations('name', [
                'en' => $data['name_en'],
                'ar' => $data['name_ar'],
            ]);

            $user->save();

            $trainer = new Trainer();
            $trainer->fill([
                'id' => $user->id,
                'important_topics' => $data['important_topics'],
                'work_fields_id' => $data['work_fields_id'],
                'provided_services_id' => $data['provided_services_id'],
                'work_sectors_id' => $data['work_sectors_id'],
                'nationality_id' => $data['nationality_id'],
                'sex' => $data['sex'],
                'headline' => $data['headline']
            ]);

            $trainer->setTranslations('last_name', [
                'en' => $data['last_name_en'],
                'ar' => $data['last_name_ar'],
            ]);

            $trainer->save();

            DB::commit();
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data'=> [
                    'user' => $user,
                    'trainer' => $trainer
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
