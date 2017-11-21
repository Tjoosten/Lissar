<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method())
        {
            case 'POST': {
                return [
                    'name'  => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'roles' => 'required',
                ];
            }

            case 'PATCH': {
                return [
                    'name'  => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
                    'roles' => 'required',
                ];
            }
        } 
    }
}
