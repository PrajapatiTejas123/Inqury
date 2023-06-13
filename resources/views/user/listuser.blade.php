@extends('admin-lte.mainadmin')
@section('content') 

 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>Users</h1>
          </div>
         
          <div class="col-sm-4">
             @if (Auth::user()->roles == 0 || Auth::user()->roles == 2)
            <a href="{{'/adduser'}}" class="btn btn-success">Add User</a>
            @endif
          </div>
          
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('listuser')}}">Home</a></li>
              <li class="breadcrumb-item active">List User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<div class="container-fluid">
<form method="get" action="{{route('listuser')}}">
  <div class="row">
      <div class="col-md-4">
        <div class="input-group">
          <input type="search" name="search" class="form-control rounded" placeholder="Search User" />
        </div>
      </div>
      <div class="col-md-4">
                      <select id="roles" value="" name="roles" class="form-control">
                      <option selected value="">Select Roles</option>
                      <option  value="0" >Admin</option>
                      <option  value="1" >Sales</option>
                      <option  value="2" >Hr</option>
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
                <h3 class="card-title">List User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>User Name</th>
                    <th>E-mail</th>
                    <th>Contact</th>
                    <th>Roles</th>
                    <th>Created-Date</th>
                    @if (Auth::user()->roles == 0 || Auth::user()->roles == 2) 
                    <th>Edit</th>
                    <th>Delete</th>
                    @endif
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($users as $key => $crud) 
                  <tr>
                    <td>{{$users->firstItem()+$key}}</td>
                    <td>{{$crud->username}}</td>
                    <td>{{$crud->email}}</td>
                    <td>{{$crud->contact}}</td>
                    <td>
                    @if($crud->roles =='0')
                      Admin
                    @elseif($crud->roles =='1')
                      Sales
                    @else($crud->roles =='2') 
                      Hr
                    @endif
                    </td>
                    <td>{{$crud->created_at}}</td>
                    @if (Auth::user()->roles == 0 || Auth::user()->roles == 2)
                      <td><a href="{{ route('edit',$crud->id)}}"><i class="fa fa-edit" style="font-size:28px; color:green;"></i></a> </td>
                    <td><!-- <a href="{{ route('delete',$crud->id)}}"><i class="fa fa-trash" onclick="return confirm('Are you sure you want to delete this user?')" data-toggle="modal" data-target="#exampleModalCenter" style="font-size:28px;color:red"></i></a> -->
                    <button type="button" class="btn btn-danger"
                    onclick="loadDeleteModal({{ $crud->id }}, `{{ $crud->username }}`)">Delete
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
            {!! $users->withQueryString()->links() !!}
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
                url: '{{ url('delete') }}/' + id,
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
