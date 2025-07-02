<?php

namespace App\Services;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainerService
{
    public function completeRegister($data, $id)
{
    try {
        DB::beginTransaction();

        $user = User::findOrFail($id);
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
            'id'                 => $user->id,
            'important_topics'  => $data['important_topics'],
            'work_fields'       => $data['work_fields'],
            'provided_services' => $data['provided_services'],
            'work_sectors'      => $data['work_sectors'],
            'international_exp' => $data['international_exp']?? null,
            'nationality'       => $data['nationality'],
            'sex'               => $data['sex'],
            'headline'          => $data['headline'],
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
            'data' => [
                'user' => $user,
                'trainer' => $trainer
            ]
        ];
    } catch (\Exception $e) {
        DB::rollBack();

        return [
            'msg' => $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}

public function updatePersonalInfo($data){
    try {
        $id = Auth::id();
        DB::beginTransaction();

        $user = User::findOrFail($id);
        $user->update([
            'bio' => $data['bio'],
        ]);

        $user->setTranslations('name', [
            'en' => $data['name_en'],
            'ar' => $data['name_ar'],
        ]);

        if (request()->hasFile('photo')) {
            $file = request()->file('photo');
            $path = $file->store('photos', 'public');
            $user->photo = $path;
        }

        $user->save();

        $trainer = Trainer::findOrFail($user->id);

        $trainer->update([
            'nationality'       => $data['nationality'],
            'headline'          => $data['headline'],
        ]);

        if (isset($data['hourly_wage'])) {
            $trainer->hourly_wage = $data['hourly_wage'];
        }

        if (isset($data['currency'])) {
            $trainer->currency = $data['currency'];
        }

        if (isset($data['linkedin_url'])) {
            $trainer->linkedin_url = $data['linkedin_url'];
        }

        $trainer->setTranslations('last_name', [
            'en' => $data['last_name_en'],
            'ar' => $data['last_name_ar'],
        ]);

        $trainer->save();

        DB::commit();

        return [
            'msg' => 'تم تخزين البيانات.',
            'success' => true,
            'data' => [
                'user' => $user,
                'trainer' => $trainer
            ]
        ];
    } catch (\Exception $e) {
        DB::rollBack();

        return [
            'msg' => $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}


public function updateExperiance($data){

    try {
        $id = Auth::id();
        DB::beginTransaction();

        $user = User::findOrFail($id);

        $trainer = Trainer::findOrFail($user->id);

        $trainer->update([
            'work_sectors'      => $data['work_sectors'],
            'provided_services' => $data['provided_services'],
            'work_fields'       => $data['work_fields'],
            'important_topics'  => $data['important_topics'],
            'international_exp' => $data['international_exp'],
        ]);

        $trainer->save();

        DB::commit();

        return [
            'msg' => 'تم تخزين البيانات.',
            'success' => true,
            'data' => [
                'user' => $user,
                'trainer' => $trainer
            ]
        ];
    } catch (\Exception $e) {
        DB::rollBack();

        return [
            'msg' => $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }

}


public function updateContactinfo($data){

    try {
        $id = Auth::id();

        DB::beginTransaction();

        $user = User::findOrFail($id);

        $user->update([
            'phone_number'  => $data['phone_number'],
            'city'          => $data['city'],
            'country_id'    => $data['country_id'],
        ]);

        $user->save();

        $trainer = Trainer::findOrFail($user->id);

        $trainer->update([
            'website' => $data['website'],
        ]);

        $trainer->save();

        DB::commit();

        return [
            'msg' => 'تم تخزين البيانات.',
            'success' => true,
            'data' => [
                'user' => $user,
                'trainer' => $trainer
            ]
        ];
    } catch (\Exception $e) {
        DB::rollBack();

        return [
            'msg' => $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }

}

}
