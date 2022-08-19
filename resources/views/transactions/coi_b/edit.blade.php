@extends('layouts.app')
@section('search', route('coi_b.search'))
@section('delete', route('coi_b.destroy', Crypt::encrypt($transaction->id)))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Pinoy Protect Plus</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item"><a href="{{ route('coi_b.index') }}">Pinoy Protect Plus</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('coi_b.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('coi_b.show', Crypt::encrypt($transaction->id)) }}" class="btn btn-sm btn-neutral loading">Show</a>
            <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button>
            <a href="{{ route('coi_b.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
        <form  method="POST" action="{{ route('coi_b.update', ['id' => Crypt::encrypt($transaction->id)]) }}">
            @method('patch')
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="userbranch">COI Number</label>
                        <input type="text" class="form-control" value="{{ $transaction->coi_number }}" readonly />
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="date_issued">Issue Date</label>
                        <input type="text" class="form-control" value="{{ Carbon\Carbon::parse($transaction->date_issued)->format('m/d/Y') }}" readonly />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="userbranch">ML BRANCH</label>
                        <input type="text" name="userbranch" class="form-control" value="{{ $transaction->userbranch }}" readonly />
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="bos_entry_number">BOS Entry Number</label>
                        <input type="text" name="bos_entry_number" class="form-control text-uppercase @error('bos_entry_number') is-invalid @enderror" value="{{ $transaction->bos_entry_number }}" placeholder="BOS Entry Number" required />
                        @error('bos_entry_number') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div> --}}
                    <div class="form-group col-md-4">
                        <label for="units">No of units</label>
                        <input type="number" name="units" class="form-control @error('units') is-invalid @enderror" placeholder="Quantity (Maximum of 5)" value="{{ old('units', $transaction->units) }}" />
                        @error('units') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="insured_name">Name of insured</label>
                        <input type="text" id="insured_name" name="insured_name" class="form-control text-uppercase @error('insured_name') is-invalid @enderror" placeholder="Insured Name" value="{{ old('insured_name', $transaction->insured_name) }}" />
                        @error('insured_name') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dateofbirth">Date of Birth</label>
                        <input type="date" id="dateofbirth" name="dateofbirth" class="form-control @error('dateofbirth') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('dateofbirth', $transaction->dateofbirth) }}" />
                        @error('dateofbirth') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" class="form-control text-uppercase @error('address') is-invalid @enderror" placeholder="Address" value="{{ old('address', $transaction->address) }}" />
                        @error('address') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="beneficiary">Beneficiary</label>
                        <input type="text" id="beneficiary" name="beneficiary" class="form-control text-uppercase @error('beneficiary') is-invalid @enderror" placeholder="Beneficiary" value="{{ old('beneficiary', $transaction->beneficiary) }}" />
                        @error('beneficiary') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="relationship">Relationship</label>
                        <input type="text" id="relationship" name="relationship" class="form-control text-uppercase @error('relationship') is-invalid @enderror" placeholder="Relationship" value="{{ old('relationship', $transaction->relationship) }}" />
                        @error('relationship') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="reason">Reason</label>
                        <textarea name="reason" class="form-control text-uppercase @error('reason') is-invalid @enderror" placeholder="Reason for Edit" >{{ old('reason', $transaction->reason) }}</textarea>
                        @error('reason') <div class="invalid-feedback">{{ $message }} </div> @enderror
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