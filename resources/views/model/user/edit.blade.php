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

      @input([
        'name' => 'is_admin',
        'label' => '¿Es admin?',
        'attributes' => ['type' => 'checkbox'],
        'value' => $user->is_admin
      ])

      @input([
        'name' => 'is_active',
        'label' => '¿Activo?',
        'attributes' => ['type' => 'checkbox'],
        'value' => $user->is_active
      ])
      
      @input([
        'name' => 'password',
        'label' => 'Contraseña',
        'attributes' => ['type' => 'password'],
        'value' => $user->password
      ])

      @input([
        'name' => 'password_confirm',
        'label' => 'Confirmar contraseña',
        'attributes' => ['type' => 'password'],
        'value' => $user->password
      ])

      <button type="submit" class="btn btn-primary">Editar</button>
    </form>

@endsection
