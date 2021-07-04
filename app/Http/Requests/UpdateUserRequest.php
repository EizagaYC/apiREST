<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'    => 'required',
            'email'   => 'required|unique:users,email,'.$this->route('user')->id,
            'age'     => 'required',
            'birtday' => 'required',
            'sex'     => 'required',
            'address' => 'required',
            'country' => 'required',
            'phone'   => 'required|max:11|',
            'dni'     => 'required|max:8|unique:users,dni,'.$this->route('user')->id,
            'password'=> 'required'
        ];
    }
}
