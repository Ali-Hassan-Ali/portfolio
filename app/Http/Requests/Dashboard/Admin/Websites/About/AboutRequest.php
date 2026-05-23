<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\About;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image'                        => ['nullable', 'image', 'max:2048'],
            'badge'                        => ['nullable', 'array'],
            'badge.*'                      => ['nullable', 'string', 'max:255'],
            'title'                        => ['required', 'array'],
            'title.*'                      => ['required', 'string', 'max:255'],
            'description'                  => ['required', 'array'],
            'description.*'                => ['required', 'string'],
            'stat_number'                  => ['nullable', 'string', 'max:50'],
            'stat_label'                   => ['nullable', 'array'],
            'stat_label.*'                 => ['nullable', 'string', 'max:255'],
            'learn_more'                   => ['nullable', 'array'],
            'learn_more.*'                 => ['nullable', 'string', 'max:255'],
            'highlights'                   => ['nullable', 'array', 'size:2'],
            'highlights.*.title'           => ['nullable', 'array'],
            'highlights.*.title.*'         => ['nullable', 'string', 'max:255'],
            'highlights.*.description'     => ['nullable', 'array'],
            'highlights.*.description.*'   => ['nullable', 'string'],
            'status'                       => ['nullable', 'boolean'],
        ];
    }
}
