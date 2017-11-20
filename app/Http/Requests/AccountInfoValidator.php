<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountInfoValidator extends FormRequest
{
    /**
     * Redirect route when errors occur.
     *  
     * @var string
     */
    protected $redirectRoute = 'account.settings.info';

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
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ];
    }

    /**
     * Get the URL to redirect to on a validation error.
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlGenerator()->route(
            $this->redirectRoute, ['type' => 'info']
        );
    }
}
