@extends('layouts.master')

@section('title')
    <title>Clientes</title>
@endsection

@section('content')

    <div class="col-sm">
      <p class='h2'>Clientes | <a href="{{ route('clients.create') }}" ><button class="btn btn-sm btn-outline-success" type="button"><i class="fas fa-plus-square"></i></button></a> <button onclick="alert('Imprime lista')" class="btn btn-sm btn-outline-secondary" type="button"><i class="fas fa-print"></i></button> <button onclick="hide()" class="btn btn-sm btn-outline-primary" type="button"><i class="fas fa-tools"></i></button></p>
      <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Correo electrónico</th>
            <th scope="col">Margen</th>
            <th class="config" scope="col"><i class="fas fa-tools config"></i></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($clients as $client)
            <tr>
              <td scope="row">{{ $client->name }}</td>
              <td>{{ $client->email }}</td>
              <td>{{ $client->margin->name }}</td>
              <td class='config'><a href="{{ route('clients.edit', ['id' => $client->id]) }}"><button type="button" class="btn btn-sm btn-outline-warning config"><i class="fas fa-wrench"></i></button></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

@endsection
