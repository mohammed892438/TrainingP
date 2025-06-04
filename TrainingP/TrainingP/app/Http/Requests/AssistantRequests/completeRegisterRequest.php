<?php

namespace App\Http\Requests\AssistantRequests;

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
        'phone_number' => 'required|string|min:10|max:20',

        'city' => 'required|string',

        'country_id' => 'required|exists:countries,id',

        'bio' => 'nullable|string',

        'name_en' => 'required|string|max:255',
        'name_ar' => 'required|string|max:255',

        'last_name_en' => 'required|string|max:255',
        'last_name_ar' => 'required|string|max:255',

        'headline' => 'required|string|max:255',

        'nationality_id' => 'required|exists:countries,id',

        'sex' => ['required', new Enum(SexEnum::class)],

        'years_of_experience' => 'required|integer|min:0',

        'provided_services' => 'required|array',
        'provided_services.*' => 'exists:provided_services,id',

        'experience_areas' => 'required|array',
        'experience_areas.*' => 'exists:experience_areas,id',

        'specialization' => 'required|string|max:255',

        'university' => 'required|string|max:255',

        'graduation_year' => 'required|date',

        'education_levels_id' => 'required|exists:education_levels,id',

        'languages_id' => 'required|exists:languages,id',
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

        'last_name_en.required' => 'الاسم الأخير باللغة الإنجليزية مطلوب.',
        'last_name_en.string' => 'يجب أن يكون الاسم الأخير باللغة الإنجليزية نصًا.',
        'last_name_en.max' => 'يجب ألا يتجاوز الاسم الأخير باللغة الإنجليزية 255 حرفًا.',

        'last_name_ar.required' => 'الاسم الأخير باللغة العربية مطلوب.',
        'last_name_ar.string' => 'يجب أن يكون الاسم الأخير باللغة العربية نصًا.',
        'last_name_ar.max' => 'يجب ألا يتجاوز الاسم الأخير باللغة العربية 255 حرفًا.',

        'headline.required' => 'المسمى الوظيفي مطلوب.',
        'headline.string' => 'يجب أن يكون المسمى الوظيفي نصًا.',
        'headline.max' => 'يجب ألا يتجاوز المسمى الوظيفي 255 حرفًا.',

        'nationality_id.required' => 'الجنسية مطلوبة.',
        'nationality_id.exists' => 'الجنسية المحددة غير صحيحة.',

        'sex.required' => 'الجنس مطلوب.',
        'sex.enum' => 'الجنس المحدد غير صالح.',

        'years_of_experience.required' => 'عدد سنوات الخبرة مطلوب.',
        'years_of_experience.integer' => 'يجب أن يكون عدد سنوات الخبرة رقمًا صحيحًا.',
        'years_of_experience.min' => 'يجب ألا يكون عدد سنوات الخبرة أقل من 0.',

        'provided_services.required' => 'الخدمات المقدمة مطلوبة.',
        'provided_services.*.exists' => 'الخدمة المحددة غير صالحة.',


        'experience_areas.required' => 'مجال الخبرة مطلوب.',
        'experience_areas.*.exists'  => 'مجال الخبرة المحدد غير صحيح.',

        'specialization.required' => 'التخصص مطلوب.',
        'specialization.string' => 'يجب أن يكون التخصص نصًا.',
        'specialization.max' => 'يجب ألا يتجاوز التخصص 255 حرفًا.',

        'university.required' => 'اسم الجامعة مطلوب.',
        'university.string' => 'يجب أن يكون اسم الجامعة نصًا.',
        'university.max' => 'يجب ألا يتجاوز اسم الجامعة 255 حرفًا.',

        'graduation_year.required' => 'سنة التخرج مطلوبة.',
        'graduation_year.date' => 'يجب أن تكون سنة التخرج تاريخًا صحيحًا.',

        'education_levels_id.required' => 'مستوى التعليم مطلوب.',
        'education_levels_id.exists' => 'مستوى التعليم المحدد غير صحيح.',

        'languages_id.required' => 'اللغات مطلوبة.',
        'languages_id.exists' => 'اللغات المحددة غير صحيحة.',
    ];
}

}
