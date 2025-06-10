<?php

namespace App\Services;

use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
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

            $branches = [];

            if (isset($data['branch_country_id'], $data['branch_city'])) {
                $branches = array_filter(
                    array_map(function ($countryId, $index) use ($data) {
                        $city = $data['branch_city'][$index] ?? null;

                        if ($countryId && $city) {
                            return [
                                'country_id' => $countryId,
                                'city' => $city,
                            ];
                        }

                        return null;
                    }, $data['branch_country_id'], array_keys($data['branch_country_id']))
                );
            }

            $organization = new Organization();
            $organization->fill([
                'id'                    => $user->id,
                'type_id'               => $data['organization_type_id'],
                'organization_sectors'  => $data['organization_sectors'],
                'employee_numbers_id'   =>$data['employee_numbers_id'],
                'annual_budgets_id'     =>$data['annual_budgets_id'],
                'established_year'      =>$data['established_year'],
                'website'               =>$data['website'],
                'branches'             => $branches,
            ]);

            // dd($branches);

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
    public function getOrganizationForUser()
{
    try {
        $userId = Auth::id();
        $organizations = Organization::with(['user','annualBudget','type'])
            ->where('id', $userId)
            ->get(); 
        return [
            'msg' => 'تم جلب البيانات.',
            'success' => true,
            'data' => $organizations 
        ];
    } catch (\Exception $e) {
        return [
            'msg' => $e->getMessage(),
            'success' => false,
            'data' => []
        ];
    }
}

}
