@extends('layouts.master')

@section('title')
    <title>Editar artículo</title>
@endsection

@section('content')

    <h2>Editar artículo</h2>
    <hr>

    <form method="post" action="{{ route('articles.update', ['id' => $article->id]) }}">
      @csrf
      @method('patch')

      <div class="form-row">

        <div class="col-md-3">
          @input([
            'name' => 'name',
            'label' => 'Nombre',
            'attributes' => ['type' => 'text'],
            'value' => $article->name
          ])
        </div>

        <div class="col-md-3">
          @input([
            'name' => 'cost',
            'label' => 'Costo',
            'input_group_prepend_text' => ['$'],
            'attributes' => ['type' => 'number', 'step' => 'any'],
            'value' => $article->cost
          ])
        </div>

        <div class="col-md-3">
          @input([
            'name' => 'margin',
            'label' => 'Margen',
            'input_group_prepend_text' => ['$'],
            'attributes' => ['type' => 'number', 'step' => 'any'],
            'value' => $article->margin
          ])
        </div>

        <div class="col-md-3">
          @input([
            'name' => 'weight',
            'label' => 'Peso',
            'input_group_append_text' => ['kg'],
            'attributes' => ['type' => 'number', 'step' => 'any'],
            'value' => $article->weight
          ])
        </div>

      </div>

      @input([
        'name' => 'description',
        'label' => 'Descripción',
        'attributes' => ['type' => 'text'],
        'value' => $article->description
      ])

      <button type="submit" class="btn btn-primary">Editar</button>
    </form>

    <hr>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy_article_modal">Eliminar</button>

    @component('components.modal', ['id' => 'destroy_article_modal', 'title' => 'Eliminar artículo'])
        ¿Desea eliminar el artículo {{ $article->name }}?
        @slot('footer')
          <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <form method="post" action="{{ route('articles.destroy', ['id' => $article->id]) }}">
            @csrf
            @method('delete')

            <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
          </form>
        @endslot
    @endcomponent

@endsection
