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
          <div class="col-md-6 offset-md-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">SMTP Mail</li>
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
          <div class="col-6">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">SMTP Mail Settings</h3>
                </div>
            
                <form action="{{ route('smtp.setting.update',$smtp->id) }}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="InputPassword1">Mail Mailer</label>
                      <input type="text" class="form-control" name="mailer" value="{{ $smtp->mailer }}" placeholder="Mail Mailer">
                      <small>Example:Mail</small>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword1">Mail Host</label>
                        <input type="text" class="form-control" name="host" value="{{ $smtp->host }}" placeholder="Mail Host">
                      </div>
                 
                    <div class="form-group">
                        <label for="InputPassword1">Mail Port</label>
                        <input type="text" class="form-control" name="port" value="{{ $smtp->port }}" placeholder="Mail Port">
                        <small>Example:3464</small>
                      </div>
                   
                    <div class="form-group">
                        <label for="InputPassword1">Mail Username</label>
                        <input type="text" class="form-control" name="user_name" value="{{ $smtp->user_name }}" placeholder="Mail Username">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword1">Mail Password</label>
                        <input type="text" class="form-control" name="password" value="{{ $smtp->password }}" placeholder="Mail Password">
                    </div>         
                  </div>
                  <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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