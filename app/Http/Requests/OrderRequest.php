<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'delivery' => ['nullable', 'date'],
            'articles' => ['required', 'array', 'filled'],
            'articles.*.article.id' => ['required', 'integer', 'exists:articles,id'],
            'articles.*.quantity' => ['required', 'numeric', 'min:1'],
            'articles.*.discount' => ['required', 'numeric', 'min:0'],
            'detail' => ['nullable', 'string'],
            'total' => ['required', 'numeric'],
            'weight' => ['required', 'numeric']
        ];
    }
}