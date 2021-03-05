<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
   
    

    <!-- Custom styles for this template-->
    <link href="{{ asset('/css/sb-admin.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--custom select-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>

    


</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }}&nbsp&nbsp&nbsp<i
                class="fa fa-spinner" aria-hidden="true"></i></i> </a>
        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="/user/{{ auth()->id() }}/edit">Opciones de cuenta</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>

    </nav>

    @canany(['view_productos'])
        <label for="">ME CHUPA TRES PINGOS</label>
    @endcan
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav"> 
            <li class="nav-item">
                <a class="nav-link" href="/opcionesPerfil">
                    <span style="color: #fff;" >{{ auth()->user()->nombre }}&nbsp{{ auth()->user()->apellido }}</span><br><br>
                    <img src="/storage/img/perfil.jpg" class="mobile_profile_image circle"  style="height:auto;max-width: 70%;border-radius:150px;border:1px solid #666;background:#ffff" alt="">
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="fa fa-home" aria-hidden="true"></i>&nbsp
                    <span>Home</span>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Business</h6>

                <!--seccion productos-->
            <li class="nav-item dropdown">
                
                <a class="nav-link dropdown-toggle" href="/product" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-tags" aria-hidden="true"></i>&nbsp
                    <span>Productos</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown"> 
                    <a class="dropdown-item" href="/product">Product Management</a>
                    <a class="dropdown-item" href="/product/create">New Product</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/category">Manage Category</a>
                   <a class="dropdown-item" href="/category/create">New Category</a> 
                </div>
            </li>
            <!--ventas-->
            <li class="nav-item">
                <a class="nav-link" href="/sale">
                    <i class="fa fa-balance-scale" aria-hidden="true"></i>&nbsp
                    <span>Sales</span></a>
            </li>
            <!--compras-->
            <li class="nav-item">
                <a class="nav-link" href="/shopping">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp
                    <span>Shopping</span></a>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Manage</h6>
                <!--seccion de socios-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp
                    <span>Partners</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="/client">Customer Management</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/provider">Partner Management</a>
                </div>
            </li>
            </li>
            <!--seccion de reportes--> 
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-chart-area"></i>&nbsp
                    <span>Reports</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="/Reportess">Sales Reports</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/Reportes">Reports Articles</a>
                </div>
            </li>
            </li>
            <!--seccion usuarios-->
            </li>
            
            <li class="nav-item dropdown">
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Access</h6>
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-users" aria-hidden="true"></i>&nbsp
                    <span>Users</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="/roles">All Roles</a>
                    <a class="dropdown-item" href="/roles/create">New Rol</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/user">All users</a>
                    <a class="dropdown-item" href="/user/create">New User</a>
                </div>
            </li>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Admin</h6>
            <li class="nav-item">
                <a class="nav-link" href="/config">
                    <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp
                    <span>Opciones del sistema</span></a>
            </li>
            <!--about-->
            <li class="nav-item">
                <a class="nav-link" href="/about">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp
                    <span>about</span></a>
            </li>
        </ul>
        <div id="content-wrapper" style="background-image: url({{ asset ('/storage/img/fondogeneral.png')}});background-position:center;"  >

        <!--.................................................................-->
        @yield('content')
        @yield('js_post_page')
        @yield('js_role_page')
        @yield('js_user_page')
        </div>
    </div>
  
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
      }
      
      function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
          txtValue = a[i].textContent || a[i].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
          } else {
            a[i].style.display = "none";
          }
        }
      }
      </script>

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
   
    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->



    <!--para el select con busqueda-->
    <!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<!-- CSS -->

    @yield('js_post_page')

</body>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"; rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js";></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>


<script src=" {{ asset('/js/jspdf.debug.js') }}"></script>
<script src=" {{ asset('/js/paginator.js') }}"></script>
 <!-- Sticky Footer -->
 <footer class="sticky-footer">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright SoftwareFJ 2020</span>
    </div>
  </div>
</footer>

</html>

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        // inicializamos el plugin
        $('#tags').select2({
            // Activamos la opcion "Tags" del plugin
            tags: true,
            tokenSeparators: [','],
            ajax: {
                dataType: 'json',
                url: '{{ url("tags") }}',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function (data, page) {
                  return {
                    results: data
                  };
                },
            }
        });
    });
</script>
@endsection
