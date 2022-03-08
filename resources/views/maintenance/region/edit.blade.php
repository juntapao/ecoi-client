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
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('region.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('region.show', $region->id) }}" class="btn btn-sm btn-neutral loading">Show</a>
            <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button>
            <a href="{{ route('region.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
        </div>
    </div>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Edit Record</h3>
            </div>
            <div class="col text-right">Issue Date: {{ date('m/d/Y') }}</div>
        </div>
    </div>
    <div class="card-header border-0">
        <form method="post" action="{{ route('region.update', $region->id) }}">
            @method('patch')
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="region_name">Region Name</label>
                        <input type="text" id="region_name" name="region_name" class="form-control @error('region_name') is-invalid @enderror" placeholder="Region Name" value="{{ $region->region_name }}" />
                        @error('region_name') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="region_manager">Region Manager</label>
                        <input type="text" id="region_manager" name="region_manager" class="form-control @error('region_manager') is-invalid @enderror" placeholder="Region Manager" value="{{ $region->region_manager }}" />
                        @error('region_manager') <div class="invalid-feedback">{{ $message }} </div> @enderror
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