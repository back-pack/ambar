@extends('layouts.master')

@section('title')
    <title>Articulos</title>
@endsection

@section('content')

    <h2>Artículos</h2>
    <hr>

    <div class="table-responsive">
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Peso</th>
            <th>Costo</th>
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
              <td>{{ $article->weight }}kg</td>
              <td>{{ $article->cost_formated }}</td>
              <td>{{ $article->cost_last_update->format('d/m/Y') }}</td>
              <td><a href="{{ route('articles.edit', ['id' => $article->id]) }}">Editar</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

@endsection
