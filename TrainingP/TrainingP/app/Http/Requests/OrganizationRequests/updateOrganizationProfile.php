<?php

namespace App\Http\Requests\OrganizationRequests;

use Illuminate\Foundation\Http\FormRequest;

class updateOrganizationProfile extends FormRequest
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
            'name_en' => 'nullable|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone_number' => ['nullable', 'regex:/^\+?\d{8,19}$/'],
            'website' => 'nullable|url',
            'country_id' => 'nullable|exists:countries,id',
            'organization_type_id' => 'nullable|exists:organization_types,id',
            'annual_budgets_id' => 'nullable|exists:annual_budgets,id',
            'employee_numbers_id' => 'nullable|exists:employee_numbers,id',
            'organization_sectors' => 'nullable|array',
            'organization_sectors.*' => 'exists:organization_sectors,id',
            'established_year' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'bio' => 'nullable|string|min:10|max:2000',
            'branch_country_id' => 'nullable|array',
            'branch_country_id.*' => 'nullable|exists:countries,id',
            'branch_city' => 'nullable|array',
            'branch_city.*' => 'nullable|string|max:255',
        ];
    }
    public function messages()
{
    return [
        'name_en.max' => 'الاسم (بالإنجليزية) يجب أن لا يزيد عن 255 حرف.',
        'name_ar.max' => 'الاسم (بالعربية) يجب أن لا يزيد عن 255 حرف.',
        'city.max' => 'المدينة يجب أن لا تزيد عن 255 حرف.',
        'phone_number.regex' => 'رقم الهاتف غير صالح.',
        'website.url' => 'يرجى إدخال رابط موقع صحيح.',
        'country_id.exists' => 'البلد المحدد غير موجود.',
        'organization_type_id.exists' => 'نوع المنظمة المحدد غير موجود.',
        'annual_budgets_id.exists' => 'الميزانية السنوية المحددة غير موجودة.',
        'employee_numbers_id.exists' => 'عدد الموظفين المحدد غير موجود.',
        'organization_sectors.array' => 'يجب أن تكون القطاعات منظمة كمصفوفة.',
        'organization_sectors.*.exists' => 'قطاع المنظمة المحدد غير موجود.',
        'established_year.digits' => 'سنة التأسيس يجب أن تتكون من 4 أرقام.',
        'established_year.integer' => 'سنة التأسيس يجب أن تكون رقمًا صحيحًا.',
        'established_year.min' => 'سنة التأسيس يجب أن تكون أكبر من أو تساوي 1900.',
        'established_year.max' => 'سنة التأسيس يجب أن تكون أقل من أو تساوي السنة الحالية.',
        'bio.min' => 'السيرة الذاتية يجب أن تتكون من 10 أحرف على الأقل.',
        'bio.max' => 'السيرة الذاتية يجب أن لا تزيد عن 2000 حرف.',
        'branch_country_id.*.exists' => 'البلد المحدد غير موجود.',
        'branch_city.*.max' => 'اسم المدينة يجب أن لا يزيد عن 255 حرف.',
    ];
}
}
