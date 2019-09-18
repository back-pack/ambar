@extends('layouts.master')

@section('title')
    <title>Usuarios</title>
@endsection

@section('content')
    <br />
    @include('flash-message')
    <div class="col-sm">
      <p class='h2'>Usuarios | <a href="{{ route('users.create') }}" ><button class="btn btn-sm btn-outline-success" type="button"><i class="fas fa-plus-square"></i></button></a> <button onclick="window.print()" class="btn btn-sm btn-outline-secondary" type="button"><i class="fas fa-print"></i></button> <button onclick="hide()" class="btn btn-sm btn-outline-primary" type="button"><i class="fas fa-tools"></i></button></p>
      <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">E-mail</th>
            <th scope="col">Teléfono</th>
            <th scope="col">¿Es administrador?</th>
            <th scope="col">¿Está activo?</th>
            <th class="config" scope="col"><i class="fas fa-tools config"></i></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->phone }}</td>
              <td>{{ $user->is_admin ? 'Si' : 'No' }}</td>
              <td>{{ $user->is_active ? 'Si' : 'No' }}</td>
              <td class='config'><a href="{{ route('users.edit', ['id' => $user->id]) }}"><button type="button" class="btn btn-sm btn-outline-success config"><i class="fas fa-wrench"></i></button></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

@endsection
