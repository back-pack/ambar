@extends('layouts.master')

@section('title')
    <title>Editar articulo</title>
@endsection

@section('content')

    <form method="post" action="{{ route('articles.update', ['id' => $article->id]) }}">
      @csrf
      @method('patch')

      @input([
        'name' => 'name',
        'label' => 'Nombre',
        'attributes' => ['type' => 'text'],
        'value' => $article->name
      ])

      @input([
        'name' => 'price',
        'label' => 'Precio',
        'attributes' => ['type' => 'number', 'step' => 'any'],
        'value' => $article->price
      ])

      @input([
        'name' => 'description',
        'label' => 'Descripción',
        'attributes' => ['type' => 'text'],
        'value' => $article->description
      ])

      <button type="submit" class="btn btn-primary">Editar</button>
    </form>

@endsection
