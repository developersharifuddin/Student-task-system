
 
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-0">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div> 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
            

              <li class="nav-item {{ Request::is('admin/student*') ? 'active' :'' }}">
              <a class="nav-link" href="{{route('student.index')}}">
                <i class="nav-icon far fa-image"></i>
                <p>Student List</p>
              </a>
            </li>
 
            
            <li class="nav-item {{ Request::is('admin/subject*') ? 'active' :'' }}">
              <a class="nav-link" href="{{route('subject.index')}}">
                <i class="nav-icon far fa-image"></i>
                <p>Subjects</p>
              </a>
            </li> 
            <li class="nav-item {{ Request::is('admin/student_result*') ? 'active' :'' }}">
              <a class="nav-link" href="{{route('student_result.index')}}">
                <i class="nav-icon far fa-image"></i>
                <p>Student_result</p>
              </a>
            </li>
   
              
          <li class="nav-item d-none">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              
          </li>

 
             
  
                  
           <li class="nav-item">
              <a class="dropdown-item nav-link bg-transparent" id="logout" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="far fa-circle nav-icon"></i>
                        
                    {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
      
          </a>
         </li>
          


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>