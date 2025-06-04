<?php

namespace App\Http\Requests\OrganizationRequests;

use Illuminate\Foundation\Http\FormRequest;

class completeRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'name_en' => 'required|string|max:255',
        'name_ar' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'phone_number' => 'required|regex:/^[0-9]{10,15}$/',
        'website' => 'required|url',
        'country_id' => 'required|exists:countries,id',
        'organization_type_id' => 'required|exists:organization_types,id',

        'annual_budgets_id' => 'required|exists:annual_budgets,id',
        'employee_numbers_id' => 'required|exists:employee_numbers,id',
        'organization_sectors' => 'required|array',
        'organization_sectors.*' => 'exists:organization_sectors,id',
        'established_year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),

        'bio' => 'required|string|min:10|max:2000',
    ];

}

public function messages(): array
{
    return [
        'name_en.required' => 'اسم المؤسسة بالإنجليزية مطلوب',
        'name_ar.required' => 'اسم المؤسسة بالعربية مطلوب',

        'city.required' => 'المدينة مطلوبة',

        'phone_number.required' => 'رقم الهاتف مطلوب',
        'phone_number.regex' => 'يجب أن يكون رقم الهاتف بين 10 إلى 15 رقمًا',

        'website.required' => 'الموقع الإلكتروني مطلوب',
        'website.url' => 'يجب أن يكون الموقع الإلكتروني رابطًا صالحًا',

        'country_id.required' => 'الدولة مطلوبة',

        'organization_type_id.required' => 'نوع المؤسسة مطلوب',

        'annual_budgets_id.required' => 'الميزانية السنوية مطلوبة',
        'annual_budgets_id.exists' => 'الميزانية غير صالحة',

        'employee_numbers_id.required' => 'عدد الموظفين مطلوب',
        'employee_numbers_id.exists' => 'عدد الموظفين غير صالح',

        'organization_sectors.required' => 'القطاعات مطلوبة',
        'organization_sectors.*.exists' => 'القطاع المحدد غير صالح',

        'established_year.required' => 'سنة التأسيس مطلوبة',
        'established_year.digits' => 'سنة التأسيس يجب أن تكون من 4 أرقام',
        'established_year.integer' => 'سنة التأسيس يجب أن تكون رقمًا صحيحًا',
        'established_year.min' => 'سنة التأسيس غير صحيحة',
        'established_year.max' => 'سنة التأسيس غير صحيحة',


        'bio.required' => 'النبذة مطلوبة',
        'bio.min' => 'يجب ألا تقل النبذة عن 10 أحرف',
        'bio.max' => 'يجب ألا تزيد النبذة عن 2000 حرف',
    ];

}

}
