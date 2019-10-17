@extends('layouts.master')

@section('title')
    <title>Crear categoría</title>
@endsection

@section('content')

    <h2>Crear categoría</h2>
    <hr>

    <form method="post" action="{{ route('categories.store') }}">
      @csrf

      @input([
        'name' => 'name',
        'label' => 'Nombre',
        'attributes' => ['type' => 'text']
      ])

      @input([
        'name' => 'description',
        'label' => 'Descripción',
        'attributes' => ['type' => 'text']
      ])

      <button type="submit" class="btn btn-primary">Crear</button>
    </form>

@endsection
