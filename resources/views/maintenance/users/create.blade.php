@extends('layouts.app')
@section('search', route('users.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Users</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
        </div>
    </div>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Add a Record</h3>
            </div>
        </div>
    </div>
    <div class="card-header border-0">
        <form method="post" action="{{ route('users.store') }}" novalidate>
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="username">User Name</label>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="User Name" value="{{ old('username') }}" />
                        @error('username') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" />
                        @error('password') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" class="form-control  @error('full_name') is-invalid @enderror" placeholder="Full Name" value="{{ old('full_name') }}" />
                        @error('username') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="branch_id">Branch</label>
                        <select class="form-control selectpicker  @error('branch_id') is-invalid @enderror" id="branch_id" name="branch_id" data-live-search="true">
                            <option selected disabled>-Select Branch-</option>
                            @if(count($branches) > 0)
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" @if(old('branch_id') == $branch->id) selected @endif>{{ $branch->branch_name }} | {{ $branch->province }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('branch_id') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="role_id">Role</label>
                        <select class="form-control  @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                            <option selected disabled>-Select Role-</option>
                            @if(count($roles) > 0)
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if(old('role_id') == $role->id) selected @endif>{{ $role->role_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('role_id') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-success loading">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection