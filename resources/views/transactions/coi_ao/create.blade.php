@extends('layouts.app')
@section('search', route('coi_ao.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Kwarta Padala Protect</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item"><a href="{{ route('coi_ao.index') }}">Kwarta Padala Protect</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('coi_ao.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
            <div class="col text-right">Issue Date: {{ date('m/d/Y') }}</div>
        </div>
    </div>
    <div class="card-header border-0">
        <form method="post" action="{{ route('coi_ao.store') }}" novalidate>
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="userbranch">ML BRANCH</label>
                        <input type="text" name="userbranch" class="form-control" value="{{ $branch->branch_name }}" readonly />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="kpt_number">KPT Number</label>
                        <input type="text" name="kpt_number" class="form-control text-uppercase @error('kpt_number') is-invalid @enderror" placeholder="KPT Number" value="{{ old('kpt_number') }}" />
                        @error('kpt_number') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="units">Number of Units</label>
                        {{-- <input type="number" name="units" class="form-control @error('units') is-invalid @enderror" placeholder="Quantity (Maximum of 5)" value="{{ old('units') }}" /> --}}
                        <select name="units" id="units" class="form-control @error('units') is-invalid @enderror">
                            <option value="1" @if(old('units') == 1)selected @endif>1</option>
                            <option value="2" @if(old('units') == 2)selected @endif>2</option>
                            <option value="3" @if(old('units') == 3)selected @endif>3</option>
                            <option value="4" @if(old('units') == 4)selected @endif>4</option>
                            <option value="5" @if(old('units') == 5)selected @endif>5</option>
                        </select>
                        @error('units') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="insured_name">Insured KP Sender/Receiver</label>
                        <input type="text" name="insured_name" class="form-control text-uppercase @error('insured_name') is-invalid @enderror" placeholder="Insured Name" value="{{ old('insured_name') }}" />
                        @error('insured_name') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="beneficiary">Beneficiary</label>
                        <input type="text" name="beneficiary" class="form-control text-uppercase @error('beneficiary') is-invalid @enderror" placeholder="Beneficiary" value="{{ old('beneficiary') }}" />
                        @error('beneficiary') <div class="invalid-feedback">{{ $message }} </div> @enderror
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