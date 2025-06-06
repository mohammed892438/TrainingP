<?php

namespace App\Services;

use App\Models\Assistant;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Education;

class AssistantService
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

            $Assistant = new Assistant();
            $Assistant->fill([
                'id' =>$user->id,
                'headline' => $data['headline'],
                'nationality' => $data['nationality'],
                'sex' => $data['sex'],
                'years_of_experience' =>$data['years_of_experience'],
                'provided_services' => $data['provided_services'],
                'experience_areas' => $data['experience_areas'],
            ]);

            $Assistant->setTranslations('last_name', [
                'en' => $data['last_name_en'],
                'ar' => $data['last_name_ar'],
            ]);
            $Assistant->save();

            $education= Education::create([
                'user_id' => $user->id,
                'specialization' => $data['specialization'],
                'university' => $data['university'],
                'graduation_year' => $data['graduation_year'],
                'education_levels_id' => $data['education_levels_id'],
                'languages' => $data['languages'],
            ]);

            $education->save();


            DB::commit();
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data'=> [
                    'user' => $user,
                    'Assistant' => $Assistant
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
