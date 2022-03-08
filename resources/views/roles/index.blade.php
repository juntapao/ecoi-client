@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List of Roles</div>

                <div class="panel-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" id="adds" title="Add a new record" data-tooltip>
                        Add
                    </button>

                    <!-- Table -->
                    <div class="sub panel-body">
                        <table id="role" class="table table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Menu List</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @if (count($roles)>0)
                                    @foreach ($roles as $roless)
                                        <tr>
                                            <td>{{$roless->role_name}}</td>
                                            <td>{{$roless->access}}</td>
                                            <td>
                                               <!--  <form method="POST" action="">  -->
                                                <a href="roles/{{$roless->id}}/edit" class="btn btn-warning" >Edit</a>  
                                                <!-- </form>  -->
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p>No Role found</p>
                                @endif
                            </tbody>

                        </table>
                    </div>

                    <!-- Add Modal -->
                    <div class="modal fade" id="add" name="add" tabindex="-1" role="dialog" aria-labelledby="addTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="row">
                                        <div class="col-md-8"><h5 class="modal-title" id="exampleModalLongTitle"></h5></div>
                                        <div class="col-md-4"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button></div>
                                    </div>
                                </div>
                                <form  method="POST" action="{{url("roles")}}">
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Role Name</label>
                                                <input type="text" id="role_name" name="role_name" class="form-control" id="inputEmail4" placeholder="Role Name" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="inputPassword4">Menu Access</label>
                                                <select class="form-control" id="access[]" name="access[]" size="5" multiple required>
                                                    
                                                    @foreach ($parentmenu as $parentmenus)
                                                        <optgroup label="{{$parentmenus->label}}">
                                                        @foreach ($childmenu as $childmenus)
                                                            @if ($parentmenus->id == $childmenus->parent)
                                                                <option value={{$childmenus->name}}>{{$childmenus->label}}</option>
                                                            @endif
                                                        @endforeach
                                                        </optgroup>

                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="id" name="id" />
                                    <input type="hidden" id="command" name="command" />

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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