<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Repositories\PaymentRepository;
use App\Http\Requests\PaymentStoreRequest;
use App\Http\Requests\PaymentUpdateRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(PaymentRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = $this->repository->all();
        return view('model.payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = \App\Client::all()->map->toSelectOption();
        return view('model.payment.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentStoreRequest $request)
    {
        $attributes = $request->validated();

        $payment_amount = $attributes['amount'];

        $client = \App\Client::findOrFail($attributes['client_id']);

        $orders_with_debt = $client->orders->filter->has_debt;

        $orders_with_debt->each(function ($order_with_debt) use ($payment_amount, $attributes) {
            if ($payment_amount == 0) {
                return false;
            }

            if ($payment_amount <= $order_with_debt->debt) {
                $amount = $payment_amount;
            }
            else {
                $amount = $order_with_debt->debt;
            }

            \App\Payment::create([
                'client_id' => $attributes['client_id'],
                'order_id' => $order_with_debt->id,
                'amount' => $amount
            ]);

            $payment_amount -= $amount;
        });

        // $i = 0;
        //
        // while ($payment_amount != 0) {
        //     $order = $orders_with_debt[$i];
        //
        //     if ($payment_amount <= $order->debt) {
        //         $amount = $payment_amount;
        //     }
        //     else {
        //         $amount = $order->debt;
        //     }
        //
        //     \App\Payment::create([
        //         'client_id' => $attributes['client_id'],
        //         'order_id' => $order->id,
        //         'amount' => $amount
        //     ]);
        //
        //     $payment_amount -= $amount;
        //     $i++;
        // }

        return $client;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('model.payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentUpdateRequest $request, Payment $payment)
    {
        $payment = $this->repository->update($request, $payment);

        return $payment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $this->repository->delete($payment);
        return redirect(route('payments.index'));
    }
}
