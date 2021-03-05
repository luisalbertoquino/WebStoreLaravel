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
          <li class="breadcrumb-item active">Informe Productos</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header" style="text-align: center">
            <i class="fas fa-table"></i>
            Generar  Nuevo Informe de Productos
            <span style="float: right">
            <button type="submit" class="btn btn-primary" >
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            </button></span>
        </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <span style="float:left">
                    <input id="Date_search" style="form-control" size="25" type="date" placeholder="Fecha Inicial" readonly="true" />
                    <button type="reset" class="reset" onclick="limpiar()"><i class="fa fa-repeat"
                        aria-hidden="true"></i></button>&ensp;&ensp;</span>
                        <span style="float:center">
                            <input id="Date_search2" style="form-control" size="25" type="date" placeholder="Fecha Final" readonly="true" />
                            <button type="reset" class="reset" onclick="limpiar()"><i class="fa fa-repeat"
                                aria-hidden="true"></i></button>&ensp;&ensp;
                            <select class="js-example-basic-single "  data-live-search="true" style="form-control" >
                                <option value="" disabled selected style="form-control">Buscar por Proveedor</option>
                                @foreach ($categoria as $categoria)
                                    @if ($categoria->estado==1){
                                        <option value={{$categoria->id}}>{{$categoria->categoria}}</option>
                                     }
                                   @endif
                                    @endforeach
                              </select>
                            
                            <button type="reset" class="reset" id="clienteSearch"><i class="fa fa-search" aria-hidden="true"
                                onclick="buscarCliente()"></i></button>
                          </span>
                <thead class="thead-dark">
                  <tr>
                    <th>id</th>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Costo</th>
                    <th>% Ganancia</th>
                    <th>valor de venta</th>
                    <th>categoria</th>
                    <th>estado</th>
                    <th>editar</th>
                
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Costo</th>
                    <th>% Ganancia</th>
                    <th>valor de venta</th>
                    <th>categoria</th>
                    <th>estado</th>
                    <th>editar</th>
                  </tr>
                </tfoot>

                <tbody>
                  @foreach ($productos as $productos)
                  <tr>
                    <td>{{$productos->id}}</td>
                    <td>{{$productos->nombreProducto}}</td>
                    <td>{{$productos->detalleProducto}}</td>
                    <td>{{$productos->stock}}</td>
                    <td>{{$productos->costo}}</td>
                    <td>{{$productos->porcentajeGanancia}}</td>
                    <td>{{$productos->valorVenta}}</td>
                    <td>
                      @if ($productos->category['estado']==1)
                      {{$productos->category['categoria']}}
                      @else
                      No hay categoria disponible
                      @endif
                      </td>
                     
                    <td  style="text-align: center;">
                      <!--cambiar estado-->
                      <form action="/product/estado/{{$productos->id}}" method="POST">
                        @method('PATCH')
                      {{csrf_field()}}
                        @if ($productos->estado==0)
                        <button class="btn btn-danger" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @else
                        <button class="btn btn-success" type="submit" ><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @endif
                      </form>
                      </td> 
                      <!--editar-->
                      <td style="text-align: center;">
                        <form action="/product/{{ $productos['id'] }}/edit" method="GET">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </form>
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