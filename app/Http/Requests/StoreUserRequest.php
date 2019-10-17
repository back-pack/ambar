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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['string', 'min:8'],
            'is_active' => ['required', 'boolean'],
            'is_admin' => ['required', 'boolean'],
            'password' => ['required', 'string', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%.]).*$/'],
            'password_confirm' => ['required', 'string', 'min:8', 'required_with:password', 'same:password']
        ];
    }
}
