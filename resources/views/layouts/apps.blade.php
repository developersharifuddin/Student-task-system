<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
     
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
  <link rel="stylesheet" href="{{asset('backend/dist/css/bootstrap.min.css')}}"> 
  <!-- Font Awesome Icons --> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  

  @stack('css')
  
</head>
<body>
  
 <div class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed bg-white">
 
 <div id="app">
        
 <div class="wrapper">

 <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div> -->

    @if(Request::is('admin*'))
    @include('layouts.partial.topbar')
    @endif

    @if(Request::is('admin*'))
    @include('layouts.partial.sidebar')
    @endif
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-transparent">
    @if(Request::is('admin*'))
    @yield('header')
    @endif
 
    @yield('content')
    </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

    <!-- /.content-wrapper -->
    @if(Request::is('admin*'))
    @include('layouts.partial.footer')
    @endif


 </div>

</div>
 
</div>

 
 
<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.js')}}"></script>
 
<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('backend/dist/js/pages/dashboard2.js')}}"></script>
<!-- 
 <link rel="stylesheet" href="{{asset('backend/plugins/sweetalert/sweetalert.min.js')}}"> -->
  <!-- <link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.js')}}">
    -->
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        

 <script type="text/javascript">
                        $('document').on('click','#delete',function(e){
                          e.preventDefault();
                         var link = $(this).attr("href");
                                                  
                            swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this imaginary file!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                          })
                          .then((willDelete) => {
                            if (willDelete) {
                              swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                              });
                            } else {
                              swal("Your imaginary file is safe!");
                            }
                          });
                        
                        });
            </script>


            <script type="text/javascript">
                        $(document).on("click","#logout", function(e){
                          e.preventDefault();
                         var link = $(this).attr("href");
                                                  
                            swal({
                           title: "Are You Want to Logout!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                          })
                          .then((willDelete) => {
                            if (willDelete) {
                             window.location.href = link;
                            } else {
                              swal("Not Logout!");
                            }
                          });
                        
                        });
            </script>
 
    @if($errors->any())
    @foreach($errors->all() as $error)
    <script>
    toastr.error('{{$error}}')
    </script>
    @endforeach
    @endif
 
@stack('js')
</body>
</html>
