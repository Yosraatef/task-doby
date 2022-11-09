<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username'       => ['required', 'string', 'max:100'],
            'password'       => ['required', 'confirmed'],
            'email'          => ['required', 'string', 'email:dns', 'unique:users,email'],
            'type'           => ['required','string'],
            'file'           => ['nullable', 'string', 'max:200', 'required_if:type,type2'],
            'bio'            => ['required', 'string', 'max:200'],
            'info'           => ['array'],
            'info.birthday'  => ['date', 'date_format:d-m-Y', 'required_if:type,type3'],
            'info.latitude'  => ['numeric', 'required', 'required_if:type,type3'],
            'info.longitude' => ['numeric', 'required', 'required_if:type,type3'],
        ];
    }
}
