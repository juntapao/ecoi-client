@extends('layouts.app')
@section('search', route('area.search'))
@section('delete', route('area.destroy', $area->id))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Areas</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item"><a href="{{ route('area.index') }}">Areas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('area.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('area.edit', $area->id) }}" class="btn btn-sm btn-neutral loading">Edit</a>
            <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button>
            <a href="{{ route('area.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
                    <label>Region Name</label>
                    <input type="text" class="form-control" value="{{ $area->region->region_name }}" readonly />
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Area Name</label>
                    <input type="text" class="form-control" value="{{ $area->area_name }}" readonly />
                </div>
                <div class="form-group col-md-6">
                    <label>Area Manager</label>
                    <input type="text" class="form-control" value="{{ $area->area_manager }}" readonly />
                </div>
            </div>
        </div>
    </div>
    @if($area->branches->count())
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="container">
                        <div class="row">
                            <h4>Branches tagged in this Area:</h4>
                            <table class="table align-items-center table-flush">
                                <tr><th>Code</th><th>Name</th><th>City</th><th>Province</th></tr>
                                @foreach($area->branches as $branch)
                                    <tr><td>{{ $branch->code }}</td><td>{{ $branch->branch_name }}</td><td>{{ $branch->city }}</td><td>{{ $branch->province }}</td></tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection