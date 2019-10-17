@extends('layouts.master')

@section('title')
    <title>Editar pedido</title>
@endsection

@section('content')

    @include('components.message')

    <edit-order order_id="{{ $order->id }}"></edit-order>

    <hr>

    {{-- <div>Total: {{ $order->total }}</div>
    <div>Pagado: {{ $order->payments->sum('amount') }}</div>
    <div>Pagado en su totalidad: {{ $order->is_fully_paid ? 'Si' : 'No' }}</div> --}}

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy_order_modal">Eliminar</button>

    @component('components.modal', ['id' => 'destroy_order_modal', 'title' => 'Eliminar pedido'])
        ¿Desea eliminar el pedido {{ $order->name }}?
        @slot('footer')
          <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <form method="post" action="{{ route('orders.destroy', ['id' => $order->id]) }}">
            @csrf
            @method('delete')

            <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
          </form>
        @endslot
    @endcomponent

@endsection
