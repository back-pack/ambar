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
            <th scope="col">¿Es administrador?</th>
            <th scope="col">¿Está activo?</th>
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
              <td>{{ $user->is_admin ? 'Si' : 'No' }}</td>
              <td>{{ $user->is_active ? 'Si' : 'No' }}</td>
              <td class='config'><a href="{{ route('users.edit', ['id' => $user->id]) }}"><button type="button" class="btn btn-sm btn-outline-success config"><i class="fas fa-wrench"></i></button></a></td>
              <td class='config'><a href="#" data-entity="users" id="{{ $user->id }}" class="trash_delete" ><button type="button" class="btn btn-sm btn-outline-danger config"><i class="fas fa-trash"></i></button></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  <div class="modal" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Eliminar registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea eliminar este registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

@endsection
