<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * TODO: Implement docblock
 */
class PriorityValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|unique:categories,name|max:50', 
            'color_code'    => 'required|max:7',
            'description'   => 'required' 
        ];
    }
}
