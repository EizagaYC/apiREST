<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'    => 'required',
            'email'   => 'required|unique:users,email',
            'age'     => 'required',
            'birtday' => 'required',
            'sex'     => 'required',
            'address' => 'required',
            'country' => 'required',
            'phone'   => 'required|max:11|',
            'dni'     => 'required|unique:users,dni|max:8|',
            'password'=> 'required'
        ];
    }
}
