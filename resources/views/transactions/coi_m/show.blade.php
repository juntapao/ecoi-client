@extends('layouts.app')
@section('search', route('coi_m.search'))
@section('delete', route('coi_m.destroy', Crypt::encrypt($transaction->id)))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Mediphone</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item"><a href="{{ route('coi_m.index') }}">Mediphone</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('coi_m.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            @if($transaction->posted == null)
                <a href="{{ route('coi_m.edit', Crypt::encrypt($transaction->id)) }}" class="btn btn-sm btn-neutral loading">Edit</a>
                <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button>
            @endif
            <a href="{{ route('coi_m.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
                    <input type="text" class="form-control" value="{{ $transaction->coi_number }}" readonly />
                </div>
                <div class="form-group col-12 col-md-6">
                    <label>Issue Date</label>
                    <input type="text" class="form-control" value="{{ $transaction->date_issued ? Carbon\Carbon::parse($transaction->date_issued)->format('m/d/Y') : null }}" readonly />
                </div>
                <div class="form-group col-12 col-md-4">
                    <label>ML BRANCH</label>
                    <input type="text" class="form-control" value="{{ $transaction->userbranch }}" readonly />
                </div>
                <div class="form-group col-12 col-md-4">
                    <label>No of units</label>
                    <input type="number" class="form-control" value="{{ $transaction->units }}" readonly />
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <label>Name of Member</label>
                    <input type="text" class="form-control" value="{{ $transaction->insured_name }}" readonly />
                </div>
                <div class="form-group col-12 col-md-6">
                    <label>Birth Date</label>
                    <input type="date" class="form-control" value="{{ $transaction->dateofbirth ? $transaction->dateofbirth->format('Y-m-d') : null }}" readonly />
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <label>Contact Number</label>
                    <input type="text" class="form-control" value="{{ $transaction->contact_number }}" readonly />
                </div>
                <div class="form-group col-12 col-md-6">
                    <label>E-Mail Addres</label>
                    <input type="text" class="form-control" value="{{ $transaction->email }}" readonly />
                </div>
                <div class="form-group col-12 col-md-6">
                    <label>Beneficiary</label>
                    <input type="text" class="form-control" value="{{ $transaction->beneficiary }}" readonly />
                </div>
                <div class="form-group col-12 col-md-6">
                    <label>Relationship</label>
                    <input type="text" class="form-control" value="{{ $transaction->relationship }}" readonly />
                </div>
            </div>
        </div>
        <div class="text-right">
            @if($transaction->posted == null)
                <a href="{{ route('coi_m.post', Crypt::encrypt($transaction->id)) }}" class="btn btn-success" onclick="return confirm('Are you sure you want to Post this transaction?')">Post</a>
            @else
                <a href="{{ route('coi_m.print', Crypt::encrypt($transaction->id)) }}" class="btn btn-success" target="_blank">Print</a>
            @endif
        </div>
    </div>
</div>
@endsection