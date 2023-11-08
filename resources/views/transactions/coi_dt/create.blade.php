@extends('layouts.app')
@section('search', route('coi_dt.search'))
@section('header')
    <div class="row align-items-center py-4">
        <div class="col-7 col-lg-6">
            <h6 class="h2 text-white d-inline-block mb-0">Family Protect Ten</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ni ni-tv-2"></i></a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item"><a href="{{ route('coi_dt.index') }}">Family Protect Ten</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <div class="col-5 col-lg-6 text-right">
            <a href="{{ route('coi_dt.index') }}" class="btn btn-sm btn-neutral loading">Show All</a>
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
            <div class="col text-right">Issue Date: {{ date('m/d/Y') }}</div>
        </div>
    </div>
    <div class="card-header border-0">
        <form method="post" action="{{ route('coi_dt.store') }}" novalidate>
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="userbranch">ML BRANCH</label>
                        <input type="text" name="userbranch" class="form-control" value="{{ $branch->branch_name }}" readonly>
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="bos_entry_number">BOS Entry No</label>
                        <input type="text" name="bos_entry_number" class="form-control @error('bos_entry_number') is-invalid @enderror" placeholder="BOS Entry No" value="{{ old('bos_entry_number') }}">
                        @error('bos_entry_number') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div> --}}
                    <div class="form-group col-md-4">
                        <label for="units">Number of Units</label>
                        {{-- <input type="number" name="units" class="form-control @error('units') is-invalid @enderror" placeholder="Quantity (Maximum of 5)" value="{{ old('units') }}" /> --}}
                        <select name="units" id="units" class="form-control @error('units') is-invalid @enderror">
                            <option value="1" @if(old('units') == 1)selected @endif>1</option>
                            <option value="2" @if(old('units') == 2)selected @endif>2</option>
                            <option value="3" @if(old('units') == 3)selected @endif>3</option>
                            <option value="4" @if(old('units') == 4)selected @endif>4</option>
                            <option value="5" @if(old('units') == 5)selected @endif>5</option>
                        </select>
                        @error('units') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="insured_name">Principal Insured</label>
                        <input type="text" name="insured_name" class="form-control text-uppercase @error('insured_name') is-invalid @enderror" placeholder="Principal Insured" value="{{ old('insured_name') }}" />
                        @error('insured_name') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dateofbirth">Birth Date <small>(18 - 75 yrs. old)</small></label>
                        <input type="date" name="dateofbirth" class="form-control @error('dateofbirth') is-invalid @enderror" value="{{ old('dateofbirth') }}" />
                        @error('dateofbirth') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div id="civil_status" class="row">
                    <div class="col-12">
                        <label>Civil Status</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="civil_status" id="single" value="Single" checked />
                            <label class="form-check-label" for="single">Single</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="civil_status" id="married" value="Married" @if(old('civil_status') == 'Married') checked @endif />
                            <label class="form-check-label" for="married">Married</label>
                        </div>
                    </div>
                </div>
                {{-- PARENTS / SPOUSE --}}
                <div class="row">
                    <div class="form-group col-md-4">
                        <label id="spouse_parents" for="guardian">Parents</label>
                        <input type="text" id="guardian" name="guardian" class="form-control text-uppercase @error('guardian') is-invalid @enderror" placeholder="Spouse / Parents" value="{{ old('guardian') }}" />
                        @error('guardian') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="relationship_1_1">Relationship</label>
                        <select name="relationship_1_1" id="relationship_1_1" class="dependent_relationship_1 form-control @error('relationship_1_1') is-invalid @enderror">
                            <option value="">- Select -</option>
                            <option value="Father" @if(old('relationship_1_1') == 'Father') selected @endif>Father</option>
                            <option value="Mother" @if(old('relationship_1_1') == 'Mother') selected @endif>Mother</option>
                        </select>
                        @error('relationship_1_1') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="guardian_dateofbirth">Birth Dates <small>(under 65 yrs. old)</small></label>
                        <input type="date" id="guardian_dateofbirth" name="guardian_dateofbirth" class="form-control @error('guardian_dateofbirth') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('guardian_dateofbirth') }}" />
                        @error('guardian_dateofbirth') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div id="dependent_2nd_1" class="row">
                    <div class="form-group col-md-4">
                        <input type="text" id="guardian2" name="guardian2" class="form-control text-uppercase @error('guardian2') is-invalid @enderror" placeholder="Spouse / Parents" value="{{ old('guardian2') }}" />
                        @error('guardian2') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <select name="relationship_1_2" id="relationship_1_2" class="dependent_relationship_1 form-control @error('relationship_1_2') is-invalid @enderror">
                            <option value="">- Select -</option>
                            <option value="Father" @if(old('relationship_1_2') == 'Father') selected @endif>Father</option>
                            <option value="Mother" @if(old('relationship_1_2') == 'Mother') selected @endif>Mother</option>
                        </select>
                        @error('relationship_1_2') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <input type="date" id="guardian_dateofbirth2" name="guardian_dateofbirth2" class="form-control @error('guardian_dateofbirth2') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('guardian_dateofbirth2') }}" />
                        @error('guardian_dateofbirth2') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                {{-- CHILDREN / SIBLING --}}
                <div class="row">
                    <div class="form-group col-md-4">
                        <label id="child_siblings" for="child_siblings">Siblings</label>
                        <input type="text" id="child_siblings" name="child_siblings" class="form-control text-uppercase @error('child_siblings') is-invalid @enderror" placeholder="Children / Siblings" value="{{ old('child_siblings') }}" />
                        @error('child_siblings') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="relationship_2_1">Relationship</label>
                        <select name="relationship_2_1" id="relationship_2_1" class="dependent_relationship_2 form-control @error('relationship_2_1') is-invalid @enderror">
                            <option value="">- Select -</option>
                            <option value="Brother" @if(old('relationship_2_1') == 'Brother') selected @endif>Brother</option>
                            <option value="Sister" @if(old('relationship_2_1') == 'Sister') selected @endif>Sister</option>
                        </select>
                        @error('relationship_2_1') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="child_siblings_dateofbirth">Birth Dates <small>(1 - 21 yrs. old)</small></label>
                        <input type="date" id="child_siblings_dateofbirth" name="child_siblings_dateofbirth" class="form-control @error('child_siblings_dateofbirth') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('child_siblings_dateofbirth') }}" />
                        @error('child_siblings_dateofbirth') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" id="child_siblings2" name="child_siblings2" class="form-control text-uppercase @error('child_siblings2') is-invalid @enderror" placeholder="Children / Siblings" value="{{ old('child_siblings2') }}" />
                        @error('child_siblings2') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <select name="relationship_2_2" id="relationship_2_2" class="dependent_relationship_2 form-control @error('relationship_2_2') is-invalid @enderror">
                            <option value="">- Select -</option>
                            <option value="Brother" @if(old('relationship_2_2') == 'Brother') selected @endif>Brother</option>
                            <option value="Sister" @if(old('relationship_2_2') == 'Sister') selected @endif>Sister</option>
                        </select>
                        @error('relationship_2_2') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <input type="date" id="child_siblings_dateofbirth2" name="child_siblings_dateofbirth2" class="form-control @error('child_siblings_dateofbirth2') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('child_siblings_dateofbirth2') }}" />
                        @error('child_siblings_dateofbirth2') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" id="child_siblings3" name="child_siblings3" class="form-control text-uppercase @error('child_siblings3') is-invalid @enderror" placeholder="Children / Siblings" value="{{ old('child_siblings3') }}" />
                        @error('child_siblings3') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <select name="relationship_2_3" id="relationship_2_3" class="dependent_relationship_2 form-control @error('relationship_2_3') is-invalid @enderror">
                            <option value="">- Select -</option>
                            <option value="Brother" @if(old('relationship_2_3') == 'Brother') selected @endif>Brother</option>
                            <option value="Sister" @if(old('relationship_2_3') == 'Sister') selected @endif>Sister</option>
                        </select>
                        @error('relationship_2_3') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <input type="date" id="child_siblings_dateofbirth3" name="child_siblings_dateofbirth3" class="form-control @error('child_siblings_dateofbirth3') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('child_siblings_dateofbirth3') }}" />
                        @error('child_siblings_dateofbirth3') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="form-group col-md-4">
                        <input type="text" id="child_siblings4" name="child_siblings4" class="form-control text-uppercase @error('child_siblings4') is-invalid @enderror" placeholder="Children / Siblings" value="{{ old('child_siblings4') }}" />
                        @error('child_siblings4') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <select name="relationship_2_4" id="relationship_2_4" class="dependent_relationship_2 form-control @error('relationship_2_4') is-invalid @enderror">
                            <option value="">- Select -</option>
                            <option value="Brother" @if(old('relationship_2_4') == 'Brother') selected @endif>Brother</option>
                            <option value="Sister" @if(old('relationship_2_4') == 'Sister') selected @endif>Sister</option>
                        </select>
                        @error('relationship_2_4') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <input type="date" id="child_siblings_dateofbirth4" name="child_siblings_dateofbirth4" class="form-control @error('child_siblings_dateofbirth4') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('child_siblings_dateofbirth4') }}" />
                        @error('child_siblings_dateofbirth4') <div class="invalid-feedback">{{ $message }} </div> @enderror
                    </div>
                </div> --}}
            </div>
            {{-- <input name="coi_number" id="coi_number" type="hidden" value="{{$policy_series->coi_no}}"> --}}
            {{-- <input name="date_issued" id="date_issued" type="hidden" value="{{$datenow}}"> --}}
            {{-- <input name="policyno" id="policyno" type="hidden" value="MM-03-{{$polyear}}-CB-{{$policy_series->series}}"> --}}
            <div class="text-right">
                {{-- <a href="{{ route('coi_dt.index') }}" class="btn btn-danger">Cancel</a> --}}
                <button type="submit" class="btn btn-success loading">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('more-scripts')
<script defer>
    $('#civil_status input').click(function() {
        var $dr1 = $('.dependent_relationship_1');
        $dr1.children().remove();
        $dr1.append($('<option />').val('').text('- Select -'));

        var $dr2 = $('.dependent_relationship_2');
        $dr2.children().remove();
        $dr2.append($('<option />').val('').text('- Select -'));

        if($('#single').is(':checked')) {

            $('#spouse_parents').html('Parents');
            $('#child_siblings').html('Siblings');
            
            $('#dependent_2nd_1').show();
            
            $dr1.append($('<option />').val('Father').text('Father'));
            $dr1.append($('<option />').val('Mother').text('Mother'));
            $dr2.append($('<option />').val('Brother').text('Brother'));
            $dr2.append($('<option />').val('Sister').text('Sister'));

        } else if($('#married').is(':checked')) {

            $('#spouse_parents').html('Spouse');
            $('#child_siblings').html('Children');

            $('#dependent_2nd_1').hide();

            $dr1.append($('<option />').val('Husband').text('Husband'));
            $dr1.append($('<option />').val('Wife').text('Wife'));
            $dr2.append($('<option />').val('Children').text('Children'));

        }
    });
</script>
@endsection