@extends('layouts.app')
@section('search', route('roles.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Uploading</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item active" aria-current="page">Uploading</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Upload Excel Data</h3>
                </div> 
            </div>
        </div>
        <div class="card-header border-0">
            <form method="post" action="{{ route('uploading.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="select_file">Select Excel File</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <input type="file" id="select_file" name="select_file" class="form-control @error('select_file') is-invalid @enderror" placeholder="" value="{{ old('select_file') }}" />
                            @error('select_file') <div class="invalid-feedback">{{ $message }} </div> @enderror
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <button type="submit" class="btn btn-success loading">Upload</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">   
        <div class="table-responsive">
            <table id="all_transaction" class="table table-sm align-items-center table-flush table-hover">
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
                                    <a href="{{ route('uploading.show', $transaction->id) }}" class="btn btn-sm btn-success loading">Show</a>
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
