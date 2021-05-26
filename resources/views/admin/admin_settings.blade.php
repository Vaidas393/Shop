@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Settings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->


  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Change info</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if ($errors->any())
            <div class="alert alert-primary" role="alert">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          @if(Session::has('success_details_message'))
          <div class="alert alert-success fade show" role="alert">
            {{ Session::get('success_details_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
            <form role="form" method="post" action="{{ url('/admin/update-admin-datails') }}" name="updateAdminDetails" id="updateAdminDetails" enctype="multipart/form-data">@csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" value="{{Auth::guard('admin')->user()->name}}"readonly="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" value="{{Auth::guard('admin')->user()->email}}"readonly="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone number</label>
                  <input type="text" class="form-control" value="{{Auth::guard('admin')->user()->mobile}}"readonly="">
                </div>
                <div class="form-group">
                  <label for="Name">Name</label>
                  <input type="text" id="admin_name" name="admin_name" class="form-control" placeholder="Name" required="">
                </div>
                  <div class="form-group">
                    <label for="number">Phone number</label>
                    <input type="text" id="admin_mobile" name="admin_mobile" class="form-control" placeholder="number">
                  </div>
                    <div class="form-group">
                      <label for="Image">Image</label>
                      <input type="file" id="admin_image" name="admin_image" class="form-control" accept="image/*" placeholder="upload Image">
                      @if(!empty(Auth::guard('admin')->user()->image))
                        <a target="_blank" href="{{ url('images/admin_images/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                        <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->image}}">
                      @endif
                    </div>
                  </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
          <!-- Input addon -->
        </div>
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Change password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if(Session::has('error_message'))
            <div class="alert alert-danger" role="alert">
              {{ Session::get('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            @if(Session::has('success_message'))
            <div class="alert alert-success" role="alert">
              {{ Session::get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

            <form role="form" method="post" action="{{ url('/admin/update-current-pwd') }}" name="updatePasswordForm" id="updatePasswordFrom">@csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Current password</label>
                  <input type="password" class="form-control" id="current_pwd" name="current_pwd" placeholder="Password" required="" minlength="6">
                  <span id="chkCurrentPswd"></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New password</label>
                  <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="Password" required minlength="6">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm password</label>
                  <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd" placeholder="Password" required minlength="6">
                </div>

              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" id="send_form" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
          <!-- Input addon -->
        </div>
        <!--/.col (right) -->
      </div>


      <!--/.col (right) -->
    </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>


</div>

@endsection
<script type="text/javascript">
$(".alert").fadeOut(5000);
</script>
<!-- <script type="text/javascript">
$(document).ready(function(){
$('#send_form').click(function(e){
     e.preventDefault();

   });
})
$('#send_detailform').click(function(e){
     e.preventDefault();
   });
})
</script> -->
