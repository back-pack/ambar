<?php

namespace App\Repositories;

use App\Payment;
use App\Http\Requests\PaymentRequest;

class PaymentRepository
{
    public function all()
    {
        return Payment::paginate(config('pagination.model.payment'));
    }

    public function create(PaymentRequest $request): Payment
    {
        $attributes = $request->validated();

        return Payment::create($attributes);
    }

    public function update(PaymentRequest $request, Payment $payment): Payment
    {
        $attributes = $request->validated();

        $payment->update($attributes);

        return $payment;
    }

    public function delete(Payment $payment): void
    {
        $payment->delete();
    }
}
