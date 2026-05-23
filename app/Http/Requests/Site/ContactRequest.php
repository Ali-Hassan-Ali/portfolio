<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ContactTypeEnum;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $type = $this->input('type', 'quick');

        $base = [
            'type'  => ['required', 'in:rfq,quick'],
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
        ];

        if ($type === ContactTypeEnum::RFQ->value) {
            return array_merge($base, [
                'company_name'  => ['nullable', 'string', 'max:255'],
                'activity_type' => ['nullable', 'string', 'max:255'],
                'budget_range'  => ['nullable', 'integer', 'min:0', 'max:100'],
                'project_scope' => ['required', 'string'],
            ]);
        }

        return array_merge($base, [
            'message' => ['required', 'string'],
        ]);
    }
}
