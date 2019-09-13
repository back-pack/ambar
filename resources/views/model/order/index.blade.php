@extends('layouts.master')

@section('title')
    <title>Pedidos</title>
@endsection

@section('content')


    <div class="col-sm">
      <p class='h2'>Pedidos | <a href="{{ route('orders.create') }}" ><button class="btn btn-sm btn-outline-success" type="button"><i class="fas fa-plus-square"></i></button></a> <button onclick="alert('Imprime lista')" class="btn btn-sm btn-outline-secondary" type="button"><i class="fas fa-print"></i></button> <button onclick="hide()" class="btn btn-sm btn-outline-primary" type="button"><i class="fas fa-tools"></i></button></p>
      <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Cliente</th>
            <th scope="col">Entrega</th>
            <th scope="col">Artículos</th>
            <th scope="col">Total</th>
            <th class="config" scope="col"><i class="fas fa-tools config"></i></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
            <tr>
              <td scope="row">{{ $order->id }}</td>
              <td>{{ $order->client->name }}</td>
              <td>{{ $order->delivery_formatted }}</td>
              <td>{{ $order->articles()->count() }}</td>
              <td>{{ number_readable($order->total, "$") }}</td>
              <td class='config'><a href="{{ route('orders.edit', ['id' => $order->id]) }}"><button type="button" class="btn btn-sm btn-outline-warning config"><i class="fas fa-wrench"></i></button></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>


@endsection
