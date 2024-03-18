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
              <li class="breadcrumb-item active">OnPage Seo</li>
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
          <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Your SEO Settings</h3>
                </div>
            
                <form action="{{ route('seo.setting.update',$data->id) }}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="InputPassword1">Meta Title</label>
                      <input type="text" class="form-control" name="meta_title" value="{{ $data->meta_title }}" placeholder="Meta Title">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword1">Meta Author</label>
                        <input type="text" class="form-control" name="meta_author" value="{{ $data->meta_author }}" placeholder="Meta Author">
                      </div>
                 
                    <div class="form-group">
                        <label for="InputPassword1">Meta Tags</label>
                        <input type="text" class="form-control" name="meta_tag" value="{{ $data->meta_tag }}" placeholder="Meta Tags">
                      </div>
                   
                    <div class="form-group">
                        <label for="InputPassword1">Meta Keyword</label>
                        <input type="text" class="form-control" name="meta_keyword" value="{{ $data->meta_keyword }}" placeholder="Meta Keyword">
                        <small>Example:ecommerce,online shop,online market</small>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword1">Meta Description</label>
                        <textarea name="meta_description" class="form-control">{{ $data->meta_description }}</textarea>
                    </div>

                    <strong class="text-center text-success">----Other Option----</strong>

                    <div class="form-group">
                        <label for="InputPassword1">Google Verifiaction</label>
                        <input type="text" class="form-control" name="google_verification" value="{{ $data->google_verification }}" placeholder="Meta Verification">
                        <small>Put here only verification code</small>
                      </div>

                    <div class="form-group">
                        <label for="InputPassword1">Alexa Verifiaction</label>
                        <input type="text" class="form-control" name="alexa_verification" value="{{ $data->alexa_verification }}" placeholder="Alexa Verification">
                        <small>Put here only verification code</small>
                      </div>
               
                    <div class="form-group">
                        <label for="InputPassword1">Google Analytics</label>
                        <textarea name="google_analytics" class="form-control">{{ $data->google_analytics }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword1">Google Adsense</label>
                        <textarea name="google_adsense" class="form-control">{{ $data->google_adsense }}</textarea>
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