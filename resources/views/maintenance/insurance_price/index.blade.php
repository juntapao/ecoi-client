@extends('layouts.app')
{{-- @section('search', route('insurance_price.search')) --}}
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Insurance Prices</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item active" aria-current="page">Insurance Prices</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            {{-- <a href="{{ route('insurance_price.create') }}" class="btn btn-sm btn-neutral loading">Add</a> --}}
            <a href="{{ route('insurance_price.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>COI Type</th>
                        <th>Price</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @if(count($prices) > 0)
                        @foreach($prices as $price)
                            <tr>
                                <td>{{ $price->coi_type }}</td>
                                <td>{{ $price->price }}</td>
                                <td class="text-center">
                                    <a href="{{ route('insurance_price.edit', $price->id) }}" class="btn btn-sm btn-warning loading" >Edit</a>  
                                    <a href="{{ route('insurance_price.show', $price->id) }}" class="btn btn-sm btn-success loading" >Show</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr colspan="5"><td>No records found</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer py-4">
            <div class="row">
                <div class="col text-left">Showing {{ $prices->count() }} out of {{ $prices->total() }} record(s)</div>
                <div>{{ $prices->links() }}</div>
            </div>
        </div>
    </div>
@endsection