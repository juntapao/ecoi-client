@extends('layouts.app')
@section('search', route('area.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Areas</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item"><a href="{{ route('area.index') }}">Areas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('area.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
        <form method="post" action="{{ route('area.store') }}" novalidate>
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="region_id">Region Name</label>
                        <select class="form-control @error('region_id') is-invalid @enderror" id="region_id" name="region_id">
                            <option selected disabled>-Select Region-</option>
                            @if(count($regions) > 0)
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" @if(old('region_id') == $region->id) selected @endif>{{ $region->region_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('region_id') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="area_name">Area Name</label>
                        <input type="text" id="area_name" name="area_name" class="form-control @error('area_name') is-invalid @enderror" placeholder="Area Name" value="{{ old('area_name') }}" />
                        @error('area_name') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="area_manager">Area Manager</label>
                        <input type="text" id="area_manager" name="area_manager" class="form-control @error('area_manager') is-invalid @enderror" placeholder="Area Manager" value="{{ old('area_manager') }}" />
                        @error('area_manager') <div class="invalid-feedback">{{ $message }} </div> @enderror
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