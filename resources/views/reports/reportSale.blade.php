@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Informes</li>
          <li class="breadcrumb-item active">Informe Ventas</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header" style="text-align: center">
            <i class="fas fa-table"></i>
            Generar Nuevo Informe de Ventas
            <span style="float: right">
              <button type="submit" class="btn btn-primary" >
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
              </button></span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <span style="float:left">
                    <input id="Date_search" size="25" type="date" placeholder="Fecha Inicial" readonly="true" />
                    <button type="reset" class="reset" onclick="limpiar()"><i class="fa fa-repeat"
                        aria-hidden="true"></i></button>&ensp;&ensp;</span>
                        <span style="float:center">
                            <input id="Date_search2" size="25" type="date" placeholder="Fecha Final" readonly="true" />
                            <button type="reset" class="reset" onclick="limpiar()"><i class="fa fa-repeat"
                                aria-hidden="true"></i></button>&ensp;&ensp;
                            <select class="js-example-basic-single "  data-live-search="true" >
                                <option value="" disabled selected>Buscar por Cliente</option>
                                @foreach ($cliente as $cliente)
                                    @if ($cliente->estado==1){
                                    <option onclick="asignarCliente('{{$cliente['nombre']}}'.{{$cliente->numeroDocumento}})" value={{$cliente->id}} >{{$cliente->numeroDocumento}}-{{$cliente->nombre}}</option>
                                     }
                                   @endif
                                    @endforeach
                              </select>
                            
                            <button type="reset" class="reset" id="clienteSearch"><i class="fa fa-search" aria-hidden="true"
                                onclick="buscarCliente()"></i></button>
                          </span>
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
                    <td>{{$venta->idUsuario}}</td>
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