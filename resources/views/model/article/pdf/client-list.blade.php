@extends('layouts.pdf')

@section('content')
    {{-- <h6 class="text-center">Lista de artículos {{ $date }}</h6> --}}
    <img src="{{ public_path('/img/articles_list_client_pdf_header.png') }}" style="width: 100%" alt="">

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
