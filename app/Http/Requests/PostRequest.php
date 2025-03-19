<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'description' => 'nullable|max:200',
            'content' => 'nullable',
            'publish_date' => 'nullable|date',
            'status' => 'required|in:0,1,2',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
