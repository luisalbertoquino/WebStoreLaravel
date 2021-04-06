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
            @if(Auth::user()->permissions->contains('slug', 'createproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
            <button type="submit" class="btn btn-primary" >
              {{ __('Nuevo Producto') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
          @endif 
            </form>
        </ol> 

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">
            <i class="fa fa-archive" style="color: #964B00;" aria-hidden="true"></i>&nbsp&nbsp
            PRODUCTOS REGISTRADOS
            <span style="float: left">
              <a href="/product2" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
          </span></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>


                    <th>id</th>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Valor_Venta</th>
                    <th>Categoria</th>
                    @if(Auth::user()->permissions->contains('slug', 'downproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th style="text-align: center;">Estado</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'viewproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th style="text-align: center;">Ver</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'updateproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th style="text-align: center;">Edit</th>
                    @endif
                    @if(Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th style="text-align: center;">Delete</th>
                    @endif
                  </tr>
                </thead>


                <tbody>
                  @foreach ($productos as $productos)
                  <tr>
                    @if($productos->category['estado']==1)
                      <td style="width:30px;text-align: center;">{{$productos->id}}</td>
                      <td style="width:70px;" class="a">{{$productos->nombreProducto}}</td>
                      <td style="width:120px;" class="a">{{$productos->detalleProducto}}</td>
                      <td style="width:30px;">{{$productos->stock}} c/u</td>
                      <td style="width:30px;text-align: center;">{{$productos->valorVenta}}.00$</td>
                      <td style="width:30px;">
                        <!--Categoria-->
                        @if ($productos->category['estado']==1)
                        {{$productos->category['categoria']}}
                        @else
                        Categoria no definida
                        @endif
                      </td> 
                      <!--Estado-->
                      @if(Auth::user()->permissions->contains('slug', 'updatecategory')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                      <td style="text-align: center;width:50px">
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
                      @endif 

                      <!--ver-->
                      @if(Auth::user()->permissions->contains('slug', 'viewproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                      <td style="width:70px; text-align:center">
                        <a class="btn btn-warning" href="/product/{{$productos->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      </td>
                      @endif 

                      <!--editar-->
                      @if(Auth::user()->permissions->contains('slug', 'updateproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                      <td style="text-align: center;width:50px">
                        <form action="/product/{{ $productos['id'] }}/edit" method="GET">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </form>
                      </td>
                      @endif

                    <!--eliminar-->
                    @if(Auth::user()->roles->first()->nombre=='Administrador Main')
                    <td style="width:70px; text-align:center">
                      <a class="btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#deleteModal" data-postid="{{$productos->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                    @endif

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