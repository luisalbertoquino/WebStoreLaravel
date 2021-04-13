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
            @if(Auth::user()->permissions->contains('slug', 'createpurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
            <button type="submit" class="btn btn-primary" >
              {{ __('Nueva Compra') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
          @endif
            </form>
        </ol> 

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">
            <i class="fas fa-table" style="color: #c2cfdd  ;"></i>&nbsp&nbsp
            REGISTRO DE COMPRAS
            <span style="float: left">
              <a href="/shopping3" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
          </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th>serie</th>
                    <th>N° Comprobante</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Estado</th>
                    @if(Auth::user()->permissions->contains('slug', 'viewpurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th>Ver</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'viewpurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th>Imprimir</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'viewpurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th>Exportar</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'updatepurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th>Anular</th>
                    @endif
                    
                    
                  </tr>
                </thead>
    

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
                    <td  style="text-align: center;">
                      <!--cambiar estado-->
                        @if ($compra->estado==0)
                        <button class="btn btn-danger" type="submit" disabled>Cancelado</button>
                        @else
                        <button class="btn btn-success" type="submit" disabled>Pagado</button>
                        @endif
                      </td> 

                  </td>

                   <!--ver-->
                   @if(Auth::user()->permissions->contains('slug', 'viewpurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                   <td style="width:50px; text-align:center">
                     <a class="btn btn-warning" href="/shopping/{{$compra->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                   </td>
                   @endif
 
                   <!--imprimir-->
                   @if(Auth::user()->permissions->contains('slug', 'viewpurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                   <td style="width:30px; text-align:center">
                     <a title="Imprimir" class="btn btn-primary" href="/shopping2/{{$compra->id}}" id="download"><i class="fa fa-print" aria-hidden="true"></i></a>
                   </td>
                   @endif

                   <!--exportar-->
                   @if(Auth::user()->permissions->contains('slug', 'viewpurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                   <td style="width:30px; text-align:center">
                     <a class="btn btn-danger" href="javascript:void(0)" id="download"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                   </td>
                   @endif
 
                   <!--anular-->
                   @if(Auth::user()->permissions->contains('slug', 'updatepurchase')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                   <td style="text-align: center;width:30px">
                     <form action="/shopping/estado/{{$compra->id}}" method="POST">
                       @method('PATCH')
                     {{csrf_field()}}
                       @if ($compra->estado==0)
                       <button class="btn btn-danger" type="submit" disabled><i class="fa fa-refresh" aria-hidden="true"></i></button>
                       @else
                       <button class="btn btn-success" type="submit" ><i class="fa fa-refresh" aria-hidden="true"></i></button>
                       @endif
                     </form>
                     @endif
                    
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
          });

      });
  </script>

@endsection