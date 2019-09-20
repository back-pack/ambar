@extends('layouts.master')

@section('title')
    <title>Editar cliente</title>
@endsection

@section('content')

    <form method="post" action="{{ route('clients.update', ['id' => $client->id]) }}">
        @csrf
        @method('patch')

        @input([
            'name' => 'name',
            'label' => 'Nombre',
            'attributes' => ['type' => 'text'],
            'value' => $client->name
        ])

        @input([
            'name' => 'email',
            'label' => 'Correo electrónico',
            'attributes' => ['type' => 'email'],
            'value' => $client->email
        ])

        <button type="submit" class="btn btn-primary">Editar cliente</button>

    </form>

    <hr>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroy_client_modal">Eliminar</button>

    @component('components.modal', ['id' => 'destroy_client_modal', 'title' => 'Eliminar cliente'])
        ¿Desea eliminar el cliente {{ $client->name }}?
        @slot('footer')
          <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <form method="post" action="{{ route('clients.destroy', ['id' => $client->id]) }}">
            @csrf
            @method('delete')

            <button type="submit" name="button" class="btn btn-danger">Eliminar</button>
          </form>
        @endslot
    @endcomponent

@endsection
