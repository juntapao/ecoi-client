@extends('layouts.app')
@section('search', route('coi_c.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Customer Protect 20</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item active" aria-current="page">Customer Protect 20</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('coi_c.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('coi_c.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="table-responsive">
            <table id="coi_c" class="table table-sm align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>COI Number</th>
                        <th>BOS Entry No</th>
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
                                <td>{{$transaction->bos_entry_number}}</td>
                                <td>{{$transaction->policy_number}}</td>
                                <td>{{$transaction->insured_name}}</td>
                                <td class="text-center">
                                    @if($transaction->posted == NULL)
                                        <a href="{{ route('coi_c.edit', Crypt::encrypt($transaction->id)) }}" class="btn btn-sm btn-warning loading" >Edit</a>  
                                        <a href="{{ route('coi_c.post', Crypt::encrypt($transaction->id)) }}" onclick="return confirm('Are you sure you want to Post this transaction?')" class="btn btn-sm btn-primary" >Post</a>
                                    @else
                                        <a href="{{ route('coi_c.edit', Crypt::encrypt($transaction->id)) }}" class="btn btn-sm btn-warning disabled" disabled>Edit</a>  
                                        <a href="{{ route('coi_c.print', Crypt::encrypt($transaction->id)) }}" target="_blank" class="btn btn-sm btn-danger" >Print</a>
                                    @endif
                                    <a href="{{ route('coi_c.show', Crypt::encrypt($transaction->id)) }}" class="btn btn-sm btn-success loading" >Show</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="5" class="text-center">No transactions found</td></tr>
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