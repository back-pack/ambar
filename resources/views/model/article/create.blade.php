@extends('layouts.master')

@section('title')
    <title>Crear articulo</title>
@endsection

@section('content')

    <form method="post" action="{{ route('articles.store') }}">
      @csrf

      @input([
        'name' => 'name',
        'label' => 'Nombre',
        'attributes' => ['type' => 'text']
      ])

      @input([
        'name' => 'price',
        'label' => 'Precio',
        'attributes' => ['type' => 'number', 'step' => 'any']
      ])

      @input([
        'name' => 'description',
        'label' => 'Descripción',
        'attributes' => ['type' => 'text']
      ])

      <button type="submit" class="btn btn-primary">Crear</button>
    </form>

@endsection
