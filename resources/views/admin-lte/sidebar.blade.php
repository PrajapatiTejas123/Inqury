<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">  
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
<div class="btn-group">
  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ Auth::user()->username }}
    <div class="dropdown-menu">
    <a class="dropdown-item"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
  </div>
  </button>
    
</div>

          <li class="nav-item">
            <a href="{{'/listuser'}}" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                User Management
              </p>
            </a>
          </li>
        
          <li class="nav-item">
            <a href="{{'/listinquiry'}}" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Inquiry Management
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>