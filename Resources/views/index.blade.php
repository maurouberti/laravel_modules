@extends('blog::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        Módulo: {!! config('blog.name') !!}
    </p>
    {{ count($Posts) }}
    <ul>
    @foreach($Posts as $Post)
        <li>{{ $Post->title }} - {{ $Post->author }}</li>
    @endforeach
    </ul>
@stop
