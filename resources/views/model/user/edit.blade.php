@extends('layouts.master')

@section('title')
    <title>Editar usuario</title>
@endsection

@section('content')

    <form method="post" action="{{ route('users.update', ['id' => $user->id]) }}">
      @csrf
      @method('patch')

      @input([
        'name' => 'name',
        'label' => 'Nombre',
        'attributes' => ['type' => 'text'],
        'value' => $user->name
      ])

      @input([
        'name' => 'email',
        'label' => 'Correo electrónico',
        'attributes' => ['type' => 'email', 'readonly' => 'true'],
        'value' => $user->email
      ])

      @input([
        'name' => 'phone',
        'label' => 'Teléfono',
        'attributes' => ['type' => 'text'],
        'value' => $user->phone
      ])

      @if ($user->is_admin)
        @input([
          'name' => 'is_admin',
          'label' => '¿Es admin?',
          'attributes' => ['type' => 'checkbox', 'checked' => 'checked'],
          'value' => 0
        ])
      @else
        @input([
          'name' => 'is_admin',
          'label' => '¿Es admin?',
          'attributes' => ['type' => 'checkbox'],
          'value' => $user->is_admin
        ])
      @endif
      @if ($user->is_active)
        @input([
          'name' => 'is_active',
          'label' => '¿Activo?',
          'attributes' => ['type' => 'checkbox', 'checked' => 'checked'],
          'value' => '1'
        ])
      @else
        @input([
          'name' => 'is_active',
          'label' => '¿Activo?',
          'attributes' => ['type' => 'checkbox'],
          'value' => '0'
        ])
      @endif
      
      @input([
        'name' => 'password',
        'label' => 'Contraseña',
        'attributes' => ['type' => 'password', 'readonly' => 'true'],
        'value' => '********'
      ])

      @input([
        'name' => 'password_confirm',
        'label' => 'Confirmar contraseña',
        'attributes' => ['type' => 'password', 'readonly' => 'true'],
        'value' => '********'
      ])

      <button type="submit" class="btn btn-primary">Editar</button>
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy_user_modal">Eliminar</button>
    </form>

    <hr>

    @component('components.modal', ['id' => 'destroy_user_modal', 'title' => 'Eliminar usuario'])
        ¿Desea eliminar el usuario {{ $user->name }}?
        @slot('footer')
          <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <form method="post" action="{{ route('users.destroy', ['id' => $user->id]) }}">
            @csrf
            @method('delete')

            <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
          </form>
        @endslot
    @endcomponent

@endsection
