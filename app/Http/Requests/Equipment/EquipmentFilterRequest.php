<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>"string",
            'price_start'=>'integer|min:1',
            "price_end"=>'integer|min:1',
            'categories'=>'array',
            'categories.*'=>'integer|min:1',
            'size'=>'integer|min:1'
        ];
    }
}
