<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191',
                'regex:/^[\p{Arabic}a-zA-Z\s\-\'"]+$/u',
            ],
            'email' => [
                'required',
                'email',
                'max:191',
            ],
            'phone' => [
                'required',
                'regex:/^[\+]?[0-9\s\-\(\)]{8,15}$/',
            ],
            'message' => [
                'required',
                'string',
                'max:300',
                // منع HTML و JS
                'not_regex:/[<>]/',
                'not_regex:/(script|javascript|vbscript|onload|onerror|onclick)/i',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.regex' => 'الاسم يجب أن يحتوي على أحرف عربية أو إنجليزية فقط',
            'name.max' => 'الاسم يجب ألا يزيد عن 191 حرف',

            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'تنسيق البريد الإلكتروني غير صحيح',
            'email.max' => 'البريد الإلكتروني يجب ألا يزيد عن 191 حرف',

            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.regex' => 'رقم الهاتف يجب أن يحتوي على 8-15 رقم ويمكن أن يبدأ بـ +',

            'message.required' => 'الرسالة مطلوبة',
            'message.max' => 'الرسالة يجب ألا تزيد عن 300 حرف',
            'message.not_regex' => 'الرسالة تحتوي على محتوى غير مسموح',
        ];
    }
}
