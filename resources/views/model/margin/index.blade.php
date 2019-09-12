@extends('layouts.master')

@section('title')
    <title>Margenes</title>
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ganancia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($margins as $margin)
                <tr>
                    <td>{{ $margin->name }}</td>
                    <td>{{ $margin->profit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
