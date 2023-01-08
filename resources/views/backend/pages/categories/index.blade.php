@extends('backend.layouts.app')

@section('admin-content')

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Category</h1>

    <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add Categories</a>

  </div>
  @include('backend.layouts.partials.messages')

  <!--Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="{{route('admin.categories.store')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col-6 mb-2">
                <label for="category_name">Category Name</label>
                <br>
                <input type="text" id="category_name" class="form-control" name="name" placeholder="">
              </div>
              <div class="col-6 mb-2">
                <label for="category_url">Category URL Text</label>
                <br>
                <input type="text" id="category_url" class="form-control" name="slug" placeholder="Category Slug, e.g, c-programming">
              </div>
              <div class="col-6 mb-2">
                <label for="parent_id">Parent Category</label>
                <br>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">Select a category</option>
                    @foreach ($parent_categories as $parent)
                    <option value="{{$parent->id}}">{{$parent->name}}</option>
                        
                    @endforeach

                </select>
              </div>
              
              <div class="col-12">
                <label for="category_details">Category Details</label>
                <br>
                <textarea name="description" id="category_details" cols="30" rows="5" class="form-control" placeholder="Category details...."></textarea>
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
          <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
        </div>
        <div class="card-body">
          <table class="table" id="dataTable">
            <thead>
              <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>URL</th>
                <th>Parent</th>
                <th>Manage</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$category->name}}</td>
                <td><a href="{{route('categories.show',$category->slug)}}" target="blank"> {{route('categories.show',$category->slug)}} </a> </td>
                <td>
                    @if (!is_null($category->parent_category($category->parent_id)))
                    {{ $category->parent_category($category->parent_id)->name }}
                    @else
                    --
                        
                    @endif
                </td>
                
                <td>
                  <a href="#editModal{{$category->id}}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
                  <a href="#deleteModal{{$category->id}}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a>
                </td>

              </tr>

                <!--Edit Modal -->
              <div class="modal fade" id="editModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <form action="{{route('admin.categories.update', $category->id)}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-2">
                              <label for="category_name">Category Name</label>
                              <br>
                              <input type="text" id="category_name" class="form-control" name="name" value="{{$category->name}}" placeholder="">
                            </div>
                            <div class="col-6 mb-2">
                              <label for="category_url">Category URL Text</label>
                              <br>
                              <input type="text" id="category_url" class="form-control" name="slug" value="{{$category->slug}}" placeholder="Category Slug, e.g, c-programming">
                            </div>
                            <div class="col-6 mb-2">
                              <label for="parent_id">Parent Category</label>
                              <br>
                              <select name="parent_id" id="parent_id" class="form-control">
                                  <option value="">Select a category</option>
                                  @foreach ($parent_categories as $parent)
                               
                                  <option value="{{$parent->id}}" {{$category->parent_id == $parent->id ? 'selected' : ''}}> {{$parent->name}}</option>
                                      
                                  @endforeach
              
                              </select>
                            </div>
                            
                            <div class="col-12">
                              <label for="category_details">Category Details</label>
                              <br>
                              <textarea name="description" id="category_details" cols="30" rows="5" class="form-control" placeholder="Category details....">{!!$category->description!!}</textarea>
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
              <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <form action="{{route('admin.categories.delete', $category->id)}}" method="POST">
                        @csrf
                        <div>
                          {{$category->name}} will be deleted !!
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
              <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
  
                        <form action="{{route('admin.categories.delete', $category->id)}}" method="POST">
                          @csrf
                          <div class="row">
                            <div class="col-12">
                              <label for="">Category Name</label>
                              <br>
                              <input type="text" class="form-control" name="name" value="{{$category->name}}" placeholder="category Name">
                            </div>
                            
                            <div class="col-12">
                              <label for="">Category Details</label>
                              <br>
                              <textarea name="description" cols="30" rows="5" class="form-control" placeholder="Category description....">{!!$category->description!!}</textarea>
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