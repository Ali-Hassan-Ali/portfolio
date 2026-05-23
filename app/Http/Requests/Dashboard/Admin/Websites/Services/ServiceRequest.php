<?php

namespace App\Http\Requests\Dashboard\Admin\Websites\Services;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return in_array(request()->method(), ['PUT', 'PATCH']) ? permissionAdmin('update-services') : permissionAdmin('create-services');

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            'icon'     => ['required','string','min:2','max:150'],
            'status'   => ['boolean'],
            'admin_id' => ['nullable','exists:admins,id'],
        ];

        if (in_array(request()->method(), ['PUT', 'PATCH'])) {

            $service = request()->route()->parameter('service');

            foreach(getLanguages() as $index=>$language) {

                $rules['name.' . $language->code]         = ['required','string','min:2','max:150', UniqueTranslationRule::for('services', 'name')->ignore($service?->id)];
                $rules['description.' . $language->code]  = ['nullable','string', UniqueTranslationRule::for('services', 'description')->ignore($service?->id)];
            }

        } else {

            foreach(getLanguages() as $index=>$language) {

                $rules['name.' . $language->code]         = ['required','string','min:2','max:150'];
                $rules['description.' . $language->code]  = ['nullable','string'];
            }

        } //end of if

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        $rules = [
            'icon' => trans('admin.global.icon'),
        ];

        foreach(getLanguages() as $language) {

            $rules['name.' . $language->code] 	     = trans('admin.global.by', ['name' => trans('admin.global.name'), 'lang' => $language->name]);
            $rules['description.' . $language->code] = trans('admin.global.by', ['name' => trans('admin.global.description'), 'lang' => $language->name]);
        }

        return $rules;

    }//end of attributes

    protected function prepareForValidation()
    {
        return $this->merge([
            'admin_id' => auth('admin')->id(),
            'status'   => request()->has('status'),
        ]);

    }//end of prepare for validation

}//end of class