@extends('layouts.master')

@section('title')
    <title>Margenes</title>
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Margen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->margin->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
