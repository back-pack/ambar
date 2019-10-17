@extends('layouts.master')

@section('title')
    <title>Pagos</title>
@endsection

@section('content')


    <div class="col-sm">
      <p class='h2'>Pagos |
          <a href="{{ route('payments.create') }}"><button class="btn btn-sm btn-outline-success" type="button"><i class="fas fa-plus-square"></i></button></a>
      </p>
      <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Cliente</th>
            <th scope="col">Nro. de pedido</th>
            <th scope="col">Monto</th>
            <th class="config" scope="col"><i class="fas fa-tools config"></i></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($payments as $payment)
            <tr>
              <td scope="row">{{ $payment->id }}</td>
              <td>{{ $payment->client->name }}</td>
              <td>{{ $payment->order->id }}</td>
              <td>{{ $payment->amount }}</td>
              <td class='config'><a href="{{ route('payments.edit', ['id' => $payment->id]) }}"><button type="button" class="btn btn-sm btn-outline-warning config"><i class="fas fa-wrench"></i></button></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $payments->links() }}
    </div>


@endsection
