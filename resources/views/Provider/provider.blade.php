@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Proveedores Registrados</li>
          <form method="get" action="/provider/create" style="margin-left: auto;">
            <button type="submit" class="btn btn-primary" >
              {{ __('Nuevo Proveedor') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
            </form>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Proveedores Actuales</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr> 
                    <th>Razon Social</th>
                    <th>Tipo Documento</th>
                    <th>N° Documento</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>estado</th>
                    <th>editar</th>
                
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Razon Social</th>
                    <th>Tipo Documento</th>
                    <th>N° Documento</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>estado</th>
                    <th>editar</th>
                  </tr>
                </tfoot>

                <tbody>
                  @foreach ($proveedor as $proveedor)
                  <tr>
                    <td><textarea  style="border:0px" readonly value="{{$proveedor->razonSocial}}" disabled  cols="35" rows="2">"{{$proveedor->razonSocial}}"</textarea></td>
                    <td>
                      @if ($proveedor->document['estado']==1)
                      {{$proveedor->document['tipoDocumento']}}
                      @else
                      Tipo de documento no disponible
                      @endif
                      </td>
                      <td>{{$proveedor->numeroDocumento}}</td>
                    <td>{{$proveedor->direccion}}</td>
                    <td>{{$proveedor->telefono}}</td>
                    <td>{{$proveedor->email}}</td>
                    <td  style="text-align: center;">
                      <!--cambiar estado-->
                      <form action="/provider/estado/{{$proveedor->id}}" method="POST">
                        @method('PATCH')
                      {{csrf_field()}}
                        @if ($proveedor->estado==0)
                        <button class="btn btn-danger" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @else
                        <button class="btn btn-success" type="submit" ><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @endif
                      </form>
                      </td> 
                      <!--editar-->
                      <td style="text-align: center;">
                        <form action="/provider/{{ $proveedor['id'] }}/edit" method="GET">
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