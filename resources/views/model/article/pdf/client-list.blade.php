@extends('layouts.pdf')

@section('content')

    <div class="row">
        <div class="col-12 clearfix">
            <h4 class="float-left">Ambar</h4>
            <h4 class="float-right">Lista de artículos {{ $date }}</h4>
        </div>
    </div>


    @foreach ($categories as $category)
        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <tr>
                    <th style="font-size: 10pt">{{ $category->name }}</th>
                    <th style="font-size: 10pt">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category->articles as $article)
                    <tr>
                        <td style="font-size: 10pt">{{ $article->name }}</td>
                        <td style="font-size: 10pt">{{ number_readable($article->price, "$") }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

@endsection
