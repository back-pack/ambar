<?php

namespace App\Repositories;

use App\Payment;
use App\Http\Requests\PaymentStoreRequest;
use App\Http\Requests\PaymentUpdateRequest;

class PaymentRepository
{
    public function all()
    {
        return Payment::paginate(config('pagination.model.payment'));
    }

    public function create(PaymentStoreRequest $request): Payment
    {
        $attributes = $request->validated();

        return Payment::create($attributes);
    }

    public function update(PaymentUpdateRequest $request, Payment $payment): Payment
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
