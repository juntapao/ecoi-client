@extends('layouts.big')

@section('content')
    <div class="text-center text-muted mb-4">
        <img class="w-100 pb-3" src="{{ asset('images/ml_logo.png') }}" />
        <small>Sign in with credentials</small>
    </div>
    <form role="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mb-3">
            <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                </div>
                <input class="form-control" name="username" placeholder="Username" type="text" />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" name="password" placeholder="Password" type="password" />
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-4 loading">Sign in</button>
        </div>
    </form>
@endsection
