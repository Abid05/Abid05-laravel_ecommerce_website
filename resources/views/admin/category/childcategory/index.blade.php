@extends('layouts.admin')
@section('admin.content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Child Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">+Add New</button>
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
                          <table class="table table-bordered table-striped table-sm ytable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ChildCategory Name</th>
                                    <th>Category Name</th>
                                    <th>SubCategory Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


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

{{-- Childcategory insert modal --}}

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Child Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('childcategory.store') }}" method="Post" id="add-form">
            @csrf
            <div class="modal-body">

                    <div class="form-group">
                        <label for="category_name">Category/Subcategory</label>
                        <select class="form-control" name="subcategory_id">

                            @foreach ($category as $row)

                                @php
                                  $subcat = DB::table('subcategories')->where('category_id','=',$row->id)->get();
                                @endphp

                                <option disabled style="color: red;" value="{{ $row->id }}">{{ $row->category_name }}</option>

                                @foreach ($subcat as $row)
                                  <option value="{{ $row->id }}"> --- {{ $row->subcategory_name }}</option>
                                @endforeach
              
                            @endforeach
                            
                        </select> 
                    </div>

                    <div class="form-group">
                        <label for="category_name">Child category Name</label>
                        <input type="text" class="form-control"  name="childcategory_name" required>
                        <small id="emailHelp" class="form-text text-muted">This is your child category</small>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Childcategory</h5>
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


  <script>
      //ajax req
      $(function childcategory(){
        let table = $('.ytable').DataTable({

            processing:true,
            serverSide:true,
            ajax:"{{ route('childcategory.index') }}",
            columns:[

                {data:'DT_RowIndex', name:'DT_RowIndex'},
                {data:'childcategory_name', name:'childcategory_name'},
                {data:'category_name', name:'category_name'},
                {data:'subcategory_name', name:'subcategory_name'},
                {data:'action', name:'action' , orderable:true, searchable:true},
            ]

        });
      });

      

      //Edit Script

      $('body').on('click','.edit',function(){

        let id = $(this).data('id');

        $.get('/childcategory/edit/'+id,function(data){

          $('#modal_body').html(data);

        });

      })

  </script>

@endsection  
    
     
