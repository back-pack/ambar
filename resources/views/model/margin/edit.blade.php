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
            'attributes' => ['type' => 'number', 'step' => 'any'],
            'value' => $margin->profit
        ])

        <button type="submit" class="btn btn-primary">Editar margen</button>

    </form>

@endsection
