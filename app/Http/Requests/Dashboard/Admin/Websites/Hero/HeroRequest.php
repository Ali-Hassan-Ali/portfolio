<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Hero;

use Illuminate\Foundation\Http\FormRequest;

class HeroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status'                         => ['nullable', 'boolean'],
            'badge'                          => ['nullable', 'array'],
            'badge.*'                        => ['nullable', 'string', 'max:255'],
            'title'                          => ['required', 'array'],
            'title.*'                        => ['required', 'string', 'max:255'],
            'sub_title'                      => ['required', 'array'],
            'sub_title.*'                    => ['required', 'string', 'max:255'],
            'features'                       => ['required', 'array', 'size:3'],
            'features.*.icon'                => ['required', 'string', 'max:100'],
            'features.*.title'               => ['required', 'array'],
            'features.*.title.*'             => ['required', 'string', 'max:255'],
            'features.*.description'         => ['required', 'array'],
            'features.*.description.*'       => ['required', 'string'],
        ];
    }
}
