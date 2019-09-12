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
        'label' => 'Email',
        'attributes' => ['type' => 'email', 'step' => 'any']
      ])

      @input([
        'name' => 'phone',
        'label' => 'Teléfono',
        'attributes' => ['type' => 'text']
      ])
      
      @input([
        'name' => 'password',
        'label' => 'Contraseña',
        'attributes' => ['type' => 'text']
      ])

      <button type="submit" class="btn btn-primary">Crear</button>
    </form>

@endsection
