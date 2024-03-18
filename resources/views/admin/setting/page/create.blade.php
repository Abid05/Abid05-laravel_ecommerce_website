@extends('layouts.admin')
@section('admin.content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Page Create</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Create a new page</h3>
                </div>
            
                <form action="{{ route('page.store') }}" method="POST">
                  @csrf
                  <div class="card-body">

                    <div class="form-group">
                        <label for="InputPassword1">Page Position</label>
                        <select class="form-control" name="page_position">
                            <option value="1">Line One</option>
                            <option value="2">Line Two</option>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="InputPassword1">Page Name</label>
                      <input type="text" class="form-control" name="page_name" id="InputPassword1" placeholder="Page Name">
                    </div>

                    <div class="form-group">
                      <label for="InputPassword2">Page Tiltle</label>
                      <input type="text" class="form-control" name="page_title" id="InputPassword2" placeholder="Page Title"> 
                    </div>

                    <div class="form-group">
                      <label for="InputPassword3">Page Description</label>
                      <textarea class="form-control" id="summernote" name="page_description"></textarea>
                      <small>This data show on your webpage</small>
                    </div>
                  </div>
                  
                  <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Create Page</button>
                  </div>
                </form>
              </div>
          </div>
        </div>

      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
@endsection