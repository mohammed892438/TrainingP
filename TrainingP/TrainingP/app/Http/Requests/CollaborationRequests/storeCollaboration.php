<?php

namespace App\Http\Requests\CollaborationRequests;

use Illuminate\Foundation\Http\FormRequest;

class storeCollaboration extends FormRequest
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
           'coporations_id' => 'required|exists:coporations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'coporations_id.required' => 'حقل الشركة مطلوب.',
            'coporations_id.exists' => 'الشركة المحددة غير موجودة.',
        ];
    }

}
