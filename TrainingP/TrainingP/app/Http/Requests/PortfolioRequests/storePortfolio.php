<?php

namespace App\Http\Requests\PortfolioRequests;

use Illuminate\Foundation\Http\FormRequest;

class storePortfolio extends FormRequest
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'file' => ['required'], // سيتم التحقق يدويًا في withValidator
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $fileInput = $this->file('file');
            $stringInput = $this->input('file');

            if (!$fileInput && !$stringInput) {
                $validator->errors()->add('file', 'يرجى إرفاق ملف أو إدخال رابط.');
            }

            // تحقق من الرابط إذا كان نص
            if (!$fileInput && $stringInput && !filter_var($stringInput, FILTER_VALIDATE_URL)) {
                $validator->errors()->add('file', 'الرابط غير صالح.');
            }

            // تحقق من الملف إذا كان مرفقًا
            if ($fileInput && !$fileInput->isValid()) {
                $validator->errors()->add('file', 'حدث خطأ أثناء رفع الملف.');
            }

            if ($fileInput) {
                $allowedMimes = ['application/pdf', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
                if (!in_array($fileInput->getMimeType(), $allowedMimes)) {
                    $validator->errors()->add('file', 'يجب أن يكون الملف بصيغة PDF أو PowerPoint فقط.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'title.required' => 'حقل العنوان مطلوب.',
            'title.string' => 'يجب أن يكون العنوان نصاً.',
            'title.max' => 'يجب ألا يتجاوز العنوان 255 حرفًا.',
            'file.required' => 'يرجى إرفاق ملف أو إدخال رابط.',
        ];
    }

}
