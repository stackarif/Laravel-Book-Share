@extends('backend.layouts.app')

@section('admin-content')

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage book</h1>

    <a href="{{route('admin.books.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add books</a>

  </div>
  @include('backend.layouts.partials.messages')



  <!-- Content Row -->
  <div class="row">

    <div class="col-sm-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">book List</h6>
        </div>
        <div class="card-body">
          <table class="table" id="dataTable">
            <thead>
              <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>URL</th>
                <th>Category</th>
                <th>Publisher</th>
                <th>Statistics</th>
                <th>Status</th>
                <th>Manage</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($books as $book)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$book->title}}</td>
                <td><a href="{{route('books.show',$book->slug)}}" target="blank"> {{route('books.show',$book->slug)}} </a> </td>
                <td>
                    {{$book->category->name ?? NULL}}
                  
                </td>
                <td>
                    {{$book->publisher->name ?? NULL}}
                  
                </td>

                <td>
                    <i class="fa fa-eye"></i>{{$book->total_view}}
                    <br>
                    <i class="fa fa-search"></i>{{$book->total_search}}
                </td>
                <td>
                    @if ($book->is_approved)
                    <span class="badge badge-success">
                        <i class="fa fa-check"></i>Approved
                         
                    </span>
                    @else
                    <span class="badge badge-danger">
                        <i class="fa fa-times"></i>Not Approved
                         
                    </span>
                        
                    @endif
                </td>
                
                <td>
                  <a href="{{route('admin.books.edit', $book->id)}}" class="btn btn-success" ><i class="fa fa-edit"></i> Edit</a>
                  <a href="#deleteModal{{$book->id}}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a>
                </td>

              </tr>

                <!--Delet Modal -->
                <div class="modal fade" id="deleteModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
  
                        <form action="{{route('admin.books.delete', $book->id)}}" method="POST">
                          @csrf
                          <div class="row">
                            <div class="col-12 mb-2">
                              <label for="">book Name</label>
                              <br>
                              <input type="text" class="form-control" name="name" value="{{$book->name}}" placeholder="book Name">
                            </div>
                            
                            <div class="col-12">
                              <label for="">book Details</label>
                              <br>
                              <textarea name="description" cols="30" rows="5" class="form-control" placeholder="book description....">{!!$book->description!!}</textarea>
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