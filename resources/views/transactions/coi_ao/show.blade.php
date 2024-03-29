@extends('layouts.app')
@section('search', route('coi_ao.search'))
@section('delete', route('coi_ao.destroy', Crypt::encrypt($transaction->id)))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Kwarta Padala Protect</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item"><a href="{{ route('coi_ao.index') }}">Kwarta Padala Protect</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('coi_ao.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            @if(!$transaction->posted)
                <a href="{{ route('coi_ao.edit', Crypt::encrypt($transaction->id)) }}" class="btn btn-sm btn-neutral loading">Edit</a>
                <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button>
            @endif
            <a href="{{ route('coi_ao.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
                <div class="form-group col-12 col-md-4">
                    <label>KPT Number</label>
                    <input type="text" class="form-control" value="{{ $transaction->kpt_number }}" readonly />
                </div>
                <div class="form-group col-12 col-md-4">
                    <label>No of units</label>
                    <input type="number" class="form-control" value="{{ $transaction->units }}" readonly />
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <label>Insured KP Sender/Receiver</label>
                    <input type="text" class="form-control" value="{{ $transaction->insured_name }}" readonly />
                </div>
                <div class="form-group col-12 col-md-6">
                    <label>Beneficiary</label>
                    <input type="text" class="form-control" value="{{ $transaction->beneficiary }}" readonly />
                </div>
            </div>
        </div>
        <div class="text-right">
            {{-- <a href="{{ route('coi_ao.index') }}" class="btn btn-primary">Cancel</a> --}}
            @if(!$transaction->posted)
                <a href="{{ route('coi_ao.post', Crypt::encrypt($transaction->id)) }}" class="btn btn-success" onclick="return confirm('Are you sure you want to Post this transaction?')">Post</a>
            @else
                <a href="{{ route('coi_ao.print', Crypt::encrypt($transaction->id)) }}" class="btn btn-success">Print</a>
            @endif
        </div>
    </div>
</div>
@endsection