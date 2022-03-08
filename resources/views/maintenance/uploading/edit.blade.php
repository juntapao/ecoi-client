@extends('layouts.app')
@section('search', route('uploading.search'))
@section('delete', route('uploading.destroy', $transaction->id))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Uploading</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item"><a href="{{ route('uploading.index') }}">Uploading</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('uploading.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('uploading.show', $transaction->id) }}" class="btn btn-sm btn-neutral loading">Show</a>
            <button data-toggle="modal" data-target="#delete" class="btn btn-sm btn-neutral">Delete</button>
            <a href="{{ route('uploading.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
        <form  method="POST" action="{{ route('uploading.update', ['id' => $transaction->id]) }}">
            @method('patch')
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="userbranch">ML BRANCH</label>
                        <input type="text" name="userbranch" class="form-control" value="{{ $transaction->userbranch }}" readonly />
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="bos_entry_number">BOS Entry No</label>
                        <input type="text" name="bos_entry_number" class="form-control @error('bos_entry_number') is-invalid @enderror" placeholder="BOS Entry No" value="{{ $transaction->bos_entry_number }}">
                        @error('bos_entry_number') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div> --}}
                    <div class="form-group col-md-4">
                        <label for="units">Number of Units</label>
                        <input type="number" name="units" class="form-control @error('units') is-invalid @enderror" placeholder="Quantity (Maximum of 5)" value="{{ old('units', $transaction->units) }}">
                        @error('units') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="insured_name">Principal Insured</label>
                        <input type="text" name="insured_name" class="form-control text-uppercase @error('insured_name') is-invalid @enderror" placeholder="Principal Insured" value="{{ old('insured_name', $transaction->insured_name) }}">
                        @error('insured_name') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dateofbirth">Birth Date <small>(18 - 70 yrs. old)</small></label>
                        <input type="date" name="dateofbirth" class="form-control @error('dateofbirth') is-invalid @enderror" value="{{ old('dateofbirth', $transaction->dateofbirth) }}">
                        @error('dateofbirth') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div id="civil_status" class="row">
                    <div class="col-12">
                        <label>Civil Status</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="civil_status" id="single" value="Single" checked />
                            <label class="form-check-label" for="single">Single</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="civil_status" id="married" value="Married" @if(old('civil_status') == 'Married') checked @endif />
                            <label class="form-check-label" for="married">Married</label>
                        </div>
                    </div>
                </div>
                {{-- PARENTS / SPOUSE --}}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label id="spouse_parents" for="guardian">Parents</label>
                        {{-- <input type="text" id="guardian" name="guardian" class="form-control @error('guardian') is-invalid @enderror" placeholder="Spouse / Parents" value="@if(old('guardian')) {{ old('guardian') }} @else {{ $transaction->guardian }} @endif"> --}}
                        <input type="text" id="guardian" name="guardian" class="form-control text-uppercase @error('guardian') is-invalid @enderror" placeholder="Spouse / Parents" value="{{ old('guardian', $transaction->guardian) }}">
                        @error('guardian') <div class="invalid-feedback">{{ str_replace('guardian', 'spouse/parent', str_replace('guardian dateofbirth', 'birth date', $message)) }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="guardian_dateofbirth">Birth Dates <small>(18 - 70 yrs. old)</small></label>
                        <input type="date" id="guardian_dateofbirth" name="guardian_dateofbirth" class="form-control @error('guardian_dateofbirth') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('guardian_dateofbirth', $transaction->guardian_dateofbirth) }}">
                        @error('guardian_dateofbirth') <div class="invalid-feedback">{{ str_replace('guardian', 'spouse/parent', str_replace('guardian dateofbirth', 'birth date', $message)) }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" id="guardian2" name="guardian2" class="form-control text-uppercase @error('guardian2') is-invalid @enderror" placeholder="Spouse / Parents" value="{{ old('guardian2', $transaction->guardian2) }}" >
                        @error('guardian2') <div class="invalid-feedback">{{ str_replace('guardian2', 'spouse/parent', str_replace('guardian dateofbirth2', 'birth date', $message)) }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="date" id="guardian_dateofbirth2" name="guardian_dateofbirth2" class="form-control @error('guardian_dateofbirth2') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('guardian_dateofbirth2', $transaction->guardian_dateofbirth2) }}" >
                        @error('guardian_dateofbirth2') <div class="invalid-feedback">{{ str_replace('guardian2', 'spouse/parent', str_replace('guardian dateofbirth2', 'birth date', $message)) }} </div> @enderror
                    </div>
                </div>
                {{-- CHILDREN / SIBLING --}}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label id="child_siblings" for="child_siblings">Siblings</label>
                        <input type="text" id="child_siblings" name="child_siblings" class="form-control text-uppercase @error('child_siblings') is-invalid @enderror" placeholder="Children / Siblings" value="{{ old('child_siblings', $transaction->child_siblings) }}" >
                        @error('child_siblings') <div class="invalid-feedback">{{ str_replace('child siblings', 'child/sibling', str_replace('child siblings dateofbirth', 'birth date', $message)) }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="child_siblings_dateofbirth">Birth Dates <small>(1 - 21 yrs. old)</small></label>
                        <input type="date" id="child_siblings_dateofbirth" name="child_siblings_dateofbirth" class="form-control @error('child_siblings_dateofbirth') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('child_siblings_dateofbirth', $transaction->child_siblings_dateofbirth) }}" >
                        @error('child_siblings_dateofbirth') <div class="invalid-feedback">{{ str_replace('child siblings', 'child/sibling', str_replace('child siblings dateofbirth', 'birth date', $message)) }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" id="child_siblings2" name="child_siblings2" class="form-control text-uppercase @error('child_siblings2') is-invalid @enderror" placeholder="Children / Siblings" value="{{ old('child_siblings2', $transaction->child_siblings2) }}" >
                        @error('child_siblings2') <div class="invalid-feedback">{{ str_replace('child siblings2', 'child/sibling', str_replace('child siblings dateofbirth2', 'birth date', $message)) }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="date" id="child_siblings_dateofbirth2" name="child_siblings_dateofbirth2" class="form-control @error('child_siblings_dateofbirth2') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('child_siblings_dateofbirth2', $transaction->child_siblings_dateofbirth2) }}" >
                        @error('child_siblings_dateofbirth2') <div class="invalid-feedback">{{ str_replace('child siblings2', 'child/sibling', str_replace('child siblings dateofbirth2', 'birth date', $message)) }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" id="child_siblings3" name="child_siblings3" class="form-control text-uppercase @error('child_siblings3') is-invalid @enderror" placeholder="Children / Siblings" value="{{ old('child_siblings3', $transaction->child_siblings3) }}" >
                        @error('child_siblings3') <div class="invalid-feedback">{{ str_replace('child siblings3', 'child/sibling', str_replace('child siblings dateofbirth3', 'birth date', $message)) }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="date" id="child_siblings_dateofbirth3" name="child_siblings_dateofbirth3" class="form-control @error('child_siblings_dateofbirth3') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('child_siblings_dateofbirth3', $transaction->child_siblings_dateofbirth3) }}" >
                        @error('child_siblings_dateofbirth3') <div class="invalid-feedback">{{ str_replace('child siblings3', 'child/sibling', str_replace('child siblings dateofbirth3', 'birth date', $message)) }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" id="child_siblings4" name="child_siblings4" class="form-control text-uppercase @error('child_siblings4') is-invalid @enderror" placeholder="Children / Siblings" value="{{ old('child_siblings4', $transaction->child_siblings4) }}" >
                        @error('child_siblings4') <div class="invalid-feedback">{{ str_replace('child siblings4', 'child/sibling', str_replace('child siblings dateofbirth4', 'birth date', $message)) }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="date" id="child_siblings_dateofbirth4" name="child_siblings_dateofbirth4" class="form-control @error('child_siblings_dateofbirth4') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('child_siblings_dateofbirth4', $transaction->child_siblings_dateofbirth4) }}" >
                        @error('child_siblings_dateofbirth4') <div class="invalid-feedback">{{ str_replace('child siblings4', 'child/sibling', str_replace('child siblings dateofbirth4', 'birth date', $message)) }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="reason">Reason</label>
                        <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" placeholder="Reason for Edit">{{ old('reason', $transaction->reason) }}</textarea>
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