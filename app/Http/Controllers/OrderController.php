<?php

namespace App\Http\Controllers;

use App\Order;
use App\Http\Requests\OrderRequest;
use App\Repositories\OrderRepository;
use App\Http\Resources\Order as OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth');
        $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = $this->repository->all()->paginate(config('pagination.model.order'));

        $total_profit = $this->repository->all()->get()->sum('profit');

        return view('model.order.index', compact('orders', 'total_profit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('model.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = $this->repository->create($request);

        return $order->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('model.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order->load('articles.article');
        return view('model.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $this->repository->update($request, $order);

        return $order->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order->is_fully_paid) {
            $this->repository->delete($order);
        }
        else {
            return back()->withMessage('El pedido no se puede eliminar porque no se ha pagado en su totalidad.');
        }

        return redirect(route('orders.index'));
    }

    public function deletes()
    {
        return view('model.order.destroy-several');
    }

    public function destroySeveral(Request $request)
    {
        $validated = $request->validate([
            'from_date' => ['required', 'date'],
            'to_date' => ['required', 'date']
        ]);

        $from = $validated['from_date'];
        $to = $validated['to_date'];

        $orders = Order::whereBetween('created_at', [$from, $to])->get()->filter->is_fully_paid;

        Order::destroy($orders->pluck('id'));

        return redirect(route('orders.index'));
    }
}
