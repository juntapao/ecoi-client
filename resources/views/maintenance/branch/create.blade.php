@extends('layouts.app')
@section('search', route('branch.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Branches</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item"><a href="{{ route('branch.index') }}">Branches</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('branch.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
        <form method="post" action="{{ route('branch.store') }}" novalidate>
            @csrf
            <div class="container">
                <div class="row">
                    {{-- <div class="form-group col-md-6">
                        <label for="region">Region Name</label>
                        <select class="form-control @error('region') is-invalid @enderror" id="region" name="region">
                            <option selected disabled>-Select Region-</option>
                                @if(count($regions) > 0)
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->region_name }}" @if(old('region') == $region->region_name) selected @endif>{{ $region->region_name }}</option>
                                    @endforeach
                                @endif
                        </select>
                        @error('region') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div> --}}
                    <div class="form-group col-12">
                        <label for="area_id">Area</label>
                        <select class="form-control selectpicker @error('area_id') is-invalid @enderror" id="area_id" name="area_id" data-live-search="true">
                            <option selected disabled>-Select Area-</option>
                            @if(count($areas) > 0)
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" @if(old('area_id') == $area->id) selected @endif>{{ $area->area_name.' | '.$area->area_manager.' | '.$area->region->region_name.' | '.$area->region->region_manager }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('area_id') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="branch_name">Branch Name</label>
                        <input type="text" id="branch_name" name="branch_name" class="form-control @error('branch_name') is-invalid @enderror" placeholder="Branch Name" value="{{ old('branch_name') }}" />
                        @error('branch_name') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="code">Code</label>
                        <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Code"  value="{{ old('code') }}"/>
                        @error('code') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="City" value="{{ old('city') }}" />
                        @error('city') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" class="form-control @error('province') is-invalid @enderror" placeholder="Province" value="{{ old('province') }}" />
                        @error('province') <div class="invalid-feedback">{{ $message }} </div> @enderror
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