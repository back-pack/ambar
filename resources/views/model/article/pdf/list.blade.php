@extends('layouts.pdf')

@section('content')

    <div class="row">
        <div class="col-12 clearfix">
            <h4 class="float-left">Ambar</h4>
            <h4 class="float-right">Lista de artículos {{ $date }}</h4>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Costo</th>
                <th>Ultima actualización</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>#{{ $article->id }}</td>
                    <td>{{ $article->name }}</td>
                    <td>{{ $article->description }}</td>
                    <td>{{ number_readable($article->cost, "$") }}</td>
                    <td>{{ $article->cost_last_update->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
