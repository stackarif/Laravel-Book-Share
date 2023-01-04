@extends('backend.layouts.app')

@section('admin-content')

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Authors</h1>

    <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add Authors</a>

  </div>

  <!--Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Author</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="{{route('admin.authors.store')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col-12 mb-2">
                <label for="">Author Name</label>
                <br>
                <input type="text" class="form-control" name="name" placeholder="Author Name">
              </div>
              
              <div class="col-12">
                <label for="">Author Details</label>
                <br>
                <textarea name="description" cols="30" rows="5" class="form-control" placeholder="Author description...."></textarea>
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
          <h6 class="m-0 font-weight-bold text-primary">Author List</h6>
        </div>
        <div class="card-body">
          <table class="table" id="dataTable">
            <thead>
              <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>Link</th>
                <th>Manage</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($authors as $author)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$author->name}}</td>
                <td>{{$author->link}}</td>
                
                <td>
                  <a href="#editModal{{$author->id}}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
                  <a href="#deleteModal{{$author->id}}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a>
                </td>

              </tr>

                <!--Edit Modal -->
              <div class="modal fade" id="editModal{{$author->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Author</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <form action="{{route('admin.authors.update', $author->id)}}" method="POST">
                        @csrf
                        <div class="row">
                          <div class="col-12 mb-2">
                            <label for="">Author Name</label>
                            <br>
                            <input type="text" class="form-control" name="name" value="{{$author->name}}" placeholder="Author Name">
                          </div>
                          
                          <div class="col-12">
                            <label for="">Author Details</label>
                            <br>
                            <textarea name="description" cols="30" rows="5" class="form-control" placeholder="Author description....">{!!$author->description!!}</textarea>
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
              <div class="modal fade" id="deleteModal{{$author->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <form action="{{route('admin.authors.delete', $author->id)}}" method="POST">
                        @csrf
                        <div>
                          {{$author->name}} will be deleted !!
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
              <div class="modal fade" id="deleteModal{{$author->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Author</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
  
                        <form action="{{route('admin.authors.delete', $author->id)}}" method="POST">
                          @csrf
                          <div class="row">
                            <div class="col-12 mb-2">
                              <label for="">Author Name</label>
                              <br>
                              <input type="text" class="form-control" name="name" value="{{$author->name}}" placeholder="Author Name">
                            </div>
                            
                            <div class="col-12">
                              <label for="">Author Details</label>
                              <br>
                              <textarea name="description" cols="30" rows="5" class="form-control" placeholder="Author description....">{!!$author->description!!}</textarea>
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