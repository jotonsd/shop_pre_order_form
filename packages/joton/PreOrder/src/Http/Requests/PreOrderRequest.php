<?php

namespace Joton\PreOrder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreOrderRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'phone' => 'nullable|numeric|min:0',
            'details' => 'required|array',
            'details.*.pre_order_details_id' => 'sometimes|exists:pre_order_details,id',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.quantity' => 'required|numeric|min:0'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled('email') && str_ends_with($this->email, '@xyz.com') && !$this->filled('phone')) {
                $validator->errors()->add(
                    'phone',
                    'The phone number is required when the email has a @xyz.com extension.'
                );
            }
        });
    }
}
