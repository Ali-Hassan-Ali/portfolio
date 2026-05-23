<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\WhyUs;

use Illuminate\Foundation\Http\FormRequest;

class WhyUsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'                        => ['required', 'array'],
            'title.*'                      => ['required', 'string', 'max:255'],
            'description'                  => ['required', 'array'],
            'description.*'                => ['required', 'string'],
            'pillars'                      => ['nullable', 'array', 'size:2'],
            'pillars.*.title'              => ['nullable', 'array'],
            'pillars.*.title.*'            => ['nullable', 'string', 'max:255'],
            'pillars.*.description'        => ['nullable', 'array'],
            'pillars.*.description.*'      => ['nullable', 'string'],
            'features'                     => ['nullable', 'array', 'size:2'],
            'features.*.title'             => ['nullable', 'array'],
            'features.*.title.*'           => ['nullable', 'string', 'max:255'],
            'features.*.description'       => ['nullable', 'array'],
            'features.*.description.*'     => ['nullable', 'string'],
            'status'                       => ['nullable', 'boolean'],
        ];
    }
}
