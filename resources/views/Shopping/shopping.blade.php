@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Compras</li>
          <form method="get" action="/shopping/create" style="margin-left: auto;">
            <button type="submit" class="btn btn-primary" >
              {{ __('Nueva Compra') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
            </form>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Registro de Compras</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th>serie/comprobante</th>
                    <th>N° Comprobante</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Factura</th>
                    <th>Estado</th>
                    <th>Ver/Anular Commpra</th>
                    
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>serie/comprobante</th>
                    <th>N° Comprobante</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Factura</th>
                    <th>Estado</th>
                    <th>Ver/Anular</th>
                  </tr>
                </tfoot>

                <tbody>
                  @foreach ($compra as $compra)
                  <tr>
                    <td>{{$compra->serieComprobante}}</td>
                    <td>{{$compra->numeroComprobante}}</td>
                    <td>{{$compra->fechaEmision}}</td>
                    <!--proveedor-->
                    <td>
                      @if ($compra->proveedor['estado']==1)
                      {{$compra->proveedor['razonSocial']}}
                      @else
                      No hay categoria disponible
                      @endif
                      </td>
                    <!--factura-->
                    <td style="text-align: center;"><a class="btn btn-danger" href="/" data-toggle="modal" data-target="#deleteModal" data-postid="{{$compra->id}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
                    <td  style="text-align: center;">
                      <!--cambiar estado-->
                        @if ($compra->estado==0)
                        <button class="btn btn-danger" type="submit" disabled>Cancelado</button>
                        @else
                        <button class="btn btn-success" type="submit" disabled>Pagado</button>
                        @endif

                      </td> 
                    <!--Ver Anular-->
                  </td>
                  
                  <td style="text-align: center;">
                    <a class="btn btn-primary" href="/shopping/{{$compra->id}}/edit"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a class="btn btn-danger" href="/" data-toggle="modal" data-target="#deleteModal" data-postid="{{$compra->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                  </td>
                    
                  </tr>
              
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted" style="text-align: center">Updated <input type="datetime" style="text-align: center" name="fecha"  readonly="true" value="<?php echo date("Y-m-d\TH-i");?>"></div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->

    </div>
    <!-- /.content-wrapper -->
    <script>
      $(document).ready(function() {
          $('.js-example-theme-single').select2({theme:"classic"});
          $('#dataTable').DataTable({
              bLengthChange: false,
          });

      });
  </script>

@endsection