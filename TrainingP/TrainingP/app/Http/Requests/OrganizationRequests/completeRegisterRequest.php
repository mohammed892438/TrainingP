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
        'phone_number' => 'required|string|min:10|max:20',
        'city' => 'required|string',
        'country_id' => 'required|exists:countries,id',
        'bio' => 'nullable|string',
        'name_en' => 'required|string|max:255',
        'name_ar' => 'required|string|max:255',
        'type_id' => 'required|exists:organization_types,id',
        'organization_sectors_id' => 'required|exists:organization_sectors,id',
        'employee_numbers_id' => 'required|exists:employee_numbers,id',
        'annual_budgets_id' => 'required|exists:annual_budgets,id',
        'established_year' => 'required|integer|min:1800|max:' . date('Y'),
        'website' => 'nullable|url',
    ];
}

public function messages(): array
{
    return [
        'phone_number.required' => 'رقم الهاتف مطلوب.',
        'phone_number.string' => 'يجب أن يكون رقم الهاتف نصًا.',
        'phone_number.min' => 'يجب ألا يقل رقم الهاتف عن 10 أرقام.',
        'phone_number.max' => 'يجب ألا يتجاوز رقم الهاتف 20 رقمًا.',

        'city.required' => 'المدينة مطلوبة.',
        'city.string' => 'يجب أن تكون المدينة نصًا.',

        'country_id.required' => 'الدولة مطلوبة.',
        'country_id.exists' => 'الدولة المحددة غير صحيحة.',

        'bio.string' => 'يجب أن يكون الوصف نصًا.',

        'name_en.required' => 'الاسم باللغة الإنجليزية مطلوب.',
        'name_en.string' => 'يجب أن يكون الاسم باللغة الإنجليزية نصًا.',
        'name_en.max' => 'يجب ألا يتجاوز الاسم باللغة الإنجليزية 255 حرفًا.',

        'name_ar.required' => 'الاسم باللغة العربية مطلوب.',
        'name_ar.string' => 'يجب أن يكون الاسم باللغة العربية نصًا.',
        'name_ar.max' => 'يجب ألا يتجاوز الاسم باللغة العربية 255 حرفًا.',

        'type_id.required' => 'نوع المنظمة مطلوب.',
        'type_id.exists' => 'نوع المنظمة المحدد غير صالح.',

        'organization_sectors_id.required' => 'قطاع المنظمة مطلوب.',
        'organization_sectors_id.exists' => 'قطاع المنظمة المحدد غير صالح.',

        'employee_numbers_id.required' => 'عدد الموظفين مطلوب.',
        'employee_numbers_id.exists' => 'عدد الموظفين المحدد غير صحيح.',

        'annual_budgets_id.required' => 'الميزانية السنوية مطلوبة.',
        'annual_budgets_id.exists' => 'الميزانية السنوية المحددة غير صحيحة.',

        'established_year.required' => 'سنة التأسيس مطلوبة.',
        'established_year.integer' => 'يجب أن تكون سنة التأسيس رقمًا صحيحًا.',
        'established_year.min' => 'يجب أن تكون سنة التأسيس بعد عام 1800.',
        'established_year.max' => 'يجب أن تكون سنة التأسيس قبل العام الحالي.',

        // 'website.url' => 'يجب أن يكون عنوان الموقع الإلكتروني صحيحًا.',
    ];
}

}
