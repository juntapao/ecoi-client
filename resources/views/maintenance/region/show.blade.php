@extends('layouts.app')
@section('search', route('region.search'))
@section('delete', route('region.destroy', $region->id))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Regions</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item"><a href="{{ route('region.index') }}">Regions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('region.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('region.edit', $region->id) }}" class="btn btn-sm btn-neutral loading">Edit</a>
            <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button>
            <a href="{{ route('region.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
        </div>
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
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
                            <input type="text" class="form-control" value="{{ $region->region_name }}" readonly />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Region Manager</label>
                            <input type="text" class="form-control" value="{{ $region->region_manager }}" readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($region->areas->count())
        <div class="col-md-4">
            <div class="card">
                <div class="card-header border-0">
                    <div class="container">
                        <div class="row">
                            <h4>Areas tagged in this Region:</h4>
                            <table class="table align-items-center table-flush">
                                <tr><th>Name</th><th>Manager</th></tr>
                                @foreach($region->areas as $area)
                                    <tr><td>{{ $area->area_name }}</td><td>{{ $area->area_manager }}</td></tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="container">
                        <div class="row">
                            <h4>Branches tagged in this Region:</h4>
                            <table class="table align-items-center table-flush">
                                <tr><th>Code</th><th>Name</th><th>City</th><th>Province</th></tr>
                                @foreach($region->areas as $area)
                                    @foreach($area->branches as $branch)
                                        <tr><td>{{ $branch->code }}</td><td>{{ $branch->branch_name }}</td><td>{{ $branch->city }}</td><td>{{ $branch->province }}</td></tr>
                                    @endforeach
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