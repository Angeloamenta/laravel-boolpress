@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                  <h3 class="card-title"><strong>{{$post->title}}</strong></h3>
                  {{-- prendo il nome della cateogria --}}
                   <h5 class="card-title"> <strong>Category:</strong>{{$post->category()->first()->name}}</h5> 
                  <p class="card-text">{{$post->content}}</p>
                  {{-- prendo il nome dell'user  --}}
                   <p> by: <strong>{{$post->user()->first()->name}}</strong></p> 
                  {{-- <a href="" class="btn btn-primary">Button</a> --}}
                  <img src="{{ asset('storage/' . $post->image)}}" alt="">
                </div>
              </div>
        </div>
    </div>
</div>
@endsection