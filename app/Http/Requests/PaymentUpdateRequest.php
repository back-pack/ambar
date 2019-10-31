<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentUpdateRequest extends FormRequest
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
            'client_id' => ['required', 'exists:clients,id'],
            'order_id' => ['required', 'exists:orders,id'],
            'amount' => ['required', 'min:1']
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $order = \App\Order::findOrFail($this->order_id);

            $payment = request()->route('payment');

            if ($this->amount > $order->debt + $payment->amount) {
                $validator->errors()->add('amount', "El monto excede a la deuda del pedido.");
            }
        });
    }
}
