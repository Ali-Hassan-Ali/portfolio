<?php

namespace App\Http\Requests\Dashboard\Admin\Settings\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('status-menus');
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:menus,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id' => trans('admin.global.item'),
        ];
    }
}
