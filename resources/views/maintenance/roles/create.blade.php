@extends('layouts.app')
@section('search', route('roles.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Roles</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Maintenance</li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
        </div>
    </div>
    <div class="card-header border-0">
        <form method="post" action="{{ route('roles.store') }}">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="role_name">Role Name</label>
                        <input type="text" id="role_name" name="role_name" class="form-control @error('role_name') is-invalid @enderror" placeholder="Role Name" value="{{ old('role_name') }}" />
                        @error('role_name') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="access">Menu Access</label>
                        <select class="form-control @error('access') is-invalid @enderror" id="access[]" name="access[]" size="5" multiple>
                            @foreach($parentmenus as $parentmenu)
                                <optgroup label="{{$parentmenu->label}}">
                                    @foreach($childmenus as $childmenu)
                                        @if($parentmenu->id == $childmenu->parent)
                                            <option value={{ $childmenu->name }} @if(in_array($childmenu->name, old('access') ?? [])) selected @endif>{{ $childmenu->label }}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('access') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-success loading">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection