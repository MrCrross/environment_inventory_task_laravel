<?php

namespace App\Http\Requests\Arrival;

use Illuminate\Foundation\Http\FormRequest;

class ArrivalCreateRequest extends FormRequest
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
            'arrival'=>'required|array',
            'arrival.*'=>'required|array',
            'arrival.*.equipment_id'=>'required|integer',
            'arrival.*.count'=>'required|integer',
            'arrival.*.arrival'=>'required|date',
        ];
    }
}
