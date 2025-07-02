<?php

namespace App\Http\Requests\TrainingAnnouncementRequests;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'nullable|string',
            'program_type_id' => 'required|exists:program_types,id',
            'language_type_id' => 'required|exists:languages,id',
            'training_classification_id' => 'required|exists:training_classifications,id',
            'training_level_id' => 'required|exists:training_levels,id',
            'program_presentation_method_id' => 'required|exists:program_presentation_methods,id',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'حقل العنوان مطلوب.',
            'title.string' => 'يجب أن يكون العنوان نصاً.',
            'description.string' => 'يجب أن يكون الوصف نصاً.',
            'program_type_id.required' => 'يرجى اختيار نوع البرنامج.',
            'program_type_id.exists' => 'نوع البرنامج المختار غير صالح.',
            'language_type_id.required' => 'يرجى اختيار اللغة.',
            'language_type_id.exists' => 'اللغة المختارة غير صالحة.',
            'training_classification_id.required' => 'يرجى اختيار تصنيف التدريب.',
            'training_classification_id.exists' => 'تصنيف التدريب غير صالح.',
            'training_level_id.required' => 'يرجى اختيار مستوى التدريب.',
            'training_level_id.exists' => 'مستوى التدريب غير صالح.',
            'program_presentation_method_id.required' => 'يرجى اختيار طريقة العرض.',
            'program_presentation_method_id.exists' => 'طريقة العرض غير صالحة.',
        ];
    }
}
