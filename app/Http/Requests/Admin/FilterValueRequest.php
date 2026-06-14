<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilterValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filter_group_id' => ['required', 'integer', 'exists:filter_groups,id'],
            'value'           => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'filter_group_id.required' => 'Phải chọn nhóm filter.',
            'filter_group_id.exists'   => 'Nhóm filter không hợp lệ.',
            'value.required'           => 'Giá trị filter là bắt buộc.',
            'value.max'                => 'Giá trị filter không được vượt quá 255 ký tự.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'value' => trim((string) $this->input('value')),
        ]);
    }
}
