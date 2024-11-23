<?php

namespace Joton\PreOrder\Http\Requests;

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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => $this->isMethod('post')
                ? 'required|email|unique:users,email'
                : 'required|email|unique:users,email,' .  $this->user,
            'password' => $this->isMethod('post')
                ? 'required|string|min:6|confirmed'
                : 'nullable|string|min:6|confirmed',
        ];
    }
}
