<?php

namespace App\Http\Requests\TrainerRequests;

use App\Enums\SexEnum;
use App\Enums\TrainerStatusEnum;
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
            'headline' => 'required|string|max:255',
            'nationality_id' => 'required|exists:countries,id',
            'work_sectors_id' => 'required|exists:work_sectors,id',
            'provided_services_id' => 'required|exists:provided_services,id',
            'work_fields_id' => 'required|exists:work_fields,id',
            'important_topics' => 'required|string',
            'status' => ['nullable','string',new Enum(TrainerStatusEnum::class)],
            'hourly_wage' => 'nullable|numeric|min:0',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
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

            'headline.required' => 'المسمى الوظيفي مطلوب.',
            'headline.string' => 'يجب أن يكون المسمى الوظيفي نصًا.',
            'headline.max' => 'يجب ألا يتجاوز المسمى الوظيفي 255 حرفًا.',

            'nationality_id.required' => 'الجنسية مطلوبة.',
            'nationality_id.exists' => 'الجنسية المحددة غير صحيحة.',

            'work_sectors_id.required' => 'قطاع العمل مطلوب.',
            'work_sectors_id.exists' => 'قطاع العمل المحدد غير صحيح.',

            'provided_services_id.required' => 'الخدمات المقدمة مطلوبة.',
            'provided_services_id.exists' => 'الخدمات المقدمة المحددة غير صحيحة.',

            'work_fields_id.required' => 'مجال العمل مطلوب.',
            'work_fields_id.exists' => 'مجال العمل المحدد غير صحيح.',

            'important_topics.required' => 'المواضيع المهمة مطلوبة.',
            'important_topics.string' => 'يجب أن تكون المواضيع المهمة نصًا.',

            'status.string' => 'يجب أن تكون الحالة نصًا.',
            'status.enum' => 'الحالة المحددة غير صحيحة.',

            'hourly_wage.numeric' => 'يجب أن تكون الأجرة بالساعة رقمًا.',
            'hourly_wage.min' => 'يجب ألا تكون الأجرة بالساعة أقل من 0.',

            'name_en.required' => 'الاسم باللغة الإنجليزية مطلوب.',
            'name_en.string' => 'يجب أن يكون الاسم باللغة الإنجليزية نصًا.',
            'name_en.max' => 'يجب ألا يتجاوز الاسم باللغة الإنجليزية 255 حرفًا.',

            'name_ar.required' => 'الاسم باللغة العربية مطلوب.',
            'name_ar.string' => 'يجب أن يكون الاسم باللغة العربية نصًا.',
            'name_ar.max' => 'يجب ألا يتجاوز الاسم باللغة العربية 255 حرفًا.',

            'bio.string' => 'يجب أن يكون الوصف نصًا.',

            'country_id.required' => 'الدولة مطلوبة.',
            'country_id.exists' => 'الدولة المحددة غير صحيحة.',

            'phone_number.required' => 'رقم الهاتف مطلوب.',
            'phone_number.string' => 'يجب أن يكون رقم الهاتف نصًا.',
            'phone_number.min' => 'يجب ألا يقل رقم الهاتف عن 10 أرقام.',
            'phone_number.max' => 'يجب ألا يتجاوز رقم الهاتف 20 رقمًا.',
        ];
    }

}
