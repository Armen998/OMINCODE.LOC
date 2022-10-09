<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'current_password' => ['required', 'string', 'min:6', 'max:190',],
            'new_password' => ['required', 'string', 'min:6', 'max:190', ],
            'confirm_new_password' => ['required', 'string', 'min:6', 'max:190',],
        ];
    }
}
