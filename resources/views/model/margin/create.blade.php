@extends('layouts.master')

@section('title')
    <title>Crear margen</title>
@endsection

@section('content')

    <form method="post" action="{{ route('margins.store') }}">
        @csrf

        @input([
            'name' => 'name',
            'label' => 'Nombre',
            'attributes' => ['type' => 'text']
        ])

        @input([
            'name' => 'profit',
            'label' => 'Ganancia',
            'attributes' => ['type' => 'number', 'step' => 'any']
        ])

        <button type="submit" class="btn btn-primary">Crear margen</button>

    </form>

@endsection
