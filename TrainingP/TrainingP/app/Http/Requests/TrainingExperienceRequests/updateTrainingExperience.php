<?php

namespace App\Http\Requests\TrainingExperienceRequests;

use Illuminate\Foundation\Http\FormRequest;

class updateTrainingExperience extends FormRequest
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
            'title_id' => 'nullable|exists:provided_services,id',
            'country_id' => 'nullable|exists:countries,id',
            'authority' => 'nullable|string|max:255',
            'engagement_type' => 'nullable|string|max:255',
            'trainees_number' => 'nullable|integer|min:1',
            'trainees_type' => 'nullable|string|max:255',
            'hours_number' => 'nullable|integer|min:1',
        ];
    }
    public function messages(): array
    {
        return [
            'title_id.exists' => 'معرف الخدمة المقدمة غير صحيح.',
            'country_id.exists' => 'معرف الدولة غير صحيح.',

            'authority.string' => 'يجب أن تكون الجهة نصًا.',
            'authority.max' => 'يجب ألا تزيد الجهة عن 255 حرفًا.',

            'engagement_type.string' => 'يجب أن يكون نوع الاشتراك نصًا.',
            'engagement_type.max' => 'يجب ألا يزيد نوع الاشتراك عن 255 حرفًا.',

            'trainees_number.integer' => 'يجب أن يكون عدد المتدربين رقمًا صحيحًا.',
            'trainees_number.min' => 'يجب أن يكون عدد المتدربين واحدًا على الأقل.',

            'trainees_type.string' => 'يجب أن يكون نوع المتدربين نصًا.',
            'trainees_type.max' => 'يجب ألا يزيد نوع المتدربين عن 255 حرفًا.',

            'hours_number.integer' => 'يجب أن يكون عدد الساعات رقمًا صحيحًا.',
            'hours_number.min' => 'يجب أن يكون عدد الساعات واحدًا على الأقل.',
        ];
    }
}
