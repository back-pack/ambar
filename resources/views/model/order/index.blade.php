@extends('layouts.master')

@section('title')
    <title>Pedidos</title>
@endsection

@section('content')


    <div class="col-sm">
      <p class='h2'>Pedidos |
          <a href="{{ route('orders.create') }}" ><button class="btn btn-sm btn-outline-success" type="button"><i class="fas fa-plus-square"></i></button></a>
          <button onclick="window.print()" class="btn btn-sm btn-outline-secondary" type="button"><i class="fas fa-print"></i></button>
          <button onclick="hide()" class="btn btn-sm btn-outline-primary" type="button"><i class="fas fa-tools"></i></button>
          <button onclick="hideProfit()" class="btn btn-sm btn-outline-primary" type="button"><i class="fas fa-money-bill-wave"></i></button>
      </p>
        <form method="get" action="{{ route('orders.index') }}" class="form-inline d-print-none">
            @select([
                'name' => 'delivery',
                'label' => 'Entrega',
                'options' => [['', 'Todos'], [0, 'Inmediata'], [1, 'Calle']],
                'value' => request()->query('delivery'),
                'classes' => ['label' => 'mb-2 mr-2', 'select' => 'mb-2 mr-2']
            ])
            @input([
                'name' => 'created_at',
                'label' => 'Fecha',
                'attributes' => ['type' => 'date'],
                'value' => request()->query('created_at'),
                'classes' => ['label' => 'mb-2 mr-2', 'input' => 'mb-2 mr-2']
            ])
            <button type="submit" class="btn btn-primary mb-2">Filtrar</button>
        </form>
      <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Fecha</th>
            <th scope="col">Cliente</th>
            <th scope="col">Entrega</th>
            <th scope="col">Artículos</th>
            <th scope="col">Total</th>
            <th scope="col">Pagado</th>
            @if (auth()->user()->is_admin)
                <th class="profit collapse" scope="col">Ganancia</th>
            @endif
            <th class="config" scope="col"><i class="fas fa-tools config"></i></th>
          </tr>
        </thead>
        <tfoot class="thead-light">
            <th colspan="5"></th>
            <th>{{ number_readable($orders->sum('total'), "$") }}</th>
            <th class="config" colspan="1"></th>
            @if (auth()->user()->is_admin)
                <th class="profit collapse">{{ number_readable($orders->sum('profit'), "$") }}</th>
            @endif
            <th colspan="1"></th>
        </tfoot>
        <tbody>
          @foreach ($orders as $order)
            <tr>
              <td scope="row">{{ $order->id }}</td>
              <td>{{ $order->created_at->format('d-m-Y') }}</td>
              <td>{{ $order->client->name }}</td>
              <td>{{ $order->delivery_formatted }}</td>
              <td>{{ $order->articles()->count() }}</td>
              <td>{{ number_readable($order->total, "$") }}</td>
              <td>{{ number_readable($order->payments->sum('amount'), "$") }}</td>
              @if (auth()->user()->is_admin)
                  <td class="profit collapse">{{ number_readable($order->profit, "$") }}</td>
              @endif
              <td class='config'><a href="{{ route('orders.edit', ['id' => $order->id]) }}"><button type="button" class="btn btn-sm btn-outline-warning config"><i class="fas fa-wrench"></i></button></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

    @if (auth()->user()->is_admin)
        <h4 class="profit collapse">Ganancia total: <b>{{ number_readable($total_profit, "$") }}</b></h4>
    @endif

      {{ $orders->appends(request()->input())->links() }}
    </div>


@endsection
