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
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'last_name_en' => ['required', 'string', 'max:255'],
            'last_name_ar' => ['required', 'string', 'max:255'],
            'country_id' => ['required', 'exists:countries,id'],
            'nationality' => 'required|array|min:1',
            'nationality.*' => 'exists:countries,id',
            'phone_number' => ['required', 'regex:/^\+?\d{8,19}$/'],
            'city' => 'required|string',
            'sex' => ['required', new Enum(SexEnum::class)],
            'work_fields' => ['required', 'array'],
            'work_fields.*' => ['exists:work_fields,id'],
            'education_levels_id' => ['required', 'exists:education_levels,id'],
        ];


    }

    public function messages(): array
    {
        return [
            'name_en.required' => 'الاسم بالإنجليزية مطلوب.',
            'name_en.string' => 'الاسم بالإنجليزية يجب أن يكون نصًا.',
            'name_en.max' => 'الاسم بالإنجليزية يجب ألا يزيد عن 255 حرفًا.',

            'name_ar.required' => 'الاسم بالعربية مطلوب.',
            'name_ar.string' => 'الاسم بالعربية يجب أن يكون نصًا.',
            'name_ar.max' => 'الاسم بالعربية يجب ألا يزيد عن 255 حرفًا.',

            'last_name_en.required' => 'اسم العائلة بالإنجليزية مطلوب.',
            'last_name_en.string' => 'اسم العائلة بالإنجليزية يجب أن يكون نصًا.',
            'last_name_en.max' => 'اسم العائلة بالإنجليزية يجب ألا يزيد عن 255 حرفًا.',

            'last_name_ar.required' => 'اسم العائلة بالعربية مطلوب.',
            'last_name_ar.string' => 'اسم العائلة بالعربية يجب أن يكون نصًا.',
            'last_name_ar.max' => 'اسم العائلة بالعربية يجب ألا يزيد عن 255 حرفًا.',

            'country_id.required' => 'الدولة مطلوبة.',
            'country_id.exists' => 'الدولة المختارة غير صحيحة.',

            'nationality.required' => 'الجنسية مطلوبة.',
            'nationality.array' => 'يجب اختيار جنسية واحدة على الأقل.',
            'nationality.*.exists' => 'الجنسية المحددة غير صحيحة.',

            'sex.required' => 'الجنس مطلوب.',
            'sex.in' => 'يرجى اختيار الجنس بين ذكر أو أنثى.',

            'work_fields.required' => 'مجال العمل مطلوب.',
            'work_fields.array' => 'مجال العمل يجب أن يكون قائمة.',
            'work_fields.*.exists' => 'مجال العمل المختار غير صحيح.',

            'education_levels_id.required' => 'مستوى التعليم مطلوب.',
            'education_levels_id.exists' => 'مستوى التعليم المختار غير صحيح.',

            'city.required' => 'المدينة مطلوبة.',

            'nationality.required' => 'الجنسية مطلوبة.',
            'nationality.array' => 'يجب اختيار جنسية واحدة على الأقل.',
            'nationality.*.exists' => 'الجنسية المحددة غير صحيحة.',

            'phone_number.required' => 'حقل رقم الجوال مطلوب.',
            'phone_number.regex' => 'يجب أن يكون رقم الجوال مكونًا من 8 إلى 20 رقمًا، ويمكن أن يبدأ بعلامة "+" فقط.',

        ];

    }
}

