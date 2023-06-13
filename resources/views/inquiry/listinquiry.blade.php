@extends('admin-lte.mainadmin')
@section('content') 

 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>Inquirys</h1>
          </div>
          <div class="col-sm-4">
            @if (Auth::user()->roles == 0 || Auth::user()->roles == 1)
            <a href="{{'/addinquiry'}}" class="btn btn-success">Add Inquiry</a>
            @endif
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('listinquiry')}}">Home</a></li>
              <li class="breadcrumb-item active">List Inquiry</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<div class="container-fluid">
<form method="get" action="{{route('listinquiry')}}">
  <div class="row">
      <div class="col-md-4">
        <div class="input-group">
          <input type="search" name="search" class="form-control rounded" placeholder="Search Inquiry" />
        </div>
      </div>
      <div class="col-md-4">
                      <select id="roles" value="" name="status" class="form-control">
                      <option selected value="">Select Status</option>
                      <option  value="0" >Pending</option>
                      <option  value="1" >Inprogress</option>
                      <option  value="2" >Complete</option>
                      </select>
      </div>
      <div class="col-md-2">
         <button type="submit" class="btn btn-outline-primary">Search</button>
      </div>
  </div>
</form>
</div>



    @if ($message = Session::get('success'))
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-primary mt-2">
               {{ $message }}
            </div>
          </div>
        </div>
      </div>
    @endif

<div class="wrapper mt-3">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Inquiry</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    @if (Auth::user()->roles == 0 || Auth::user()->roles == 1)
                    <th>Edit</th>
                    <th>Delete</th>
                    @endif
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($inquirys as $key => $crud) 
                  <tr>
                    <td>{{$inquirys->firstItem()+$key}}</td>
                    <td>{{$crud->firstname}}</td>
                    <td>{{$crud->lastname}}</td>
                    <td>{{$crud->email}}</td>
                    <td>{{$crud->contact}}</td>
                    <td>{{$crud->address}}</td>
                    <td>{{$crud->title}}</td>
                    <td>{{$crud->description}}</td>
                    <td>
                    @if($crud->status =='0')
                      Pending
                    @elseif($crud->status =='1')
                      Inprogress
                    @else($crud->status =='2') 
                      Complete
                    @endif
                    </td>
                    @if (Auth::user()->roles == 0 || Auth::user()->roles == 1)
                    <td><a href="{{ route('editinquiry',$crud->id)}}"><i class="fa fa-edit" style="font-size:28px; color:green;"></i></a> </td>
                    <td><!-- <a href=""><i class="fa fa-trash" onclick="loadDeleteModal({{ $crud->id }})"  style="font-size:28px;color:red"></i></a> -->
                    <button type="button" class="btn btn-danger"
                    onclick="loadDeleteModal({{ $crud->id }}, `{{ $crud->firstname }}`)"><i class="fa fa-trash"></i>
                   </button>
                    </td>
                    @endif
                  </tr>
                  @endforeach 
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            {!! $inquirys->withQueryString()->links() !!}
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      
    </section>
    
  </div>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>


<div class="modal fade" id="deleteCategory" data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="deleteCategory" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <span id="modal-category_name"></span>?
                        <input type="hidden" id="category" name="category_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="modal-confirm_delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>

 <script>
        function loadDeleteModal(id, name) {
            $('#modal-category_name').html(name);
            $('#modal-confirm_delete').attr('onclick', `confirmDelete(${id})`);
            $('#deleteCategory').modal('show');
        }

        function confirmDelete(id) {
            $.ajax({
                url: '{{ url('deleteinquiry') }}/' + id,
                //console.log('tejas');
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                   _token: '{!! csrf_token() !!}',
                 },
                success: function (data) {
                    setInterval('location.reload()', 1000);

              $('#deleteCategory').modal('hide');
                },
                error: function (error) {
                  
                    // Error logic goes here..!
                }
            });
        }
    </script>

@endsection
