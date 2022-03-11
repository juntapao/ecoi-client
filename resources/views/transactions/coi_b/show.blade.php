@extends('layouts.app')
@section('search', route('coi_b.search'))
@section('delete', route('coi_b.destroy', $transaction->id))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Pinoy Protect Plus</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item"><a href="{{ route('coi_b.index') }}">Pinoy Protect Plus</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('coi_b.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            @if($transaction->posted == null)
                <a href="{{ route('coi_b.edit', $transaction->id) }}" class="btn btn-sm btn-neutral loading">Edit</a>
                <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button>
            @endif
            <a href="{{ route('coi_b.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
                <div class="form-group col-12 col-md-6">
                    <label>COI Number</label>
                    <input type="text" class="form-control" value="{{ $transaction->terminal_coi_number }}" readonly />
                </div>
                <div class="form-group col-12 col-md-6">
                    <label>Issue Date</label>
                    <input type="text" class="form-control" value="{{ $transaction->date_issued ? Carbon\Carbon::parse($transaction->date_issued)->format('m/d/Y') : null }}" readonly />
                </div>
                <div class="form-group col-12 col-md-4">
                    <label>ML BRANCH</label>
                    <input type="text" class="form-control" value="{{ $transaction->userbranch }}" readonly />
                </div>
                {{-- <div class="form-group col-12 col-md-4">
                    <label>BOS Entry Number</label>
                    <input type="text" class="form-control" value="{{ $transaction->bos_entry_number }}" readonly />
                </div> --}}
                <div class="form-group col-12 col-md-4">
                    <label>No of units</label>
                    <input type="number" class="form-control" value="{{ $transaction->units }}" readonly />
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Name of insured</label>
                    <input type="text" class="form-control" value="{{ $transaction->insured_name }}" readonly />
                </div>
                <div class="form-group col-md-6">
                    <label>Date of Birth</label>
                    <input type="date" class="form-control" value="{{ $transaction->dateofbirth }}" readonly />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Address</label>
                    <input type="text" class="form-control" value="{{ $transaction->address }}" readonly />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Beneficiary</label>
                    <input type="text" class="form-control" value="{{ $transaction->beneficiary }}" readonly />
                </div>
                <div class="form-group col-md-6">
                    <label>Relationship</label>
                    <input type="text" class="form-control" value="{{ $transaction->relationship }}" readonly />
                </div>
            </div>
        </div>
        <div class="text-right">
            @if($transaction->posted)
                <a href="{{ route('coi_b.print', $transaction->id) }}" class="btn btn-success">Print</a>
            @else
                <a href="{{ route('coi_b.post', $transaction->id) }}" class="btn btn-success" onclick="return confirm('Are you sure you want to Post this transaction?')">Post</a>
            @endif
        </div>
    </div>
</div>
@endsection