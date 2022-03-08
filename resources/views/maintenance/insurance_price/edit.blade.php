@extends('layouts.app')
{{-- @section('search', route('insurance_price.search')) --}}
{{-- @section('delete', route('insurance_price.destroy', $price->id)) --}}
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Insurance Prices</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item"><a href="{{ route('insurance_price.index') }}">Insurance Prices</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            {{-- <a href="{{ route('insurance_price.create') }}" class="btn btn-sm btn-neutral loading">Add</a> --}}
            <a href="{{ route('insurance_price.show', $price->id) }}" class="btn btn-sm btn-neutral loading">Show</a>
            {{-- <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button> --}}
            <a href="{{ route('insurance_price.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
        <form method="post" action="{{ route('insurance_price.update', $price->id) }}">
            @method('patch')
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>COI Type</label>
                        <input type="text" class="form-control" value="{{ $price->coi_type }}" readonly />
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" class="form-control text-right @error('price') is-invalid @enderror" placeholder="Price" value="{{ $price->price }}" />
                        @error('price') <div class="invalid-feedback">{{ $message }} </div> @enderror
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