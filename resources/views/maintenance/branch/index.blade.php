@extends('layouts.app')
@section('search', route('branch.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Branches</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item active" aria-current="page">Branches</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('branch.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('branch.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Region Name</th>
                        <th>Area Name</th>
                        <th>Branch Name</th>
                        <th>City</th>
                        <th>Provice</th>
                        <th>Code</th>
                        <th class="text-center">Users Count</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @if(count($branches) > 0)
                        @foreach($branches as $branch)
                            <tr>
                                <td>{{ $branch->area->region->region_name }}</td>
                                <td>{{ $branch->area->area_name }}</td>
                                <td>{{ $branch->branch_name }}</td>
                                <td>{{ $branch->city }}</td>
                                <td>{{ $branch->province }}</td>
                                <td>{{ $branch->code }}</td>
                                <td class="text-center">{{ number_format($branch->users->count(), 0) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('branch.edit', $branch->id) }}" class="btn btn-sm btn-warning loading" >Edit</a>  
                                    <a href="{{ route('branch.show', $branch->id) }}" class="btn btn-sm btn-success loading" >Show</a>
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
                <div class="col text-left">Showing {{ $branches->count() }} out of {{ $branches->total() }} record(s)</div>
                <div>{{ $branches->links() }}</div>
            </div>
        </div>
    </div>
@endsection