<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketValidator extends FormRequest
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
        return [
            "subject"       => 'required|max:255',
            "category_id"   => 'required|numeric', 
            "assignee_id"   => 'required|numeric', 
            "priority_id"   => 'required|numeric',
            "description"   => 'required'
        ];
    }
}
