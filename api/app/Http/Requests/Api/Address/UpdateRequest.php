<?php

namespace App\Http\Requests\Api\Address;

// Required Libraries
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'route'             => 'required',
            'neighborhood'      => 'required',
            'city'              => 'required',
            'state'             => 'required|max:2|max:2',
            'post_code'         => [
                'required',
                'max:8',
                'min:8',
                Rule::unique('addresses')->ignore($this->address->id),
            ]
        ];
    }
}
