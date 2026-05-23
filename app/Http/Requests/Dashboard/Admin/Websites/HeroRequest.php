<?php

namespace App\Http\Requests\Dashboard\Admin\Websites;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class HeroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return permissionAdmin('create-websites');

    }//end of authorize

    public function rules(): array
    {
        $rules = [
            //'icon'     => ['required','string','min:2','max:150'],
            'status'   => ['boolean'],
        ];

        foreach(getLanguages() as $language) {

            $rules['title.' . $language->code]     = ['required','string','min:2'];
            $rules['sub_title.' . $language->code] = ['required','string','min:2'];
        }

        return $rules;

    }//end of rules

    public function attributes(): array
    {
        $rules = [];

        $rules['logo'] = trans('admin.global.logo');

        foreach(getLanguages() as $language) {

            $rules['title.' . $language->code]       = trans('admin.global.by', ['name' => trans('admin.global.title'), 'lang' => $language->name]);
            $rules['sub_title.' . $language->code] = trans('admin.global.by', ['name' => trans('admin.global.sub_title'), 'lang' => $language->name]);
        }

        return $rules;

    }//end of attributes

    protected function prepareForValidation()
    {
        return $this->merge([
            'status' => request()->boolean('status'),
        ]);

    }//end of prepare for validation

}//end of class