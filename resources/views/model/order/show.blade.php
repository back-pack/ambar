@extends('layouts.master')

@section('title')
    <title>Pedido #{{ $order->id }}</title>
@endsection

@section('content')

    <h3>Pedido Nro {{ $order->id }}</h3>
    <hr>
    <p>Cliente: {{ $order->client->name }}</p>
    <p>Entrega: {{ $order->deliveryFormatted }}</p>

    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Descuento</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tfoot class="thead-light">
            <tr>
                <th colspan="3"></th>
                <th>Total</th>
                <th>{{ number_readable($order->total, "$") }}</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($order->articles as $article)
                <tr @if ($article->is_below_cost) class="table-warning" @endif>
                    <td>{{ $article->name }}</td>
                    <td>{{ number_readable($article->price, "$") }}</td>
                    <td>{{ $article->quantity }}</td>
                    <td>{{ number_readable($article->discount, null, "%", true) }}</td>
                    <td>{{ number_readable($article->subtotal, "$") }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>{{ $order->detail }}</p>

    <p>Peso total: {{ number_readable($order->weight, null, "kg") }}</p>

@endsection

@push('js')
    <script>
        window.print();
    </script>
@endpush
