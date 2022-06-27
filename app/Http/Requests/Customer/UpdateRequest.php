<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\FormRequest;
use App\Rules\UniqueNumberCheck;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    public static function validationRules()
    {
        $rules = StoreRequest::validationRules();

        foreach ($rules['name'] as $key => $rule) {
            if (is_a($rule, UniqueNumberCheck::class)) {
                unset($rules['name'][$key]);
                break;
            }
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'house_id' => Auth::user()->house_id
        ]);
    }
}
