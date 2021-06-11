<?php

namespace App\Http\Requests\Api\Users;

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
            'name'     => 'required',
            'password' => 'required|confirmed',
            'email'    => [
                'required',
                Rule::unique('users')->ignore($this->user->id),
            ],
        ];
    }
}
