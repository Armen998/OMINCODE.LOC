<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminRegistrationFormRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:20', 'string'],
            'age' => ['required', 'integer', 'min:0'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:190', 'confirmed'],
            'password_confirm' => ['required|same:password', 'min:6', 'mix:190'],
            'type' => ['required', Rule::in(['admin', 'regular']) ]
        ];
    }
}
