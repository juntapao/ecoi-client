@extends('layouts.app')
@section('search', route('all.search'))
{{-- @section('delete', route('all.destroy', $transaction->id)) --}}
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">All Transactions</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Reports</li>
                <li class="breadcrumb-item"><a href="{{ route('all.index') }}">All Transactions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            {{-- <a href="{{ route('all.create') }}" class="btn btn-sm btn-neutral loading">Add</a> --}}
            {{-- <a href="{{ route('all.edit', $transaction->id) }}" class="btn btn-sm btn-neutral loading">Edit</a> --}}
            {{-- <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button> --}}
            <a href="{{ route('all.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
            @if($transaction->type == 'A')
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
                    {{-- <div class="form-group col-12 col-md-4">
                        <label>BOS Entry No</label>
                        <input type="text" class="form-control" value="{{ $transaction->bos_entry_number }}" readonly />
                    </div> --}}
                    <div class="form-group col-12 col-md-4">
                        <label>No of units</label>
                        <input type="number" class="form-control" value="{{ $transaction->units }}" readonly />
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label>Principal Insured</label>
                        <input type="text" class="form-control" value="{{ $transaction->insured_name }}" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Birth Date <small>(18 - 70 yrs. old)</small></label>
                        <input type="text" class="form-control" value="{{ $transaction->dateofbirth ? Carbon\Carbon::parse($transaction->dateofbirth)->format('m/d/Y') : null }}" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label>Civil Status</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Single" @if($transaction->civil_status == 'Single') checked @endif disabled />
                            <label class="form-check-label" for="single">Single</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Married" @if($transaction->civil_status == 'Married') checked @endif disabled />
                            <label class="form-check-label" for="married">Married</label>
                        </div>
                    </div>
                </div>
                {{-- PARENTS / SPOUSE --}}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Parents</label>
                        <input type="text" class="form-control" value="{{ $transaction->guardian }}" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Birth Dates <small>(18 - 70 yrs. old)</small></label>
                        <input type="text" class="form-control" value="{{ $transaction->guardian_dateofbirth ? Carbon\Carbon::parse($transaction->guardian_dateofbirth)->format('m/d/Y') : null }}" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" value="{{ $transaction->guardian2 }}" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" value="{{ $transaction->guardian_dateofbirth2 ? Carbon\Carbon::parse($transaction->guardian_dateofbirth2)->format('m/d/Y') : null }}" readonly />
                    </div>
                </div>
                {{-- CHILDREN / SIBLING --}}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Siblings</label>
                        <input type="text" class="form-control" value="{{ $transaction->child_siblings }}" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Birth Dates <small>(1 - 21 yrs. old)</small></label>
                        <input type="text" class="form-control" value="{{ $transaction->child_siblings_dateofbirth ? Carbon\Carbon::parse($transaction->child_siblings_dateofbirth)->format('m/d/Y') : null }}" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" value="{{ $transaction->child_siblings2 }}" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" value="{{ $transaction->child_siblings_dateofbirth2 ? Carbon\Carbon::parse($transaction->child_siblings_dateofbirth2)->format('m/d/Y') : null }}" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" value="{{ $transaction->child_siblings3 }}" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" value="{{ $transaction->child_siblings_dateofbirth3 ? Carbon\Carbon::parse($transaction->child_siblings_dateofbirth3)->format('m/d/Y') : null }}" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" value="{{ $transaction->child_siblings4 }}" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" value="{{ $transaction->child_siblings_dateofbirth4 ? Carbon\Carbon::parse($transaction->child_siblings_dateofbirth4)->format('m/d/Y') : null }}" readonly />
                    </div>
                </div>
            @elseif($transaction->type == 'AO')
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
            @elseif($transaction->type == 'B')
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
            @elseif($transaction->type == 'D')
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
                        <label>Name of Insured</label>
                        <input type="text" class="form-control" value="{{ $transaction->insured_name }}" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" value="{{ $transaction->dateofbirth }}" readonly />
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
            @elseif($transaction->type == 'R')
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
                        <label>Pawn Ticket Number</label>
                        <input type="text" class="form-control" value="{{ $transaction->ticket_number }}" readonly />
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label>No of units</label>
                        <input type="number" class="form-control" value="{{ $transaction->units }}" readonly />
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Pawner / Insured</label>
                        <input type="text" class="form-control" value="{{ $transaction->insured_name }}" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Beneficiary</label>
                        <input type="text" class="form-control" value="{{ $transaction->beneficiary }}" readonly />
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection