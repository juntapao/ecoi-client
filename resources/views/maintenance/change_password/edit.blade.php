@extends('layouts.app')
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Account Password</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Account</li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right"></div>
    </div>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Change Password</h3>
            </div>
        </div>
    </div>
    <div class="card-header border-0">
        <form method="post" action="{{ route('change_password.update', $user->id) }}">
            @method('patch')
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="password">Current Password</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" />
                        @error('password') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" value="{{ old('new_password') }}" />
                        @error('new_password') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" value="{{ old('new_password_confirmation') }}" />
                        @error('new_password_confirmation') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success loading">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection