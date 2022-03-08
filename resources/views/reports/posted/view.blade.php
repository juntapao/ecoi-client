@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">View User</div>

                <div class="panel-body">
                    @if ($transaction->type == 'A')
                        <form  method="POST" action="{{url("reports/posted/$transaction->id")}}">
                            {{method_field('PATCH')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">ML BRANCH</label>
                                        
                                        <input type="text" id="userbranch" name="userbranch" class="form-control" value="{{$transaction->userbranch}}" placeholder="{{$transaction->userbranch}}" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">BOS Entry No</label>
                                        <input type="text" id="bos_number" name="bos_number" class="form-control" value="{{$transaction->bos_entry_number}}" placeholder="BOS Entry Number" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">No of units</label>
                                        <input type="number" id="no_units" max="5" name="no_units"value="{{$transaction->units}}"  class="form-control" placeholder="Quantity (Maximum of 5)" required>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Principal Insured</label>
                                        <input type="text" id="insuredname" name="insuredname" value="{{$transaction->insured_name}}" class="form-control" placeholder="Insured Name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Birthdates</label>
                                        <input type="date" id="dateofbirth" name="dateofbirth" value="{{$transaction->dateofbirth}}" class="form-control"placeholder="Date of Birth" required>
                                    </div>
                                </div>
                                <div id="civil_status" class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Civil Status</label><br>
                                        <input type="hidden" id="confo" value="{{$transaction->civil_status}}" >
                                        <input type="radio" id="single" name="civil_status" value="Single"  required>Single
                                        
                                        <input type="radio" id="married" name="civil_status" value="Married" required>Married
                                    </div>
                                </div>
                                <!-- Spouse / Parents 1 -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label id="spouse_parents" for="inputPassword4"></label>
                                        <input type="text" id="guardian" name="guardian" class="form-control" value="{{$transaction->guardian}}" placeholder="Spouse / Parents" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Birthdates</label>
                                        <input type="date" id="dateofbirth1" name="dateofbirth1" class="form-control" value="{{$transaction->guardian_dateofbirth}}" placeholder="Date of Birth" required>
                                    </div>
                                </div>
                                <!-- Spouse / Parents 2 -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4"></label>
                                        <input type="text" id="guardian1" name="guardian1" class="form-control" value="{{$transaction->guardian2}}" placeholder="Spouse / Parents" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4"></label>
                                        <input type="date" id="dateofbirth2" name="dateofbirth2" class="form-control" value="{{$transaction->guardian_dateofbirth2}}" placeholder="Date of Birth" >
                                    </div>
                                </div>


                                <!-- child/sibling 1 -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label id="child_siblings" for="inputPassword4"></label>
                                        <input type="text" id="child_siblings" name="child_siblings" class="form-control" value="{{$transaction->child_siblings}}" placeholder="Children / Siblings" >
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="inputPassword4">Birthdates</label>
                                            <input type="date" id="dateofbirth3" name="dateofbirth3" class="form-control" value="{{$transaction->child_siblings_dateofbirth}}" placeholder="Date of Birth" >
                                    </div>
                                </div>
                                <!-- child/sibling 2 -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4"></label>
                                        <input type="text" id="child_siblings1" name="child_siblings1" class="form-control" value="{{$transaction->child_siblings2}}"placeholder="Children / Siblings" >
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="inputPassword4"></label>
                                            <input type="date" id="dateofbirth4" name="dateofbirth4" class="form-control" value="{{$transaction->child_siblings_dateofbirth2}}" placeholder="Date of Birth" >
                                    </div>
                                </div>
                                <!-- child/sibling 3 -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4"></label>
                                        <input type="text" id="child_siblings2" name="child_siblings2" class="form-control" value="{{$transaction->child_siblings3}}"placeholder="Children / Siblings" >
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="inputPassword4"></label>
                                            <input type="date" id="dateofbirth5" name="dateofbirth5" class="form-control" value="{{$transaction->child_siblings_dateofbirth3}}" placeholder="Date of Birth" >
                                    </div>
                                </div>
                                <!-- child/sibling 4 -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4"></label>
                                        <input type="text" id="child_siblings3" name="child_siblings3" class="form-control" value="{{$transaction->child_siblings4}}"placeholder="Children / Siblings" >
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="inputPassword4"></label>
                                            <input type="date" id="dateofbirth6" name="dateofbirth6" class="form-control" value="{{$transaction->child_siblings_dateofbirth4}}" placeholder="Date of Birth" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Reason</label>
                                        <input type="text" id="reason" name="reason" class="form-control" value="{{$transaction->reason}}"placeholder="Children / Siblings" >
                                    </div>
                                </div>
                        
                            </div>
                            <div class="modal-footer">
                                <a href="/mlhuillier/public/reports/posted" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                                {{-- <a type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger" >Delete</a>
                                <button type="submit" class="btn btn-success">Save</button> --}}
                            </div>
                        </form>
                    @endif

                    @if ($transaction->type == 'AO')
                        <form  method="POST" action="{{url("reports/posted/$transaction->id")}}">
                            {{method_field('PATCH')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">ML BRANCH</label>
                                        
                                        <input type="text" id="userbranch" name="userbranch" class="form-control" value="{{$transaction->userbranch}}" placeholder="{{$transaction->userbranch}}" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">KPT Number</label>
                                        <input type="text" id="kpt_number" name="kpt_number" class="form-control" value="{{$transaction->kpt_number}}" placeholder="KPT Number" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">No of units</label>
                                        <input type="number" id="no_units" max="5" name="no_units"value="{{$transaction->units}}"  class="form-control" placeholder="Quantity (Maximum of 5)" required>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Insured KP Sender/Receiver</label>
                                        <input type="text" id="insuredname" name="insuredname" class="form-control" value="{{$transaction->insured_name}}" placeholder="Insured Name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Beneficiary</label>
                                        <input type="text" id="beneficiary" name="beneficiary" class="form-control" value="{{$transaction->beneficiary}}" placeholder="Beneficiary" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Reason</label>
                                        <input type="text" id="reason" name="reason" value="{{$transaction->reason}}" class="form-control" placeholder="Reason for Edit" >
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="/mlhuillier/public/reports/posted" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                                {{-- <a type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger" >Delete</a>
                                <button type="submit" class="btn btn-success">Save</button> --}}
                            </div>
                        </form>
                    @endif
                    @if ($transaction->type == 'B')
                        <form  method="POST" action="{{url("reports/posted/$transaction->id")}}">
                            {{method_field('PATCH')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">ML BRANCH</label>
                                        <input type="text" id="userbranch" name="userbranch" class="form-control" value="{{$transaction->userbranch}}" placeholder="{{$transaction->userbranch}}" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">BOS Entry Number</label>
                                        <input type="text" id="bos_number" name="bos_number" class="form-control" value="{{$transaction->bos_entry_number}}" placeholder="BOS Entry Number" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">No of units</label>
                                        <input type="number" id="no_units" max="5" name="no_units"value="{{$transaction->units}}"  class="form-control" placeholder="Quantity (Maximum of 5)" required>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Name of insured</label>
                                        <input type="text" id="insuredname" name="insuredname" class="form-control" value="{{$transaction->insured_name}}" placeholder="Insured Name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Date of Birth</label>
                                        <input type="date" id="dateofbirth" name="dateofbirth" class="form-control" value="{{$transaction->dateofbirth}}" placeholder="Date of Birth" required>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="inputPassword4">Address</label>
                                            <input type="text" id="address" name="address"value="{{$transaction->address}}" class="form-control" placeholder="Address" required>
                                        </div>
                                    
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Beneficiary</label>
                                        <input type="text" id="beneficiary" name="beneficiary" class="form-control" value="{{$transaction->beneficiary}}" placeholder="Beneficiary" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Relationship</label>
                                        <input type="text" id="relationship" name="relationship" value="{{$transaction->relationship}}" class="form-control" placeholder="relationship" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Reason</label>
                                        <input type="text" id="reason" name="reason" class="form-control" value="{{$transaction->reason}}" placeholder="Reason for Edit" >
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="/mlhuillier/public/reports/posted" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                                {{-- <a type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger" >Delete</a>
                                <button type="submit" class="btn btn-success">Save</button> --}}
                            </div>
                        </form>
                    @endif
                    @if ($transaction->type == 'D')
                        <form  method="POST" action="{{url("reports/posted/$transaction->id")}}">
                            {{method_field('PATCH')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">ML BRANCH</label>
                                        <input type="text" id="userbranch" name="userbranch" class="form-control" value="{{$transaction->userbranch}}" placeholder="{{$transaction->userbranch}}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">No of units</label>
                                        <input type="number" id="no_units" max="5" name="no_units"value="{{$transaction->units}}"  class="form-control" placeholder="Quantity (Maximum of 5)" required>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Name of insured</label>
                                        <input type="text" id="insuredname" name="insuredname" class="form-control" value="{{$transaction->insured_name}}" placeholder="Insured Name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Date of Birth</label>
                                        <input type="date" id="dateofbirth" name="dateofbirth" class="form-control" value="{{$transaction->dateofbirth}}" placeholder="Date of Birth" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Beneficiary</label>
                                        <input type="text" id="beneficiary" name="beneficiary" class="form-control" value="{{$transaction->beneficiary}}" placeholder="Beneficiary" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Relationship</label>
                                        <input type="text" id="relationship" name="relationship" value="{{$transaction->relationship}}" class="form-control" placeholder="relationship" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Reason</label>
                                        <input type="text" id="reason" name="reason" value="{{$transaction->reason}}" class="form-control" placeholder="Reason for Edit">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="/mlhuillier/public/reports/posted" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                                {{-- <a type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger" >Delete</a>
                                <button type="submit" class="btn btn-success">Save</button> --}}
                            </div>
                        </form>
                    @endif
                    @if ($transaction->type == 'R')
                        <form  method="POST" action="{{url("reports/posted/$transaction->id")}}">
                            {{method_field('PATCH')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">ML BRANCH</label>
                                        
                                        <input type="text" id="userbranch" name="userbranch" class="form-control" value="{{$transaction->userbranch}}" placeholder="{{$transaction->userbranch}}" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">PAWN Ticker Number</label>
                                        <input type="text" id="ticket_number" name="ticket_number" class="form-control" value="{{$transaction->ticket_number}}" placeholder="PAWN Ticket Number" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">No of units</label>
                                        <input type="number" id="no_units" max="5" name="no_units"value="{{$transaction->units}}"  class="form-control" placeholder="Quantity (Maximum of 5)" required>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Pawner / Insured</label>
                                        <input type="text" id="insuredname" name="insuredname" class="form-control" value="{{$transaction->insured_name}}" placeholder="Insured Name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Beneficiary</label>
                                        <input type="text" id="beneficiary" name="beneficiary" class="form-control" value="{{$transaction->beneficiary}}" placeholder="Beneficiary" required>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Reason</label>
                                        <input type="text" id="reason" name="reason" value="{{$transaction->reason}}" class="form-control" placeholder="Reason for Edit" >
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="/mlhuillier/public/reports/posted" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                                {{-- <a type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger" >Delete</a>
                                <button type="submit" class="btn btn-success">Save</button> --}}
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection