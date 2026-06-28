<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'icon' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
            'icon.max' => 'Mã icon không được vượt quá 255 ký tự.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'description' => $this->normalizeNullable($this->input('description')),
            'parent_id' => $this->normalizeNullable($this->input('parent_id')),
            'icon' => $this->normalizeNullable($this->input('icon')),
        ]);
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            /** @var Category|null $category */
            $category = $this->route('category');
            $parentId = $this->input('parent_id');

            if (!$parentId) {
                return;
            }

            $parent = Category::find($parentId);
            if (!$parent) {
                return;
            }

            if ($category && (int) $category->id === (int) $parent->id) {
                $validator->errors()->add('parent_id', 'Danh mục cha không được trùng với chính nó.');
                return;
            }

            $service = app(CategoryService::class);

            if ($category && $service->isDescendantOf($parent, $category)) {
                $validator->errors()->add('parent_id', 'Không thể chọn danh mục con làm danh mục cha.');
                return;
            }

            if ($service->resolveLevel($parent) >= 3) {
                $validator->errors()->add('parent_id', 'Danh mục chỉ hỗ trợ tối đa 3 cấp.');
            }
        });
    }

    private function normalizeNullable(mixed $value): mixed
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}