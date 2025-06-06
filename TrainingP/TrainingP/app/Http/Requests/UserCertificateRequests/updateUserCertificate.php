<?php

namespace App\Http\Requests\UserCertificateRequests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserCertificate extends FormRequest
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
            'certificate_id' => 'required|exists:certificates,id',
            'issue_date' => 'required|date',
            'verification_link' => 'required|url',
        ];

    }

    public function messages(): array
{
    return [
        'certificate_id.required' => 'يرجى تحديد الشهادة.',
        'certificate_id.exists' => 'الشهادة المحددة غير موجودة.',

        'issue_date.required' => 'يرجى إدخال تاريخ الإصدار.',
        'issue_date.date' => 'يجب أن يكون تاريخ الإصدار بتنسيق تاريخ صالح.',

        'verification_link.required' => 'يرجى إدخال رابط التحقق.',
        'verification_link.url' => 'يجب أن يكون رابط التحقق عنوان URL صالحًا.',
    ];
}

}
