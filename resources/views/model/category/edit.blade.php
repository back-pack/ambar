@extends('layouts.master')

@section('title')
    <title>Editar categoría</title>
@endsection

@section('content')

    <h2>Editar categoría</h2>
    <hr>

    @include('components.message')

    <form method="post" action="{{ route('categories.update', ['id' => $category->id]) }}">
      @csrf
      @method('patch')

      @input([
        'name' => 'name',
        'label' => 'Nombre',
        'attributes' => ['type' => 'text'],
        'value' => $category->name
      ])

      @input([
        'name' => 'description',
        'label' => 'Descripción',
        'attributes' => ['type' => 'text'],
        'value' => $category->description
      ])

      <button type="submit" class="btn btn-primary">Editar</button>
    </form>

    <hr>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy_category_modal">Eliminar</button>

    @component('components.modal', ['id' => 'destroy_category_modal', 'title' => 'Eliminar categoria'])
        ¿Desea eliminar la categoria {{ $category->name }}?
        @slot('footer')
          <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <form method="post" action="{{ route('categories.destroy', ['id' => $category->id]) }}">
            @csrf
            @method('delete')

            <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
          </form>
        @endslot
    @endcomponent

@endsection
