@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
          @if (session('status'))
          <div class="alert alert-danger">
              {{ session('status') }}
          </div>
          @endif
            @foreach ($posts as $post)
            <div class="card w-100">
                <div class="card-body">
                  <h3 class="card-title">{{$post['title']}}</h3>
                  <p class="card-text">{{$post['content']}}</p>
                  <div>
                    <h4>Tag:</h4>
                    @foreach ($post->tags()->get() as $tag)
                    <a href="">{{ $tag->name }}</a>
                @endforeach
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-1">
                        <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-primary">View</a>
                      </div>
                      {{-- questo if serve per visualizzare la possibilità di cancellare ed editare solo al creatore del post --}}
                      @if (Auth::user()->id === $post->user_id)
                      <div class="col-1">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                      </div>
                      <div class="col-1">
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <input class="btn btn-danger" type="submit" value="Delete">             
                        </form>          
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection