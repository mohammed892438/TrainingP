<?php

namespace App\Http\Requests\TrainingAnnouncementRequests;

use Illuminate\Foundation\Http\FormRequest;

class storeAdditionalSettings extends FormRequest
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
            'is_free' => 'sometimes|boolean',
            'cost' => 'nullable|numeric',
            'currency' => 'nullable|string|max:10',
            'payment_method' => 'nullable|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
            'city' => 'nullable|string|max:255',
            'residential_address' => 'nullable|string',
            'application_deadline' => 'required|date',
            'max_trainees' => 'required|integer|min:1',
            'application_submission_method' => 'required|in:inside_platform,outside_platform',
            'registration_link' => 'nullable|url',
            'profile_image' => 'nullable|image|max:2048',
            'training_files.*' => 'nullable|file|max:5120',
        ];
    }
    public function messages(): array
{
    return [

        'is_free.boolean' => 'قيمة حقل "تدريب مجاني" يجب أن تكون صحيحة أو خاطئة.',

        'cost.numeric' => 'قيمة التكلفة يجب أن تكون رقمية.',
        'currency.string' => 'العملة يجب أن تكون نصاً.',
        'currency.max' => 'العملة يجب ألا تتجاوز 10 أحرف.',
        'payment_method.string' => 'طريقة الدفع يجب أن تكون نصاً.',
        'payment_method.max' => 'طريقة الدفع يجب ألا تتجاوز 255 حرفاً.',

        'country_id.exists' => 'الدولة المحددة غير موجودة.',
        'city.string' => 'اسم المدينة يجب أن يكون نصاً.',
        'city.max' => 'اسم المدينة يجب ألا يتجاوز 255 حرفاً.',
        'residential_address.string' => 'العنوان التفصيلي يجب أن يكون نصاً.',

        'application_deadline.required' => 'يرجى تحديد آخر موعد للتقديم.',
        'application_deadline.date' => 'تنسيق تاريخ آخر موعد غير صالح.',

        'max_trainees.required' => 'يرجى تحديد العدد الأقصى للمتدربين.',
        'max_trainees.integer' => 'يجب أن يكون العدد الأقصى رقماً صحيحاً.',
        'max_trainees.min' => 'يجب ألا يقل العدد الأقصى للمتدربين عن 1.',

        'application_submission_method.required' => 'يرجى تحديد طريقة استقبال الطلبات.',
        'application_submission_method.in' => 'طريقة استقبال الطلبات غير صالحة.',

        'registration_link.url' => 'رابط التسجيل غير صالح.',

        'profile_image.image' => 'يجب أن تكون الصورة التعريفية من نوع صورة.',
        'profile_image.max' => 'الحد الأقصى لحجم الصورة هو 2 ميغابايت.',

        'training_files.*.file' => 'كل ملف يجب أن يكون من نوع ملف صالح.',
        'training_files.*.max' => 'كل ملف يجب ألا يتجاوز حجمه 5 ميغابايت.',
    ];
}

}
