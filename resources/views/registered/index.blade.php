@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class=" panel-heading">
                    <div class=" row">
                        <div class="col-md-6">E-Certificates
                        </div>
                        <div align="right" class="col-md-3"><font color="blue">EDITED</font>
                        </div>
                        <div class="col-md-3">DEFAULT 
                        </div>
                    </div>
                </div>
               
                <div class="panel-body">
                    <!-- Button trigger modal -->
                    <a type="button"  class="btn btn-primary" data-toggle="modal" data-target=".add">Add</a>

                    
                    <!-- Table -->
                    <div class="sub panel-body">
                        <table id="coi_a" class="table table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>COI No</th>
                                    <th>BOS Entry No</th>
                                    <th>Policy No</th>
                                    <th>Insured Name</th>
                                    <th>No. of Units</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            {{-- {{$transaction}} --}}
                            <tbody>
                                @if (count($transaction)>0)
                                    @foreach ($transaction as $transactions)
                                        <tr>
                                            <td @if ($transactions->status == 'edited')
                                            style="color: blue" @endif>
                                            @if ($transactions->type == 'A')
                                            Family Protect - Plus
                                            @elseif ($transactions->type == 'B')
                                            Pinoy Protect - Plus
                                            @elseif ($transactions->type == 'D')
                                            Family Protect
                                            @elseif ($transactions->type == 'R')
                                            Pawner's Protect
                                            @elseif ($transactions->type == 'AO')
                                            KP Protect
                                            @endif
                                            </td>
                                            <td @if ($transactions->status == 'edited')
                                            style="color: blue" @endif>{{$transactions->coi_number}}</td>
                                            <td @if ($transactions->status == 'edited')
                                            style="color: blue" @endif>{{$transactions->bos_entry_number}}</td>
                                            <td @if ($transactions->status == 'edited')
                                            style="color: blue" @endif>{{$transactions->policy_number}}</td>
                                            <td @if ($transactions->status == 'edited')
                                            style="color: blue" @endif>{{$transactions->insured_name}}</td>
                                            <td @if ($transactions->status == 'edited')
                                            style="color: blue" @endif><center>{{$transactions->units}}</center></td>
                                            <td>
                                            <a 
                                                @if ($transactions->type == 'A')
                                                href="transactions/coi_a/{{$transactions->id}}"
                                                @elseif ($transactions->type == 'A0')
                                                href="transactions/coi_ao/{{$transactions->id}}"
                                                @elseif ($transactions->type == 'B')
                                                href="transactions/coi_b/{{$transactions->id}}"
                                                @elseif ($transactions->type == 'D')
                                                href="transactions/coi_d/{{$transactions->id}}"
                                                @elseif ($transactions->type == 'R')
                                                href="transactions/coi_r/{{$transactions->id}}"
                                                @endif
                                             
                                                
                                                target="_blank" class="btn btn-danger" >Print</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p>No E-Certificate Transaction found</p>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection