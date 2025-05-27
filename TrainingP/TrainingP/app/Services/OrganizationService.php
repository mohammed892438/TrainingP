<?php

namespace App\Services;

use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class OrganizationService
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

            $organization = new Organization();
            $organization->fill([
                'id' => $user->id,
                'type_id' => $data['type_id'],
                'organization_sectors_id' => $data['organization_sectors_id'],
                'employee_numbers_id' =>$data['employee_numbers_id'],
                'annual_budgets_id' =>$data['annual_budgets_id'],
                'established_year' =>$data['established_year'],
                'website' =>$data['website'],
            ]);

            $organization->save();

            DB::commit();
            return [
                'msg' => 'تم تخزين البيانات.',
                'success' => true,
                'data'=> [
                    'user' => $user,
                    'organization' => $organization
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
