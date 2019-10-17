@extends('layouts.master')

@section('title')
    <title>Editar pago</title>
@endsection

@section('content')

    <h2>Editar pago</h2>
    <hr>

    <edit-payment payment_id="{{ $payment->id }}"></edit-payment>

    <hr>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy_payment_modal">Eliminar</button>

    @component('components.modal', ['id' => 'destroy_payment_modal', 'title' => 'Eliminar pago'])
        ¿Desea eliminar el pago?
        @slot('footer')
          <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <form method="post" action="{{ route('payments.destroy', ['id' => $payment->id]) }}">
            @csrf
            @method('delete')

            <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
          </form>
        @endslot
    @endcomponent

@endsection
