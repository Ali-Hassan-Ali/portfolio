<?php

namespace App\Http\Requests\Dashboard\Admin\Settings\General;

use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'array'],
            'name.*'      => ['required', 'string', 'max:255'],
            'about'       => ['nullable', 'array'],
            'about.*'     => ['nullable', 'string'],
            'phone'           => ['nullable', 'string', 'max:50'],
            'email'           => ['nullable', 'email', 'max:255'],
            'copyright'       => ['nullable', 'array'],
            'copyright.*'     => ['nullable', 'string', 'max:500'],
            'status'      => ['nullable', 'boolean'],
        ];
    }
}
