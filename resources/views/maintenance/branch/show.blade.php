@extends('layouts.app')
@section('search', route('branch.search'))
@section('delete', route('branch.destroy', $branch->id))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Branches</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item"><a href="{{ route('branch.index') }}">Branches</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('branch.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('branch.edit', $branch->id) }}" class="btn btn-sm btn-neutral loading">Edit</a>
            <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button>
            <a href="{{ route('branch.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
                {{-- <div class="form-group col-md-6">
                    <label>Region Name</label>
                    <input type="text" class="form-control" value="{{ $branch->region }}" readonly />
                </div> --}}
                <div class="form-group col-12">
                    <label>Area</label>
                    <input type="text" class="form-control" value="{{ $branch->area->area_name }}" readonly />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Branch Name</label>
                    <input type="text" class="form-control" value="{{ $branch->branch_name }}" readonly />
                </div>
                <div class="form-group col-md-6">
                    <label>Code</label>
                    <input type="text" class="form-control" value="{{ $branch->code }}" readonly />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>City</label>
                    <input type="text" class="form-control" value="{{ $branch->city }}" readonly />
                </div>
                <div class="form-group col-md-6">
                    <label>Province</label>
                    <input type="text" class="form-control" value="{{ $branch->province }}" readonly />
                </div>
            </div> 
        </div>
    </div>
    @if($branch->users->count())
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="container">
                        <div class="row">
                            <h4>Users tagged in this Branch:</h4>
                            <table class="table align-items-center table-flush">
                                <tr><th>Username</th><th>Full Name</th></tr>
                                @foreach($branch->users as $user)
                                    <tr><td>{{ $user->username }}</td><td>{{ $user->full_name }}</td></tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
</div>
@endsection