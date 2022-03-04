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
            @foreach ($categories as $category)
            <div class="card w-100">
                <div class="card-body">
                  <h5 class="card-title">{{$category['name']}}</h5>
                    <div class="row">
                      <div class="col-1">
                        <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-primary">View</a>
                      </div>
                      <div class="col-1">
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <input class="btn btn-danger" type="submit" value="Delete">             
                        </form>          
                      </div>
                    </div>
                </div>
              </div>
            @endforeach
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection