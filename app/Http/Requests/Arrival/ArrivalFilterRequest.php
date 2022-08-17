<?php

namespace App\Http\Requests\Arrival;

use Illuminate\Foundation\Http\FormRequest;

class ArrivalFilterRequest extends FormRequest
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
            'size'=>'integer',
            'equipment'=>'array',
            'equipment.*'=>'integer',
            'category'=>'array',
            'category.*'=>'integer',
            'user'=>'array',
            'user.*'=>'integer',
            'arrival_start'=>'date',
            'arrival_end'=>'date',
            'count_start'=>'integer',
            'count_end'=>'integer'
        ];
    }
}
