@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.posts.update', $post) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                    <option @if (old('category_id') == $category->id) selected @endif value="{{$category->id}}" >{{$category->name}}</option>    
                    @endforeach 
                  </select>
                  @error('category_id')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    @if ($errors->any())
                    <div class="mb-3 mt-3">
                        @foreach ($tags as $tag)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$tag->id}}" name="tags[]"
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                              {{$tag->name}}
                            </label>
                          </div>
                        @endforeach
                    @else
                     <div class="mb-3 mt-3">
                        {{-- @dd(old('tags', [])); --}}
                        @foreach ($tags as $tag)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$tag->id}}" name="tags[]"
                            {{ $post->tags()->get()->contains($tag->id)? 'checked': '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                              {{$tag->name}}
                            </label>
                          </div>
                        @endforeach
                    @endif
                    </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
                    @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if (!empty($post->image))
                <div>
                    <img src="{{ asset('storage/' . $post->image)}}" alt="">
                </div>
                @endif
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" id="image" name="image">
                  </div>
                  @error('image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" rows="3"
                        name="content">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <input class="btn btn-primary" type="submit" value="Salva">
            </form>
        </div>
    </div>
</div>
@endsection