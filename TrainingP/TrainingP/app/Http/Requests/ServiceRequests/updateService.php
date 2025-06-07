<?php

namespace App\Http\Requests\ServiceRequests;

use Illuminate\Foundation\Http\FormRequest;

class updateService extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:1000',
            'training_areas' => 'required|string',
            'training_areas.*' => 'string|max:255',
            'client_type' => 'sometimes|required|string',
            'client_level' => 'sometimes|required|string',
            'application_method' => 'sometimes|required|string',
            'hourly_wage' => 'sometimes|required|numeric|min:0',
            'work_experience_id' => 'sometimes|required|exists:work_experiences,id',
            'added_value' => 'nullable|string',
            'notes' => 'nullable|string',
        ];

    }

    public function messages(): array
{
    return [
        'title.required' => 'العنوان مطلوب.',
        'title.string' => 'يجب أن يكون العنوان نصًا.',
        'title.max' => 'يجب ألا يتجاوز العنوان 255 حرفًا.',

        'description.required' => 'الوصف مطلوب.',
        'description.string' => 'يجب أن يكون الوصف نصًا.',
        'description.max' => 'يجب ألا يتجاوز الوصف 1000 حرفًا.',

        'training_areas.string' => 'يجب أن يكون مجالات التدريب نصًا.',
        'training_areas.required' => 'مجالات التدريب مطلوبة.',
        'training_areas.*.string' => 'يجب أن يكون كل عنصر في مجالات التدريب نصًا.',
        'training_areas.*.max' => 'يجب ألا يتجاوز كل عنصر في مجالات التدريب 255 حرفًا.',

        'client_type.required' => 'نوع العميل مطلوب.',
        'client_level.required' => 'مستوى العميل مطلوب.',
        'application_method.required' => 'طريقة التقديم مطلوبة.',

        'hourly_wage.required' => 'الأجر بالساعة مطلوب.',
        'hourly_wage.numeric' => 'يجب أن يكون الأجر رقمًا.',
        'hourly_wage.min' => 'يجب ألا يكون الأجر أقل من 0.',

        'work_experience_id.required' => 'رقم الخبرة العملية مطلوب.',
        'work_experience_id.exists' => 'الخبرة العملية المحددة غير موجودة.',

    ];
}
}
