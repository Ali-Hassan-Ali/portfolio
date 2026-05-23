<?php

namespace App\Http\Requests\Dashboard\Admin\Settings\Menu;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('delete-menus');
    }

    public function rules(): array
    {
        return [
            'ids.*' => ['required', 'numeric', 'exists:menus,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'ids.*' => trans('admin.global.items'),
        ];
    }

    protected function prepareForValidation()
    {
        return request()->merge([
            'ids' => json_decode(request()->record_ids),
        ]);
    }
}
