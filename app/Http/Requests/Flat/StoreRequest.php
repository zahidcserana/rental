<?php

namespace App\Http\Requests\Flat;

use App\Http\Requests\FormRequest;

class StoreRequest extends FormRequest
{
    public static function validationRules()
    {
        return [
            'house_id' => [
                'required',
                'exists:houses,id,deleted_at,NULL'
            ],
            'customer_id' => [
                'sometimes'
            ],
            'name' => [
                'required'
            ],
            'rent' => [
                'required'
            ],
            'status' => [
                'sometimes'
            ],
        ];
    }
}
