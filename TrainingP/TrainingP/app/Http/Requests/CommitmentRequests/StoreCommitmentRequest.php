<?php

namespace App\Http\Requests\CommitmentRequests;

use App\Enums\CommittedToEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommitmentRequest extends FormRequest
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
    public function rules()
{
    return [
        'name' => 'required|string|max:255',
        'committed_to' => 'required|in:' . implode(',', array_column(CommittedToEnum::cases(), 'value')),
    ];
}

public function messages()
{
    return [
        'name.required' => 'اسم الالتزام مطلوب.',
        'name.string' => 'يجب أن يكون اسم الالتزام نصًا.',
        'name.max' => 'يجب ألا يتجاوز اسم الالتزام 255 حرفًا.',
        'committed_to.required' => 'يجب تحديد جهة الالتزام.',
        'committed_to.in' => 'جهة الالتزام غير صالحة.',
    ];
}
}
