<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="shortcut icon" href="img/favico.ico" />


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
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }
        
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
        
        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
        
        .rtl table {
            text-align: right;
        }
        
        .rtl table tr td:nth-child(2) {
            text-align: left;
        }


        </style>

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
                    @if(Auth::user()->permissions->contains('slug', 'editacount')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/user/{{ auth()->id() }}/edit">Opciones de cuenta</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul> 

    </nav>


    <div id="wrapper" style="position: sticky">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav"> 
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                    <span style="color: #fff;"><h5>{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}</h5></span>
                    @auth
                    <span style="color: #fff;" > Rol: {{ Auth::user()->roles->isNotEmpty() ? Auth::user()->roles->first()->nombre : "" }}</span>
                   
                    @endauth
                    <br><br>
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
                @if(Auth::user()->permissions->contains('slug', 'viewproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
            <li class="nav-item dropdown">
                
                <a class="nav-link dropdown-toggle" href="/product" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-archive" aria-hidden="true"></i>&nbsp
                    <span>Productos</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    @if(Auth::user()->permissions->contains('slug', 'viewcategory')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/category">Manage Category</a>
                   <a class="dropdown-item" href="/category/create">New Category</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    
                   <a class="dropdown-item" href="/product">Product Management</a>
                    <a class="dropdown-item" href="/product/create">New Product</a>
                   
                </div>
            </li>
            @endif
      
            <!--ventas-->

            @if(Auth::user()->permissions->contains('slug', 'viewsale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
            <li class="nav-item dropdown">
                
                <a class="nav-link dropdown-toggle" href="/product" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-tags" aria-hidden="true"></i>&nbsp
                    <span>Sales</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="/sale">
                        <span>Manage Sales</span></a>
                    @if(Auth::user()->permissions->contains('slug', 'createsale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/sale/create">
                        <span>New Sale</span></a>
                    @endif
                </div>
            </li>
            @endif
            
            <!--compras-->

            @if(Auth::user()->permissions->contains('slug', 'viewpurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="/product" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-truck" aria-hidden="true"></i>&nbsp
                    <span>Shopping</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="/shopping">
                        <span>Manage Shopping</span></a>
                    @if(Auth::user()->permissions->contains('slug', 'createpurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/shopping/create">
                        <span>New Shopping</span></a>
                    @endif
                </div>
            </li>
            @endif

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
                    @if(Auth::user()->permissions->contains('slug', 'viewcostumer')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/client">Customer Management</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    @if(Auth::user()->permissions->contains('slug', 'viewsupplier')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/provider">Supplier Management</a>
                    @endif
                </div>
            </li>
            
            <!--seccion de reportes--> 
            @if(Auth::user()->permissions->contains('slug', 'viewreports')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
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
            @endif
            </li>
            <!--seccion usuarios-->
            </li>
            @if(Auth::user()->permissions->contains('slug', 'viewuser')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
            <li class="nav-item dropdown">
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Access</h6>
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-users" aria-hidden="true"></i>&nbsp
                    <span>Users</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    @if(Auth::user()->permissions->contains('slug', 'viewrol')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/roles">All Roles</a>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'createrol')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/roles/create">New Rol</a>
                    <div class="dropdown-divider"></div>
                    @endif
                    <a class="dropdown-item" href="/user">All users</a>
                    @if(Auth::user()->permissions->contains('slug', 'createuser')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/user/create">New User</a>
                    @endif
                </div>
                <div class="dropdown-divider"></div>
            </li>
            @endif
            
            <!--Seccion admin-->
            

            @if(Auth::user()->permissions->contains('slug', 'administrador')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
            <h6 class="dropdown-header">Admin</h6>
            <li class="nav-item">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp
                    <span>Options System</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    @if(Auth::user()->permissions->contains('slug', 'operationalvariables')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/Bussiness">Operational Variables</a>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'editacount')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/user/{{auth()->user()->id}}/edit">Account Options</a>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'ViewDocument')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/document">Supported Documents</a>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'operationalvariables')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <a class="dropdown-item" href="/Bussiness2">Business Customization</a>
                    @endif
                </div>
                <div class="dropdown-divider"></div>
            </li>
            @endif




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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>
<script src="https://cdn.bootcss.com/html2pdf.js/0.9.1/html2pdf.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>


<script src=" {{ asset('/js/jspdf.debug.js') }}"></script>
<script src=" {{ asset('/js/paginator.js') }}"></script>
 <!-- Sticky Footer -->
 <footer class="sticky-footer">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright SoftwareFJ 2021</span>
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
