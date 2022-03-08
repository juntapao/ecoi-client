@extends('layouts.app')
{{-- @section('search', route('detailed.search')) --}}
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Detailed Report</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Reports</li>
                <li class="breadcrumb-item">Detailed Report</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            {{-- <a href="{{ route('detailed.index') }}" class="btn btn-sm btn-neutral loading">Show All</a> --}}
        </div>
    </div>
@endsection
@section('content')
@include('includes.download')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Generate Report</h3>
            </div>
        </div>
    </div>
    <div class="card-header border-0">
        <form method="post" action="{{ route('detailed.store') }}" novalidate>
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-4">
                        <strong>Date From</strong>
                        <input type="date" id="date_from" name="date_from" class="form-control @error('date_from') is-invalid @enderror" value="{{ old('date_from') }}" />
                        @error('date_from') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <strong>Date To</strong>
                        <input type="date" id="date_to" name="date_to" class="form-control @error('date_to') is-invalid @enderror" value="{{ old('date_to') }}" />
                        @error('date_to') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-4">
                        <label for="region">Region</label>
                        <select class="form-control selectpicker @error('region') is-invalid @enderror" id="region" name="region[]" data-live-search="true" multiple>
                            <option disabled>-Select-</option>
                            @if(count($regions) > 0)
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" @if(old('region') == $region->id) selected @endif>{{ $region->region_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('region') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="area">Area</label>
                        <select class="form-control selectpicker secondary @error('area') is-invalid @enderror" id="area" name="area[]" data-live-search="true" multiple>
                            <option disabled>-Select-</option>
                            @if(count($areas) > 0)
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" @if(old('area') == $area->id) selected @endif>{{ $area->area_name.' | '.$area->area_manager.' | '.$area->region->region_name.' | '.$area->region->region_manager }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('area') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="branch">Branch</label>
                        <select class="form-control selectpicker @error('branch') is-invalid @enderror" id="branch" name="branch[]" data-live-search="true" multiple>
                            <option disabled>-Select-</option>
                            @if(count($branches) > 0)
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->branch_name }}" @if(old('branch') == $branch->branch_name) selected @endif>{{ $branch->branch_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('branch') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-1"></div>
                    <div class="col-12 col-md-11 ml-4">
                        @error('product')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" name="product[]" type="checkbox" value="A" id="A" @if(in_array('A', old('product') ?? [])) checked @endif />
                                <label class="form-check-label" for="A">Family Protect - Plus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="product[]" type="checkbox" value="AO" id="AO" @if(in_array('AO', old('product') ?? [])) checked @endif />
                                <label class="form-check-label" for="AO">KP Protect</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="product[]" type="checkbox" value="B" id="B" @if(in_array('B', old('product') ?? [])) checked @endif />
                                <label class="form-check-label" for="B">Pinoy Protect - Plus</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="product[]" type="checkbox" value="D" id="D" @if(in_array('D', old('product') ?? [])) checked @endif />
                                <label class="form-check-label" for="D">Family Protect</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="product[]" type="checkbox" value="R" id="R" @if(in_array('R', old('product') ?? [])) checked @endif />
                                <label class="form-check-label" for="R">Pawner's Protect</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-success loading">Generate</button>
            </div>
        </form>
    </div>
</div>
@endsection