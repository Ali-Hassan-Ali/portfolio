<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Cta;

use Illuminate\Foundation\Http\FormRequest;

class CtaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'           => ['required', 'array'],
            'title.*'         => ['required', 'string', 'max:255'],
            'description'     => ['required', 'array'],
            'description.*'   => ['required', 'string'],
            'btn_primary'     => ['nullable', 'array'],
            'btn_primary.*'   => ['nullable', 'string', 'max:255'],
            'btn_secondary'   => ['nullable', 'array'],
            'btn_secondary.*' => ['nullable', 'string', 'max:255'],
            'status'          => ['nullable', 'boolean'],
        ];
    }
}
