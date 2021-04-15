@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

    
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item active">Resultados Generales de ventas</li>
            </ol>



            <!--INICIO DEL DEMO-->
            <!-- Content Row -->
            <div class="row">

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                      Producto mas Vendido (Monthly)</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">Jabon (1.658 C/U)</div>
                              </div>
                              <div class="col-auto">
                                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-success shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                      Producto que genera mas Ganancia (Annual)</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">Arroz($215,000)</div>
                              </div>
                              <div class="col-auto">
                                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-info shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Producto menos vendido
                                  </div>
                                  <div class="row no-gutters align-items-center">
                                      <div class="col-auto">
                                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">10% Producto x</div>
                                      </div>
                                      <div class="col">
                                          <div class="progress progress-sm mr-2">
                                              <div class="progress-bar bg-danger" role="progressbar"
                                                  style="width: 10%" aria-valuenow="50" aria-valuemin="0"
                                                  aria-valuemax="100"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-auto">
                                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-warning shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                      Ventas Realizadas</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800">18&nbsp&nbsp&nbsp<i class="fas fa-shopping-bag"></i></div>
                              </div>
                              <div class="col-auto">
                                  <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Content Column -->

          <div class="col-lg-5">

            <!-- Project Card Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" style="text-align: center">Productos mas Populares</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Server Migration <span
                            class="float-right">20%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Sales Tracking <span
                            class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Database <span
                            class="float-right">60%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%"
                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Payout Details <span
                            class="float-right">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Account Setup <span
                            class="float-right">Complete!</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

            </div>
          </div>

        </div>


           
            <!-- Icon Cards-->
            
          
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->

    </div>
    <!-- /.content-wrapper -->

    <script>
      $(document).ready(function() {
          $('.js-example-theme-single').select2({theme:"classic"});
          $('#dataTable').DataTable({
              
          });

      });
  </script> 

@endsection