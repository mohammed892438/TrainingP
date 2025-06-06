<?php

namespace App\Http\Requests\EducationRequests;

use Illuminate\Foundation\Http\FormRequest;

class storeEducation extends FormRequest
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
            'specialization' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'graduation_year' => 'required|date',
            'education_levels_id' => 'required|exists:education_levels,id',
            'languages' => 'required|array',
            'languages.*' => 'exists:languages,id',
        ];
    }

    public function messages(): array
    {
        return [
            'specialization.required' => 'يرجى إدخال التخصص.',
            'specialization.string' => 'يجب أن يكون التخصص نصًا.',
            'specialization.max' => 'يجب ألا يزيد طول التخصص عن 255 حرفًا.',

            'university.required' => 'يرجى إدخال اسم الجامعة.',
            'university.string' => 'يجب أن يكون اسم الجامعة نصًا.',
            'university.max' => 'يجب ألا يزيد طول اسم الجامعة عن 255 حرفًا.',

            'graduation_year.required' => 'يرجى إدخال سنة التخرج.',
            'graduation_year.date' => 'يجب أن تكون سنة التخرج بتنسيق تاريخ صالح.',

            'education_levels_id.required' => 'يرجى تحديد مستوى التعليم.',
            'education_levels_id.exists' => 'المستوى التعليمي المحدد غير موجود.',

            'languages.required' => 'اللغات مطلوبة.',
            'languages.*.exists' => 'اللغات المحددة غير صحيحة.',
        ];
    }


}
