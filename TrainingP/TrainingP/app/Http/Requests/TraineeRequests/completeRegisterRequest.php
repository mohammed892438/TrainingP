<?php

namespace App\Http\Requests\TraineeRequests;

use App\Enums\SexEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            'last_name_en' => 'required|string|max:255',
            'last_name_ar' => 'required|string|max:255',
            'sex' => ['required', new Enum(SexEnum::class)],
            'nationality_id' => 'required|exists:countries,id',
            'work_fields_id' => 'required|exists:work_fields,id',
            'education_levels_id' => 'required|exists:education_levels,id',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'city' => 'required|string',
            'phone_number' => 'required|string|min:10|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'last_name_en.required' => 'الاسم الأخير باللغة الإنجليزية مطلوب.',
            'last_name_en.string' => 'يجب أن يكون الاسم الأخير باللغة الإنجليزية نصًا.',
            'last_name_en.max' => 'يجب ألا يتجاوز الاسم الأخير باللغة الإنجليزية 255 حرفًا.',

            'last_name_ar.required' => 'الاسم الأخير باللغة العربية مطلوب.',
            'last_name_ar.string' => 'يجب أن يكون الاسم الأخير باللغة العربية نصًا.',
            'last_name_ar.max' => 'يجب ألا يتجاوز الاسم الأخير باللغة العربية 255 حرفًا.',

            'sex.required' => 'الجنس مطلوب.',
            'sex.enum' => 'الجنس المحدد غير صالح.',

            'nationality_id.required' => 'الجنسية مطلوبة.',
            'nationality_id.exists' => 'الجنسية المحددة غير صحيحة.',

            'work_fields_id.required' => 'مجال العمل مطلوب.',
            'work_fields_id.exists' => 'مجال العمل المحدد غير صحيح.',


            'name_en.required' => 'الاسم باللغة الإنجليزية مطلوب.',
            'name_en.string' => 'يجب أن يكون الاسم باللغة الإنجليزية نصًا.',
            'name_en.max' => 'يجب ألا يتجاوز الاسم باللغة الإنجليزية 255 حرفًا.',

            'name_ar.required' => 'الاسم باللغة العربية مطلوب.',
            'name_ar.string' => 'يجب أن يكون الاسم باللغة العربية نصًا.',
            'name_ar.max' => 'يجب ألا يتجاوز الاسم باللغة العربية 255 حرفًا.',

            'country_id.required' => 'الدولة مطلوبة.',
            'country_id.exists' => 'الدولة المحددة غير صحيحة.',

            'city.required' => 'المدينة مطلوبة.',

            'phone_number.required' => 'رقم الهاتف مطلوب.',
            'phone_number.string' => 'يجب أن يكون رقم الهاتف نصًا.',
            'phone_number.min' => 'يجب ألا يقل رقم الهاتف عن 10 أرقام.',
            'phone_number.max' => 'يجب ألا يتجاوز رقم الهاتف 20 رقمًا.',
        ];
    }
}

