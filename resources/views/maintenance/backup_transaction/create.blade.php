@extends('layouts.app')
@section('search', route('backup_transaction.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-8">
            <h6 class="h2 text-white d-inline-block mb-0">Backup Transaction</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item"><a href="{{ route('backup_transaction.index') }}">Backup Transaction</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-4 text-right">
            <a href="{{ route('backup_transaction.create') }}" class="btn btn-sm btn-neutral loading">Backup</a>
            <a href="{{ route('backup_transaction.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
        <div class="container">
            <form method="post" action="{{ route('backup_transaction.get') }}" novalidate class="row">
                @csrf
                <div class="form-group col-md-4">
                    <label for="coi_number">COI Number</label>
                    <input type="text" name="coi_number" class="form-control @error('coi_number') is-invalid @enderror" placeholder="COI Number" value="{{ old('coi_number') }}" />
                    @error('coi_number') <div class="invalid-feedback">{{ $message }} </div> @enderror
                </div>
                <div class="form-group col-md-1"><br />
                    <button type="submit" class="btn btn-info loading mt-2">View</button>
                </div>
            </form>
        </div>

        @if(isset($transaction))
            <div class="container">
                <table class="table table-sm">
                    <tbody>
                        @if($transaction->coi_number) <tr><td class="text-right"><b>COI Number</b></td><td>{{ $transaction->coi_number }}</td></tr> @endif
                        @if($transaction->kpt_number) <tr><td class="text-right"><b>KPT Number</b></td><td>{{ $transaction->kpt_number }}</td></tr> @endif
                        @if($transaction->policy_number) <tr><td class="text-right"><b>Policy Number</b></td><td>{{ $transaction->policy_number }}</td></tr> @endif
                        @if($transaction->bos_entry_number) <tr><td class="text-right"><b>BOS Entry Number</b></td><td>{{ $transaction->bos_entry_number }}</td></tr> @endif
                        @if($transaction->ticket_number) <tr><td class="text-right"><b>Ticket Number</b></td><td>{{ $transaction->ticket_number }}</td></tr> @endif
                        @if($transaction->insured_name) <tr><td class="text-right"><b>Insured Name</b></td><td>{{ $transaction->insured_name }}</td></tr> @endif
                        @if($transaction->address) <tr><td class="text-right"><b>Address</b></td><td>{{ $transaction->address }}</td></tr> @endif
                        @if($transaction->civil_status) <tr><td class="text-right"><b>Civil Status</b></td><td>{{ $transaction->civil_status }}</td></tr> @endif
                        @if($transaction->beneficiary) <tr><td class="text-right"><b>Beneficiary</b></td><td>{{ $transaction->beneficiary }}</td></tr> @endif
                        @if($transaction->relationship) <tr><td class="text-right"><b>Relationship</b></td><td>{{ $transaction->relationship }}</td></tr> @endif
                        @if($transaction->dateofbirth) <tr><td class="text-right"><b>Date of Birth</b></td><td>{{ $transaction->dateofbirth }}</td></tr> @endif
                        @if($transaction->guardian) <tr><td class="text-right"><b>Guardian / Parent 1</b></td><td>{{ $transaction->guardian }}</td></tr> @endif
                        @if($transaction->guardian_dateofbirth) <tr><td class="text-right"><b>Guardian / Parent 1 Birth Date</b></td><td>{{ $transaction->guardian_dateofbirth }}</td></tr> @endif
                        @if($transaction->guardian2) <tr><td class="text-right"><b>Guardian / Parent 2</b></td><td>{{ $transaction->guardian2 }}</td></tr> @endif
                        @if($transaction->guardian_dateofbirth2) <tr><td class="text-right"><b>Guardian / Parent 1 Birth Date</b></td><td>{{ $transaction->guardian_dateofbirth2 }}</td></tr> @endif
                        @if($transaction->child_siblings) <tr><td class="text-right"><b>Child / Sibling 1</b></td><td>{{ $transaction->child_siblings }}</td></tr> @endif
                        @if($transaction->child_siblings_dateofbirth) <tr><td class="text-right"><b>Child / Sibling 1</b></td><td>{{ $transaction->child_siblings_dateofbirth }}</td></tr> @endif
                        @if($transaction->child_siblings2) <tr><td class="text-right"><b>Child / Sibling 2</b></td><td>{{ $transaction->child_siblings2 }}</td></tr> @endif
                        @if($transaction->child_siblings_dateofbirth2) <tr><td class="text-right"><b>Child / Sibling 2</b></td><td>{{ $transaction->child_siblings_dateofbirth2 }}</td></tr> @endif
                        @if($transaction->child_siblings3) <tr><td class="text-right"><b>Child / Sibling 3</b></td><td>{{ $transaction->child_siblings3 }}</td></tr> @endif
                        @if($transaction->child_siblings_dateofbirth3) <tr><td class="text-right"><b>Child / Sibling 3</b></td><td>{{ $transaction->child_siblings_dateofbirth3 }}</td></tr> @endif
                        @if($transaction->child_siblings4) <tr><td class="text-right"><b>Child / Sibling 4</b></td><td>{{ $transaction->child_siblings4 }}</td></tr> @endif
                        @if($transaction->child_siblings_dateofbirth4) <tr><td class="text-right"><b>Child / Sibling 4</b></td><td>{{ $transaction->child_siblings_dateofbirth4 }}</td></tr> @endif
                        @if($transaction->type) <tr><td class="text-right"><b>Type</b></td><td>{{ $transaction->type }}</td></tr> @endif
                        @if($transaction->units) <tr><td class="text-right"><b>Units</b></td><td>{{ $transaction->units }}</td></tr> @endif
                        @if($transaction->price) <tr><td class="text-right"><b>Price</b></td><td>{{ $transaction->price }}</td></tr> @endif
                        @if($transaction->date_issued) <tr><td class="text-right"><b>Date Issued</b></td><td>{{ $transaction->date_issued }}</td></tr> @endif
                        @if($transaction->status) <tr><td class="text-right"><b>Status</b></td><td>{{ $transaction->status }}</td></tr> @endif
                        @if($transaction->posted) <tr><td class="text-right"><b>Posted</b></td><td>{{ $transaction->posted }}</td></tr> @endif
                        @if($transaction->userbranch) <tr><td class="text-right"><b>Branch</b></td><td>{{ $transaction->userbranch }}</td></tr> @endif
                        @if($transaction->reason) <tr><td class="text-right"><b>Reason</b></td><td>{{ $transaction->reason }}</td></tr> @endif
                        @if($transaction->userid_created) <tr><td class="text-right"><b>Created By</b></td><td>{{ $transaction->userid_created }}</td></tr> @endif
                        @if($transaction->userid_modified) <tr><td class="text-right"><b>Modified By</b></td><td>{{ $transaction->userid_modified }}</td></tr> @endif
                    </tbody>
                </table>
                
                <form method="post" action="{{ route('backup_transaction.store') }}" novalidate>
                    @csrf
                    <input name="id" type="hidden" @if(isset($transaction)) value="{{ $transaction->id }}" @endif />
                    <div class="text-right">
                        {{-- <a href="{{ route('coi_a.index') }}" class="btn btn-danger">Cancel</a> --}}
                        <button type="submit" class="btn btn-danger loading mt-2">Backup</button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
