@extends('layouts.master')

@section('title')
    <title>Usuarios</title>
@endsection

@section('content')


    <div class="col-sm">
      <p class='h2'>Usuarios | <a href="{{ route('users.create') }}" ><button class="btn btn-sm btn-outline-success" type="button"><i class="fas fa-plus-square"></i></button></a> <button onclick="alert('Imprime lista')" class="btn btn-sm btn-outline-secondary" type="button"><i class="fas fa-print"></i></button> <button onclick="hide()" class="btn btn-sm btn-outline-primary" type="button"><i class="fas fa-tools"></i></button></p>
      <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">E-mail</th>
            <th scope="col">Teléfono</th>
            <th class="config" scope="col"><i class="fas fa-tools config"></i></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td scope="row">{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->phone }}</td>
              <td class='config'><a href="{{ route('users.edit', ['id' => $user->id]) }}"><button type="button" class="btn btn-sm btn-outline-warning config"><i class="fas fa-wrench"></i></button></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>


@endsection
