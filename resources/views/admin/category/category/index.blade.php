@extends('layouts.admin')
@section('admin.content')
 <!-- Dropify -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+Add New</button>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

           <!-- Main content -->
    <section class="content">
        <div class="containe-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum aspernatur eius quasi soluta aut labore saepe facere, itaque numquam, tempore blanditiis veritatis maxime sint fugit optio modi consectetur porro alias!</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Category Slug</th>
                                    <th>Icon</th>
                                    <th>Home Page</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ( $data as $key => $row)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $row->category_name }}</td>
                                    <td>{{ $row->category_slug }}</td>
                                    <td><img src="{{ asset($row->icon) }}" height="32" width="32"></td>
                                    <td>
                                      @if($row->home_page == 1) 
                                          <span class="badge badge-success">Home Page</span>
                                       @endif
                                    </td>
                                    <td>
                                        <a  data-id='{{ $row->id }}' class=" edit btn btn-info btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                                        <a href="{{ route('category.delete',$row->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
            </div>
        </div><!--/. container-fluid -->
    </section>
</div>

{{-- category insert modal --}}

<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('category.store') }}" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                    <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_add" name="category_name" required>
                    <small id="emailHelp" class="form-text text-muted">This is your main category</small>
                    </div>     
            </div>
            <div class="modal-body">
                    <div class="form-group">
                    <label for="category_name">Category Icon</label>
                    <input type="file" class="form-control dropify" id="icon" name="icon" required>
                    </div>     
            </div>
            <div class="modal-body">
              <div class="form-group">
              <label for="category_name">Show On Homepage</label>
                <select class="form-control" name="home_page">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

{{-- edit insert modal --}}

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modal_body">

        </div>
      </div>
    </div>
  </div>


<!-- ajax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- dropify -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script>
    $('.dropify').dropify({
    messages: {
        'default': 'Click Here',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
    });
</script>


  <script>

      $('.edit').on('click',function(){

        let cat_id = $(this).data('id');
        $.get('category/edit/'+cat_id,function(data){

           $('#modal_body').html(data);
        });
       
      })

  </script>

@endsection  
    
     
