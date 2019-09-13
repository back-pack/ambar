@extends('layouts.master')


@section('content')

    <edit-order order_id="{{ $order->id }}"></edit-order>

    <hr>

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
