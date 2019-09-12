@extends('layouts.master')

@section('title')
    <title>Crear cliente</title>
@endsection

@section('content')

    <form method="post" action="{{ route('clients.store') }}">
        @csrf

        @input([
            'name' => 'name',
            'label' => 'Nombre',
            'attributes' => ['type' => 'text']
        ])

        @input([
            'name' => 'email',
            'label' => 'Correo electrónico',
            'attributes' => ['type' => 'email']
        ])

        @select([
            'name' => 'margin_id',
            'label' => 'Margen',
            'options' => $margins
        ])

        <button type="submit" class="btn btn-primary">Crear cliente</button>

    </form>

@endsection
