<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Xác định người dùng có được phép gửi request hay không.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Các quy tắc xác thực áp dụng cho request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:8'
        ];
    }

    /**
     * Các thông báo lỗi tùy chỉnh.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được vượt quá 100 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
        ];
    }
}
