@extends('layouts.app')
@section('search', route('backup_transaction.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-8">
            <h6 class="h2 text-white d-inline-block mb-0">Backup Transaction</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item active" aria-current="page">Backup Transaction</li>
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
        <div class="table-responsive">
            <table class="table table-sm align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>COI Number</th>
                        <th>Policy Number</th>
                        <th>Insured Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @if(count($transactions) > 0)
                        @foreach($transactions as $transaction)
                            <tr @if($transaction->status == 'edited') class="table-primary" data-toggle="tooltip" data-placement="bottom" title="This record has been modified" @endif>
                                <td>{{$transaction->coi_number}}</td>
                                <td>{{$transaction->policy_number}}</td>
                                <td>{{$transaction->insured_name}}</td>
                                <td class="text-center">
                                    <a href="{{ route('backup_transaction.show', $transaction->id) }}" class="btn btn-sm btn-success loading">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="4" class="text-center">No transactions found</td></tr>
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

