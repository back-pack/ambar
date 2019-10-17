@extends('layouts.master')

@section('title')
    <title>Categorias</title>
@endsection

@section('content')


    <div class="col-sm">
      <p class='h2'>Categorias |
          <a href="{{ route('categories.create') }}"><button class="btn btn-sm btn-outline-success" type="button"><i class="fas fa-plus-square"></i></button></a>
      </p>
      <table class="table table-hover table-responsive-sm">
        <thead class="thead-light">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th class="config" scope="col"><i class="fas fa-tools config"></i></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
            <tr>
              <td scope="row">{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->description }}</td>
              <td class='config'><a href="{{ route('categories.edit', ['id' => $category->id]) }}"><button type="button" class="btn btn-sm btn-outline-warning config"><i class="fas fa-wrench"></i></button></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $categories->links() }}
    </div>


@endsection
