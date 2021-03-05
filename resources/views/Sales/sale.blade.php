@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Ventas</li>
          <form method="get" action="/sale/create" style="margin-left: auto;">
            <button type="submit" class="btn btn-primary" >
              {{ __('Nueva Venta') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
            </form>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Registro de Ventas</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th>venta N°</th>
                    <th>Serial Venta</th>
                    <th>Vendedor</th>
                    <th>Producto</th>
                    <th>Cantidad Producto</th>
                    <th>Subtotal</th>
                    <th>Iva</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Fecha Venta</th>
                
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>venta N°</th>
                    <th>Serial Venta</th>
                    <th>Vendedor</th>
                    <th>Producto</th>
                    <th>Cantidad Producto</th>
                    <th>Subtotal</th>
                    <th>Iva</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Fecha Venta</th>
                  </tr>
                </tfoot>

                <tbody>
                  @foreach ($venta as $venta)
                  <tr>
                    <td>{{$venta->numeroVenta}}</td>
                    <td>{{$venta->serialVenta}}</td>
                    <td>{{$venta->usuario['nombre']}}&nbsp{{$venta->usuario['apellido']}}</td>
                    <td>
                      @if ($venta->product['estado']==1)
                      {{$venta->product['nombreProducto']}}
                      @else
                      Producto agotado o no dispo
                      @endif
                    </td> 
                    <td>{{$venta->cantidadProducto}}</td>
                    <td>{{$venta->subtotal}}</td>
                    <td>{{$venta->iva}}</td>
                    <td>{{$venta->total}}</td>
                    <td>
                      @if ($venta->cliente['estado']==1)
                      {{$venta->cliente['numeroDocumento']}}-{{$venta->cliente['nombre']}}
                      @else
                      No exist
                      @endif
                    </td> 
                    <td>{{$venta->fechaEmision}}</td>
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