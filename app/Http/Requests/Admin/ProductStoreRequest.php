<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends ProductRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        // Khi tạo mới bắt buộc có ít nhất 1 ảnh
        $rules['images']   = ['required', 'array', 'min:1'];
        $rules['images.*'] = ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'];
        return $rules;
    }

    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'images.required' => 'Sản phẩm phải có ít nhất 1 ảnh.',
            'images.min'      => 'Sản phẩm phải có ít nhất 1 ảnh.',
        ]);
    }
}
