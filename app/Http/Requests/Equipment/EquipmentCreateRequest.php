<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentCreateRequest extends FormRequest
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
            "equipments"=>"required|array",
            "equipments.*"=>"required|array",
            "equipments.*.name"=>"required|string|unique:equipments",
            "equipments.*.price"=>"required|integer|min:1",
            "equipments.*.category_id"=>"required|integer"
        ];
    }
}
