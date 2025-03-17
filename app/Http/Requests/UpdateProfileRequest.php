<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'last_name' => 'required|string|max:20',
            'address' => 'nullable|string|max:200',
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Họ không được để trống.',
            'first_name.string' => 'Họ phải là chuỗi.',
            'first_name.max' => 'Họ không được vượt quá 30 ký tự.',
            'last_name.required' => 'Tên không được để trống.',
            'last_name.string' => 'Tên phải là chuỗi.',
            'last_name.max' => 'Tên không được vượt quá 20 ký tự.',
            'address.string' => 'Địa chỉ phải là chuỗi.',
            'address.max' => 'Địa chỉ không được vượt quá 200 ký tự.',
        ];
    }
}
