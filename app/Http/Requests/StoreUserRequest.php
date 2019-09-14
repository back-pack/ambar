<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user],
            'phone' => ['string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'required_with:password_confirm', 'same:password_confirm'],
            'password_confirm' => ['required', 'string', 'min:8'],
        ];
    }
}