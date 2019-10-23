@extends('layouts.master')

@section('title')
    <title>Pedido #{{ $order->id }}</title>
@endsection

@section('content')

    <img src="/img/articles_list_client_pdf_header.png" style="width: 100%" alt="">

    <h3>Pedido Nro {{ $order->id }}</h3>
    <hr>
    <p>Cliente: {{ $order->client->name }}</p>
    <p>Entrega: {{ $order->deliveryFormatted }}</p>
    <p>Pagado: {{ number_readable($order->payments->sum('amount'), "$") }} de {{ number_readable($order->total, "$") }}</p>
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
                    <td>{{ number_readable($article->touched_price, "$") }}</td>
                    <td>{{ $article->quantity }}</td>
                    <td>{{ number_readable($article->discount, null, "%", true) }}</td>
                    <td>{{ number_readable($article->subtotal, "$") }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>{{ $order->detail }}</p>

    <div class="float-right">
        <p>Deuda anterior: {{ number_readable($order->client->debt + $order->payments->sum('amount'), "$") }}</p>
        <p>Deuda actual: {{ number_readable($order->client->debt, "$") }}</p>
    </div>

    <p>Peso total: {{ number_readable($order->weight, null, "kg") }}</p>

@endsection

@push('js')
    <script>
        window.print();
    </script>
@endpush
