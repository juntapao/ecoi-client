@extends('layouts.app')
@section('search', route('users.search'))
@section('delete', route('users.destroy', $user->id))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Users</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-neutral loading">Edit</a>
            <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button>
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
        </div>
    </div>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Show Record</h3>
            </div>
        </div>
    </div>
    <div class="card-header border-0">
        <div class="container">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>User Name</label>
                    <input type="text" class="form-control" value="{{ $user->username }}" readonly />
                </div>
                <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="password" class="form-control" value="{{ $user->password }}" readonly />
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Full Name</label>
                    <input type="text" class="form-control" value="{{ $user->full_name }}" readonly />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Branch</label>
                    <input type="text" class="form-control" value="{{ $user->branch->branch_name }}" readonly />
                </div>
                <div class="form-group col-md-6">
                    <label>Role</label>
                    <input type="text" class="form-control" value="{{ $user->user_role->role_name }}" readonly />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection