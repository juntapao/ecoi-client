@extends('layouts.app')
@section('search', route('change_password.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Account Password</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Account</li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('change_password.create') }}" class="btn btn-sm btn-neutral loading">Add</a>
            <a href="{{ route('change_password.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>User Name</th>
                        <th>Full Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @if(count($users) > 0)
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->username}}</td>
                                <td>{{$user->full_name}}</td>
                                <td class="text-center">
                                    <a href="{{ route('change_password.edit', $user->id) }}" class="btn btn-sm btn-warning loading" >Edit</a>  
                                    <a href="{{ route('change_password.show', $user->id) }}" class="btn btn-sm btn-success loading" >Show</a>
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
                <div class="col text-left">Showing {{ $users->count() }} out of {{ $users->total() }} record(s)</div>
                <div>{{ $users->links() }}</div>
            </div>
        </div>
    </div>
@endsection