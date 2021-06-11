<?php

namespace App\Http\Requests\Api\Address;

// Required Libraries
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'post_code'         => 'required|max:8|min:8|unique:addresses,post_code',
            'route'             => 'required',
            'neighborhood'      => 'required',
            'city'              => 'required',
            'state'             => 'required|max:2|max:2',
        ];
    }
}
