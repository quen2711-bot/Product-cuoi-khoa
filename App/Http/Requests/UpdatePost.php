<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePost extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'title.max' => 'Tiêu đề không được vượt quá 50 ký tự.',
            'content.required' => 'Vui lòng nhập nội dung bài viết.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.mimes' => 'Ảnh chỉ chấp nhận JPG, JPEG, PNG hoặc WEBP.',
            'image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
        ];
    }
}