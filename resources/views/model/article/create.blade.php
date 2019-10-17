@extends('layouts.master')

@section('title')
    <title>Crear artículo</title>
@endsection

@section('content')

    <h2>Crear artículo</h2>
    <hr>

    <form method="post" action="{{ route('articles.store') }}">
      @csrf

      @select([
          'name' => 'category_id',
          'label' => 'Categoria',
          'options' => $categories
      ])

      <div class="form-row">

        <div class="col-md-3">
          @input([
            'name' => 'name',
            'label' => 'Nombre',
            'attributes' => ['type' => 'text']
          ])
        </div>

        <div class="col-md-3">
          @input([
            'name' => 'cost',
            'label' => 'Costo',
            'input_group_prepend_text' => ['$'],
            'attributes' => ['type' => 'number', 'step' => 'any', 'min' => 0]
          ])
        </div>

        <div class="col-md-3">
          @input([
            'name' => 'price',
            'label' => 'Precio',
            'input_group_prepend_text' => ['$'],
            'attributes' => ['type' => 'number', 'step' => 'any', 'min' => 0]
          ])
        </div>

        <div class="col-md-3">
          @input([
            'name' => 'weight',
            'label' => 'Peso',
            'input_group_append_text' => ['kg'],
            'attributes' => ['type' => 'number', 'step' => 'any']
          ])
        </div>

      </div>

      @input([
        'name' => 'description',
        'label' => 'Descripción',
        'attributes' => ['type' => 'text']
      ])

      <button type="submit" class="btn btn-primary">Crear</button>
    </form>

@endsection
