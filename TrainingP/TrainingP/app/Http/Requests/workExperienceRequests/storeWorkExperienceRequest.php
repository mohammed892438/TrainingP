<?php

namespace App\Http\Requests\workExperienceRequests;

use Illuminate\Foundation\Http\FormRequest;

class storeWorkExperienceRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'the_authority' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'country_id' => 'required|exists:countries,id',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'العنوان مطلوب.',
            'title.string' => 'يجب أن يكون العنوان نصًا.',
            'title.max' => 'يجب ألا يزيد العنوان عن 255 حرفًا.',

            'the_authority.required' => 'الجهة المسؤولة مطلوبة.',
            'the_authority.string' => 'يجب أن تكون الجهة المسؤولة نصًا.',
            'the_authority.max' => 'يجب ألا تزيد الجهة المسؤولة عن 255 حرفًا.',

            'start_date.required' => 'تاريخ البدء مطلوب.',
            'start_date.date' => 'يجب أن يكون تاريخ البدء تاريخًا صحيحًا.',

            'end_date.date' => 'يجب أن يكون تاريخ الانتهاء تاريخًا صحيحًا.',
            'end_date.after_or_equal' => 'يجب أن يكون تاريخ الانتهاء بعد أو يساوي تاريخ البدء.',

            'country_id.required' => 'الدولة مطلوبة.',
            'country_id.exists' => 'معرف الدولة غير صحيح.',
        ];
    }
}
