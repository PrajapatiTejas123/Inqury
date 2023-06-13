@extends('admin-lte.mainadmin')
@section('content') 

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid"> 
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
        <form method="POST" action="{{ route('update',$users->id)}}">
        @csrf
                <div class="card-body">
                	<div class="row">
                		<div class="col-md-6">
                	<div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                      <input type="text" value="{{old('username',$users->username)}}" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter User Name">
                    @error('username')
          			<span class="text-danger">{{ $message }}</span>
          			@enderror
                  	</div>
                		</div>
                		<div class="col-md-6">
                	<div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" value="{{old('email',$users->email)}}" name="email" class="form-control" id="exampleInputPassword1" placeholder="Enter Email">
                    @error('email')
          			<span class="text-danger">{{ $message }}</span>
          			@enderror
                    </div>
                		</div>
                	</div>
                 
                    <div class="row">
                    	<div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputPassword1">Contact</label>
                    <input type="text" value="{{old('contact',$users->contact)}}" name="contact" class="form-control" id="exampleInputPassword1" placeholder="Enter Contact No">
                    @error('contact')
          			<span class="text-danger">{{ $message }}</span>
          			@enderror
                    </div>
                    	</div>
                    	<div class="col-md-6">
                    	<label>Roles<span class="text-danger"></span></label>
                    	<select id="roles" value="{{old('roles',$users->roles)}}" name="roles" class="form-control">
                    	<option selected value="">Select Roles</option>
                    	<option  value="admin" {{old('roles',$users->roles) == '0' ? "selected" : ""}}>Admin</option>
                    	<option  value="sales" {{old('roles',$users->roles) == '1' ? "selected" : ""}}>Sales</option>
                      <option  value="sales" {{old('roles',$users->roles) == '2' ? "selected" : ""}}>Hr</option>
                    	</select>
                    	@error('roles')
          			<span class="text-danger">{{ $message }}</span>
          			@enderror
                    	</div>
                    </div>
                  
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" checked name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                      
                    </div>
                    @error('terms')
          			<span class="text-danger">{{ $message }}</span>
          			@enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->


@endsection
