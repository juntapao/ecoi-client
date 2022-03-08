@extends('layouts.app')
@section('search', route('region.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Regions</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item active" aria-current="page">Regions</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('region.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('region.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
                        <th>Manager</th>
                        <th class="text-center">Areas Counter</th>
                        <th class="text-center">Branches Counter</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @if(count($regions) > 0)
                        @foreach($regions as $region)
                            @php $total_branches = 0; @endphp
                            @foreach($region->areas as $area)
                                @php $total_branches += $area->branches->count(); @endphp
                            @endforeach
                            <tr>
                                <td>{{ $region->region_name }}</td>
                                <td>{{ $region->region_manager }}</td>
                                <td class="text-center">{{ number_format($region->areas->count(), 0) }}</td>
                                <td class="text-center">{{ $total_branches }}</td>
                                <td class="text-center">
                                    <a href="{{ route('region.edit', $region->id) }}" class="btn btn-sm btn-warning loading" >Edit</a>  
                                    <a href="{{ route('region.show', $region->id) }}" class="btn btn-sm btn-success loading" >Show</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="3" class="text-center">No records found</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer py-4">
            <div class="row">
                <div class="col text-left">Showing {{ $regions->count() }} out of {{ $regions->total() }} record(s)</div>
                <div>{{ $regions->links() }}</div>
            </div>
        </div>
    </div>
@endsection