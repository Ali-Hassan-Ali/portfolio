<?php

namespace App\Http\Requests\Dashboard\Admin\Settings\Menu;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'array'],
            'name.*'   => ['required', 'string', 'max:255'],
            'link'     => ['required', 'string', 'max:255'],
            'type'     => ['required', 'string', 'in:all,header,footer'],
            'status'    => ['nullable', 'boolean'],
            'parent_id' => ['nullable', 'numeric', 'exists:menus,id'],
            'admin_id'  => ['nullable', 'numeric'],
        ];
    }
}
