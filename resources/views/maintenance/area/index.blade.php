@extends('layouts.app')
@section('search', route('area.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Areas</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item active" aria-current="page">Areas</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('area.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('area.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Area Name</th>
                        <th>Manager Name</th>
                        <th>Region Name</th>
                        <th class="text-center">Branches</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @if(count($areas) > 0)
                        @foreach($areas as $area)
                            <tr>
                                <td>{{ $area->area_name }}</td>
                                <td>{{ $area->area_manager }}</td>
                                <td>{{ $area->region->region_name }}</td>
                                <td class="text-center">{{ number_format($area->branches->count(), 0) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('area.edit', $area->id) }}" class="btn btn-sm btn-warning loading" >Edit</a>  
                                    <a href="{{ route('area.show', $area->id) }}" class="btn btn-sm btn-success loading" >Show</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="4" class="text-center">No records found</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer py-4">
            <div class="row">
                <div class="col text-left">Showing {{ $areas->count() }} out of {{ $areas->total() }} record(s)</div>
                <div>{{ $areas->links() }}</div>
            </div>
        </div>
    </div>
@endsection