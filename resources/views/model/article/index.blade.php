@extends('layouts.master')

@section('title')
    <title>Articulos</title>
@endsection

@section('content')


    <div class="col-sm">
      <p class='h2'>Articulos |
          <a href="{{ route('articles.create') }}"><button class="btn btn-sm btn-outline-success" type="button"><i class="fas fa-plus-square"></i></button></a>
          <a href="{{ route('articles.pdf') }}"><button class="btn btn-sm btn-outline-secondary" type="button"><i class="fas fa-print"></i></button></a>
          <a href="{{ route('articles.pdf', ['for' => 'client']) }}"><button class="btn btn-sm btn-outline-secondary" type="button"><i class="fas fa-user"></i></button></a>
          <button onclick="hide()" class="btn btn-sm btn-outline-primary" type="button"><i class="fas fa-tools"></i></button>
      </p>
      <articles-search></articles-search>
      <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Costo</th>
            <th scope="col">Margen</th>
            <th scope="col">Precio</th>
            <th class="config" scope="col"><i class="fas fa-tools config"></i></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($articles as $article)
            <tr>
              <td scope="row">{{ $article->id }}</td>
              <td>{{ $article->name }}</td>
              <td>{{ $article->description }}</td>
              <td>{{ number_readable($article->cost, "$") }}</td>
              <td>{{ number_readable($article->margin, "$") }}</td>
              <td>{{ number_readable($article->price, "$") }}</td>
              <td class='config'><a href="{{ route('articles.edit', ['id' => $article->id]) }}"><button type="button" class="btn btn-sm btn-outline-warning config"><i class="fas fa-wrench"></i></button></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $articles->links() }}
    </div>


@endsection
