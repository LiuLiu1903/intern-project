<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                'unique:users,email',
                'regex:/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/', // Ký tự hoa
                'regex:/[a-z]/', // Ký tự thường
                'regex:/[0-9]/', // Chữ số
                'regex:/[@$!%*?&]/' // Ký tự đặc biệt
            ],
        ];
    }
    
    public function messages()
    {
        return [
            'first_name.required' => 'Vui lòng nhập tên.',
            'first_name.max' => 'Tên không được vượt quá 30 ký tự.',
            'last_name.required' => 'Vui lòng nhập họ.',
            'last_name.max' => 'Họ không được vượt quá 30 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.regex' => 'Email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu phải bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.',
        ];
    }
}
