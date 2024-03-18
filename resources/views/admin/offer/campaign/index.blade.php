@extends('layouts.admin')
@section('admin.content')

  <!-- Dropify -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">      

  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Campaign</h1>
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
                          <h3 class="card-title">All Campaign List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-bordered table-striped table-sm ytable">
                            <thead>
                                <tr>
                                    <th>Start Date</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Discount(%)</th>
                                    <th>Status</th>
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

{{-- Campaign insert modal --}}

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Campaign</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('campaign.store') }}" method="Post" id="add-form" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

                    <div class="form-group">
                        <label for="campaign-title">Campaign Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  name="title" required>
                        <small id="emailHelp" class="form-text text-muted">This is Campaign title</small>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="start-date">Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control"  name="start_date" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="end-date">End Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control"  name="end_date" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="start-date">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="end-date">Discount (%) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control"  name="discount" required>
                                <small id="emailHelp" class="form-text text-muted">Discount percentage are apply for all product selling price.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="brand-name">Campaign Banner <span class="text-danger">*</span></label>
                        <input type="file" id="dropify" data-height="140"  name="image" required>
                        
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
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Campaign</h5>
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
      $(function campaign(){
        let table = $('.ytable').DataTable({

            processing:true,
            serverSide:true,
            ajax:"{{ route('campaign.index') }}",
            columns:[

                {data:'start_date', name:'start_date'},
                {data:'title', name:'title'},
                {data:'image', name:'image',render:function(data){
                    return '<img src="'+data+'" width="50">';
                }},
                {data:'discount', name:'discount'},
                {data:'status', name:'status'},
                {data:'action', name:'action' , orderable:true, searchable:true},
            ]

        });
      });

      //Edit Script

      $('body').on('click','.edit',function(){

        let id = $(this).data('id');

        $.get('/campaign/edit/'+id,function(data){

          $('#modal_body').html(data);

        });

      })

  </script>

@endsection  
    
     
