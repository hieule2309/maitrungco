<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'price'         => ['required', 'numeric', 'min:0'],
            'active'        => ['nullable', 'boolean'],
            'categories'    => ['required', 'array', 'min:1'],
            'categories.*'  => ['integer', 'exists:categories,id'],
            'filter_values' => ['nullable', 'array'],
            'filter_values.*' => ['nullable', 'integer', 'exists:filter_values,id'],
            'images'            => ['nullable', 'array'],
            'images.*'          => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'existing_images'   => ['nullable', 'array'],
            'existing_images.*' => ['integer'],
            'image_sort'        => ['nullable', 'array'],
            'image_sort.*'      => ['integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'Tên sản phẩm là bắt buộc.',
            'name.max'            => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'price.required'      => 'Giá sản phẩm là bắt buộc.',
            'price.min'           => 'Giá sản phẩm không được nhỏ hơn 0.',
            'categories.required' => 'Phải chọn ít nhất 1 danh mục.',
            'categories.min'      => 'Phải chọn ít nhất 1 danh mục.',
            'images.*.image'      => 'File tải lên phải là ảnh.',
            'images.*.max'        => 'Kích thước ảnh không được vượt quá 5MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Convert formatted price "15.000.000" -> "15000000"
        if ($this->has('price')) {
            $this->merge([
                'price' => str_replace(['.', ','], ['', '.'], $this->input('price')),
            ]);
        }
    }
}
