@extends('layouts.app')

@section('content')

<h1>
    All posts of Category: {{ $category->name }}
</h1>


@foreach ($category->posts()->get() as $post)
    <p>{{ $post->id }}</p>
    <p>{{ $post->title }}</p>
@endforeach 


@endsection