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
        'attributes' => ['type' => 'text']
      ])

      @input([
        'name' => 'email',
        'label' => 'Email',
        'attributes' => ['type' => 'email']
      ])

      @input([
        'name' => 'phone',
        'label' => 'Teléfono',
        'attributes' => ['type' => 'text']
      ])
      
      @input([
        'name' => 'password',
        'label' => 'Contraseña',
        'attributes' => ['type' => 'password']
      ])

      <button type="submit" class="btn btn-primary">Editar</button>
    </form>

@endsection
