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
            @if(Auth::user()->permissions->contains('slug', 'createsale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
            <button type="submit" class="btn btn-primary" >
              {{ __('Nueva Venta') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
          @endif
            </form>
        </ol>
        
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">
            <i class="fas fa-table" style="color: #c2cfdd  ;"></i>&nbsp&nbsp
            REGISTRO DE VENTAS
            <span style="float: left">
              <a href="/sale3" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
          </span>
          </div>
            
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th style="width:20px;"><i class="fa fa-book" aria-hidden="true"></i></th>
                    <th>Serie</th>
                    <th>Vendedor</th>
                    <th>Subtotal</th>
                    <th>Iva</th>
                    <th>Total</th>
                    <th>Cliente</th> 
                    <th>Fecha</th>
                    <th>Estado</th>
                    @if(Auth::user()->permissions->contains('slug', 'viewsale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th>Ver</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'viewsale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th>Print</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'viewsale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th>Export</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'updatesale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th>Anular</th>
                    @endif
                  </tr>
                </thead>

                <tbody> 
                  @php
                      $acum= null;
                  @endphp
                  @foreach ($venta as $venta)
                  @if($acum != $venta->serialVenta)
                  <tr>
                    <td style="width:20px;">{{$venta->numeroVenta}}</td>
                    <td style="width:80px;">{{$venta->serialVenta}}</td>
                    <td style="width:80px;">{{$venta->usuario['nombre']}}&nbsp{{$venta->usuario['apellido']}}</td>
                    <td style="width:50px;">${{$venta->subtotal}}.00</td>
                    <td style="width:50px;">${{$venta->ivaAcum}}.00</td>
                    <td style="width:50px;">${{$venta->total}}.00</td>
                    <td style="width:80px;">
                      @if ($venta->cliente['estado']==1)
                      {{$venta->cliente['numeroDocumento']}}-{{$venta->cliente['nombre']}}
                      @else
                      Sin Registro
                      @endif
                    </td> 
                    <td style="width:90px;">{{$venta->fechaEmision}}</td>
                    <td style="text-align: center;width:30px">
                        @if ($venta->estado==0)
                        <button class="btn btn-danger" type="submit" disabled>Cancelado</button>
                        @else
                        <button class="btn btn-success" type="submit" disabled>Pagado</button>
                        @endif
                    </td>  
                    <!--ver-->
                    @if(Auth::user()->permissions->contains('slug', 'viewsale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <td style="width:50px; text-align:center">
                      <a class="btn btn-warning" href="/sale/{{$venta->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </td>
                    @endif

                    <!--imprimir-->
                   @if(Auth::user()->permissions->contains('slug', 'viewsale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                   <td style="width:30px; text-align:center">
                     <a title="Imprimir" class="btn btn-primary" href="javascript:void(0)" id="download"><i class="fa fa-print" aria-hidden="true"></i></a>
                   </td>
                   @endif

                    <!--exportar-->
                    @if(Auth::user()->permissions->contains('slug', 'viewsale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <td style="width:30px; text-align:center">
                      <a class="btn btn-danger" href="/sale2/{{$venta->id}}" id="download"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                    @endif

                    <!--anular-->
                    @if(Auth::user()->permissions->contains('slug', 'updatesale')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <td style="text-align: center;width:30px">
                      <form action="/sale/estado/{{$venta->id}}" method="POST">
                        @method('PATCH')
                      {{csrf_field()}}
                        @if ($venta->estado==0)
                        <button class="btn btn-danger" type="submit" disabled><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @else
                        <button class="btn btn-success" type="submit" ><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @endif
                      </form>
                      @endif
                    </td>  
                  </tr>
                  @php
                      $acum=$venta->serialVenta;
                  @endphp
                  @endif
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
              
          });

      });
  </script> 

@endsection