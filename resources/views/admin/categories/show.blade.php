@extends('layouts.app')

@section('content')

<h1>
    All posts of Category: {{ $category->name }}
</h1>

{{-- @dd($category->posts()->get()) --}}

{{-- non funzionava perchè nel model di Category la funzione si chiamava user invece di posts --}}
@foreach ($category->posts()->get() as $post)
    <p>{{ $post->id }}</p>
    <p>{{ $post->title }}</p>
@endforeach 


@endsection