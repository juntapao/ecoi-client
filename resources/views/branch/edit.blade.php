@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Branch</div>

                <div class="panel-body">
                    <form  method="POST" action="{{url("branch/$branch->id")}}">
                            {{method_field('PATCH')}}
                            {{csrf_field()}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Branch Name</label>
                                    <input type="text" id="branch_name" name="branch_name" class="form-control" value="{{$branch->branch_name}}" id="inputEmail4" placeholder="Branch Name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Code</label>
                                    <input type="text" id="code" name="code" class="form-control" id="inputPassword4" value="{{$branch->code}}" placeholder="Code" required>
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <a href="/mlhuillier/public/branch" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <a type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger" >Delete</a>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>


                    <!-- Delete Modal -->
                    <div class="modal fade" id="delete" name="delete" tabindex="-1" role="dialog" aria-labelledby="addTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="row">
                                        <div class="col-md-8"><h5 class="modal-title" id="exampleModalLongTitle">Delete Record</h5></div>
                                        <div class="col-md-4"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button></div>
                                    </div>
                                </div>
                                <form  method="POST" id="del" action="{{url("branch/$branch->id")}}">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="row">
                                                <div class="col-md-12"><h6 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete <strong> {{$branch->branch_name}} </strong> branch ?</h6></div>
                                        </div> 
                                    </div>
                                    <input type="hidden" id="id" name="id" />
                                    <input type="hidden" id="command" name="command" />

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection