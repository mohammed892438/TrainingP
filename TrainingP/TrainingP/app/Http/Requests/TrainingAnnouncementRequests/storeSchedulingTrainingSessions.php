<?php

namespace App\Http\Requests\TrainingAnnouncementRequests;

use Illuminate\Foundation\Http\FormRequest;

class storeSchedulingTrainingSessions extends FormRequest
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
            'schedules' => 'required|array|min:1',
            'schedules.*.session_date' => 'required|date',
            'schedules.*.duration_minutes' => 'required|integer|min:1',
        ];
    }
    public function messages(): array
{
    return [
        'schedules.required' => 'يرجى إضافة جلسة تدريب واحدة على الأقل.',
        'schedules.array' => 'يجب أن تكون الجلسات بصيغة مصفوفة صحيحة.',
        'schedules.min' => 'يجب إدخال جلسة تدريب واحدة على الأقل.',

        'schedules.*.session_date.required' => 'يرجى تحديد تاريخ الجلسة.',
        'schedules.*.session_date.date' => 'تاريخ الجلسة غير صالح.',

        'schedules.*.duration_minutes.required' => 'يرجى إدخال مدة الجلسة بالدقائق.',
        'schedules.*.duration_minutes.integer' => 'يجب أن تكون مدة الجلسة رقماً صحيحاً.',
        'schedules.*.duration_minutes.min' => 'الحد الأدنى لمدة الجلسة هو دقيقة واحدة.',
    ];
}

}
