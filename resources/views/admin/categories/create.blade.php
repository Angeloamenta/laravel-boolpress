@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.categories.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="name" class="form-label">Category</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('title') }}">
                    @error('title')
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