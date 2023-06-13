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
              <li class="breadcrumb-item active">Edit Inquiry</li>
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
                <h3 class="card-title">Edit Inquiry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('updateinquiry',$users->id)}}">
              	@csrf
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" value="{{old('firstname',$users->firstname)}}" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="Enter firstname">
                    @error('firstname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                    </div>
                    </div>
                    <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Last Name</label>
                    <input type="text" value="{{old('lastname',$users->lastname)}}" name="lastname" class="form-control" id="exampleInputPassword1" placeholder="Enter lastname">
                    @error('lastname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                    </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" value="{{old('email',$users->email)}}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                    </div>
                    </div>
                    <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Contact No</label>
                    <input type="text" value="{{old('contact',$users->contact)}}" name="contact" class="form-control" id="exampleInputPassword1" placeholder="Enter contact no">
                    @error('contact')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                    </div>
                    </div>
                  </div>


                	<div class="row">
                		<div class="col-md-6">
                	<div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" value="{{old('address',$users->address)}}" name="address" class="form-control" id="exampleInputEmail1" placeholder="Enter address">
                    @error('address')
          			<span class="text-danger">{{ $message }}</span>
          			@enderror
                  	</div>
                		</div>
                		<div class="col-md-6">
                	<div class="form-group">
                    <label for="exampleInputPassword1">Title</label>
                    <input type="text" value="{{old('title',$users->title)}}" name="title" class="form-control" id="exampleInputPassword1" placeholder="Enter title">
                    @error('title')
          			<span class="text-danger">{{ $message }}</span>
          			@enderror
                    </div>
                		</div>
                	</div>
                 
                    <div class="row">
                      <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <input type="text" value="{{old('description',$users->description)}}" name="description" class="form-control" id="exampleInputPassword1" placeholder="Enter Description">
                    @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                    </div>
                    </div>
                    	<div class="col-md-6">
                    	<label>Status<span class="text-danger"></span></label>
                    	<select id="status" value="{{old('status',$users->status)}}" name="status" class="form-control">
                    	<option selected value="">Select Status</option>
                    	<option  value="pending" {{old('status',$users->status) == '0' ? "selected" : ""}}>Pending</option>
                    	<option  value="inprogress" {{old('status',$users->status) == '1' ? "selected" : ""}}>Inprogress</option>
                      <option  value="complete"{{old('status',$users->status) == '2' ? "selected" : ""}}>Complete</option>
                    	</select>
                    	@error('status')
          			<span class="text-danger">{{ $message }}</span>
          			@enderror
                    	</div>
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
