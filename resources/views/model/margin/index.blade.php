@extends('layouts.master')

@section('title')
    <title>Margenes</title>
@endsection

@section('content')
    <div class="col-sm">
      <p class='h2'>Margenes | <a href="{{ route('margins.create') }}" ><button class="btn btn-sm btn-outline-success" type="button"><i class="fas fa-plus-square"></i></button></a> <button onclick="window.print()" class="btn btn-sm btn-outline-secondary" type="button"><i class="fas fa-print"></i></button> <button onclick="hide()" class="btn btn-sm btn-outline-primary" type="button"><i class="fas fa-tools"></i></button></p>
      <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Ganancia</th>
            <th class="config" scope="col"><i class="fas fa-tools config"></i></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($margins as $margin)
            <tr>
              <td scope="row">{{ $margin->name }}</td>
              <td>{{ number_readable($margin->profit, null, "%", true) }}</td>
              <td class='config'><a href="{{ route('margins.edit', ['id' => $margin->id]) }}"><button type="button" class="btn btn-sm btn-outline-warning config"><i class="fas fa-wrench"></i></button></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $margins->links() }}
    </div>
@endsection
