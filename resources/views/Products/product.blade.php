@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Productos</li>
          <form method="get" action="/product/create" style="margin-left: auto;">
            <button type="submit" class="btn btn-primary" >
              {{ __('Nuevo Producto') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
            </form>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Productos disponibles en Stock</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    <td><textarea  style="border:0px" readonly value="{{$productos->nombreProducto}}" disabled  cols="10" rows="4">"{{$productos->nombreProducto}}"</textarea></td>
                    <td><textarea  style="border:0px" readonly value="{{$productos->detalleProducto}}" disabled  cols="20" rows="4">"{{$productos->detalleProducto}}"</textarea></td>
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