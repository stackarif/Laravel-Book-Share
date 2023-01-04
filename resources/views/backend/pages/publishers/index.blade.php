@extends('backend.layouts.app')

@section('admin-content')

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Publisher</h1>

    <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add publishers</a>

  </div>
  @include('backend.layouts.partials.messages')

  <!--Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Publisher</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="{{route('admin.publishers.store')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col-6 mb-2">
                <label for="">Publisher Name</label>
                <br>
                <input type="text" class="form-control" name="name" placeholder="">
              </div>
              <div class="col-6 mb-2">
                <label for="">Publisher Link</label>
                <br>
                <input type="text" class="form-control" name="link" placeholder="">
              </div>
              <div class="col-6 mb-2">
                <label for="">Publisher Address</label>
                <br>
                <input type="text" class="form-control" name="address" placeholder="">
              </div>
              <div class="col-6 mb-2">
                <label for="">Publisher Outlet</label>
                <br>
                <input type="text" class="form-control" name="outlet" placeholder="">
              </div>
              
              <div class="col-12">
                <label for="">Publisher Details</label>
                <br>
                <textarea name="description" cols="30" rows="5" class="form-control" placeholder="Publisher details...."></textarea>
              </div>
            </div>
            <div class="mt-4">
              <button type="submit" class="btn btn-primary">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
          </form>
        
        </div>

      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-sm-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">publisher List</h6>
        </div>
        <div class="card-body">
          <table class="table" id="dataTable">
            <thead>
              <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>Link</th>
                <th>Address</th>
                <th>Outlet</th>
                <th>Manage</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($publishers as $publisher)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$publisher->name}}</td>
                <td>{{$publisher->link}}</td>
                <td>{{$publisher->address}}</td>
                <td>{{$publisher->outlet}}</td>
                
                <td>
                  <a href="#editModal{{$publisher->id}}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
                  <a href="#deleteModal{{$publisher->id}}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a>
                </td>

              </tr>

                <!--Edit Modal -->
              <div class="modal fade" id="editModal{{$publisher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit publisher</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <form action="{{route('admin.publishers.update', $publisher->id)}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-2">
                              <label for="">Publisher Name</label>
                              <br>
                              <input type="text" class="form-control" name="name" value="{{$publisher->name}}" placeholder="">
                            </div>
                            <div class="col-6 mb-2">
                              <label for="">Publisher Link</label>
                              <br>
                              <input type="text" class="form-control" name="link" value="{{$publisher->link}}" placeholder="">
                            </div>
                            <div class="col-6 mb-2">
                              <label for="">Publisher Address</label>
                              <br>
                              <input type="text" class="form-control" name="address" value="{{$publisher->address}}" placeholder="">
                            </div>
                            <div class="col-6 mb-2">
                              <label for="">Publisher Outlet</label>
                              <br>
                              <input type="text" class="form-control" name="outlet" value="{{$publisher->outlet}}" placeholder="">
                            </div>
                            
                            <div class="col-12">
                              <label for="">Publisher Details</label>
                              <br>
                              <textarea name="description" cols="30" rows="5" class="form-control" placeholder="Publisher details....">{!!$publisher->description!!}"</textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          
                        </div>
                      </form>
                    
                    </div>

                  </div>
                </div>
              </div>
                  <!--Edit Modal -->
              <div class="modal fade" id="deleteModal{{$publisher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <form action="{{route('admin.publishers.delete', $publisher->id)}}" method="POST">
                        @csrf
                        <div>
                          {{$publisher->name}} will be deleted !!
                        </div>
                        <div class="mt-4">
                          <button type="submit" class="btn btn-primary">Ok, Confirm</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          
                        </div>
                      </form>
                    
                    </div>

                  </div>
                </div>
              </div>
                <!--Delet Modal -->
              <div class="modal fade" id="deleteModal{{$publisher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit publisher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
  
                        <form action="{{route('admin.publishers.delete', $publisher->id)}}" method="POST">
                          @csrf
                          <div class="row">
                            <div class="col-12">
                              <label for="">publisher Name</label>
                              <br>
                              <input type="text" class="form-control" name="name" value="{{$publisher->name}}" placeholder="publisher Name">
                            </div>
                            
                            <div class="col-12">
                              <label for="">publisher Details</label>
                              <br>
                              <textarea name="description" cols="30" rows="5" class="form-control" placeholder="publisher description....">{!!$publisher->description!!}</textarea>
                            </div>
                          </div>
                          <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            
                          </div>
                        </form>
                      
                      </div>
  
                    </div>
                  </div>
              </div>  
                  
              @endforeach
             
            </tbody>
          </table>
          
        </div>
      </div>
    </div>

  </div>
    
@endsection