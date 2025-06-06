<?php

namespace App\Http\Requests\SkillRequests;

use Illuminate\Foundation\Http\FormRequest;

class storeSkillRequest extends FormRequest
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
            'name' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => ' الأسم المهارة مطلوب.',
            'name.string' => 'يجب ان يكون الاسم مكون من محارف.',
        ];
    }
}
