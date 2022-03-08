@extends('layouts.big')

@section('content')
    <div class="text-center text-muted mb-4">
        <span>Initial setup</span><br />
        <small>Please input the assigned terminal signature</small>
    </div>
    <form role="form" method="POST" action="{{ route('set-terminal') }}">
        @csrf
        <div class="form-group mb-3">
            <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-desktop"></i></span>
                </div>
                <input class="form-control @error('signature') is-invalid @enderror" name="signature" placeholder="Terminal Signature" type="text" />
                @error('signature') <div class="invalid-feedback">{{ $message }} </div> @enderror
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary my-4 loading">Assign</button>
        </div>
    </form>
@endsection

