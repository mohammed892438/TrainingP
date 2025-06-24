<?php

namespace App\Http\Requests\TrainerRequests;

use Illuminate\Foundation\Http\FormRequest;

class updateContactInfo extends FormRequest
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

            'country_id' => 'required|exists:countries,id',

            'city' => 'required|string',

            'phone_number' => ['required', 'regex:/^\+?\d{8,19}$/'],

            'website' => 'sometimes|url',
        ];
    }

    public function messages(): array
    {
        return [
            'country_id.required' => 'الدولة مطلوبة.',
            'country_id.exists' => 'الدولة المحددة غير صحيحة.',

            'city.required' => 'المدينة مطلوبة.',

            'phone_number.required' => 'حقل رقم الجوال مطلوب.',
            'phone_number.regex' => 'يجب أن يكون رقم الجوال مكونًا من 8 إلى 20 رقمًا، ويمكن أن يبدأ بعلامة "+" فقط.',

            'website.url' => 'يجب أن يكون الموقع الإلكتروني رابطًا صالحًا',

        ];
    }
}
