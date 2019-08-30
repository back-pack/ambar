@extends('layouts.master')

@section('title')
    <title>Articulos</title>
@endsection

@section('content')

    <table class="table table-hover table-responsive-sm">
      <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Ultima actualización</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($articles as $article)
          <tr>
            <td>{{ $article->id }}</td>
            <td>{{ $article->name }}</td>
            <td>{{ $article->description }}</td>
            <td>{{ $article->price_formated }}</td>
            <td>{{ $article->price_last_update->format('d/m/Y') }}</td>
            <td><a href="{{ route('articles.edit', ['id' => $article->id]) }}">Editar</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>

@endsection
