@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">
                  <!-- Page Heading -->
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                  <h1 class="h3 mb-1 text-red-800" style="text-align: center">Apicacion de control de negocio en linea</h1>
                  <p class="mb-4">A traves de esta plataforma usted podra realizar lo siguiente: </p>
                    </div>
                  </div>
                  <!-- Content Row -->
                  <div class="row">
        
                    <!-- First Column -->
                    <div class="col-lg-4">
        
                      <!-- Custom Text Color Utilities -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Registrar Clientes</h6>
                        </div>
                        <div class="card-body">
                          <p class=" py-2 bg-gradient-warning">Acceso a:</p>
                          <p class=" py-2 bg-gradient-warning">1. Tabla de clientes</p>
                          <p class=" py-2 bg-gradient-warning">2. Adicion de clientes</p>
                          <p class=" py-2 bg-gradient-warning">3. Edicion de clientes</p>
                          <p class=" py-2 bg-gradient-warning">4. Modificar el estado de los clientes</p>
                          <img src="storage/img/hands.jpg" class="mx-auto d-block m-4" alt="" style="width:80%;">
                        </div>
                      </div>
        
                      <!-- Custom Font Size Utilities -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Configurar Usuario de Administrador</h6>
                        </div>
                        <div class="card-body">
                          <p class=" py-2 bg-gradient-warning">Acceso a:</p>
                          <p class=" py-2 bg-gradient-warning">1. Editar caracteristicas de admin</p>
                          <p class="text-lg mb-0">2. Registrar nuevo administrador</p>
                          <img src="storage/img/inicioBackground.jpg" class="mx-auto d-block m-4" style="width:80%;" alt="">
                        </div>
                      </div>
        
                    </div>
        
                    <!-- Second Column -->
                    <div class="col-lg-4">
        
                      <!-- Background Gradient Utilities -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Registrar Ventas</h6>
                        </div>
                        <div class="card-body">
                          <div class=" py-2 bg-gradient-warning ">Acceso a:</div>
                          <div class="px-3 py-2 bg-gradient-warning ">1. Tabla de ventas</div>
                          <div class="px-3 py-2 bg-gradient-warning ">2. Adicion de ventas</div>
                          <div class="px-3 py-2 bg-gradient-warning ">3. Edicion de ventas</div>
                          <div class="px-3 py-2 bg-gradient-warning ">4. Integrar contrato o favtura de venta</div>
                          <div class="px-3 py-2 bg-gradient-warning ">5. Editar caracteristicas basicas de venta</div>
                           <img src="storage/img/Background.jpg" class="mx-auto d-block m-4 " style="width:80%;" alt="">
                        </div>
                      </div>
        
                    </div>
        
                    <!-- Third Column -->
                    <div class="col-lg-4">
        
                      <!-- Grayscale Utilities -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Generar Reportes</h6>
                        </div>
                        <div class="card-body">
                          <div class="p-3 bg-gray-100">Acceso a:</div>
                          <div class="p-3 bg-gray-100">1. Generar reportes segun contratos vigentes</div>
                          <div class="p-3 bg-gray-200">2. Generar reportes segun contratos proximos a expirar</div>
                          <div class="p-3 bg-gray-300">3. Generar reportes por cliente</div>
                          <div class="p-3 bg-gray-400">4. Generar contratos por busqueda general</div>
                          <div class="p-3 bg-gray-400">5. Tabla resultante de busqueda de flitrado</div>
                          <img src="storage/img/time.jpg" class="mx-auto d-block m-4" style="width:80%;" alt="">
                        </div>
                      </div>
                    </div>
        
                  </div>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->

    </div>
    <!-- /.content-wrapper -->

@endsection