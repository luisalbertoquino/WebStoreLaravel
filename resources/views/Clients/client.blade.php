@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Clientes</li>
          <form method="get" action="/client/create" style="margin-left: auto;">
            <button type="submit" class="btn btn-primary" >
              {{ __('Añadir Cliente al sistema') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
            </form>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Registro de Clientes</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
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
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo Documento</th>
                    <th>N° Documento</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>categoria</th>
                    <th>estado</th>
                    <th>editar</th>
                  </tr>
                </tfoot> 

                <tbody>
                  @foreach ($clientes as $clientes)
                  <tr>
                    <td>{{$clientes->id}}</td>
                    <td><textarea  style="border:0px" readonly value="{{$clientes->nombre}}" disabled  cols="10" rows="2">"{{$clientes->nombre}}"</textarea></td>
                    <td><textarea  style="border:0px" readonly value="{{$clientes->apellido}}" disabled  cols="10" rows="2">"{{$clientes->apellido}}"</textarea></td>
                    <td>
                      @if ($clientes->documento['estado']==1)
                      {{$clientes->documento['tipoDocumento']}}
                      @else
                      Tipo de documento no valido
                      @endif
                      </td>
                      <td>{{$clientes->numeroDocumento}}</td>
                      <td>{{$clientes->direccion}}</td>
                      <td>{{$clientes->telefono}}</td>
                      <td><textarea  style="border:0px" readonly value="{{$clientes->email}}" disabled  cols="15" rows="2">"{{$clientes->email}}"</textarea></td>
                     
                    <td  style="text-align: center;">
                      <!--cambiar estado-->
                      <form action="/client/estado/{{$clientes->id}}" method="POST">
                        @method('PATCH')
                      {{csrf_field()}}
                        @if ($clientes->estado==0)
                        <button class="btn btn-danger" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @else
                        <button class="btn btn-success" type="submit" ><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @endif
                      </form>
                      </td> 
                      <!--editar-->
                      <td style="text-align: center;">
                        <form action="/client/{{ $clientes['id'] }}/edit" method="GET">
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