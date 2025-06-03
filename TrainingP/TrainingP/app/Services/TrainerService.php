<?php

namespace App\Services;

use App\Models\Trainer;
use App\Models\User;
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
            'nationality'       => $data['nationality'],
            'sex'               => $data['sex'],
            'headline'          => $data['headline'],
            'status'            => $data['status'] ?? null,
            'hourly_wage'       => $data['hourly_wage'] ?? null,
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

}
