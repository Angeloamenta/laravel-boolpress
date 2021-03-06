@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col">
                        <h1>

                            {{-- qui prendiamo il nome user  e
                                 nella seconda parte grazie al collegamento con la tabella user info, prendiamo il numero generato --}}
                            Welcome {{ Auth::user()->name }} - {{ Auth::user()->userInfo()->first()->phone }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
