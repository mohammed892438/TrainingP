<?php

namespace App\Http\Requests\VolunteeringRequests;

use Illuminate\Foundation\Http\FormRequest;

class updateVolunteering extends FormRequest
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
            'type' => 'required|string|max:255|exists:provided_services,id',
            'mounthly_hours' => 'required|integer|min:1',
            'training_titles' => 'required|string',
            'training_titles.*' => 'string|max:255',
        ];

    }

    public function messages(): array
    {
        return [
            'type.required' => 'نوع الخدمة مطلوب.',
            'type.string' => 'يجب أن يكون نوع الخدمة نصًا.',
            'type.max' => 'يجب ألا يتجاوز نوع الخدمة 255 حرفًا.',
            'type.exists' => 'نوع الخدمة المحدد غير موجود في قاعدة البيانات.',

            'mounthly_hours.required' => 'عدد ساعات التطوع الشهري مطلوب.',
            'mounthly_hours.integer' => 'يجب أن يكون عدد ساعات التطوع رقمًا صحيحًا.',
            'mounthly_hours.min' => 'يجب أن يكون عدد ساعات التطوع ساعة واحدة على الأقل.',

            'training_titles.string' => 'يجب أن يكون مجالات التدريب نصًا.',
            'training_titles.required' => 'مجالات التدريب مطلوبة.',
            'training_titles.*.string' => 'يجب أن يكون كل عنصر في مجالات التدريب نصًا.',
            'training_titles.*.max' => 'يجب ألا يتجاوز كل عنصر في مجالات التدريب 255 حرفًا.',
        ];
    }

}
