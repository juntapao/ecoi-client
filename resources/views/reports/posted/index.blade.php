@extends('layouts.app')
@section('search', route('posted.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Posted Transactions</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Reports</li>
                <li class="breadcrumb-item active" aria-current="page">Posted Transactions</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            {{-- <a href="{{ route('posted.create') }}" class="btn btn-sm btn-neutral loading">Add</a> --}}
            <a href="{{ route('posted.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
        </div>
    </div>
    <form action="{{ route('posted.filter') }}" method="get">
        <div class="row container">
            <div class="form-group col-12 col-md-4 col-lg-3">
                <strong class="text-secondary">Date From</strong>
                <input type="date" id="date_from" name="date_from" class="form-control @error('date_from') is-invalid @enderror" value="{{ isset($date_from) ? $date_from : old('date_from') }}" />
                {{-- <input type="date" id="date_from" name="date_from" class="form-control @error('date_from') is-invalid @enderror" value="{{ $date_from }}" /> --}}
                {{-- @error('date_from') <div class="invalid-feedback">{{ $message }} </div> @enderror --}}
            </div>
            <div class="form-group col-12 col-md-4 col-lg-3">
                <strong class="text-secondary">Date To</strong>
                <input type="date" id="date_to" name="date_to" class="form-control @error('date_to') is-invalid @enderror" value="{{ isset($date_to) ? $date_to : old('date_to') }}" />
                {{-- @error('date_to') <div class="invalid-feedback">{{ $message }} </div> @enderror --}}
            </div>
            <div class="col-12 col-md-4 col-lg-3"><br />
                <button type="submit" class="btn btn-success loading">Filter</button>
            </div>
        </div>
    </form>
@endsection
@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>COI Number</th>
                        <th>Ticket number</th>
                        <th>Insured Name</th>
                        <th>Transaction Type</th>
                        <th>Branch</th>
                        <th>Date</th>
                        {{-- <th>Status</th> --}}
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @if(count($transactions) > 0)
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->coi_number }}</td>
                                <td>{{ $transaction->ticket_number }}</td>
                                <td>{{ $transaction->insured_name }}</td>
                                <td>{{ App\Http\Controllers\CommonController::getTransactionType($transaction->type) }}</td>
                                <td>{{ $transaction->userbranch }}</td>
                                <td>{{ $transaction->date_issued ? Carbon\Carbon::parse($transaction->date_issued)->format('m/d/Y') : null }}</td>
                                {{-- <td>{{ $transaction->status }}</td> --}}
                                <td class="text-center">
                                    <a href="{{ route('posted.show', $transaction->id) }}" class="btn btn-sm btn-success loading" >Show</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="7" class="text-center">No records found</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer py-4">
            <div class="row">
                <div class="col text-left">Showing {{ $transactions->count() }} out of {{ $transactions->total() }} record(s)</div>
                <div>{{ $transactions->links() }}</div>
            </div>
        </div>
    </div>
@endsection