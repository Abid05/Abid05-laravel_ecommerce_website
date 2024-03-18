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
              <li class="breadcrumb-item active">Website Setting</li>
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
          <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Website Setting</h3>
                </div>
            
                <form action="{{ route('website.setting.update',$setting->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label>Currency</label>
                      <select name="currency" class="form-control">
                        <option value="৳" {{ ($setting->currency=='৳')? 'selected': '' }}>Taka(৳)</option>
                        <option value="$" {{ ($setting->currency=='$')? 'selected': '' }}>USD($)</option>
                        <option value="$" {{ ($setting->currency=='₹')? 'selected': '' }}>Rupee(₹)</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label>Phone One</label>
                        <input type="text" class="form-control" name="phone_one" value="{{ $setting->phone_one }}" placeholder="Meta Author">
                      </div>
                 
                    <div class="form-group">
                        <label>Phone Two</label>
                        <input type="text" class="form-control" name="phone_two" value="{{ $setting->phone_two }}" placeholder="Meta Tags">
                      </div>
                   
                    <div class="form-group">
                        <label>Main Email</label>
                        <input type="text" class="form-control" name="main_email" value="{{ $setting->main_email }}" placeholder="Meta Keyword">
                    </div>
                    <div class="form-group">
                        <label>Support Email</label>
                        <input type="text" class="form-control" name="support_email" value="{{ $setting->support_email }}" placeholder="Meta Keyword">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" value="{{ $setting->address }}" placeholder="Meta Keyword">
                    </div>

                    <strong class="text-center text-success">Social Link</strong>

                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" class="form-control" name="facebook" value="{{ $setting->facebook }}" >
                    </div>

                    <div class="form-group">
                        <label><Table>Twitter</Table></label>
                        <input type="text" class="form-control" name="twitter" value="{{ $setting->twitter }}">
                    </div>
               
                    <div class="form-group">
                        <label>Instagram</label>
                        <input type="text" class="form-control" name="instagram" value="{{ $setting->instagram }}">
                    </div>
                    <div class="form-group">
                        <label>Linkedin</label>
                        <input type="text" class="form-control" name="linkedin" value="{{ $setting->linkedin }}">
                    </div>
                    <div class="form-group">
                        <label>Youtube</label>
                        <input type="text" class="form-control" name="youtube" value="{{ $setting->youtube }}">
                    </div>

                    <strong class="text-center text-success">Logo & Favicon</strong>
                    <div class="form-group">
                        <label>Main Logo</label>
                        <input type="file" class="form-control" name="logo">
                        <input type="hidden" name="old_logo" value="{{ $setting->logo }}">
                    </div>
                    <div class="form-group">
                        <label>Favicon</label>
                        <input type="file" class="form-control" name="favicon">
                        <input type="hidden" name="old_favicon" value="{{ $setting->favicon }}">
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