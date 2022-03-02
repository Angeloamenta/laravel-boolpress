@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>
                All posts of Category: {{ $category->name }}
            </h1>
        </div>
    </div>
    <div class="row">
        {{-- non funzionava perchè nel model di Category la funzione si chiamava user invece di posts --}}
        @foreach ($category->posts()->get() as $post)
        <div class="row">
            <div class="col">
                <p>{{ $post->title }}</p>
            </div>
            <div class="col-1">
                <a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
            </div>
        </div>
        @endforeach 
        </table>
    </div>
</div>
@endsection