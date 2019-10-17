@extends('layouts.master')

@section('title')
    <title>Crear usuario</title>
@endsection

@section('content')

    <form method="post" action="{{ route('users.store') }}">
      @csrf

      @input([
        'name' => 'name',
        'label' => 'Nombre',
        'attributes' => ['type' => 'text']
      ])

      @input([
        'name' => 'email',
        'label' => 'Correo electrónico',
        'attributes' => ['type' => 'email']
      ])

      @input([
        'name' => 'phone',
        'label' => 'Teléfono',
        'attributes' => ['type' => 'text']
      ])

      @checkbox_boolean([
        'name' => 'is_admin',
        'label' => '¿Es admin?',
        'attributes' => ['type' => 'checkbox']
      ])

      @checkbox_boolean([
        'name' => 'is_active',
        'label' => '¿Activo?',
        'attributes' => ['type' => 'checkbox']
      ])

      @input([
        'name' => 'password',
        'label' => 'Contraseña',
        'attributes' => ['type' => 'password']
      ])

      @input([
        'name' => 'password_confirm',
        'label' => 'Confirmar contraseña',
        'attributes' => ['type' => 'password']
      ])

      <button type="submit" class="btn btn-primary">Crear</button>
    </form>

@endsection
