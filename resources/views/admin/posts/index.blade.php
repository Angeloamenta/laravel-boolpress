@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            @foreach ($posts as $post)
            <div class="card w-100">
                <div class="card-body">
                  <h5 class="card-title">{{$post['title']}}</h5>
                  <p class="card-text">{{$post['content']}}</p>
                  <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-primary">View</a>
                </div>
              </div>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection