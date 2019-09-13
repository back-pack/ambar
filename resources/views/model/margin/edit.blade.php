@extends('layouts.master')

@section('title')
    <title>Editar margen</title>
@endsection

@section('content')

    <form method="post" action="{{ route('margins.update', ['id' => $margin->id]) }}">
        @csrf
        @method('patch')

        @input([
            'name' => 'name',
            'label' => 'Nombre',
            'attributes' => ['type' => 'text'],
            'value' => $margin->name
        ])

        @input([
            'name' => 'profit',
            'label' => 'Ganancia',
            'input_group_append_text' => ['%'],
            'attributes' => ['type' => 'number', 'step' => 'any', 'min' => 0],
            'value' => $margin->profit
        ])

        <button type="submit" class="btn btn-primary">Editar margen</button>

    </form>

    <hr>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy_margin_modal">Eliminar</button>

    @component('components.modal', ['id' => 'destroy_margin_modal', 'title' => 'Eliminar mergen'])
        ¿Desea eliminar el margen {{ $margin->name }}?
        @slot('footer')
          <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <form method="post" action="{{ route('margins.destroy', ['id' => $margin->id]) }}">
            @csrf
            @method('delete')

            <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
          </form>
        @endslot
    @endcomponent

@endsection
