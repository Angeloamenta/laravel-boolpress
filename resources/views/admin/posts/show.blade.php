@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                  <h5 class="card-title">{{$post->title}}</h5>
                  {{-- prendo il nome della cateogria --}}
                  {{-- <h6>{{$post->category()->first()->name}}</h6>  --}}
                  <p class="card-text">{{$post->content}}</p>
                  {{-- prendo il nome dell'user  --}}
                  {{-- <p>{{$post->user()->first()->name}}</p> --}}
                  {{-- <a href="" class="btn btn-primary">Button</a> --}}
                </div>
              </div>
        </div>
    </div>
</div>
@endsection