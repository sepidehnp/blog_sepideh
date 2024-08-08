<?php

namespace Spd\User\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;


class UserRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() === true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     *
     */
    public function rules()
    {
        return [
            //
            'name'      => 'required|string|min:3|max:190',
            'email'     => 'required|email|min:3|max:190|unique:users,email',
            'password'  => 'required|string|min:6|max:190',
        ];
    }
}
