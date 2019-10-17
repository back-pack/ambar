@extends('layouts.master')

@section('title')
    <title>Eliminar pedidos</title>
@endsection

@section('content')

    <h3>Eliminar pedidos</h3>
    <hr>

    <form method="post" action="{{ route('orders.destroy-several') }}">
        @csrf

        @input([
            'name' => 'from_date',
            'label' => 'Desde',
            'attributes' => ['type' => 'date']
        ])

        @input([
            'name' => 'to_date',
            'label' => 'Hasta',
            'attributes' => ['type' => 'date']
        ])

        <button type="submit" class="btn btn-primary">Eliminar pedidos</button>

    </form>

@endsection
